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
            <p>Select which fields you wish to create by clicking/taping on them</p>
            <p>Note: click or hover on <i class="fa fa-info-circle fa-lg"></i> for extra information</p>
            <hr>
        </div>

        {!! Form::open(['action' => 'MaterialsController@postOptions']) !!}
        <div class="col-md-6">

            <div class="btn-group-vertical checkbox_option" data-toggle="buttons">

                @for($i=1; $i < 11; $i++)


                <label class="btn btn-primary {{$options[$i]->option}}">
                    {!!  Form::checkbox($options[$i]->option, 1, null, ['data-onstyle'=> 'success'
                    ]) !!} {{ucwords(str_replace('_', ' ', $options[$i]->option))}}


                    <i class="fa fa-info-circle fa-lg" data-toggle="tooltip" data-placement="right"
                       title="{{$options[$i]->description}}"></i>

                </label>

                @endfor

            </div>
        </div>
        <div class="col-md-6">

            <div class="btn-group-vertical checkbox_option" data-toggle="buttons">

                @for($i=11; $i < count($options); $i++)


                    <label class="btn btn-primary  {{$options[$i]->option}}">
                        {!!  Form::checkbox($options[$i]->option, 1, null, ['data-onstyle'=> 'success'
                        ]) !!} {{ucwords(str_replace('_', ' ', $options[$i]->option))}}



                        <i class="fa fa-info-circle fa-lg" data-toggle="tooltip" data-placement="right"
                           title="{{$options[$i]->description}}"></i>
                    </label>

                @endfor

            </div>

        </div>

    </div>

    <div id="format" class="padding_tb col-md-12">
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
