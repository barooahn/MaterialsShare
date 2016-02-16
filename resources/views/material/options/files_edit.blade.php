<div class="control-group">
    @if($material->files->count())
        @foreach($material->files as $file)
            <div class="form_padding">
                <img class="material_image"
                     src="{{url('/images/'.  pathinfo($file->filename, PATHINFO_FILENAME).'.jpg')}}"
                     title="{{$file->filename}}">

                <div class="form_padding">
                    <a class="btn btn-danger btn-large form-control "
                       href="{{ URL::route('remove_file', array('file' => $file)) }}">Delete</a>
                </div>
            </div>
            <hr>
        @endforeach
    @endif
    <div class="controls white_text">
        {!! Form::label('files', 'Choose files to upload below:') !!}

        {!! Form::file('upload_files[]', array('multiple'=>true, 'class' => 'file_input')) !!}
        <p class="errors">{!!$errors->first('upload_files')!!}</p>
        @if(Session::has('error'))
            <p class="errors">{!! Session::get('error') !!}</p>
        @endif
    </div>
</div>