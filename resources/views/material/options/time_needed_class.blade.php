<div class="form-group">
    {!! Form::label('time_needed_class', 'Time Needed in Class:') !!}

    <div>
        <input class="class_slider" type="text" name="time_needed_class" data-slider-min="0"
               data-slider-max="90" data-slider-step="5" data-slider-value="
            {{isset($material->time_needed_class) ? $material->time_needed_class: "0"}}">
        <span>Minutes: <span class="class_time">
            {{isset($material->time_needed_class) ? $material->time_needed_class: "0"}}</span></span>
    </div>

</div>