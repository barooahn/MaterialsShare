<div class="control-group">

    <div class="controls">
        {!! Form::label('files', 'Choose files to upload below:') !!}

        {!! Form::file('images[]', array('multiple'=>true, 'class' => 'file_input')) !!}
        <p class="errors">{!!$errors->first('images')!!}</p>
        @if(Session::has('error'))
            <p class="errors">{!! Session::get('error') !!}</p>
        @endif
    </div>
</div>