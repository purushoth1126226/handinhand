

 @if($vital->is_pharmacy)
       <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-6">
         <li class="mr-3 lg:text-xl text-xl">
         {{__('label.patientvisit_title_pharmacyshow')}}
         </li>
      </ul>



     <div id="app" class="flex justify-between p-2 mx-8">
      <table class="shadow-lg bg-white">
         <tr>
            <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-4">{{__('label.patientvisit_sno_pharmacyshow')}}</th>
            <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-80">{{__('label.patientvisit_drug_pharmacyshow')}}</th>
            <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-32">{{__('label.patientvisit_morning_pharmacyshow')}}</th>
            <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-32">{{__('label.patientvisit_afternoon_pharmacyshow')}}</th>
            <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-32">{{__('label.patientvisit_evening_pharmacyshow')}}</th>
            <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-32">{{__('label.patientvisit_night_pharmacyshow')}}</th>
            <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">{{__('label.patientvisit_bf_pharmacyshow')}}</th>
            <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">{{__('label.patientvisit_af_pharmacyshow')}}</th>
            <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">{{__('label.patientvisit_count_pharmacyshow')}}</th>
         </tr>

         @foreach ($vital->doctorprescription as $key => $value)
         <tr>
         <td class="border border-gray-400 px-3 py-2">
            <input type="hidden" value="{{ $value->id }}" name=labreport_id[]>
            <center>  <span>{{ $key + 1 }}</span></center>
           </td>
           <td class="border border-gray-400 px-3 py-2">
              <span>{{ $value->drugname }}</span>
           </td>
           <td class="border border-gray-400 px-3 py-2">
              @if($value->morning)
            <span class="rounded-full h-8 w-8 flex items-center justify-center bg-green-500"></span>
            @else
            <span>-</span>
            @endif
           </td>

           <td class="border border-gray-400 px-3 py-2">
             @if($value->afternoon)
             <span class="rounded-full h-8 w-8 flex items-center justify-center bg-green-500"></span>
             @else
             <span>-</span>
             @endif
           </td>
           <td class="border border-gray-400 px-3 py-2">
            @if($value->evening)
            <span class="rounded-full h-8 w-8 flex items-center justify-center bg-green-500"></span>
            @else
            <span>-</span>
            @endif
         </td>
         <td class="border border-gray-400 px-3 py-2">
          @if($value->night)
          <span class="rounded-full h-8 w-8 flex items-center justify-center bg-green-500"></span>
          @else
          <span>-</span>
          @endif
         </td>
         <td class="border border-gray-400 px-3 py-2">
           @if($value->bf)
           <span class="rounded-full h-8 w-8 flex items-center justify-center bg-green-500"></span>
           @else
           <span>-</span>
           @endif
         </td>
         <td class="border border-gray-400 px-3 py-2">
            @if($value->af)
            <span class="rounded-full h-8 w-8 flex items-center justify-center bg-green-500"></span>
            @else
            <span>-</span>
            @endif
         </td>
         <td class="border border-gray-400 px-3 py-2">
          <span>{{ $value->count }}</span>
         </td>
         </tr>
         @endforeach
      </table>
   </div>
<br><br>
@if($vital->is_pharmacy)
   <div class="md:flex mb-3">
      <table class="table-fixed text-md">
         <thead>
            <tr>
               <th class="bg-blue-100 border border-gray-400 text-center px-3 py-3">{{__('label.inward_drug_create')}}</th>
               <th class="bg-blue-100 border border-gray-400 text-center px-3 py-3">{{__('label.inward_qty_create')}}</th>
               <th class="bg-blue-100 border border-gray-400 text-center px-3 py-3">{{__('label.inward_unit_create')}}</th>
               <th class="bg-blue-100 border border-gray-400 text-center px-3 py-3">{{__('label.inward_variant_create')}}</th>
               <th class="bg-blue-100 border border-gray-400 text-center px-3 py-3">{{__('label.inward_batchid_create')}}</th>
               <th class="bg-blue-100 border border-gray-400 text-center px-1 py-2">{{__('label.inward_balance_create')}}</th>
               <th class="bg-blue-100 border border-gray-400 text-center px-3 py-3">{{__('label.inward_manufacturedate_create')}}</th>
               <th class="bg-blue-100 border border-gray-400 text-center px-6 py-2 w-2/4">{{__('label.inward_expirydate_create')}}</th>
               <th class="bg-blue-100 border border-gray-400 text-center px-3 py-3" >{{__('label.inward_expiryalertdate_create')}}</th>
               <th class="bg-blue-100 border border-gray-400 text-center px-1 py-3" >{{__('label.inward_recievedqty_create')}}</th>
            </tr>
         </thead>
         @foreach ($pharmacyoutward as $key => $value)
         <tr>
            <td class="border border-gray-400 px-3 py-2">
               <span>{{ $value->drug_name }}</span>
            </td>
            <td class="border border-gray-400 px-3 py-2">
               <span>{{ $value->qty }}</span>
            </td>
            <td class="border border-gray-400 px-3 py-2">
               <span>{{ $value->unit }}</span>
            </td>
            <td class="border border-gray-400 px-3 py-2">
               <span>{{ $value->variant }}</span>
            </td>
            <td class="border border-gray-400 px-3 py-2">
               <span>{{ $value->bacth_id }}</span>
            </td>
            <td class="border border-gray-400">
            <span class="text-center">{{ $value->balance }}</span>
            </td>
            <td class="border border-gray-400 px-3 py-2">
               <span>{{date('d-m-Y', strtotime($value->manufacture_date))}}</span>
            </td>
            <td class="border border-gray-400 px-5 py-2">
               <span>{{date('d-m-Y', strtotime($value->expiry_date))}}</span>
            </td>
            <td class="border border-gray-400 px-3 py-2">
               <span>{{date('d-m-Y', strtotime($value->expiry_alertdate))}}</span>
            </td>
            <td class="border border-gray-400 px-1 py-2">
               <span>{{ $value->received_qty }}</span>
            </td>
         </tr>
         @endforeach
      </table>
</div>
@endif
<br><br>
   <div class="md:flex mb-3">
      <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_status_pharmacyshow')}}"  value="{{ Config('archive.pharmacystatus')[$vital->pharmacystatus] }}" />
  </div>

   <div class="md:flex mb-3">
          <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_remark_pharmacyshow')}}"  value="{{ $vital->pharmacyremarks }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_date_pharmacyshow')}}"  value="{{date('d-m-Y,h:i:s', strtotime($vital->is_pharmacy))}}" />
      </div>
   @endif
