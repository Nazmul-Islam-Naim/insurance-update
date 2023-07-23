<?php

namespace App\Http\Controllers\Motor;

use App\Models\AccountInfoMotorInsurance;
use App\Models\AdditionalPerils;
use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\BankClientLedger;
use App\Models\BillCollectionMotor;
use App\Models\Branch;
use App\Models\ClientInsured;
use App\Models\Currency;
use App\Models\MotorInsurance;
use App\Models\Product;
use App\Models\TarrifCalculation;
use App\Models\TransactionReport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Models\MarineCargoInsurance;
use DataTables;
use NumberToWords\NumberToWords;
use Validator;
use Response;
use Session;
use Auth;
use DB;

class MotorInsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        // Gate::authorize('app.MarineCargoInsurance.index');
        if ($request->ajax()) {
            $alldata= MotorInsurance::checkBranch()
                            ->with('client','bank','tarrifCalculation','tarrifCalculation.tarrif','accountInfoMotorInsurance','motorAdditionalPerilsDetail')
                            ->orderBy('id','desc')
                            ->get();
            return DataTables::of($alldata)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                ob_start() ?>

                <ul class="list-inline m-0">
                    <!--<li class="list-inline-item">-->
                    <!--    <a href="<?php echo route('motor-insurance.edit', $row->id); ?>" class="badge bg-primary badge-sm" data-id="<?php echo $row->id; ?>"><i class="icon-edit-3"></i></a>-->
                    <!--</li>-->
                    <li class="list-inline-item">
                        <button data-id="<?php echo $row->id; ?>" class="badge bg-danger badge-sm button-delete"><i class="icon-delete"></i></button>
                    </li>
                </ul>

            <?php return ob_get_clean();
            })->make(True);
        }
        return view('motor.insurance-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['allclient']= ClientInsured::orderBy('id','desc')->get();
        $data['allbank']= Bank::orderBy('id','desc')->get();
        $data['alltarrif']= TarrifCalculation::orderBy('id','desc')->get();
        $data['allproduct']= Product::orderBy('id','desc')->get();
        $data['allcurrency']= Currency::orderBy('id','desc')->get();
        $data['allperils']= AdditionalPerils::orderBy('id','desc')->get();
        return view('motor.create-edit-form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
       
        // Gate::authorize('app.MarineCargoInsurance.create');
        $request->validate([
            'client_id' => 'required',
            'bank_id' => 'required',
        ]);

        $input = $request->all();
        $input['insurance_code'] = MotorInsurance::setInsuranceCode(date('Y',strtotime($request->period_from)));
        $input['branch_id'] = Auth::user()->branch_id;
        $input['created_by'] = Auth::user()->id;
        $input['due'] = $request->grand_total;
        

        DB::beginTransaction();
        try{
            //----------------- save data to database ---------------//
        // dd($request->all());
            if ($request->save != '') {

                $motorInsurance = MotorInsurance::create($input);
                $account = $motorInsurance->accountInfoMotorInsurance()->create($input);
                $motorInsurance->insurances()->create(['type' => 'Motor']);
                if (!empty($request->addmore)) {
                    foreach ($request->addmore as $value) {
                        $perils = $motorInsurance->motorAdditionalPerilsDetail()->create($value);
                    }
                }
    
                BankClientLedger::create([
                    'client_id' => $request->client_id, 
                    'bank_id' => $request->bank_id,
                    'creator_id' => Auth::id(),
                    'insurance_id' =>  $motorInsurance->id,
                    'insurance_type' => 'Motor',
                    'reason' => "bill for ". $motorInsurance->client->name,
                    'amount' => $request->grand_total,
                    'date' => $request->period_from,
                    'branch_id' =>  $input['branch_id'],
                    'created_by' => $input['created_by'],
                ]);
                DB::commit();
                Session::flash('flash_message','Motor Insurance Successfully Added !');
                return redirect()->route('motor-insurance.index')->with('status_color','success');
            } 
            //----------------- save data to database ---------------//
            else {
                // dd($input);
                $data = $this->preview($input);
                return view('motor.insurance-preview',$data);
            }
            
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
        // Gate::authorize('app.MarineCargoInsurance.edit');
        $data['single_data']= MarineCargoInsurance::find($id);
        return view('motor.create-edit-form', $data);
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
        // Gate::authorize('app.MarineCargoInsurance.edit');

        $data=MarineCargoInsurance::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'address' => 'required',
        ]);
              
        $input = $request->all();
        try{
            $data->update($input);
            Session::flash('flash_message','Marine Cargo Insurance Successfully Updated !');
            return redirect()->route('marine-cargo-insurance.index')->with('status_color','warning');
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
        // Gate::authorize('app.MarineCargoInsurance.destroy');
        $data = MotorInsurance::findOrFail($id);
        $data->insurances()->delete();
        $action = $data->delete();

        if($action){
            Session::flash('flash_message','Motor Insurance Successfully Deleted !');
            return redirect()->back()->with('status_color','danger');
        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }

    //--------------------------------- get tarrif ----------------------------------------------//
    public function getTarrif(Request $request){
        $data = TarrifCalculation::with('tarrif')->findOrFail($request->id);
        return response()->json($data);
        die;
    }
    //--------------------------------- motor bill collection list -----------------------------//
    public function motorBillCollection( Request $request)
    {
        // Gate::authorize('app.MarineCargoInsurance.index');
        if ($request->ajax()) {
            if (!empty($request->start_date) && !empty($request->end_date)) {
                $alldata= MotorInsurance::checkBranch()
                                        ->with('client','bank','tarrifCalculation','tarrifCalculation.tarrif','accountInfoMotorInsurance','motorAdditionalPerilsDetail')
                                        ->whereBetween('period_from',[date('Y-m-d',strtotime($request->start_date)),date('Y-m-d',strtotime($request->end_date))])
                                        ->orderBy('id','desc')
                                        ->get();
                 return DataTables::of($alldata)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    ob_start() ?>
    
                    <ul class="list-inline m-0">
                        <li class="list-inline-item">
                            <a href="<?php echo route('motor-bill-collection-form', $row->id); ?>" class="badge bg-warning badge-sm" data-id="<?php echo $row->id; ?>">Bill Collect</a>
                        </li>
                    </ul>
    
                <?php return ob_get_clean();
                })->make(True);
            } else {
                $alldata= MotorInsurance::checkBranch()
                                        ->with('client','bank','tarrifCalculation','tarrifCalculation.tarrif','accountInfoMotorInsurance','motorAdditionalPerilsDetail')
                                        ->orderBy('id','desc')
                                        ->get();
                 return DataTables::of($alldata)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    ob_start() ?>
    
                    <ul class="list-inline m-0">
                        <li class="list-inline-item">
                            <a href="<?php echo route('motor-bill-collection-form', $row->id); ?>" class="badge bg-warning badge-sm" data-id="<?php echo $row->id; ?>">Bill Collect</a>
                        </li>
                    </ul>
    
                <?php return ob_get_clean();
                })->make(True);
            }
        }
        return view('motor.insurance-bill-collection-list');
    }

    //--------------------------------- marine bill collection form -----------------------------//
    public function motorBillCollectionForm( Request $request , $insuranceId)
    {
        // Gate::authorize('app.MarineCargoInsurance.index');
        $data['single_data'] = MotorInsurance::findOrFail($insuranceId);
        $data['allbank'] = BankAccount::all();
        return view('motor.bill-collection-form',$data);
    }

    //--------------------------------- marine bill collection form -----------------------------//
    public function motorBillCollectionFormStore( Request $request)
    {
        // dd($request->all());
        // Gate::authorize('app.MarineCargoInsurance.index');
        $request->validate([
        'collected_amount' => 'required | numeric',
        'collection_type' => 'required',
        'bank_id' => 'required',
        'date' => 'required',
        'note' => 'nullable | max:255',
        ]);

        $input = $request->all();
        //----------------- client information --------------------//
        $client = MotorInsurance::where('id', $request->insurance_id)->first();
        DB::beginTransaction();
        try{
            if ($request->collection_type == 1) {
                //---------------------- increment and decrement to account info table ---------------//
                AccountInfoMotorInsurance::where('motor_insurance_id', $request->insurance_id)->decrement('due',$request->collected_amount);
                $increment = AccountInfoMotorInsurance::where('motor_insurance_id', $request->insurance_id)->first();
                AccountInfoMotorInsurance::where('motor_insurance_id', $request->insurance_id)->update([
                        'collected_amount' => $increment->collected_amount + $request->collected_amount
                    ]);

                BankAccount::where('id',$request->bank_id)->increment('balance',$request->collected_amount);
                
                //---------------------- insert data into transaction table and bill collection table ---------------//
                BillCollectionMotor::create([
                    'insurance_id' => $request->insurance_id,
                    'amount' => $request->collected_amount,
                    'collection_type' => $request->collection_type,
                    'cheque_number' => null,
                    'bank_name' => null,
                    'bank_id' => $request->bank_id,
                    'date' => $request->date,
                    'note' => $request->note,
                    'branch_id' => Auth::user()->branch_id,
                    'created_by' => Auth::id(),
                ]);
    
                BankClientLedger::create([
                    'client_id' => $client->client->id, 
                    'bank_id' => null, 
                    'creator_id' => $client->created_by,
                    'insurance_id' => $request->insurance_id,
                    'insurance_type' => 'Motor',
                    'reason' => "collection from ". $request->name,
                    'amount' => $request->collected_amount,
                    'date' => $request->date,
                    'branch_id' => Auth::user()->branch_id,
                    'created_by' => Auth::id(),
                ]);

                TransactionReport::create([
                    'bank_id'=> $request->bank_id,
                    'transaction_date'=> $request->date, 
                    'amount'=> $request->collected_amount, 
                    'keyword'=>'Motor', 
                    'reason'=> 'bill collection from '. $request->name, 
                    'note'=> $request->note, 
                    'tok'=> $request->insurance_id, 
                    'status'=> 1, 
                    'branch_id' => Auth::user()->branch_id,
                    'created_by' => Auth::id(),
                ]);
                DB::commit();
                Session::flash('flash_message','Bill Collection Complete !');
                return redirect()->route('motor-bill-collection')->with('status_color','success');
            } else {
                dd('under construction.........');
                DB::commit();
                Session::flash('flash_message','Bill Collection Pending Until Approved Checque !');
                return redirect()->route('motor-bill-collection')->with('status_color','success');
            }
            

        }catch(\Exception $e){
            dd($e->getMessage());
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
            DB::rollback();
        }
    }

        
    //--------------------------------- motor bill collection report -----------------------------//
    public function motorBillCollectionReport( Request $request)
    {
        // Gate::authorize('app.MarineCargoInsurance.index');
        if ($request->ajax()) {
            if (!empty($request->start_date) && !empty($request->end_date)) {
                $alldata= BillCollectionMotor::checkBranch()
                                            ->with('insurance','insurance.client','insurance.bank','bank')
                                            ->whereBetween('date',[date('Y-m-d',strtotime($request->start_date)),date('Y-m-d',strtotime($request->end_date))])
                                            ->orderBy('id','desc')
                                            ->get();
                return DataTables::of($alldata)
                ->addIndexColumn()->make(True);
            } else {
                $alldata= BillCollectionMotor::checkBranch()
                                            ->with('insurance','insurance.client','insurance.bank','bank')
                                            ->orderBy('id','desc')
                                            ->get();
                return DataTables::of($alldata)
                ->addIndexColumn()->make(True);
            }
            
        }
        return view('motor.bill-collection-report');
    }

    // invoice
    public function motorInvoice($id){
        $data['single_data'] = MotorInsurance::findOrFail($id);
        $data['inWordsInsuredAmount'] = NumberToWords::transformNumber('en',$data['single_data']->accountInfoMotorInsurance->insured_amount);
        $data['inWords'] = NumberToWords::transformNumber('en',$data['single_data']->accountInfoMotorInsurance->grand_total);
        return view('motor.motor-invoice',$data);
    }
    public function preview($data)
    {
        // dd($data);
        $preview['client'] = ClientInsured::select('id', 'name','phone','address')->where('id', $data['client_id'])->first();
        $preview['bank'] = Bank::select('id', 'name','branch','address')->where('id', $data['bank_id'])->first();
        $preview['tarrif'] = TarrifCalculation::where('id', $data['tarrif_calculation_id'])->first();
        $preview['reg_no'] = $data['reg_no'];
        $preview['engine_no'] = $data['engine_no'];
        $preview['chassis_no'] = $data['chassis_no'];
        $preview['model_no'] = $data['model_no'];

        $preview['period_from'] = $data['period_from'];
        $preview['period_to'] = $data['period_to'];
        $preview['declaration'] = $data['declaration'];
        $preview['risk_option'] = $data['risk_option'];
        $preview['insured_amount'] = $data['insured_amount'];
        $preview['premium_percent'] = $data['premium_percent'];
        $preview['ncb_percent'] = $data['ncb_percent'] ?? 0;

        $preview['perils_premium'] = $data['perils_premium'];
        $preview['net_premium'] = $data['net_premium'];
        $preview['vat_percent'] = $data['vat_percent'];
        $preview['vat_amount'] = $data['vat_amount'];
        $preview['grand_total'] = $data['grand_total'];
        $preview['payment_percent'] = $data['payment_percent'];
        $preview['payment_percent_amount'] = $data['payment_percent_amount'];
        $preview['payment'] = $data['payment'];
        $preview['branch'] = Branch::select('id', 'name')->where('id', $data['branch_id'])->first();
        $preview['creator'] = User::select('id', 'name')->where('id', $data['created_by'])->first();
        if (!empty($data['addmore'])) {
            $preview['addmore'] = $data['addmore'];
        }
        $grandTotal = (round($data['net_premium'] + (($data['net_premium'] * $data['vat_percent']) / 100)));
        $preview['insuredWord'] = NumberToWords::transformNumber('en',$data['insured_amount']);
        $preview['inWords'] = NumberToWords::transformNumber('en',$grandTotal);
        return $preview;
    }

}
