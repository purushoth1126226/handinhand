@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.adminshownav  name='physicalandgeneralexamination' title="{{__('label.physicalandgeneralexamination_title_show')}}  - {{ $physicalandgeneralexamination->uniqid }}" backbutton="enable" />
<main class="w-full flex-grow px-6 py-2">
   <div class="p-8 mt-6 lg:mt-0 rounded shadow container bg-white  mx-auto">
      <div class="md:flex mb-3 ">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.physicalandgeneralexamination_id_show') }}" value="{{ $physicalandgeneralexamination->uniqid }}" />
         <div class="md:w-2/12 ">
           <label class="block text-gray-800 font-bold md:text-left mb-3 md:mb-0 ml-1">
           {{ __('label.physicalandgeneralexamination_name_show') }}<span class="float-right text-dark px-1">:</span>
           </label>
       </div>
      <div class="md:w-4/12">
         <label class="block text-blue-800 font-bold md:text-left mb-3 md:mb-0 ml-3">
         {{ $physicalandgeneralexamination->name }}
         </label>
      </div>

      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.physicalandgeneralexamination_createdat_show') }}" value="{{date('d-m-Y,h:i:s', strtotime($physicalandgeneralexamination->created_at))}}" />
         <x-admin.layouts.adminshowlabeldetails  title="{{ __('label.physicalandgeneralexamination_createdby_show') }}" value="{{$physicalandgeneralexamination->created_by}}" />
      </div>
      @if($physicalandgeneralexamination->updated_by)
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.physicalandgeneralexamination_updatedat_show') }}" value="{{date('d-m-Y,h:i:s', strtotime($physicalandgeneralexamination->updated_at))}}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.physicalandgeneralexamination_updatedby_show') }}" value="{{$physicalandgeneralexamination->updated_by}}" />
      </div>
      @endif
   </div>
</main>
@endsection
@section('footerSection')
@endsection
