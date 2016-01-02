@extends('layouts.edit')
{{-- Web site Title --}}
@section('title') {!!  $material->title !!} :: @parent @stop

@section('body-id')
    "create"
@endsection

{{-- Content --}}
@section('content')
    <div class="row center_form">
        <div class="col-md-8 col-md-offset-2">
            <h1 class="white_text">{{$material->title}}e</h1>
            <hr>

            {!! Form::model($material, [
                    'method' => 'PATCH',
                    'route' => ['material.update_title', $material->id]
            ]) !!}

            <div class="form-group">

                {!! Form::hidden('material', $material->id) !!}

                {!! Form::label('title', 'Title:', array('class' => 'white_text')) !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">

                {!! Form::label('objective', 'What is the objective of this material?', array('class' => 'white_text')) !!}
                {!! Form::textarea('objective', null, ['class' => 'form-control form-wysyg']) !!}

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