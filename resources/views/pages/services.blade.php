@extends('layouts.app')
@section('title') Services :: @parent @stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2 class="center_form">What value and services do we provide?</h2>
            </div>
        </div>

        @include('partials.start_nav')


        <div class="col-md-9">

            <h2>Material Share gives users many advantages: </h2>

            <div>{!! Html::image('img/advantages.jpg', 'advantages', ['class' => 'img-responsive']) !!}</div>


            <h3>Quick and Easy:</h3>

            <p>Materials Share has been designed to be as simple, quick and easy to use as possible whilst still being a
                robust and powerful application. Materials Share offers a selection of categories to describe your
                material. Some of these include: files to upload, objective, level, textbook, class time and many more.
                In all there are 20 options you can choose from. </p>

            <p>You can choose how much information to input. Materials Share has a simple options system to select what
                you want information you want to input and when you want to do it. If you only have a few minutes you
                can take a quick picture on your mobile give it a title and upload it and you have created a material.
                Later you can go back and complete the full details.</p>

            <div>{!! Html::image('img/quick_and_easy.jpg', 'quick and easy', ['class' => 'img-responsive']) !!}</div>
            <h3>Save your work in the cloud:</h3>

            <p>Materials saved in the cloud are available to you and other teachers (you don’t have to share your
                materials) from any location and from any device that is attached to the internet. Your laptop or work
                computer is the most obvious choice but, also your mobile phone or home TV can be used to browse or make
                new materials. After your material is uploaded you can access it anywhere, any time. It will be stored
                until you decided to delete it. </p>

            <div>{!! Html::image('img/save_to_cloud.jpg', 'save work to the cloud', ['class' => 'img-responsive']) !!}</div>
            <h3>Sharing materials:</h3>

            <p>Material Share allows you to access materials from any other teacher who has uploaded a material. If you
                don’t have much time before a class and want supplementary materials do a quick search and find a
                suitable material that is applicable. </p>

            <div>{!! Html::image('img/share.jpg', 'share work', ['class' => 'img-responsive']) !!}</div>
            <h3>Search:</h3>

            <p>Materials Share allows you to search through all the uploaded materials for a specific detail. This could
                be level: intermediate, book: Headway, grammar point: simple past, topic: family. </p>

            <div>{!! Html::image('img/search.jpg', 'search', ['class' => 'img-responsive']) !!}</div>
            <h3>Feedback and rating:</h3>

            <p>Each material can be rated by teachers on a scale of 1 -5 hearts. It is easy to do and can help you get
                the best material for your class. In addition to rating each material has a comments section for
                thanking the uploader, tips on improvements, variations for uses of the material or, other
                comments. </p>

            <div>{!! Html::image('img/feedback.jpg', 'feedback and rating', ['class' => 'img-responsive']) !!}</div>
        </div>
    </div>
@endsection