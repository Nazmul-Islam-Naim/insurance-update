@extends('layouts.layout')
@section('title', 'User Performances')
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
        <div class="card card-primary">
          <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title">Clients Category</h3>
          </div>
          <!-- /.box-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div id="basic-column-graph-datalables"></div>
              </div>
              <div class="col-md-12">
                <div class="tags-block">
                  <h5>Life Stages</h5>
                  <div class="tags f-16">
                    <a href="{{route('clients')}}" class="me-2">
                      <i class="icon-label text-dark"></i><strong> All({{$all}})</strong>
                    </a>
                    <a href="{{route('clients','customer')}}" class="me-2">
                      <i class="icon-label text-primary"></i><strong> Customer({{$customer}})</strong>
                    </a>
                    <a href="{{route('clients', 'lead')}}" class="me-2">
                      <i class="icon-label text-secondary"></i><strong>Lead({{$lead}})</strong> 
                    </a>
                    <a href="{{route('clients', 'opportunity')}}" class="me-2">
                      <i class="icon-label text-warning"></i><strong>Opportunity({{$oppotunity}})</strong> 
                    </a>
                    <a href="{{route('clients', 'subscriber')}}" class="me-2">
                      <i class="icon-label text-success"></i><strong>Subscriber({{$subscriber}})</strong> 
                    </a>
                    <a href="{{route('clients', 'general')}}" class="me-2">
                      <i class="icon-label text-danger"></i><strong>General({{$general}})</strong> 
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.row -->
          </div>
          <div class="card-footer"></div>
        </div>
      </div>
    </div>
    <!-- Row end -->
  </div>
  <!-- Content wrapper end -->
</div>
<!-- Content wrapper scroll end -->
{!!Html::script('custom/js/jquery.min.js')!!}
{!!Html::script('custom/vendor/apex/apexcharts.min.js')!!}
{!!Html::script('custom/vendor/apex/examples/column/basic-column-graph-datalables.js')!!} 
@endsection 