@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.adminshownav  name='role' title="ROLE - {{ $role->id }}" backbutton="enable" />
<main class="w-full flex-grow px-6 py-2">
   <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white container mx-auto">
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title='ID' value="{{ $role->id }}" />
         <x-admin.layouts.adminshowlabeldetails title='NAME' value="{{ $role->name }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title='CREATED AT' value="{{ $role->created_at }}" />
         <x-admin.layouts.adminshowlabeldetails title='CREATED BY' value="{{ $role->created_by }}" />
      </div>
      @if($role->updated_by)
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title='UPDATED AT' value="{{ $role->created_at }}" />
         <x-admin.layouts.adminshowlabeldetails title='UPDATED BY' value="{{ $role->updated_at }}" />
      </div>
      @endif
   </div>
</main>
@endsection
@section('footerSection')
@endsection