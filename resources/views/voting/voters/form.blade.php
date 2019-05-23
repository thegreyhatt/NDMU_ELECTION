<div class="form-group {{ $errors->has('id_num') ? 'has-error' : ''}}">
    <label for="id_num" class="control-label">{{ 'ID Num' }}</label>
    <input class="form-control" name="id_num" type="text" id="id_num" value="{{ isset($voter->id_num) ? $voter->id_num : ''}}" >
    {!! $errors->first('id_num', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('party_list') ? 'has-error' : ''}}">
    <label for="party_list" class="control-label">{{ 'College' }}</label>
    <select name="college_id" class="form-control" id="college_id" >
            @foreach ($colleges  as $optionKey => $optionValue)
             <option value="{{ $optionKey}}" {{ (isset($candidate->college_id) && $candidate->college_id == $optionKey ) ? 'selected' : ''}}>{{ $optionValue}}</option>
        @endforeach
</select>
    {!! $errors->first('party_list', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" onclick="submitForm(this);" value="{{ $formMode === 'edit' ? 'Update' : 'Proceed' }}">
</div>

<script>
    function submitForm(btn) {
        // disable the button
        btn.disabled = true;
        // submit the form    
        btn.form.submit();
    }
</script>
