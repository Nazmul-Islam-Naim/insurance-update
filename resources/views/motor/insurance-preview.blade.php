@extends('layouts.layout')
@section('title', 'Motor Insurance Preview')
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
                <div class="card-title">Motor Insurance Preview</div>
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
                            <td style="text-align:left" colspan="10">Insurance Office: {{$branch->name}}, <br>{{$branch->address}}.</td>
                          </tr>
                          <tr>
                            <td style="text-align:left" colspan="8">Client Name: {{$client->name}}, {{$client->address}} <br>{{$client->phone}}.</td>
                            <td style="text-align:left" colspan="2">Bill No: V-<br>Date: {{date("d-F-Y",strtotime($period_from))}}.</td>
                          </tr>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center; " colspan="2">Risk Covered</td>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center; "colspan="6">Particulars of Insurance</td>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center; "colspan="2">Premium</td>
                          </tr>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:left; " colspan="2">
                              @if (!empty($addmore))
                              @foreach ($addmore as $item)
                              <?php
                                $title = DB::table('additional_perils')->select('title')->where('id',$item['perils_id'])->first();
                              ?>
                              {{$title->title}}<br>
                              @endforeach
                              @else
                              @endif
                            </td>
                            <td colspan="6">
                              <div> &emsp; Being the Motor Insurance Premium for sum insured Of TK. <u>{{$insured_amount}}</u><br> 
                                &emsp; ({{ucfirst($insuredWord)}} Taka Only).Against our Motor Certificate (Comprehensive) detailed <br>  
                                &emsp; premium calculation is as under:</div>
                              <div> &emsp; {{$tarrif->tarrif->name}}</div>
                              <div> &emsp; Reg No - {{$reg_no}}</div>
                              <div> &emsp; Engine No - {{$engine_no}}</div>
                              <div> &emsp; Chassis No - {{$chassis_no}}</div>
                              <div> &emsp; Model - {{$model_no}}</div>
                              <div> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Basic Premium</div>
                              <div> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; + {{$premium_percent}}%, on F.I.V </div>
                              @if (!empty($addmore))
                              @foreach ($addmore as $item)
                              <?php
                                $title = DB::table('additional_perils')->select('title')->where('id',$item['perils_id'])->first();
                              ?>
                              <div> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; {{$title->title}} {{$item['premium_rate']}}% </div>
                              @endforeach
                              @else
                              @endif
                              <div> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Own damage premium </div>
                              <div> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; NCB &emsp;&emsp; {{$ncb_percent}}% </div>
                              <div> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Total After NCB </div><br>
                              <div> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Act Liability Premium </div>
                              <div> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Passenger &emsp;&emsp; {{$tarrif->passenger}} &emsp; X &emsp; {{$tarrif->per_passenger_fee}} </div>
                              <div> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Driver Paid </div><br>
                              <div> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; <b>Net Premium</b> </div>
                              <div> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Add : VAT {{$vat_percent}}% </div>
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
                                <div style="width: 50%; text-align:right"><b>{{number_format($tarrif->basic,2)}}</b></div>
                              </div>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>{{number_format((($insured_amount * $premium_percent)/100),2)}}</b></div>
                              </div>
                              <?php $perilsPremium = 0; ?>
                              @if (!empty($addmore))
                              @foreach ($addmore as $item)
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right">
                                  <b>
                                    <b>{{number_format((round(($item['amount'] * $item['premium_rate'])/100)),2)}}</b>
                                    <?php $perilsPremium += round(($item['amount'] * $item['premium_rate'])/100);?>
                                  </b>
                                </div>
                              </div>
                              @endforeach
                              @endif
                              <div>
                                <b><hr style="margin:0px; opacity:2.25;"></b>
                              </div>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>{{number_format(($tarrif->basic + (($insured_amount * $premium_percent)/100) + $perilsPremium),2)}}</b></div>
                              </div>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>{{number_format((($tarrif->basic + (($insured_amount * $premium_percent)/100) + $perilsPremium) * $ncb_percent)/100,2)}}</b></div>
                              </div>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>
                                  {{number_format(
                                    ($tarrif->basic + (($insured_amount * $premium_percent)/100) + $perilsPremium) - 
                                    ((($tarrif->basic + (($insured_amount * $premium_percent)/100) + $perilsPremium) * $ncb_percent)/100)
                                    ,2)}}</b></div>
                              </div>
                              <div>
                                <b><hr style="margin:0px; opacity:2.25;"></b>
                              </div><br>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>{{number_format($tarrif->act_laibility,2)}}</b></div>
                              </div>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>{{number_format(($tarrif->passenger * $tarrif->per_passenger_fee),2)}}</b></div>
                              </div>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>{{number_format($tarrif->driver_fee,2)}}</b></div>
                              </div>
                              <div>
                                <b><hr style="margin:0px; opacity:2.25; height:2px"></b>
                              </div><br>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>
                                  {{number_format((($tarrif->basic + (($insured_amount * $premium_percent)/100) + $perilsPremium) -
                                  ((($tarrif->basic + (($insured_amount * $premium_percent)/100) + $perilsPremium) * $ncb_percent)/100) +
                                  $tarrif->act_laibility + ($tarrif->passenger * $tarrif->per_passenger_fee)+
                                  $tarrif->driver_fee),2)}}</b></div>
                              </div>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>
                                  <?php 
                                    $net = ($tarrif->basic + (($insured_amount * $premium_percent)/100) + $perilsPremium) - 
                                  ((($tarrif->basic + (($insured_amount * $premium_percent)/100) + $perilsPremium) * $ncb_percent)/100) +
                                  $tarrif->act_laibility + ($tarrif->passenger * $tarrif->per_passenger_fee)+
                                  $tarrif->driver_fee;
                                  $vatAmount = round(($net * $vat_percent)/100);
                                    ?>
                                  {{number_format($vatAmount,2)}}</b>
                                </div>
                              </div>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>
                                  {{number_format(($net + $vatAmount),2)}}</b>
                                </div>
                              </div>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                 @if (($payment_percent == 0) || ($payment_percent == '') || ($payment_percent == null))
                                <div style="width: 50%; text-align:right"><b>{{number_format(($net + $vatAmount),2)}}</b></div>
                                @else
                                <div style="width: 50%; text-align:right"><b>{{number_format(($net + $vatAmount) - round(($net * $payment_percent)/100),2)}}</b></div> 
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
              <div class="card-footer">
                <form action="{{route('motor-insurance.store')}}" method="post">
                  @csrf
                  <input type="hidden" name="client_id" value="{{$client->id}}">
                  <input type="hidden" name="bank_id" value="{{$bank->id}}">
                  <input type="hidden" name="tarrif_calculation_id" value="{{$tarrif->id}}">
                  <input type="hidden" name="reg_no" value="{{$reg_no}}">
                  <input type="hidden" name="engine_no" value="{{$engine_no}}">
                  <input type="hidden" name="chassis_no" value="{{$chassis_no}}">
                  <input type="hidden" name="model_no" value="{{$model_no}}">
                  <input type="hidden" name="period_from" value="{{$period_from}}">
                  <input type="hidden" name="period_to" value="{{$period_to}}">
                  <input type="hidden" name="declaration" value="{{$declaration}}">
                  <input type="hidden" name="risk_option" value="{{$risk_option}}">
                  <input type="hidden" name="insured_amount" value="{{$insured_amount}}">
                  
                  <input type="hidden" name="premium_percent" value="{{$premium_percent}}">
                  <input type="hidden" name="net_premium" value="{{$net_premium}}">
                  <input type="hidden" name="ncb_percent" value="{{$ncb_percent}}">
                  <input type="hidden" name="vat_percent" value="{{$vat_percent}}">
                  <input type="hidden" name="grand_total" value="{{$grand_total}}">
                  <input type="hidden" name="payment_percent" value="{{$payment_percent}}">
                  <input type="hidden" name="payment_percent_amount" value="{{$payment_percent_amount}}">
                  <input type="hidden" name="payment" value="{{$payment}}">
                  <input type="hidden" name="branch_id" value="{{$branch->id}}">
                  <input type="hidden" name="created_by" value="{{$creator->id}}">
                  @if (!empty($addmore))
                      @foreach($addmore as $key => $data)
                      <input type="hidden" name="addmore[{{$key}}][perils_id]" value="{{$data['perils_id']}}">
                      <input type="hidden" name="addmore[{{$key}}][amount]" value="{{$data['amount']}}">
                      <input type="hidden" name="addmore[{{$key}}][premium_rate]" value="{{$data['premium_rate']}}">
                      @endforeach
                  @endif
                  <a href="{{route('motor-insurance.index')}}" class="btn btn-warning">Cancle</a>
                  <input type="submit" name="save" class="btn btn-primary" value="Save">
                </form>
                </div>
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