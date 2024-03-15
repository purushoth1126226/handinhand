@if(App::make('configuration')->mailchimpflag)
<article class="overflow-hidden rounded-lg">
    <div class="card rounded-lg overflow-hidden shadow hover:shadow-lg border-l-2 bg-white mt-2 mb-3 mr-1 pb-2">
      <div class="p-2  {{ App::make('configuration')->theme_color }}" style="background: #52b34d;">
         <p class="md:ml-1 font-semibold {{ App::make('configuration')->text_color }} text-xl"> Newsletter </p>
      </div>
    <form action="{{ url('newsletter') }}" method="post" class="form_prevent_multiple_submits">
       @csrf
       <div class="card-mail flex items-center mx-2 my-4">
          <input type="email" name="mail" value="{{ old("mail") }}" class="border-l border-t border-b {{ str_replace("bg","border", App::make('configuration')->theme_color ) }} rounded-l-md w-full text-base md:text-lg px-3 py-2" placeholder="Enter Your Email" novalidate>
          <button class="{{ App::make('configuration')->theme_color }} {{ App::make('configuration')->text_color }} button_prevent_multiple_submits font-bold capitalize px-3 py-2 text-base md:text-lg rounded-r-md border-t border-r border-b" style="background: #52b34d;">subscribe</button>
          <i class="fa fa-spinner m-1 text-green-500 fa-spin"></i>
       </div>
       @error('mail')
       <span class="ml-4"> @include('helper.formerror', ['error' => "mail"]) </span>
       @enderror
    </form>
    </div>
</article>
@endif



@if($aboutme->active)

@if($aboutme->avataractive)
<div class="card rounded-lg overflow-hidden shadow hover:shadow-lg border-l-2 bg-white mt-2 mb-3 mr-1 pb-2">
   <div class="flex p-2 {{ App::make('configuration')->theme_color }}" style="background: #52b34d;">
      @if($aboutme->avatar)
      <img src="{{ URL('/avatar/thumbnail/'.  $aboutme->avatar) }}"
         class="h-14 w-14 rounded-full mr-2 object-cover" />
      <div>
      @else
      <img src="{{ URL('/avatar/profile.jpg') }}"
         class="h-14 w-14 rounded-full mr-2 object-cover" />
      <div>
      @endif
         <p class="font-semibold {{ App::make('configuration')->text_color }} text-lg"> {{ $aboutme->avatartaglineone }}</p>
         <p class="font-semibold {{ App::make('configuration')->text_color }} text-md"> {{ $aboutme->avatartaglinetwo }}</p>
      </div>
   </div>
     <p class="text-justify p-4 text-gray-900 leading-sm">
      {!! $aboutme->body !!}
     </p>
</div>
@else 

<div class="card rounded-lg overflow-hidden shadow hover:shadow-lg border-l-2 bg-white mt-2 mb-3 mr-1 pb-2">
   <div class="p-2  {{ App::make('configuration')->theme_color }}" style="background: #52b34d;">
       <p class="md:ml-1 font-semibold {{ App::make('configuration')->text_color }} text-xl"> {{ $aboutme->title }} </p>
    </div>
    <p class="text-justify text-gray-900 leading-sm">
     {!! $aboutme->body !!}
    </p>
</div>

@endif
@endif

@if(!$categories->isEmpty())
<div class="flex p-1 mt-1">
    <div class="w-full my-2 {{ App::make('configuration')->theme_color }} rounded-lg shadow hover:shadow-lg" style="background: #52b34d;">
       <div class="flex p-3">
          <h2 class="md:ml-1 text-xl font-semibold {{ App::make('configuration')->text_color }}"> Category </h2>
       </div>
       @foreach($categories as $eachCategories)
       <div x-data={show:false} class="rounded-sm">
           <a href="#hover" @click="show=!show">
          <div class="border bg-white px-1 py-4 hover:bg-gray-200" id="heading{{ $eachCategories->id }}">
             <svg class="fill-current text-dark inline-block h-5 w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
             </svg>
             {{ $eachCategories->name }}
             <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full {{ App::make('configuration')->text_color }} {{ App::make('configuration')->theme_color }} uppercase last:mr-0 mr-1 float-right" style="background: #52b34d;">
                 {{ App\Models\Admin\Blog\Post::where('category_id', $eachCategories->id)->count() }}
                </span>
            </div>
        </a>
          <div x-show="show" class="border pl-10 py-4 bg-gray-100 text-gray-700">
             @foreach($eachCategories->subcategories as $eachSubCategoriesList)
             <ul class="list-disc">
                <li>
                   <a class="" href="{{ route('subcategory', [$eachSubCategoriesList->id, $eachCategories->id]) }}">
                   <strong> {{ $eachSubCategoriesList->name }} </strong>
                   <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full {{ App::make('configuration')->text_color }} {{ App::make('configuration')->theme_color }} uppercase last:mr-0 mr-1" style="background: #52b34d;">
                   {{ App\Models\Admin\Blog\Post::where('category_id', $eachCategories->id)->where('subcategory_id', $eachSubCategoriesList->id)->count() }}
                   </span>
                   </a>
                </li>
             </ul>
             @endforeach
          </div>
       </div>
       @endforeach 
    </div>
</div>
@endif

@if(!$tags->isEmpty())
<div class="flex p-1 mt-1">
    <div class="w-full my-2 {{ App::make('configuration')->theme_color }} rounded-lg shadow hover:shadow-lg" style="background: #52b34d;">
       <div class="flex p-3">
          <h2 class="md:ml-1 text-xl font-semibold {{ App::make('configuration')->text_color }}"> Tags </h2>
       </div>
       @foreach($tags as $eachtags)
       <a href="{{ route('tag', [$eachtags->id, $eachtags->slug]) }}" >

        <div class="border bg-white px-1 py-4 hover:bg-gray-200" id="heading{{ $eachtags->id }}">
            <svg class="fill-current text-dark inline-block h-5 w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
              </svg>
            {{ $eachtags->name }}
            <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full {{ App::make('configuration')->text_color }} {{ App::make('configuration')->theme_color }} uppercase last:mr-0 mr-1 float-right" style="background: #52b34d;">
                {{ $eachtags->tagposts->count() }}
               </span>
           </div>
       </a>
       @endforeach 
    </div>
</div>
@endif





