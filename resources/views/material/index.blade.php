@extends('layouts.app')
{{-- Web site Title --}}
@section('title')
    @parent
@stop

@section('content')

    @if($materials)

        <a href="#" class="scrollToTop"><i class="fa fa-arrow-up fa-2x"></i></a>

        @include('partials.filter')

        @foreach($materials as $item)

            <hr>
            <div class="row">

                <div class="col-md-4">
                    <a href="{{ URL::to('material/'.$item->slug) }}">{{ $item->title }}</a>

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

                <div class="col-md-4">

                    @foreach($item->files as $key => $file)

                        @if($key ==0)
                                <a href="{{ URL::to('material/'.$item->slug) }}"><img class="material_image img-responsive"
                                                                                      src="{{url('/imagesIndex/'.  pathinfo($file->filename, PATHINFO_FILENAME).'.jpg')}}"
                                                                                      title="{{$file->filename}}">
                                </a>
                        @endif

                    @endforeach


                </div>

                <div class="col-md-4">


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

                    @if(Auth::User())
                        @if(Auth::User()->id != $item->user_id )
                            <div class="btn-group-vertical material_button" role="group">
                                @if($item->liked())

                                    <a class="btn btn-danger"
                                       href="{{ route('addLike', $item->id) }}">Remove from My Materials</a>

                                @else

                                    <a class="btn btn-success"
                                       href="{{ route('addLike', $item->id) }}">Save to My Materials</a>


                                @endif
                            </div>
                        @endif
                    @endif

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

    <script>
        $('#category').select2({
            placeholder: 'Click for options',

            theme: "bootstrap"
        });
        $('#level').select2({
            placeholder: 'Click for options',

            theme: "bootstrap"
        });

        $('#book').select2({
            placeholder: 'Click for options',
            allowClear: true,
            theme: "bootstrap"
        });

        $('#language_focus').select2({
            placeholder: 'Click for options',

            theme: "bootstrap"
        });

        $('#activity_use').select2({
            placeholder: 'Click for options',

            theme: "bootstrap"
        });

        $('#pupil_task').select2({
            placeholder: 'Click for options',

            theme: "bootstrap"
        });
    </script>

    <script>
        $(".prep_slider").slider({});
        $(".prep_slider").change(function () {
            $(".prep_time").text($(this).val());
        });

        $(".class_slider").slider({});
        $(".class_slider").change(function () {
            $(".class_time").text($(this).val());
        });
    </script>

    <script type="text/javascript">

        $(document).ready(
                function () {
                    $('.btn.btn-info.expand.form-control ').click(
                            function () {
                                if (!$(".content").hasClass('opened')) {
                                    $(".content").slideDown(1000).addClass('opened');
                                } else {
                                    $(".content").slideUp(1000).removeClass('opened');
                                }
                            }
                    );
                }
        );
    </script>

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