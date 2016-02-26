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

            @if(array_key_exists('files', $options))

                @include('material.options.file_uploads', ['previous' => "null"])
            @endif

            {!! Form::open(['action' => 'MaterialsController@store', 'files' => true]) !!}

            <div>
                {!! Form::label('title', 'Give your material a title:') !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}

            </div>

            @foreach($options as $option=>$value)

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
                @if($option == 'procedure_before')
                    @include('material.options.procedure_before')
                @endif
                @if($option == 'procedure_in')
                    @include('material.options.procedure_in')
                @endif
                @if($option == 'target_language')
                    @include('material.options.target_language')
                @endif
                @if($option == 'time_needed_prep')
                    @include('material.options.time_needed_prep')
                @endif
                @if($option == 'time_needed_class')
                    @include('material.options.time_needed_class')
                @endif
                @if($option == 'variations')
                    @include('material.options.variations')
                @endif
                @if($option == 'follow_up')
                    @include('material.options.follow_up')
                @endif
                @if($option == 'tips')
                    @include('material.options.tips')
                @endif
                @if($option == 'notes')
                    @include('material.options.notes')
                @endif

            @endforeach
            <div class="form-group">

                {!! Form::submit('continue', ['class' => 'btn btn-success btn-large form-control', 'id' => 'saveButton']) !!}

            </div>


            {!! Form::close() !!}

        </div>
    </div>

@stop

@section('scripts')
    <script>
        $('#category').select2({
            placeholder: 'Choose or Type',
            tags: true,
            theme: "bootstrap"
        });
        $('#level').select2({
            placeholder: 'Choose or Type',
            tags: true,
            theme: "bootstrap"
        });

        $('#book').select2({
            placeholder: 'Choose or Type',
            tags: true,
            theme: "bootstrap"
        });

        $('#language_focus').select2({
            placeholder: 'Choose or Type',
            tags: true,
            theme: "bootstrap"
        });

        $('#activity_use').select2({
            placeholder: 'Choose or Type',
            tags: true,
            theme: "bootstrap"
        });

        $('#pupil_task').select2({
            placeholder: 'Choose or Type',
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

    <script>
        $(".prep_slider").slider();
        $(".prep_slider").change(function () {
            $(".prep_time").text($(this).val());
        });

        $(".class_slider").slider();
        $(".class_slider").change(function () {
            $(".class_time").text($(this).val());
        });
    </script>

    <script type="text/javascript">

        function stopRKey(evt) {
            var evt = (evt) ? evt : ((event) ? event : null);
            var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
            if ((evt.keyCode == 13) && (node.type == "text")) {
                return false;
            }
        }

        document.onkeypress = stopRKey;

    </script>


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var photo_counter = 0;
        Dropzone.options.realDropzone = {

            uploadMultiple: false,
            parallelUploads: 100,
            maxFilesize: 55,
            previewsContainer: '#dropzonePreview',
            previewTemplate: document.querySelector('#preview-template').innerHTML,
            addRemoveLinks: true,
            acceptedFiles: 'image/*,application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.ms-powerpoint, video/mp4, video/x-msvideo, .avi, .wmv, .ppt, .pptx',
            dictRemoveFile: 'Remove',
            dictFileTooBig: 'Image is bigger than 60MB',

            // The setting up of the dropzone
            init: function () {

                this.on("removedfile", function (file) {

                    $.ajax({
                        type: 'POST',
                        url: 'upload/delete',
                        data: {id: file.name},
                        dataType: 'html',
                        success: function (data) {
                            var rep = JSON.parse(data);
                            if (rep.code == 200) {
                                photo_counter--;
                                $("#photoCounter").text("(" + photo_counter + ")");
                            }

                        }
                    });

                });
            },
            error: function (file, response) {
                if ($.type(response) === "string")
                    var message = response; //dropzone sends it's own error messages in string
                else
                    var message = response.message;
                file.previewElement.classList.add("dz-error");
                _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                _results = [];
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i];
                    _results.push(node.textContent = message);
                }
                return _results;
            },
            success: function (file, done) {
                photo_counter++;
                $("#photoCounter").text("(" + photo_counter + ")");
            }
        }

    </script>



@stop