
@extends('components.admin.layouts.adminapp')
@section('headSection')
<style>

    /* div{
    box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
    } */

    .ticket {
    width: 240px;
    max-width: 240px;
    }

</style>
@endsection
@section('main-content')
<x-admin.layouts.adminshownav  name='enrollment' title="{{ __('label.patientenrollment_title_token')}}- {{ $vital->uniqid }}" backbutton="enable" />
<main  class="w-full flex-grow p-3 bg-white">
    <div class="ticket mx-auto p-3 text-sm font-semibold">
     <div id="showreceipt">
       <p class="text-center text-green-600 my-2 font-bold">PHC</p>
         <p>{{ __('label.patientenrollment_date_token')}} :{{ $vital->created_at->format('d/M/Y H:i:s')  }}</p>
         <p>{{ __('label.patientenrollment_no_token')}}:{{ $vital->token_id  }}</p>
         <p style=" border-bottom: 1px solid black; width:200px;" ></p>
         <p>{{ __('label.patientenrollment_patientname_token')}} :<strong> {{ $vital->name }}</strong></p>
         <p>{{__('label.patientvisit_age_show')}} :<strong> {{ $vital->age }}</strong></p>
         <p>{{__('label.patientvisit_sexuality_show')}} :<strong> {{ Config('archive.sexuality')[$vital->sexuality] }}</strong></p>
         <p>{{ __('label.patientenrollment_mobileno_token')}}:<strong>{{$vital->phone}}</strong></p>
         <br><br>
         <p class="text-center text-green-600 font-bold">Inspiring Good Health !</p>
       </div><br><br>
       <div>
         <button id="print" class="bg-green-500 hover:bg-green-600 px-2 text-white rounded text-lg">Print</button>
       </div>
    </div>
</main>
@endsection
@section('footerSection')
<script>
  $("#print").on("click", function(){
        var a = window.open('', '', 'height=800, width=800');
            a.document.write($("#showreceipt").html());
            a.document.close();
            a.print();

    })
</script>


@endsection
