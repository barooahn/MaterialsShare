@extends('layouts.app')
{{-- Web site Title --}}
@section('title')
    @parent
@stop

@section('content')



    @if($materials)
        @foreach($materials as $item)
            <hr>
            <div class="row">

                <div class="col-md-4">
                    <h2>{{ $item->title }}</h2>

                    @if($item->objective)
                        <div>

                            <h3>Objective:</h3>

                            {!! $item->objective !!}

                        </div>
                    @endif

                    @if($item->levels->count()>1)
                        <div>

                            <h3>Level:</h3>

                            @foreach($item->levels as $level)

                                <div>
                                    {!! $level->level !!}
                                </div>

                            @endforeach

                        </div>
                    @endif

                    @if($item->book)
                        <div>

                            <h3>Book:</h3>


                            <div>
                                {!! $item->book->book!!}
                            </div>


                        </div>
                    @endif

                    @if(Auth::User())
                        @if(Auth::User()->id != $item->user_id )
                            @if($item->liked())

                                <div>
                                    <a class="btn btn-warning user_button form-control"
                                       href="{{ URL::route('addLike', array('material' => $item)) }}">Remove</a>

                                </div>

                            @else
                                <div>
                                    <a class="btn btn-success user_button form-control"
                                       href="{{ URL::route('addLike', array('material' => $item)) }}">Save</a>


                                </div>
                            @endif
                        @endif
                    @endif

                </div>

                <div class="col-md-4">

                    @foreach($item->files as $key => $file)

                        @if($key ==0)
                            <div class="form_padding">
                                <img class="material_image" src="{{ asset($file->thumb_path)  }}">
                            </div>
                        @endif

                    @endforeach


                    <div class="form_padding">
                        <a class="btn btn-success user_button form-control"
                           href="{{ URL::to('material/'.$item->slug) }}">Go to
                            Material</a>
                    </div>

                </div>

                <div class="col-md-4">

                    <div>
                        <h3>Rating:</h3>

                        <div>
                            {!! Form::text('stars', $item->averageRating(), [
                            'class' => 'form-control rating',
                            'data-step' => 0.01,
                            'data-stars' => 5,
                            'data-symbol' => '&#xe005;',
                            'data-default-caption' => '{rating} hearts',
                            'data-star-captions' => '{}',
                            'data-show-clear'=> 'false'
                              ])
                              !!}
                        </div>

                    </div>

                </div>
            </div>


        @endforeach

        <hr>
        <div class="row">

            <div class="col-md-12 center_form">
                {!! $materials->render() !!}
            </div>
        </div>
    @endif
@stop


@section('scripts')
    <script>
        $(".rating").rating(
                {
                    'readonly': 'true',
                    'size': 'sm'

                });
    </script>
@stop