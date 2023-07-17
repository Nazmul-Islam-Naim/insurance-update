@extends('layouts.layout')
@section('title', 'Motor Invoice')
@section('content')
<!-- Content Header (Page header) -->
<?php
  $baseUrl = URL::to('/');
?>
<!-- Content wrapper scroll start -->
<div class="content-wrapper-scroll">

  <!-- Content wrapper start -->
  <div class="content-wrapper">
    <!-- Row start -->
    <div class="row gutters">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        @include('common.message')
      </div>
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <div class="card-header">
                <div class="card-title">Motor Invoice</div>
                <a onclick="printReport();" href="javascript:0;"><img class="img-thumbnail" style="width:30px;" src='{{asset("custom/img/print.png")}}'></a>
              </div>
              <div class="card-body" >
                <!-- Row start -->
                <div class="row gutters">
                  <div class="col-md-12" id="printTable">
                    <div class="table-responsive" >
                      <table class="table table-bordered" id="example" style="width:100%; font-size:12px" cellspacing="0" cellpadding="0"> 
                        <tbody>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; font-size:18px; text-align:center; white-space:unset; " colspan="10">
                              As per Insurance Developement Regulatory Authority (IDRA) rule,
                              before insurance of policy insurance premium is required to be received.
                            </td>
                          </tr>
                          <tr>
                            <td style="font-size:18px; text-align:center; white-space:unset; " colspan="10">
                              <h2><u>PREMIUM BILL</u></h2>
                            </td>
                          </tr>
                          <tr>
                            <td style="text-align:left" colspan="10">Insurance Office: {{$single_data->branch->name}}, <br>{{$single_data->branch->address}}.</td>
                          </tr>
                          <tr>
                            <td style="text-align:left" colspan="10">Bank: {{$single_data->bank->name}},
                              {{$single_data->bank->address}},{{$single_data->bank->branch}} .</td> 
                          </tr>
                          <tr>
                            <td style="text-align:left" colspan="8">Client Name: {{$single_data->client->name}}, {{$single_data->client->address}} <br>{{$single_data->client->phone}}.</td>
                            <td style="text-align:left" colspan="2">Bill No: {{$single_data->insurance_code}}<br>Date: {{date("d-F-Y",strtotime($single_data->period_from))}}.</td>
                          </tr>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center; " colspan="2">Risk Covered</td>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center; "colspan="6">Particulars of Insurance</td>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center; "colspan="2">Premium</td>
                          </tr>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:left; " colspan="2">
                              @if (!empty($single_data->motorAdditionalPerilsDetail))
                              @foreach ($single_data->motorAdditionalPerilsDetail as $item)
                              <?php
                                $title = DB::table('additional_perils')->select('title')->where('id',$item->perils_id)->first();
                              ?>
                              {{$title->title}}<br>
                              @endforeach
                              @else
                              @endif
                            </td>
                            <td colspan="6">
                              <div> &emsp; Being the Motor Insurance Premium for sum insured Of TK. <u>{{$single_data->accountInfoMotorInsurance->insured_amount}}</u><br> 
                                &emsp; ({{ucfirst($inWordsInsuredAmount)}} Taka Only).Against our Motor Certificate (Comprehensive) detailed <br>  
                                &emsp; premium calculation is as under:</div>
                              <div> &emsp; {{$single_data->tarrifCalculation->tarrif->name}}</div>
                              <div> &emsp; Reg No - {{$single_data->reg_no}}</div>
                              <div> &emsp; Engine No - {{$single_data->engine_no}}</div>
                              <div> &emsp; Chassis No - {{$single_data->chassis_no}}</div>
                              <div> &emsp; Model - {{$single_data->model_no}}</div>
                              <div> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Basic Premium</div>
                              <div> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; + {{$single_data->accountInfoMotorInsurance->premium_percent}}%, on F.I.V </div>
                              @if (!empty($single_data->motorAdditionalPerilsDetail))
                              @foreach ($single_data->motorAdditionalPerilsDetail as $item)
                              <?php
                                $title = DB::table('additional_perils')->select('title')->where('id',$item->perils_id)->first();
                              ?>
                              <div> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; {{$title->title}} {{$item->premium_rate}}% </div>
                              @endforeach
                              @else
                              @endif
                              <div> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Own damage premium </div>
                              <div> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; NCB &emsp;&emsp; {{$single_data->accountInfoMotorInsurance->ncb_percent}}% </div>
                              <div> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Total After NCB </div><br>
                              <div> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Act Liability Premium </div>
                              <div> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Passenger &emsp;&emsp; {{$single_data->passenger}} &emsp; X &emsp; {{$single_data->tarrifCalculation->per_passenger_fee}} </div>
                              <div> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Driver Paid </div><br>
                              <div> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; <b>Net Premium</b> </div>
                              <div> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Add : VAT {{$single_data->accountInfoMotorInsurance->vat_percent}}% </div>
                              <div> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; <b>Total Premium</b> </div>
                              <div> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; <b>Payment</b> </div>
                            </td>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:left; "colspan="2">
                              <div><br></div>
                              <div><br></div>
                              <div><br></div>
                              <div><br></div>
                              <div><br></div>
                              <div><br></div>
                              <div><br></div>
                              <div><br></div>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>{{number_format($single_data->tarrifCalculation->basic,2)}}</b></div>
                              </div>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>{{number_format(round((($single_data->accountInfoMotorInsurance->insured_amount * $single_data->accountInfoMotorInsurance->premium_percent)/100)),2)}}</b></div>
                              </div>
                              @if (!empty($single_data->motorAdditionalPerilsDetail))
                              <?php $perilsPremium = 0; ?>
                              @foreach ($single_data->motorAdditionalPerilsDetail as $item)
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right">
                                  <b>
                                    <b>{{number_format((round(($item->amount * $item->premium_rate)/100)),2)}}</b>
                                    <?php $perilsPremium += round(($item->amount * $item->premium_rate)/100);?>
                                  </b>
                                </div>
                              </div>
                              @endforeach
                              @else
                              @endif
                              <div>
                                <b><hr style="margin:0px; opacity:2.25;"></b>
                              </div>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>{{number_format(round(($single_data->tarrifCalculation->basic + (($single_data->accountInfoMotorInsurance->insured_amount * $single_data->accountInfoMotorInsurance->premium_percent)/100) + $perilsPremium)),2)}}</b></div>
                              </div>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>{{number_format(round((($single_data->tarrifCalculation->basic + (($single_data->accountInfoMotorInsurance->insured_amount * $single_data->accountInfoMotorInsurance->premium_percent)/100) + $perilsPremium) *$single_data->accountInfoMotorInsurance->ncb_percent)/100),2)}}</b></div>
                              </div>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>
                                  {{number_format(round(
                                    ($single_data->tarrifCalculation->basic + (($single_data->accountInfoMotorInsurance->insured_amount * $single_data->accountInfoMotorInsurance->premium_percent)/100) + $perilsPremium) - 
                                    ((($single_data->tarrifCalculation->basic + (($single_data->accountInfoMotorInsurance->insured_amount * $single_data->accountInfoMotorInsurance->premium_percent)/100) + $perilsPremium) *$single_data->accountInfoMotorInsurance->ncb_percent)/100)
                                  ),2)}}</b></div>
                              </div>
                              <div>
                                <b><hr style="margin:0px; opacity:2.25;"></b>
                              </div><br>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>{{number_format($single_data->tarrifCalculation->act_laibility,2)}}</b></div>
                              </div>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>{{number_format(($single_data->tarrifCalculation->passenger * $single_data->tarrifCalculation->per_passenger_fee),2)}}</b></div>
                              </div>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>{{number_format($single_data->tarrifCalculation->driver_fee,2)}}</b></div>
                              </div>
                              <div>
                                <b><hr style="margin:0px; opacity:2.25; height:2px"></b>
                              </div><br>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>
                                  {{number_format($single_data->accountInfoMotorInsurance->net_premium,2)}}</b></div>
                              </div>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>
                                  {{number_format(round(($single_data->accountInfoMotorInsurance->net_premium * $single_data->accountInfoMotorInsurance->vat_percent)/100),2)}}</b>
                                </div>
                              </div>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>
                                  {{number_format(round(($single_data->accountInfoMotorInsurance->net_premium + ($single_data->accountInfoMotorInsurance->net_premium * $single_data->accountInfoMotorInsurance->vat_percent)/100)),2)}}</b>
                                </div>
                              </div>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                @if (($single_data->accountInfoMotorInsurance->payment_percent == 0) || ($single_data->accountInfoMotorInsurance->payment_percent == '') || ($single_data->accountInfoMotorInsurance->payment_percent == null))
                                <div style="width: 50%; text-align:right"><b>{{number_format(round(($single_data->accountInfoMotorInsurance->net_premium + ($single_data->accountInfoMotorInsurance->net_premium * $single_data->accountInfoMotorInsurance->vat_percent)/100)),2)}}</b></div>
                                @else
                                <div style="width: 50%; text-align:right"><b>{{number_format(round((($single_data->accountInfoMotorInsurance->net_premium + ($single_data->accountInfoMotorInsurance->net_premium * $single_data->accountInfoMotorInsurance->vat_percent)/100)) 
                                  - round(($single_data->accountInfoMotorInsurance->net_premium  * $single_data->accountInfoMotorInsurance->payment_percent)/100)),2)}}</b></div>
                                @endif
                              </div>
                            </td>
                            <br><br><br><br>
                          </tr>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:left; " colspan="10">
                              <p>Taka ( In Words ) : {{ucfirst($inWords)}} taka only. </p> 
                            </td>
                          </tr>
                          <tr>
                            <td colspan="10">
                             NB: No Receipt is valid unless it is made on the Company's printed Money receipt and signed by and authorised officer.
                            </td>
                          </tr>
                          <tr>
                            <td colspan="10">
                              <div style="display:flex">
                                <div style="width:50%; text-align:center">
                                  <br><br><br><br>
                                  <p>Checked By</p>
                                </div>
                                <div style="width:50%; text-align:center">
                                  <br><br>
                                  For & on behalf of <br>
                                  Takaful Islami Insurance Limited<br><br><br>
                                  <p>Authorized Officer</p>
                                </div>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <!-- Row end -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer"></div>
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