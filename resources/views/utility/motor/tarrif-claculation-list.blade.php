@extends('layouts.layout')
@section('title', 'Tarrif Calculation')
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
            <div class="card-title">Tarrif Calculation List</div>
            <a href="{{route('tarrif-calculation.create')}}" class="btn btn-primary"><i class="icon-plus-circle"></i>Add Tarrif Calculation</a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <!--<table id="dataTable" class="table v-middle">-->
              <table id="example" class="table custom-table">
                <thead>
                  <tr>
                    <th>{{ __('home.SL') }}</th>
                    <th>Tarrif Type</th>
                    <th>Basic</th>
                    <th>Act Laibility</th>
                    <th>Per Passenger Fee</th>
                    <th>Passenger</th>
                    <th>Passenger Fee</th>
                    <th>Driver Fee</th>
                    <th>Net Amount</th>
                    <th>Vat(%)</th>
                    <th>Vat Amount</th>
                    <th>Grand Total</th>
                    <th>Branch</th>
                    <th>Created By</th>
                    <th>{{ __('home.action') }}</th>
                  </tr>
                </thead>
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
{!!Html::script('custom/yajraTableJs/jquery.js')!!}
<script>
   // ==================== date format ===========
   function dateFormat(data) { 
    let date, month, year;
    date = data.getDate();
    month = data.getMonth() + 1;
    year = data.getFullYear();

    date = date
        .toString()
        .padStart(2, '0');

    month = month
        .toString()
        .padStart(2, '0');

    return `${date}-${month}-${year}`;
  }
	$(document).ready(function() {
		'use strict';
      var table = $('#example').DataTable({
			serverSide: true,
			processing: true,
      deferRender : true,
			ajax: "{{route('tarrif-calculation.index')}}",
      "lengthMenu": [[ 100, 150, 250, -1 ],[ '100', '150', '250', 'All' ]],
      dom: 'Blfrtip',
        buttons: [
            'copy',
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5,6,7,8,9,10,11,12,13]
                },
                messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
            },
            {
                extend: 'print',
                title:"",
                messageTop: function () {
                  var top = '<center><p class ="text-center"><img src="{{asset("logo")}}/logo.png" width="40px" height="40px"/></p></center>';
                  top += '<center><h3>PPPO</h3></center>';
                  
                  return top;
                },
                customize: function (win){
                $(win.document.body).addClass('white-bg');
                $(win.document.body).css('font-size', '10px');
 
                $(win.document.body).find('table').css('font-size', 'inherit');
 
                $(win.document.body).find('table thead th').css('border','1px solid #ddd');  
                $(win.document.body).find('table tbody td').css('border','1px solid #ddd');  
                $(win.document.body).css("height", "auto").css("min-height", "0");
                },
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5,6,7,8,9,10,11,12,13]
                },
                messageBottom: null
            }
        ],
			aaSorting: [[0, "asc"]],

			columns: [
        {
          data: 'DT_RowIndex',
        },
				{
          data: 'tarrif.name',
        },
				{
          data: 'basic',
        },
				{
          data: 'act_laibility',
        },
				{
          data: 'per_passenger_fee',
        },
				{
          data: 'passenger',
        },
				{
          data: 'passenger',
          render:function(data,type,row){
            return (Math.round(row.per_passenger_fee) * Math.round(row.passenger)).toFixed(2);
          }
        },
				{
          data: 'driver_fee',
        },
				{
          data: 'net_amount',
        },
				{
          data: 'vat_percent',
        },
				{
          data: 'vat_percent',
          render:function(data,type,row){
            return (Math.round((row.net_amount * row.vat_percent)/100)).toFixed(2);
          }
        },
				{
          data: 'net_amount',
          render:function(data,type,row){
            return ( Math.round( parseFloat(data) + (parseFloat(data * row.vat_percent)/100))).toFixed(2);
          }
        },
				{
          data: 'branch.name',
        },
				{
          data: 'user.name',
        },
				{
          data: 'action',
        }
			]
    });
     //-------- Delete single data with Ajax --------------//
     $("#example").on("click", ".button-delete", function(e) {
			e.preventDefault();

			var confirm = window.confirm('Are you sure want to delete data?');
			if (confirm != true) {
				return false;
			}
			var id = $(this).data('id');
			var url = '{{route("product.destroy",":id")}}';
			var url = url.replace(':id', id);
			var token = '{{csrf_token()}}';
			$.ajax({
				url: url,
				type: 'POST',
				data: {
					'_method': 'DELETE',
					'_token': token
				},
				success: function(data) {
					table.ajax.reload();
					console.log('success');
				},

			});
    });
});
</script>
@endsection 