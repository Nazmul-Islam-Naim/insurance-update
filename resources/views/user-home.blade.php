@extends('layouts.layout')
@section('title', 'User Dashboard')
@section('content')
<!-- Content wrapper scroll start -->
<div class="content-wrapper-scroll">

	<!-- Content wrapper start -->
	<div class="content-wrapper">

		<!-- Row start -->
		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			@include('common.commonFunction')
			</div>
			<!------------------- total marine ---------------------->
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
			    <a href="{{route('marine-cargo-insurance.index')}}" target="_blank">
    				<div class="stats-tile">
    					<div class="sale-icon">
    						<i ><img src="{{asset('upload/logo/marine.gif')}}" alt="" width="60px"></i>
    					</div>
    					<div class="sale-details">
    						<h4>{{$marine}}</h4>
    						<p>Total Marine Insurance</p>
    					</div>
    					<div class="sale-graph">
    						<div id="sparklineLine5"></div>
    					</div>
    				</div>
				</a>
			</div>
			<!------------------- total motor ---------------------->
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
			    <a href="{{route('motor-insurance.index')}}" target="_blank">
    				<div class="stats-tile">
    					<div class="sale-icon">
    						<i ><img src="{{asset('upload/logo/motor.gif')}}" alt="" width="60px"></i>
    					</div>
    					<div class="sale-details">
    						<h4>{{$motor}}</h4>
    						<p>Total Motor Insurance</p>
    					</div>
    					<div class="sale-graph">
    						<div id="sparklineLine5"></div>
    					</div>
    				</div>
				</a>
			</div>
			<!------------------- total fire ---------------------->
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
			    <a href="{{route('fire-insurance.index')}}" target="_blank">
    				<div class="stats-tile">
    					<div class="sale-icon">
    						<i ><img src="{{asset('upload/logo/fire.gif')}}" alt="" width="60px"></i>
    					</div>
    					<div class="sale-details">
    						<h4>{{$fire}}</h4>
    						<p>Total Fire Insurance</p>
    					</div>
    					<div class="sale-graph">
    						<div id="sparklineLine5"></div>
    					</div>
    				</div>
				</a>
			</div>
			<!------------------- total marine bill ---------------------->
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
			    <a href="{{route('marine-cargo-insurance.index')}}" target="_blank">
    				<div class="stats-tile">
    					<div class="sale-icon">
    						<i ><img src="{{asset('upload/logo/marine.gif')}}" alt="" width="60px"></i>
    					</div>
    					<div class="sale-details">
    						<h4>{{$marineBill}}</h4>
    						<p>Marine Insurance Total Bill</p>
    					</div>
    					<div class="sale-graph">
    						<div id="sparklineLine5"></div>
    					</div>
    				</div>
				</a>
			</div>
			<!------------------- total motor bill ---------------------->
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
			    <a href="{{route('motor-insurance.index')}}" target="_blank">
    				<div class="stats-tile">
    					<div class="sale-icon">
    						<i ><img src="{{asset('upload/logo/motor.gif')}}" alt="" width="60px"></i>
    					</div>
    					<div class="sale-details">
    						<h4>{{$motorBill}}</h4>
    						<p>Motor Insurance Total Bill</p>
    					</div>
    					<div class="sale-graph">
    						<div id="sparklineLine5"></div>
    					</div>
    				</div>
				</a>
			</div>
			<!------------------- total fire bill ---------------------->
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
			    <a href="{{route('fire-insurance.index')}}" target="_blank">
    				<div class="stats-tile">
    					<div class="sale-icon">
    						<i ><img src="{{asset('upload/logo/fire.gif')}}" alt="" width="60px"></i>
    					</div>
    					<div class="sale-details">
    						<h4>{{$fireBill}}</h4>
    						<p>Fire Insurance Total Bill</p>
    					</div>
    					<div class="sale-graph">
    						<div id="sparklineLine5"></div>
    					</div>
    				</div>
				</a>
			</div>
			<!------------------- total marine bill collection ---------------------->
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
			    <a href="{{route('marine-bill-collection-report')}}" target="_blank">
    				<div class="stats-tile">
    					<div class="sale-icon">
    						<i ><img src="{{asset('upload/logo/marine.gif')}}" alt="" width="60px"></i>
    					</div>
    					<div class="sale-details">
    						<h4>{{$marineBillCollection}}</h4>
    						<p>Marine Insurance Total Bill Collection</p>
    					</div>
    					<div class="sale-graph">
    						<div id="sparklineLine5"></div>
    					</div>
    				</div>
				</a>
			</div>
			<!------------------- total motor bill collection ---------------------->
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
			    <a href="{{route('motor-bill-collection-report')}}" target="_blank">
    				<div class="stats-tile">
    					<div class="sale-icon">
    						<i ><img src="{{asset('upload/logo/motor.gif')}}" alt="" width="60px"></i>
    					</div>
    					<div class="sale-details">
    						<h4>{{$motorBillCollection}}</h4>
    						<p>Motor Insurance Total Bill Collection</p>
    					</div>
    					<div class="sale-graph">
    						<div id="sparklineLine5"></div>
    					</div>
    				</div>
				</a>
			</div>
			<!------------------- total fire bill collection ---------------------->
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
			    <a href="{{route('fire-bill-collection-report')}}" target="_blank">
    				<div class="stats-tile">
    					<div class="sale-icon">
    						<i ><img src="{{asset('upload/logo/fire.gif')}}" alt="" width="60px"></i>
    					</div>
    					<div class="sale-details">
    						<h4>{{$fireBillCollection}}</h4>
    						<p>Fire Insurance Total Bill Collection</p>
    					</div>
    					<div class="sale-graph">
    						<div id="sparklineLine5"></div>
    					</div>
    				</div>
				</a>
			</div>
		</div>
		<!-- Row end -->
	</div>
	<!-- Content wrapper end -->
</div>
<!-- Content wrapper scroll end -->
@endsection