@extends('layouts.layout')
@section('title', 'Marine Bill Collection')
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
        {!! Form::open(array('route' =>['marine-bill-collection-form-store'],'method'=>'POST','files'=>true)) !!}
        <div class="card">
          <div class="card-header">
            <div class="card-title">Marine Bill Collection</div>
          </div>
          <div class="card-body">
            <!-- Row start -->
            <div class="row gutters">
              <!------------------- insurance name ------------------------>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input  type="text" name="name"
                    class="form-control @error('name') is-invalid @enderror" 
                    value="{{(!empty($single_data))?$single_data->client->name: old('name') }}" readonly="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">Client Name </div>
                  <input type="hidden" name="insurance_id" value="{{$single_data->id}}">
                </div>
                <!-- Field wrapper end -->
              </div>
              <!------------------- bank name ------------------------>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input  type="text" name="phone"
                    class="form-control @error('phone') is-invalid @enderror" 
                    value="{{(!empty($single_data))?$single_data->bank->name:old('phone')}}" readonly="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">Bank Name </div>
                </div>
                <!-- Field wrapper end --> 
              </div>
              <!------------------- interest covered ------------------------>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input class="form-control" type="text" name="interest_cover"
                    class="form-control @error('interest_cover') is-invalid @enderror"  
                    value="{{(!empty($single_data))?$single_data->interestCovered->name:old('interest_cover')}}"  readonly="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">Interest Covered</div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <!------------------- Total Bill ------------------------>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input class="form-control" type="text" name="grand_total"
                    class="form-control @error('grand_total') is-invalid @enderror"  
                    value="{{(!empty($single_data->accountInfoMarinInsurance))?$single_data->accountInfoMarinInsurance->grand_total :old('grand_total')}}"  readonly="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">Total Bill </div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <!------------------- total due ------------------------>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input class="form-control" type="text" name="due" id="due"
                    class="form-control @error('due') is-invalid @enderror"  
                    value="{{(!empty($single_data->accountInfoMarinInsurance))?$single_data->accountInfoMarinInsurance->due :old('due')}}"  readonly="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">Total Due </div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <!------------------- collectable amount  ------------------------>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input class="form-control" type="number" step="any" name="collected_amount" id="collected_amount"
                    class="form-control @error('collected_amount') is-invalid @enderror"  
                    value="{{old('collected_amount')}}" required="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">Collectable Amount <span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <!------------------- collection Type  ------------------------>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12" >
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="collection_type" id="collection_type" class="form-control @error('collection_type') is-invalid @enderror" required> 
                      <option value="">Select</option>
                      <option value="1" {{((old('collection_type') ==1)) ? 'selected' : ''}}>Cash</option>
                      <option value="2" {{((old('collection_type') == 2)) ? 'selected' : ''}}>Cheque</option>
                    </select>
                  </div>
                  <div class="field-placeholder">Payment Type<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <!--------------------------- checque number --------------------->
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12" id="chequeNumber" style="display: none">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input  type="text" name="cheque_number" id="cheque_number" class="form-control  @error('cheque_number') is-invalid @enderror" 
                    value="{{old('cheque_number')}}" autocomplete="off">
                  </div>
                  <div class="field-placeholder">Cheque Number</div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <!--------------------------- bank name --------------------->
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12" id="bankName" style="display: none">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input  type="text" name="bank_name" id="bank_name" class="form-control  @error('bank_name') is-invalid @enderror" 
                    value="{{old('bank_name')}}" autocomplete="off">
                  </div>
                  <div class="field-placeholder">Bank Name</div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <!------------------- account   ------------------------>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="bank_id" class="form-control @error('bank_id') is-invalid @enderror" required> 
                      <option value="">Select</option>
                      @foreach($allbank as $bank)
                      <option value="{{$bank->id}}" {{( (old('bank_id') == $bank->id)) ? 'selected' : ''}}>{{$bank->bank_name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">Account<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <!--------------------------- collect date --------------------->
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input  type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" 
                    value="{{date('Y-m-d')}}" required="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">Date<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
              </div>
              <!--------------------------- note --------------------->
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12" id="hideShow">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input  type="text" name="note" id="note" class="form-control  @error('note') is-invalid @enderror" 
                    value="{{old('note')}}" autocomplete="off">
                  </div>
                  <div class="field-placeholder">Note</div>
                </div>
                <!-- Field wrapper end -->
              </div>
            </div>
            <!-- Row end -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer text-end">
            <a href="{{route('marine-bill-collection')}}" class="btn  btn-warning">Back</a>
            <button class="btn btn-primary" type="submit">Save</button>
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
  $(document).ready(function () {

    //---------------- cheque selection by payment type ---------------//
    $("#collection_type").change(function (e) { 
      e.preventDefault();
      var type = $("#collection_type").val();
      if (type == 2) {
        $("#chequeNumber").show();
        $("#bankName").show();
      } else {
        $("#chequeNumber").hide();
        $("#bankName").hide();
      }
      
    });

    //------------------- check amount to due -------------------------//
    $("#collected_amount").keyup(function (e) { 
      var due = parseFloat($("#due").val());
      var collection = parseFloat($("#collected_amount").val());

      if (isNaN(due)) {
        due = 0;
      }

      if (isNaN(collection)) {
        collection = 0;
      }

      if (collection > due) {
        alert('Collection is too long');
        $('#collected_amount').val(0);
      }


    });

  });
</script>
@endsection 