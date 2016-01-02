@extends('layouts.edit')
{{-- Web site Title --}}
@section('title') {!!  $material->title !!} :: @parent @stop

@section('body-id')
    "edit"
@endsection

{{-- Content --}}
@section('content')
    <div class="row center_form">
        <div class="col-md-6 col-md-offset-3">
            <h1 class="white_text"> Edit category</h1>

            <hr>

            {!! Form::model($material, [
                    'method' => 'PATCH',
                    'route' => ['material.update_category', $material->id]
            ]) !!}


            <div class="form_padding">

                {!! Form::label('category_list', 'Category:', array('class' => 'white_text')) !!}
                {!! Form::select('category_list[]', $categories, $material->categories->lists('category','id')->toArray(), ['id' => 'category', 'class' => 'form-control', 'multiple']) !!}

            </div>

            <div class="form_padding">

                {!! Form::submit('update',['class' => 'btn btn-primary btn-large form-control']) !!}

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