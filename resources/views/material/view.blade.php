@extends('layouts.app')
{{-- Web site Title --}}
@section('title') {!!  $material->title !!} :: @parent @stop

{{-- Content --}}
@section('content')

    <div class="row">
        <div class="col-md-7">
            <div class="heading">
                <h1> {!! $material->title !!}</h1>
            </div>
        </div>


        <div class="col-md-5">
            @include('partials.user_buttons')
        </div>
    </div>


    <hr>


    <div class="row">
        <div class="col-md-6">

            <div>

                <h3>Objective(s):</h3>

                <h4>By the end of the activity pupils will be able to:</h4>

                {!! $material->objective !!}

            </div>

            <div>

                <h3>Target Language:</h3>

                {!! $material->target_language !!}

            </div>

            <div>

                <h3>Time needed:</h3>

                <p><strong>Preperation</strong> {!! $material->time_needed_prep !!} minutes</p>

                <p><strong>In Class </strong>{!! $material->time_needed_class !!} minutes</p>

            </div>

            <div>

                <h3>Level:</h3>

                @foreach($material->levels as $level)

                    <div>
                        {!! $level->level !!}
                    </div>

                @endforeach

            </div>

            <div>

                <h3>Language Focus:</h3>

                @foreach($material->languageFocuses as $focus)

                    <div>
                        {!! $focus->language_focus!!}
                    </div>

                @endforeach

            </div>

            <div>

                <h3>Activity Use:</h3>

                @foreach($material->activityUses as $activity)

                    <div>
                        {!! $activity->activity_use!!}
                    </div>

                @endforeach

            </div>

            <div>

                <h3>Pupil Task:</h3>

                @foreach($material->pupilTasks as $task)

                    <div>
                        {!! $task->pupil_task!!}
                    </div>

                @endforeach

            </div>

        </div>

        <div class="col-md-6">

            <h3>Category:</h3>

            @foreach($material->categories as $category)

                <div>
                    {!! $category->category !!}
                </div>

            @endforeach

            <div>

                <h3>Materials:</h3>

                {!! $material->materials !!}

            </div>

            <div>

                <h3>Procedure:</h3>

                <h4>Before class:</h4>

                {!! $material->procedure_before !!}

                <h4>In class:</h4>

                {!! $material->procedure_in !!}

            </div>

            @if($material->follow_up)
            <div>

                <h3>Follow Up:</h3>

                {!! $material->follow_up !!}


            </div>
            @endif



            @if($material->variations)
            <div>

                <h3>Variations:</h3>

                {!! $material->variations!!}


            </div>
            @endif

            @if($material->tips)
            <div>

                <h3>Tips:</h3>

                {!! $material->tips!!}


            </div>
            @endif

            @if($material->notes)
                <div>

                    <h3>Notes:</h3>

                    {!! $material->notes!!}


                </div>
            @endif

        </div>

    </div>

    <hr>

    @if($material->files->count() >=1)



        <div class="row">

            <div class="col-md-6">

                <h2>Attached files</h2>

                @foreach($material->files as $file)

                    <div>
                        <img class="material_image" src="{{ asset($file->thumb_path)  }}">
                    </div>

                    @if(Auth::user())
                            <div class="form-padding">

                                <a class="btn btn-success btn-large form-control" href="{{ URL::route('material.get_download',
                                array('path' => $file->file_path, 'filename' =>$file->filename, )) }}">Download</a>
                            </div>
                    @endif


                    <hr>
                @endforeach

            </div>

            <div class="col-md-6">

                <h2>Comments</h2>

                @include('partials.disqus')

            </div>

        </div>

    @endif



@stop
@include('partials.social')

@section('scripts')
    <script>
        $(".rating").rating(
                {
                    'size': 'sm'

                });
    </script>


@stop