<div class="form-group {{ $errors->has('position') ? 'has-error' : ''}}">
    <label for="position" class="control-label">{{ 'Position' }}</label>
    <input class="form-control" name="position" type="text" id="position" value="{{ isset($position->position) ? $position->position : ''}}" >
    {!! $errors->first('position', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('order') ? 'has-error' : ''}}">
    <label for="order" class="control-label">{{ 'Order' }}</label>
    <input class="form-control" name="order" type="number" id="order" value="{{ isset($position->order) ? $position->order : ''}}" >
    {!! $errors->first('order', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('is_ssg') ? 'has-error' : ''}}">
    <label for="is_ssg" class="control-label">{{ 'Is Ssg' }}</label>
    <div class="radio">
    <label><input name="is_ssg" type="radio" value="1" {{ (isset($position) && 1 == $position->is_ssg) ? 'checked' : '' }}> Yes</label>
</div>
<div class="radio">
    <label><input name="is_ssg" type="radio" value="0" @if (isset($position)) {{ (0 == $position->is_ssg) ? 'checked' : '' }} @else {{ 'checked' }} @endif> No</label>
</div>
    {!! $errors->first('is_ssg', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
