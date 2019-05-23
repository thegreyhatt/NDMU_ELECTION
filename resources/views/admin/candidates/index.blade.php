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
                    <div class="card-header">Candidates</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/candidates/create') }}" class="btn btn-success btn-sm" title="Add New Candidate">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/admin/candidates') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 pull-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th><th>Profile Pic</th><th>Name</th><th>College</th><th>Position</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($candidates as $item)
                                    <tr>
                                        <td>{{ $item->id_num}}</td> 
                                        
                                        <td>      <img class="img-rounded circle" width="100px" height="100px" src="{{asset('image/'.$item->profile_pic)}}" alt=""></td>
                                        <td>{{ $item->student->name }}</td><td>{{ $item->college->college }}</td><td>{{ $item->position->position }}</td>
                                        <td>
                                            <a href="{{ url('/admin/candidates/' . $item->id) }}" title="View Candidate"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/candidates/' . $item->id . '/edit') }}" title="Edit Candidate"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/candidates' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Candidate" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $candidates->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
