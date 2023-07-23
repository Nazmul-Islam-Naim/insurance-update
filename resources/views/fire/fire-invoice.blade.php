@extends('layouts.layout')
@section('title', 'Fire Invoice')
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
                <div class="card-title">Fire Invoice</div>
                <a onclick="printReport();" href="javascript:0;"><img class="img-thumbnail" style="width:30px;" src='{{asset("custom/img/print.png")}}'></a>
              </div>
              <div class="card-body" >
                <!-- Row start -->
                <div class="row gutters">
                  <div class="col-md-12" id="printTable">
                    <div class="table-responsive" >
                      <table class="table table-bordered" id="example" style="width:100%; font-size:12px" cellspacing="0" cellpadding="0"> 
                        <tbody>
                          <?php 
                            $totalProduct = 0;
                            $totalPerils = 0;
                          ?>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; font-size:18px; text-align:center; white-space:unset; " colspan="10">
                              <img src="{{asset('upload/logo/header.png')}}" height="60px" alt="" srcset="">
                            </td>
                          </tr>
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
                            <td style="text-align:left" colspan="10">
                              Insurance Office: {{$single_data->branch->name}}, <br>
                              {{$single_data->branch->address}},<br>
                              Phone: {{$single_data->branch->phone}},<br>
                              E-Mail: {{$single_data->branch->email}}.
                            </td>
                          </tr>
                          <tr>
                            <td style="text-align:left" colspan="5">Fire Bill No: {{$single_data->insurance_code}}</td>
                            <td style="text-align:right" colspan="5">Date: {{date("d-M-Y",strtotime($single_data->period_from))}}</td>
                          </tr>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:left;">The Insured Name & Address</td>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:left;" colspan="9">{{$single_data->bank->name}},
                              {{$single_data->bank->address}},{{$single_data->bank->branch}} &nbsp; as &nbsp; <br>{{$single_data->client->name}}, 
                              {{$single_data->client->address}}, {{$single_data->client->phone}}</td>
                          </tr>
                          <tr>
                            <td colspan="10"><br></td>
                          </tr>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center;" colspan="7">Segregation of The Sum Insured</td>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center;"></td>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center;" colspan="2">Sum Insured</td>
                          </tr>
                          @if (!empty($single_data->fireInsuranceProductDetail))
                          <?php $totalProduct = 0; ?>
                          @foreach ($single_data->fireInsuranceProductDetail as $item)
                          <?php
                            $title = DB::table('products')->select('name')->where('id',$item->product_id)->first();
                            $totalProduct += $item->product_amount;
                          ?>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:left" colspan="7">{{$title->name}}</td>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">TK</td>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center" colspan="2">{{number_format(round($item->product_amount),2)}}</td>
                          </tr>
                          @endforeach
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:right;" colspan="7"><strong>Total Sum Insured: </strong></td>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center">TK</td>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center;" colspan="2"><strong>{{number_format(round($totalProduct),2)}}</strong></td>
                          </tr>
                          @else
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center;" colspan="10"><strong>No product available..........!</strong></td>
                          </tr>
                          @endif
                          <tr>
                            <td colspan="10">
                              <div style="display:flex">
                                <div style="width:25%">INTEREST IINSURED</div>
                                <div style="width:5%">:</div>
                                <div style="width:70%">
                                  @if (!empty($single_data->fireInsuranceProductDetail))
                                @foreach ($single_data->fireInsuranceProductDetail as $item)
                                <?php
                                  $title = DB::table('products')->select('name')->where('id',$item->product_id)->first();
                                ?>
                                 {{$title->name}},
                                @endforeach
                                @endif
                                </div>
                              </div>
                              <div style="display:flex">
                                <div style="width:25%">PERILS TO BE COVERED</div>
                                <div style="width:5%">:</div>
                                <div style="width:70%">Fire &/or Lightning, only</div>
                              </div>
                              <div style="display:flex">
                                <div style="width:25%">SITUATION</div>
                                <div style="width:5%">:</div>
                                <div style="width:70%">{{$single_data->situation}}</div>
                              </div>
                              <div style="display:flex">
                                <div style="width:25%">PERIOD</div>
                                <div style="width:5%">:</div>
                                <div style="width:70%">{{date('d-m-Y',strtotime($single_data->period_from))}} To {{date('d-m-Y',strtotime($single_data->period_to))}}</div>
                              </div>
                              <div style="display:flex">
                                <div style="width:25%">CONSTRUCTION OF PREMISES</div>
                                <div style="width:5%">:</div>
                                <div style="width:70%">{{$single_data->construction_premises}}</div>
                              </div>
                              <div style="display:flex">
                                <div style="width:25%">OWNER/OCCUPIED BY</div>
                                <div style="width:5%">:</div>
                                <div style="width:70%">The Insured.</div>
                              </div>
                              <div style="display:flex">
                                <div style="width:25%">USED AS</div>
                                <div style="width:5%">:</div>
                                <div style="width:70%">{{$single_data->used_as}}.</div>
                              </div>
                              <div style="display:flex">
                                <div style="width:25%">WARRANTIES</div>
                                <div style="width:5%">:</div>
                                <div style="width:70%">This Covernote is issued, subject to Terms, Conditions and Warranties of the Policy.</div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center;" colspan="8">Rate</td>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center;" colspan="2">Premium Payable</td>
                          </tr>
                          @if (!empty($single_data->fireInsuranceProductDetail))
                          <?php $totalProduct = 0; ?>
                          @foreach ($single_data->fireInsuranceProductDetail as $item)
                          <?php
                            $title = DB::table('products')->select('name')->where('id',$item->product_id)->first();
                            $totalProduct += $item->product_amount;
                          ?>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:left" colspan="8">Fire@ &emsp; {{$item->product_rate}}% &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; {{number_format(round($item->product_amount),2)}}</td>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:right" colspan="2">{{number_format(round(($item->product_amount * $item->product_rate)/100))}}</td>
                          </tr>
                          @endforeach
                          @else
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center;" colspan="10"><strong>No product available..........!</strong></td>
                          </tr>
                          @endif
                          @if (!empty($single_data->fireAdditionalPerilsDetail))
                          <?php $totalProduct = 0; ?>
                          @foreach ($single_data->fireAdditionalPerilsDetail as $perils)
                          <?php
                            $titleAdd = DB::table('additional_perils')->select('title')->where('id',$perils->perils_id)->first();
                          ?>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:left" colspan="8">{{$titleAdd->title}}@ &emsp; {{$perils->premium_rate}}% &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; {{number_format(round($perils->amount),2)}}</td>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:right" colspan="2">{{number_format(round(($perils->amount * $perils->premium_rate)/100))}}</td>
                          </tr>
                          @endforeach
                          @endif
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:left;"colspan="7">Net Premium</td>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center;">TK.</td>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:right" colspan="2">{{number_format(round($single_data->accountInfoFireInsurance->net_premium),2)}}</td>
                          </tr>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:left;"colspan="7">VAT &emsp; @ &emsp; 15%</td>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center;">TK.</td>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:right" colspan="2">{{number_format(round($single_data->accountInfoFireInsurance->vat_amount),2)}}</td>
                          </tr>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:right;" colspan="7"><strong>Gross Premium</strong></td>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center;">TK.</td>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:right;" colspan="2"><strong>{{number_format(round($single_data->accountInfoFireInsurance->grand_total),2)}}</strong></td>
                          </tr>
                          <tr>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:right;" colspan="7"><strong>Payment</strong></td>
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:center;">TK.</td>
                            @if (($single_data->accountInfoFireInsurance->payment == 0) || ($single_data->accountInfoFireInsurance->payment == '') || ($single_data->accountInfoFireInsurance->payment == null))
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:right;" colspan="2"><strong>{{number_format(round($single_data->accountInfoFireInsurance->grand_total),2)}}</strong></td>
                            @else
                            <td style="border: 1px solid #ddd; padding: 3px 3px; text-align:right;" colspan="2"><strong>{{number_format(round($single_data->accountInfoFireInsurance->payment),2)}}</strong></td> 
                            @endif
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