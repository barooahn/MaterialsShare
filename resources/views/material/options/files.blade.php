<div class="control-group">

    <div class="controls">
        {!! Form::label('files', 'Choose files to upload below:') !!}


        {{--{!! Form::file('upload_files[]', array('multiple'=>true, 'class' => 'file_input ', 'placeholder' => 'browser for files')) !!}--}}

        <p class="errors">{!!$errors->first('images')!!}</p>
        @if(Session::has('error'))
            <p class="errors">{!! Session::get('error') !!}</p>
        @endif
    </div>


    <div class="dropzone" id="dropzoneFileUpload">
    </div>

</div>