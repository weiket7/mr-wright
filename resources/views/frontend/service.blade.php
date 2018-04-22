@extends('frontend.template', [
  'title'=>'services / '.$current_service->title,
  'meta_title'=>$current_service->meta_title,
  'meta_keyword'=>$current_service->meta_keyword,
  'meta_desc'=>$current_service->meta_desc
])

@section('content')
  <div class="column column-1-4">
    <ul class="vertical-menu">
      @foreach($services as $service)
        <li {{ $current_service->url == $service->url ? "class=selected" : "" }}>
          <a href="{{url('services/'.$service->url)}}">
            {{ $service->title }}
            <span class="template-arrow-menu"></span>
          </a>
        </li>
      @endforeach
    </ul>
  </div>
  <div class="column column-3-4">
    <div class="r-row">
      <div class="column column-1-2">
        <a href="{{url('assets/images/frontend/services/'.$current_service->image1)}}" class="prettyPhoto re-preload" title="{{$current_service->title}}">
          <img src='{{url('assets/images/frontend/services/'.$current_service->image1)}}' alt='img'>
        </a>
      </div>
      <div class="column column-1-2">
        <a href="{{url('assets/images/frontend/services/'.$current_service->image2)}}" class="prettyPhoto re-preload" title="{{$current_service->title}}">
          <img src='{{url('assets/images/frontend/services/'.$current_service->image2)}}' alt='img'>
        </a>
      </div>
    </div>
    <div class="r-row page-margin-top">
      <div class="column-1-1">
        <h1 class="box-header">
          {{$current_service->title}}
        </h1>
        <div class="description t1">
          {!! $current_service->content !!}
        </div>
      </div>
    </div>
  </div>
@endsection