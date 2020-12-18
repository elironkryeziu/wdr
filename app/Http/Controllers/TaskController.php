<?php

namespace App\Http\Controllers;

use App\Aw;
use App\Task;
use App\DefaultTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Task as TaskResource;
use App\Http\Resources\SingleTask as SingleTaskResource;


class TaskController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tasks = Task::all();

        return TaskResource::collection($tasks);
    }

    public function week_tasks()
    {
        $tasks = DB::table('task_worker')
            ->join('tasks', 'tasks.id', '=', 'task_worker.task_id')
            ->leftJoin('aws', 'aws.id', '=', 'tasks.aw_id')
            ->select('task_worker.worker_id','tasks.id', 'tasks.name', 'tasks.status', 'tasks.date','tasks.style','tasks.start','tasks.finish','aws.name as aw_name','aws.client','aws.coli','aws.wm_quantity')
            ->where('tasks.show_in_plan',true)
            ->where('tasks.date','>=',now()->startOfWeek())
            ->where('tasks.date','<=',now()->endOfWeek())
            ->get();

            // return $tasks;
        return $tasks->map(function ($task) {
            return [
                'task_id' => $task->id,
                'start' => substr($task->date . " " . $task->start, 0, -3),
                'end' => substr($task->date . " " . $task->finish, 0, -3),
                'title' => $task->name,
                'status' => $task->status,
                'class' => $task->worker_id % 2 == 0 ? 'sport' : 'health',
                'split' => $task->worker_id,
                'aw_name' => $task->aw_name,
                'client' => $task->client,
                'coli' => $task->coli,
                'aw_minus_wm' => $task->coli - $task->wm_quantity
            ];
        });   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // return $request;
        
        if (!$request->task['task']['isDefault'] || !isset($request->task['task']['isDefault']))
        {
            //nese useri nuk e ka zgjedh default
            $task = Task::create([
                'aw_id' => $request->task['id'] ?? null,
                'name' => $request->task['task']['name'],
                'notes' => $request->task['task']['notes'] ?? null,
                'start' => $request->task['task']['start'],
                'finish' => $request->task['task']['finish'],
                'status' => $request->task['task']['status'],
                'date' => $request->task['task']['date'],
                'updated_by' => $request->user()->id
            ]);
    
    
            foreach ($request->task['task']['workers'] as $worker)
            {
                DB::table('task_worker')->insert([
                    'task_id' => $task->id,
                    'worker_id' => $worker['id'],
                    'created_at' => now()
                ]);
            }
    
            return $task;
        } else 
        {
            $last_dt = DefaultTask::orderBy('id','desc')->first();
            $default_task = DefaultTask::updateOrCreate(
                [
                    'name' => $request->task['task']['name'],
                ],
                [
                    'name' => $request->task['task']['name'],
                    'sort_order' => $last_dt->sort_order + 1,
                    'status' => 'active',
                    'created_by' => $request->user()->id
            ]);

            $awObj = Aw::find($request->task['id']);
            $aws = Aw::where('loading_date','>=',$awObj->loading_date)->get();

            //tasku i sodit
            $task = Task::create([
                'aw_id' => $awObj->id,
                'name' => $request->task['task']['name'],
                'start' => $request->task['task']['start'],
                'finish' => $request->task['task']['finish'],
                'status' => $request->task['task']['status'],
                'date' => $request->task['task']['date'],
                'updated_by' => $request->user()->id
            ]);
    
            //taskat per AW-te e ardhshme
            foreach ($aws as $aw)
            {
                if (!$aw->isClosed)
                {
                    $task = Task::updateOrCreate(
                        [
                            'aw_id' => $aw->id,
                            'name' => $request->task['task']['name'],
                        ],
                        [
                            'aw_id' => $aw->id,
                            'name' => $request->task['task']['name'],
                            'updated_by' => $request->user()->id
                    ]);
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $task = Task::find($id);

        return new SingleTaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $task = Task::find($id);
        
        // return isset($task['task']['notes']);

        if (!isset($request->task['task']['notes']))
        {
            $task->update([
                'closed' => $request->task['task']['closed'],
                'date' => $request->task['task']['date'],
                'start' => $request->task['task']['start'],
                'finish' => $request->task['task']['finish'],
                'name' => $request->task['task']['name'],
                'notes' => $request->task['task']['notes'] ?? null,
                'status' => $request->task['task']['status'],
            ]);
        }
        else {
            $task->update([
                'closed' => $request->task['task']['closed'],
                'date' => $request->task['task']['date'],
                'start' => $request->task['task']['start'],
                'finish' => $request->task['task']['finish'],
                'name' => $request->task['task']['name'],
                'notes' => $request->task['task']['notes'] ?? null,
                'status' => $request->task['task']['status'],
            ]);
        }

        $rqstWorkers = Array();
        $dbWorkers = DB::table('task_worker')
                        ->where('task_id', $task->id)
                        ->pluck('worker_id')
                        ->toArray();

        foreach ($request->task['task']['workers'] as $worker)
        {
            array_push($rqstWorkers,$worker['id']);
        }

        $toDelete = array_diff($dbWorkers,$rqstWorkers);
        $toAdd = array_diff($rqstWorkers,$dbWorkers);
        
        foreach ($toDelete as $td)
        {
            DB::table('task_worker')
            ->where('task_id', $task->id)
            ->where('worker_id', $td)
            ->delete();
        }

        foreach ($toAdd as $ta)
        {
            DB::table('task_worker')->insert([
                'task_id' => $task->id,
                'worker_id' => $ta,
                'created_at' => now()
            ]);
        }

        return "Task updated";

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $task = Task::find($id);

        $task->delete();
    }
}
