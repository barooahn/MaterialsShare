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
                   href="{{ route('addLike', $material->id) }}">Remove from My Materials</a>

            @else

                <a class="btn btn-success user_button form-control"
                   href="{{ route('addLike', $material->id) }}">Save to My Materials</a>


            @endif
        </div>



    @endif

</div>