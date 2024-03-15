@if($post)
@foreach ($post as $eachPost)

@if($eachPost->video_status)
<article class="bg-white overflow-hidden rounded-lg shadow hover:shadow-lg mb-4">
   <video
   id="vid1"
   class="video-js vjs-default-skin block h-96 w-full"
   controls
   data-setup='{ "techOrder": ["youtube", "html5"], "sources": [{ "type": "video/youtube", "src": "{{ $eachPost->video_link }}"}] }'
 >
 </video>
    <div class="mt-4 md:mt-0 md:ml-4 p-2">
       <a href="{{ url('/blog/'.$eachPost->postslug) }}"  class="block mt-1 mb-1 text-lg leading-tight font-semibold text-gray-900 hover:underline">{{ $eachPost->title }}</a>
       <a href="{{ route('category', [$eachPost->category_id ]) }}" class="shadow uppercase hover:shadow-lg p-1 {{ App::make('configuration')->text_color }} text-sm {{ App::make('configuration')->theme_color }} font-bold rounded-lg" style="background: #52b34d;">{{ $eachPost->category }}</a>
       <a href="{{ url('/blog/'.$eachPost->postslug) }}" >
          <p class="mt-2 text-gray-600 text-justify">{!! $eachPost->interpretation !!} </p>
          <strong class="float-right text-yellow-600 mb-1">[Continue Reading...]</strong> 
       </a>
    </div>
    <div class="flex justify-between md:flex-row lg:flex-row xl:flex-row 2xl:flex-row flex-col clear-both mt-4 md:mt-0 p-3 bg-gray-100 border-t-2">
       <div class="text-gray-500 italic md:ml-4"><small> Posted on {{ \Carbon\Carbon::parse($eachPost->created_at)->format('F d,Y') }}</small></div>
       <div>
          <a href="{{ route('subcategory', [$eachPost->subcategory_id, $eachPost->category_id]) }}" class="text-white bg-gray-500 px-2 py-1 m-1 rounded-lg shadow"> {{ $eachPost->subcategory }}</a>
       </div>
    </div> 
 </article>
@elseif($eachPost->image)
<article class="bg-white overflow-hidden rounded-lg shadow hover:shadow-lg mb-4">
   <a href="{{ url('/blog/'.$eachPost->postslug) }}" >
   {{-- rounded-lg border-green-500 --}}
   <img alt="Placeholder" class="block h-auto md:h-80 w-full" src="{{ url('/images/blog/images/'.$eachPost->image) }}">
   </a>
   <div class="mt-4 md:mt-0 md:ml-4 p-2">
      <a href="{{ url('/blog/'.$eachPost->postslug) }}"  class="block mt-1 mb-1 text-lg leading-tight font-semibold text-gray-900 hover:underline">{{ $eachPost->title }}</a>
      <a href="{{ route('category', [$eachPost->category_id ]) }}" class="shadow uppercase hover:shadow-lg p-1 {{ App::make('configuration')->text_color }} text-sm {{ App::make('configuration')->theme_color }} font-bold rounded-lg" style="background: #52b34d;">{{ $eachPost->category }}</a>
      <a href="{{ url('/blog/'.$eachPost->postslug) }}" >
         <p class="mt-2 text-gray-600 text-justify">{!! $eachPost->interpretation !!} </p>
         <strong class="float-right text-yellow-600 mb-1">[Continue Reading...]</strong> 
      </a>
   </div>
   <div class="flex justify-between md:flex-row lg:flex-row xl:flex-row 2xl:flex-row flex-col clear-both mt-4 md:mt-0 p-3 bg-gray-100 border-t-2">
      <div class="text-gray-500 italic md:ml-4"><small> Posted on {{ \Carbon\Carbon::parse($eachPost->created_at)->format('F d,Y') }}</small></div>
      <div>
         <a href="{{ route('subcategory', [$eachPost->subcategory_id, $eachPost->category_id]) }}" class="text-white bg-gray-500 px-2 py-1 m-1 rounded-lg shadow"> {{ $eachPost->subcategory }}</a>
      </div>
   </div>
</article>
@else
<article class="bg-white overflow-hidden rounded-lg shadow hover:shadow-lg mb-4">
    <div class="mt-4 md:mt-0 md:ml-4 p-2">
       <a href="{{ url('/blog/'.$eachPost->postslug) }}"  class="block mt-1 mb-1 text-lg leading-tight font-semibold text-gray-900 hover:underline">{{ $eachPost->title }}</a>
       <a href="{{ route('category', [$eachPost->category_id ]) }}" class="shadow uppercase hover:shadow-lg p-1 {{ App::make('configuration')->text_color }} text-sm {{ App::make('configuration')->theme_color }} font-bold rounded-lg" style="background: #52b34d;">{{ $eachPost->category }}</a>
       <a href="{{ url('/blog/'.$eachPost->postslug) }}" >
          <p class="mt-2 text-gray-600 text-justify">{!! $eachPost->interpretation !!} </p>
          <strong class="float-right text-yellow-600 mb-1">[Continue Reading...]</strong> 
       </a>
    </div>
    <div class="flex justify-between md:flex-row lg:flex-row xl:flex-row 2xl:flex-row flex-col clear-both mt-4 md:mt-0 p-3 bg-gray-100 border-t-2">
       <div class="text-gray-500 italic md:ml-4"><small> Posted on {{ \Carbon\Carbon::parse($eachPost->created_at)->format('F d,Y') }}</small></div>
       <div>
          <a href="{{ route('subcategory', [$eachPost->subcategory_id, $eachPost->category_id]) }}" class="text-white bg-gray-500 px-2 py-1 m-1 rounded-lg shadow"> {{ $eachPost->subcategory }}</a>
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