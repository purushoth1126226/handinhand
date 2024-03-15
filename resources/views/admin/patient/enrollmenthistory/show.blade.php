@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.adminshownav  name='enrollmenthistory' title="{{ __('label.patientenrollmenthistory_title_index')}}- {{ $vital->uniqid }}" backbutton="enable" />
<main class="w-full flex-grow px-6 py-2">
   <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white container mx-auto">
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientenrollmenthistory_id_show')}}" value="{{ $vital->uniqid }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientenrollmenthistory_patientname_show')}}"  value="{{ $vital->name }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientenrollmenthistory_age_show')}}"  value="{{ $vital->age }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientenrollmenthistory_sexuality_show')}}"  value="{{ Config('archive.sexuality')[$vital->sexuality] }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientenrollmenthistory_fatherorhusband_show')}}"  value="{{ $vital->fatherorhusband }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientenrollmenthistory_mobileno_show')}}" value="{{ $vital->phone }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientenrollmenthistory_village_show')}}" value="{{ ($vital->village) ? $vital->village->name : '' }}" />
         @if($vital->dob)
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientenrollmenthistory_dob_show')}}"  value="{{date('d-m-Y', strtotime($vital->dob))}}" />
         @endif
      </div>

      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientenrollmenthistory_createdat_show')}}"  value="{{date('d-m-Y,h:i:s', strtotime($vital->created_at))}}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientenrollmenthistory_createdby_show')}}"  value="{{ $vital->created_by }}" />
      </div>
      @if($vital->updated_by)
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientenrollmenthistory_updatedat_show')}}"  value="{{date('d-m-Y,h:i:s', strtotime($vital->updated_at))}}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientenrollmenthistory_updatedby_show')}}"  value="{{ $vital->updated_by }}" />
      </div>
      @endif
   </div>
</main>
@endsection
@section('footerSection')
@endsection
