@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
@section('pagetitle', 'Settings')

<x-admin.layouts.adminshownav  name='addemployee' title="{{__('label.settings_title_index')}} - {{ $addemployee->uniqid }}" backbutton="enable" />

<main class="w-full flex-grow px-6 py-2">
   <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white container mx-auto">
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.settings_id_show')}}"  value="{{ $addemployee->uniqid }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.settings_name_show')}}" value="{{ $addemployee->name }}" />
      </div>
      <div class="md:flex mb-3">
        <x-admin.layouts.adminshowlabeldetails title="{{__('label.settings_mobileno_show')}}"  value="{{ $addemployee->phone }}" />
        <x-admin.layouts.adminshowlabeldetails title="{{__('label.settings_altno_show')}}"  value="{{ $addemployee->phone_two }}" />
     </div>
     <div class="md:flex mb-3">
        <x-admin.layouts.adminshowlabeldetails title="{{__('label.settings_email_show')}}"  value="{{ $addemployee->email }}" />
        <x-admin.layouts.adminshowlabeldetails title="{{__('label.settings_department_show')}}"  value="{{ $addemployee->department }}" />
      </div>
      <div class="md:flex mb-3">
        <x-admin.layouts.adminshowlabeldetails title="{{__('label.settings_empid_show')}}"  value="{{ $addemployee->employee_id }}" />
        <x-admin.layouts.adminshowlabeldetails title="{{__('label.settings_designation_show')}}"  value="{{ $addemployee->designation }}" />
      </div>
      <div class="md:flex mb-3">
      <x-admin.layouts.adminshowlabeldetails title="{{__('label.settings_email_show')}}"  value="{{ $addemployee->email }}" />
        <x-admin.layouts.adminshowlabeldetails title="{{__('label.settings_address_show')}}"  value="{{ $addemployee->address }}" />
      </div>
      <div class="md:flex mb-3">
      <x-admin.layouts.adminshowlabeldetails title="{{__('label.settings_role_show')}}"  value="{{ $role->name }}" />
      </div>
  
   </div>
</main>
@endsection
@section('footerSection')
@endsection
