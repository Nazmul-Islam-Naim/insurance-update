<?php

namespace App\Http\Controllers;

use App\Enum\Status;
use Illuminate\Http\Request;
use App\Models\MarineCargoInsurance;
use App\Models\MotorInsurance;
use App\Models\FireInsurance;
use App\Models\AccountInformationMarinInsurance;
use App\Models\AccountInfoMotorInsurance;
use App\Models\AccountInfoFireInsurance;
use App\Models\BillCollectionMarinInsurance;
use App\Models\BillCollectionMotor;
use App\Models\BillCollectionFire;
use App\Models\OtherReceiveVoucher;
use App\Models\OtherPaymentVoucher;
use App\Models\User;
use Carbon\Carbon;
use Session;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['marine'] = MarineCargoInsurance::where('branch_id',Auth::user()->branch_id)->count();
        $data['motor'] = MotorInsurance::where('branch_id',Auth::user()->branch_id)->count();
        $data['fire'] = FireInsurance::where('branch_id',Auth::user()->branch_id)->count();
        $data['marineBill'] = AccountInformationMarinInsurance::where('branch_id',Auth::user()->branch_id)->sum('grand_total');
        $data['motorBill'] = AccountInfoMotorInsurance::where('branch_id',Auth::user()->branch_id)->sum('grand_total');
        $data['fireBill'] = AccountInfoFireInsurance::where('branch_id',Auth::user()->branch_id)->sum('grand_total');
        $data['marineBillCollection'] = BillCollectionMarinInsurance::where('branch_id',Auth::user()->branch_id)->sum('amount');
        $data['motorBillCollection'] = BillCollectionMotor::where('branch_id',Auth::user()->branch_id)->sum('amount');
        $data['fireBillCollection'] = BillCollectionFire::where('branch_id',Auth::user()->branch_id)->sum('amount');
        return view('user-home',$data);
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index2()
    {
        // dialy, monthly, yearly and total daily work calculation
        $data['fireDailyAmount'] = AccountInfoFireInsurance::where('branch_id',Auth::user()->branch_id)->whereDate('created_at',Carbon::now())->sum('grand_total');
        $data['fireMonthlyAmount'] = AccountInfoFireInsurance::where('branch_id',Auth::user()->branch_id)->whereMonth('created_at',Carbon::now()->month)->sum('grand_total');
        $data['fireYearlyAmount'] = AccountInfoFireInsurance::where('branch_id',Auth::user()->branch_id)->whereYear('created_at',Carbon::now()->year)->sum('grand_total');
        
        $data['marineDailyAmount'] = AccountInformationMarinInsurance::where('branch_id',Auth::user()->branch_id)->whereDate('created_at',Carbon::now())->sum('grand_total');
        $data['marineMonthlyAmount'] = AccountInformationMarinInsurance::where('branch_id',Auth::user()->branch_id)->whereMonth('created_at',Carbon::now()->month)->sum('grand_total');
        $data['marineYearlyAmount'] = AccountInformationMarinInsurance::where('branch_id',Auth::user()->branch_id)->whereYear('created_at',Carbon::now()->year)->sum('grand_total');
        
        $data['motorDailyAmount'] = AccountInfoMotorInsurance::where('branch_id',Auth::user()->branch_id)->whereDate('created_at',Carbon::now())->sum('grand_total');
        $data['motorMonthlyAmount'] = AccountInfoMotorInsurance::where('branch_id',Auth::user()->branch_id)->whereMonth('created_at',Carbon::now()->month)->sum('grand_total');
        $data['motorYearlyAmount'] = AccountInfoMotorInsurance::where('branch_id',Auth::user()->branch_id)->whereYear('created_at',Carbon::now()->year)->sum('grand_total');
        
        $data['totalDaily'] = $data['fireDailyAmount'] + $data['marineDailyAmount'] + $data['motorDailyAmount'];
        $data['totalMonthly'] = $data['fireMonthlyAmount'] + $data['marineMonthlyAmount'] + $data['motorMonthlyAmount'];
        $data['totalYearly'] = $data['fireYearlyAmount'] + $data['marineYearlyAmount'] + $data['motorYearlyAmount'];
        
        // dialy, monthly, yearly and total collection calculation (RCV)
        $data['fireDailyCollection'] = BillCollectionFire::where('branch_id',Auth::user()->branch_id)->whereDate('date',Carbon::now())->sum('amount');
        $data['fireMonthlyCollection'] = BillCollectionFire::where('branch_id',Auth::user()->branch_id)->whereMonth('date',Carbon::now()->month)->sum('amount');
        $data['fireYearlyCollection'] = BillCollectionFire::where('branch_id',Auth::user()->branch_id)->whereYear('date',Carbon::now()->year)->sum('amount');
        
        $data['marineDailyCollection'] = BillCollectionMarinInsurance::where('branch_id',Auth::user()->branch_id)->whereDate('date',Carbon::now())->sum('amount');
        $data['marineMonthlyCollection'] = BillCollectionMarinInsurance::where('branch_id',Auth::user()->branch_id)->whereMonth('date',Carbon::now()->month)->sum('amount');
        $data['marineYearlyCollection'] = BillCollectionMarinInsurance::where('branch_id',Auth::user()->branch_id)->whereYear('date',Carbon::now()->year)->sum('amount');
        
        $data['motorDailyCollection'] = BillCollectionMotor::where('branch_id',Auth::user()->branch_id)->whereDate('date',Carbon::now())->sum('amount');
        $data['motorMonthlyCollection'] = BillCollectionMotor::where('branch_id',Auth::user()->branch_id)->whereMonth('date',Carbon::now()->month)->sum('amount');
        $data['motorYearlyCollection'] = BillCollectionMotor::where('branch_id',Auth::user()->branch_id)->whereYear('date',Carbon::now()->year)->sum('amount');
        
        $data['totalDailyCollection'] = $data['fireDailyCollection'] + $data['marineDailyCollection'] + $data['motorDailyCollection'];
        $data['totalMonthlyCollection'] = $data['fireMonthlyCollection'] + $data['marineMonthlyCollection'] + $data['motorMonthlyCollection'];
        $data['totalYearlyCollection'] = $data['fireYearlyCollection'] + $data['marineYearlyCollection'] + $data['motorYearlyCollection'];
        
        // dialy, monthly, yearly and total due calculation
        $data['totalDailyDue'] = $data['totalDaily'] - $data['totalDailyCollection'];
        $data['totalMonthlyDue'] = $data['totalMonthly'] - $data['totalMonthlyCollection'];
        $data['totalYearlyDue'] = $data['totalYearly'] - $data['totalYearlyCollection'];
        
        // others receive calculation (RCV)
        $data['dailyReceive'] = OtherReceiveVoucher::where('branch_id',Auth::user()->branch_id)->whereDate('receive_date',Carbon::now())->sum('amount');
        $data['monthlyReceive'] = OtherReceiveVoucher::where('branch_id',Auth::user()->branch_id)->whereMonth('receive_date',Carbon::now()->month)->sum('amount');
        $data['yearlyReceive'] = OtherReceiveVoucher::where('branch_id',Auth::user()->branch_id)->whereYear('receive_date',Carbon::now()->year)->sum('amount');
        
        // others payment calculation
        $data['dailyPayment'] = OtherPaymentVoucher::where('branch_id',Auth::user()->branch_id)->whereDate('payment_date',Carbon::now())->sum('amount');
        $data['monthlyPayment'] = OtherPaymentVoucher::where('branch_id',Auth::user()->branch_id)->whereMonth('payment_date',Carbon::now()->month)->sum('amount');
        $data['yearlyPayment'] = OtherPaymentVoucher::where('branch_id',Auth::user()->branch_id)->whereYear('payment_date',Carbon::now()->year)->sum('amount');
         
        // dialy, monthly, yearly and last balance calculation
        $data['totalDailyBalance'] = ($data['dailyReceive'] + $data['totalDailyCollection']) - $data['dailyPayment'];
        $data['totalMonthlyBalance'] = ($data['monthlyReceive'] + $data['totalMonthlyCollection']) - $data['monthlyPayment'];
        $data['totalYearlyBalance'] = ($data['yearlyReceive'] + $data['totalYearlyCollection']) - $data['yearlyPayment'];
        
        return view('dashboard',$data);
    }

    public function selectBranch()
    {
        return view('branchPanelPopup');
    }

    public function adminSelectedDashboard($branch_id)
    {
        if(Auth::user()->user_type == 1)
        {
            session(['branch_id' => $branch_id]);
            return redirect('user-home');
        }
    }
}
