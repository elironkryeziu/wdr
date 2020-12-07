<?php

namespace App\Http\Controllers;

use App\Pause;
use Illuminate\Http\Request;

class PauseController extends Controller
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
        $pauses = Pause::all();

        return $pauses;
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
        $pause = Pause::create([
            'worker_id' => $request->worker_id,
            'start_time' => $request->start_time,
            'finish_time' => $request->finish_time,
            'notes' => $request->notes,
            'created_by' => $request->user()->id
        ]);

        return $pause;
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
        $pause = Pause::find($id);

        return $pause;
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
        $pause = Pause::find($id);

        $pause->delete();        
    }
}
