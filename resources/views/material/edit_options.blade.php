@extends('layouts.create')
{{-- Web site Title --}}
@section('title') Create Material @stop

@section('body-id')
    "edit"
@endsection

{{-- Content --}}
@section('content')

    <div class="row white_text">
        <div class="col-md-12 center_form">
            <h1 class="white_text"> Edit or add the following fields</h1>

            <p>Below are the minimum requirements to publish your material</p>
            <hr>
        </div>

        {!! Form::open(['route' => ['material/edit_options', $material['id']]]) !!}
        <div class="col-md-6">
            <h2 class="white_text">Edit fields:</h2>


            @if($options_complete != null)
                @foreach($options_complete as $option => $description)

                    <div>
                        {!!  Form::checkbox($option, 1, null, ['data-toggle' => 'toggle', 'data-onstyle'=> 'success']) !!}

                        {!! Form::label($option, $description) !!}
                    </div>
                @endforeach
            @endif

        </div>

        <div class="col-md-6">
            @if($options_empty != null)

                <h2 class="white_text">Add fields:</h2>
                @foreach($options_empty as $option => $description)

                    <div>
                        {!!  Form::checkbox($option, 1, null, ['data-toggle' => 'toggle', 'data-onstyle'=> 'success']) !!}

                        {!! Form::label($option, $description) !!}
                    </div>
                @endforeach
            @else
                <h2 class="white_text">All fields completed!</h2>
            @endif

        </div>

        <div class="padding_tb col-md-12">

            {!! Form::submit('continue', ['class' => 'btn btn-primary btn-large form-control']) !!}

        </div>
        {!! Form::close() !!}

    </div>

@stop

