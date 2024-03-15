<ul class="flex justify-between bg-blue-500 text-white rounded p-2">
    <li class="mr-3 lg:text-xl text-xl">
        @if ($obj->id)
        <i class="fas fa-list mr-3"></i> {{ __('label.update')}} {{ $title }}
        @else
        <i class="fas fa-list mr-3"></i> {{ __('label.addnew')}} {{ $title }}
        @endif
    </li>
    <li class="mr-3">
        @if($backbutton == 'enable')
       <a class="inline-block border border-gray-500 rounded py-1 px-4 bg-gray-600 hover:bg-gray-700 text-white" href="{{route($name.'.index')}}">{{ __('label.backbuttton_back')}}</a>
       @elseif ($backbutton == 'title')
        <a class="inline-block border border-green-500 rounded py-1 px-4 bg-green-500 hover:bg-green-600 text-white" href="{{route($name.'.index')}}">{{ $title }} {{ __('label.list')}}</a>
       @elseif ($backbutton == 'adminsettings')
       <a class="inline-block border border-gray-500 rounded py-1 px-4 bg-gray-600 hover:bg-gray-700 text-white" href="{{route('settings')}}">{{ __('label.backbuttton_back')}}</a>
       @endif
    </li>
 </ul>
