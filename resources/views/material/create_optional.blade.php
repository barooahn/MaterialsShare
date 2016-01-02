@extends('layouts.create')
{{-- Web site Title --}}
@section('title') Create Material @stop

@section('body-id')
    "create_optional"
@endsection

{{-- Content --}}
@section('content')

    <div class="row center_form">
        <div class="col-md-8 col-md-offset-2">

            <h1 class="white_text">{{$material->title}}</h1>
            <hr>
            <h2 class="white_text">Well done! Your material is ready!</h2>

            <h4 class="white_text">You can finish now or there are a few additional optional fields</h4>

            <h4 class="white_text">You can complete these at anytime by editing the material</h4>

            <div>
                <a class="btn btn-primary btn-large form-control" href="material/{{$material->slug}}">See/Edit my material</a>
            </div>

            <hr>

            {!! Form::open(['action' => 'MaterialsController@createOptional']) !!}

            <div class="form-group">

                {!! Form::hidden('material', $material->id) !!}
                <div class="form-padding">
                    {!! Form::label('follow_up', 'Follow Up:', array('class' => 'white_text')) !!}
                    {!! Form::textarea('follow_up', null, ['class' => 'form-control form-wysyg']) !!}
                </div>
                <div class="form-padding">
                    {!! Form::label('variations', 'Variations:', array('class' => 'white_text')) !!}
                    {!! Form::textarea('variations', null, ['class' => 'form-control form-wysyg']) !!}
                </div>
                <div class="form-padding">
                    {!! Form::label('tips', 'Tips:', array('class' => 'white_text')) !!}
                    {!! Form::textarea('tips', null, ['class' => 'form-control form-wysyg']) !!}
                </div>
                <div class="form-padding">
                    {!! Form::label('notes', 'Notes:', array('class' => 'white_text')) !!}
                    {!! Form::textarea('notes', null, ['class' => 'form-control form-wysyg']) !!}
                </div>
            </div>

            <div class="form-group">

                {!! Form::submit('Submit', ['class' => 'btn btn-primary btn-large form-control']) !!}

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
