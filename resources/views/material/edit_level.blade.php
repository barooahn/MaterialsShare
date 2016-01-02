@extends('layouts.edit')
{{-- Web site Title --}}
@section('title') {!!  $material->title !!} :: @parent @stop

@section('body-id')
    "create"
@endsection

{{-- Content --}}
@section('content')
    <h1>Edit Material</h1>

    <h2>Material Tile: <strong>{{$material->title}}</strong></h2>


    {!! Form::model($material, [
        'method' => 'PATCH',
        'route' => ['material.update_level', $material->id]
    ]) !!}

    <div class = "form-group">



        {!! Form::label('level', 'Level:') !!}
        {!! Form::select('level[]', $levels, $material->levels->lists('level','id')->toArray(), ['id' => 'level', 'class' => 'form-control', 'multiple']) !!}

        {!! Form::label('language_focus', 'Language Focus:') !!}
        {!! Form::select('language_focus[]', $language_focuses, $material->languageFocuses->lists('language_focus','id')->toArray(), ['id' => 'language_focus', 'class' => 'form-control', 'multiple']) !!}

        {!! Form::label('activity_use', 'Activity Use:') !!}
        {!! Form::select('activity_use[]', $activity_uses, $material->activityUses->lists('activity_use','id')->toArray(), ['id' => 'activity_use', 'class' => 'form-control', 'multiple']) !!}

        {!! Form::label('pupil_task', 'Pupil Task:') !!}
        {!! Form::select('pupil_task[]', $pupil_tasks, $material->pupilTasks->lists('pupil_task','id')->toArray(), ['id' => 'pupil_task', 'class' => 'form-control', 'multiple']) !!}

        {!! Form::hidden('material', $material->id) !!}

    </div>

    <div class = "form-group">

        {!! Form::submit('continue', ['class' => 'btn btn-primary btn-large form-control']) !!}

    </div>
    {!! Form::close() !!}

@stop
@section('scripts')
    <script>
        $('#level').select2({
            placeholder: 'Choose one or more level(s)',
            tags: true,
            theme: "bootstrap"
        });

        $('#language_focus').select2({
            placeholder: 'Choose one or more language focus(es)',
            tags: true,
            theme: "bootstrap"
        });

        $('#activity_use').select2({
            placeholder: 'Choose one or more activity use(es)',
            tags: true,
            theme: "bootstrap"
        });

        $('#pupil_task').select2({
            placeholder: 'Choose one or more pupil task(s)',
            tags: true,
            theme: "bootstrap"
        });

    </script>
@stop