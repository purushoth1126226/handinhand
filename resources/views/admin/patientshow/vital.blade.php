
      <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
       <li class="mr-3 lg:text-xl text-xl">
       {{__('label.patientvisit_vitals_show')}}
         </li>
      </ul>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_temperature_show')}}"  value="{{ $vital->temperature }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_bloodpressure_show')}}"  value="{{ $vital->bloodpressure }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_height_show')}}" value="{{ $vital-> height}}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_weight_show')}}"  value="{{ $vital->weight }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_pulserate_show')}}" value="{{ $vital->pulserate }}" />
         <div class="md:w-2/12 ">
           <label class="block text-gray-800 font-bold md:text-left mb-3 md:mb-0 ml-1">
           {{__('label.patientvisit_respiratory_show')}}<span class="text-dark">:</span>
           </label>
        </div>
       <div class="md:w-4/12">
         <label class="block text-blue-800 font-bold md:text-left mb-3 md:mb-0 ml-3">
         {{ $vital->respiratoryrate }}
         </label>
       </div>

      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_sptwo_show')}}"  value="{{ $vital->spo_two }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_painscale_show')}}"  value="{{ $vital->painscaleone }}" />
      </div>
      <div class="md:flex mb-3">
         <!-- <x-admin.layouts.adminshowlabeldetails title='PAIN SCALE TWO' value="{{ $vital-> painscaletwo}}" /> -->
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_location_show')}}"  value="{{ $vital-> location}}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_character_show')}}"  value="{{ $vital-> character}}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_allergy_show')}}"  value="{{ $vital->allergy->pluck('name')->implode(', ') }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_currentcomplaints_show')}}"  value="{{ $vital->illness->pluck('name')->implode(', ') }}" />

      </div>
      <div class="md:flex mb-3">
      <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_alcohol_show')}}"  value="{{isset($vital) && ($vital->alcohol == 0)  ? 'NO' : 'YES' }}" />
      <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_smoking_show')}}"  value="{{isset($vital) && ($vital->smoking == 0)  ? 'NO' : 'YES' }}" />
      </div>
      <div class="md:flex mb-3">
        <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_tobacco_show')}}"  value="{{isset($vital) && ($vital->tobacco == 0)  ? 'NO' : 'YES' }}" />
        <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_others_show')}}" value="{{ $vital-> others}}" />
      </div>

      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_createdat_show')}}"  value="{{date('d-m-Y,h:i:s', strtotime($vital->created_at))}}" />
      </div>
