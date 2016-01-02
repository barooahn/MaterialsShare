@extends('layouts.edit')
{{-- Web site Title --}}
@section('title') {!!  $material->title !!} :: @parent @stop

@section('body-id')
    "create"
@endsection

{{-- Content --}}
@section('content')
    <div class="row center_form">
        <div class="col-md-8 col-md-offset-2">

            <h1 class="white_text">{{$material->title}}</h1>
            <hr>
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



            {!! Form::model($material, [
                'method' => 'PATCH',
                'files' => true,
                'route' => ['material.update_file', $material->id]
            ]) !!}

            <div class="form-group">

                {!! Form::hidden('material', $material->id) !!}


            </div>
            <div class="control-group">
                <div class="controls">

                    {!! Form::file('images[]', array('multiple'=>true, 'class' => 'file_input')) !!}
                    <p class="errors">{!!$errors->first('images')!!}</p>
                    @if(Session::has('error'))
                        <p class="errors">{!! Session::get('error') !!}</p>
                    @endif
                </div>
            </div>

            <div class="form-group">

                {!! Form::submit('update', ['class' => 'btn btn-primary btn-large form-control']) !!}

            </div>
            {!! Form::close() !!}
        </div>
    </div>



@stop
@section('scripts')
    <script>
        $(".file_input").fileinput({'showPreview':false, showUpload:false});
    </script>


@stop

