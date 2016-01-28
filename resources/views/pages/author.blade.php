@extends('layouts.app')
@section('title') Author :: @parent @stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2>About the Author</h2>
            </div>
        </div>

        @include('partials.start_nav')

        <div class="col-md-9">
            <p>content</p>
        </div>
    </div>
@endsection