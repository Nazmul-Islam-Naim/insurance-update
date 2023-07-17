@extends('layouts.layout')
@section('title', 'Commission Form')
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
        {!! Form::open(array('route' =>['marine-commission.store'],'method'=>'POST','files'=>true, 'onsubmit' => 'return checkTotal()')) !!}
        <div class="card">
          <div class="card-header">
            <div class="card-title">Marine Insurance Commission Distribution</div>
          </div>
          <div class="card-body">
            <!-- Row start -->
            <div class="row gutters">
              <!---------------- marine commission card-------------------------->
            <div class="card">
              <div class="card-header">
                <div class="card-title"> 
                  Client Name: {{$single_data->client->name}} || Client Phone: {{$single_data->client->phone}} || Address: {{$single_data->client->address}} || Sum of Insured: {{$single_data->accountInfoMarinInsurance->grand_total}} TK.
                </div>
              </div>
              <div class="card-body">
                <div class="row ">
                  <!--------------------------- payment method --------------------->
                  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <select name="payment_method" class="select-single select2 js-state @error('payment_method') is-invalid @enderror" data-live-search="true" required> 
                          <option value="">Select</option>
                          @foreach($allmethod as $method)
                          <option value="{{$method->id}}" {{((!empty($single_data) && ($method->id == $single_data->payment_method)) || (old('payment_method') == $method->id)) ? 'selected' : ''}}>{{$method->bank_name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="field-placeholder">Payment Method<span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!--------------------------- payment date --------------------->
                  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <input  type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" 
                        value="{{(!empty($single_data->date))?$single_data->date: date('Y-m-d')}}" required="" autocomplete="off">
                      </div>
                      <div class="field-placeholder">Date<span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <!--------------------------- note --------------------->
                  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <textarea name="note" class="form-control  @error('note') is-invalid @enderror" style="height:40px">{{old('note')}}</textarea>
                      </div>
                      <div class="field-placeholder">Note</div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                </div>
                <div class="row gutters">
                  <input type="hidden" name="grand_total" id="grand_total" value="{{$single_data->accountInfoMarinInsurance->grand_total}}">
                  <input type="hidden" name="insurance_id" id="insurance_id" value="{{$single_data->id}}">
                  <div class="table-responsive">
                    <!--<table id="dataTable" class="table v-middle">-->
                    <table id="myTableID" class="table ">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Insured Amount</th>
                          <th>Payment(%)</th>
                          <th>Payment Amount</th>
                          <th>action</th>
                        </tr>
                      </thead>
                      <tbody id="body">
                        <?php $row = 0; ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td style="border: 1px solid #fff; text-align:right; font-weight:bold" colspan="3">
                           Total Payment: 
                          </td>
                          <td style="border: 1px solid #fff">
                            <input type="number" class="form-control" name="total_amount" id="total_amount" readonly="" autocomplete="off">
                            <input type="hidden" class="form-control" name="total_percent" id="total_percent" readonly="" autocomplete="off">
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
            <!-- Row end -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer text-end">
            <a href="{{route('marine-commission.index')}}" class="btn  btn-warning">Back</a>
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
     //------------------------------ payment title -----------//
  var i=0;
  $("#addone").on('click',function(){
      i++;
      var row = '<tr id="row_'+i+'">';
          row += '<td style="border: 1px solid #fff; width:35%">';
          row += ' <select name="addmore['+ i +'][payment_title_id]" id="payment_title_id_'+i+'" onchange="setValue('+i+')" class=" form-control select-single js-states select2  @error("payment_title_id") is-invalid @enderror" data-live-search="true" required> ';
          row += ' <option value="">Select</option>';
          row += ' @foreach($alltitle as $title)';
          row += ' <option value="{{$title->id}}" {{((!empty($single_data) && ($title->id == $single_data->payment_title_id)) || (old("payment_title_id") == $title->id)) ? "selected" : ""}}>{{$title->title}}</option>';
          row += ' @endforeach';
          row += '</td>';
          row += '<td style="border: 1px solid #fff">';
          row += ' <input type="number" step="any" class="form-control" name="addmore['+ i +'][insured_amount]" id="insured_amount_'+i+'" onkeyup="setAmount('+i+')" readonly="" autocomplete="off">';
          row += '</td>';
          row += '<td style="border: 1px solid #fff">';
          row += ' <input type="number" step="any" class="form-control percent" name="addmore['+ i +'][percent]" id="percent_'+i+'" onkeyup="setAmount('+i+')" required="" autocomplete="off">';
          row += '</td>';
          row += '<td style="border: 1px solid #fff">';
          row += ' <input type="number" class="form-control amount" name="addmore['+ i +'][amount]" id="amount_'+i+'" readonly="" autocomplete="off" >';
          row += '</td>';
          row += '<td style="border: 1px solid #fff">';
          row += ' <input type="button" class="form-control" value="x" id="remove" onclick="$(\'#row_'+i+'\').remove();totalAmount()">';
          row += '</td>';
          row += '</tr></br>';
          $('#body').append(row);
          $('.select2').select2();
  });
  });
  //--------------------- set amount ---------------//
  function setValue(row) {
    var grandTotal = document.getElementById('grand_total').value;
    var id = document.getElementById('payment_title_id_'+row).value;
    if (id != '') {
    document.getElementById('insured_amount_'+row).value = grandTotal;
    totalAmount();
    } else {
    document.getElementById('insured_amount_'+row).value = 0;
    totalAmount();
    }
  }
  //------------------------ set row total ------------------//
  function setAmount(row) {
      var amount = document.getElementById('insured_amount_'+row).value;
      var percent   = document.getElementById('percent_'+row).value;
      document.getElementById('amount_'+row).value = Math.round((amount * percent)/100);
      totalAmount();
    }

  //------------------------ total amount ------------------//
  function totalAmount() {
      var subTotal = 0 ;
      var total = 0 ;
      var toatlPercent = 0 ;
      var arr = document.getElementsByClassName('amount');
      var percnet = document.getElementsByClassName('percent');
      for (var i = 0; i < arr.length; i++) {
          if (parseFloat(arr[i].value))
          subTotal += parseFloat(arr[i].value);
          toatlPercent += parseFloat(percnet[i].value);
      }
      total = Math.round(subTotal);
      document.getElementById('total_amount').value = total;
      document.getElementById('total_percent').value = toatlPercent;
    }

    // check total 
    function checkTotal() {
      var totalAmount = parseFloat(document.getElementById('total_amount').value);
     if (isNaN(totalAmount)) {
      totalAmount = 0 ;
     }
      if (totalAmount <= 0){
        alert('Total payment must be greatter than 0.')
        return false;
      }else{
        return true;
      }
    }
</script>
@endsection 