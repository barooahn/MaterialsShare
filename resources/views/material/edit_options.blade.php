@extends('layouts.create')
{{-- Web site Title --}}
@section('title') Create Material @stop

@section('body-id')
    "test"
@endsection

{{-- Content --}}
@section('content')

    <div class="row">
        <div class="col-md-12 center_form">
            <h1> Edit or add the following fields</h1>

            <p>Below are the minimum requirements to publish your material</p>
            <hr>
        </div>

        {!! Form::open(['route' => ['material/edit_options', $material['id']]]) !!}
        <div class="col-md-6">
            <h2>Edit fields:</h2>


            @if($options_complete != null)
                <div class="btn-group-vertical checkbox_option" data-toggle="buttons">
                    @foreach($options_complete as $option => $description)

                        <label class="btn btn-primary {{$option}}">
                            {!!  Form::checkbox($option, 1, null, ['data-onstyle'=> 'success']) !!}
                            {{ucwords(str_replace('_', ' ', $option))}}

                            <i class="fa fa-info-circle fa-lg" data-toggle="tooltip" data-placement="right"
                               title="{{$description}}"></i>

                        </label>
                    @endforeach

                </div>
            @endif

        </div>

        <div class="col-md-6">
            @if($options_empty != null)

                <h2>Add fields:</h2>
                <div class="btn-group-vertical checkbox_option" data-toggle="buttons">
                    @foreach($options_empty as $option => $description)

                        <label class="btn btn-primary {{$option}}">
                            {!!  Form::checkbox($option, 1, null, ['data-onstyle'=> 'success']) !!}
                            {{ucwords(str_replace('_', ' ', $option))}}

                            <i class="fa fa-info-circle fa-lg" data-toggle="tooltip" data-placement="right"
                               title="{{$description}}"></i>

                        </label>
                    @endforeach

                </div>
            @else
                <h2>All fields completed!</h2>
            @endif

        </div>

        <div class="padding_tb col-md-12">

            {!! Form::submit('continue', ['class' => 'btn btn-success btn-large form-control']) !!}

        </div>
        {!! Form::close() !!}

    </div>

@stop

@section('scripts')
    <script>

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

    </script>

@stop