@extends('components.admin.layouts.adminapp')
@section('headSection')

@endsection
@section('main-content')

<x-admin.layouts.admincreateoreditnav  name=inward title="{{__('label.inward_title_create')}}" :obj="$inward" backbutton="title" />


<main class="w-full flex-grow px-6 py-2">
    <!--Card-->
    <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
       {!! Form::model($inward, ['route' => ['inward.store', $inward->id],  'id' => '', 'class' => ' form_prevent_multiple_submits ', 'novalidate' => 'novalidate', 'files' => 'true','enctype'=>'multipart/form-data']) !!}
       {{ Form::hidden('id', $inward->id, array('id' => 'invisible_id')) }}
       {{ Form::hidden('uniqid', $inward->uniqid, array('id' => 'invisible_id')) }}

       {{ Form::hidden('supplier_id', $inward->supplier_id ,array('id'=>'supplier_id')) }}


        @include('admin.druginward.inward.form')

        <div class="md:flex md:items-center justify-center">
         @if ($inward->id)
         {!! Form::button( '<i class="fa fa-spinner m-1 fa-spin"></i>'.__('label.inward_save_edit'), ['type' => 'submit', 'class' => 'shadow bg-green-500 hover:bg-green-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 m-1 flex rounded button_prevent_multiple_submits'] ) !!}
         @else
         {!! Form::button( '<i class="fa fa-spinner m-1 fa-spin"></i>'.__('label.inward_save_create'), ['type' => 'submit', 'class' => 'shadow bg-green-500 hover:bg-green-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 m-1 flex rounded button_prevent_multiple_submits'] ) !!}
         @endif
         <a href="" class="shadow bg-gray-500 hover:bg-gray-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">{{__('label.inward_cancel_create')}}</a>
       </div>

       {!! Form::close() !!}
    </div>
 </main>

@endsection
@section('footerSection')

{!! Html::script('/js/chosen.jquery.min.js'); !!}
{!! Html::script('/js/select2.min.js'); !!}


{!! Html::script('/js/sweetalert.min.js') !!}
    <script>
        window.addEventListener('swal:confirm', event => {
            console.log(event);
            swal({
                    title: event.detail.message,
                    text: event.detail.text,
                    icon: event.detail.type,
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.livewire.emit('removedrug');
                    }
                });
        });

        window.addEventListener('swal:hello', event => {
            console.log(event);
            swal({
                    title: event.detail.message,
                    text: event.detail.text,
                    icon: event.detail.type,
                    buttons: true,
                    dangerMode: true,
                })
               
        });

    </script>

<!-- <script>

$(document).ready(function () {
        window.livewire.emit('show');
    });

    window.livewire.on('show', () => {
        $('#exampleModal').modal('show');
    });

 </script> -->

<script>


   $(document).ready(function(){

   $("#searchsupplier").keyup(function(){
       var search = $(this).val();
       var _token = $('input[name="_token"]').val();

       if(search != ""){

           $.ajax({
               url: '{{ route('inwardsearch.fetch') }}',
               type: 'post',
               data: {search:search, type:1, _token:_token},
               dataType: 'json',
               success:function(response){
                   var len = response.length;
                   $("#searchResult").empty();
                   for( var i = 0; i<len; i++){
                       var id = response[i]['id'];
                       var name = response[i]['name'];
                       var company = response[i]['company'];
                       var phone = response[i]['phone'];
                       var uniqid = response[i]['uniqid'];

                       $("#searchResult").append("<li class='p-2 border-b-2 border-white bg-green-300 text-grey-400 cursor-pointer hover:bg-green-400' value='"+id+"'><span class='rounded-lg text-xl text-grey-400 p-2'> Company : "+company+ "  / Name : "+name+"/uniqid : "+uniqid+ " </span></li>");
                   }

                   // binding click event to li
                   $("#searchResult li").bind("click",function(){
                       setText(this);
                   });

               }
           });
       }else{
            $("#searchResult").empty();
            $("#searchsupplier").val('');
            $("#supplier_name").val('');
            $("#supplier_id").val('');
            $("#supplier_uniqid").val('');
            $("#phone").val('');
            $("#companyname").val('');
            $("#address").val('');

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
       url: '{{ route('inwardsearch.fetch') }}',
       type: 'post',
       data: {id:id, type:2, _token:_token},
       dataType: 'json',
       success: function(response){
            $("#searchsupplier").val(response.name);
            $("#supplier_id").val(response.id);
            $("#supplier_uniqid").val(response.uniqid);
            $("#supplier_name").val(response.name);
            $("#phone").val(response.phone);
            $("#companyname").val(response.company);
            $("#address").val(response.billing_address);
       }

   });
   }

   </script>



@endsection
