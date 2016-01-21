@extends('layouts.create')
{{-- Web site Title --}}
@section('title') Create Material @stop

@section('body-id')
    "create"
@endsection

{{-- Content --}}
@section('content')

    <div class="row center_form">
        <div class="col-md-6 col-md-offset-3">
            <h1 class="white_text"> Create a new material</h1>

            <hr>


            {!! Form::open(['action' => 'MaterialsController@store', 'files' => true]) !!}

            <div>
                {!! Form::label('title', 'Give your material a title:', array('class' => 'white_text')) !!}
                {!! Form::text('title', null, ['class' => 'form-control', 'files' => true]) !!}

            </div>

            @foreach($options as $option=>$value)
                @if($option == 'files')
                    @include('material.options.files', ['previous' => "null"])
                @endif
                @if($option == 'category')
                    @include('material.options.category', ['previous' => "null"])
                @endif
                @if($option == 'objective')
                    @include('material.options.objective')
                @endif
                @if($option == 'level')
                    @include('material.options.level', ['previous' => "null"])
                @endif
                @if($option == 'book')
                    @include('material.options.book', ['previous' => "null"])
                @endif
                @if($option == 'language_focus')
                    @include('material.options.language_focus', ['previous' => "null"])
                @endif
                @if($option == 'activity_use')
                    @include('material.options.activity_use', ['previous' => "null"])
                @endif
                @if($option == 'pupil_task')
                    @include('material.options.pupil_task', ['previous' => "null"])
                @endif
                @if($option == 'materials')
                    @include('material.options.materials')
                @endif
                @if($option == 'follow_up')
                    @include('material.options.follow_up')
                @endif
                @if($option == 'notes')
                    @include('material.options.notes')
                @endif
                @if($option == 'procedure_before')
                    @include('material.options.procedure_before')
                @endif
                @if($option == 'procedure_in')
                    @include('material.options.procedure_in')
                @endif
                @if($option == 'target_language')
                    @include('material.options.target_language')
                @endif
                @if($option == 'time_needed_class')
                    @include('material.options.time_needed_class')
                @endif
                @if($option == 'time_needed_prep')
                    @include('material.options.time_needed_prep')
                @endif
                @if($option == 'tips')
                    @include('material.options.tips')
                @endif
                @if($option == 'variations')
                    @include('material.options.variations')
                @endif

            @endforeach
            <div class="form-group">

                {!! Form::submit('continue', ['class' => 'btn btn-primary btn-large form-control']) !!}

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
        $('#level').select2({
            placeholder: 'Choose one or more level(s)',
            tags: true,
            theme: "bootstrap"
        });

        $('#book').select2({
            placeholder: 'What text book is this material used with?',
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


    <script>
        tinymce.init({
            selector: '.form-wysyg',
            menubar: false,
            statusbar: false
        });
    </script>

    <script>
        $(".file_input").fileinput({'showPreview': false, showUpload: false});
    </script>
@stop