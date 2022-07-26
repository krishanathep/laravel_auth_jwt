<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;


class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = $request->get('data');

        $count = Branch::where('mcustno_sendto', '=', $data)->count();

        $branch = Branch::join('sumbillpay_txt', 'cust_notifcation_sendto.mcustno','=', 'sumbillpay_txt.mcustno',)
        ->where('mcustno_sendto', '=', $data)
        ->where('business', '=', 'PIPE')
        ->where('isdisable', '=', '0')
        ->whereNotNull('outstanding')
        ->get();

         return response()->json([
             'status'=> 200,
             'count'=>$count,
             'branch'=>$branch
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
        //
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
