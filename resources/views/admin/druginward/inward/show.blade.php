@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.adminshownav name='inward' title="{{__('label.inward_title_create')}} - {{ $inward->uniqid }}" backbutton="enable" />
<main class="w-full flex-grow px-6 py-2">
   <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white container mx-auto">
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.drug_id_show')}}" value="{{ $inward->uniqid }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.drug_id_show')}}" value="{{ $inward->supplier_uniqid }}" />
            </div>
            <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.inward_companyname_create')}}" value="{{ $inward->companyname }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.inward_name_create')}}" value="{{ $inward->supplier_name }}" />
            </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.inward_contactmobno_create')}}" value="{{ $inward->phone }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.inward_date_create')}}" value="{{ $inward->date }}" />
      </div>
            <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.inward_address_create')}}" value="{{ $inward->address }}" />
            <x-admin.layouts.adminshowlabeldetails title="{{ __('label.inward_remarks_create')}}" value="{{ $inward->remarks }}" />
      </div>
<br><br>
<div class="md:flex mb-3">
      <table class="table-fixed text-md">
         <thead>
            <tr>
          <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">{{__('label.inward_drug_create')}}</th>
         <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">{{__('label.inward_qty_create')}}</th>
         <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">{{__('label.inward_unit_create')}}</th>
         <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">{{__('label.inward_variant_create')}}</th>
         <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">{{__('label.inward_batchid_create')}}</th>
         <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">{{__('label.inward_manufacturedate_create')}}</th>
         <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">{{__('label.inward_expirydate_create')}}</th>
         <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3" >{{__('label.inward_expiryalertdate_create')}}</th>
         <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3" >{{__('label.inward_price_create')}}</th>
            </tr>
         </thead>
         @foreach ($inwarditem as $key => $value)
         <tr>
            <td class="border border-gray-400 px-3 py-2">
               <span>{{ $value->drug_name }}</span>
            </td>
            <td class="border border-gray-400 px-3 py-2">
               <span>{{ $value->qty }}</span>
            </td>
            <td class="border border-gray-400 px-3 py-2">
               <span>{{ $value->unit }}</span>
            </td>
            <td class="border border-gray-400 px-3 py-2">
               <span>{{ $value->variant }}</span>
            </td>
            <td class="border border-gray-400 px-3 py-2">
               <span>{{ $value->bacth_id }}</span>
            </td>
            <td class="border border-gray-400 px-3 py-2">
               <span>{{date('d-m-Y', strtotime($value->manufacture_date))}}</span>
            </td>
            <td class="border border-gray-400 px-3 py-2">
               <span>{{date('d-m-Y', strtotime($value->expiry_date))}}</span>
            </td>
            <td class="border border-gray-400 px-3 py-2">
               <span>{{date('d-m-Y', strtotime($value->expiry_alertdate))}}</span>
            </td>
            <td class="border border-gray-400 px-3 py-2">
               <span>{{ $value->price }}</span>
            </td>
         </tr>
         @endforeach
      </table>
</div>
<br><br>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.inward_createdat_show')}}" value="{{ $inward->created_at }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.inward_createdby_show')}}" value="{{ $inward->created_by }}" />
      </div>
      @if($inward->updated_by)
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.inward_updatedat_show')}}" value="{{ $inward->updated_at }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.inward_updatedby_show')}}"value="{{ $inward->updated_by }}" />
      </div>
      @endif
   </div>
</main>
@endsection
@section('footerSection')
@endsection
