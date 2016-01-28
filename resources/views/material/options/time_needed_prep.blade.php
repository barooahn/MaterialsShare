<div class="form_padding">
    {!! Form::label('time_needed_prep', 'Time Needed For Preparation:', array('class' => 'white_text')) !!}

    <div>
        <input class="prep_slider" type="text" name="time_needed_prep" data-slider-min="5"
               data-slider-max="90" data-slider-step="5" data-slider-value="
            {{isset($material->time_needed_prep) ? $material->time_needed_prep: "5"}}">
        <span class="white_text">Minutes: <span class="prep_time">
            {{isset($material->time_needed_prep) ? $material->time_needed_prep: "5"}}</span></span>
    </div>

    <br/>
</div>

