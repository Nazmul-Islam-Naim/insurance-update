<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OtherPaymentType;
use Validator;
use Response;
use Session;
use Auth;
use DB;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['alldata']= OtherPaymentType::where('branch_id',Auth::user()->branch_id)->orderBy('id', 'DESC')->get();
        return view('otherPayment.type', $data);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('flash_message', $validator->errors());
            return redirect()->back()->with('status_color','warning');
        }

        $input = $request->all();
        $input['status'] = 1;
        $input['branch_id'] = Auth::user()->branch_id;

        DB::beginTransaction();
        try{
            $bug=0;
            $insert= OtherPaymentType::create($input);
            DB::commit();
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            DB::rollback();
        }

        if($bug==0){
            Session::flash('flash_message','Payment Type Successfully Created !');
            return redirect()->back()->with('status_color','success');
        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
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
        $data=OtherPaymentType::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('flash_message', $validator->errors());
            return redirect()->back()->with('status_color','warning');
        }
              
        $input = $request->all();
        try{
            $bug=0;
            $data->update($input);
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }

        if($bug==0){
            Session::flash('flash_message','Payment Type Successfully Updated !');
            return redirect()->back()->with('status_color','warning');
        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
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
        $data = OtherPaymentType::findOrFail($id);
        $action = $data->delete();

        if($action){
            Session::flash('flash_message','Payment Type Successfully Deleted !');
            return redirect()->back()->with('status_color','danger');
        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
}
