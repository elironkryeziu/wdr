<?php

namespace App\Http\Controllers;

use App\Plan;
use App\Worker;
use Illuminate\Http\Request;

class PlanController extends Controller
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
        $plans = Plan::all();

        return $plans;
    }

    public function workers()
    {
        //
        $workers = Worker::all();

        return $workers->map(function ($worker) {
            return [
                'id' => $worker->id,
                'label' => $worker->fullName,
                'hide' => false,
                'class' => $worker->id % 2 == 0 ? 'mom' : 'dad',
            ];
        });
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
        $plan = Plan::find($id);

        return $plan;
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
}
