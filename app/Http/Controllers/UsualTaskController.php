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
        //
        $usual_task = UsualTask::create([
            'name' => $request->name,
            'notes' => $request->notes,
            'created_by' => $request->user()->id
        ]);

        if ($request->monthly) 
        {
            $usual_task->monthly = $request->monthly;
            $usual_task->month_day = $request->month_day;
        } else 
        {
            $usual_task->monday = $request->monday;
            $usual_task->tuesday = $request->tuesday;
            $usual_task->wednesday = $request->wednesday;
            $usual_task->thursday = $request->thursday;
            $usual_task->friday = $request->friday;
        }
        $usual_task->update();

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
        //
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
