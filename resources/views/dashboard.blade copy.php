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
                  <h4>{{number_format($fireDailyAmount,2)}}</h4>
                  <p>Daily</p>
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
                  <h4>{{number_format($fireMonthlyAmount,2)}}</h4>
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
                  <h4>{{number_format($fireYearlyAmount,2)}}</h4>
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
                  <h4>{{number_format($marineDailyAmount,2)}}</h4>
                  <p>Daily</p>
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
                  <h4>{{number_format($marineMonthlyAmount,2)}}</h4>
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
                  <h4>{{number_format($marineYearlyAmount,2)}}</h4>
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
                  <h4>{{$fireDailyAmount}}</h4>
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
                  <h4>{{$fireDailyAmount}}</h4>
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
                  <h4>{{$fireDailyAmount}}</h4>
                  <p>Last Balance</p>
                </div>
                <div class="sale-graph">
                  <div id="sparklineLine5"></div>
                </div>
              </div>
            </a>
          </div>
        </div>
        <!------------------- dashboard ---------------------->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card card-primary">
                  
                    <div class="card-header d-flex justify-content-between align-items-center">
                          
                      <a onclick="printReport();" href="javascript:0;"><img class="img-thumbnail" style="width:30px;" src='{{asset("custom/img/print.png")}}'></a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div class="col-md-12" id="printTable">
                        <div class="table-responsive">
                          <table class="" style="width: 100%; font-size: 12px;" cellspacing="0" cellpadding="0">  
                            <tbody> 
                              <tr> 
                                <td colspan="4" style="border: 1px solid #ddd; padding: 3px 3px; background-color:#eee; text-align:center">Dashboard</td>
                              </tr>
                              <tr> 
                                <td colspan="4" style="height: 25px"></td>
                              </tr>
                              <tr> 
                                <td style="border: 1px solid #ddd; padding: 3px 3px; background-color:#eee; text-align:center">Item Name</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; background-color:#eee; text-align:center">Daily</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; background-color:#eee; text-align:center">Monthly</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; background-color:#eee; text-align:center">Yearly</td>
                              </tr>
                              <tr> 
                                <td colspan="4" style="height: 25px">Work Entry</td>
                              </tr>
                              <tr> 
                                <td style="border: 1px solid #ddd; padding: 3px 3px;">Fire</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">{{number_format($fireDailyAmount,2)}}</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">{{number_format($fireMonthlyAmount,2)}}</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">{{number_format($fireYearlyAmount,2)}}</td>
                              </tr>
                              <tr> 
                                <td style="border: 1px solid #ddd; padding: 3px 3px;">Marine</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">{{number_format($marineDailyAmount,2)}}</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">{{number_format($marineMonthlyAmount,2)}}</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">{{number_format($marineYearlyAmount,2)}}</td>
                              </tr>
                              <tr> 
                                <td style="border: 1px solid #ddd; padding: 3px 3px;">Motor</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">{{number_format($motorDailyAmount,2)}}</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">{{number_format($motorMonthlyAmount,2)}}</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">{{number_format($motorYearlyAmount,2)}}</td>
                              </tr>
                              <tr> 
                                <td style="border: 1px solid #ddd; padding: 3px 3px;">Others</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">0</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">0</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">0</td>
                              </tr>
                              <tr> 
                                <td style="border: 1px solid #ddd; padding: 3px 3px;">Total Work</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">{{number_format($totalDaily,2)}}</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">{{number_format($totalMonthly,2)}}</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">{{number_format($totalYearly,2)}}</td>
                              </tr>
                              <tr> 
                                <td style="border: 1px solid #ddd; padding: 3px 3px;">Total Payment RCV</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">{{number_format($totalDailyCollection,2)}}</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">{{number_format($totalMonthlyCollection,2)}}</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">{{number_format($totalYearlyCollection,2)}}</td>
                              </tr>
                              <tr> 
                                <td style="border: 1px solid #ddd; padding: 3px 3px;">Total Due Work</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">{{number_format($totalDailyDue,2)}}</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">{{number_format($totalMonthlyDue,2)}}</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">{{number_format($totalYearlyDue,2)}}</td>
                              </tr>
                              <tr> 
                                <td style="border: 1px solid #ddd; padding: 3px 3px;height:25px"></td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center"></td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center"></td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center"></td>
                              </tr>
                              <tr> 
                                <td style="border: 1px solid #ddd; padding: 3px 3px;">Cash RCV</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">{{number_format($dailyReceive,2)}}</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">{{number_format($monthlyReceive,2)}}</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">{{number_format($yearlyReceive,2)}}</td>
                              </tr>
                              <tr> 
                                <td style="border: 1px solid #ddd; padding: 3px 3px;">Cash Payment</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">{{number_format($dailyPayment,2)}}</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">{{number_format($monthlyPayment,2)}}</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">{{number_format($yearlyPayment,2)}}</td>
                              </tr>
                              <tr> 
                                <td style="border: 1px solid #ddd; padding: 3px 3px;">Last Balance</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">{{number_format($totalDailyBalance,2)}}</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">{{number_format($totalMonthlyBalance,2)}}</td>
                                <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">{{number_format($totalYearlyBalance,2)}}</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
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
                 <h4>{{number_format($motorDailyAmount,2)}}</h4>
                 <p>Daily</p>
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
                 <h4>{{number_format($motorMonthlyAmount,2)}}</h4>
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
             <div class="stats-tile">
               <div class="sale-icon">
                 <i ><img src="{{asset('upload/logo/motor.gif')}}" alt="" width="60px"></i>
               </div>
               <div class="sale-details">
                 <h4>{{number_format($motorYearlyAmount,2)}}</h4>
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
           <a href="{{route('motor-insurance.index')}}" target="_blank">
             <div class="stats-tile">
               <div class="sale-icon">
                 <i ><img src="{{asset('upload/logo/bank.png')}}" alt="" width="60px"></i>
               </div>
               <div class="sale-details">
                 <h4>{{$fireDailyAmount}}</h4>
                 <p>Total Work</p>
               </div>
               <div class="sale-graph">
                 <div id="sparklineLine5"></div>
               </div>
             </div>
           </a>
         </div>
         <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
           <a href="{{route('motor-insurance.index')}}" target="_blank">
             <div class="stats-tile">
               <div class="sale-icon">
                 <i ><img src="{{asset('upload/logo/bank.png')}}" alt="" width="60px"></i>
               </div>
               <div class="sale-details">
                 <h4>9998567</h4>
                 <p>Total Payment RCV</p>
               </div>
               <div class="sale-graph">
                 <div id="sparklineLine5"></div>
               </div>
             </div>
           </a>
         </div>
         <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
           <a href="{{route('motor-insurance.index')}}" target="_blank">
             <div class="stats-tile">
               <div class="sale-icon">
                 <i ><img src="{{asset('upload/logo/bank.png')}}" alt="" width="60px"></i>
               </div>
               <div class="sale-details">
                 <h4>999999998567</h4>
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