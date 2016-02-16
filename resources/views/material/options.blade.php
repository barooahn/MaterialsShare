@extends('layouts.create')
{{-- Web site Title --}}
@section('title')Create Material @stop

@section('body-id')
    "test"
@endsection

{{-- Content --}}
@section('content')

    <div>
        <div class="col-md-12 center_form">
            <h1> Create a new material</h1>

            <p>Below are the minimum requirements to publish your material</p>
            <hr>
        </div>

        {!! Form::open(['action' => 'MaterialsController@postOptions']) !!}
        <div class="col-md-6">

            <div>

                @for($i=0; $i<10; $i++)

                    <div class= {{$options[$i]->option}}>
                        {!!  Form::checkbox($options[$i]->option, 1, null, ['data-toggle' => 'toggle', 'data-onstyle'=> 'success']) !!}

                        {!! Form::label($options[$i]->option, ucwords(str_replace('_', ' ', $options[$i]->option))) !!}
                        <i class="fa fa-info-circle fa-lg" data-toggle="tooltip" data-placement="right"
                           title="{{$options[$i]->description}}"></i>

                    </div>

                @endfor

            </div>
        </div>

        <div class="col-md-6">

            <div>
                @for($i=10; $i<20; $i++)

                    <div>
                        {!!  Form::checkbox($options[$i]->option, 1, null, ['data-toggle' => 'toggle', 'data-onstyle'=> 'success']) !!}

                        {!! Form::label($options[$i]->option, ucwords(str_replace('_', ' ', $options[$i]->option))) !!}

                        <i class="fa fa-info-circle fa-lg" data-toggle="tooltip" data-placement="right"
                           title="{{$options[$i]->description}}"></i>
                    </div>

                @endfor

            </div>

        </div>

    </div>

    <div class="padding_tb col-md-12">
        {!! Form::submit('Create your material', ['class' => 'btn btn-success form-control']) !!}
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