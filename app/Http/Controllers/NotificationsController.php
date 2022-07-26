<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifications;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Filter by Customer Cude
    public function codefilter(Request $request)
    {
        $data = $request->get('data');

        $count = Notifications::where('mcompcode', '=', $data)
        ->where('business', '=', 'PIPE')
        ->whereNotNull('outstanding')
        ->orderBy('mcustno', 'asc')
        ->count();

        $notifications = Notifications::where('mcompcode', '=', $data)
        ->where('business', '=', 'PIPE')
        ->whereNotNull('outstanding')
        ->orderBy('mcustno', 'asc')
        ->get();

         return response()->json([
             'status'=> 200,
             'count'=>$count,
             'notifications'=>$notifications
         ]);
    }

    // Filter by Due Date
    public function dayfilter(Request $request)
    {
        $data = $request->get('data');

        $count = Notifications::where('mday', '=', $data)
        ->where('business', '=', 'PIPE')
        ->whereNotNull('outstanding')
        ->orderBy('mcustno', 'asc')
        ->count();

        $notifications = Notifications::where('mday', '=', $data)
        ->where('business', '=', 'PIPE')
        ->whereNotNull('outstanding')
        ->orderBy('mcustno', 'asc')
        ->get();

         return response()->json([
             'status'=> 200,
             'count'=>$count,
             'notifications'=>$notifications
         ]);
    }

    // Filter by Between Date
    public function duedatefilter(Request $request)
    {
        $start = $request->get('start');
        $stop = $request->get('stop');

        $notifications = Notifications::whereBetween('mduedate', [$start, $stop])
        ->where('business', '=', 'PIPE')
        ->whereNotNull('outstanding')
        ->orderBy('mcustno', 'asc')
        ->get();

         return response()->json([
             'status'=> 200,
             'notifications'=>$notifications
         ]);
    }

    public function index()
    {
        $count = DB::table('sumbillpay_txt')
        ->where('business', '=', 'PIPE')
        ->where('mday', '=', 'friday')
        ->whereBetween('mduedate', ['05/27/2022', '06/03/2022'])
        ->whereNotNull('outstanding')
        ->orderBy('mcustno', 'asc')
        ->count();

        $notifications = DB::table('sumbillpay_txt')
        ->where('business', '=', 'PIPE')
        ->where('mday', '=', 'friday')
        ->whereBetween('mduedate', ['05/27/2022', '06/03/2022'])
        ->whereNotNull('outstanding')
        ->orderBy('mcustno', 'asc')
        ->get();

        return response()->json([
            'status'=> 200,
            'count'=>$count,
            'notifications'=>$notifications
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
        $validator = Validator::make($request->all(),[
            'mcustno'=>'required|max:191',
            'mcustno_sendto'=>'required|max:191',
            'isdisable'=>'required|max:191',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=> 422,
                'validate_err'=> $validator->messages(),
            ]);
        } else {
            $notifications = new Notifications;
            $notifications->mcustno = $request->input('mcustno');
            $notifications->mcustno_sendto = $request->input('mcustno_sendto');
            $notifications->isdisable = $request->input('isdisable');
            $notifications->save();

            return response()->json([
                'status'=> 200,
                'message'=>'Notificatins Created Successfully',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notifications = Notifications::find($id);
        if($notifications)
        {
            return response()->json([
                'status'=> 200,
                'notifications' => $notifications,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Notification ID Found',
            ]);
        } 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notifications = Notifications::find($id);
        if($notifications)
        {
            return response()->json([
                'status'=> 200,
                'notifications' => $notifications,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Notifications ID Found',
            ]);
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
        $validator = Validator::make($request->all(),[
            'mcustno_sendto'=>'required|max:191',
            'isdisable'=>'required|max:191',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=> 422,
                'validationErrors'=> $validator->messages(),
            ]);
        }
        else
        {
            $notifications = Notifications::find($id);
            if($notifications) {
                $notifications->mcustno_sendto = $request->input('mcustno_sendto');
                $notifications->isdisable = $request->input('isdisable');
                $notifications->update();

                return response()->json([
                    'status'=> 200,
                    'message'=>'Student Updated Successfully',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=> 404,
                    'message' => 'No Student ID Found',
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notifications = Notifications::find($id);
        if($notifications)
        {
            $notifications->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Notification Deleted Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Notification ID Found',
            ]);
        }
    }
}
