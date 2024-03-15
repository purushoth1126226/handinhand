@extends('components.website.layout.app')
@section('headSection')
@section('title', isset(App::make('configuration')->company_name) ? App::make('configuration')->company_name : '')
@section('description', isset(App::make('configuration')->description) ? App::make('configuration')->description : '' )
@section('keyword', isset(App::make('configuration')->keyword) ? App::make('configuration')->keyword : '')
@section('image', url("/image/".App::make('configuration')->uplode_logo_image))
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
@endsection
@section('main-content')
<div class="my-2 mx-auto px-1 md:px-2">
   <div class="flex flex-wrap">
      <!-- Left SideNav -->
      <div class="w-full md:w-1/2 lg:my-4 lg:px-3 lg:w-1/4">
         @include('website.blog.leftsidenav')
      </div>
      {{-- Blog Body --}}
      <div class="w-full md:w-1/2 lg:my-4 lg:px-3 lg:w-1/2 order-first md:order-none">
         @if($post)
         @foreach ($post as $eachPost)
         @if($eachPost->video_status)
         <article class="m-2 font-sans bg-white  rounded-lg shadow hover:shadow-lg leading-normal flex">
            <div class=" shadow-lg  overflow-hidden sm:flex">
               
               <div class="h-48 sm:h-auto sm:w-48 md:w-64 flex-none bg-cover bg-center rounded rounded-t sm:rounded sm:rounded-l text-center overflow-hidden">
                  <video
                  id="vid1"
                  class="video-js vjs-default-skin block h-64 w-full"
                  controls
                  data-setup='{ "techOrder": ["youtube", "html5"], "sources": [{ "type": "video/youtube", "src": "{{ $eachPost->video_link }}"}] }'
                  >
               </video>
               </div>
            
            <div class="px-6 py-4">
               <a href="{{ url('/blog/'.$eachPost->postslug) }}">
                  <h2 class="mb-2 font-black">{{ $eachPost->title }}</h2>
               </a>
               <a href="{{ route('category', [$eachPost->category_id ]) }}" class="shadow uppercase hover:shadow-lg p-1 {{ App::make('configuration')->text_color }} text-sm {{ App::make('configuration')->theme_color }} font-bold rounded-lg" style="background: #52b34d;">{{ $eachPost->category }}</a>
               <a href="{{ url('/blog/'.$eachPost->postslug) }}" >
                  <p class="mb-4 text-grey-500 text-sm">
                     {!! $eachPost->interpretation !!}
                  </p>
                  <div class="flex justify-between md:flex-row lg:flex-row xl:flex-row 2xl:flex-row flex-col clear-both">
                     <div class="text-gray-500 italic"><small> Posted on {{ \Carbon\Carbon::parse($eachPost->created_at)->format('F d,Y') }}</small></div>
                     <div>
                        <strong class="float-right text-yellow-600 mb-1">[Continue Reading...]</strong> 
                     </div>
                  </div>
               </a>
            </div>
        </div>
     </article>
     
         @elseif($eachPost->image)
            <article class="m-2 font-sans bg-white  rounded-lg shadow hover:shadow-lg leading-normal flex">
               <div class=" shadow-lg  overflow-hidden sm:flex">
                  <a href="{{ url('/blog/'.$eachPost->postslug) }}" >
                  <div class="h-48 sm:h-auto sm:w-48 md:w-64 flex-none bg-cover bg-center rounded rounded-t sm:rounded sm:rounded-l text-center overflow-hidden" style="background-image: url('{{ url("/images/blog/thumbnail/".$eachPost->image) }}')">
                  </a>
                  </div>
               
               <div class="px-6 py-4">
                  <a href="{{ url('/blog/'.$eachPost->postslug) }}">
                     <h2 class="mb-2 font-black">{{ $eachPost->title }}</h2>
                  </a>
                  <a href="{{ route('category', [$eachPost->category_id ]) }}" class="shadow uppercase hover:shadow-lg p-1 {{ App::make('configuration')->text_color }} text-sm {{ App::make('configuration')->theme_color }} font-bold rounded-lg" style="background: #52b34d;">{{ $eachPost->category }}</a>
                  <a href="{{ url('/blog/'.$eachPost->postslug) }}" >
                     <p class="mb-4 text-grey-500 text-sm">
                        {!! $eachPost->interpretation !!}
                     </p>
                     <div class="flex justify-between md:flex-row lg:flex-row xl:flex-row 2xl:flex-row flex-col clear-both">
                        <div class="text-gray-500 italic"><small> Posted on {{ \Carbon\Carbon::parse($eachPost->created_at)->format('F d,Y') }}</small></div>
                        <div>
                           <strong class="float-right text-yellow-600 mb-1">[Continue Reading...]</strong> 
                        </div>
                     </div>
                  </a>
               </div>
      </div>
      </article>
      @else
      <article class="m-2 font-sans bg-white  rounded-lg shadow hover:shadow-lg leading-normal flex">
         <div class=" shadow-lg  overflow-hidden sm:flex">        
         <div class="px-6 py-4">
            <a href="{{ url('/blog/'.$eachPost->postslug) }}">
               <h2 class="mb-2 font-black">{{ $eachPost->title }}</h2>
            </a>
            <a href="{{ route('category', [$eachPost->category_id ]) }}" class="shadow uppercase hover:shadow-lg p-1 {{ App::make('configuration')->text_color }} text-sm {{ App::make('configuration')->theme_color }} font-bold rounded-lg" style="background: #52b34d;">{{ $eachPost->category }}</a>
            <a href="{{ url('/blog/'.$eachPost->postslug) }}" >
               <p class="mb-4 text-grey-500 text-sm">
                  {!! $eachPost->interpretation !!}
               </p>
               <div class="flex justify-between md:flex-row lg:flex-row xl:flex-row 2xl:flex-row flex-col clear-both">
                  <div class="text-gray-500 italic"><small> Posted on {{ \Carbon\Carbon::parse($eachPost->created_at)->format('F d,Y') }}</small></div>
                  <div>
                     <strong class="float-right text-yellow-600 mb-1">[Continue Reading...]</strong> 
                  </div>
               </div>
            </a>
         </div>
     </div>
   </article>
      @endif
      @endforeach
      <div class="p-4">
         {!! $post->render() !!}
      </div>
      @else
      <p> Will update soon </p>
      @endif
      <!-- END Article -->
   </div>
   <!-- Right SideNav -->
   <div class="w-full md:w-1/2 lg:my-4 lg:px-3 lg:w-1/4">
      @include('website.blog.rightsidenav')
   </div>
</div>
</div>
@endsection
@section('footerSection')
@endsection