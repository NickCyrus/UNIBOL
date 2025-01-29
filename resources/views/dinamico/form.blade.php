@php
    $slug = getCurrentRouteGroup();
@endphp
@extends('app')
@section('content')
<div class="card">
    <div class="card-header">
            <a class="btn btn-danger pull-right  event-plus" href="{{route("{$slug}")}}">
                <i class='bx bx-left-arrow-alt' ></i> &nbsp; Cancelar
            </a>
       <h4 class="fw-bold">
        @isset($prefixTitle) <span class="text-muted fw-light">{!!$prefixTitle!!} /</span> @endisset {{$title}}
       </h4>

    </div>
    <div class="p-3">
        <form action="{{route("{$slug}.save")}}" method="POST" enctype="multipart/form-data">
                @csrf
                {!!(makeForm($form , $info , $event))!!}
                @include('component.btn-event',['slug'=>$slug])                
        </form>
    </div>
  </div>

  @if($errors->any() && 1==2)
    {{ implode('', $errors->all('<div>:message</div>')) }}
  @endif

@endsection
@section('addFooter')
    @includeIf("$viewPath.form.footer",['slug'=>$slug])
@endsection



