@extends('layouts.app')
{{-- Web site Title --}}
@section('title') {{  $material->title }} :: @parent @stop

{{-- Content --}}
@section('content')


    <div class="row view_padding">
        <div class="col-md-7">
            @if(count($material->files))
                <div class="heading">
                    <h1> {{ $material->title }}</h1>

                    <!-- Go to www.addthis.com/dashboard to customize your tools -->
                    <div class="addthis_sharing_toolbox"></div>
                </div>
            @endif
        </div>


        <div class="col-md-5">
            @include('partials.user_buttons')
        </div>
    </div>


    <hr>
    @if(count($material->files))
        <div class="row">
            <div class="col-md-12">


                <h2>Attached files</h2>

                @foreach($material->files as $file)
                    <div>
                        <img class="material_image"
                             src="{{url('/images/'.pathinfo($file->filename, PATHINFO_FILENAME).'.jpg')}}"
                             title="{{$file->filename}}">
                    </div>

                    @if(Auth::user())
                        <div class="form-padding">

                            <a class="btn btn-success btn-large form-control" href="{{ URL::route('material.get_download',
                                array('file' => $file)) }}">Download</a>
                        </div>
                    @endif
                    <hr>
                @endforeach

            </div>
        </div>
    @endif

    <div class="page-break"></div>

    <div class="row">
        <div class="col-md-12">

            <div class="heading">
                <h1> {{ $material->title }}</h1>

                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_sharing_toolbox"></div>
                <hr>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">


            @if($material->objective)
                <div>

                    <h4>Objective(s):</h4>

                    <h5>By the end of the activity pupils will be able to:</h5>

                    {!! $material->objective !!}

                </div>
            @endif

            @if($material->target_language)
                <div>
                    <h4>Target Language:</h4>

                    {{ $material->target_language }}

                </div>
            @endif

            @if($material->time_needed_prep)
                <div>
                    <h4>Time needed for preparation:</h4>

                    {{ $material->time_needed_prep }} minutes

                </div>
            @endif

            @if( $material->time_needed_class)
                <div>
                    <h4>Time needed in class:</h4>

                    {{ $material->time_needed_class }} minutes

                </div>
            @endif

            @if(count($material->levels))
                <div>

                    <h4>Level:</h4>

                    @foreach($material->levels as $level)

                        <div>
                            {{ $level->level }}
                        </div>

                    @endforeach

                </div>
            @endif

            @if(count($material->languageFocuses))
                <div>

                    <h4>Language Focus:</h4>

                    @foreach($material->languageFocuses as $focus)

                        <div>
                            {{ $focus->language_focus}}
                        </div>

                    @endforeach

                </div>
            @endif

            @if(count($material->activityUses))
                <div>

                    <h4>Activity Use:</h4>

                    @foreach($material->activityUses as $activity)

                        <div>
                            {{ $activity->activity_use}}
                        </div>

                    @endforeach

                </div>
            @endif

            @if(count($material->pupilTasks))
                <div>

                    <h4>Pupil Task:</h4>

                    @foreach($material->pupilTasks as $task)

                        <div>
                            {{ $task->pupil_task }}
                        </div>

                    @endforeach

                </div>
            @endif
            @if($material->book)
                <div>

                    <h4>Book:</h4>


                    <div>
                        {{ $material->book->book }}
                    </div>


                </div>
            @endif
            @if($material->page)
                <div>

                    <h4>Page:</h4>

                    {{ $material->page }}


                </div>
            @endif

        </div>

        <div class="col-md-6">


            @if(count($material->categories))
                <h4>Which learning institute:</h4>
                @foreach($material->categories as $category)

                    <div>
                        {{ $category->category }}
                    </div>

                @endforeach
            @endif

            @if($material->materials)
                <div>

                    <h4>Materials:</h4>

                    {{ $material->materials }}

                </div>
            @endif


            @if($material->procedure_before)
                <div>
                    <h4>Procedure before class:</h4>

                    {!! $material->procedure_before !!}
                </div>

            @endif


            @if($material->procedure_in)
                <div>
                    <h4>Procedure in class:</h4>

                    {!! $material->procedure_in !!}


                </div>
            @endif


            @if($material->follow_up)
                <div>

                    <h4>Follow Up:</h4>

                    {!! $material->follow_up !!}


                </div>
            @endif



            @if($material->variations)
                <div>

                    <h4>Variations:</h4>

                    {!! $material->variations!!}


                </div>
            @endif

            @if($material->tips)
                <div>

                    <h4>Tips:</h4>

                    {!! $material->tips!!}


                </div>
            @endif

            @if($material->notes)
                <div>

                    <h4>Notes:</h4>

                    {!! $material->notes!!}


                </div>
            @endif


        </div>

    </div>

    <hr>

    <div class="row">

        <div class="col-md-12 comments">
            <h2>Comments</h2>
            @include('partials.disqus')
            <div class="spot-im-frame-inpage" data-post-id="POST_ID_GOES_HERE"></div>

        </div>

    </div>

@stop
@include('partials.social')

@section('scripts')
    <script>
        $(".rating").rating(
                {
                    'size': 'sm'

                });
    </script>

    <script>
        $(function () {
            $('.confirm').click(function () {
                return window.confirm("Are you sure you want to delete this material?  This can not be undone! ");
            });
        });
    </script>


@stop