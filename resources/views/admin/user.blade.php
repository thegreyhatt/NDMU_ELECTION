@extends('adminlte::page')
{{-- @section('adminlte_css')

@endsection --}}

@section('content')
  @if (session()->has('error'))
      <div class="alert alert-danger alert-block">
        <button type="button" name="button" class="close" data-dismiss="alert">X</button>
      <strong>{{session()->get('error')}}</strong>
      </div>
      @elseif (session()->has('message'))
      <div class="alert alert-success alert-block">
        <button type="button" name="button" class="close" data-dismiss="alert">X</button>
        <strong>{{session()->get('message')}}</strong>
      </div>
  @endif
  <div class="box">
    <div class="portlet light">
      <div class="portlet-body">
        <div class="tabbable-custom nav-justified">
          <ul class="nav nav-tabs nav-justified">
            <li class="active">
              <a href="#detail" data-toggle="tab"><i class="fa fa-user"></i>Details</a>
            </li>
            <li>
              <a href="#email" data-toggle="tab"><i class="fa fa-envelope"></i>Email</a>
            </li>
            <li>
              <a href="#password" data-toggle="tab"><i class="fa fa-lock"></i>Password</a>
            </li>
          </ul>

          <div class="tab-content">

            <div class="tab-pane active" id="detail">
              <div class="portlet-body form">
                <div class="row">
                  <div class="col-md-6">
                    <form role="form" class="form-horizontal">
                      <div class="form-body">

                        <div class="form-group form-md-line-input">
                        <label class="col-md-3 control-label">Name</label>
                        <div class="col-md-9">
                          <div class="form-control form-control-static">
                                {{$user->name}}
                              <div class="form-control-focus"></div>
                            </div>
                          </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label">Email</label>
                            <div class="col-md-9">
                              <div class="form-control form-control-static">
                                    {{$user->email}}
                                  <div class="form-control-focus"></div>
                                </div>
                              </div>
                            </div>

                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane" id="email">
                <div class="portlet-body form">
                  <div class="row">
                    <div class="col-md-6">
                      <form action="{{route('newEmail')}}" method="post" class="form-horizontal">
                          {!! csrf_field() !!}
                        <div class="form-body">

                          <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="[object Object]">New Email</label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" name="email" value="">
                                <div class="form-control-focus"></div>
                            </div>
                          </div>
                          
                          <div class="form-group form-md-line-input">
                              <label class="col-md-3 control-label" for="[object Object]">Current Password</label>
                              <div class="col-md-9">
                                  <input type="password" class="form-control" name="currentPassword" value="">
                                  <div class="form-control-focus"></div>
                                  <span class="help-block">Old Password</span>
                              </div>
                            </div>

                          <div class="form-actions">
                            <div class="row">
                              <div class="col-md-offset-2 col-md-9">
                                <button type="submit" class="btn green">Save</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="password">
                  <div class="portlet-body form">
                    <div class="row">
                      <div class="col-md-6">
                      <form action="{{route('newPassword')}}" method="post" role="form" class="form-horizontal">
                          {!! csrf_field() !!}
                        <div class="form-body">
                            
                              <div class="form-group form-md-line-input">
                                  <label class="col-md-3 control-label" for="[object Object]">Old Password</label>
                                  <div class="col-md-9">
                                      <input type="password" class="form-control" name="currentPassword" value="">
                                      <div class="form-control-focus"></div>
                                      <span class="help-block">Old Password</span>
                                  </div>
                                </div>
                                
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="[object Object]">New Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="newPassword" value="">
                                        <div class="form-control-focus"></div>
                                    </div>
                                  </div>

                                  <div class="form-group form-md-line-input">
                                      <label class="col-md-3 control-label" for="[object Object]">Password Confirmation</label>
                                      <div class="col-md-9">
                                          <input type="password" class="form-control" name="passwordConfirmation" value="">
                                          <div class="form-control-focus"></div>
                                      </div>
                                    </div>
                                    <div class="form-actions">
                                      <div class="row">
                                        <div class="col-md-offset-2 col-md-9">
                                          <button type="submit" class="btn green" name="button">Save</button>
                                        </div>
                                      </div>
                                    </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('css')
  <link rel="icon" href="{!! asset('images/ndmu_logo.ico') !!}"/>
  <link rel="stylesheet" href="{{asset('css/global.css')}}">
@endsection