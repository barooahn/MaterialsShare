<div class="form_padding">
    {!! Form::label('time_needed_class', 'Time Needed in Class:', array('class' => 'white_text')) !!}

    <div>
        <input class="class_slider" type="text" name="time_needed_class" data-slider-min="5"
               data-slider-max="90" data-slider-step="5" data-slider-value="
            {{isset($material->time_needed_class) ? $material->time_needed_class: "5"}}">
        <span class="white_text">Minutes: <span class="class_time">
            {{isset($material->time_needed_class) ? $material->time_needed_class: "5"}}</span></span>
    </div>

    <br/>
</div>