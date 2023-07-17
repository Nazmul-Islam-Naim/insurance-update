@extends('layouts.layout')
@section('title', 'Marine Cargo Insurance Preview')
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
                <div class="card-title">Marine Cargo Insurance Preview</div>
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
                            <td style="text-align:left" colspan="10">Bank: {{$bank->name}},
                              {{$bank->address}},{{$bank->branch}} .</td> 
                          </tr>
                          <tr>
                            <td style="text-align:left" colspan="8">Client Name: {{$client->name}}, {{$client->address}} <br>{{$client->phone}}.</td>
                            <td style="text-align:left" colspan="2">Bill No: M-<br>Date: {{date("d-F-Y",strtotime($period_from))}}.</td>
                          </tr>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center; ">Risk Covered</td>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center; "colspan="7">Particulars of Insurance</td>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center; "colspan="2">Premium</td>
                          </tr>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:left; ">
                              @if (!empty($addmore))
                              @foreach ($addmore as $item)
                              <?php
                                $title = DB::table('additional_perils')->select('title')->where('id',$item['perils_id'])->first();
                              ?>
                              {{$title->title}}<br>
                              @endforeach
                              @else
                              @endif
                              <br><br><br><br><br><br>
                            </td>
                            <td colspan="7">
                              <div>&emsp; Being the Marine Insurance Premium for sum insured Of</div>
                              <div>{{$currency->name}} &emsp;&emsp; {{$amount_in_dollar}} + {{$extra_percent}}% &emsp;&emsp; @ {{$rate}} &emsp;&emsp; = TK. {{$amount_in_bdt}}</div>
                              <div>&emsp; as per our Marine covernote no. as under bellow: </div>
                              <div style="display:flex">
                                <div style="width:50%">
                                  Voyage From: {{$from->name}},<br>
                                  To: {{$to->name}},
                                  <br><br><br>
                                  Item:- {{$cover->name}}
                                  <br><br><br>
                                </div>
                                <div style="width:50%">
                                  <b>Marine &emsp; @ &emsp; {{$premium_percent}}%</b><br>
                                  @if (!empty($addmore))
                                  @foreach ($addmore as $item)
                                  <?php
                                    $title = DB::table('additional_perils')->select('title')->where('id',$item['perils_id'])->first();
                                  ?>
                                  <b>{{$title->title}} &emsp; @ &emsp; {{$item['premium_rate']}}%</b><br>
                                  @endforeach
                                  @else
                                  @endif
                                  <b>Net Premium </b><br>
                                  <b>Vat &emsp; @ &emsp; {{$vat_percent}}%</b><br>
                                  <b>Stamp Duty: </b><br><br>
                                  <p style="text-align:right;margin:0px"><b>Grand Total</b></p>
                                  <br>
                                  <p style="text-align:right;margin:0px"><b>Payment</b></p>
                                </div>
                              </div>
                            </td>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:left; "colspan="2">
                              <?php 
                                $netPremium = round(($amount_in_bdt * $premium_percent)/100);
                              ?>
                              <br><br><br>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>{{round(($amount_in_bdt * $premium_percent)/100)}}</b></div>
                              </div>
                              @if (!empty($addmore))
                              @foreach ($addmore as $item)
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right">
                                  <b>
                                    <b>{{round(($item['amount'] * $item['premium_rate'])/100)}}</b>
                                    <?php $netPremium += round(($item['amount'] * $item['premium_rate'])/100)?>
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
                                <div style="width: 50%; text-align:right"><b>{{$netPremium}}</b></div>
                              </div>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>{{round(($netPremium * $vat_percent)/100)}}</b></div>
                              </div>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>{{($stamp_duty)}}</b></div>
                              </div>
                              <div>
                                <b><hr style="margin:0px; opacity:2.25; height:2px"></b>
                              </div>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                <div style="width: 50%; text-align:right"><b>{{($netPremium + round(($netPremium * $vat_percent)/100) + $stamp_duty)}}</b></div>
                              </div>
                              <br>
                              <div style="display: flex;">
                                <div style="width: 50%;"><b>TK.</b></div>
                                @if (($payment == '') ||  ($payment = 0) || ($payment == null))
                                <div style="width: 50%; text-align:right"><b>{{($netPremium + round(($netPremium * $vat_percent)/100) + $stamp_duty)}}</b></div>
                                @else
                                <div style="width: 50%; text-align:right"><b>{{ $payment  +  $stamp_duty}}</b></div>
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
                <form action="{{route('marine-cargo-insurance.store')}}" method="post">
                  @csrf
                  <input type="hidden" name="client_id" value="{{$client->id}}">
                  <input type="hidden" name="bank_id" value="{{$bank->id}}">
                  <input type="hidden" name="interest_covered_id" value="{{$cover->id}}">
                  <input type="hidden" name="voyage_from_id" value="{{$from->id}}">
                  <input type="hidden" name="voyage_to_id" value="{{$to->id}}">
                  <input type="hidden" name="voyage_via_id" value="{{$via->id}}">
                  <input type="hidden" name="transit_by_id" value="{{$transit->id}}">
                  <input type="hidden" name="stamp_amount" value="{{$stamp_amount}}">
                  <input type="hidden" name="slug" value="{{$slug}}">
                  <input type="hidden" name="period_from" value="{{$period_from}}">
                  <input type="hidden" name="period_to" value="{{$period_to}}">
                  <input type="hidden" name="declaration" value="{{$declaration}}">
                  <input type="hidden" name="risk_option" value="{{$risk_option}}">
                  <input type="hidden" name="amount_in_dollar" value="{{$amount_in_dollar}}">
                  <input type="hidden" name="extra_percent" value="{{$extra_percent}}">
                  <input type="hidden" name="extra_percent_amount" value="{{$extra_percent_amount}}">
                  <input type="hidden" name="currency_id" value="{{$currency->id}}">
                  <input type="hidden" name="rate" value="{{$rate}}">
                  <input type="hidden" name="amount_in_bdt" value="{{$amount_in_bdt}}">
                  <input type="hidden" name="perils_premium" value="{{$perils_premium}}">
                  <input type="hidden" name="premium_percent" value="{{$premium_percent}}">
                  <input type="hidden" name="premium" value="{{$premium}}">
                  {{-- <input type="hidden" name="discount_percent" value="{{$discount_percent}}">
                  <input type="hidden" name="discount_amount" value="{{$discount_amount}}"> --}}
                  <input type="hidden" name="net_premium" value="{{$net_premium}}">
                  <input type="hidden" name="vat_percent" value="{{$vat_percent}}">
                  <input type="hidden" name="vat_amount" value="{{$vat_amount}}">
                  <input type="hidden" name="stamp_duty" value="{{$stamp_duty}}">
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
                  <a href="{{route('marine-cargo-insurance.index')}}" class="btn btn-warning">Cancle</a>
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