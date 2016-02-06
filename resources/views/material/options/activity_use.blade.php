<div class="form-padding">
    {!! Form::label('activity_use', 'Activity Use:') !!}
    {!! Form::select('activity_use[]', $activity_uses, $previous, ['id' => 'activity_use', 'class' => 'form-control', 'multiple']) !!}
</div>