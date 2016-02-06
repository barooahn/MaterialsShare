@if($material->private == 0)
    <a href="{{ route('togglePrivate', $material->id) }}"
       class="btn btn-danger user_button form-control">Make private</a>

@else
    <a href="{{ route('togglePrivate', $material->id) }}"
       class="btn btn-success user_button form-control">Make public</a>

@endif

