@extends('layouts.app')
@section('title') Why :: @parent @stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2 class="center_form">Why are we doing this?</h2>
            </div>
        </div>

        <a href="#" class="scrollToTop"><i class="fa fa-arrow-up fa-2x"></i></a>
        @include('partials.start_nav')

        <div class="col-md-9">
            <div>{!! Html::image('img/mystery_box1.png', 'mystery box', ['class' => 'img-responsive']) !!}</div>
            <br/>

            <p>As a teacher and a tech enthusiast I have long wanted to create an online database to store all of my
                teaching materials. I have worked for over a decade in education and cannot imagine how many materials I
                have created over the years. A simple question to answer would be: How many materials do I have in my
                stock now? None! I have travelled to many countries and worked for many different employers over the
                years my stock has gone up and down but, now has completely disappeared. </p>

            <p>At some stage I had a large box full of materials all alphabetically organised. That worked for a while
                but, when changed employer and was teaching different levels instead of one class I needed to reorganise
                my box into levels and also alphabetically. Then I thought what about looking for a specific language
                point. For all my toils of multiple indexing of my materials I still needed to know the exact material I
                was looking for and where I put it. In the end someone inherited my ‘unindexable’ box of materials and
                probably never looked at them again (as they did not know every detail of what was in there).</p>

            <br/>

            <div>{!! Html::image('img/lost_materials.jpg', 'lost materials', ['class' => 'img-responsive']) !!}</div>
            <br/>

            <p>After a few years of remaking the same materials I didn’t have any more I thought there has to be a
                better way. The plan for Materials Share was hatched. What if there was a better place to store all my
                materials than big cumbersome box? What if each time I needed a resource based on level or, text book,
                or just had a few minutes in class to fill I could find a material in a few seconds? </p>

            <p>This type of problem really appeals to the tech side of my brain. If I could build a software app that
                could store all my materials in the cloud, I would never lose another material again. I could index
                materials according to whatever category I wished and even access them on my commute to work via my
                phone. By the time I got to work I would know the materials I would use for my lesson, hit the print
                button and be ready to go. </p>

            <p>This got me thinking. If I could store all my work in the cloud, other people could do it too. What if
                every teacher used the app then no one would ever lose a material again? My next thought was if everyone
                is saving their materials to the web then maybe I could use someone else’s material for my lesson. Maybe
                someone would want to use one of my materials for their lesson. If we all shared our materials how much
                time would we all save? </p>


            <div>{!! Html::image('img/save_time.jpg', 'save time', ['class' => 'img-responsive']) !!}</div>

            <p>Materials Share was born. I wanted to make a web app where teachers could save and access their materials
                anywhere in the world that has an internet connection. Teachers could share their materials (or not)
                with other users. Each material would be searchable by specific criteria so easily found. Materials
                could be rated so as to find the best material for the job. People could comment with suggestions and
                tips or, just say thank you for a great material. </p>

            <p>So Material Share is here. It’s still in a beta stage so it should work but, there will be bugs that I
                have not found yet. If you want to give it a try please remember that there is a chance your shiny new
                material may be lost or deleted. When enough people have tested the software I will move Materials Share
                to release and your materials will be backed up daily and safe. </p>

            <p>Just a quick note on security, as it’s a hot topic. All your passwords are encrypted so even if there is
                a security breach all that will be revealed is a bunch of gibberish.</p>

            <p>There are many more features and improvements coming to Materials Share in the near future so keep
                checking back.</p>
        </div>
    </div>
@endsection

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