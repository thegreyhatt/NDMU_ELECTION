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
                    <div class="card-header">Positions</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/positions/create') }}" class="btn btn-success btn-sm" title="Add New Position">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/admin/positions') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 pull-right" role="search">
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
                                        <th>#</th><th>Position</th><th>Order</th><th>SSG Position</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($positions as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->position }}</td><td>{{ $item->order }}</td><td>
                                        @if ($item->is_ssg == 1)
                                            Yes
                                        @else
                                            No
                                        @endif    
                                            
                                        
                                        </td>
                                        <td>
                                            <a href="{{ url('/admin/positions/' . $item->id) }}" title="View Position"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/positions/' . $item->id . '/edit') }}" title="Edit Position"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/positions' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Position" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $positions->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
