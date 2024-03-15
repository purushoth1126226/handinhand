@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.admincreateoreditnav  name=labpatientlist title="{{__('label.patientlab_title_index')}}" :obj="$vital" backbutton="enable" />

<main class="w-full flex-grow px-6 py-2">
    <!--Card-->
    <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
       {!! Form::model($vital, ['route' => ['laboratory.store', $vital->id],  'id' => '', 'class' => ' form_prevent_multiple_submits ', 'novalidate' => 'novalidate', 'files' => 'true','enctype'=>'multipart/form-data']) !!}
       {{ Form::hidden('id', $vital->id, array('id' => 'invisible_id')) }}
       {{ Form::hidden('uuid', $vital->uuid, array('id' => 'uuid')) }}
       {{ Form::hidden('uniqid', $vital->uniqid, array('id' => 'uniqid')) }}

       {{ Form::hidden('enrollment_id', $vital->enrollment_id, array('id' => 'enrollment_idval')) }}
       {{ Form::hidden('enrollment_uuid', $vital->enrollment_uuid, array('id' => 'enrollment_uuidval')) }}
       {{ Form::hidden('enrollment_uniqid', $vital->enrollment_uniqid, array('id' => 'enrollment_uniqidval')) }}

        @include('admin.laboratory.patientlist.form')

        <div class="md:flex md:items-center justify-center">
         @if ($vital->id)
         {!! Form::button( '<i class="fa fa-spinner m-1 fa-spin"></i>'.__('label.patientlab_partial_edit'), ['type' => 'submit', 'name' => 'labarotarystatus', 'value' => 1,  'class' => 'shadow bg-green-500 hover:bg-green-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 m-1 flex rounded'] ) !!}
          {!! Form::button( '<i class="fa fa-spinner m-1 fa-spin"></i>'.__('label.patientlab_complete_edit'), ['type' => 'submit',  'name' => 'labarotarystatus', 'value' => 2, 'class' => 'shadow bg-green-500 hover:bg-green-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 m-1 flex rounded'] ) !!}
         @else
         {!! Form::button( '<i class="fa fa-spinner m-1 fa-spin"></i> CREATE', ['type' => 'submit', 'class' => 'shadow bg-green-500 hover:bg-green-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 m-1 flex rounded button_prevent_multiple_submits'] ) !!}
         @endif
         <a href="" class="shadow bg-gray-500 hover:bg-gray-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">{{__('label.patientlab_cancel_edit')}}</a>
       </div>

       {!! Form::close() !!}
    </div>
 </main>

@endsection

@section('footerSection')
@endsection
