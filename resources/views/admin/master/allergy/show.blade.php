@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.adminshownav  name='allergy' title="{{ __('label.allery_title_show') }}- {{ $allergy->uniqid }}" backbutton="enable" />
<main class="w-full flex-grow px-6 py-2">
   <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white container mx-auto">
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.allergy_id_show') }}" value="{{ $allergy->uniqid }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.allergy_name_show') }}"  value="{{ $allergy->name }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.allergy_createdat_show') }}" value="{{date('d-m-Y,h:i:s', strtotime($allergy->created_at))}}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.allergy_createdby_show') }}" value="{{ $allergy->created_by }}" />
      </div>
      @if($allergy->updated_by)
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.allergy_updatedat_show') }}"  value="{{date('d-m-Y,h:i:s', strtotime($allergy->updated_at))}}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.allergy_updatedby_show') }}"  value="{{ $allergy->updated_by }}" />
      </div>
      @endif
   </div>
</main>
@endsection
@section('footerSection')
@endsection
