@extends('layouts.create')
{{-- Web site Title --}}
@section('title')Create Material @stop

@section('body-id')
    "test"
@endsection

{{-- Content --}}
@section('content')

    <div>
        <div class="col-md-12 center_form">
            <h1> Create a new material</h1>

            <p>Below are the minimum requirements to publish your material</p>
            <hr>
        </div>

        {!! Form::open(['action' => 'MaterialsController@postOptions']) !!}
        <div class="col-md-6">

            <div>


                <div>
                    {!!  Form::checkbox('files', 1, null, ['data-toggle' => 'toggle', 'data-onstyle'=> 'success', 'checked']) !!}

                    {!! Form::label('files', 'Is there a picture/audio/video/document to upload?') !!}
                </div>

                <div>

                    {!!  Form::checkbox('objective', 1, null, ['data-toggle' => 'toggle', 'data-onstyle'=> 'success', 'checked']) !!}

                    {!! Form::label('objective', 'Objective:') !!}
                </div>
                <div>

                    {!!  Form::checkbox('category', 1, null, ['data-toggle' => 'toggle', 'data-onstyle'=> 'success', 'checked']) !!}

                    {!! Form::label('category', 'What type of education center do you work?') !!}
                </div>

                <div>


                    {!!  Form::checkbox('level', 1, null, ['data-toggle' => 'toggle', 'data-onstyle'=> 'success', 'checked']) !!}

                    {!! Form::label('level', 'Level:') !!}
                </div>

                <div>


                    {!!  Form::checkbox('target_language ', 1, null, ['data-toggle' => 'toggle']) !!}

                    {!! Form::label('target_language', 'Target Language:') !!}
                </div>
                <div>

                    {!!  Form::checkbox('time_needed_prep', 1, null, ['data-toggle' => 'toggle']) !!}

                    {!! Form::label('time_needed_prep', 'Time needed to prepare material:') !!}
                </div>
                <div>

                    {!!  Form::checkbox('time_needed_class', 1, null, ['data-toggle' => 'toggle', 'data-onstyle'=> 'success', 'checked']) !!}

                    {!! Form::label('time_needed_class', 'Time needed to deliver material:') !!}
                </div>

                <div>

                    {!!  Form::checkbox('procedure_before', 1, null, ['data-toggle' => 'toggle']) !!}

                    {!! Form::label('procedure_before', 'Describe preparation procedure:') !!}
                </div>
                <div>

                    {!!  Form::checkbox('procedure_in', 1, null, ['data-toggle' => 'toggle', 'data-onstyle'=> 'success', 'checked']) !!}

                    {!! Form::label('procedure_in', 'Describe the procedure in the classroom:') !!}
                </div>

                <div>
                    {!!  Form::checkbox('language_focus', 1, null, ['data-toggle' => 'toggle']) !!}

                    {!! Form::label('language_focus', 'Language focus(es) of the material') !!}

                </div>


            </div>
        </div>

        <div class="col-md-6">

            <div>
                <div>
                    {!!  Form::checkbox('activity_use', 1, null, ['data-toggle' => 'toggle']) !!}

                    {!! Form::label('activity_use', 'Activity use(s) of the material') !!}

                </div>
                <div>
                    {!!  Form::checkbox('book', 1, null, ['data-toggle' => 'toggle']) !!}

                    {!! Form::label('book', 'Which text book is the material for?') !!}

                </div>

                <div>
                    {!!  Form::checkbox('target_language', 1, null, ['data-toggle' => 'toggle']) !!}

                    {!! Form::label('target_language', 'What language does the material tatget?') !!}

                </div>

                <div>
                    {!!  Form::checkbox('pupil_task', 1, null, ['data-toggle' => 'toggle']) !!}

                    {!! Form::label('pupil_task', 'What tasks will the pupils do?') !!}

                </div>

                <div>
                    {!!  Form::checkbox('materials', 1, null, ['data-toggle' => 'toggle']) !!}

                    {!! Form::label('materials', 'What materials are needed?') !!}

                </div>
                <div>
                    {!!  Form::checkbox('follow_up', 1, null, ['data-toggle' => 'toggle']) !!}

                    {!! Form::label('follow_up', 'Are there any follow up activities?') !!}

                </div>
                <div>
                    {!!  Form::checkbox('variations', 1, null, ['data-toggle' => 'toggle']) !!}

                    {!! Form::label('variations', 'Variations for using the material') !!}

                </div>
                <div>
                    {!!  Form::checkbox('tips', 1, null, ['data-toggle' => 'toggle']) !!}

                    {!! Form::label('tips', 'Tips for using the material') !!}

                </div>
                <div>
                    {!!  Form::checkbox('notes', 1, null, ['data-toggle' => 'toggle']) !!}

                    {!! Form::label('notes', 'Notes') !!}

                </div>
            </div>

        </div>

    </div>

    <div class="padding_tb col-md-12">
        {!! Form::submit('Create your material', ['class' => 'btn btn-success form-control']) !!}
        {!! Form::close() !!}
    </div>

@stop

