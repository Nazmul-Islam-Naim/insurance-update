@extends('layouts.layout')
@section('title', 'Income Voucher Report')
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
        @include('common.commonFunction')
      </div>
    </div>
    <div class="row gutters">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">{{ __('home.Search_Area') }}</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="col-md-12">
              <form method="post" action="{{ route('receive.filter') }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-inline">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="field-wrapper">
                        <div class="input-group">
                          <input class="form-control " type="date" name="start_date" value="" autocomplete="off">
                        </div>
                        <div class="field-placeholder">From </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="field-wrapper">
                        <div class="input-group">
                          <input class="form-control " type="date" name="end_date" value="" autocomplete="off">
                        </div>
                        <div class="field-placeholder">To </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="field-wrapper">
                        <div class="input-group">
                          <select name="type_id" id="type_id" class="select-single select2 js-state" data-live-search="true" autocomplete="off"> 
                            <option value="">Select</option>
                            @foreach ($alltype as $type)
                                <option value="{{$type->id}}" {{(!empty($type_id) && ($type_id == $type->id)) ? 'selected' : ''}}>{{$type->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="field-placeholder">Type </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="field-wrapper">
                        <div class="input-group">
                          <select name="sub_type_id" id="sub_type_id" class="select-single select2 js-state" data-live-search="true" autocomplete="off"> 
                            <option value="">Select</option>
                            @if (!empty($sub_type_id))
                            @foreach ($allsubtype as $subtype)
                            <option value="{{$subtype->id}}" {{($sub_type_id == $subtype->id) ? 'selected' : ''}}>{{$subtype->name}}</option>
                            @endforeach
                            @endif
                          </select>
                        </div>
                        <div class="field-placeholder">Sub Type </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="field-wrapper">
                        <div class="input-group">
                          <input type="submit" value="Search" class="btn btn-info btn-md">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>

      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">{{ __('menu.income_voucher_report') }}</h3>
                
            <a onclick="printReport();" href="javascript:0;"><img class="img-thumbnail" style="width:30px;" src='{{asset("custom/img/print.png")}}'></a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="col-md-12" id="printTable">
              <center><h5 style="margin: 0px">{{ __('menu.income_voucher_report') }}</h5></center>
              <div class="table-responsive">
                @if(!empty($start_date) && !empty($end_date))
                <center><h6 style="margin: 0px">From : {{dateFormateForView($start_date)}} To : {{dateFormateForView($end_date)}}</h6></center>
                @else
                <center><h6 style="margin: 0px">Date : {{date('d-m-Y')}}</h6></center>
                @endif
                <table class="" style="width: 100%; font-size: 12px;" cellspacing="0" cellpadding="0">  
                  <thead> 
                    <tr style="background: #ccc;"> 
                      <th style="border: 1px solid #ddd; padding: 3px 3px; color: #000">{{ __('home.SL') }}</th>
                      <th style="border: 1px solid #ddd; padding: 3px 3px; color: #000">{{ __('home.date') }}</th>
                      <th style="border: 1px solid #ddd; padding: 3px 3px; color: #000">{{ __('home.receive_method') }}</th>
                      <th style="border: 1px solid #ddd; padding: 3px 3px; color: #000">Income Type</th>
                      <th style="border: 1px solid #ddd; padding: 3px 3px; color: #000">{{ __('menu.other_income_sub_type') }}</th>
                      <th style="border: 1px solid #ddd; padding: 3px 3px; color: #000">{{ __('home.issue_by') }}</th>
                      <th style="border: 1px solid #ddd; padding: 3px 3px; color: #000">{{ __('home.created_by') }}</th>
                      <th style="border: 1px solid #ddd; padding: 3px 3px; color: #000">{{ __('home.note') }}</th>
                      <th style="border: 1px solid #ddd; padding: 3px 3px; color: #000">{{ __('home.amount') }}</th>
                    </tr>
                  </thead>
                  <tbody> 
                    <?php                           
                      $number = 1;
                      $numElementsPerPage = 250; // How many elements per page
                      $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                      $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
                      $rowCount = 0;

                      $sum = 0;
                    ?>
                    @foreach($alldata as $data)
                    <?php 
                      $rowCount++;
                      $sum += $data->amount;
                    ?>
                    <tr> 
                      <td style="border: 1px solid #ddd; padding: 3px 3px">{{$currentNumber++}}</td>
                      <td style="border: 1px solid #ddd; padding: 3px 3px">{{dateFormateForView($data->receive_date)}}</td>
                      <td style="border: 1px solid #ddd; padding: 3px 3px">{{$data->otherreceive_bank_object->bank_name}}</td>
                      <td style="border: 1px solid #ddd; padding: 3px 3px">{{$data->otherreceive_type_object->name}}</td>
                      <td style="border: 1px solid #ddd; padding: 3px 3px">{{$data->otherreceive_subtype_object->name}}</td>
                      <td style="border: 1px solid #ddd; padding: 3px 3px">{{$data->issue_by}}</td>
                      <td style="border: 1px solid #ddd; padding: 3px 3px">{{$data->otherreceive_user_object->name}}</td>
                      <td style="border: 1px solid #ddd; padding: 3px 3px">{{$data->note}}</td>
                      <td style="border: 1px solid #ddd; padding: 3px 3px">{{number_format($data->amount, 2)}}</td>
                    </tr>
                    @endforeach
                    @if($rowCount==0)
                    <tr>
                      <td colspan="9" align="center">
                        <h5 style="color: #ccc">No Data Found . . .</h5>
                      </td>
                    </tr>
                    @endif
                  </tbody>
                  <tfoot> 
                    <tr> 
                      <td colspan="8" style="text-align: center;font-weight: bold; border: 1px solid #ddd; padding: 3px 3px"><b>{{ __('home.total') }}</b></td>
                      <td style="font-weight: bold; border: 1px solid #ddd; padding: 3px 3px"><b>{{Session::get('currency')}} {{number_format($sum, 2)}}</b></td>
                    </tr>
                  </tfoot>
                </table>
                <div class="col-md-12" align="right">

                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- Row end -->
  </div>
  <!-- Content wrapper end -->
</div>
<!-- Content wrapper scroll end -->
<script src="{{asset('custom/js/jquery.min.js')}}"></script>
    <script type="text/javascript">
      // dependancy dropdown using ajax
      $(document).ready(function() {
        $('#type_id').on('change', function() {
          var typeID = $(this).val();
          if(typeID) {
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              method: "POST",
              //url: "{{URL::to('find-payment-subtype-with-type-id')}}",
              url: "{{$baseUrl.'/'.config('app.or').'/find-receive-subtype-with-type-id'}}",
              data: {
                'id' : typeID
              },
              dataType: "json",

              success:function(data) {
                //console.log(data);
                if(data){
                  $('#sub_type_id').empty();
                  $('#sub_type_id').focus;
                  $('#sub_type_id').append('<option value="">Select</option>'); 
                  $.each(data, function(key, value){
                    console.log(data);
                    $('select[name="sub_type_id"]').append('<option value="'+ value.id +'">' + value.name+ '</option>');
                  });
                }else{
                  $('#sub_type_id').empty();
                }
              }
            });
          }else{
            $('#sub_type_id').empty();
          }
        });
      });
    </script>
@endsection 