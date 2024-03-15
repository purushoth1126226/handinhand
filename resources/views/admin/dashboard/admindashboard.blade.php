@extends('components.admin.layouts.adminapp')
@section('headSection')
{{ Html::style( asset('/calendar/css/jquery-ui.css')) }}
{{ Html::style( asset('/calendar/css/fullcalendar.min.css')) }}
{{ Html::style( asset('/calendar/css/fullcalendar.print.min.css')) }}
{{-- <link href='https://fullcalendar.io/releases/fullcalendar/3.9.0/fullcalendar.print.min.css' rel='stylesheet' media='print' /> --}}
@endsection
@section('main-content')
<x-admin.layouts.adminindexnav can="ttest" name=dashboard title="{{ __('label.sidenav_dashboard') }}" button='disable' gate='true' />


<div class="container mx-auto my-8">
  <div class="grid gap-7 sm:grid-cols-2 lg:grid-cols-4">
     <div class="p-5 bg-white rounded shadow-lg hover:bg-green-500 hover:text-white">
        <div class="text-gray-800 hover:text-white">{{ __('label.dashboard_todayenrollment') }}</div>
        <div class="flex items-center pt-1">
           <div class="text-2xl font-bold text-gray-900 ">{{ $data['todayenrollment'] }}</div>
           {{-- <span class="flex items-center px-2 py-0.5 mx-2 text-sm text-green-600 bg-green-100 rounded-full">
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                 <path d="M18 15L12 9L6 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
              <span>1.8%</span>
           </span> --}}
        </div>
     </div>
     <div class="p-5 bg-white rounded shadow-lg hover:bg-green-500 hover:text-white">
        <div class="text-gray-800 hover:text-white">{{ __('label.dashboard_totalenrollment') }}</div>
        <div class="flex items-center pt-1">
           <div class="text-2xl font-bold text-gray-900 ">{{ $data['totalenrollment'] }}</div>
           {{-- <span class="flex items-center px-2 py-0.5 mx-2 text-sm text-red-600 bg-red-100 rounded-full">
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                 <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
              <span>2.5%</span>
           </span> --}}
        </div>
     </div>
     <div class="p-5 bg-white rounded shadow-lg hover:bg-green-500 hover:text-white">
        <div class="text-gray-800 hover:text-white">{{ __('label.dashboard_todayvital') }}</div>
        <div class="flex items-center pt-1">
           <div class="text-2xl font-bold text-gray-900 ">{{ $data['todayvital'] }}</div>
           {{-- <span class="flex items-center px-2 py-0.5 mx-2 text-sm text-green-600 bg-green-100 rounded-full">
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                 <path d="M18 15L12 9L6 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
              <span>5.2%</span>
           </span> --}}
        </div>
     </div>
     <div class="p-5 bg-white rounded shadow-lg hover:bg-green-500 hover:text-white">
        <div class="text-gray-800 hover:text-white">{{ __('label.dashboard_totalvital') }}</div>
        <div class="flex items-center pt-1">
           <div class="text-2xl font-bold text-gray-900 ">{{ $data['totalvital'] }}</div>
           {{-- <span class="flex items-center px-2 py-0.5 mx-2 text-sm text-green-600 bg-green-100 rounded-full">
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                 <path d="M18 15L12 9L6 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
              <span>2.2%</span>
           </span> --}}
        </div>
     </div>
  </div>
</div>
<div class="md:m-5 grid grid-cols-1 md:grid-cols-2 ">
  <div class="bg-white rounded shadow mx-1 ">
     <div class="bg-blue-500 rounded mb-2 p-3 text-lg text-white"> {{ __('label.dashboard_calender') }}
        <a class="shadow float-right bg bg-green-500 hover:bg-green-600 rounded p-1 text-sm" href="{{route('eventcalendar.index')}}" class="btn btn-sm btn-success " role="button">ADD EVENT</a>
     </div>
     <div class="card-body p-2">
        <div id='calendar'></div>
     </div>
  </div>
  <div class="card shadow rounded mx-1 bg-white">
     <div class="bg-blue-500 rounded mb-2 p-3 text-lg text-white"> {{ __('label.dashboard_activestatus') }}</div>
     <div class="p-2">
        <ul class="">
           @if(isset($tracking))
           @foreach($tracking as  $track)
           <li class="m-1">
              <div style="font-family: '"Times New Roman", Times, serif';>
              <span class="bg-blue-500 p-1 text-white rounded shadow ">{{ $track->name }}</span>
              <span>{{ $track->details }}</span>
              <span class=" text-blue-500 float-right">{{ \Carbon\Carbon::parse($track->created_at)->diffForHumans()  }}</span>
     </div>
     </li>
     @endforeach
     @endif
     </ul>
  </div>
</div>
</div>
<div class="md:m-5 grid grid-cols-1 md:grid-cols-2 ">
  <div class="bg-white rounded shadow mx-1 ">
     <div class="bg-blue-500 rounded mb-2 p-3 text-lg text-white"> {{ __('label.dashboard_loginstatus') }}</div>
     <div class="card-body p-2">
        <ul class="list-disc ml-6">
           <li>Last Login At : {{ Auth()->User()->last_login_at }}</li>
           <li>Last Login IP : {{ Auth()->User()->last_login_ip }}</li>
        </ul>
     </div>
  </div>
</div>







@endsection
@section('footerSection')
{!! Html::script('/calendar/js/moment.min.js'); !!}
{!! Html::script('/calendar/js/fullcalendar.min.js'); !!}

<script>
  $(document).ready(function() {
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,basicDay'
      },
      displayEventTime: false,
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: <?php echo json_encode($eventcalendar); ?>,
      eventClick: function(event) {
            if (event.url) {
                window.open(event.url, "_blank");
                return false;
            }
        },
    });
  });
</script>
@endsection