@extends('layouts.layout')
@section('title', 'Dashboard')
@section('content')
<!-- Content wrapper scroll start -->
<div class="content-wrapper-scroll">

	<!-- Content wrapper start -->
	<div class="content-wrapper">

		<!-- Row start -->
		<div class="row gutters">
      <!-- column one -->
      <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
        <div class="row gutters">
          <!------------------- fire ---------------------->
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <div class="card-body text-center">
                <h6>Work Entry</h6>
                <p>Fire Insurance Summery</p>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
            <a href="{{route('fire-insurance.index')}}" target="_blank">
              <div class="stats-tile">
                <div class="sale-icon">
                  <i ><img src="{{asset('upload/logo/fire.gif')}}" alt="" width="60px"></i>
                </div>
                <div class="sale-details">
                  <h5>{{number_format($fire['fireDailyAmount'],2)}}</h5>
                  <p>Daily ({{$fire['fireDailyCount']}})</p>
                </div>
                <div class="sale-graph">
                  <div id="sparklineLine5"></div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
            <a href="{{route('fire-insurance.index')}}" target="_blank">
              <div class="stats-tile">
                <div class="sale-icon">
                  <i ><img src="{{asset('upload/logo/fire.gif')}}" alt="" width="60px"></i>
                </div>
                <div class="sale-details">
                  <h5>{{number_format($fire['fireMonthlyAmount'],2)}}</h5>
                  <p>Monthly</p>
                </div>
                <div class="sale-graph">
                  <div id="sparklineLine5"></div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
            <a href="{{route('fire-insurance.index')}}" target="_blank">
              <div class="stats-tile">
                <div class="sale-icon">
                  <i ><img src="{{asset('upload/logo/fire.gif')}}" alt="" width="60px"></i>
                </div>
                <div class="sale-details">
                  <h5>{{number_format($fire['fireYearlyAmount'],2)}}</h5>
                  <p>Yearly</p>
                </div>
                <div class="sale-graph">
                  <div id="sparklineLine5"></div>
                </div>
              </div>
            </a>
          </div>
          <!------------------- marine ---------------------->
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <div class="card-body text-center">
                <h6>Work Entry</h6>
                <p>Marine Insurance Summery</p>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
            <a href="{{route('marine-cargo-insurance.index')}}" target="_blank">
              <div class="stats-tile">
                <div class="sale-icon">
                  <i ><img src="{{asset('upload/logo/marine.gif')}}" alt="" width="60px"></i>
                </div>
                <div class="sale-details">
                  <h5>{{number_format($marine['marineDailyAmount'],2)}}</h5>
                  <p>Daily ({{$marine['marineDailyCount']}})</p>
                </div>
                <div class="sale-graph">
                  <div id="sparklineLine5"></div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
            <a href="{{route('marine-cargo-insurance.index')}}" target="_blank">
              <div class="stats-tile">
                <div class="sale-icon">
                  <i ><img src="{{asset('upload/logo/marine.gif')}}" alt="" width="60px"></i>
                </div>
                <div class="sale-details">
                  <h5>{{number_format($marine['marineMonthlyAmount'],2)}}</h5>
                  <p>Monthly</p>
                </div>
                <div class="sale-graph">
                  <div id="sparklineLine5"></div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
            <a href="{{route('marine-cargo-insurance.index')}}" target="_blank">
              <div class="stats-tile">
                <div class="sale-icon">
                  <i ><img src="{{asset('upload/logo/marine.gif')}}" alt="" width="60px"></i>
                </div>
                <div class="sale-details">
                  <h5>{{number_format($marine['marineYearlyAmount'],2)}}</h5>
                  <p>Yearly</p>
                </div>
                <div class="sale-graph">
                  <div id="sparklineLine5"></div>
                </div>
              </div>
            </a>
          </div>
          <!------------------- other receive payment ---------------------->
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <div class="card-body text-center">
                <h6>Work Entry</h6>
                <p>Other Receive & Payment Summery</p>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
            <a href="{{route('receive-voucher-report')}}" target="_blank">
              <div class="stats-tile">
                <div class="sale-icon">
                  <i ><img src="{{asset('upload/logo/money.png')}}" alt="" width="60px"></i>
                </div>
                <div class="sale-details">
                  <h5>{{number_format($cashRCV,2)}}</h5>
                  <p>Cash RCV</p>
                </div>
                <div class="sale-graph">
                  <div id="sparklineLine5"></div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
            <a href="{{route('payment-voucher-report')}}" target="_blank">
              <div class="stats-tile">
                <div class="sale-icon">
                  <i ><img src="{{asset('upload/logo/money.png')}}" alt="" width="60px"></i>
                </div>
                <div class="sale-details">
                  <h5>{{number_format($cashPayment,2)}}</h5>
                  <p>Cash Payment</p>
                </div>
                <div class="sale-graph">
                  <div id="sparklineLine5"></div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
            <a href="#">
              <div class="stats-tile">
                <div class="sale-icon">
                  <i ><img src="{{asset('upload/logo/money.png')}}" alt="" width="60px"></i>
                </div>
                <div class="sale-details">
                  <h5>{{number_format($lastBalance,2)}}</h5>
                  <p>Last Balance</p>
                </div>
                <div class="sale-graph">
                  <div id="sparklineLine5"></div>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
      <!-- column two -->
      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
        <div class="row gutters">
          <!------------------- motor ---------------------->
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
           <div class="card">
             <div class="card-body text-center">
               <h6>Work Entry</h6>
               <p>Motor Insurance Summery</p>
             </div>
           </div>
         </div>
         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
           <a href="{{route('motor-insurance.index')}}" target="_blank">
             <div class="stats-tile">
               <div class="sale-icon">
                 <i ><img src="{{asset('upload/logo/motor.gif')}}" alt="" width="60px"></i>
               </div>
               <div class="sale-details">
                 <h5>{{number_format($motor['motorDailyAmount'],2)}}</h5>
                 <p>Daily ({{$motor['motorDailyCount']}})</p>
               </div>
               <div class="sale-graph">
                 <div id="sparklineLine5"></div>
               </div>
             </div>
           </a>
         </div>
         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
           <a href="{{route('motor-insurance.index')}}" target="_blank">
             <div class="stats-tile">
               <div class="sale-icon">
                 <i ><img src="{{asset('upload/logo/motor.gif')}}" alt="" width="60px"></i>
               </div>
               <div class="sale-details">
                 <h5>{{number_format($motor['motorMonthlyAmount'],2)}}</h5>
                 <p>Monthly</p>
               </div>
               <div class="sale-graph">
                 <div id="sparklineLine5"></div>
               </div>
             </div>
           </a>
         </div>
         <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
           <a href="{{route('motor-insurance.index')}}" target="_blank">
             <div class="stats-tile" style="height: 86px">
               <div class="sale-icon">
                 <i ><img src="{{asset('upload/logo/motor.gif')}}" alt="" width="60px"></i>
               </div>
               <div class="sale-details">
                 <h5>{{number_format($motor['motorYearlyAmount'],2)}}</h5>
                 <p>Yearly</p>
               </div>
               <div class="sale-graph">
                 <div id="sparklineLine5"></div>
               </div>
             </div>
           </a>
         </div>
          <!------------------- total calculaion ---------------------->
         <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
           <a href="#" >
             <div class="stats-tile">
               <div class="sale-icon">
                 <i ><img src="{{asset('upload/logo/bank.png')}}" alt="" width="60px"></i>
               </div>
               <div class="sale-details">
                 <h5>{{number_format($totalWork,2)}}</h5>
                 <p>Total Work</p>
               </div>
               <div class="sale-graph">
                 <div id="sparklineLine5"></div>
               </div>
             </div>
           </a>
         </div>
         <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
           <a href="#">
             <div class="stats-tile" style="height: 86px">
               <div class="sale-icon">
                 <i ><img src="{{asset('upload/logo/bank.png')}}" alt="" width="60px"></i>
               </div>
               <div class="sale-details">
                <h5>{{number_format($paymentRCV,2)}}</h5>
                 <p>Total Payment RCV</p>
               </div>
               <div class="sale-graph">
                 <div id="sparklineLine5"></div>
               </div>
             </div>
           </a>
         </div>
         <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
           <a href="#">
             <div class="stats-tile">
               <div class="sale-icon">
                 <i ><img src="{{asset('upload/logo/bank.png')}}" alt="" width="60px"></i>
               </div>
               <div class="sale-details">
                <h5>{{number_format($dueWork,2)}}</h5>
                 <p>Total Due Work</p>
               </div>
               <div class="sale-graph">
                 <div id="sparklineLine5"></div>
               </div>
             </div>
           </a>
         </div>
        </div>
      </div>
		</div>
		<!-- Row end -->
	</div>
	<!-- Content wrapper end -->
</div>
<!-- Content wrapper scroll end -->
@endsection