@extends('layouts.app')
{{-- Web site Title --}}
@section('title') Material Categories @stop

{{-- Content --}}
@section('content')
    <h1>Categories</h1>

    <hr/>

    @foreach($material_categories as $category)

        <div>
            <a class="btn btn-success" href="#">{{$category->category}}</a>
        </div>

    @endforeach
@stop