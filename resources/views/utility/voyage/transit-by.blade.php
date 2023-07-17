@extends('layouts.layout')
@section('title', 'Transit By')
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
      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
        @if(!empty($single_data))
          {!! Form::open(array('route' =>['transit-by.update', $single_data->id],'method'=>'PUT','files'=>true)) !!}
          <?php $info ="Edit";?>
        @else
        {!! Form::open(array('route' =>['transit-by.store'],'method'=>'POST','files'=>true)) !!}
          <?php $info ="Add";?>
        @endif
        <div class="card">
          <div class="card-header">
            <div class="card-title">{{$info}}  Transit By</div>
          </div>
          <div class="card-body">
            <!-- Row start -->
            <div class="row gutters">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input  type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{(!empty($single_data->name))?$single_data->name: old('name')}}" required="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">{{ __('home.name') }} <span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->

                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input  type="number" name="stamp_amount" class="form-control @error('stamp_amount') is-invalid @enderror" value="{{(!empty($single_data->stamp_amount))?$single_data->stamp_amount: old('stamp_amount')}}" required="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">Stamp Amount <span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
                
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="voyage_via_id" class="form-control select2 select-single js-state @error('voyage_via_id') is-invalid @enderror" data-live-search="true" required> 
                      <option value="">Select</option>
                      @foreach($allvia as $via)
                      <option value="{{$via->id}}" {{((!empty($single_data) && ($via->id == $single_data->voyage_via_id)) || (old('voyage_via_id') == $via->id)) ? 'selected' : ''}}>{{$via->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">Voyage Via<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
              </div>
            </div>
            <!-- Row end -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button class="btn btn-primary" type="submit">{{$info}}</button>
          </div>
        </div>
        {!! Form::close() !!}
      </div>
      
      <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Transit By List</div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <!--<table id="dataTable" class="table v-middle">-->
              <table id="basicExample" class="table custom-table">
                <thead>
                  <tr>
                    <th>{{ __('home.SL') }}</th>
                    <th>{{ __('home.name') }}</th>
                    <th>Voyage Via</th>
                    <th>Stamp Amount</th>
                    <th>Branch</th>
                    <th>Created By</th>
                    <th>{{ __('home.action') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $sl = 1;?>
                  @foreach($alldata as $data)
                  <tr>
                    <td>{{$sl++}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->voyageVia->name}}</td>
                    <td>{{$data->stamp_amount}}</td>
                    <td>{{$data->branch->name}}</td>
                    <td>{{$data->user->name}}</td>
                    <td>
                      <div class="actions" style="height: 25px">
                        <a href="{{ route('transit-by.edit', $data->id) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                          <i class="icon-edit1 text-info"></i>
                        </a>
                        {{Form::open(array('route'=>['transit-by.destroy',$data->id],'method'=>'DELETE'))}}
                          <button type="submit" class="btn btn-default btn-xs confirmdelete" confirm="You want to delete this informations ?" title="Delete" style="width: 100%"><i class="icon-x-circle text-danger"></i></button>
                        {!! Form::close() !!}
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
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