@extends('layouts.layout')
@section('title', 'Branch')
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
          {!! Form::open(array('route' =>['branch.update', $single_data->id],'method'=>'PUT','files'=>true)) !!}
          <?php $info ="Update";?>
        @else
        {!! Form::open(array('route' =>['branch.store'],'method'=>'POST','files'=>true)) !!}
          <?php $info ="Add";?>
        @endif
        <div class="card">
          <div class="card-header">
            <div class="card-title">{{$info}} Branch </div>
          </div>
          <div class="card-body">
            <!-- Row start -->
            <div class="row gutters">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input  type="text" name="name"
                    class="form-control @error('name') is-invalid @enderror" 
                    value="{{(!empty($single_data->name))?$single_data->name: old('name') }}" required="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">Name <span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input  type="text" name="division"
                    class="form-control @error('division') is-invalid @enderror" 
                    value="{{(!empty($single_data->division)) ? $single_data->division : old('division')}}"  autocomplete="off">
                  </div>
                  <div class="field-placeholder">Division </div>
                </div>
                <!-- Field wrapper end -->
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input  type="text" name="district"
                    class="form-control @error('district') is-invalid @enderror" 
                    value="{{(!empty($single_data->district)) ? $single_data->district : old('district')}}" autocomplete="off">
                  </div>
                  <div class="field-placeholder">District </div>
                </div>
                <!-- Field wrapper end -->
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                   <textarea name="address"  class="form-control @error('address') is-invalid @enderror"  style="height:40px">{{(!empty($single_data->address)) ? $single_data->address : old('address')}}</textarea>
                  </div>
                  <div class="field-placeholder">Address</div>
                </div>
                <!-- Field wrapper end -->
              </div>
            </div>
            <!-- Row end -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer text-end">
            <a href="{{route('branch.index')}}" class="btn  btn-warning">Back</a>
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
@endsection 