@extends('layouts.create')
{{-- Web site Title --}}
@section('title') Create Material @stop

@section('body-id')
    "create_title"
@endsection
{{-- Content --}}
@section('content')

    <div class="row center_form">
        <div class="col-md-8 col-md-offset-2">
            <h1 class="white_text">Give your material a title</h1>
            <hr>

            {!! Form::model($material) !!}

            <div class="form-group">

                {!! Form::hidden('material', $material->id) !!}

                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">

                <h2 class="white_text">What is the objective of this material?</h2>
                <hr>
                <p class="white_text">Example: By the end of the activity pupils will be able to: </p>

                <p class="white_text"> spell words correctly. </p>

                <p class="white_text">or, categorise different food and drink items under appropriate headings.</p>
                {!! Form::textarea('objective', null, ['class' => 'form-control form-wysyg']) !!}

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

@stop