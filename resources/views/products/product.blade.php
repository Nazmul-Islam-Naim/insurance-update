@extends('layouts.layout')
@section('title', 'Product')
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
          {!! Form::open(array('route' =>['product.update', $single_data->id],'method'=>'PUT','files'=>true)) !!}
          <?php $info ="Edit";?>
        @else
        {!! Form::open(array('route' =>['product.store'],'method'=>'POST','files'=>true)) !!}
          <?php $info ="Add";?>
        @endif
        <div class="card">
          <div class="card-header">
            <div class="card-title">{{$info}}  {{ __('menu.Product') }}</div>
          </div>
          <div class="card-body">
            <!-- Row start -->
            <div class="row gutters">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                    value="{{(!empty($single_data->name))?$single_data->name: old('name')}}" required="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">{{ __('home.name') }} <span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="product_category_id" class="form-control @error('product_category_id') is-invalid @enderror"  required> 
                      <option value="">Select</option>
                      @foreach($allcategory as $category)
                      <option value="{{$category->id}}" {{((!empty($single_data) && ($category->id == $single_data->product_category_id)) || (old('product_category_id') == $category->id)) ? 'selected' : ''}}>{{$category->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">Product Category <span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="product_sub_category_id" class="form-control @error('product_sub_category_id') is-invalid @enderror" required> 
                      <option value="">Select</option>
                      @foreach($allsubcategory as $subcategory)
                      <option value="{{$subcategory->id}}" {{((!empty($single_data) && ($subcategory->id == $single_data->product_sub_category_id)) || (old('product_sub_category_id') == $category->id)) ? 'selected' : ''}}>{{$subcategory->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">Product Sub Category<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
              </div>
            </div>
            <!-- Row end -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer text-end">
            <a href="{{route('product.index')}}" class="btn btn-warning">Back</a>
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