<div class="form-group {{ $errors->has('partylist') ? 'has-error' : ''}}">
    <label for="partylist" class="control-label">{{ 'Partylist' }}</label>
    <input class="form-control" name="partylist" type="text" id="partylist" value="{{ isset($partylist->partylist) ? $partylist->partylist : ''}}" >
    {!! $errors->first('partylist', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Description' }}</label>
    <textarea class="form-control" rows="5" name="description" type="textarea" id="description" >{{ isset($partylist->description) ? $partylist->description : ''}}</textarea>
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('college') ? 'has-error' : ''}}">
    <label for="college" class="control-label">{{ 'College' }}</label>
    <select name="college" class="form-control" id="college" >
    @foreach (json_decode('option={}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($partylist->college) && $partylist->college == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
    {!! $errors->first('college', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
