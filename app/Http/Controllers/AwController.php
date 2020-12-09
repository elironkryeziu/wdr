<?php

namespace App\Http\Controllers;

use App\Aw;
use Illuminate\Http\Request;
use App\Http\Resources\Aw as AwResource;


class AwController extends Controller
{
    //

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $aws = Aw::all();

        // if ($request->startDate)
        // {
        //     $aws->where('loading_date','>',$request->startDate);
        // } else 
        // {
        //     $aws->where('loading_date','>',today()->toDateString());
        // }

        // if ($request->finishDate)
        // {
        //     $aws->where('loading_date','>',$request->finishDate);
        // }

        return AwResource::collection($aws);
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
        $aw = Aw::find($id);

        return $aw;
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
