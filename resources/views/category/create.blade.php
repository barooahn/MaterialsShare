@extends('layouts.app')
{{-- Web site Title --}}
@section('title') Create Category @stop

{{-- Content --}}
@section('content')
    <h1> Create a new material</h1>

    <hr/>

         {!! Form::open(['url' => 'category']) !!}

            <div class = "form-group">

                {!! Form::label('category', 'Category:') !!}
                {!! Form::text('category', null, ['class' => 'form-control']) !!}

            </div>

            <div class = "form-group">

                  {!! Form::submit('Add Category', ['class' => 'btn btn-primary btn-large form-control']) !!}

            </div>
        {!! Form::close() !!}

@stop