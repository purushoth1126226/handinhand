@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<main class="w-full flex-grow px-6 py-2">
   <x-admin.layouts.adminshownav  name='eventcalendar' title="EVENT CALENDAR - {{ $eventcalendar->uniqid }}" backbutton="enable" />
   <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white container mx-auto">
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title='ID' value="{{ $eventcalendar->uniqid }}" />
         <x-admin.layouts.adminshowlabeldetails title='TITLE' value="{{ $eventcalendar->title }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title='STATUS' value="{{ isset($eventcalendar) ? 'Active' : 'In Active' }}" />
         <x-admin.layouts.adminshowlabeldetails title='START DATE' value="{{ $eventcalendar->start }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title='END DATE' value="{{ $eventcalendar->end }}" />
         <x-admin.layouts.adminshowlabeldetails title='CREATED BY' value="{{ $eventcalendar->created_by }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title='CREATED AT' value="{{ $eventcalendar->created_at }}" />
         <x-admin.layouts.adminshowlabeldetails title='UPDATED AT' value="{{ $eventcalendar->updated_at }}" />
      </div>
   </div>
</main>
@endsection
@section('footerSection')
@endsection

