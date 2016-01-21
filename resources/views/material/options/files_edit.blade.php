<div class="control-group">
    @if($material->files->count())
        @foreach($material->files as $file)
            <div class="form_padding">
                <img class="material_image" src="{{ asset($file->thumb_path)  }}">

                <div class="form_padding">
                    <a class="btn btn-danger btn-large form-control "
                       href="{{ URL::route('material.destroy_file', array('file' => $file)) }}">Delete</a>
                </div>
            </div>
            <hr>
        @endforeach
    @endif
    <div class="controls white_text">
        {!! Form::label('files', 'Choose files to upload below:', array('class' => 'white_text')) !!}

        {!! Form::file('images[]', array('multiple'=>true, 'class' => 'file_input')) !!}
        <p class="errors">{!!$errors->first('images')!!}</p>
        @if(Session::has('error'))
            <p class="errors">{!! Session::get('error') !!}</p>
        @endif
    </div>
</div>