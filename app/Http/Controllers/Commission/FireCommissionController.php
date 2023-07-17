<?php

namespace App\Http\Controllers\Commission;

use App\Models\AccountInfoFireInsurance;
use App\Models\BankAccount;
use App\Models\Commission;
use App\Models\FireInsurance;
use App\Models\TransactionReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Custom\MessageController;
use App\Models\PaymentTitle;
use DataTables;
use Validator;
use Response;
use Session;
use Auth;
use DB;

class FireCommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Gate::authorize('app.PaymentTitle.index');
        if ($request->ajax()) {
            $alldata= FireInsurance::checkBranch()
                                            ->with('client','bank','accountInfoFireInsurance','fireAdditionalPerilsDetail')
                                            ->get();
            return DataTables::of($alldata)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                ob_start() ?>

                <ul class="list-inline m-0">
                    <li class="list-inline-item">
                        <a href="<?php echo route('fire-commission-form', $row->id); ?>" class="badge bg-primary badge-sm" data-id="<?php echo $row->id; ?>">Payment</a>
                    </li>
                </ul>

            <?php return ob_get_clean();
            })->make(True);
        }
        return view('commission.fire.fire-commission-list');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function commissionForm($id)
    {
        $data['single_data'] = FireInsurance::checkBranch()->findOrFail($id);
        $data['alltitle'] = PaymentTitle::checkBranch()->get();
        $data['allmethod'] = BankAccount::checkBranch()->get();
        return view('commission.fire.commission-form',$data);
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
        // $request->validate([
        //     'title' => 'required|string|max:255',
        // ]);
        $getInsuranceInfo = FireInsurance::where('id',$request->insurance_id)
                                                    ->select('client_id','bank_id')
                                                    ->first();
        $getAccountInfo = AccountInfoFireInsurance::where('fire_insurance_id',$request->insurance_id)
                                                    ->select('grand_total')
                                                    ->first();

        $input = $request->all();
        $input['branch_id'] = Auth::user()->branch_id;
        $input['created_by'] = Auth::user()->id;
        $input['client_id'] = $getInsuranceInfo->client_id;
        $input['bank_id'] = $getInsuranceInfo->bank_id;
        $input['insured_amount'] = $getAccountInfo->grand_total;
        $input['insurance_type'] = 'Fire';
        DB::beginTransaction();
        try{
            $commission = Commission::create($input);
            foreach ($request->addmore as $value) {
                $commission->commissionDetails()->create($value);
            }
            TransactionReport::create([
                'bank_id'=> $request->payment_method,
                'transaction_date'=> $request->date, 
                'amount'=> $input['total_amount'], 
                'keyword'=>'Fire', 
                'reason'=> 'bill payment ', 
                'note'=> $request->note, 
                'tok'=> $commission->id, 
                'status'=> 1, 
                'branch_id' =>  $input['branch_id'],
                'created_by' => Auth::id(),
            ]);

            BankAccount::where('id',$input['payment_method'])->decrement('balance',$input['total_amount']);
            DB::commit();
            Session::flash('flash_message','Payment Successfully Added !');
            return redirect()->route('commission-report')->with('status_color','success');
        }catch(\Exception $e){
            dd($e->getMessage());
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * report
     * @return \Illuminate\Http\Response
     */
    public function commissionReport(Request $request)
    {
        // Gate::authorize('app.PaymentTitle.index');
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
        // Gate::authorize('app.PaymentTitle.edit');
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
        // Gate::authorize('app.PaymentTitle.edit');
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
        // Gate::authorize('app.PaymentTitle.destroy');
        //
    }

}
