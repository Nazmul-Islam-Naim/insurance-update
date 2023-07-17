@extends('layouts.layout')
@section('title', 'Marine Cargo Insurance')
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
      @if(!empty($single_data))
        {!! Form::open(array('route' =>['marine-cargo-insurance.update', $single_data->id],'method'=>'PUT','files'=>true)) !!}
        <?php $info ="Edit";?>
      @else
      {!! Form::open(array('route' =>['marine-cargo-insurance.store'],'method'=>'POST','files'=>true)) !!}
        <?php $info ="Add";?>
        <div class="row">
          
      <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
        @endif
        <div class="card">
          <div class="card-header">
            <div class="card-title">{{$info}}  Marine Cargo Insurance</div>
          </div>
          <div class="card-body">
            <!-- Row start -->
            <div class="row gutters">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row">
                  <div class="col-md-10">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <select name="client_id" class="form-control select-single js-state @error('client_id') is-invalid @enderror" data-live-search="true" required> 
                          <option value="">Select</option>
                          @foreach($allclient as $client)
                          <option value="{{$client->id}}" {{((!empty($clientId) && ($client->id == $clientId)) || (old('client_id') == $client->id)) ? 'selected' : ''}}>{{$client->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="field-placeholder">Client Name<span class="text-danger">*</span></div> {{!empty($clientId) ? $clientId : '22'}}
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <div class="col-md-2">
                    <a href="#addClient" class="form-control btn btn-primary" data-bs-toggle="modal" style="margin-top: 8px"><i class="icon-plus-circle"></i></a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-10">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                      <div class="input-group">
                        <select name="bank_id" class="form-control select-single js-state @error('bank_id') is-invalid @enderror" data-live-search="true" required> 
                          <option value="">Select</option>
                          @foreach($allbank as $bank)
                          <option value="{{$bank->id}}" {{((!empty($single_data) && ($bank->id == $single_data->bank_id)) || (old('bank_id') == $bank->id)) ? 'selected' : ''}}>{{$bank->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="field-placeholder">Bank Name<span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->
                  </div>
                  <div class="col-md-2">
                    <a href="#addBank" class="form-control btn btn-primary" data-bs-toggle="modal" style="margin-top: 8px"><i class="icon-plus-circle"></i></a>
                  </div>
                </div>
                
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="voyage_via_id" class="form-control select-single js-state @error('voyage_via_id') is-invalid @enderror" data-live-search="true" required> 
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
            {{-- <button class="btn btn-primary" type="submit">{{$info}}</button> --}}
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
        <div class="card">
          <div class="card-header">
            <div class="card-title">{{$info}}  Marine Cargo Insurance</div>
          </div>
          <div class="card-body">
            <!-- Row start -->
            <div class="row gutters">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <select name="client_id" class="form-control select-single js-state @error('client_id') is-invalid @enderror" data-live-search="true" required> 
                      <option value="">Select</option>
                      @foreach($allclient as $client)
                      <option value="{{$client->id}}" {{((!empty($single_data) && ($client->id == $single_data->client_id)) || (old('client_id') == $client->id)) ? 'selected' : ''}}>{{$client->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="field-placeholder">Client Name<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <div class="input-group">
                    <input  type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{(!empty($single_data->name))?$single_data->name: old('name')}}" required="" autocomplete="off">
                  </div>
                  <div class="field-placeholder">{{ __('home.name') }} <span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
              </div>
            </div>
            <!-- Row end -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            {{-- <button class="btn btn-primary" type="submit">{{$info}}</button> --}}
          </div>
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

 <!-- Start Modal for client -->
 <div class="modal fade" id="addClient" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="icon-plus-circle"></i> Add Client Informations</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      {!! Form::open(array('route' =>['add-marine-client'],'method'=>'POST','files'=>true)) !!}
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <!-- Field wrapper start -->
            <div class="field-wrapper">
              <div class="input-group">
                <input  type="text" name="name"
                class="form-control @error('name') is-invalid @enderror" 
                value="{{ old('name') }}" required="" autocomplete="off">
              </div>
              <div class="field-placeholder">Name <span class="text-danger">*</span></div>
            </div>
            <!-- Field wrapper end -->
            <!-- Field wrapper start -->
            <div class="field-wrapper">
              <div class="input-group">
                <input  type="text" name="phone"
                class="form-control @error('phone') is-invalid @enderror" 
                value="{{old('phone')}}" required="" autocomplete="off">
              </div>
              <div class="field-placeholder">Phone <span class="text-danger">*</span></div>
            </div>
            <!-- Field wrapper end -->
            <!-- Field wrapper start -->
            <div class="field-wrapper">
              <div class="input-group">
                <input class="form-control" type="text" name="email"
                class="form-control @error('email') is-invalid @enderror"  
                value="{{old('email')}}"  autocomplete="off">
              </div>
              <div class="field-placeholder">E-mail </div>
            </div>
            <!-- Field wrapper end -->
            <!-- Field wrapper start -->
            <div class="field-wrapper">
              <div class="input-group">
              <textarea name="address"  class="form-control @error('address') is-invalid @enderror"  style="height:40px" required="">{{old('address')}}</textarea>
              </div>
              <div class="field-placeholder">Address <span class="text-danger">*</span></div>
            </div>
            <!-- Field wrapper end -->
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
        {{Form::submit('Save',array('class'=>'btn btn-success btn-sm', 'style'=>'width:15%'))}}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
<!-- End Modal for edit cheque book -->

 <!-- Start Modal for bank -->
 <div class="modal fade" id="addBank" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="icon-plus-circle"></i> Add Bank Informations</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      {!! Form::open(array('route' =>['add-marine-bank'],'method'=>'POST','files'=>true)) !!}
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
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
                <input  type="text" name="branch"
                class="form-control @error('branch') is-invalid @enderror" 
                value="{{(!empty($single_data->branch))?$single_data->branch:old('branch')}}" required="" autocomplete="off">
              </div>
              <div class="field-placeholder">Branch <span class="text-danger">*</span></div>
            </div>
            <!-- Field wrapper end -->
            <!-- Field wrapper start -->
            <div class="field-wrapper">
              <div class="input-group">
               <textarea name="address"  class="form-control @error('address') is-invalid @enderror"  style="height:40px" required="">{{(!empty($single_data->address))?$single_data->address:old('address')}}</textarea>
              </div>
              <div class="field-placeholder">Address <span class="text-danger">*</span></div>
            </div>
            <!-- Field wrapper end -->
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
        {{Form::submit('Save',array('class'=>'btn btn-success btn-sm', 'style'=>'width:15%'))}}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
<!-- End Modal for edit cheque book -->
@endsection 