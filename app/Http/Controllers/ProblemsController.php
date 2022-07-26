<?php

namespace App\Http\Controllers;

use App\Models\Problems;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProblemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $problems = Problems::all();
        return response()->json([
            'status'=> 200,
            'problems'=>$problems,
        ]);
    }
    // Filter user login
    public function search(Request $request)
    {
        $search = 'krishanathep@gmail.com';

        $problems = Problems::select("*")->where('email', $search)->get();

        $count = $problems->count();

        return response()->json([
            'status'=> 200,
            'count'=> $count,
            'problems'=>$problems,
        ]);
    }

    // Filter finish case
    public function finish()
    {
        $problems = Problems::select("*")->where('status', 'Finish')->get();

        $count = $problems->count();

        return response()->json([
            'status'=> 200,
            'count'=> $count,
            'problems'=>$problems,
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
            'name'=>'required|max:191',
            'detail'=>'required|max:191',
            'country'=>'required|max:191',
            'category'=>'required|max:191',
            'status'=>'required|max:191',
            'email'=>'required|email|max:191',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=> 422,
                'validate_err'=> $validator->messages(),
            ]);
        }
        else
        {
            // $fileName = time().'.'.$request->file('files')->extension();  
            // $request->file('files')->move(public_path('uploads'), $fileName);
    
            $problem = new Problems;
            $problem->name = $request->input('name');
            $problem->detail = $request->input('detail');
            $problem->country = $request->input('country');
            $problem->status = $request->input('status');
            $problem->category = $request->input('category');
            $problem->email = $request->input('email');
            // $student->file = $fileName;
            $problem->save();

            return response()->json([
                'status'=> 200,
                'message'=>'Problem Added Successfully',
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
        $problem = Problems::find($id);
        if($problem)
        {
            return response()->json([
                'status'=> 200,
                'problem' => $problem,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Problem ID Found',
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
        $problem = Problems::find($id);
        if($problem)
        {
            return response()->json([
                'status'=> 200,
                'problem' => $problem,
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
            'name'=>'required|max:191',
            'detail'=>'required|max:191',
            'country'=>'required|max:191',
            'status'=>'required|max:191',
            'category'=>'required|max:191',
            'email'=>'required|email|max:191',
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
            $problem = Problems::find($id);
            if($problem)
            {
                $problem->name = $request->input('name');
                $problem->detail = $request->input('detail');
                $problem->country = $request->input('country');
                $problem->status = $request->input('status');
                $problem->category = $request->input('category');
                $problem->email = $request->input('email');
                $problem->update();

                return response()->json([
                    'status'=> 200,
                    'message'=>'Problem Updated Successfully',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=> 404,
                    'message' => 'No Problem ID Found',
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
        $problem = Problems::find($id);
        if($problem)
        {
            $problem->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Problem Deleted Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Problem ID Found',
            ]);
        }
    }
}
