@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.adminshownav name='supplier' title="{{__('label.suppplier_title_index')}} - {{ $supplier->uniqid }}" backbutton="enable" />
<main class="w-full flex-grow px-6 py-2">
   <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white container mx-auto">
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.drug_id_show')}}" value="{{ $supplier->uniqid }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.suppplier_companyname_create')}}" value="{{ $supplier->company }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.suppplier_name_create')}}" value="{{ $supplier->name }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.suppplier_contactmobno_create')}}" value="{{ $supplier->phone }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.suppplier_phno_create')}}" value="{{ $supplier->phone_two }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.suppplier_email_create')}}" value="{{ $supplier->email }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.suppplier_address_create')}}" value="{{ $supplier->billing_address }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.suppplier_city_create')}}" value="{{ $supplier->city }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.suppplier_state_create')}}" value="{{ $supplier->state }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.suppplier_pincode_create')}}" value="{{ $supplier->pincode }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.suppplier_gstin_create')}}" value="{{ $supplier->gstin }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.suppplier_bankname_create')}}" value="{{ $supplier->bankname }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.suppplier_ifsc_create')}}" value="{{ $supplier->bankifsc }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.suppplier_bankbranch_create')}}" value="{{ $supplier->bankbranch }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.suppplier_acno_create')}}" value="{{ $supplier->bankaccountnumber }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.suppplier_remarks_create')}}" value="{{ $supplier->remarks }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.suppplier_pan_create')}}" value="{{ $supplier->pan }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.inward_createdat_show')}}" value="{{date('d-m-Y,h:i:s', strtotime($supplier->created_at))}}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.inward_createdby_show')}}" value="{{ $supplier->created_by }}" />
      </div>
      @if($supplier->updated_by)
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.inward_updatedat_show')}}" value="{{date('d-m-Y,h:i:s', strtotime($supplier->updated_at))}}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.inward_updatedby_show')}}"  value="{{ $supplier->updated_by }}" />
      </div>
      @endif
   </div>
</main>
@endsection
@section('footerSection')
@endsection
