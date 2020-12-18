<?php

namespace App\Http\Controllers;

use App\Task;
use App\UsualTask;
use Illuminate\Http\Request;
use App\Http\Resources\DailyTask;
use App\Http\Resources\WeeklyTask;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\MonthlyTask;
use App\Http\Resources\UsualTask as UsualTaskResource;

class UsualTaskController extends Controller
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
        return [
            'usual_tasks' => UsualTaskResource::collection(Task::Usual()->get()),
            'daily_tasks_tomorrow' => UsualTaskResource::collection(Task::Daily()->get()),
            'daily_tasks' => DailyTask::collection(UsualTask::Daily()->get()),
            'weekly_tasks' => WeeklyTask::collection(UsualTask::Weekly()->get()),
            'monthly_tasks' => MonthlyTask::collection(UsualTask::Monthly()->get()),
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usual_task = UsualTask::create([
            'name' => $request->task['task']['name'],
            'notes' => $request->task['task']['name'],
            'start' => $request->task['task']['start'],
            'finish' => $request->task['task']['finish'],
            'created_by' => $request->user()->id
        ]);

        if ($request->task['type'] == 'daily') 
        {
          $usual_task->monday = 1;
          $usual_task->tuesday = 1;
          $usual_task->wednesday = 1;
          $usual_task->thursday = 1;
          $usual_task->friday = 1;
          $usual_task->monthly = 0;
          $usual_task->month_day = null;
        } else if ($request->task['type'] == 'weekly')
        {
          foreach ($request->task['task']['days'] as $day) {
            $d = strtolower($day['name']);
            $usual_task->$d = 1;
          }
        } else if ($request->task['type'] == 'monthly')
        {
          $usual_task->monthly = 1;
          $usual_task->month_day = $request->task['task']['date'];
        }
        $usual_task->update();

        foreach ($request->task['task']['workers'] as $worker)
            {
                DB::table('usualtask_worker')->insert([
                    'usual_task_id' => $usual_task->id,
                    'worker_id' => $worker['id'],
                    'created_at' => now()
                ]);
            }

        return $usual_task;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($type,$id)
    {
        //
        switch ($type) 
        {
            case "usual":
                return new UsualTaskResource(Task::find($id));
              break;
            case "usual_daily":
                return new UsualTaskResource(Task::find($id));
              break;
            case "daily":
                return new DailyTask(UsualTask::find($id));
              break;
            case "weekly":
                return new WeeklyTask(UsualTask::find($id));
              break;
            case "monthly":
                return new MonthlyTask(UsualTask::find($id));
              break;
            default:
              return null;
        }
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
        $task = UsualTask::find($id);
        
        $type = $request->task['task']['type'];

        $task->name = $request->task['task']['name'];
        $task->start = $request->task['task']['start'];
        $task->finish = $request->task['task']['finish'];
        $task->notes = $request->task['task']['notes'];
      
        $task->monthly = 0;
        $task->month_day = null;
        $task->monday = 0;
        $task->tuesday = 0;
        $task->wednesday = 0;
        $task->thursday = 0;
        $task->friday = 0;

        switch ($type) {
            case "daily":
              $task->monday = 1;
              $task->tuesday = 1;
              $task->wednesday = 1;
              $task->thursday = 1;
              $task->friday = 1;
              break;
            case "weekly":
              foreach ($request->task['task']['days'] as $day) {
                $d = strtolower($day['name']);
                $task->$d = 1;
              }
              break;
            case "monthly":
                $task->monthly = 1;
                $task->month_day = $request->task['task']['day_of_month'];
              break;
            default:
          }
          $task->update();


        $rqstWorkers = Array();
        $dbWorkers = DB::table('usualtask_worker')
                        ->where('usual_task_id', $task->id)
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
            DB::table('usualtask_worker')
            ->where('usual_task_id', $task->id)
            ->where('worker_id', $td)
            ->delete();
        }

        foreach ($toAdd as $ta)
        {
            DB::table('usualtask_worker')->insert([
                'usual_task_id' => $task->id,
                'worker_id' => $ta,
                'created_at' => now()
            ]);
        }

        return $task;
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
        $usual_task = UsualTask::find($id);

        $usual_task->delete();
    }
}
