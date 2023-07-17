@extends('layouts.layout')
@section('title', 'Tarrif Calculation Form')
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
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        @if(!empty($single_data))
          {!! Form::open(array('route' =>['tarrif-calculation.update', $single_data->id],'method'=>'PUT','files'=>true)) !!}
          <?php $info ="Edit";?>
        @else
        {!! Form::open(array('route' =>['tarrif-calculation.store'],'method'=>'POST','files'=>true)) !!}
          <?php $info ="Add";?>
        @endif
        <div class="card">
          <div class="card-header">
            <div class="card-title">{{$info}}  Tarrif Calculation Form </div>
          </div>
          <div class="card-body">
            <!-- Row start -->
            <div class="row gutters">
              <!---------------- tarrif type ---------------------->
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="tarrif_id" class="form-control @error('tarrif_id') is-invalid @enderror"  required> 
                      <option value="">Select</option>
                      @foreach($alltarrif as $tarrif)
                      <option value="{{$tarrif->id}}" {{((!empty($single_data) && ($tarrif->id == $single_data->tarrif_id)) || (old('tarrif_id') == $tarrif->id)) ? 'selected' : ''}}>{{$tarrif->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">Tarrif Type<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <!---------------- basic ---------------------->
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input  type="number" name="basic" id="basic" class="form-control @error('basic') is-invalid @enderror" value="{{(!empty($single_data->basic))?$single_data->basic: old('basic')}}" required="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">Basic<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <!---------------- act laibility ---------------------->
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input  type="number" name="act_laibility" id="act_laibility" class="form-control @error('act_laibility') is-invalid @enderror" value="{{(!empty($single_data->act_laibility))?$single_data->act_laibility: old('act_laibility')}}" required="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">Act Liability<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <!---------------- per passenger fee ---------------------->
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input  type="number" name="per_passenger_fee" id="per_passenger_fee" class="form-control @error('per_passenger_fee') is-invalid @enderror" value="{{(!empty($single_data->per_passenger_fee))?$single_data->per_passenger_fee: 45}}" readonly="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">Per Passenger Fee<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <!---------------- passenger ---------------------->
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input  type="number" name="passenger" id="passenger" class="form-control @error('passenger') is-invalid @enderror" value="{{(!empty($single_data->passenger))?$single_data->passenger: old('passenger')}}" required="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">Passenger<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <!---------------- passenger fee ---------------------->
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input  type="number" name="passenger_fee" id="passenger_fee" class="form-control @error('passenger_fee') is-invalid @enderror" value="{{(!empty($single_data))? ($single_data->per_passenger_fee * $single_data->passenger): old('passenger_fee')}}" readonly="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">Passenger Fee</div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <!---------------- driver fee ---------------------->
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input  type="number" name="driver_fee" id="driver_fee" class="form-control @error('driver_fee') is-invalid @enderror" value="{{(!empty($single_data->driver_fee))?$single_data->driver_fee: old('driver_fee')}}" required="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">Driver Fee<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <!---------------- net amount ---------------------->
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input  type="number" name="net_amount" id="net_amount" class="form-control @error('net_amount') is-invalid @enderror" value="{{(!empty($single_data->net_amount))?$single_data->net_amount: old('net_amount')}}" readonly="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">Net Amount<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <!---------------- vat(%) ---------------------->
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input  type="number" name="vat_percent" id="vat_percent" class="form-control @error('vat_percent') is-invalid @enderror" value="{{(!empty($single_data->vat_percent))?$single_data->vat_percent: old('vat_percent')}}" required="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">Vat(%)<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <!---------------- vat amount ---------------------->
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input  type="number" name="vat_amount" id="vat_amount" class="form-control @error('vat_amount') is-invalid @enderror" value="{{(!empty($single_data)) ? round(($single_data->net_amount * $single_data->vat_percent)/100) : old('vat_amount')}}" readonly="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">Vat Amount</div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <!---------------- grand total ---------------------->
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input  type="number" name="grand_total" id="grand_total" class="form-control @error('grand_total') is-invalid @enderror" value="{{(!empty($single_data)) ? round($single_data->net_amount + (($single_data->net_amount * $single_data->vat_percent)/100)) : old('grand_total')}}" readonly="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">Grand Total</div>
                </div>
                <!-- Field wrapper end -->
              </div>
            </div>
            <!-- Row end -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer text-end">
            <button class="btn btn-primary" type="submit">{{$info}}</button>
          </div>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
    <!-- Row end -->
  </div>
  <!-- Content wrapper end -->
</div>
<!-- Content wrapper scroll end -->
{!!Html::script('custom/js/jquery.min.js')!!}
<script>
  function totalNetAmount() {
    var basic = parseFloat(document.getElementById('basic').value);
    var actLaibility = parseFloat(document.getElementById('act_laibility').value);
    var passengerFee = parseFloat(document.getElementById('passenger_fee').value);
    var driverFee = parseFloat(document.getElementById('driver_fee').value);
    if (isNaN(basic)) {
      basic = 0;
    }
    if (isNaN(actLaibility)) {
      actLaibility = 0;
    }
    if (isNaN(passengerFee)) {
      passengerFee = 0;
    }
    if (isNaN(driverFee)) {
      driverFee = 0;
    }
    var grandTotl = basic + actLaibility + passengerFee + driverFee;
    document.getElementById('net_amount').value = Math.round(grandTotl);
  }
  function grandTotl() {
    var netAmount = parseFloat(document.getElementById('net_amount').value);
    var vatAmount = parseFloat(document.getElementById('vat_amount').value);
    if (isNaN(netAmount)) {
      netAmount = 0;
    }
    if (isNaN(vatAmount)) {
      vatAmount = 0;
    }
    var grandTotl = netAmount + vatAmount;
    document.getElementById('grand_total').value = Math.round(grandTotl);
  }
  $(document).ready(function () {
    //----------------- basic -----------------//
    $('#basic').keyup(function (e) { 
      totalNetAmount();
      grandTotl();
    });
    //----------------- basic -----------------//
    $('#act_laibility').keyup(function (e) { 
      totalNetAmount();
      grandTotl();
    });
    //----------------- passenger -----------------//
    $('#passenger').keyup(function (e) { 
      var perPassengerFee = parseFloat($("#per_passenger_fee").val());
      var passenger = parseFloat($("#passenger").val());
      if (isNaN(perPassengerFee)) {
        perPassengerFee = 0;
      }
      if (isNaN(perPassengerFee)) {
        passenger = 0;
      }
      $("#passenger_fee").val(Math.round(perPassengerFee * passenger));

      //----------------- grand total claculation ---------------//
      totalNetAmount();
      grandTotl();
    });
    //----------------- driver fee -----------------//
    $('#driver_fee').keyup(function (e) { 
      totalNetAmount();
      grandTotl();
    });
    //----------------- vat  -----------------//
    $('#vat_percent').keyup(function (e) { 
      var vatPercent = parseFloat($("#vat_percent").val());
      var netAmount = parseFloat($("#net_amount").val());
      if (isNaN(vatPercent)) {
        vatPercent = 0;
      }
      if (isNaN(netAmount)) {
        netAmount = 0;
      }
      $("#vat_amount").val(Math.round((vatPercent * netAmount)/100));

      //------------------ total -------------//
      totalNetAmount();
      grandTotl();
    });
  });
</script>
@endsection 