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
                    <div class="card-header">PartyList {{ $partylist->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/party-lists') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/party-lists/' . $partylist->id . '/edit') }}" title="Edit PartyList"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/partylists' . '/' . $partylist->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete PartyList" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $partylist->id }}</td>
                                    </tr>
                                    <tr><th> Partylist </th><td> {{ $partylist->partylist }} </td></tr><tr><th> Description </th><td> {{ $partylist->description }} </td></tr><tr><th> College </th><td> {{ $partylist->college }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
