@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.adminshownav  name='diagnosis' title="{{ __('label.diagnosis_title_show') }} - {{ $diagnosis->uniqid }}" backbutton="enable" />
<main class="w-full flex-grow px-6 py-2">
   <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white container mx-auto">
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.diagnosis_id_show') }}" value="{{ $diagnosis->uniqid }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.diagnosis_diagnosis_show') }}" value="{{ $diagnosis->name }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.diagnosis_createdat_show') }}" value="{{date('d-m-Y,h:i:s', strtotime($diagnosis->created_at))}}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.diagnosis_createdby_show') }}" value="{{$diagnosis->created_by}}" />
      </div>
      @if($diagnosis->updated_by)
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.diagnosis_updatedat_show') }}" value="{{date('d-m-Y,h:i:s', strtotime($diagnosis->updated_at))}}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.diagnosis_updatedby_show') }}" value="{{$diagnosis->updated_by}}" />
      </div>
      @endif
   </div>
</main>
@endsection
@section('footerSection')
@endsection
