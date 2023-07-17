<?php

namespace App\Http\Controllers\Commission;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Custom\MessageController;
use App\Models\PaymentTitle;
use Validator;
use Response;
use Session;
use Auth;
use DB;

class PaymentTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Gate::authorize('app.PaymentTitle.index');
        $data['alldata']= PaymentTitle::checkBranch()->get();
        return view('commission.payment-title', $data);

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
        // Gate::authorize('app.PaymentTitle.create');
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $input = $request->all();
        $input['branch_id'] = Auth::user()->branch_id;
        $input['created_by'] = Auth::user()->id;

        DB::beginTransaction();
        try{
            $bug=0;
            $insert= PaymentTitle::create($input);
            DB::commit();
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            DB::rollback();
        }

        if($bug==0){
            Session::flash('flash_message','Title Successfully Added !');
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
        // Gate::authorize('app.PaymentTitle.edit');
        $data['alldata']= PaymentTitle::all();
        $data['single_data']= PaymentTitle::findOrFail($id);
        return view('commission.payment-title', $data);
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
        // Gate::authorize('app.PaymentTitle.edit');
        $data=PaymentTitle::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
        ]);
              
        $input = $request->all();
        DB::beginTransaction();
        try{
            $bug=0;
            $data->update($input);
            DB::commit();
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            DB::rollback();
        }

        if($bug==0){
            Session::flash('flash_message','Title Successfully Updated !');
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
        // Gate::authorize('app.PaymentTitle.destroy');
        $data = PaymentTitle::findOrFail($id);
        try {
            $action = $data->delete();
            Session::flash('flash_message','Title Successfully Deleted !');
            return redirect()->back()->with('status_color','danger');
        } catch (\Exception $e) {
            Session::flash('flash_message', MessageController::getErrorMessage($e->errorInfo[2]));
            return redirect()->back()->with('status_color','warning');
            DB::rollback();
        }
    }
}
