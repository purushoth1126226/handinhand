@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.admincreateoreditnav  name=supplier title="{{__('label.suppplier_title_create')}}" :obj="$supplier" backbutton="enable" />

<main class="w-full flex-grow px-6 py-2">
    <!--Card-->
    <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
       {!! Form::model($supplier, ['route' => ['supplier.store', $supplier->id],  'id' => '', 'class' => ' form_prevent_multiple_submits ', 'novalidate' => 'novalidate', 'files' => 'true','enctype'=>'multipart/form-data']) !!}
       {{ Form::hidden('id', $supplier->id, array('id' => 'invisible_id')) }}
       {{ Form::hidden('uniqid', $supplier->uniqid, array('id' => 'invisible_id')) }}

        @include('admin.druginward.supplier.form')

        <div class="md:flex md:items-center justify-center">
         @if ($supplier->id)
         {!! Form::button( '<i class="fa fa-spinner m-1 fa-spin"></i>'.__('label.suppplier_save_edit'), ['type' => 'submit', 'class' => 'shadow bg-green-500 hover:bg-green-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 m-1 flex rounded button_prevent_multiple_submits'] ) !!}
         @else
         {!! Form::button( '<i class="fa fa-spinner m-1 fa-spin"></i>'.__('label.suppplier_save_create'), ['type' => 'submit', 'class' => 'shadow bg-green-500 hover:bg-green-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 m-1 flex rounded button_prevent_multiple_submits'] ) !!}
         @endif
         <a href="" class="shadow bg-gray-500 hover:bg-gray-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">CANCEL</a>
       </div>

       {!! Form::close() !!}
    </div>
 </main>

@endsection
@section('footerSection')
@endsection
