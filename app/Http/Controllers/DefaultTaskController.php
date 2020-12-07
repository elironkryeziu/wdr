<?php

namespace App\Http\Controllers;

use App\DefaultTask;
use Illuminate\Http\Request;

class DefaultTaskController extends Controller
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
        $default_tasks = DefaultTask::all();

        return $default_tasks;
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
        $default_task = DefaultTask::create([
            'name' => $request->name,
            'sort_order' => $request->sort_order,
            'status' => $request->status,
            'notes' => $request->notes,
            'created_by' => $request->user()->id
        ]);

        return $default_task;
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
        $default_task = DefaultTask::find($id);

        return $default_task;
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
        $default_task = DefaultTask::find($id);

        $default_task->delete();
    }
}
