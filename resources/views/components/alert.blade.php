 
<div {{ $attributes->merge(['class' => 'alert alert-dismissible my-2']) }} role="alert">
    {{$slot}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>