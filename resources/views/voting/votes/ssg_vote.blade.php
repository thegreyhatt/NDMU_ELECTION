@extends('layouts.app')

@section('css')
    <style>
    .thumbnail {
    background: #fff;
    }
    .active {
  background-color: skyblue !important;
}
    </style>
    
@endsection

@section('content')
{{-- {{dd($candidates->where('position_id','=',array_search('President', $positions))->count())}} --}}
    <div class="container">
        
            @include('admin.sidebar')
            {{-- <hr style="height:2px;border:none;color:gray;background-color:gray;" /> --}}
            <form method="POST" action="{{ url('/voting/votes/ssg') }}" accept-charset="UTF-8" class="form-group" enctype="multipart/form-data">
                {{ csrf_field() }}
                @section('office')
                - SSG
                @endsection
            @foreach ($positions as $position)
              <div class="btn-group-toggle" data-toggle="buttons">
            <div class="row">
                    
                @php
                    $count = 0;
                @endphp
                @php
                    $col = $candidates->where('position_id','=',array_search($position, $positions))->count();
                @endphp
                @if ($col!=0)
                   <h1 class="text-center">{{$position}}</h1>
                @endif
                @if ($col<6)
                    @php
                        $col = floor((12-$col*2)/2);
                    @endphp
                @endif
                @php ($flag = 0) @endphp
              
                @foreach($candidates as $candidate)
                    @if($candidate->position->position == $position)
                        @if ($count == 6)
                            <br>
                        @endif
                        @if ($col<6 && $flag !=1)
                            <div class="col-md-2 col-md-offset-{{$col}}">
                            @php ($flag = 1) @endphp
                        @else
                            <div class="col-md-2">
                        @endif
                        
                            <div class="thumbnail text-center">
                                    <img class="img-rounded circle" width="100px" height="100px" src="{{asset('image/'.$candidate->profile_pic)}}" alt=""></td>
                                    <br>
                                    {{$candidate->student->name}}<br>
                                    
                                        @if ($position!= end($positions) )
                                            <label class="btn btn-primary" name="{{$position}}" >
                                                <input type="radio" name="{{$position}}" id="{{$position}}" value="{{$candidate->id}}" 
                                                autocomplete="off" style="display: none;"> Vote
                                            </label>
                                        @else
                                            <label class="btn btn-primary" name="{{$position}}" id="hello{{$candidate->id}}">
                                                <input type="checkbox" class="radio"
                                                    value="{{$candidate->id}}" name="{{$position}}[{{$candidate->id}}]" style="display: none;">Vote
                                            </label>
                                        @endif
                            </div>
                        </div> 
                        @php
                            $count++;
                        @endphp
                    @endif
                @endforeach
            </div>
                {{-- <hr> --}}
            
                    </div>
            @endforeach
        
            <div style=" margin-top: 50px;"></div>
            <input class="btn btn-primary btn-block rounded-0 pull-right btn-lg" onclick="return confirmation();" id="proceed" type="submit" value="Proceed">
    </div>
</form>
@endsection

@section('js')
<script type="text/javascript">

function confirmation(){
    if(confirm('Do you want to submit votes for ssg?')){
        document.getElementById('proceed').submit();
    }else{
        return false;
    }   
};


</script>

@endsection