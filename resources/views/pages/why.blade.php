@extends('layouts.app')
@section('title') Why :: @parent @stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Why are we doing this?</h2>
            </div>
        </div>

        @include('partials.start_nav')

        <div class="col-md-9">
            <p>content</p>
        </div>
    </div>
@endsection