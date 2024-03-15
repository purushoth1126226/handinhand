@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.adminshownav  name='drug' title="{{__('label.drug_title_index')}} - {{ $drug->uniqid }}" backbutton="enable" />
<main class="w-full flex-grow px-6 py-2">
   <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white container mx-auto">
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.drug_id_show')}}"  value="{{ $drug->uniqid }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.drug_name_show')}}" value="{{ $drug->name }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.drug_genericname_create')}}"  value="{{ $drug->generic_name }}" />
         <div class="md:w-2/12 ">
       <label class="block text-gray-800 font-bold md:text-left mb-3 md:mb-0 ml-1">
       {{__('label.drug_classification_create')}}<span class="float-right text-dark px-1">:</span>
        </label>
      </div>
      <div class="md:w-4/12">
         <label class="block text-blue-800 font-bold md:text-left mb-3 md:mb-0 ml-3">
           {{ $drug->drug_classification }}
         </label>
       </div>
      </div>
      <div class="md:flex mb-3">
        <div class="md:w-2/12 ">
           <label class="block text-gray-800 font-bold md:text-left mb-3 md:mb-0 ml-1">
           {{__('label.drug_manufacturename_create')}}<span class="float-right text-dark px-1">:</span>
           </label>
       </div>
      <div class="md:w-4/12">
         <label class="block text-blue-800 font-bold md:text-left mb-3 md:mb-0 ml-3">
         {{ $drug->manufacture_name }}
         </label>
      </div>
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.drug_dosage_create')}}"  value="{{ $drug->dosage }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.drug_variant_create')}}"  value="{{Config('archive.drug_variant' )[$drug->drug_variant] }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_diagnosis_edit')}}"  value="{{ $drug->diagnosis->pluck('name')->implode(', ') }}" />
      </div>

      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.drug_remark_show')}}" value="{{ $drug->drug_remark }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.drug_createdat_show')}}"  value="{{date('d-m-Y,h:i:s', strtotime($drug->created_at))}}" />

      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.drug_createdby_show')}}"  value="{{$drug->created_by}}" />
      @if($drug->updated_by)
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.drug_updatedat_show')}}"  value="{{date('d-m-Y,h:i:s', strtotime($drug->updated_at))}}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.drug_updatedby_show')}}"  value="{{$drug->updated_by}}" />
      </div>
      @endif
   </div>
</main>
@endsection
@section('footerSection')
@endsection
