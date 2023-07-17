<?php

namespace App\Http\Controllers\Utility;

use App\Models\TarrifType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Custom\MessageController;
use App\Models\TarrifCalculation;
use DataTables;
use Validator;
use Response;
use Session;
use Auth;
use DB;

class TarrifCalculationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        // Gate::authorize('app.TarrifCalculation.index');
        if ($request->ajax()) {
            $alldata= TarrifCalculation::checkBranch()->with('tarrif','branch','user')->get();
            return DataTables::of($alldata)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                ob_start() ?>

                <ul class="list-inline m-0">
                    <li class="list-inline-item">
                        <a href="<?php echo route('tarrif-calculation.edit', $row->id); ?>" class="badge bg-primary badge-sm" data-id="<?php echo $row->id; ?>"><i class="icon-edit-3"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <button data-id="<?php echo $row->id; ?>" class="badge bg-danger badge-sm button-delete"><i class="icon-delete"></i></button>
                    </li>
                </ul>

            <?php return ob_get_clean();
            })->make(True);
        }
        return view('utility.motor.tarrif-claculation-list');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Gate::authorize('app.TarrifCalculation.edit');
        $data['alltarrif']= TarrifType::all();
        return view('utility.motor.tarrif-calculation-form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Gate::authorize('app.TarrifCalculation.create');
        $request->validate([
            'tarrif_id' => 'required',
            'basic' => 'numeric',
            'act_laibility' => 'numeric',
            'per_pessanger_fee' => 'numeric',
            'pessanger' => 'numeric',
            'driver_fee' => 'numeric',
            'net_amount' => 'numeric',
            'vat_percent' => 'numeric',
        ]);

        $input = $request->all();
        $input['branch_id'] = Auth::user()->branch_id;
        $input['created_by'] = Auth::user()->id;

        DB::beginTransaction();
        try{
            $bug=0;
            $insert= TarrifCalculation::create($input);
            DB::commit();
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            DB::rollback();
        }

        if($bug==0){
            Session::flash('flash_message','Tarrif Calculation Successfully Added !');
            return redirect()->route('tarrif-calculation.index')->with('status_color','success');
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
        // Gate::authorize('app.TarrifCalculation.edit');
        
        $data['alltarrif']= TarrifType::all();
        $data['single_data']= TarrifCalculation::findOrFail($id);
        // dd($data['alltarrif']);
        return view('utility.motor.tarrif-calculation-form', $data);
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
        // Gate::authorize('app.TarrifCalculation.edit');
        $data=TarrifCalculation::findOrFail($id);

        $request->validate([
            'tarrif_id' => 'required',
            'basic' => 'numeric',
            'act_laibility' => 'numeric',
            'per_pessanger_fee' => 'numeric',
            'pessanger' => 'numeric',
            'driver_fee' => 'numeric',
            'net_amount' => 'numeric',
            'vat_percent' => 'numeric',
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
            Session::flash('flash_message','Tarrif Calculation Successfully Updated !');
            return redirect()->route('tarrif-calculation.index')->with('status_color','warning');
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
        // Gate::authorize('app.TarrifCalculation.destroy');
        $data = TarrifCalculation::findOrFail($id);
        try {
            $action = $data->delete();
            Session::flash('flash_message','Tarrif Calculation Successfully Deleted !');
            return redirect()->back()->with('status_color','danger');
        } catch (\Exception $e) {
            Session::flash('flash_message', MessageController::getErrorMessage($e->errorInfo[2]));
            return redirect()->back()->with('status_color','warning');
            DB::rollback();
        }
    }
}
