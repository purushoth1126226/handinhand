<div class="p-2 text-white bg-blue-500 rounded-md shadow-md">
    <ul class="flex justify-between">
       <li>
          <span class="flex text-xl font-semibold tracking-wider uppercase">
             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 5c7.18 0 13 5.82 13 13M6 11a7 7 0 017 7m-6 0a1 1 0 11-2 0 1 1 0 012 0z" />
             </svg>
             &nbsp;{{ $title }}
          </span>
       </li>
       <li class="mr-2">
          @if($button == 'disable')
          <span></span>
          @elseif($button == 'ajax')
          @can($can)
          <a href="javascript:void(0)" class="bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-3 focus:ring-green-500 focus:ring-opacity-50 p-2 rounded" id="{{ 'add_'. $name }}">{{__('label.labinvestigation_create_index')}}</a>
          @endcan
          @elseif($button == 'normal')
          @can($can)
          <a class="bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-3 focus:ring-green-500 focus:ring-opacity-50 p-2 rounded" href="{{route($name.'.create')}}">{{__('label.labinvestigation_create_index')}}</a>
          @endcan
          @endif
       </li>
    </ul>
 </div>
