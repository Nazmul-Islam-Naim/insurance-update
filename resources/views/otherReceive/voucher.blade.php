@extends('layouts.layout')
@section('title', 'Add Income Voucher')
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
        <div class="card">
          <div class="card-header">
            <div class="card-title">{{ __('menu.add_income_voucher') }}</div>
          </div>
          {!! Form::open(array('route' =>['receive-voucher.store'],'method'=>'POST')) !!}
          <div class="card-body">
            <!-- Row start -->
            <div class="row gutters">
              <div class="col-md-6">
                <div class="field-wrapper">
                  <div class="input-group">
                    <select class="form-control Type" name="receive_type_id" required=""> 
                      <option value="">Select</option>
                      @foreach($alltype as $type)
                      <option value="{{$type->id}}">{{$type->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">{{ __('menu.other_income_type') }} <span class="text-danger">*</span></div>
                </div>

                <div class="field-wrapper">
                  <div class="input-group">
                    <select class="form-control SubType" name="receive_sub_type_id" required="">
                    </select>
                  </div>
                  <div class="field-placeholder">{{ __('menu.other_income_sub_type') }} <span class="text-danger">*</span></div>
                </div>

                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text" name="amount" class="form-control decimal" value="" autocomplete="off" required>
                  </div>
                  <div class="field-placeholder">{{ __('home.amount') }} <span class="text-danger">*</span></div>
                </div>

                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text" name="receive_from" class="form-control" value="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">{{ __('home.receive_form') }}</div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text" name="issue_by" class="form-control" autocomplete="off" value="">
                  </div>
                  <div class="field-placeholder">{{ __('home.issue_by') }}</div>
                </div>

                <div class="field-wrapper">
                  <div class="input-group">
                    <select class="form-control" name="bank_id" required="">
                      <option value="">--Select--</option>
                      @foreach($allbank as $bank)
                      <option value="{{$bank->id}}">{{$bank->bank_name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">{{ __('home.receive_method') }} <span class="text-danger">*</span></div>
                </div>

                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="date" name="receive_date" class="form-control" value="<?php echo date('Y-m-d');?>" required>
                  </div>
                  <div class="field-placeholder">{{ __('home.date') }} <span class="text-danger">*</span></div>
                </div>

                <div class="field-wrapper">
                  <div class="input-group">
                    <textarea name="note" rows="1" class="form-control"></textarea>
                  </div>
                  <div class="field-placeholder">{{ __('home.note') }}</div>
                </div>
              </div>
            </div>
            <!-- Row end -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button class="btn btn-primary" type="submit">Save</button>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
    <!-- Row end -->
  </div>
  <!-- Content wrapper end -->
</div>
<!-- Content wrapper scroll end -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
      // dependancy dropdown using ajax
      $(document).ready(function() {
        $('.Type').on('change', function() {
          var typeID = $(this).val();
          if(typeID) {
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              method: "POST",
              //url: "{{URL::to('find-receive-subtype-with-type-id')}}",
              url: "{{$baseUrl.'/'.config('app.or').'/find-receive-subtype-with-type-id'}}",
              data: {
                'id' : typeID
              },
              dataType: "json",

              success:function(data) {
                //console.log(data);
                if(data){
                  $('.SubType').empty();
                  $('.SubType').focus;
                  $('.SubType').append('<option value="">Select</option>'); 
                  $.each(data, function(key, value){
                    //console.log(data);
                    $('select[name="receive_sub_type_id"]').append('<option value="'+ value.id +'">' + value.name+ '</option>');
                  });
                }else{
                  $('.SubType').empty();
                }
              }
            });
          }else{
            $('.SubType').empty();
          }
        });
      });
    </script>
@endsection 