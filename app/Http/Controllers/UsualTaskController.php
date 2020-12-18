<?php

namespace App\Http\Controllers;

use App\Task;
use App\UsualTask;
use Illuminate\Http\Request;
use App\Http\Resources\UsualTask as UsualTaskResource;
use App\Http\Resources\DailyTask;
use App\Http\Resources\WeeklyTask;
use App\Http\Resources\MonthlyTask;

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
        // $request->task['task']['name']
        // return $request;
        
        $usual_task = UsualTask::create([
            'name' => $request->task['task']['name'],
            'status' => $request->task['task']['status'],
            'notes' => $request->task['task']['name'],
            'start' => $request->task['task']['start'],
            'finish' => $request->task['task']['finish'],
            'created_by' => $request->user()->id
        ]);

        if ($request->monthly) 
        {
          $usual_task = UsualTask::create([
            'name' => $request->task['task']['name'],
            'status' => $request->task['task']['status'],
            'notes' => $request->task['task']['name'],
            'start' => $request->task['task']['start'],
            'finish' => $request->task['task']['finish'],
            'monthly' => 1,
            'month_day' =>  $request->task['task']['month_day'],
            // 'monday' => $request->task['task']['day']['monday'],
            // 'tuesday' => $request->task['task']['day']['tuesday'],
            // 'wednesday' => $request->task['task']['day']['wednesday'],
            // 'thursday' => $request->task['task']['day']['thursday'],
            // 'friday' => $request->task['task']['day']['friday'],
            'created_by' => $request->user()->id
        ]);
            // $usual_task->monthly = 1;
            // $usual_task->month_day = $request->task['task']['day_of_the_month'];
            
            return $usual_task;
        } 
        else if($request->weekly)
        {
          return $request->task['task'];
        //   $usual_task = UsualTask::create([
        //     'name' => $request->task['task']['name'],
        //     'status' => $request->task['task']['status'],
        //     'notes' => $request->task['task']['name'],
        //     'start' => $request->task['task']['start'],
        //     'finish' => $request->task['task']['finish'],
        //     'monday' => $request->task['task']['day']['monday'],
        //     'tuesday' => $request->task['task']['day']['tuesday'],
        //     'wednesday' => $request->task['task']['day']['wednesday'],
        //     'thursday' => $request->task['task']['day']['thursday'],
        //     'friday' => $request->task['task']['day']['friday'],
        //     'created_by' => $request->user()->id
        // ]);
          

          // $usual_task->monday = $request->monday;
          // $usual_task->tuesday = $request->tuesday;
          // $usual_task->wednesday = $request->wednesday;
          // $usual_task->thursday = $request->thursday;
          // $usual_task->friday = $request->friday;
        }
        else 
        {
          $usual_task = UsualTask::create([
            'name' => $request->task['task']['name'],
            'status' => $request->task['task']['status'],
            'notes' => $request->task['task']['name'],
            'start' => $request->task['task']['start'],
            'finish' => $request->task['task']['finish'],
            'monday' => 1,
            'tuesday' => 1,
            'wednesday' => 1,
            'thursday' => 1,
            'friday' => 1,
            'created_by' => $request->user()->id
          ]);

          // $usual_task->monday = 1;
          // $usual_task->tuesday = 1;
          // $usual_task->wednesday = 1;
          // $usual_task->thursday = 1;
          // $usual_task->friday = 1;
        }
        // $usual_task->update();

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
        $task->status = $request->task['task']['status'];
        $task->start = $request->task['task']['start'];
        $task->finish = $request->task['task']['finish'];
        $task->notes = $request->task['task']['notes'];
      
        switch ($type) {
            case "daily":
              // $task->name = $request->task['task']['name'];
              // $task->status = $request->task['task']['status'];
              // $task->start = $request->task['task']['start'];
              // $task->finish = $request->task['task']['finish'];
              // $task->notes = $request->task['task']['notes'];
              $task->monday = 1;
              $task->tuesday = 1;
              $task->wednesday = 1;
              $task->thursday = 1;
              $task->friday = 1;
              
              break;
            case "weekly":
              // $task->name = $request->task['task']['name'];
              // $task->status = $request->task['task']['status'];
              // $task->start = $request->task['task']['start'];
              // $task->finish = $request->task['task']['finish'];
              // $task->notes = $request->task['task']['notes'];
              $task->monday = isset($request->task['task']['monday']) ?? 0;
              $task->tuesday = isset($request->task['task']['tuesday']) ?? 0;
              $task->wednesday = isset($request->task['task']['wednesday']) ?? 0;
              $task->thursday = isset($request->task['task']['thursday']) ?? 0;
              $task->friday = isset($request->task['task']['friday']) ?? 0;
              // return $task;

              break;
            case "monthly":
                $task->monthly = 1;
                $task->day_of_month = $request->task['task']['day_of_month'];
              break;
            default:
          }

          $task->update();

          
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
