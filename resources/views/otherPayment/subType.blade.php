@extends('layouts.layout')
@section('title', 'Expense Sub Type')
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
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">{{ __('menu.add_other_expense_sub_type') }}</h3>
          </div>
          <!-- /.card-header -->
          {!! Form::open(array('route' =>['payment-sub-type.store'],'method'=>'POST')) !!}
          <div class="card-body">
            <div class="field-wrapper">
              <div class="input-group">
                <input class="form-control" type="text" name="name" value="" required="" autocomplete="off">
              </div>
              <div class="field-placeholder">{{ __('menu.other_expense_sub_type') }} <span class="text-danger">*</span></div>
            </div>
            <div class="field-wrapper">
              <div class="input-group">
                <select class="form-control select2" name="payment_type_id" required="">
                  <option value="">--Select--</option>
                  @foreach($alltype as $type)
                  <option value="{{$type->id}}">{{$type->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="field-placeholder">{{ __('menu.other_expense_type') }} <span class="text-danger">*</span></div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
      
      <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">{{ __('menu.expense_sub_type_list') }}</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
              <table id="basicExample" class="table custom-table">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>{{ __('menu.other_expense_sub_type') }}</th>
                    <th>{{ __('menu.other_expense_type') }}</th>
                    <th>{{ __('home.status') }}</th>
                    <th>{{ __('home.action') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <?php                           
                    $number = 1;
                    $numElementsPerPage = 15; // How many elements per page
                    $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
                    $rowCount = 0;
                  ?>
                  @foreach($alldata as $data)
                  <?php $rowCount++; ?>
                  <tr>
                    <td>{{$currentNumber++}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->paymentsubtype_type_object->name}}</td>
                    <td>
                      @if ($data->status == 1)
                      <span class="badge bg-primary">Active</span>
                      @elseif ($data->status == 0)
                      <span class="badge bg-warning">Inactive</span>
                      @endif
                    </td>
                    <td>
                      <div class="actions" style="height: 25px">
                        <a href="#editModal{{$data->id}}" data-bs-toggle="modal" style="padding: 1px 15px"><i class="icon-edit1 text-info"></i></a>
                        {{Form::open(array('route'=>['payment-sub-type.destroy',$data->id],'method'=>'DELETE'))}}
                          <button type="submit" class="btn btn-default btn-xs confirmdelete" confirm="You want to delete this informations ?" title="Delete" style="width: 100%"><i class="icon-x-circle text-danger"></i></button>
                        {!! Form::close() !!}
                      </div>

                      <!-- Start Modal for edit Expense Sub Type -->
                      <div class="modal fade" id="editModal{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title"><i class="fa fa-edit"></i> {{ __('menu.edit_other_expense_sub_type') }}</h4>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            {!! Form::open(array('route' =>['payment-sub-type.update', $data->id],'method'=>'PUT')) !!}
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="field-wrapper">
                                    <div class="input-group">
                                      <input class="form-control" type="text" name="name" value="{{$data->name}}" required="" autocomplete="off">
                                    </div>
                                    <div class="field-placeholder">{{ __('menu.other_expense_sub_type') }} <span class="text-danger">*</span></div>
                                  </div>
                                  <div class="field-wrapper">
                                    <div class="input-group">
                                      <select class="form-control" name="payment_type_id" required="">
                                        <option value="">Select</option>
                                        @foreach($alltype as $type)
                                        <option value="{{$type->id}}" {{($type->id==$data->payment_type_id)? 'selected':''}}>{{$type->name}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                    <div class="field-placeholder">{{ __('menu.other_expense_type') }} <span class="text-danger">*</span></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                              {{Form::submit('Update',array('class'=>'btn btn-success btn-sm', 'style'=>'width:15%'))}}
                            </div>
                            {!! Form::close() !!}
                          </div>
                        </div>
                      </div>
                      <!-- End Modal for edit Expense Sub Type -->
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            {{$alldata->render()}}
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- Row end -->
  </div>
  <!-- Content wrapper end -->
</div>
<!-- Content wrapper scroll end -->
@endsection 