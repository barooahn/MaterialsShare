<div class="form-padding">
    {!! Form::label('pupil_task', 'Pupil Task(s):') !!}
    {!! Form::select('pupil_task[]', $pupil_tasks, $previous, ['id' => 'pupil_task', 'class' => 'form-control', 'multiple']) !!}
</div>