<div class="form-group">

    {!! Form::label('category', 'Educational institute:') !!}
    {!! Form::select('category_list[]', $categories, $previous, ['id' => 'category', 'class' => 'form-control', 'multiple']) !!}

</div>