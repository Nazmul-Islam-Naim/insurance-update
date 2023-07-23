<?php

namespace App\Http\Controllers\Fire;

use App\Models\AccountInfoFireInsurance;
use App\Models\AdditionalPerils;
use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\BankClientLedger;
use App\Models\BillCollectionFire;
use App\Models\Branch;
use App\Models\ClientInsured;
use App\Models\Currency;
use App\Models\FireInsurance;
use App\Models\Product;
use App\Models\TransactionReport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Models\MarineCargoInsurance;
use NumberToWords\NumberToWords;
use DataTables;
use Validator;
use Response;
use Session;
use Auth;
use DB;

class FireInsuranceController extends Controller
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
            $alldata= FireInsurance::checkBranch()
                            ->with('client','bank','accountInfoFireInsurance','fireAdditionalPerilsDetail')
                            ->orderBy('id','desc')
                            ->get();
            return DataTables::of($alldata)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                ob_start() ?>

                <ul class="list-inline m-0">
                    <!--<li class="list-inline-item">-->
                    <!--    <a href="<?php echo route('fire-insurance.edit', $row->id); ?>" class="badge bg-primary badge-sm" data-id="<?php echo $row->id; ?>"><i class="icon-edit-3"></i></a>-->
                    <!--</li>-->
                    <li class="list-inline-item">
                        <button data-id="<?php echo $row->id; ?>" class="badge bg-danger badge-sm button-delete"><i class="icon-delete"></i></button>
                    </li>
                </ul>

            <?php return ob_get_clean();
            })->make(True);
        }
        return view('fire.insurance-list');
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
        $data['allproduct']= Product::orderBy('id','desc')->get();
        $data['allcurrency']= Currency::orderBy('id','desc')->get();
        $data['allperils']= AdditionalPerils::orderBy('id','desc')->get();
        return view('fire.create-edit-form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        // Gate::authorize('app.MarineCargoInsurance.create');
        $request->validate([
            'client_id' => 'required',
            'bank_id' => 'required',
        ]);

        $input = $request->all();
        $input['insurance_code'] = FireInsurance::setInsuranceCode(date('Y',strtotime($request->period_from)));
        $input['branch_id'] = Auth::user()->branch_id;
        $input['created_by'] = Auth::user()->id;
        $input['due'] = $request->grand_total;
        

        DB::beginTransaction();
        try{
            //----------------- save data to database ---------------//
        // dd($request->all());
            if ($request->save != '') {

                $fireInsurace = FireInsurance::create($input);
                $account = $fireInsurace->accountInfoFireInsurance()->create($input);
                $fireInsurace->insurances()->create(['type' => 'Fire']);
                if (!empty($request->addproduct)) {
                    foreach ($request->addproduct as $value) {
                        $products = $fireInsurace->fireInsuranceProductDetail()->create($value);
                    }
                }
                if (!empty($request->addmore)) {
                    foreach ($request->addmore as $value) {
                        $perils = $fireInsurace->fireAdditionalPerilsDetail()->create($value);
                    }
                }
    
                BankClientLedger::create([
                    'client_id' => $request->client_id, 
                    'bank_id' => $request->bank_id,
                    'creator_id' => Auth::id(),
                    'insurance_id' =>  $fireInsurace->id,
                    'insurance_type' => 'Fire',
                    'reason' => "bill for ". $fireInsurace->client->name,
                    'amount' => $request->grand_total,
                    'date' => $request->period_from,
                    'branch_id' =>  $input['branch_id'],
                    'created_by' => $input['created_by'],
                ]);
                DB::commit();
                Session::flash('flash_message','Fire Insurance Successfully Added !');
                return redirect()->route('fire-insurance.index')->with('status_color','success');
            } 
            //----------------- save data to database ---------------//
            else {
                // dd($input);
                $data = $this->preview($input);
                return view('fire.insurance-preview',$data);
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
        return view('marine.create-edit-form', $data);
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
        $data = FireInsurance::findOrFail($id);
        $data->insurances()->delete();
        $action = $data->delete();

        if($action){
            Session::flash('flash_message','Marine Cargo Insurance Successfully Deleted !');
            return redirect()->back()->with('status_color','danger');
        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }

    //--------------------------------- fire bill collection list -----------------------------//
    public function fireBillCollection( Request $request)
    {
        // Gate::authorize('app.MarineCargoInsurance.index');
        if ($request->ajax()) {
            if (!empty($request->start_date) && !empty($request->end_date)) {
                $alldata= FireInsurance::checkBranch()
                                        ->with('client','bank','accountInfoFireInsurance','fireAdditionalPerilsDetail')
                                        ->whereBetween('period_from',[date('Y-m-d',strtotime($request->start_date)),date('Y-m-d',strtotime($request->end_date))])
                                        ->orderBy('id','desc')
                                        ->get();
                return DataTables::of($alldata)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    ob_start() ?>
    
                    <ul class="list-inline m-0">
                        <li class="list-inline-item">
                            <a href="<?php echo route('fire-bill-collection-form', $row->id); ?>" class="badge bg-warning badge-sm" data-id="<?php echo $row->id; ?>">Bill Collect</a>
                        </li>
                    </ul>
    
                <?php return ob_get_clean();
                })->make(True);
            }else {
                $alldata= FireInsurance::checkBranch()
                                        ->with('client','bank','accountInfoFireInsurance','fireAdditionalPerilsDetail')
                                        ->orderBy('id','desc')
                                        ->get();
                return DataTables::of($alldata)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    ob_start() ?>
    
                    <ul class="list-inline m-0">
                        <li class="list-inline-item">
                            <a href="<?php echo route('fire-bill-collection-form', $row->id); ?>" class="badge bg-warning badge-sm" data-id="<?php echo $row->id; ?>">Bill Collect</a>
                        </li>
                    </ul>
    
                <?php return ob_get_clean();
                })->make(True);
            }
        }
        return view('fire.insurance-bill-collection-list');
    }

    //--------------------------------- fire bill collection form -----------------------------//
    public function fireBillCollectionForm( Request $request , $insuranceId)
    {
        // Gate::authorize('app.MarineCargoInsurance.index');
        $data['single_data'] = FireInsurance::findOrFail($insuranceId);
        $data['allbank'] = BankAccount::all();
        return view('fire.bill-collection-form',$data);
    }

    //--------------------------------- fire bill collection form -----------------------------//
    public function fireBillCollectionFormStore( Request $request)
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
        $client = FireInsurance::where('id', $request->insurance_id)->first();
        DB::beginTransaction();
        try{
            if ($request->collection_type == 1) {
                //---------------------- increment and decrement to account info table ---------------//
                AccountInfoFireInsurance::where('fire_insurance_id', $request->insurance_id)->decrement('due',$request->collected_amount);
                $increment = AccountInfoFireInsurance::where('fire_insurance_id', $request->insurance_id)->first();
                AccountInfoFireInsurance::where('fire_insurance_id', $request->insurance_id)->update([
                    'collected_amount' => $increment->collected_amount + $request->collected_amount
                    ]);

                BankAccount::where('id',$request->bank_id)->increment('balance',$request->collected_amount);
                
                //---------------------- insert data into transaction table and bill collection table ---------------//
                BillCollectionFire::create([
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
                    'insurance_type' => 'Fire',
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
                    'keyword'=>'Fire', 
                    'reason'=> 'bill collection from '. $request->name, 
                    'note'=> $request->note, 
                    'tok'=> $request->insurance_id, 
                    'status'=> 1, 
                    'branch_id' => Auth::user()->branch_id,
                    'created_by' => Auth::id(),
                ]);
                DB::commit();
                Session::flash('flash_message','Bill Collection Complete !');
                return redirect()->route('fire-bill-collection')->with('status_color','success');
            } else {
                dd('under construction...');
                Session::flash('flash_message','Bill Collection Pending Until Approved Cheque !');
                return redirect()->route('fire-bill-collection')->with('status_color','success');
            }
            

        }catch(\Exception $e){
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
            DB::rollback();
        }
    }

    
    //--------------------------------- fire bill collection report -----------------------------//
    public function fireBillCollectionReport( Request $request)
    {
        // Gate::authorize('app.MarineCargoInsurance.index');
        if ($request->ajax()) {
            if (!empty($request->start_date) && !empty($request->end_date)) {
                $alldata= BillCollectionFire::checkBranch()
                                            ->with('insurance','insurance.client','insurance.bank','bank')
                                            ->whereBetween('date',[date('Y-m-d',strtotime($request->start_date)),date('Y-m-d',strtotime($request->end_date))])
                                            ->orderBy('id','desc')
                                            ->get();
                return DataTables::of($alldata)
                ->addIndexColumn()->make(True);
            } else {
                $alldata= BillCollectionFire::checkBranch()
                                            ->with('insurance','insurance.client','insurance.bank','bank')
                                            ->orderBy('id','desc')
                                            ->get();
                return DataTables::of($alldata)
                ->addIndexColumn()->make(True);
            }
        }
        return view('fire.bill-collection-report');
    }

    // invoice
    public function fireInvoice($id){
        $data['single_data'] = FireInsurance::findOrFail($id);
        $data['inWords'] = NumberToWords::transformNumber('en',$data['single_data']->accountInfoFireInsurance->grand_total);
        return view('fire.fire-invoice',$data);
    }
    public function preview($data)
    {
        // dd($data);
        $preview['client'] = ClientInsured::select('id', 'name','phone','address')->where('id', $data['client_id'])->first();
        $preview['bank'] = Bank::select('id', 'name','branch','address')->where('id', $data['bank_id'])->first();
        $preview['period_from'] = $data['period_from'];
        $preview['period_to'] = $data['period_to'];
        $preview['used_as'] = $data['used_as'];
        $preview['situation'] = $data['situation'];
        $preview['construction_premises'] = $data['construction_premises'];
        $preview['amount_in_bdt'] = $data['amount_in_bdt'];
        $preview['extra_percent'] = $data['extra_percent'];
        $preview['extra_percent_amount'] = $data['extra_percent_amount'];
        $preview['perils_premium'] = $data['perils_premium'];
        $preview['discount_percent'] = (!empty($data['discount_percent'])) ? $data['discount_percent'] : 0;
        $preview['discount_amount'] = (!empty($data['discount_amount'])) ? $data['discount_amount'] : 0;
        $preview['net_premium'] = $data['net_premium'];
        $preview['vat_percent'] = $data['vat_percent'];
        $preview['vat_amount'] = $data['vat_amount'];
        $preview['grand_total'] = $data['grand_total'];
        $preview['payment_percent'] = $data['payment_percent'];
        $preview['payment'] = $data['payment'];
        $preview['branch'] = Branch::select('id', 'name','phone','email','address')->where('id', $data['branch_id'])->first();
        $preview['creator'] = User::select('id', 'name')->where('id', $data['created_by'])->first();
        if (!empty($data['addproduct'])) {
            $preview['addproduct'] = $data['addproduct'];
        }
        if (!empty($data['addmore'])) {
            $preview['addmore'] = $data['addmore'];
        }
        // if (!empty($data['addmore'])) {
        //     foreach ($data['addmore'] as $key => $value) {
        //         $preview['addmore'][$key] = AdditionalPerils::select('id', 'title')->where('id', $value['perils_id'])->first();
        //         $preview['addmore'][$key] = $value;
        //     }
        // }
        // dd($preview);
        $grandTotal = (round( $preview['grand_total']));
        $preview['inWords'] = NumberToWords::transformNumber('en',$grandTotal);

        return $preview;
    }

}
