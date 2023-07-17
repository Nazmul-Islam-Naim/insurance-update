<?php

namespace App\Http\Controllers\Utility;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Custom\MessageController;
use App\Models\TransitBy;
use App\Models\VoyageVia;
use Str;
use Validator;
use Response;
use Session;
use Auth;
use DB;

class TransitByController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Gate::authorize('app.TransitBy.index');
        $data['allvia']= VoyageVia::all();
        $data['alldata']= TransitBy::checkBranch()->get();
        return view('utility.voyage.transit-by', $data);
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
        // Gate::authorize('app.TransitBy.create');
        $input = $request->all();
        $input['branch_id'] = Auth::user()->branch_id;
        $input['created_by'] = Auth::user()->id;
        $input['slug'] = Str::slug($request->name); 

        $request->validate([
            'name' => 'required|string|max:255|unique:transit_bies,name',
            'voyage_via_id' => 'required',
        ]);

        DB::beginTransaction();
        try{
            $bug=0;
            $insert= TransitBy::create($input);
            DB::commit();
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            DB::rollback();
        }

        if($bug==0){
            Session::flash('flash_message','Transit By Successfully Added !');
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
        // Gate::authorize('app.TransitBy.edit');
        $data['allvia']= VoyageVia::all();
        $data['alldata']= TransitBy::all();
        $data['single_data']= TransitBy::findOrFail($id);
        return view('utility.voyage.transit-by', $data);
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
        // Gate::authorize('app.TransitBy.edit');
        $data=TransitBy::findOrFail($id);

        $input = $request->all();
        $input['slug'] = Str::slug($request->name);

        $request->validate([
            'name' => 'required|string|max:255|unique:transit_bies,name,'.$id,
            'voyage_via_id' => 'required',
        ]);
              
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
            Session::flash('flash_message','Transit By Successfully Updated !');
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
        // Gate::authorize('app.TransitBy.destroy');
        $data = TransitBy::findOrFail($id);
        try {
            $action = $data->delete();
            Session::flash('flash_message','Transit By Successfully Deleted !');
            return redirect()->back()->with('status_color','danger');
        } catch (\Exception $e) {
            Session::flash('flash_message', MessageController::getErrorMessage($e->errorInfo[2]));
            return redirect()->back()->with('status_color','warning');
            DB::rollback();
        }
    }

    //----------------------- ajax for insurance ---------------------//
    public function takeStampAmount(Request $request){
        $data = TransitBy::where('id', $request->id)->first();
        return Response::json($data);
        die;
    }
}
