@extends('layouts.layout')
@section('title', 'Fire Insurance')
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
        {!! Form::open(array('route' =>['fire-insurance.update', $single_data->id],'method'=>'PUT','files'=>true)) !!}
        <?php $info ="Edit";?>
      @else
      {!! Form::open(array('route' =>['fire-insurance.store'],'method'=>'POST','files'=>true)) !!}
        <?php $info ="Add";?>
      @endif
        <div class="row">
          <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
            <div class="card">
              <div class="card-header">
                <div class="card-title">{{$info}}  Fire Insurance</div>
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
                  <!--------------------------- interest covered/product --------------------->
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="table-responsive">
                      <!--<table id="dataTable" class="table v-middle">-->
                      <table id="myTableID" class="table ">
                        <thead>
                          <tr>
                            <th>Name of Properties</th>
                            <th>Amount</th>
                            <th>S.Per.</th>
                            <th>S.Per. Amount</th>
                            <th>Rate</th>
                            <th>Premium</th>
                            <th>action</th>
                          </tr>
                        </thead>
                        <tbody id="productTable">
                        </tbody>
                        <tfoot>
                          <tr>
                            <td style="border: 1px solid #fff; text-align:right; font-weight:bold" colspan="5">
                              Total Amount: 
                            </td>
                            <td style="border: 1px solid #fff">
                              <input type="number" class="form-control" name="product_total" id="product_total" readonly="" autocomplete="off">
                            </td>
                            <td >
                              <input type="button" class="form-control" value="+" id="addrow" >
                            </td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                  <!--------------------------- amount in dollar --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" name="amount_in_dollar" id="amount_in_dollar" class="form-control @error('amount_in_dollar') is-invalid @enderror" 
                        value="{{(!empty($single_data->amount_in_dollar))?$single_data->amount_in_dollar: old('amount_in_dollar')}}" readonly="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Amount<span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!--------------------------- extra percent --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" name="extra_percent" id="extra_percent" class="form-control @error('extra_percent') is-invalid @enderror" 
                        value="{{(!empty($single_data->extra_percent))?$single_data->extra_percent: old('extra_percent')}}" required="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Extra %<span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!--------------------------- extra percent amount --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" name="extra_percent_amount" id="extra_percent_amount" class="form-control @error('extra_percent_amount') is-invalid @enderror" 
                        value="{{(!empty($single_data->extra_percent_amount))?$single_data->extra_percent_amount: old('extra_percent_amount')}}" readonly="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Extra Percent Amount<span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!--------------------------- currency type --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <select name="currency_id" id="currency_id" class="select-single select2 js-state @error('currency_id') is-invalid @enderror" data-live-search="true" required> 
                          <option value="">Select</option>
                          @foreach($allcurrency as $currency)
                          <option value="{{$currency->slug}}"
                            {{((!empty($single_data) && ($currency->id == $single_data->currency_id)) || (old('currency_id') == $currency->id)) ? 'selected' : ''}}>
                            {{$currency->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="field-placeholder">Currency Type<span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!--------------------------- rate --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" step="any" name="rate" id="rate" class="form-control @error('rate') is-invalid @enderror" 
                        value="{{(!empty($single_data->rate))?$single_data->rate: old('rate')}}" required="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Rate<span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!--------------------------- amount in bdt --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" name="amount_in_bdt" id="amount_in_bdt" class="form-control @error('amount_in_bdt') is-invalid @enderror" 
                        value="{{(!empty($single_data->amount_in_bdt))?$single_data->amount_in_bdt: old('amount_in_bdt')}}" readonly="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Amount(BDT)<span class="text-danger">*</span></div>
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
                          {{-- <tr id="row_0" >
                            <td style="border: 1px solid #fff; width:35%">
                              <select name="addmore[{{$row}}][perils_id]" id="perils_id_{{$row}}" onchange="setValue({{$row}})" class="select2 select-single js-state @error('perils_id') is-invalid @enderror" data-live-search="true" required> 
                                <option value="">Select</option>
                                @foreach($allperils as $perils)
                                <option value="{{$perils->id}}" {{((!empty($single_data) && ($perils->id == $single_data->perils_id)) || (old('perils_id') == $perils->id)) ? 'selected' : ''}}>{{$perils->title}}</option>
                                @endforeach
                              </select>
                            </td>
                            <td style="border: 1px solid #fff">
                              <input type="number" class="form-control" name="addmore[{{$row}}][amount]" id="amount_{{$row}}" onkeyup="setPremium({{$row}})" autocomplete="off">
                            </td>
                            <td style="border: 1px solid #fff">
                              <input type="number" class="form-control" name="addmore[{{$row}}][premium_rate]" id="premium_rate_{{$row}}" onkeyup="setPremium({{$row}})" autocomplete="off">
                            </td>
                            <td style="border: 1px solid #fff">
                              <input type="number" class="form-control" name="addmore[{{$row}}][rowPremium]" id="rowPremium_{{$row}}" readonly="" autocomplete="off">
                            </td>
                          </tr> --}}
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
                <div class="card-title">Fire Insurance</div>
              </div>
              <div class="card-body">
                <!-- Row start -->
                <div class="row gutters">
                  <!------------------ permium percent--------------------->
                  {{-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" step="any" name="premium_percent" id="premium_percent" class="form-control @error('premium_percent') is-invalid @enderror" 
                        value="{{(!empty($single_data->premium_percent))?$single_data->premium_percent: old('premium_percent')}}" required="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Premimum % <span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->
                  </div> --}}
                  <!------------------ permium --------------------->
                  {{-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" name="premium" id="premium" class="form-control @error('premium') is-invalid @enderror" 
                        value="{{(!empty($single_data->premium))?$single_data->premium: old('premium')}}" readonly="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Premimum</div>
                    </div>
                    <!-- Field wrapper end -->
                  </div> --}}
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
                  <!------------------ discount percent --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" name="discount_percent" id="discount_percent" class="form-control @error('discount_percent') is-invalid @enderror" 
                        value="{{(!empty($single_data->discount_percent))?$single_data->discount_percent: old('discount_percent')}}" required="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Discount %</div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!------------------ discount amount --------------------->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" name="discount_amount" id="discount_amount" class="form-control @error('discount_amount') is-invalid @enderror" 
                        value="{{(!empty($single_data->discount_amount))?$single_data->discount_amount: old('discount_amount')}}" readonly="" autocomplete="off">
                      </div>
                      <div class="field-placeholder"> Discount Amount</div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!------------------ sp discount --------------------->
                  {{-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" name="sp_discount" class="form-control @error('sp_discount') is-invalid @enderror" 
                        value="{{(!empty($single_data->sp_discount))?$single_data->sp_discount: old('sp_discount')}}" required="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Sp Discount</div>
                    </div>
                    <!-- Field wrapper end -->
                  </div> --}}
                  <!------------------ net premium --------------------->
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
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
                  <!------------------ stamp amount --------------------->
                  {{-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="number" name="stamp_duty" id="stamp_duty" class="form-control @error('stamp_duty') is-invalid @enderror" 
                        value="{{(!empty($single_data->stamp_duty))?$single_data->stamp_duty: old('stamp_duty')}}" readonly="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Stamp Duty</div>
                    </div>
                    <!-- Field wrapper end -->
                  </div> --}}
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

  //------------------------------ multiple product -----------//
  var j=0;
  $("#addrow").on('click',function(){
      j++;
      var row = '<tr id="rowProduct_'+j+'">';
          row += '<td style="border: 1px solid #fff">';
          row += ' <select name="addproduct['+ j +'][product_id]" id="product_id_'+j+'" class=" form-control select-single js-states select2  @error("product_id") is-invalid @enderror" data-live-search="true" required> ';
          row += ' <option value="">Select</option>';
          row += ' @foreach($allproduct as $product)';
          row += ' <option value="{{$product->id}}" {{((!empty($single_data) && ($product->id == $single_data->product_id)) || (old("product_id") == $product->id)) ? "selected" : ""}}>{{$product->name}}</option>';
          row += ' @endforeach';
          row += '</td>';
          row += '<td style="border: 1px solid #fff; width:18%">';
          row += ' <input type="number" step="any" class="form-control product_amount" name="addproduct['+ j +'][product_amount]" id="product_amount_'+j+'" onkeyup="productPremium('+j+')" required="" autocomplete="off">';
          row += '</td>';
          row += '<td style="border: 1px solid #fff; width:10%">';
          row += ' <input type="number" step="any" class="form-control s_per" name="addproduct['+ j +'][s_per]" id="s_per_'+j+'" onkeyup="productPremium('+j+')" required="" autocomplete="off">';
          row += '</td>';
          row += '<td style="border: 1px solid #fff; width:16%">';
          row += ' <input type="number" step="any" class="form-control s_per_amount" name="addproduct['+ j +'][s_per_amount]" id="s_per_amount_'+j+'" onkeyup="productPremium('+j+')" readonly="" autocomplete="off">';
          row += '</td>';
          row += '<td style="border: 1px solid #fff; width:10%">';
          row += ' <input type="number" step="any" class="form-control product_rate" name="addproduct['+ j +'][product_rate]" id="product_rate_'+j+'" onkeyup="productPremium('+j+')" required="" autocomplete="off">';
          row += '</td>';
          row += '<td style="border: 1px solid #fff; width:16%">';
          row += ' <input type="number" step="any" class="form-control product_premium" name="addproduct['+ j +'][product_premium]" id="product_premium_'+j+'" readonly="" autocomplete="off">';
          row += '</td>';
          row += '<td style="border: 1px solid #fff">';
          row += ' <input type="button" class="form-control" value="x" id="remove" onclick="$(\'#rowProduct_'+j+'\').remove();totalAmount();">';
          row += '</td>';
          row += '</tr></br>';
          $('#productTable').append(row);
          $('.select2').select2();
  });
  

  //----------------------- currency change and premium -----------------//
  $("#currency_id").change(function (e) { 
    var slug = $("#currency_id").val();;
    if (slug == 'taka') {
      $('#rate').val(1);
    }else{
      $('#rate').val('');
    }

    //---------------- set value for premium ----------------//
    var bdt = parseFloat($("#amount_in_bdt").val());
    var perilsPre = parseFloat($("#perils_premium").val());
    if (isNaN(bdt)) {
      bdt = 0;
    }
    if (isNaN(perilsPre)) {
      perilsPre = 0;
    }
    $("#total_premium").val(bdt + perilsPre);
    $("netPremium").val(bdt + perilsPre);
  });

  //----------------------- amount in dollar chagne -----------------//
  // $("#rate").keyup(function (e) { 
  //   var totalDollar = 0;
  //   var extraAmount =0;
  //   var convert = 0;
  //   //------------------------- parse float ------------//
  //   var dollar = parseFloat($("#amount_in_dollar").val());
  //   var extraPercent = parseFloat($("#extra_percent").val());
  //   var rate = parseFloat($("#rate").val());
  //    //------------------------- check nan or note -----//
  //    if (isNaN(dollar)) {
  //     dollar = 0;
  //   }

  //   if (isNaN(extraPercent)) {
  //     extraPercent = 0;
  //   }

  //   if (isNaN(rate)) {
  //     rate = 0;
  //   }
  //   //------------------------- check extra percent -----------------//
  //   if (extraPercent > 0) {
  //     extraAmount = (dollar * extraPercent)/100;
  //     totalDollar = dollar + extraAmount;
  //   } else {
  //     extraAmount =  (dollar * 0)/100;
  //     totalDollar = dollar + extraAmount;
  //   }
  //   //----------------------- check dollar rate ---------------------//
  //   if (rate > 0) {
  //     convert = totalDollar * rate;
  //   } else {
  //     convert = totalDollar * 1;
  //   }

  //   $("#extra_percent_amount").val(Math.round(extraAmount));
  //   $("#amount_in_bdt").val(Math.round(convert));

    
  //   //---------------- set value for premium ----------------//
  //   var perilsPre = parseFloat($("#perils_premium").val());
  //   if (isNaN(perilsPre)) {
  //     perilsPre = 0;
  //   }
  //   $("#total_premium").val(Math.round(convert + perilsPre));
  //   $("#net_premium").val(Math.round(convert + perilsPre));

  // });

  //----------------------- extra percent chagne -----------------//
  $("#extra_percent").keyup(function (e) { 
    var totalDollar = 0;
    var extraAmount =0;
    var convert = 0;
   //------------------------- parse float ------------//
    var dollar = parseFloat($("#amount_in_dollar").val());
    var extraPercent = parseFloat($("#extra_percent").val());
    var rate = parseFloat($("#rate").val());
    //------------------------- check nan or note -----//
    if (isNaN(dollar)) {
      dollar = 0;
    }

    if (isNaN(extraPercent)) {
      extraPercent = 0;
    }

    if (isNaN(rate)) {
      rate = 0;
    }
    //------------------------- check extra percent -----------------//
    if (extraPercent > 0) {
      extraAmount = (dollar * extraPercent)/100;
      totalDollar = dollar + extraAmount;
    } else {
      extraAmount =  0;
      totalDollar = dollar + extraAmount;
    }
    //----------------------- check dollar rate ---------------------//

    if (rate > 0) {
      convert = totalDollar * rate;
    } else {
      convert = totalDollar * 1;
    }

    $("#extra_percent_amount").val(Math.round(extraAmount));
    $("#amount_in_bdt").val(Math.round(convert));

  });

  //----------------------- dollar rate chagne -----------------//
  $("#rate").keyup(function (e) { 
    var totalDollar = 0;
    var extraAmount =0;
    var convert = 0;
    //------------------------- parse float ------------//
    var dollar = parseFloat($("#amount_in_dollar").val());
    var extraPercent = parseFloat($("#extra_percent").val());
    var rate = parseFloat($("#rate").val());
    // var stampAmount = parseFloat($("#stamp_amount").val());
    var slug = $("#slug").val();
    //------------------------- check nan or note -----//
    if (isNaN(dollar)) {
      dollar = 0;
    }

    if (isNaN(extraPercent)) {
      extraPercent = 0;
    }

    if (isNaN(rate)) {
      rate = 0;
    }
    //------------------------- check extra percent -----------------//
    if (extraPercent > 0) {
      extraAmount = (dollar * extraPercent)/100;
      totalDollar = dollar + extraAmount;
    } else {
      extraAmount =  (dollar * 0)/100;
      totalDollar = dollar + extraAmount;
    }
    //----------------------- check dollar rate ---------------------//
    if (rate > 0) {
      convert = totalDollar * rate;
    } else {
      convert = totalDollar * 1;
    }

    $("#extra_percent_amount").val(Math.round(extraAmount));
    $("#amount_in_bdt").val(Math.round(convert));

    //---------------- set value for premium ----------------//
    var perilsPre = parseFloat($("#perils_premium").val());
    if (isNaN(perilsPre)) {
      perilsPre = 0;
    }
    $("#total_premium").val(Math.round(convert + perilsPre));
    $("#net_premium").val(Math.round(convert + perilsPre));

    //---------- stump duty -----------//
    // if (slug == "truck") {
    //   $("#stamp_duty").val(stampAmount);
    // } else {
    //   $("#stamp_duty").val(Math.round(convert / stampAmount));
    // }

  });

  //------------------------ premium + total premium + net premium calculation ----------------//
  $("#premium_percent").keyup(function (e) { 
    var premium = 0 ;
    var netPremium = 0 ;
    var totalPremium = 0;
    var sumInsurance = parseFloat($("#amount_in_bdt").val());
    var premiumPercent = parseFloat($("#premium_percent").val());
    var discountAmount = parseFloat($("#discount_amount").val());
    var perilsPrem = parseFloat($("#perils_premium").val());
    if (isNaN(sumInsurance)) {
      sumInsurance = 0 ;
    }

    if (isNaN(premiumPercent)) {
      premiumPercent = 0 ;
    }
    if (isNaN(discountAmount)) {
      discountAmount = 0 ;
    }    
    if (isNaN(perilsPrem)) {
      perilsPrem = 0 ;
    }
    premium = Math.round( (sumInsurance * premiumPercent)/100);
    //---------- total premium ---------------//
    premium = premium;
    totalPremium = premium + perilsPrem; 
    netPremium = totalPremium - discountAmount;
    $("#premium").val(premium);
    $("#total_premium").val(totalPremium);
    $("#net_premium").val(netPremium);

  });

  //------------------------ discount calculation ----------------//
  $("#discount_percent").keyup(function (e) { 
    var discount = 0 ;
    var netPremium = 0 ;
    var totalPremium = parseFloat($("#total_premium").val());
    var discountPercent = parseFloat($("#discount_percent").val());
    if (isNaN(totalPremium)) {
      totalPremium = 0 ;
    }

    if (isNaN(discountPercent)) {
      discountPercent = 0 ;
    }
    discount = Math.round( (totalPremium * discountPercent)/100);
    netPremium = totalPremium - discount;
    $("#discount_amount").val(discount);
    $("#net_premium").val(netPremium);



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
          row += ' <input type="number" class="form-control" name="rowPremium" id="rowPremium_'+i+'" readonly="" autocomplete="off">';
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
    var amount = document.getElementById('amount_in_bdt').value;
    document.getElementById('amount_'+row).value = amount;
    perilsPremium();
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
    var bdt = parseFloat(document.getElementById('amount_in_bdt').value);
    var arr = document.getElementsByName('rowPremium');
    for (var i = 0; i < arr.length; i++) {
        if (parseFloat(arr[i].value))
          premium += parseFloat(arr[i].value);
    }
    total = Math.round(premium);
    document.getElementById('perils_premium').value = total;
    document.getElementById('total_premium').value = total + bdt;
    document.getElementById('net_premium').value = Math.round(total + bdt);
  }

//----------------- change product value -------------------//
function productPremium(row) {
  console.log(56);
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

//------------------------ product total amount ------------------//
function totalAmount() {
    var productTotal = 0 ;
    var total = 0 ;
    var arr = document.getElementsByClassName('product_premium');
    for (var i = 0; i < arr.length; i++) {
        if (parseFloat(arr[i].value))
        productTotal += parseFloat(arr[i].value);
    }
    total = Math.round(productTotal);
    document.getElementById('product_total').value = total;
    document.getElementById('amount_in_dollar').value = total;
  }

  //------------------ preview --------------//
  function preview() {
    document.getElementById('save').value = '';
  }
</script>
@endsection 