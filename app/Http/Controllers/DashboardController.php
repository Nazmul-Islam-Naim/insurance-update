<?php

namespace App\Http\Controllers;
use App\Models\ClientInsured;
use App\Models\Insurance;
use App\Enum\LifeStage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use Session;
use Auth;
use DB;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{	
	public function index() {
		return view('dashboard');
	}

	public function dueWork(Request $request){
		// $insurance = Insurance::find(307);
		// dd($insurance->insuranceable->accountInfo);
		if ($request->ajax()) {
            $alldata= Insurance::with('insuranceable','insuranceable.client','insuranceable.accountInfo')
							->whereHas('insuranceable.accountInfo', function($query){
								// dd($query->toSql());
								$query->where('due', '>', 0)
									->orWhere('due', '>', 0)
									->orWhere('due', '>', 0);
							})
                            ->get();
            return DataTables::of($alldata)
            ->addIndexColumn()->make(True);
        }
        return view('dashboard.dueWork');
	}

	public function crm(){
		$data['all'] = ClientInsured::count();
		$data['customer'] = ClientInsured::where('life_stage',LifeStage::Customer)->count();
		$data['lead'] = ClientInsured::where('life_stage',LifeStage::Lead)->count();
		$data['oppotunity'] = ClientInsured::where('life_stage',LifeStage::Opportunity)->count();
		$data['subscriber'] = ClientInsured::where('life_stage',LifeStage::Subscriber)->count();
		$data['general'] = ClientInsured::where('life_stage',LifeStage::General)->count();
		return view('dashboard.crm',$data);
	}

	public function clients(Request $request, $lifeStage = null){
		// dd($lifeStage);
		if ($request->ajax()) {
			if ($lifeStage != null) {
				$alldata= ClientInsured::checkBranch()->with('branch','user','owner')->where('life_stage', LifeStage::getFromName(ucfirst($request->lifeStage))->toValue())->get();
				return DataTables::of($alldata)
				->addIndexColumn()
				->addColumn('lifeStage', function($row){
					return LifeStage::getFromValue($row->life_stage)->toString();
				})
				->make(True);
			} else {
				$alldata= ClientInsured::checkBranch()->with('branch','user','owner')->get();
				return DataTables::of($alldata)
				->addIndexColumn()
				->addColumn('lifeStage', function($row){
					return LifeStage::getFromValue($row->life_stage)->toString();
				})
				->make(True);
			}
			
        }
        return view('dashboard.clients',compact('lifeStage'));
	}

	public function lifeStage()
    {
        // Gate::authorize('app.users.delete');
		$client = [];
		$customer = ClientInsured::where('life_stage',LifeStage::Customer)->count();
		$lead = ClientInsured::where('life_stage',LifeStage::Lead)->count();
		$oppotunity = ClientInsured::where('life_stage',LifeStage::Opportunity)->count();
		$subscriber = ClientInsured::where('life_stage',LifeStage::Subscriber)->count();
		$general = ClientInsured::where('life_stage',LifeStage::General)->count();
		array_push($client, $customer);
		array_push($client, $lead);
		array_push($client, $oppotunity);
		array_push($client, $subscriber);
		array_push($client, $general);
        $data['lifeStages'] = LifeStage::get();
        $data['clients'] = (object)$client;
        return response()->json($data);
    }
}
