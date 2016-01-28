@extends('layouts.app')
@section('title') Content :: @parent @stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Examples of our content</h2>
            </div>
        </div>

        @include('partials.start_nav')

        <div class="col-md-9">
            <p>content</p>
        </div>
    </div>
@endsection