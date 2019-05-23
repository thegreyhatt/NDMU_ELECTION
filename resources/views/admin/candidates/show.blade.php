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
                    <div class="card-header">Candidate {{ $candidate->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/candidates') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/candidates/' . $candidate->id . '/edit') }}" title="Edit Candidate"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/candidates' . '/' . $candidate->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Candidate" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $candidate->id_num }}</td>
                                    </tr>
                                    <tr><th> Profile Pic </th>
                                        <td>
                                            <img class="img-rounded circle" width="100px" height="100px" src="{{asset('image/'.($item->profile_pic))}}" alt="">
                                        </td>
                                    
                                    
                                    </tr><tr><th> Name </th><td> {{ $candidate->student->name }} </td></tr><tr><th> College </th><td> {{ $candidate->college->college }} </td></tr><tr><th> Position </th><td> {{ $candidate->position->position }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
