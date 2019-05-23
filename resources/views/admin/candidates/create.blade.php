@extends('adminlte::page')

@section('css')
  <link rel="icon" href="{!! asset('images/ndmu_logo.ico') !!}"/>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Create New Candidate</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/candidates') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />
                        <form method="POST" action="{{ url('/admin/candidates') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            @include ('admin.candidates.form', ['party_lists'=>$party_lists,'colleges'=>$colleges,'positions' => $positions,'formMode' => 'create' ])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
