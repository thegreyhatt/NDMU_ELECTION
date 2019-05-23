<div class="form-group {{ $errors->has('college') ? 'has-error' : ''}}">
    <label for="college" class="control-label">{{ 'College' }}</label>
    <input class="form-control" name="college" type="text" id="college" value="{{ isset($college->college) ? $college->college : ''}}" >
    {!! $errors->first('college', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Description' }}</label>
    <textarea class="form-control" rows="5" name="description" type="textarea" id="description" >{{ isset($college->description) ? $college->description : ''}}</textarea>
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
