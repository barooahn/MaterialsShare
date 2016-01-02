@extends('layouts.create')
{{-- Web site Title --}}
@section('title') Create Material @stop

@section('body-id')
    "create_times"
@endsection

{{-- Content --}}
@section('content')
    <div class="row center_form">
        <div class="col-md-8 col-md-offset-2">

            <h1 class="white_text">{{$material->title}}</h1>
            <hr>

            {!! Form::open(['action' => 'MaterialsController@createTimes', 'files' => true]) !!}


            <div class="form-group white_text">

                {!! Form::hidden('material', $material->id) !!}

                <div class="form_padding">
                    {!! Form::label('target_language', 'Target Language:', array('class' => 'white_text')) !!}
                    {!! Form::text('target_language', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form_padding">
                    {!! Form::label('time_needed_prep', 'Time Needed For Preparation (mins):', array('class' => 'white_text')) !!}
                    {!! Form::text('time_needed_prep', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form_padding">
                    {!! Form::label('time_needed_class', 'Time Needed in Class (mins):', array('class' => 'white_text')) !!}
                    {!! Form::text('time_needed_class', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form_padding">
                    {!! Form::label('materials', 'Materials needed:', array('class' => 'white_text')) !!}
                    {!! Form::text('materials', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form_padding">
                    {!! Form::label('procedure_before', 'Procedure before the class:', array('class' => 'white_text')) !!}
                    {!! Form::textarea('procedure_before', null, ['class' => 'form-control form-wysyg']) !!}
                </div>
                <div class="form_padding">
                    {!! Form::label('procedure_in', 'Procedure in class:', array('class' => 'white_text')) !!}
                    {!! Form::textarea('procedure_in', null, ['class' => 'form-control form-wysyg']) !!}
                </div>
            </div>
            <div class="control-group">
                <div class="controls white_text">
                    {!! Form::file('images[]', array('multiple'=>true, 'class' => 'file_input')) !!}
                    <p class="errors">{!!$errors->first('images')!!}</p>
                    @if(Session::has('error'))
                        <p class="errors">{!! Session::get('error') !!}</p>
                    @endif
                </div>
            </div>


            <div class="form-group">

                {!! Form::submit('continue', ['class' => 'btn btn-primary btn-large form-control']) !!}

            </div>
            {!! Form::close() !!}

        </div>
    </div>

@stop

@section('scripts')

    <script>
        tinymce.init({
            selector: '.form-wysyg',
            menubar: false,
            statusbar: false
        });
    </script>

    <script>
        $(".file_input").fileinput({'showPreview':false, showUpload:false});
    </script>

@stop
