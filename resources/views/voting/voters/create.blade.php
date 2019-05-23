@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-primary">
                            <div class="panel-heading custom-header-panel">
                                <h3 class="panel-title">Enter Voting Details</h3>
                            </div>
                            <div class="panel-body">
                        {{-- @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif --}}
                        @if (!empty($flash_message))
                                <ul class="alert alert-success">
                                        <li>{{ $flash_message}}</li>
                                </ul>
                        @endif
                       
                        
                            <form method="POST" action="{{ url('/voting/votes') }}" accept-charset="UTF-8" class="form-group" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @include ('voting.voters.form', ['formMode' => 'create'])
                            </form>
                            
                </div>
            </div>
    </div>
@endsection
