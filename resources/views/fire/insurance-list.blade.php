@extends('layouts.layout')
@section('title', 'Insurance List')
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
            <div class="card-title">Fire Insurance List</div>
            <a href="{{route('fire-insurance.create')}}" class="btn btn-sm btn-primary"><i class="icon-plus-circle"></i>Add Insurance</a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <!--<table id="dataTable" class="table v-middle">-->
              <table id="example" class="table custom-table">
                <thead>
                  <tr>
                    <th>{{ __('home.SL') }}</th>
                    <th>Date</th>
                    <th>Code</th>
                    <th>Client Name</th>
                    <th>Bank Name</th>
                    <th>Premium</th>
                    <th>Discount(%)</th>
                    <th>Discount</th>
                    <th>Net Premium</th>
                    <th>Vat (15%)</th>
                    <th>Total</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
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
{!!Html::script('custom/yajraTableJs/jquery.js')!!}
<script>
   // ==================== date format ===========
   function dateFormat(data) { 
    console.log(data);
    let date, month, year;
    date = data.getDate();
    month = data.getMonth()+1;
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
			ajax: "{{route('fire-insurance.index')}}",
      "lengthMenu": [[ 100, 150, 250, -1 ],[ '100', '150', '250', 'All' ]],
      dom: 'Blfrtip',
        buttons: [
            'copy',
            {
                extend: 'excel',
                exportOptions: {
                    columns: [  0, 1, 2, 3,4,5,6,7,8,9,10]
                },
                messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
            },
            {
                extend: 'print',
                title:"",
                messageTop: function () {
                  var top = '<center><p class ="text-center"><img src="{{asset("upload/logo/")}}/header.png" height="60px"/></p></center>';
                  
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
                  columns: [  0, 1, 2, 3,4,5,6,7,8,9,10]
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
          data: 'period_from',
          render: function(data, display, row) {
						if (data != null) {
							return dateFormat(new Date(data)).toString();
						}
					}
        },
        {
          data: 'insurance_code',
          render:function(data, display, row){
            var url = '{{route("fire-invoice",":id")}}';
            var url = url.replace(':id', row.id);
            return '<a href=' + url +'>'+ data +'</a>';
          }
        },
				{
          data: 'client.name',
        },
				{
          data: 'bank.name',
          render:function(data, display, row){
            return data + ' (' + row.bank.branch + ')';
          }
        },
				{
          data: 'fire_additional_perils_detail',
          render:function(data, display, row){
            var perils = 0;
            var total = 0;
            data.forEach(loop => {
              perils = (loop.amount * loop.premium_rate)/100;
              total += perils;
            });
            return  (Math.round(parseFloat(row.account_info_fire_insurance.amount_in_bdt)) + Math.round(total)).toFixed(2);
          }
        },
				{
          data: 'account_info_fire_insurance.discount_percent',
        },
				{
          data: 'account_info_fire_insurance.discount_amount',
        },
				{
          data: 'account_info_fire_insurance.net_premium',
        },
				{
          data: 'account_info_fire_insurance.vat_amount',
        },
				{
          data: 'account_info_fire_insurance.grand_total',
        },
        {
          data: 'action',
        },
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
			var url = '{{route("fire-insurance.destroy",":id")}}';
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