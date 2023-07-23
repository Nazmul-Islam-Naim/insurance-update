<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsuranceRate\CreateInsurance;
use App\Http\Requests\InsuranceRate\UpdateInsurance;
use App\Models\InsuranceRate;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class InsuranceRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Gate::authorize('app.accounttype.index');
        $data['alldata']= InsuranceRate::orderBy('id', 'DESC')->get();
        return view('utility.insuranceRate', $data);
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
    public function store(CreateInsurance $request)
    {
        // Gate::authorize('app.accounttype.create');
        try{
            InsuranceRate::create($request->all());
            Session::flash('flash_message','Insurance Rate Successfully Added !');
            return redirect()->route('insuranceRates.index')->with('status_color','success');
        }catch(\Exception $e){
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
        // Gate::authorize('app.accounttype.index');
        $data['single_data']= InsuranceRate::findOrFail($id);
        $data['alldata']= InsuranceRate::orderBy('id', 'DESC')->get();
        return view('utility.insuranceRate', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInsurance $request, $id)
    {
        // Gate::authorize('app.accounttype.index');
        try{
            $data = $request->all();
            $token = Arr::pull($data, '_token');
            $method = Arr::pull($data, '_method');
            InsuranceRate::where('id', $id)->update($data);
            Session::flash('flash_message','Insurance Rate Successfully Updated !');
            return redirect()->route('insuranceRates.index')->with('status_color','success');
        }catch(\Exception $e){
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
        // Gate::authorize('app.accounttype.index');
        try{
            InsuranceRate::where('id', $id)->delete();
            Session::flash('flash_message','Insurance Rate Successfully Deleted !');
            return redirect()->route('insuranceRates.index')->with('status_color','success');
        }catch(\Exception $e){
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
}
