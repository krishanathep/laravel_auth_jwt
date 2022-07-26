<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customers::all();

        return response()->json([
            'status'=> 200,
            'customers'=>$customers,
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
        // $validator = Validator::make($request->all(),[
        //     'id' => 'required',
        //     'name' => 'required',
        //     'address1' => 'required',
        //     'address2' => 'required',
        //     'fax' => 'required',
        //     'faxstatus' => 'required',
        //     'phone' => 'required',
        //     'email' => 'required',
        //     'contact' => 'required',
        //     'remark' => 'required',
        // ]);

        // if($validator->fails())
        // {
        //     return response()->json([
        //         'status'=> 422,
        //         'validate_err'=> $validator->messages(),
        //     ]);
        // }
        // else
        // {
            $customer = new Customers;
            $customer->mcustno = $request->input('id');
            $customer->mcustname = $request->input('name');
            $customer->maddress1 = $request->input('address1');
            $customer->maddress2 = $request->input('address2');
            $customer->mfax = $request->input('fax');
            $customer->mstatusfax = $request->input('faxstatus');
            $customer->mtel = $request->input('phone');
            $customer->mmobile = $request->input('mobile');
            $customer->memail = $request->input('email');
            $customer->mcontact = $request->input('contact');
            $customer->mremarks = $request->input('remark');

            $customer->save();

            return response()->json([
                'status'=> 200,
                'message'=>'Customer Added Successfully',
            ]);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customers = Customers::find($id);
        if($customers)
        {
            return response()->json([
                'status'=> 200,
                'customers' => $customers,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Customer ID Found',
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
        $validator = Validator::make($request->all(),[
            'id' => 'required',
            'name' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'fax' => 'required',
            'faxstatus' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'remark' => 'required',
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
            $customer = Customers::find($id);
            if($customer)
            {
                $customer->id = $request->input('id');
                $customer->name = $request->input('name');
                $customer->address1 = $request->input('address1');
                $customer->address2 = $request->input('address2');
                $customer->fax = $request->input('fax');
                $customer->faxstatus = $request->input('faxstatus');
                $customer->phone = $request->input('phone');
                $customer->email = $request->input('email');
                $customer->contact = $request->input('contact');
                $customer->remark = $request->input('remark');

                $customer->update();

                return response()->json([
                    'status'=> 200,
                    'message'=>'Customer Updated Successfully',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=> 404,
                    'message' => 'No Customer ID Found',
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
        $customer = Customers::find($id);
        if($customer)
        {
            $customer->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Customer Deleted Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Customer ID Found',
            ]);
        }
    }
}
