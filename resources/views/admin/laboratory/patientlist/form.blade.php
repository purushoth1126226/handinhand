<ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-2">
    <li class="mr-3 lg:text-xl text-xl">
    {{__('label.patientlab_enrollment_edit')}}
      </li>
   </ul>

      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientlab_id_edit')}}"  value="{{ $vital->uniqid }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientlab_patientname_edit')}}" value="{{ $vital->name }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientlab_age_edit')}}" value="{{ $vital->age }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientlab_sexuality_edit')}}" value="{{ Config('archive.sexuality')[$vital->sexuality] }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientlab_fatherorhusband_edit')}}" value="{{ $vital->fatherorhusband }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientlab_mobileno_edit')}}" value="{{ $vital->phone }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientlab_village_edit')}}" value="{{ ($vital->village && $vital->village->name)?($vital->village->name):'' }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientlab_dob_edit')}}" value="{{ $vital->dob }}" />
      </div>
      <div class="md:flex mb-3">
      <div class="md:w-2/12 ">
           <label class="block text-gray-800 font-bold md:text-left mb-3 md:mb-0 ml-1">
           {{ __('label.patientenrollment_aadharorrational_create')}}<span class="text-dark">:</span>
           </label>
        </div>
       <div class="md:w-4/12">
         <label class="block text-blue-800 font-bold md:text-left mb-3 md:mb-0 ml-3">
         {{ $vital->aadharorrational}}
         </label>
       </div>
      </div>
      <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
       <li class="mr-3 lg:text-xl text-xl">
       {{__('label.patientlab_vitals_edit')}}
         </li>
      </ul>

      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientlab_mobileno_edit')}}"  value="{{ $vital->temperature }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientlab_bloodpressure_edit')}}" value="{{ $vital->bloodpressure }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientlab_height_edit')}}" value="{{ $vital-> height}}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientlab_weight_edit')}}" value="{{ $vital->weight }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientlab_pulserate_edit')}}" value="{{ $vital->pulserate }}" />
         <div class="md:w-2/12 ">
           <label class="block text-gray-800 font-bold md:text-left mb-3 md:mb-0 ml-1">
           {{__('label.patientlab_respiratory_edit')}}<span class="text-dark">:</span>
           </label>
        </div>
       <div class="md:w-4/12">
         <label class="block text-blue-800 font-bold md:text-left mb-3 md:mb-0 ml-3">
         {{ $vital->respiratoryrate }}
         </label>
       </div>
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientlab_sptwo_edit')}}" value="{{ $vital->spo_two }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientlab_painscale_edit')}}" value="{{ $vital->painscaleone }}" />
      </div>
      <div class="md:flex mb-3">
         <!-- <x-admin.layouts.adminshowlabeldetails title='PAIN SCALE TWO' value="{{ $vital-> painscaletwo}}" /> -->
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientlab_location_edit')}}" value="{{ $vital-> location}}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientlab_mobileno_edit')}}" value="{{ $vital-> character}}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientlab_allergy_edit')}}" value="{{ $vital->allergy->pluck('name')->implode(', ') }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientlab_currentcomplaints_edit')}}" value="{{ $vital->illness->pluck('name')->implode(', ') }}" />

      </div>
      <div class="md:flex mb-3">
      <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientlab_alcohol_edit')}}" value="{{isset($vital) && ($vital->alcohol == 0)  ? 'NO' : 'YES' }}" />
      <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientlab_smoking_edit')}}" value="{{isset($vital) && ($vital->smoking == 0)  ? 'NO' : 'YES' }}" />
      </div>
      <div class="md:flex mb-3">
        <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientlab_tobacco_edit')}}" value="{{isset($vital) && ($vital->tobacco == 0)  ? 'NO' : 'YES' }}" />
        <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientlab_others_edit')}}" value="{{ $vital-> others}}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientlab_doctor_edit')}}" value="{{ $vital->doctors}}" />
      </div>

      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientlab_createdat_edit')}}" value="{{date('d-m-Y,h:i:s', strtotime($vital->created_at))  }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientlab_createdby_edit')}}" value="{{ $vital->created_by }}" />
      </div>
      @if($vital->updated_by)
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientlab_updatedat_edit')}}" value="{{ date('d-m-Y,h:i:s', strtotime($vital->updated_at))  }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientlab_updatedby_edit')}}" value="{{ $vital->updated_by}}" />
      </div>
      @endif

 <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-2">
    <li class="mr-3 lg:text-xl text-xl">
    {{__('label.patientlab_title_labedit')}}
      </li>
 </ul>


 <div id="app" class="flex justify-between p-2 mx-8">
   <table class="shadow-lg bg-white">
      <tr>
        <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-4"> {{__('label.patientlab_sno_labedit')}}</th>
        <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-96"> {{__('label.patientlab_labinvestigation_labedit')}}</th>
        <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-80"> {{__('label.patientlab_sample_labedit')}}</th>
        <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-96"> {{__('label.patientvisit_result_labshow') }}</th>
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
         <center>  <input name=sample[] value="{{ $key++ }}"  type="checkbox" class="form-checkbox h-5 w-5" {{  ($value->sample == 1 ? ' checked' : '') }}></center>
        </td>
        <td class="border border-gray-400 px-3 py-2">
         <center>  <input name=result[] value="{{ $value->result }}"  type="text" class="form-input rounded block w-full p-1 focus:bg-white"></center>
        </td>
        <td class="border border-gray-400 px-3 py-2">
         <center>  <span>{!! $value->range !!}</span> </center>
        </td>
      </tr>
      @endforeach

   </table>
</div>

 {{-- REMARKS --}}

 <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
   <li class="mr-3 lg:text-xl text-xl">
   {{__('label.patientlab_remark_labedit')}}
   </li>
</ul>

<div class="md:flex mb-3">
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "labarotaryremark", 'name' =>__('label.patientlab_remark_labedit'), 'required' => false])
   </div>
   <div class="md:w-10/12">
      {{ Form::textarea('labarotaryremark',$vital->labarotaryremark ,array('id'=>'labarotaryremark','class'=>'p-1 form-textarea block w-full focus:bg-white', 'rows'=>'2')) }}
      @include('helper.formerror', ['error' => "labarotaryremark"])
   </div>
 </div>
