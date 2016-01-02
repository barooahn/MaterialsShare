@extends('layouts.create')
{{-- Web site Title --}}
@section('title') Create Material @stop

@section('body-id')
    "create_level"
@endsection

{{-- Content --}}
@section('content')

    <div class="row center_form">
        <div class="col-md-8 col-md-offset-2">

            <h1 class="white_text">{{$material->title}}</h1>
            <hr>


            {!! Form::open(['action' => 'MaterialsController@createLevel']) !!}

            <div class="form-group">

                <div class="form-padding">
                    {!! Form::select('level[]', $levels, null, ['id' => 'level', 'class' => 'form-control', 'multiple']) !!}
                </div>
                <div class="form-padding">
                    {!! Form::select('language_focus[]', $language_focuses, null, ['id' => 'language_focus', 'class' => 'form-control', 'multiple']) !!}
                </div>
                <div class="form-padding">
                    {!! Form::select('activity_use[]', $activity_uses, null, ['id' => 'activity_use', 'class' => 'form-control', 'multiple']) !!}
                </div>
                <div class="form-padding">
                    {!! Form::select('pupil_task[]', $pupil_tasks, null, ['id' => 'pupil_task', 'class' => 'form-control', 'multiple']) !!}
                </div>
                {!! Form::hidden('material', $material->id) !!}

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