<ul class="flex justify-between bg-blue-500 text-white p-1 rounded">
    <li class="mr-3 lg:text-xl text-xl">
        <i class="fas fa-eye mr-3"></i>{{ $title }}
    </li>
    <li class="mr-3">
        @if($backbutton == 'enable')
       <a class="inline-block border border-gray-500 rounded py-1 px-4 bg-gray-600 hover:bg-gray-700 text-white" href="{{route($name.'.index')}}">{{__('label.diagnosis_back_create')}}</a>
       @endif
    </li>
 </ul>


