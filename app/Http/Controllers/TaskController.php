<?php

namespace App\Http\Controllers;

use App\Task;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $task = Task::create([
            'aw_id' => $request->aw_id,
            'name' => $request->name,
            'start' => $request->start,
            'finish' => $request->finish,
            'status' => $request->status,
            'date' => $request->date,
            'updated_by' => $request->user()->id
        ]);

        return $task;
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
        $task->update([
            'closed' => $request->task['task']['closed'],
            'date' => $request->task['task']['date'],
            'start' => $request->task['task']['start'],
            'finish' => $request->task['task']['finish'],
            'name' => $request->task['task']['name'],
            'status' => $request->task['task']['status'],
        ]);

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
