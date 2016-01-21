<div class="form-padding">
    {!! Form::label('pupil_task', 'Pupil Task(s):', array('class' => 'white_text')) !!}
    {!! Form::select('pupil_task[]', $pupil_tasks, $previous, ['id' => 'pupil_task', 'class' => 'form-control', 'multiple']) !!}
</div>