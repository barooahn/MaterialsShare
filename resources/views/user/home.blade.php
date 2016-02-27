@extends('layouts.app')
{{-- Web site Title --}}
@section('title')
    @parent
@stop

@section('content')

    <hr>
    <div class="row">
        <a href="#" class="scrollToTop"><i class="fa fa-arrow-up fa-2x"></i></a>

        <div class="col-md-6">

            <h1 class="center_form">Materials you have created</h1>

            <hr>
            @if(!$materials->isEmpty())
                @foreach($materials as $item)


                    <h2><a href="{{ URL::to('material/'.$item->slug) }}">{{ $item->title }}</a></h2>

                    <div class="padding_b">
                        @if($item->objective)
                            <div>

                                <h5>Objective:</h5>

                                {!! $item->objective !!}

                            </div>
                        @endif

                        @if(count($item->levels))
                            <div>

                                <h5>Level:</h5>

                                @foreach($item->levels as $level)

                                    <div>
                                        {!! $level->level !!}
                                    </div>

                                @endforeach

                            </div>
                        @endif

                        @if($item->book)
                            <div>

                                <h5>Book:</h5>


                                <div>
                                    {!! $item->book->book!!}
                                </div>


                            </div>
                        @endif

                    </div>

                    {!! Form::open([
                       'route' => ['togglePrivate', $item->id]
                   ]) !!}

                    @if($item->private == 0)
                        {!! Form::submit('Make private', ['class' => 'btn btn-info user_button form-control']) !!}

                    @else
                        {!! Form::submit('Make public', ['class' => 'btn btn-success user_button form-control']) !!}

                    @endif
                    {!! Form::hidden('id', $item->id) !!}
                    {!! Form::close() !!}



                    @foreach($item->files as $key => $file)

                        @if($key ==0)
                            <div class="form_padding">
                                <a href="{{ URL::to('material/'.$item->slug) }}"><img class="material_image"
                                                                                      src="{{url('/imagesIndex/'.  pathinfo($file->filename, PATHINFO_FILENAME).'.jpg')}}"
                                                                                      title="{{$file->filename}}"></a>
                            </div>
                        @endif

                    @endforeach
                    <hr>
                @endforeach

            @else

                <div class="well well-lg">This is where materials you have <strong> created</strong> can be found</div>

            @endif

        </div>

        <div class="col-md-6">

            <h1 class="center_form">Materials you have saved</h1>

            <hr>


            @if(!$liked->isEmpty())
                @foreach($liked as $item)

                    <h3>{{ $item->title }}</h3>

                    <p>{!! $item->objective !!}</p>

                    <div>
                        <a class="btn btn-success form-control" href="{{ URL::to('material/'.$item->slug) }}">Read
                            more</a>
                    </div>

                    @if(Auth::User())
                        @if(Auth::User()->id != $item->user_id )
                            @if($item->liked())

                                <a class="btn btn-danger user_button form-control"
                                   href="{{ route('addLike', $item->id) }}">Remove from My Materials</a>

                            @else

                                <a class="btn btn-success user_button form-control"
                                   href="{{ route('addLike', $item->id) }}">Save to My Materials</a>


                            @endif
                        @endif
                    @endif

                    @foreach($item->files as $key => $file)

                        @if($key ==0)
                            <div>
                                <img class="material_image"
                                     src="{{url('/images/'.  pathinfo($file->filename, PATHINFO_FILENAME).'.jpg')}}"
                                     title="{{$file->filename}}">
                            </div>
                        @endif

                    @endforeach
                    <hr>

                @endforeach

            @else

                <div class="well well-lg">This is where materials you have <strong> saved</strong> can be found</div>

            @endif

        </div>
    </div>



@stop
@section('scripts')
    <script>
        $(document).ready(function () {

//Check to see if the window is top if not then display button
            $(window).scroll(function () {
                if ($(this).scrollTop() > 400) {
                    $('.scrollToTop').fadeIn().css('z-index', 20000);

                } else {
                    $('.scrollToTop').fadeOut();
                }
            });

//Click event to scroll to top
            $('.scrollToTop').click(function () {
                $('html, body').animate({scrollTop: 0}, 800);
                return false;
            });

        });

    </script>


@stop