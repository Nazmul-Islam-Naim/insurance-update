<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OtherPaymentVoucher;
use App\Models\TransactionReport;
use Validator;
use Response;
use Session;
use Auth;
use DB;

class OtherPaymentAmenmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['alldata']=  OtherPaymentVoucher::orderBy('id','desc')->paginate(250);
        return view('amenment.paymentVoucherAmenment', $data);
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
        DB::beginTransaction();
        try{
            $bug=0;
            // Getting amount
            $amount = DB::table('other_payment_vouchers')->where('tok', $id)->first();
            $action = DB::table('bank_accounts')->where('id', $amount->bank_id)->increment('balance', $amount->amount);

            $action = OtherPaymentVoucher::where('tok',$id)->delete();
            $action = TransactionReport::where('tok',$id)->delete();

            DB::commit();
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            DB::rollback();
        }

        if($bug==0){
            Session::flash('flash_message','Other Payment Successfully Deleted !');
            return redirect()->back()->with('status_color','danger');
        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }

    public function filter(Request $request)
    {
        if ($request->start_date !="" && $request->end_date !="") {
            $data['alldata']= OtherPaymentVoucher::whereBetween('payment_date', [$request->start_date, $request->end_date])->paginate(250);
            $data['start_date'] = $request->start_date;
            $data['end_date'] = $request->end_date;
            return view('amenment.paymentVoucherAmenment', $data);
        }
    }
}
