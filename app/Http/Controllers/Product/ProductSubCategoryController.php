<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Custom\MessageController;
use App\Models\ProductSubCategory;
use App\Models\ProductCategory;
use Validator;
use Response;
use Session;
use Auth;
use DB;

class ProductSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.productsubcategory.index');
        $data['allcategory']= ProductCategory::all();
        $data['alldata']= ProductSubCategory::checkBranch()->get();
        return view('products.product-sub-category', $data);
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
        Gate::authorize('app.productsubcategory.create');
        $request->validate([
            'name' => 'required',
            'product_category_id' => 'required',
        ]);

        $input = $request->all();
        $input['branch_id'] = Auth::user()->branch_id;
        $input['created_by'] = Auth::user()->id;

        DB::beginTransaction();
        try{
            $bug=0;
            $insert= ProductSubCategory::create($input);
            DB::commit();
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            DB::rollback();
        }

        if($bug==0){
            Session::flash('flash_message','Product Sub Category Successfully Added !');
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
        Gate::authorize('app.productsubcategory.edit');
        $data['allcategory']= ProductCategory::all();
        $data['alldata']= ProductSubCategory::all();
        $data['single_data']= ProductSubCategory::findOrFail($id);
        return view('products.product-sub-category', $data);
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
        Gate::authorize('app.productsubcategory.edit');
        $data=ProductSubCategory::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'product_category_id' => 'required',
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
            Session::flash('flash_message','Product Sub Category Successfully Updated !');
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
        Gate::authorize('app.productsubcategory.destroy');
        $data = ProductSubCategory::findOrFail($id);
        try {
            $action = $data->delete();
            Session::flash('flash_message','Product Sub Category Successfully Deleted !');
            return redirect()->back()->with('status_color','danger');
        } catch (\Exception $e) {
            Session::flash('flash_message', MessageController::getErrorMessage($e->errorInfo[2]));
            return redirect()->back()->with('status_color','warning');
            DB::rollback();
        }
    }
}
