@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.adminshownav  name='vital' title="{{ __('label.patientvitalshistory_title_index')}} - {{ $vital->uniqid }}" backbutton="enable" />
<main class="w-full flex-grow px-6 py-2">
   <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white container mx-auto">
   <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
     <li class="mr-3 lg:text-xl text-xl">
     {{ __('label.patientvitalshistory_patientdetials_show')}}
      </li>
  </ul>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_id_show')}}" value="{{ $vital->uniqid }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_patientname_show')}}" value="{{ $vital->name }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_age_show')}}" value="{{ $vital->age }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_sexuality_show')}}" value="{{ config('archive.sexuality')[$vital->sexuality] }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_fatherorhusband_show')}}" value="{{ $vital->fatherorhusband }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_mobileno_show')}}" value="{{ $vital->phone }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_village_show')}}" value="{{ ($vital->village) ? $vital->village->name : '' }}" />
         @if($vital->dob)
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_dob_show')}}" value="{{date('d-m-Y', strtotime($vital->dob))}}" />
         @endif
      </div>
      <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
        <li class="mr-3 lg:text-xl text-xl">
        {{ __('label.patientvitalshistory_title')}}
        </li>
    </ul>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_temperature_show')}}"  value="{{ $vital->temperature }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_bloodpressure_show')}}" value="{{ $vital->bloodpressure }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_height_show')}}" value="{{ $vital-> height}}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_weight_show')}}" value="{{ $vital->weight }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_pulserate_show')}}" value="{{ $vital->pulserate }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_respiratoryrate_show')}}" value="{{ $vital->respiratoryrate }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_sptwo_show')}}" value="{{ $vital->spo_two }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_painscale_show')}}" value="{{ $vital->painscaleone }}" />
      </div>
      <div class="md:flex mb-3">
         <!-- <x-admin.layouts.adminshowlabeldetails title='PAIN SCALE TWO' value="{{ $vital-> painscaletwo}}" /> -->
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_location_show')}}" value="{{ $vital-> location}}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_character_show')}}" value="{{ $vital-> character}}" />
      </div>
      <div class="md:flex mb-3">
        <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_allergy_show')}}" value="{{ $vital->allergy->pluck('name')->implode(', ') }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_currentcomplaints_show')}}" value="{{ $vital->illness->pluck('name')->implode(', ') }}" />
      </div>
      <div class="md:flex mb-3">
      <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_alcohol_show')}}" value="{{isset($vital) && ($vital->alcohol == 0)  ? 'NO' : 'YES' }}" />
      <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_smoking_show')}}"  value="{{isset($vital) && ($vital->smoking == 0)  ? 'NO' : 'YES' }}" />
      </div>
      <div class="md:flex mb-3">
        <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_tobacco_show')}}"  value="{{isset($vital) && ($vital->tobacco == 0)  ? 'NO' : 'YES' }}" />
        <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_others_show')}}"  value="{{ $vital-> others}}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_doctor_show')}}"  value="{{ $vital->doctors}}" />
      </div>

      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_createdat_show')}}"  value="{{date('d-m-Y', strtotime($vital->created_at))}}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_createdby_show')}}"  value="{{ $vital->created_by }}" />
      </div>
      @if($vital->updated_by)
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_updatedat_show')}}"  value="{{date('d-m-Y', strtotime($vital->updated_at))}}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientvitalshistory_updatedby_show')}}"  value="{{ $vital->updated_by }}" />
      </div>
      @endif
   </div>
</main>
@endsection
@section('footerSection')
@endsection
