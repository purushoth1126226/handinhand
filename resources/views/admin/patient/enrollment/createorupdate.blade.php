@extends('components.admin.layouts.adminapp')
@section('headSection')
{{ Html::style( asset('/css/chosen.css')) }}
{{ Html::style( asset('/css/select2.min.css')) }}
<style>

   .clear{
    clear:both;
    margin-top: 20px;
   }

   #searchResult{
    list-style: none;
    padding: 0px;
    width: 800px;
    position: absolute;
    margin: 0;
   }

   #searchResult li:hover{
    cursor: pointer;
   }

   </style>
@endsection
@section('main-content')
<x-admin.layouts.admincreateoreditnav  name=enrollment title="{{ __('label.patientenrollment_title_index')}}" :obj="$vital" backbutton="title" />

<main class="w-full flex-grow px-6 py-2">
    <!--Card-->
    <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
       {!! Form::model($vital, ['route' => ['enrollment.store', $vital->id],  'id' => '', 'class' => ' form_prevent_multiple_submits ', 'novalidate' => 'novalidate', 'files' => 'true','enctype'=>'multipart/form-data']) !!}
       {{ Form::hidden('id', $vital->id, array('id' => 'invisible_id')) }}
       {{ Form::hidden('uuid', $vital->uuid, array('id' => 'uuid')) }}
       {{ Form::hidden('uniqid', $vital->uniqid, array('id' => 'uniqid')) }}

       {{ Form::hidden('enrollment_id', $vital->enrollment_id, array('id' => 'enrollment_idval')) }}
       {{ Form::hidden('enrollment_uuid', $vital->enrollment_uuid, array('id' => 'enrollment_uuidval')) }}
       {{ Form::hidden('enrollment_uniqid', $vital->enrollment_uniqid, array('id' => 'enrollment_uniqidval')) }}

        @include('admin.patient.enrollment.form')

        <div class="md:flex md:items-center justify-center">
         @if ($vital->id)
         {!! Form::button( '<i class="fa fa-spinner m-1 fa-spin"></i>'. __('label.patientenrollment_save_edit'), ['type' => 'submit', 'class' => 'shadow bg-green-500 hover:bg-green-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 m-1 flex rounded button_prevent_multiple_submits'] ) !!}
         @else
         {!! Form::button( '<i class="fa fa-spinner m-1 fa-spin"></i>'. __('label.patientenrollment_save_create'), ['type' => 'submit', 'class' => 'shadow bg-green-500 hover:bg-green-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 m-1 flex rounded button_prevent_multiple_submits'] ) !!}
         @endif
         <a href="" class="shadow bg-gray-500 hover:bg-gray-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">{{ __('label.patientenrollment_cancel_create') }}</a>
       </div>

       {!! Form::close() !!}
    </div>
 </main>

@endsection
@section('footerSection')

{!! Html::script('/js/chosen.jquery.min.js'); !!}
{!! Html::script('/js/select2.min.js'); !!}

<script>
   $(document).ready(function(){

   $("#searchpatient").keyup(function(){
       var search = $(this).val();
       var _token = $('input[name="_token"]').val();

       if(search != ""){

           $.ajax({
               url: '{{ route('patientsearch.fetch') }}',
               type: 'post',
               data: {search:search, type:1, _token:_token},
               dataType: 'json',
               success:function(response){
                   var len = response.length;
                   $("#searchResult").empty();
                   for( var i = 0; i<len; i++){
                       var id = response[i]['id'];
                       var name = response[i]['name'];
                       var phone = response[i]['phone'];
                       var fatherorhusband = response[i]['fatherorhusband'];
                       var village = response[i]['village']['name'];
                       $("#searchResult").append("<li class='p-2 border-b-2 border-white bg-green-700 text-white' value='"+id+"'><span class='rounded-lg text-xl text-white p-2 '> Ph : "+phone+ "  / Name : "+name+" /Father or Husband : "+fatherorhusband+"</span> <span class='float-right text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-black bg-white last:mr-0 mr-1'>"+village+"</span></li>");
                   }

                   // binding click event to li
                   $("#searchResult li").bind("click",function(){
                       setText(this);
                   });

               }
           });
       }else{
            $("#searchResult").empty();
            $("#searchpatient").val('');
            $("#enrollment_idval").val('');
            $("#enrollment_uuidval").val('');
            $("#enrollment_uniqidval").val('');
            $("#nameval").val('');
            $("#ageval").val('');
            $("#sexualityval").val('');
            $("#fatherorhusbandval").val('');
            $("#phoneval").val('');
            $("#village_idval").val('');
            $("#dobval").val('');
            $("#addressval").val('');

       }

   });

   });

   // Set Text to search box and get details
   function setText(element){

   var id = $(element).val();
   var value = $(element).text();

   var _token = $('input[name="_token"]').val();


   $("#searchResult").empty();

   // Request User Details
   $.ajax({
       url: '{{ route('patientsearch.fetch') }}',
       type: 'post',
       data: {id:id, type:2, _token:_token},
       dataType: 'json',
       success: function(response){
            $("#searchpatient").val(response.name);
            $("#enrollment_idval").val(response.id);
            $("#enrollment_uuidval").val(response.uuid);
            $("#enrollment_uniqidval").val(response.uniqid);
            $("#nameval").val(response.name);
            $("#ageval").val(response.age);
            $("#sexualityval").val(response.sexuality);
            $("#fatherorhusbandval").val(response.fatherorhusband);
            $("#phoneval").val(response.phone);
            $("#village_idval").val(response.village_id);
            $("#dobval").val(response.dob);
            $("#addressval").val(response.address);
            $("#aadharorrational").val(response.aadharorrational);
       }

   });
   }

   </script>


<script>

$(document).ready(function() {
    $('.js-example-basic-multiple_one').select2();

    ajaxvitalsmultiselectvital();

    function ajaxvitalsmultiselectvital() {
        $.ajax({
            url: "{{route('ajaxvitalsmultiselectvital')}}",
            mehtod: "get",
            dataType: 'json',
            success: function(data) {
             $('#allergyoption').html(data.allergy);
             $('#allergyoption').val({!! $vital->allergySelect !!});
             $('#allergyoption').trigger('change');

             $('#illnessoption').html(data.illness);
             $('#illnessoption').val({!! $vital->illnessSelect !!});
             $('#illnessoption').trigger('change');
            }
        })
    }
});
 </script>



<script>
    $('.form-control-chosen').chosen({
      allow_single_deselect: true,
      width: '100%'
    });
    $('.form-control-chosen-required').chosen({
      allow_single_deselect: false,
      width: '100%'
    });
    $('.form-control-chosen-search-threshold-100').chosen({
      allow_single_deselect: true,
      disable_search_threshold: 100,
      width: '100%'
    });
    $('.form-control-chosen-optgroup').chosen({
      width: '100%'
    });
</script>



@endsection
