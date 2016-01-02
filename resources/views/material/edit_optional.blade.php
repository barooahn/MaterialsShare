@extends('layouts.edit')
{{-- Web site Title --}}
@section('title') {!!  $material->title !!} :: @parent @stop

@section('body-id')
    "create"
@endsection

{{-- Content --}}
@section('content')
    <h1>Update!</h1>

    {!! Form::model($material, [
        'method' => 'PATCH',
        'route' => ['material.update_optional', $material->id]
    ]) !!}

    <div class = "form-group">

        {!! Form::hidden('material', $material->id) !!}

        {!! Form::label('follow_up', 'Follow Up:', array('class' => 'white_text')) !!}
        {!! Form::textarea('follow_up', null, ['class' => 'form-control form-wysyg']) !!}

        {!! Form::label('variations', 'Variations:', array('class' => 'white_text')) !!}
        {!! Form::textarea('variations', null, ['class' => 'form-control form-wysyg']) !!}

        {!! Form::label('tips', 'Tips:', array('class' => 'white_text')) !!}
        {!! Form::textarea('tips', null, ['class' => 'form-control form-wysyg']) !!}

        {!! Form::label('notes', 'Notes:', array('class' => 'white_text')) !!}
        {!! Form::textarea('notes', null, ['class' => 'form-control form-wysyg']) !!}
    </div>

    <div class = "form-group">

        {!! Form::submit('update', ['class' => 'btn btn-primary btn-large form-control']) !!}

    </div>
    {!! Form::close() !!}

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
