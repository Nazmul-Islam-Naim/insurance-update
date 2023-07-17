<?php

namespace App\Http\Controllers\Utility;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Custom\MessageController;
use App\Models\Bank;
use DataTables;
use Validator;
use Response;
use Session;
use Auth;
use DB;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        // Gate::authorize('app.Bank.index');
        if ($request->ajax()) {
            $alldata = Bank::checkBranch()->with('insuranceBranch','user')->get();
            return DataTables::of($alldata)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                ob_start() ?>

                <ul class="list-inline m-0">
                    <li class="list-inline-item">
                        <a href="<?php echo route('bank.edit', $row->id); ?>" class="badge bg-primary badge-sm" data-id="<?php echo $row->id; ?>"><i class="icon-edit-3"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <button data-id="<?php echo $row->id; ?>" class="badge bg-danger badge-sm button-delete"><i class="icon-delete"></i></button>
                    </li>
                </ul>

            <?php return ob_get_clean();
            })->make(True);
        }
        return view('utility.bank.bank-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['alldata']= Bank::orderBy('id', 'DESC')->get();
        return view('utility.bank.create-edit-form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Gate::authorize('app.Bank.create');
        $request->validate([
            'name' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'address' => 'required',
        ]);

        $input = $request->all();
        $input['branch_id'] = Auth::user()->branch_id;
        $input['created_by'] = Auth::user()->id;
        
        DB::beginTransaction();
        try{
            $insert= Bank::create($input);
            DB::commit();
            Session::flash('flash_message','Bank Successfully Added !');
            return redirect()->route('bank.index')->with('status_color','success');
        }catch(\Exception $e){
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
            DB::rollback();
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
        // Gate::authorize('app.Bank.edit');
        $data['single_data']= Bank::find($id);
        return view('utility.bank.create-edit-form', $data);
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
        // Gate::authorize('app.Bank.edit');

        $data=Bank::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'address' => 'required',
        ]);
              
        $input = $request->all();
        try{
            $data->update($input);
            Session::flash('flash_message','Bank Successfully Updated !');
            return redirect()->route('bank.index')->with('status_color','warning');
        }catch(\Exception $e){
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
            DB::rollback();
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
        // Gate::authorize('app.Bank.destroy');
        $data = Bank::findOrFail($id);
        try {
            $action = $data->delete();
            Session::flash('flash_message','Bank Successfully Deleted !');
            return redirect()->back()->with('status_color','danger');
        } catch (\Exception $e) {
            Session::flash('flash_message', MessageController::getErrorMessage($e->errorInfo[2]));
            return redirect()->back()->with('status_color','warning');
            DB::rollback();
        }
    }
}
