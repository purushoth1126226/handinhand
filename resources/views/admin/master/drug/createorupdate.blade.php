@extends('components.admin.layouts.adminapp')
@section('headSection')
{{ Html::style( asset('/css/select2.min.css')) }}
@endsection
@section('main-content')
<x-admin.layouts.admincreateoreditnav  name=drug title="{{__('label.drug_title_create')}}" :obj="$drug" backbutton="enable" />

<main class="w-full flex-grow px-6 py-2">
    <!--Card-->
    <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
       {!! Form::model($drug, ['route' => ['drug.store', $drug->id],  'id' => '', 'class' => ' form_prevent_multiple_submits ', 'novalidate' => 'novalidate', 'files' => 'true','enctype'=>'multipart/form-data']) !!}
       {{ Form::hidden('id', $drug->id, array('id' => 'invisible_id')) }}
       {{ Form::hidden('uniqid', $drug->uniqid, array('id' => 'invisible_id')) }}

        @include('admin.master.drug.form')

        <div class="md:flex md:items-center justify-center">
         @if ($drug->id)
         {!! Form::button( '<i class="fa fa-spinner m-1 fa-spin"></i>'. __('label.drug_save_edit'), ['type' => 'submit', 'class' => 'shadow bg-green-500 hover:bg-green-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 m-1 flex rounded button_prevent_multiple_submits'] ) !!}
         @else
         {!! Form::button( '<i class="fa fa-spinner m-1 fa-spin"></i>'. __('label.drug_save_create'), ['type' => 'submit', 'class' => 'shadow bg-green-500 hover:bg-green-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 m-1 flex rounded button_prevent_multiple_submits'] ) !!}
         @endif
         <a href="" class="shadow bg-gray-500 hover:bg-gray-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">{{ __('label.drug_cancel_create') }}</a>
       </div>

       {!! Form::close() !!}
    </div>
 </main>

@endsection
@section('footerSection')

{!! Html::script('/js/select2.min.js'); !!}

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple_one').select2();

        ajaxdrugsmultiselect();

        function ajaxdrugsmultiselect() {
            $.ajax({
                url: "{{route('ajaxdrugsmultiselect')}}",
                mehtod: "get",
                dataType: 'json',
                success: function(data) {

                 $('#diagnosisoption').html(data.diagnosisoption);
                 $('#diagnosisoption').val({!! $drug->diagnosisSelect !!});
                 $('#diagnosisoption').trigger('change');

                }
            })
        }
    });
     </script>
@endsection
