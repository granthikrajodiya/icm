<div class="row">
    @foreach ($details as $key => $value)
        <div class="col-12 form-group">
            {{ Form::label($key, $key ,['class' => 'form-control-label']) }}
            {{ Form::text($key, $value, ['class' => 'form-control','disabled' => 'true']) }}
        </div>
    @endforeach
</div>
