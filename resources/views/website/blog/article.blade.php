@extends('components.website.layout.app')
@section('headSection')
@section('title', $post ? $post->title : '')
@section('description', $post ? $post->description : '' )
@section('keyword', $post ? $post->keyword : '')
@section('image', ($post && $post->image) ? url('/images/blog/images/'.$post->image) : "/image/".App::make('configuration')->uplode_logo_image)
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
         @include('website.blog.blogbody')
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