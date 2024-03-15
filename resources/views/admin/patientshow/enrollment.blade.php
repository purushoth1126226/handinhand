
    <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-6">
      <li class="mr-3 lg:text-xl text-xl">
       {{__('label.patientvisit_enrollment_show')}}
      </li>
   </ul>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_id_show')}}" value="{{ $vital->uniqid }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_patientname_show')}}"  value="{{ $vital->name }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_age_show')}}" value="{{ $vital->age }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_sexuality_show')}}"   value="{{ Config('archive.sexuality')[$vital->sexuality] }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_address_show')}}" value="{{ $vital->address}}" />
         <div class="md:w-2/12 ">
           <label class="block text-gray-800 font-bold md:text-left mb-3 md:mb-0 ml-1">
           {{__('label.patientvisit_fatherorhusband_show')}}<span class="text-dark">:</span>
           </label>
        </div>
       <div class="md:w-4/12">
         <label class="block text-blue-800 font-bold md:text-left mb-3 md:mb-0 ml-3">
         {{ $vital->fatherorhusband }}
         </label>
       </div>

      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_mobileno_show')}}" value="{{ $vital->phone }}" />
      </div>
      <div class="md:flex mb-3">
         
      <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientenrollment_village_show')}}" value="{{($vital->village) ? $vital->village->name : '' }}" />

         @if($vital->dob)
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_dob_show')}}" value="{{date('d-m-Y', strtotime($vital->dob))}}" />
         @endif
      </div>
      <div class="md:flex mb-3">
      <div class="md:w-2/12 ">
           <label class="block text-gray-800 font-bold md:text-left mb-3 md:mb-0 ml-1">
           {{ __('label.patientenrollment_aadharorrational_create')}}<span class=" text-dark">:</span>
           </label>
        </div>
       <div class="md:w-4/12">
         <label class="block text-blue-800 font-bold md:text-left mb-3 md:mb-0 ml-3">
         {{ $vital->aadharorrational}}
         </label>
      </div>
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientenrollment_createdat_show')}}" value="{{date('d-m-Y,h:i:s', strtotime($vital->created_at))}}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientenrollment_createdby_show')}}" value="{{($vital->created_by)}}" />
      </div>
      @if($vital->updated_by)
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientenrollment_updatedat_show')}}"  value="{{date('d-m-Y,h:i:s', strtotime($vital->updated_at))}}" />
         <x-admin.layouts.adminshowlabeldetails title="{{ __('label.patientenrollment_updatedby_show')}}"  value="{{($vital->updated_by) }}" />
      </div>
      @endif
