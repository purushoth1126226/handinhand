@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')

<main class="w-full flex-grow px-6 py-2">
   <x-admin.layouts.admincreateoreditnav  name=eventcalendar title="EVENT CALENDAR" :obj="$eventcalendar" backbutton="enable" />
    <!--Card-->
    <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
       {!! Form::model($eventcalendar, ['route' => ['eventcalendar.store', $eventcalendar->id],  'id' => '', 'class' => ' form_prevent_multiple_submits ', 'novalidate' => 'novalidate', 'files' => 'true','enctype'=>'multipart/form-data']) !!}
       {{ Form::hidden('id', $eventcalendar->id, array('id' => 'invisible_id')) }}

        @include('admin.officeutility.eventcalendar.form') 

        <div class="md:flex md:items-center justify-center">
         @if ($eventcalendar->id)
         {!! Form::button( '<i class="fa fa-spinner m-1 fa-spin"></i> UPDATE', ['type' => 'submit', 'class' => 'shadow bg-green-500 hover:bg-green-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 m-1 flex rounded button_prevent_multiple_submits'] ) !!}
         @else
         {!! Form::button( '<i class="fa fa-spinner m-1 fa-spin"></i> CREATE', ['type' => 'submit', 'class' => 'shadow bg-green-500 hover:bg-green-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 m-1 flex rounded button_prevent_multiple_submits'] ) !!}
         @endif
         <a href="" class="shadow bg-gray-500 hover:bg-gray-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">CANCEL</a>
       </div>

       {!! Form::close() !!}
    </div>
 </main>

@endsection
@section('footerSection')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.standalone.min.css" rel="stylesheet" type="text/css" />
<script>
    $('#datepicker1').datepicker({
        format: 'dd/mm/yyyy'
    });
    $('#datepicker2').datepicker({
        format: 'dd/mm/yyyy'
    });
</script>
@endsection