<div class="form-group">
    {!! Form::label('time_needed_prep', 'Time Needed For Preparation:') !!}

    <div>
        <input class="prep_slider" type="text" name="time_needed_prep" data-slider-min="0"
               data-slider-max="90" data-slider-step="5" data-slider-value="
            {{isset($material->time_needed_prep) ? $material->time_needed_prep: "0"}}">
        <span>Minutes: <span class="prep_time">
            {{isset($material->time_needed_prep) ? $material->time_needed_prep: "0"}}</span></span>
    </div>

</div>