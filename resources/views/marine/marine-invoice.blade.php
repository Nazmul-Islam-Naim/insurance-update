@extends('layouts.layout')
@section('title', 'Marine Invoice')
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
                <div class="card-title">Marine Invoice</div>
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
                            <td style="text-align:left" colspan="10">Insurance Office: {{$single_data->branch->name}}, <br>
                              {{$single_data->branch->address}}.</td>
                          </tr>
                          <tr>
                            <td style="text-align:left" colspan="10">Bank: {{$single_data->bank->name}},
                              {{$single_data->bank->address}},{{$single_data->bank->branch}} .</td> 
                          </tr>
                          <tr>
                            <td style="text-align:left" colspan="8">Client Name: {{$single_data->client->name}}, 
                              {{$single_data->client->address}} <br>{{$single_data->client->phone}}.</td>
                            <td style="text-align:left" colspan="2">Bill No: {{$single_data->insurance_code}}<br>Date: {{date("d-F-Y",strtotime($single_data->period_from))}}.</td>
                          </tr>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center; ">Risk Covered</td>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center; "colspan="7">Particulars of Insurance</td>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center; "colspan="2">Premium</td>
                          </tr>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:left; ">
                              @if (!empty($single_data->marineAdditionalPerilsDetail))
                              @foreach ($single_data->marineAdditionalPerilsDetail as $item)
                              <?php
                                $title = DB::table('additional_perils')->select('title')->where('id',$item->perils_id)->first();
                              ?>
                              {{$title->title}}<br>
                              @endforeach
                              @else
                              @endif
                              <br><br><br><br><br><br>
                            </td>
                            <td colspan="7">
                              <div>&emsp; Being the Marine Insurance Premium for sum insured Of</div>
                              <div>{{$single_data->currency->name}} &emsp;&emsp; 
                                {{$single_data->accountInfoMarinInsurance->amount_in_dollar}} + {{$single_data->accountInfoMarinInsurance->extra_percent}}% 
                                &emsp;&emsp; @ {{$single_data->accountInfoMarinInsurance->rate}} &emsp;&emsp; = TK. {{$single_data->accountInfoMarinInsurance->amount_in_bdt}}</div>
                              <div>&emsp; as per our Marine covernote no. as under bellow: </div>
                              <div style="display:flex">
                                <div style="width:50%">
                                  Voyage From: {{$single_data->voyageFrom->name}},<br>
                                  To: {{$single_data->voyageTo->name}},
                                  <br><br><br>
                                  Item:- {{$single_data->interestCovered->name}}
                                  <br><br><br>
                                </div>
                                <div style="width:50%">
                                  <b>Marine &emsp; @ &emsp; {{$single_data->accountInfoMarinInsurance->premium_percent}}%</b><br>
                                  @if (!empty($single_data->marineAdditionalPerilsDetail))
                                  @foreach ($single_data->marineAdditionalPerilsDetail as $item)
                                  <?php
                                    $title = DB::table('additional_perils')->select('title')->where('id',$item->perils_id)->first();
                                  ?>
                                  <b>{{$title->title}} &emsp; @ &emsp; {{$item->premium_rate}}%</b><br>
                                  @endforeach
                                  @else
                                  @endif
                                  <b>Net Premium </b><br>
                                  <b>Vat &emsp; @ &emsp; {{$single_data->accountInfoMarinInsurance->vat_percent}}%</b><br>
                                  <b>Stamp Duty: </b><br><br>
                                  <p style="text-align:right;margin:0px"><b>Grand Total</b></p>
                                  <br>
                                  <p style="text-align:right;margin:0px"><b>Payment</b></p>
                                </div>
                              </div>
                            </td>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:left; "colspan="2">
                              <?php 
                                $netPremium = round(($single_data->accountInfoMarinInsurance->amount_in_bdt * $single_data->accountInfoMarinInsurance->premium_percent)/100);
                              ?>
                              <br><br><br>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>{{number_format(round(($single_data->accountInfoMarinInsurance->amount_in_bdt * $single_data->accountInfoMarinInsurance->premium_percent)/100),2)}}</b></div>
                              </div>
                              @if (!empty($single_data->marineAdditionalPerilsDetail))
                              @foreach ($single_data->marineAdditionalPerilsDetail as $item)
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right">
                                  <b>
                                    <b>{{number_format(round(($item->amount * $item->premium_rate)/100),2)}}</b>
                                    <?php $netPremium += round(($item->amount * $item->premium_rate)/100)?>
                                  </b>
                                </div>
                              </div>
                              @endforeach
                              @else
                              @endif
                              <div>
                                <b><hr style="margin:0px; opacity:2.25; height:2px"></b>
                              </div>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>{{number_format($single_data->accountInfoMarinInsurance->net_premium,2)}}</b></div>
                              </div>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>{{number_format(round($single_data->accountInfoMarinInsurance->vat_amount),2)}}</b></div>
                              </div>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>{{number_format(($single_data->accountInfoMarinInsurance->stamp_duty),2)}}</b></div>
                              </div>
                              <div>
                                <b><hr style="margin:0px; opacity:2.25; height:2px"></b>
                              </div>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>{{number_format(($single_data->accountInfoMarinInsurance->net_premium + 
                                round($single_data->accountInfoMarinInsurance->vat_amount) +$single_data->accountInfoMarinInsurance->stamp_duty),2)}}</b></div>
                              </div>
                              <br>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                @if (($single_data->accountInfoMarinInsurance->payment == 0)  ||  ($single_data->accountInfoMarinInsurance->payment = '') || ($single_data->accountInfoMarinInsurance->payment == null))
                                <div style="width: 50%; text-align:right"><b>{{number_format(($single_data->accountInfoMarinInsurance->net_premium + 
                                round($single_data->accountInfoMarinInsurance->vat_amount) + $single_data->accountInfoMarinInsurance->stamp_duty),2)}}</b></div>
                                @else
                                <div style="width: 50%; text-align:right"><b>{{number_format($single_data->accountInfoMarinInsurance->payment + $single_data->accountInfoMarinInsurance->stamp_duty,2)}}</b></div>
                                @endif
                              </div>
                            </td>
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