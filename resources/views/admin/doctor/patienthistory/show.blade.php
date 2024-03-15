
@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')


<x-admin.layouts.adminshownav  name='patienthistory' title="{{__('label.patientdoctorhistory_title_index')}} - {{ $vital->uniqid }}" backbutton="enable" />
<main class="w-full flex-grow px-6 py-2">
   <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white container mx-auto">

    @include('admin.patientshow.enrollment')
    @include('admin.patientshow.vital')
    @include('admin.patientshow.doctorexamination')
    @include('admin.patientshow.laboratory')
    @include('admin.patientshow.pharmacy')

   </div>
</main>



@endsection
@section('footerSection')
@endsection
