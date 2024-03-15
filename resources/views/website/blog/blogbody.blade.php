@if($post)

@if($post->video_status)
<article class="bg-white overflow-hidden rounded-lg shadow hover:shadow-lg mb-4">
   <video
   id="vid1"
   class="video-js vjs-default-skin block h-96 w-full"
   controls
   data-setup='{ "techOrder": ["youtube", "html5"], "sources": [{ "type": "video/youtube", "src": "{{ $post->video_link }}"}] }'
 >
 </video>
    <div class="mt-4 md:mt-0 md:ml-4 p-2">
       
       <a class="text-dark block py-2 text-3xl leading-tight font-semibold hover:underline">{{ $post->title }}</a>
       <a href="{{ route('category', [$post->category_id ]) }}" class="shadow uppercase hover:shadow-lg p-1 {{ App::make('configuration')->text_color }} text-sm {{ App::make('configuration')->theme_color }} font-bold rounded-lg" style="background: #52b34d;">{{ $post->category }}</a>
       @if($post->country)
       <nav class="bg-gray-100 p-2 rounded font-sans w-full my-2">
         <ol class="list-reset flex text-grey-dark">
           <li><a href="#" class="text-blue font-bold">{{ $post->country }}</a></li>
           @if($post->state)
           <li><span class="mx-2">/</span></li>
           <li><a href="#" class="text-blue font-bold">{{ $post->state }}</a></li>
           @endif
           @if($post->city)
           <li><span class="mx-2">/</span></li>
           @endif
           <li>{{ $post->city }}</li>
         </ol>
       </nav>
       @endif
       @if($post->subtitle)
       <a class="block mt-1 mb-1 pt-2 text-xl leading-tight font-semibold text-yellow-600 hover:underline">{{ $post->subtitle }}</a>
       @endif
       <a><p class="mt-2 text-gray-600 text-justify">{!! htmlspecialchars_decode($post->body) !!} </p> </a>
       
     </div>
     <div class="flex justify-between md:flex-row lg:flex-row xl:flex-row 2xl:flex-row flex-col clear-both mt-4 md:mt-0 p-3 bg-gray-100 border-t-2">
        <div class="text-gray-500 italic md:ml-4"><small> Posted on {{ \Carbon\Carbon::parse($post->created_at)->format('F d,Y') }}</small></div>
        <div>
           <a href="{{ route('subcategory', [$post->subcategory_id, $post->category_id]) }}" class="text-white bg-gray-500 px-2 py-1 m-1 rounded-lg shadow"> {{ $post->subcategory }}</a>
        </div>
     </div>
 </article>
@elseif($post->image)
<article class="bg-white overflow-hidden rounded-lg shadow hover:shadow-lg mb-4">
   <a><img alt="Placeholder" class="block h-auto md:h-96 w-full" src="{{ url('/images/blog/images/'.$post->image) }}"></a>
   <div class="mt-4 md:mt-0 md:ml-4 p-2">
      <a class="text-dark block py-2 text-3xl leading-tight font-semibold hover:underline">{{ $post->title }}</a>
      <a href="{{ route('category', [$post->category_id ]) }}" class="shadow uppercase hover:shadow-lg p-1 {{ App::make('configuration')->text_color }} text-sm {{ App::make('configuration')->theme_color }} font-bold rounded-lg" style="background: #52b34d;">{{ $post->category }}</a>
      @if($post->country)
      <nav class="bg-gray-100 p-2 rounded font-sans w-full my-2">
        <ol class="list-reset flex text-grey-dark">
          <li><a href="#" class="text-blue font-bold">{{ $post->country }}</a></li>
          @if($post->state)
          <li><span class="mx-2">/</span></li>
          <li><a href="#" class="text-blue font-bold">{{ $post->state }}</a></li>
          @endif
          @if($post->city)
          <li><span class="mx-2">/</span></li>
          @endif
          <li>{{ $post->city }}</li>
        </ol>
      </nav>
      @endif
      @if($post->subtitle)
      <a class="block mt-1 mb-1 pt-2 text-xl leading-tight font-semibold text-yellow-600 hover:underline">{{ $post->subtitle }}</a>
      @endif
      <a><p class="mt-2 text-gray-600 text-justify">{!! htmlspecialchars_decode($post->body) !!} </p> </a>
   </div>
   <div class="flex justify-between md:flex-row lg:flex-row xl:flex-row 2xl:flex-row flex-col clear-both mt-4 md:mt-0 p-3 bg-gray-100 border-t-2">
      <div class="text-gray-500 italic md:ml-4"><small> Posted on {{ \Carbon\Carbon::parse($post->created_at)->format('F d,Y') }}</small></div>
      <div>
         <a href="{{ route('subcategory', [$post->subcategory_id, $post->category_id]) }}" class="text-white bg-gray-500 px-2 py-1 m-1 rounded-lg shadow"> {{ $post->subcategory }}</a>
      </div>
   </div>
</article>
@else
<article class="bg-white overflow-hidden rounded-lg shadow hover:shadow-lg mb-4">
    <div class="mt-4 md:mt-0 md:ml-4 p-2">
      <a class="text-dark block py-2 text-3xl leading-tight font-semibold hover:underline">{{ $post->title }}</a>
      <a href="{{ route('category', [$post->category_id ]) }}" class="shadow uppercase hover:shadow-lg p-1 {{ App::make('configuration')->text_color }} text-sm {{ App::make('configuration')->theme_color }} font-bold rounded-lg" style="background: #52b34d;">{{ $post->category }}</a>
      @if($post->country)
      <nav class="bg-gray-100 p-2 rounded font-sans w-full my-2">
        <ol class="list-reset flex text-grey-dark">
          <li><a href="#" class="text-blue font-bold">{{ $post->country }}</a></li>
          @if($post->state)
          <li><span class="mx-2">/</span></li>
          <li><a href="#" class="text-blue font-bold">{{ $post->state }}</a></li>
          @endif
          @if($post->city)
          <li><span class="mx-2">/</span></li>
          @endif
          <li>{{ $post->city }}</li>
        </ol>
      </nav>
      @endif
      @if($post->subtitle)
      <a class="block mt-1 mb-1 pt-2 text-xl leading-tight font-semibold text-yellow-600 hover:underline">{{ $post->subtitle }}</a>
      @endif
      <a><p class="mt-2 text-gray-600 text-justify">{!! htmlspecialchars_decode($post->body) !!} </p> </a>
    </div>
    <div class="flex justify-between md:flex-row lg:flex-row xl:flex-row 2xl:flex-row flex-col clear-both mt-4 md:mt-0 p-3 bg-gray-100 border-t-2">
       <div class="text-gray-500 italic md:ml-4"><small> Posted on {{ \Carbon\Carbon::parse($post->created_at)->format('F d,Y') }}</small></div>
       <div>
          <a href="{{ route('subcategory', [$post->subcategory_id, $post->category_id]) }}" class="text-white bg-gray-500 px-2 py-1 m-1 rounded-lg shadow"> {{ $post->subcategory }}</a>
       </div>
    </div>
 </article>

@endif
   @if(App::make('configuration')->disqusflag)
      @if($post->blogcomment)
         <div class="bg-white p-4 rounded-lg shadow">
            {!!  App::make('configuration')->disquscode !!}
         </div>
      @endif
   @endif
@else
<p> Will update soon </p>
@endif
<!-- END Article -->