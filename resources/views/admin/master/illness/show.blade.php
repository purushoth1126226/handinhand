@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.adminshownav  name='illness' title="{{ __('label.illness_title_show') }} - {{ $illness->uniqid }}" backbutton="enable" />
<main class="w-full flex-grow px-6 py-2">
   <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white container mx-auto">
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.illness_id_show') }}"  value="{{ $illness->uniqid }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.illness_name_show') }}"   value="{{ $illness->name }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.illness_createdat_show') }}"   value="{{date('d-m-Y,h:i:s', strtotime($illness->created_at))}}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.illness_createdby_show') }}"  value="{{ $illness->created_by}}" />
      </div>
      @if($illness->updated_by)
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.illness_updatedat_show') }}"  value="{{date('d-m-Y,h:i:s', strtotime($illness->updated_at))}}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.illness_updatedby_show') }}"   value="{{ $illness->updated_by}}" />
      </div>
      @endif
   </div>
</main>
@endsection
@section('footerSection')
@endsection
