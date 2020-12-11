<?php

namespace App\Http\Controllers;

use App\Worker;
use Illuminate\Http\Request;
use App\Http\Resources\Worker as WorkerResource;

class WorkerController extends Controller
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
        $workers = Worker::all();

        return WorkerResource::collection($workers);
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

        $worker = Worker::create([
            'number' => $request->worker['worker']['number'],
            'first_name' => $request->worker['worker']['first_name'],
            'last_name' => $request->worker['worker']['last_name'],
            'notes' => $request->worker['worker']['notes']
        ]);

        return $worker;
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
        $worker = Worker::find($id);

        return $worker;
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
        // return $request;
        $worker = Worker::find($id);

        $worker->update([
            'number' => $request->worker['worker']['number'],
            'first_name' => $request->worker['worker']['first_name'],
            'last_name' => $request->worker['worker']['last_name'],
            'notes' => $request->worker['worker']['notes']
        ]);

        return $worker;
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
        $worker = Worker::find($id);

        $worker->delete();
    }
}
