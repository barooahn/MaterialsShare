<div class="row">
    <div class="col-md-12">
        <div>
            <button type="button" class="btn btn-info expand form-control">Filer Materials</button>
        </div>
        <div class="content">


            {!! Form::open(['action' => 'MaterialsController@postFilter']) !!}

            @foreach($materials as $item)
                {!! Form::hidden('materials[]', $item->id) !!}
            @endforeach
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('activity_use', 'Activity Use:') !!}
                    {!! Form::select('activity_use[]', $activity_uses, null, ['id' => 'activity_use', 'multiple']) !!}
                </div>


                <div class="form-group">
                    {!! Form::label('book', 'Text Book:') !!}
                    {!! Form::select('book', $books, null, ['id' => 'book']) !!}
                </div>

            </div>
            <div class="col-md-3">
                <div class="form-group">

                    {!! Form::label('category', 'Educational institute:') !!}
                    {!! Form::select('category_list[]', $categories, null, ['id' => 'category', 'multiple']) !!}

                </div>

                <div class="form-group">
                    {!! Form::label('level', 'Level:') !!}
                    {!! Form::select('level[]', $levels, null, ['id' => 'level', 'multiple']) !!}
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('pupil_task', 'Pupil Task(s):') !!}
                    {!! Form::select('pupil_task[]', $pupil_tasks, null, ['id' => 'pupil_task', 'multiple']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('language_focus', 'Language Focus:') !!}
                    {!! Form::select('language_focus[]', $language_focuses, null, ['id' => 'language_focus', 'multiple']) !!}
                </div>

            </div>

            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('time_needed_class', 'Time Needed in Class:') !!}

                    <div>
                        <input class="class_slider" type="text" name="time_needed_class" data-slider-min="0"
                               data-slider-max="90" data-slider-step="5" data-slider-value="[0,90]">
                              <span>Minutes: <span class="class_time"></span></span>
                    </div>


                </div>
                <div class="form-group">
                    {!! Form::label('time_needed_prep', 'Time Needed For Preparation:') !!}

                    <div>
                        <input class="prep_slider" type="text" name="time_needed_prep" data-slider-min="0"
                               data-slider-max="90" data-slider-step="5" data-slider-value="[0,90]">
                           <span>Minutes: <span class="prep_time"></span></span>
                    </div>

                </div>

            </div>

            <div class="col-md-12">

                {!! Form::submit('Start filter', ['class' => 'btn btn-success btn-large form-control']) !!}

            </div>

            {!! Form::close() !!}

        </div>


    </div>
</div>
