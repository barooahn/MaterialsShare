@extends('layouts.edit')
{{-- Web site Title --}}
@section('title') {!!  $material->title !!} :: @parent @stop

@section('body-id')
    "edit_menu"
@endsection

{{-- Content --}}
@section('content')
    <div class="heading">
        <h1> Choose what to edit - {!! $material->title !!}</h1>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-5">
            <div>

                <p>The Category/Categories</p>

                {!! Form::open([
                     'route' => ['material.edit_category', $material->id]
                 ]) !!}
                {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>

            <hr>
            <div>

                <p>The Title</p>

                <p>The Objective</p>

                {!! Form::open([
                         'route' => ['material.edit_title', $material->id]
                     ]) !!}
                {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}

            </div>

            <hr>
            <div>

                <p>The Time Needed In Class</p>

                <p>The Time Needed for Preparation</p>

                <p>The Materials Needed</p>

                <p>The Procedure In Class</p>

                <p>The Procedure Before Class</p>

                {!! Form::open([
                     'route' => ['material.edit_times', $material->id]
                 ]) !!}
                {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}

            </div>

            <hr>
            <div>

                <p>The Attachment(s)/File(s)</p>

                {!! Form::open([
                     'route' => ['material.edit_file', $material->id]
                 ]) !!}
                {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}

            </div>
        </div>
        <div class="col-md-5">

            <div>

                <p>The Target Language</p>

                <p>The Level(s)</p>

                <p>The Language Focus(es)</p>

                <p>The Activity Use(s)</p>

                <p>The Pupil Task(s)</p>

                <p>The Attachment(s)/File(s)</p>

                {!! Form::open([
                     'route' => ['material.edit_level', $material->id]
                 ]) !!}
                {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}

            </div>

            <hr>

            <div>

                <p>The Follow Up</p>

                <p>The Variations</p>

                <p>The Tips</p>

                <p>The Notes</p>

                {!! Form::open([
                     'route' => ['material.edit_optional', $material->id]
                 ]) !!}
                {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}

            </div>
        </div>
    </div>

@stop
