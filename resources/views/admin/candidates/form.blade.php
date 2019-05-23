<div class="form-group {{ $errors->has('profile_pic') ? 'has-error' : ''}}">
    <label for="profile_pic" class="control-label">{{ 'Profile Pic' }}</label>
    {{-- <input type="file" multiple accept='image/*'> --}}
    <input name="profile_pic"  multiple accept='image/*' type="file" id="profile_pic" value="{{ isset($candidate->profile_pic) ? $candidate->profile_pic : ''}}" >
    {!! $errors->first('profile_pic', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('id_num') ? 'has-error' : ''}}">
    <label for="id_num" class="control-label">{{ 'Id Num' }}</label>
    <input class="form-control" name="id_num" type="text" id="id_num" value="{{ isset($candidate->id_num) ? $candidate->id_num : ''}}" >
    {!! $errors->first('id_num', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('position') ? 'has-error' : ''}}">
    <br>Are you applying as SSG? <input type="checkbox" id="is_ssg" name="is_ssg" value="is_ssg"> <br>
    <br>
    <label for="position" class="control-label">{{ 'Position' }}</label>
    <select name="position_id" class="form-control" id="position_id" >
    {{-- @foreach ($positions  as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($candidate->position) && $candidate->position == $optionKey) ? 'selected' : ''}}>{{ $optionValue->position }}</option>
    @endforeach --}}
    {{-- <option "{{ (isset($candidate->position_id) ) ? 'value' : ''}}" {{ (isset($candidate->position->position)) ? 'selected' : ''}}>{{ $candidate->position->position}}</option> --}}
    <option value="">-- Check the check box--</option>
</select>
    {!! $errors->first('position', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('college') ? 'has-error' : ''}}">
    <label for="college" class="control-label">{{ 'College' }}</label>
    
    <select name="college_id" class="form-control" id="college_id" >
            @foreach ($colleges  as $optionKey => $optionValue)
             <option value="{{ $optionKey}}" {{ (isset($candidate->college_id) && $candidate->college_id == $optionKey ) ? 'selected' : ''}}>{{$optionValue}}</option>
        @endforeach
</select>
    {!! $errors->first('college', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('party_list') ? 'has-error' : ''}}">
    <label for="party_list" class="control-label">{{ 'Party List' }}</label>
    <select name="party_list_id" class="form-control" id="party_list_id" >
    @foreach ($party_lists as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($candidate->party_list_id) && $candidate->party_list_id == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
    {!! $errors->first('party_list', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>

@section('js')
    <script type="text/javascript">
        // function display() {

            
            var position_ssg = {};
                @foreach ($positions as $position)
                    @if($position->is_ssg==1)
                        position_ssg["{{$position->id}}"]="{{$position->position}}";
                    @endif
                @endforeach
                console.log(position_ssg);

            var position_not_ssg = {}
                @foreach ($positions as $position)
                    @if($position->is_ssg==0)
                     position_not_ssg["{{$position->id}}"]="{{$position->position}}";
                    @endif
                @endforeach
                
                console.log(position_not_ssg);
            $(document).ready(function() { addToList(); });
            $('#is_ssg').click(function(){
                addToList();
            });
            if({{ (!empty($candidate->position_id) ? json_encode($candidate->position_id) : '0') }}&& 
                {{(!empty($candidate->position->is_ssg) ? json_encode($candidate->position->is_ssg) : '0')}}){
                document.getElementById("is_ssg").checked = true;
            }else{
                document.getElementById("is_ssg").checked = false;
            }
            function addToList() { // Declare a function
                var is_check = document.getElementById("is_ssg").checked ;
                var position = {};
                    if(is_check){
                        Object.assign(position, position_ssg);
                    }else{
                        Object.assign(position, position_not_ssg);
                    }
                    console.log(position)
                    $('#position_id').empty();
                    $.each(position, function(i, p) {
                        $('#position_id').append($('<option></option>').val(i).html(p));
                    });
                    if({{(!empty($candidate->position_id) ? json_encode($candidate->position_id) : '0')}}){
                        document.getElementById('position_id').value = {{(!empty($candidate->position_id) ? json_encode($candidate->position_id) : '0')}};
                    }
            }
           
        // }

    </script>
@endsection