<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SendDetail;

class SendDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = SendDetail::all();

        return response()->json([
            'status'=> 200,
            'details'=>$details,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $details = new SendDetail;
            $details->mcusdoc = $request->input('mcusdoc');
            $details->mcustno = $request->input('mcustno');
            $details->mcustname = $request->input('mcustname');
            $details->send_from = $request->input('send_from');
            $details->fax = $request->input('fax');
            $details->email = $request->input('email');
            $details->report = $request->input('report');
           

            $details->save();

            return response()->json([
                'status'=> 200,
                'message'=>'Details Added Successfully',
            ]);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    }
}
