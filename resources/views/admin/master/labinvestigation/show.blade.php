@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.adminshownav  name='labinvestigation' title="{{__('label.labinvestigation_title_show')}} - {{ $labinvestigation->uniqid }}" backbutton="enable" />
<main class="w-full flex-grow px-6 py-2">
   <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white container mx-auto">
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.labinvestigation_id_show')}}"  value="{{ $labinvestigation->uniqid }}" />
     <div class="md:w-2/12 ">
       <label class="block text-gray-800 font-bold md:text-left mb-3 md:mb-0 ml-1">
       {{__('label.labinvestigation_name_show')}}<span class="float-right text-dark px-1">:</span>
        </label>
    </div>
     <div class="md:w-4/12">
         <label class="block text-blue-800 font-bold md:text-left mb-3 md:mb-0 ml-3">
         {{ $labinvestigation->name }}
       </label>
    </div>

      </div>
      <div class="md:flex mb-3">
        <x-admin.layouts.adminshowlabeldetails title="{{__('label.labinvestigation_range_show')}}" value="{!! $labinvestigation->range !!}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.labinvestigation_createdat_show')}}"  value="{{date('d-m-Y,h:i:s', strtotime($labinvestigation->created_at))}}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.labinvestigation_createdby_show')}}"  value="{{$labinvestigation->created_by}}" />
      </div>
      @if($labinvestigation->updated_by)
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.labinvestigation_updatedat_show')}}"  value="{{date('d-m-Y,h:i:s', strtotime($labinvestigation->updated_at))}}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.labinvestigation_updatedby_show')}}"  value="{{$labinvestigation->updated_by}}" />
      </div>
      @endif
   </div>
</main>
@endsection
@section('footerSection')
@endsection
