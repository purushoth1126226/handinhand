@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.adminshownav  name='village' title="{{__('label.village_title_index')}} - {{ $village->uniqid }}" backbutton="enable" />
<main class="w-full flex-grow px-6 py-2">
   <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white container mx-auto">
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.village_id_show')}}" value="{{ $village->uniqid }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.village_name_show')}}" value="{{ $village->name }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.village_createdat_show')}}" value="{{date('d-m-Y,h:i:s', strtotime($village->created_at))}}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.village_createdby_show')}}" value="{{$village->created_by}}" />
      </div>
      @if($village->updated_by)
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.village_updatedat_show')}}" value="{{date('d-m-Y,h:i:s', strtotime($village->updated_at))}}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.village_updatedby_show')}}" value="{{$village->updated_by}}" />
      </div>
      @endif
   </div>
</main>
@endsection
@section('footerSection')
@endsection
