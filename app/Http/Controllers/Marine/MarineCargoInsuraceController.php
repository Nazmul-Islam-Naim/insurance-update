<?php

namespace App\Http\Controllers\Marine;

use App\Models\AccountInformationMarinInsurance;
use App\Models\AdditionalPerils;
use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\BankClientLedger;
use App\Models\BillCollectionMarinInsurance;
use App\Models\Branch;
use App\Models\ClientInsured;
use App\Models\Currency;
use App\Models\Product;
use App\Models\TransactionReport;
use App\Models\TransitBy;
use App\Models\User;
use App\Models\VoyageFrom;
use App\Models\VoyageTo;
use App\Models\VoyageVia;
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

class MarineCargoInsuraceController extends Controller
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
            $alldata= MarineCargoInsurance::checkBranch()
                            ->with('client','bank','interestCovered','voyageFrom','voyageTo','voyageVia','transitBy','accountInfoMarinInsurance','currency')
                            ->orderBy('id','desc')
                            ->get();
            return DataTables::of($alldata)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                ob_start() ?>

                <ul class="list-inline m-0">
                    <!--<li class="list-inline-item">-->
                    <!--    <a href="<?php echo route('marine-cargo-insurance.edit', $row->id); ?>" class="badge bg-primary badge-sm" data-id="<?php echo $row->id; ?>"><i class="icon-edit-3"></i></a>-->
                    <!--</li>-->
                    <li class="list-inline-item">
                        <button data-id="<?php echo $row->id; ?>" class="badge bg-danger badge-sm button-delete"><i class="icon-delete"></i></button>
                    </li>
                </ul>

            <?php return ob_get_clean();
            })->make(True);
        }
        return view('marine.insurance-list');
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
        $data['allfrom']= VoyageFrom::orderBy('id','desc')->get();
        $data['allto']= VoyageTo::orderBy('id','desc')->get();
        $data['allvia']= VoyageVia::orderBy('id','desc')->get();
        $data['alltransit']= TransitBy::orderBy('id','desc')->get();
        $data['allcurrency']= Currency::orderBy('id','desc')->get();
        $data['allperils']= AdditionalPerils::orderBy('id','desc')->get();
        return view('marine.create-edit-form', $data);
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
        // insurance code using year
        $input = $request->all();
        $input['insurance_code'] = MarineCargoInsurance::setInsuranceCode(date('Y',strtotime($request->period_from)));
        $input['branch_id'] = Auth::user()->branch_id;
        $input['created_by'] = Auth::user()->id;
        
        

        DB::beginTransaction();
        try{
            //----------------- save data to database ---------------//
        // dd($request->all());
            if ($request->save != '') {
                
                if ( $request->slug == 'truck') {
                    $result = 50;
                } else {
                    $amount = $input['amount_in_bdt'];
                    $checker = $input['stamp_amount'];
        
                    $result = ceil($amount/$checker);
                    $result = $result * 10 + 10;
                }
                
                $input['stamp_duty'] = $result;
                $input['due'] = $request->grand_total + $result;
                $input['grand_total'] = $request->grand_total + $result;

                $marinInsurance = MarineCargoInsurance::create($input);
                $account = $marinInsurance->accountInfoMarinInsurance()->create($input);
                $marinInsurance->insurances()->create(['type' => 'Marine']);
                if (!empty($request->addmore)) {
                    foreach ($request->addmore as $value) {
                        $perils = $marinInsurance->marineAdditionalPerilsDetail()->create($value);
                    }
                }
    
                BankClientLedger::create([
                    'client_id' => $request->client_id, 
                    'bank_id' => '',
                    'creator_id' => Auth::id(),
                    'insurance_id' =>  $marinInsurance->id,
                    'insurance_type' => 'Marine',
                    'reason' => "bill for ". $marinInsurance->client->name,
                    'amount' => $request->grand_total,
                    'date' => $request->period_from,
                    'branch_id' =>  $input['branch_id'],
                    'created_by' => $input['created_by'],
                ]);
                DB::commit();
                Session::flash('flash_message','Marine Cargo Insurance Successfully Added !');
                return redirect()->route('marine-cargo-insurance.index')->with('status_color','success');
            } 
            //----------------- save data to database ---------------//
            else {
                $data = $this->preview($input);
                return view('marine.insurance-preview',$data);
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
        $data = MarineCargoInsurance::findOrFail($id);
        AccountInformationMarinInsurance::where('marine_cargo_insurance_id',$id)->delete();
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

    //--------------------------------- marine bill collection list -----------------------------//
    public function marineBillCollection( Request $request)
    {
        // Gate::authorize('app.MarineCargoInsurance.index');
        if ($request->ajax()) {
            if (!empty($request->start_date) && !empty($request->end_date)) {
                $alldata= MarineCargoInsurance::checkBranch()
                                            ->with('client','bank','interestCovered','voyageFrom','voyageTo','voyageVia','transitBy','accountInfoMarinInsurance','currency')
                                            ->whereBetween('period_from',[date('Y-m-d',strtotime($request->start_date)),date('Y-m-d',strtotime($request->end_date))])
                                            ->orderBy('id','desc')
                                            ->get();
                return DataTables::of($alldata)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    ob_start() ?>
    
                    <ul class="list-inline m-0">
                        <li class="list-inline-item">
                            <a href="<?php echo route('marine-bill-collection-form', $row->id); ?>" class="badge bg-warning badge-sm" data-id="<?php echo $row->id; ?>">Bill Collect</a>
                        </li>
                    </ul>
    
                <?php return ob_get_clean();
                })->make(True);
            } else {
                $alldata= MarineCargoInsurance::checkBranch()
                                            ->with('client','bank','interestCovered','voyageFrom','voyageTo','voyageVia','transitBy','accountInfoMarinInsurance','currency')
                                            ->orderBy('id','desc')
                                            ->get();
                return DataTables::of($alldata)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    ob_start() ?>
    
                    <ul class="list-inline m-0">
                        <li class="list-inline-item">
                            <a href="<?php echo route('marine-bill-collection-form', $row->id); ?>" class="badge bg-warning badge-sm" data-id="<?php echo $row->id; ?>">Bill Collect</a>
                        </li>
                    </ul>
    
                <?php return ob_get_clean();
                })->make(True);
            }
        }
        return view('marine.insurance-bill-collection-list');
    }

    //--------------------------------- marine bill collection form -----------------------------//
    public function marineBillCollectionForm( Request $request , $insuranceId)
    {
        // Gate::authorize('app.MarineCargoInsurance.index');
        $data['single_data'] = MarineCargoInsurance::findOrFail($insuranceId);
        $data['allbank'] = BankAccount::all();
        return view('marine.bill-collection-form',$data);
    }

    //--------------------------------- marine bill collection store -----------------------------//
    public function marineBillCollectionFormStore( Request $request)
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
        $client = MarineCargoInsurance::where('id', $request->insurance_id)->first();
        DB::beginTransaction();
        try{
            if ($request->collection_type == 1) {
                //---------------------- increment and decrement to account info table ---------------//
                AccountInformationMarinInsurance::where('marine_cargo_insurance_id', $request->insurance_id)->decrement('due',$request->collected_amount);
                $increment = AccountInformationMarinInsurance::where('marine_cargo_insurance_id', $request->insurance_id)->first();
                AccountInformationMarinInsurance::where('marine_cargo_insurance_id', $request->insurance_id)->update([
                    'collected_amount' => $increment->collected_amount + $request->collected_amount
                    ]);

                BankAccount::where('id',$request->bank_id)->increment('balance',$request->collected_amount);
                
                //---------------------- insert data into transaction table and bill collection table ---------------//
                BillCollectionMarinInsurance::create([
                    'insurance_id' => $request->insurance_id,
                    'amount' => $request->collected_amount,
                    'collection_type' => $request->collection_type,
                    'cheque_number' => $request->cheque_number,
                    'bank_name' => $request->bank_name,
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
                    'insurance_type' => 'Marine',
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
                    'keyword'=>'Marine', 
                    'reason'=> 'bill collection from '. $request->name, 
                    'note'=> $request->note, 
                    'tok'=> $request->insurance_id, 
                    'status'=> 1, 
                    'branch_id' => Auth::user()->branch_id,
                    'created_by' => Auth::id(),
                ]);
                DB::commit();
                Session::flash('flash_message','Bill Collection Complete !');
                return redirect()->route('marine-bill-collection')->with('status_color','success');
            } else {
                dd('ok');
                DB::commit();
                Session::flash('flash_message','Bill Collection Pending Until Approved Checque !');
                return redirect()->route('marine-bill-collection')->with('status_color','success');
            }
            

        }catch(\Exception $e){
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
            DB::rollback();
        }
    }

    //--------------------------------- marine bill collection report -----------------------------//
    public function marineBillCollectionReport( Request $request)
    {
        // Gate::authorize('app.MarineCargoInsurance.index');
        if ($request->ajax()) {
            if (!empty($request->start_date) && !empty($request->end_date)) {
                $alldata= BillCollectionMarinInsurance::checkBranch()
                                            ->with('insurance','insurance.client','insurance.bank','insurance.accountInfoMarinInsurance','bank')
                                            ->whereBetween('date',[date('Y-m-d',strtotime($request->start_date)),date('Y-m-d',strtotime($request->end_date))])
                                            ->orderBy('id','desc')
                                            ->get();
                return DataTables::of($alldata)
                ->addIndexColumn()->make(True);
            } else {
                $alldata= BillCollectionMarinInsurance::checkBranch()
                                            ->with('insurance','insurance.client','insurance.bank','insurance.accountInfoMarinInsurance','bank')
                                            ->orderBy('id','desc')
                                            ->get();
                return DataTables::of($alldata)
                ->addIndexColumn()->make(True);
            }
        }
        return view('marine.bill-collection-report');
    }

    // invoice
    public function marineInvoice($id){
        $data['single_data'] = MarineCargoInsurance::findOrFail($id);
        $data['inWords'] = NumberToWords::transformNumber('en',$data['single_data']->accountInfoMarinInsurance->grand_total);
        return view('marine.marine-invoice',$data);
    }

    public function preview($data)
    {
        // dd($data);
        $baseFee = 20;
        $fee = 0;

        $preview['client'] = ClientInsured::select('id', 'name','phone','address')->where('id', $data['client_id'])->first();
        $preview['bank'] = Bank::select('id', 'name','branch','address')->where('id', $data['bank_id'])->first();
        $preview['cover'] = Product::select('id', 'name')->where('id', $data['interest_covered_id'])->first();
        $preview['from'] = VoyageFrom::select('id', 'name')->where('id', $data['voyage_from_id'])->first();
        $preview['to'] = VoyageTo::select('id', 'name')->where('id', $data['voyage_to_id'])->first();
        $preview['via'] = VoyageVia::select('id', 'name')->where('id', $data['voyage_via_id'])->first();
        $preview['transit'] = TransitBy::select('id', 'name')->where('id', $data['transit_by_id'])->first();
        $preview['stamp_amount'] = $data['stamp_amount'];
        $preview['slug'] = $data['slug'];

        if ( $preview['slug'] == 'truck') {
            $result = 50;
        } else {
            $amount = $data['amount_in_bdt'];
            $checker = $data['stamp_amount'];

            $result = ceil($amount/$checker);
            $result = $result * 10 + 10;
        }
        

        $preview['period_from'] = $data['period_from'];
        $preview['period_to'] = $data['period_to'];
        $preview['declaration'] = $data['declaration'];
        $preview['risk_option'] = $data['risk_option'];
        $preview['amount_in_dollar'] = $data['amount_in_dollar'];
        $preview['extra_percent'] = $data['extra_percent'];
        $preview['extra_percent_amount'] = $data['extra_percent_amount'];
        $preview['currency'] = Currency::select('id', 'name')->where('id', $data['currency_id'])->first();
        $preview['rate'] = $data['rate'];
        $preview['amount_in_bdt'] = $data['amount_in_bdt'];
        $preview['perils_premium'] = $data['perils_premium'];
        $preview['premium_percent'] = $data['premium_percent'];
        $preview['premium'] = $data['premium'];
        // $preview['discount_percent'] = $data['discount_percent'];
        // $preview['discount_amount'] = $data['discount_amount'];
        $preview['net_premium'] = $data['net_premium'];
        $preview['vat_percent'] = $data['vat_percent'];
        $preview['vat_amount'] = $data['vat_amount'];
        $preview['stamp_duty'] = $result;
        $preview['grand_total'] = $data['grand_total'];
        $preview['payment_percent'] = $data['payment_percent'];
        $preview['payment_percent_amount'] = $data['payment_percent_amount'];
        $preview['payment'] = $data['payment'];
        $preview['branch'] = Branch::select('id', 'name', 'address')->where('id', $data['branch_id'])->first();
        $preview['creator'] = User::select('id', 'name')->where('id', $data['created_by'])->first();
        if (!empty($data['addmore'])) {
            $preview['addmore'] = $data['addmore'];
        }
        $grandTotal = (round($data['net_premium'] + (($data['net_premium'] * $data['vat_percent']) / 100) + $data['stamp_duty']));
        $preview['inWords'] = NumberToWords::transformNumber('en',$grandTotal);
        return $preview;
    }

}
