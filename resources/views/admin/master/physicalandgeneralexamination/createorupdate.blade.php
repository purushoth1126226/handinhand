@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.admincreateoreditnav  name=physicalandgeneralexamination title="{{__('label.physicalandgeneralexamination_title_index')}}" :obj="$physicalandgeneralexamination" backbutton="enable" />

<main class="w-full flex-grow px-6 py-2">
    <!--Card-->
    <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
       {!! Form::model($physicalandgeneralexamination, ['route' => ['physicalandgeneralexamination.store', $physicalandgeneralexamination->id],  'id' => '', 'class' => ' form_prevent_multiple_submits ', 'novalidate' => 'novalidate', 'files' => 'true','enctype'=>'multipart/form-data']) !!}
       {{ Form::hidden('id', $physicalandgeneralexamination->id, array('id' => 'invisible_id')) }}
       {{ Form::hidden('uniqid', $physicalandgeneralexamination->uniqid, array('id' => 'invisible_id')) }}

        @include('admin.master.physicalandgeneralexamination.form')

        <div class="md:flex md:items-center justify-center">
         @if ($physicalandgeneralexamination->id)
         {!! Form::button( '<i class="fa fa-spinner m-1 fa-spin"></i>'. __('label.physicalandgeneralexamination_save_edit'), ['type' => 'submit', 'class' => 'shadow bg-green-500 hover:bg-green-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 m-1 flex rounded button_prevent_multiple_submits'] ) !!}
         @else
         {!! Form::button( '<i class="fa fa-spinner m-1 fa-spin"></i> '. __('label.physicalandgeneralexamination_save_create'), ['type' => 'submit', 'class' => 'shadow bg-green-500 hover:bg-green-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 m-1 flex rounded button_prevent_multiple_submits'] ) !!}
         @endif
         <a href="" class="shadow bg-gray-500 hover:bg-gray-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">{{ __('label.physicalandgeneralexamination_cancel_create') }}</a>
       </div>

       {!! Form::close() !!}
    </div>
 </main>

@endsection
@section('footerSection')
@endsection
