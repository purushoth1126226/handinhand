@extends('components.admin.layouts.adminapp')
@section('headSection')
{{ Html::style( asset('/css/summernote-lite.min.css')) }}
@endsection
@section('main-content')
<x-admin.layouts.admincreateoreditnav  name=labinvestigation title="{{__('label.labinvestigation_title_create')}}" :obj="$labinvestigation" backbutton="enable" />

<main class="w-full flex-grow px-6 py-2">
    <!--Card-->
    <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
       {!! Form::model($labinvestigation, ['route' => ['labinvestigation.store', $labinvestigation->id],  'id' => '', 'class' => ' form_prevent_multiple_submits ', 'novalidate' => 'novalidate', 'files' => 'true','enctype'=>'multipart/form-data']) !!}
       {{ Form::hidden('id', $labinvestigation->id, array('id' => 'invisible_id')) }}
       {{ Form::hidden('uniqid', $labinvestigation->uniqid, array('id' => 'invisible_id')) }}

        @include('admin.master.labinvestigation.form')

        <div class="md:flex md:items-center justify-center">
         @if ($labinvestigation->id)
         {!! Form::button( '<i class="fa fa-spinner m-1 fa-spin"></i>'. __('label.labinvestigation_save_edit'), ['type' => 'submit', 'class' => 'shadow bg-green-500 hover:bg-green-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 m-1 flex rounded button_prevent_multiple_submits'] ) !!}
         @else
         {!! Form::button( '<i class="fa fa-spinner m-1 fa-spin"></i>'.__('label.labinvestigation_save_create'), ['type' => 'submit', 'class' => 'shadow bg-green-500 hover:bg-green-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 m-1 flex rounded button_prevent_multiple_submits'] ) !!}
         @endif
         <a href="" class="shadow bg-gray-500 hover:bg-gray-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">{{__('label.labinvestigation_cancel_create')}}</a>
       </div>

       {!! Form::close() !!}
    </div>
 </main>

@endsection
@section('footerSection')
<!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script> -->
{!! Html::script('/js/summernote-lite.min.js'); !!}
<script type="text/javascript">
$('.summernote').summernote({
   placeholder: 'Short Description About Product',
   tabsize: 2,
   height: 150,
   toolbar: [
       ['style', ['style']],
       ['font', ['bold', 'underline', 'clear']],
       ['color', ['color']],
       ['para', ['ul', 'ol', 'paragraph']],
       ['table', ['table']],
       ['insert', ['link', 'picture', 'video']],
       ['view', ['fullscreen', 'codeview', 'help']]
   ]
});
</script>
@endsection
