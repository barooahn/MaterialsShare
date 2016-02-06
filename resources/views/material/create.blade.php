@extends('layouts.create')
{{-- Web site Title --}}
@section('title') Create Material @stop

@section('body-id')
    "test"
@endsection

{{-- Content --}}
@section('content')

    <div class="row center_form">
        <div class="col-md-6 col-md-offset-3">
            <h1> Create a new material</h1>

            <hr>
            <h4>Choose a category or create a new one</h4>

            {!! Form::open(['action' => 'MaterialsController@store']) !!}

            <div class="form-group">

                {!! Form::select('category_list[]', $categories, null, ['id' => 'category', 'class' => 'form-control', 'multiple']) !!}

            </div>

            <div class="form-group">

                {!! Form::submit('Add Category',['class' => 'btn btn-primary btn-large form-control']) !!}

            </div>
            {!! Form::close() !!}

        </div>
    </div>

@stop

@section('scripts')
    <script>
        $('#category').select2({
            placeholder: 'Choose a category',
            tags: true,
            theme: "bootstrap"
        });
    </script>


@stop