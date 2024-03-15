@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.admincreateoreditnav name=user title="{{ __('label.systeminfo_title')}}"  :obj="Auth::user()" backbutton="adminsettings" />

<main class="w-full flex-grow p-3">
    <div class="p-2 mt-4 lg:mt-0 rounded shadow bg-white">
       <iframe class="w-full h-screen" src="{{route('decompose')}}">Your browser isn't compatible</iframe>
    </div>
    </div>
 </main>

@endsection
@section('footerSection')
@endsection
