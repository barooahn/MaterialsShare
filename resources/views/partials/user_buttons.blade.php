<div class="user_buttons">
    @if(Auth::user())

        @include('partials.rate')


        <div class="btn-group btn-group-justified">


            @if(Auth::user()->id == $material->user_id)


                @include('partials.buttons.delete')

                @include('partials.buttons.edit')

                @include('partials.buttons.private')

            @elseif($material->liked())


                <a class="btn btn-danger user_button form-control"
                   href="{{ URL::route('addLike', array('material' => $material)) }}">Remove</a>


            @else

                <a class="btn btn-success user_button form-control"
                   href="{{ URL::route('addLike', array('material' => $material)) }}">Save</a>


            @endif
        </div>



    @endif

</div>