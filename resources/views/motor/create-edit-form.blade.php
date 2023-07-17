@extends('layouts.layout')
@section('title', 'Motor Insurance')
@section('content')
<style>
  .select2-container--default .select2-selection--single .select2-selection__clear  {
    cursor: pointer;
    float: right;
    font-weight: bold;
    height: 26px;
    margin-right: 20px;
    padding-right: 0px;
    display: none;
}

  /* Chrome, Safari, Edge, Opera */
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }
</style>
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
      @if(!empty($single_data))
        {!! Form::open(array('route' =>['motor-insurance.update', $single_data->id],'method'=>'PUT','files'=>true)) !!}
        <?php $info ="Edit";?>
      @else
      {!! Form::open(array('route' =>['motor-insurance.store'],'method'=>'POST','files'=>true)) !!}
        <?php $info ="Add";?>
      @endif
        <div class="row">
          <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
            <div class="card">
              <div class="card-header">
                <div class="card-title">{{$info}}  Motor Insurance</div>
              </div>
              <div class="card-body">
                <!-- Row start -->
                <div class="row gutters">
                  <!--------------------------- client --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <select name="client_id" class="select-single select2 js-state @error('client_id') is-invalid @enderror" data-live-search="true" required> 
                          <option value="">Select</option>
                          @foreach($allclient as $client)
                          <option value="{{$client->id}}" {{((!empty($single_data) && ($client->id == $single_data->client_id)) || (old('client_id') == $client->id)) ? 'selected' : ''}}>{{$client->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="field-placeholder">Client Name<span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!--------------------------- bank --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <select name="bank_id" class="select-single select2 js-state @error('bank_id') is-invalid @enderror" data-live-search="true" required> 
                          <option value="">Select</option>
                          @foreach($allbank as $bank)
                          <option value="{{$bank->id}}" {{((!empty($single_data) && ($bank->id == $single_data->bank_id)) || (old('bank_id') == $bank->id)) ? 'selected' : ''}}>{{$bank->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="field-placeholder">Bank Name<span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!--------------------------- vehicle/tarrif --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <select name="tarrif_calculation_id" id="tarrif_calculation_id" class="select-single select2 js-state @error('tarrif_calculation_id') is-invalid @enderror" data-live-search="true" required> 
                          <option value="">Select</option>
                          @foreach($alltarrif as $tarrif)
                          <option value="{{$tarrif->id}}" {{((!empty($single_data) && ($tarrif->id == $single_data->tarrif_calculation_id)) || (old('tarrif_calculation_id') == $tarrif->id)) ? 'selected' : ''}}>{{$tarrif->tarrif->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="field-placeholder">Tarrif<span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!--------------------------- reg no --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12" id="tarrifDetails">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="text" name="reg_no" id="reg_no" class="form-control @error('reg_no') is-invalid @enderror" 
                        value="{{(!empty($single_data->reg_no))?$single_data->reg_no: old('reg_no')}}" required="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Reg No<span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!--------------------------- engine no --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12" >
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="text" name="engine_no" id="engine_no" class="form-control @error('engine_no') is-invalid @enderror" 
                        value="{{(!empty($single_data->engine_no))?$single_data->engine_no: old('engine_no')}}" required="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Engine No<span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!--------------------------- chasis no --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="text" name="chassis_no" id="chassis_no" class="form-control @error('chassis_no') is-invalid @enderror" 
                        value="{{(!empty($single_data->chassis_no))?$single_data->chassis_no: old('chassis_no')}}" required="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Chassis No<span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!--------------------------- modle no --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="text" name="model_no" id="model_no" class="form-control @error('model_no') is-invalid @enderror" 
                        value="{{(!empty($single_data->model_no))?$single_data->model_no: old('model_no')}}" required="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Model No<span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!--------------------------- period from --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="date" name="period_from" id="period_from" class="form-control @error('period_from') is-invalid @enderror" 
                        value="{{(!empty($single_data->period_from))?$single_data->period_from: old('period_from')}}" required="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Period From<span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!--------------------------- period to --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="date" name="period_to" id="period_to" class="form-control @error('period_to') is-invalid @enderror" 
                        value="{{(!empty($single_data->period_to))?$single_data->period_to: old('period_to')}}" required="" readonly="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Period To<span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!--------------------------- declaration --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <textarea name="declaration" class="form-control @error('declaration') is-invalid @enderror" style="height: 40px" autocomplete="off">
                          {{(!empty($single_data->declaration))?$single_data->declaration: old('declaration')}}
                        </textarea>
                      </div>
                      <div class="field-placeholder">Declaration</div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!--------------------------- risk option --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <textarea  name="risk_option" class="form-control @error('risk_option') is-invalid @enderror" style="height: 40px" autocomplete="off">
                          {{(!empty($single_data->risk_option))?$single_data->risk_option: old('risk_option')}}
                        </textarea>
                      </div>
                      <div class="field-placeholder">Risk Option</div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!--------------------------- Insured amount --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" name="insured_amount" id="insured_amount" class="form-control @error('insured_amount') is-invalid @enderror" 
                        value="{{(!empty($single_data->insured_amount))?$single_data->insured_amount: old('insured_amount')}}" required="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Insured Amount<span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                </div>
                <!-- Row end -->
              </div>
              <!-- /.card-body -->
            </div>
            <!---------------- additional perils card-------------------------->
            <div class="card">
              <div class="card-header">
                <div class="card-title">Additional Perils</div>
              </div>
              <div class="card-body">
                <div class="row gutters">
                  <div class="table-responsive">
                    <!--<table id="dataTable" class="table v-middle">-->
                    <table id="myTableID" class="table ">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Amount</th>
                          <th>Rate</th>
                          <th>Premium</th>
                          <th>action</th>
                        </tr>
                      </thead>
                      <tbody id="body">
                        <?php $row = 0; ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td style="border: 1px solid #fff; text-align:right; font-weight:bold" colspan="3">
                            Additional Perils Primum: 
                          </td>
                          <td style="border: 1px solid #fff">
                            <input type="number" class="form-control" name="perils_premium" id="perils_premium" readonly="" autocomplete="off">
                          </td>
                          <td >
                            <input type="button" class="form-control" value="+" id="addone" >
                          </td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
            <div class="card">
              <div class="card-header">
                <div class="card-title">Motor Insurance</div>
              </div>
              <div class="card-body">
                <!-- Row start -->
                <div class="row gutters">
                  <!------------------ Basic Premium --------------------->
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" name="basic_premium" id="basic_premium" class="form-control @error('basic_premium') is-invalid @enderror" 
                        value="{{(!empty($single_data->basic_premium))?$single_data->basic_premium: old('basic_premium')}}" readonly="" autocomplete="off">
                      </div>
                      <div class="field-placeholder"> Basice Premium</div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!------------------ permium percent--------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" step="any" name="premium_percent" id="premium_percent" class="form-control @error('premium_percent') is-invalid @enderror" 
                        value="{{(!empty($single_data->premium_percent))?$single_data->premium_percent: old('premium_percent')}}" required="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Premimum % <span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!------------------ permium --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" name="premium" id="premium" class="form-control @error('premium') is-invalid @enderror" 
                        value="{{(!empty($single_data->premium))?$single_data->premium: old('premium')}}" readonly="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Premimum</div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!------------------ total permium perils + insurance --------------------->
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" name="total_premium" id="total_premium" class="form-control @error('total_premium') is-invalid @enderror" 
                        value="{{(!empty($single_data->total_premium))?$single_data->total_premium: old('total_premium')}}" readonly="" autocomplete="off">
                      </div>
                      <div class="field-placeholder"> Total Premium</div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!------------------ ncb percent--------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" step="any" name="ncb_percent" id="ncb_percent" class="form-control @error('ncb_percent') is-invalid @enderror" 
                        value="{{(!empty($single_data->ncb_percent))?$single_data->ncb_percent: old('ncb_percent')}}"  autocomplete="off">
                      </div>
                      <div class="field-placeholder">NCB % </div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!------------------ ncb amount --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" name="ncb" id="ncb" class="form-control @error('ncb') is-invalid @enderror" 
                        value="{{(!empty($single_data->ncb))?$single_data->ncb: old('ncb')}}" readonly="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">NCB Amount</div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!------------------ total permium  - ncb --------------------->
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" name="after_ncb" id="after_ncb" class="form-control @error('after_ncb') is-invalid @enderror" 
                        value="{{(!empty($single_data->after_ncb))?$single_data->after_ncb: old('after_ncb')}}" readonly="" autocomplete="off">
                      </div>
                      <div class="field-placeholder"> After NCB</div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!------------------ act liability premium --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" name="act_liability" id="act_liability" class="form-control @error('act_liability') is-invalid @enderror" 
                        value="{{(!empty($single_data->act_liability))?$single_data->act_liability: old('act_liability')}}" readonly="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Act Liability</div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!------------------ passenger --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" name="passenger" id="passenger" class="form-control @error('passenger') is-invalid @enderror" 
                        value="{{(!empty($single_data->passenger))?$single_data->passenger: old('passenger')}}" readonly="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Passenger</div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!------------------ per passenger fee --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" name="per_passenger" id="per_passenger" class="form-control @error('per_passenger') is-invalid @enderror" 
                        value="{{(!empty($single_data->per_passenger))?$single_data->per_passenger: old('per_passenger')}}" readonly="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Per Passenger</div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!------------------ passenger total fee --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" name="passenger_total" id="passenger_total" class="form-control @error('passenger_total') is-invalid @enderror" 
                        value="{{(!empty($single_data->passenger_total))?$single_data->passenger_total: old('passenger_total')}}" readonly="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Passenger Total</div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!------------------ driver paid --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" name="driver_fee" id="driver_fee" class="form-control @error('driver_fee') is-invalid @enderror" 
                        value="{{(!empty($single_data->driver_fee))?$single_data->driver_fee: old('driver_fee')}}" readonly="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Driver Fee</div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!------------------ net premium --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" name="net_premium" id="net_premium" class="form-control @error('net_premium') is-invalid @enderror" 
                        value="{{(!empty($single_data->net_premium))?$single_data->net_premium: old('net_premium')}}" readonly="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Net Premimum</div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!------------------ vat percent --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" name="vat_percent" id="vat_percent" class="form-control @error('vat_percent') is-invalid @enderror" 
                        value="{{(!empty($single_data->vat_percent))?$single_data->vat_percent: old('vat_percent')}}" required="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Vat % <span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!------------------ vat percent amount --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" name="vat_amount" id="vat_amount" class="form-control @error('vat_amount') is-invalid @enderror" 
                        value="{{(!empty($single_data->vat_amount))?$single_data->vat_amount: old('vat_amount')}}" readonly="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Vat Amount</div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!------------------ grand total amount --------------------->
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" name="grand_total" id="grand_total" class="form-control @error('grand_total') is-invalid @enderror" 
                        value="{{(!empty($single_data->grand_total))?$single_data->grand_total: old('grand_total')}}" required="" readonly="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Grand Total</div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!------------------payment percent --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" name="payment_percent" id="payment_percent" class="form-control @error('payment_percent') is-invalid @enderror" 
                        value="{{(!empty($single_data->payment_percent))?$single_data->payment_percent: old('payment_percent')}}" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Payment(%)</div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!------------------payment percent amount --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" name="payment_percent_amount" id="payment_percent_amount" class="form-control @error('payment_percent_amount') is-invalid @enderror" 
                        value="{{(!empty($single_data->payment_percent_amount))?$single_data->payment_percent_amount: old('payment_percent_amount')}}" readonly="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">(%) Amount</div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!------------------payment --------------------->
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" name="payment" id="payment" class="form-control @error('payment') is-invalid @enderror" 
                        value="{{(!empty($single_data->payment))?$single_data->payment: old('payment')}}" readonly="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Payment</div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                </div>
                <!-- Row end -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <input type="submit" name="preview" id="preview" class="btn btn-warning" value="Preview" onclick="preview">
                  <input type="submit" name="save" id="save" class="btn btn-primary" value="Save" >
                {!! Form::close() !!}
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
{!!Html::script('custom/js/jquery.min.js')!!}
<script>
$(document).ready(function () {

  //----------------------- tarrif id change -------------------//
  $("#tarrif_calculation_id").change(function (e) { 
    e.preventDefault();
    var id = $("#tarrif_calculation_id").val();
    if (id) {
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: "POST",
        url: "{{route('get-tarrif')}}",
        data: {
          'id' : id
        },
        dataType: "json",

        success:function(data) {
          if(data){
            // $("#details").empty();
            $("#basic_premium").empty();
            $("#act_liability").empty();
            $("#passenger").empty();
            $("#per_passenger").empty();
            $("#passenger_total").empty();
            $("#driver_fee").empty();
            $("#vat_percent").empty();
            $('#tarrifDetails').focus;
          // var html = '<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">';
          //     html += '<div class="field-wrapper" id="details">';
          //     html += '<div class="input-group">';
          //     html += '<p> Basic: '+data.basic + ' || Per Passenger Fee: '+ data.per_passenger_fee+ ' || Passenger: ' + data.passenger +
          //       ' || Passenger Fee: ' + (data.per_passenger_fee * data.passenger) + ' || Driver Fee: ' + data.driver_fee +
          //       ' || Net Amount: ' + data.net_amount +  '</p>';
          //     html += '</div>';
          //     html += '</div>';
          //     html += '</div>';
          //   $('#tarrifDetails').after( html );
            $("#basic_premium").val(data.basic);
            $("#act_liability").val(data.act_laibility);
            $("#passenger").val(data.passenger);
            $("#per_passenger").val(data.per_passenger_fee);
            $("#passenger_total").val(data.per_passenger_fee * data.passenger);
            $("#driver_fee").val(data.driver_fee);
            $("#vat_percent").val(data.vat_percent);
          }else{
            // $("#tarrifDetails").after();
            $("#basic_premium").empty();
            $("#act_liability").empty();
            $("#passenger").empty();
            $("#per_passenger").empty();
            $("#passenger_total").empty();
            $("#driver_fee").empty();
            $("#vat_percent").empty();
          }
        }
      });
    } else {
        // $("#tarrifDetails").after();
        $("#basic_premium").empty();
        $("#act_liability").empty();
        $("#passenger").empty();
        $("#per_passenger_fee").empty();
        $("#passenger_total").empty();
        $("#driver_fee").empty();
        $("#vat_percent").empty();
    }
  });


  //------------------------change insured amount ----------------//
  $("#insured_amount").keyup(function (e) { 
    allCalculation();
  });

  //------------------------change premium ----------------//
  $("#premium_percent").keyup(function (e) { 
    allCalculation();
  });

  //------------------------change ncb ----------------//
  $("#ncb_percent").keyup(function (e) { 
    afterNcb(); 
  });

  //------------------------ vat calculation with grand total----------------//
  $("#vat_percent").keyup(function (e) { 
    var vatAmount = 0 ;
    var grandTotal = 0;
    var netPremium = parseFloat($("#net_premium").val());
    var vatPercent = parseFloat($("#vat_percent").val());
    if (isNaN(netPremium)) {
      netPremium = 0 ;
    }

    if (isNaN(vatPercent)) {
      vatPercent = 0 ;
    }

    vatAmount = Math.round( (netPremium * vatPercent) / 100 );
    $("#vat_amount").val(vatAmount);
    
    // var stampAmount = parseFloat($("#stamp_duty").val());
    // if (isNaN(stampAmount)) {
    //   stampAmount = 0 ;
    // }
    // grandTotal = netPremium + vatAmount + stampAmount;
    grandTotal = netPremium + vatAmount;
    
    $("#grand_total").val(grandTotal);



  });
  //------------------------ payment----------------//
  $("#payment_percent").keyup(function (e) { 
    var paymentAmount = 0 ;
    var payment = 0;
    var grandTotal = parseFloat($("#grand_total").val());
    var netPremium = parseFloat($("#net_premium").val());
    var percent = parseFloat($("#payment_percent").val());
    if (isNaN(grandTotal)) {
      grandTotal = 0 ;
    }

    if (isNaN(netPremium)) {
      netPremium = 0 ;
    }

    if (isNaN(percent)) {
      percent = 0 ;
    }

    paymentAmount = Math.round( (netPremium * percent) / 100 );
    payment = grandTotal - paymentAmount;
    $("#payment_percent_amount").val(paymentAmount);
    $("#payment").val(payment);
  });
  //------------------------ date change ----------------//
  $("#period_from").change(function (e) { 
    var periodFrom = $("#period_from").val();
    let date, month, year;
    var conToDate = new Date(periodFrom);
    date = conToDate.getDate();
    month = conToDate.getMonth()+1;
    year = conToDate.getFullYear();

    date = date
        .toString()
        .padStart(2, '0');

    month = month
        .toString()
        .padStart(2, '0');

    var periodTo = `${year+1}-${month}-${date}`;
    $("#period_to").val(periodTo);

  });

  //------------------------------ multiple perils -----------//
  var i=0;
  $("#addone").on('click',function(){
      i++;
      var row = '<tr id="row_'+i+'">';
          row += '<td style="border: 1px solid #fff; width:35%">';
          row += ' <select name="addmore['+ i +'][perils_id]" id="perils_id_'+i+'" onchange="setValue('+i+')" class=" form-control select-single js-states select2  @error("perils_id") is-invalid @enderror" data-live-search="true" required> ';
          row += ' <option value="">Select</option>';
          row += ' @foreach($allperils as $perils)';
          row += ' <option value="{{$perils->id}}" {{((!empty($single_data) && ($perils->id == $single_data->perils_id)) || (old("perils_id") == $perils->id)) ? "selected" : ""}}>{{$perils->title}}</option>';
          row += ' @endforeach';
          row += '</td>';
          row += '<td style="border: 1px solid #fff">';
          row += ' <input type="number" step="any" class="form-control" name="addmore['+ i +'][amount]" id="amount_'+i+'" onkeyup="setPremium('+i+')" required="" autocomplete="off">';
          row += '</td>';
          row += '<td style="border: 1px solid #fff">';
          row += ' <input type="number" step="any" class="form-control" name="addmore['+ i +'][premium_rate]" id="premium_rate_'+i+'" onkeyup="setPremium('+i+')" required="" autocomplete="off">';
          row += '</td>';
          row += '<td style="border: 1px solid #fff">';
          row += ' <input type="number" class="form-control" name="rowPremium" id="rowPremium_'+i+'" readonly="" autocomplete="off" >';
          row += '</td>';
          row += '<td style="border: 1px solid #fff">';
          row += ' <input type="button" class="form-control" value="x" id="remove" onclick="$(\'#row_'+i+'\').remove();perilsPremium()">';
          row += '</td>';
          row += '</tr></br>';
          $('#body').append(row);
          $('.select2').select2();
  });

});

//--------------------- set amount ---------------//
function setValue(row) {
    var amount = document.getElementById('insured_amount').value;
    var id = document.getElementById('perils_id_'+row).value;
    if (id != '') {
      document.getElementById('amount_'+row).value = amount;
      perilsPremium();
    } else {
      document.getElementById('amount_'+row).value = 0;
      perilsPremium();
    }
  }

//------------------------ set row premium ------------------//
function setPremium(row) {
    var amount = document.getElementById('amount_'+row).value;
    var rate   = document.getElementById('premium_rate_'+row).value;
    document.getElementById('rowPremium_'+row).value = Math.round((amount * rate)/100);
    perilsPremium();
  }

//------------------------ perils_premium ------------------//
function perilsPremium() {
    var premium = 0 ;
    var total = 0 ;
    var bdt = parseFloat(document.getElementById('insured_amount').value);
    var arr = document.getElementsByName('rowPremium');
    for (var i = 0; i < arr.length; i++) {
        if (parseFloat(arr[i].value))
          premium += parseFloat(arr[i].value);
    }
    total = Math.round(premium);
    document.getElementById('perils_premium').value = total;
    allCalculation();
    // document.getElementById('total_premium').value = Math.round(total + bdt);
    // document.getElementById('net_premium').value = Math.round(total + bdt);
  }

//----------------- change product value -------------------//
function productPremium(row) {
  var newAmount = 0;
  var newPremium = 0;
  var amount = document.getElementById('product_amount_'+row).value;
  var sPr   = document.getElementById('s_per_'+row).value;
  var rate   = document.getElementById('product_rate_'+row).value;
  if (isNaN(amount)) {
    amount = 1;
  }
  if (isNaN(sPr)) {
    sPr = 1;
  }
  if (isNaN(rate)) {
    rate = 1;
  }
  newAmount = (amount * sPr)/100;
  newPremium = (newAmount * rate)/100;
  console.log(newPremium);
  document.getElementById('s_per_amount_'+row).value = Math.round(newAmount);
  document.getElementById('product_premium_'+row).value = Math.round(newPremium);
  totalAmount();
  }

//------------------------ product total amount + amount in bdt + total premium ------------------//
function totalAmount() {
    var totalAmount = 0 ;
    var productTotal = 0 ;
    var total = 0 ;
    var arr = document.getElementsByClassName('product_premium');
    for (var i = 0; i < arr.length; i++) {
        if (parseFloat(arr[i].value))
        productTotal += parseFloat(arr[i].value);
        totalAmount  += parseFloat(document.getElementById('product_amount_'+(i+1)).value); 
    }
    total = Math.round(productTotal);
    document.getElementById('total_amount').value = Math.round(totalAmount);
    document.getElementById('product_total').value = total;
    document.getElementById('insured_amount').value = total;
    document.getElementById('total_premium').value = total;
  }

//-------------- all calculation -----------//
function allCalculation(){
  var premium = 0 ;
  var totalPremium = 0 ;
  var netPremium = 0 ;
  var vatAmount = 0;
  var grandTotal = 0;

  var basicPremium = parseFloat(document.getElementById('basic_premium').value);
  var insuredAmount = parseFloat(document.getElementById('insured_amount').value);
  var premiumPercent = parseFloat(document.getElementById('premium_percent').value);
  var perilsPremium = parseFloat(document.getElementById('perils_premium').value);
  var actLiability = parseFloat(document.getElementById('act_liability').value);
  var passengerTotal = parseFloat(document.getElementById('passenger_total').value);
  var driverFee = parseFloat(document.getElementById('driver_fee').value);
  var vatPercent = parseFloat(document.getElementById('vat_percent').value);

  if (isNaN(basicPremium)) {
    basicPremium = 0;
  }
  if (isNaN(insuredAmount)) {
    insuredAmount = 0;
  }
  if (isNaN(premiumPercent)) {
    premiumPercent = 0;
  }
  if (isNaN(perilsPremium)) {
    perilsPremium = 0;
  }
  if (isNaN(actLiability)) {
    actLiability = 0;
  }
  if (isNaN(passengerTotal)) {
    passengerTotal = 0;
  }
  if (isNaN(driverFee)) {
    driverFee = 0;
  }
  if (isNaN(vatPercent)) {
    vatPercent = 0;
  }

  premium = Math.round((insuredAmount * premiumPercent)/100);
  totalPremium = basicPremium + premium + perilsPremium;
  netPremium = totalPremium + actLiability + passengerTotal + driverFee;
  vatAmount = Math.round((netPremium * vatPercent)/100);
  grandTotal = netPremium + vatAmount;

  document.getElementById('premium').value = premium;
  document.getElementById('total_premium').value = totalPremium;
  document.getElementById('net_premium').value = netPremium;
  document.getElementById('vat_amount').value = vatAmount;
  document.getElementById('grand_total').value = grandTotal;
}
//-------------- after ncb calculation -----------//
function afterNcb(){
  var ncbAmount = 0 ;
  var afterNcb = 0 ;
  var netPremium = 0 ;
  var vatAmount = 0;
  var grandTotal = 0;

  var totalPremium = parseFloat(document.getElementById('total_premium').value);
  var ncbPercent = parseFloat(document.getElementById('ncb_percent').value);
  var actLiability = parseFloat(document.getElementById('act_liability').value);
  var passengerTotal = parseFloat(document.getElementById('passenger_total').value);
  var driverFee = parseFloat(document.getElementById('driver_fee').value);
  var vatPercent = parseFloat(document.getElementById('vat_percent').value);

  if (isNaN(ncbAmount)) {
    ncbAmount = 0;
  }
  if (isNaN(actLiability)) {
    actLiability = 0;
  }
  if (isNaN(passengerTotal)) {
    passengerTotal = 0;
  }
  if (isNaN(driverFee)) {
    driverFee = 0;
  }
  if (isNaN(vatPercent)) {
    vatPercent = 0;
  }

  ncbAmount = Math.round((totalPremium * ncbPercent)/100);
  afterNcb = totalPremium - ncbAmount;
  netPremium = afterNcb + actLiability + passengerTotal + driverFee;
  vatAmount = Math.round((netPremium * vatPercent)/100);
  grandTotal = netPremium + vatAmount;

  document.getElementById('ncb').value = ncbAmount;
  document.getElementById('after_ncb').value = afterNcb;
  document.getElementById('net_premium').value = netPremium;
  document.getElementById('vat_amount').value = vatAmount;
  document.getElementById('grand_total').value = grandTotal;
}

  //------------------ preview --------------//
  function preview() {
    document.getElementById('save').value = '';
  }
</script>
@endsection 