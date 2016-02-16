@extends('layouts.app')
@section('title') Contact :: @parent @stop
@section('content')
    <div class="row">
        <div class="page-header">
            <h1>Contact Page</h1>
        </div>
    </div>
    <div class="row center_form">
        <div class="col-md-6 col-md-offset-3">

            @if (Auth::user())
                <h2>Feedback</h2>
                <div class="center_form">
                    {!! Form::open(['action' => 'MaterialsController@store']) !!}
                    <div class="form-group">
                        {!! Form::hidden('user', Auth::user()->name) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('topic', 'Please chose topic') !!}
                        {!! Form::select('topic', array(
                                            'good' => 'Give a positive comment',
                                            'error' => 'Error or bug',
                                            'improve' => 'Suggest an improvement',
                                            'complaint' => 'Complain about someone/something'
                                            ),null,['class' => 'form-control'])  !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('feedback', 'Please give details') !!}
                        {!! Form::textarea('feedback', null,['class' => 'form-control']) !!}
                    </div>

                    {!! Form::submit('continue', ['class' => 'btn btn-primary btn-large form-control']) !!}
                    {!! Form::close() !!}
                    <hr>
                </div>

            @else
                <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    Login to leave a comment.
                </div>
            @endif

            <h1> {!! Html::mailto('mailto:barooahn@gmail.com', 'Email Materials Share') !!}</h1>

            <h3>barooahn@gmail.com</h3>

        </div>

@endsection