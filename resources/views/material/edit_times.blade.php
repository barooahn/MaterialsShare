@extends('layouts.edit')
{{-- Web site Title --}}
@section('title') {!!  $material->title !!} :: @parent @stop

@section('body-id')
    "edit_times"
@endsection

{{-- Content --}}
@section('content')
    <div class="row center_form">
        <div class="col-md-8 col-md-offset-2">

            <h1 class="white_text">{{$material->title}}</h1>
            <hr>


            {!! Form::model($material, [
                'method' => 'PATCH',
                'files' => true,
                'route' => ['material.update_times', $material->id]
            ]) !!}

            <div class="form-group">

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
            <div class="form-group">

                {!! Form::submit('update', ['class' => 'btn btn-primary btn-large form-control']) !!}

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

@stop
