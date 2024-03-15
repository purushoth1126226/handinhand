


  @if($vital->is_labarotary)
      <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-6">
         <li class="mr-3 lg:text-xl text-xl">
         {{__('label.patientvisit_title_labshow')}}
         </li>
      </ul>

      <div id="app" class="flex justify-between p-2 mx-8">
         <table class="shadow-lg bg-white">
            <tr>
              <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-4"> {{__('label.patientvisit_sno_labshow')}}</th>
              <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-96"> {{__('label.patientvisit_labinvestigation_labshow')}}</th>
              <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-80"> {{__('label.patientlab_sample_labedit')}}</th>
              <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-80">{{__('label.patientvisit_result_labshow')}}</th>
              <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-40"> {{__('label.patientlab_range_labedit')}}</th>
            </tr>

            @foreach ($vital->labreport as $key => $value)
            <tr>
            <td class="border border-gray-400 px-3 py-2">
               <input type="hidden" value="{{ $value->id }}" name=labreport_id[]>
               <center>  <span>{{ $key + 1 }}</span></center>
              </td>
              <td class="border border-gray-400 px-3 py-2">
                 <span>{{ $value->name }}</span>
              </td>
              <td class="border border-gray-400 px-3 py-2">
               <center><span>{!! isset($value) && ($value->sample == 0)  ? '<span class="text-red-500 font-bold">NO </span>' : '<span class="text-green-600 font-bold">YES<span>' !!}</span></center>
              </td>
              <td class="border border-gray-400 px-3 py-2">
               <span>{{ $value->result }}</span>
              </td>
              <td class="border border-gray-400 px-3 py-2">
                <span>{!! $value->range !!}</span>
              </td>
            </tr>
            @endforeach
         </table>
      </div>

      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_status_labshow')}}"  value="{{ Config('archive.labstatus')[$vital->labarotarystatus] }}" />
     </div>

      <div class="md:flex mb-3">
             <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_remark_labshow')}}"  value="{{ $vital->labarotaryremark }}" />
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_date_labshow')}}" value="{{date('d-m-Y,h:i:s', strtotime($vital->is_labarotary))}}" />
         </div>

      @endif
