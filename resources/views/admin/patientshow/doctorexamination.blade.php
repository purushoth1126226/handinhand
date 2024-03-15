
@if($vital->is_doctor)
   <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-2">
        <li class="mr-3 lg:text-xl text-xl">
        {{__('label.patientvisit_doctorexam_show')}}
        </li>
     </ul>
      <div class="md:flex mb-3">
      <div class="md:w-2/12 ">
           <label class="block text-gray-800 font-bold md:text-left mb-3 md:mb-0 ml-1">
           {{__('label.patientvisit_physicalandgeneral_show')}}<span class="float-right text-dark px-1">:</span>
           </label>
        </div>
       <div class="md:w-4/12">
         <label class="block text-blue-800 font-bold md:text-left mb-3 md:mb-0 ml-3">
         {{ $vital->physicalandgeneralexamination->pluck('name')->implode(', ') }}
         </label>
     </div>
      <x-admin.layouts.adminshowlabeldetails title="MORBIDITY" value="{{ $vital->morbidity }}" />
      </div>
      <div class="md:flex mb-3">
      <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_diagnosis_show')}} " value="{{ $vital->diagnosis->pluck('name')->implode(', ') }}" />
         
      <div class="md:w-2/12 ">
           <label class="block text-gray-800 font-bold md:text-left mb-3 md:mb-0 ml-1">
           {{__('label.patientvisit_labinvestigation_show')}}<span class="float-right text-dark px-1">:</span>
           </label>
        </div>
       <div class="md:w-4/12">
         <label class="block text-blue-800 font-bold md:text-left mb-3 md:mb-0 ml-3">
         {{ $vital->labinvestigation->pluck('name')->implode(', ') }}
         </label>
     </div>
      </div>
      <div class="md:flex mb-3">
      <x-admin.layouts.adminshowlabeldetails title="ALLERGY NOTE" value="{{ $vital->allergy_note }}" />
      <x-admin.layouts.adminshowlabeldetails title="CURRENT COMPLIANT NOTE " value="{{ $vital->illness_note }}" />
      </div>
      <div class="md:flex mb-3">
      <x-admin.layouts.adminshowlabeldetails title="DIAGNOSIS NOTE" value="{{ $vital->diagnosis_note }}" />
      <x-admin.layouts.adminshowlabeldetails title="LAB NOTE " value="{{ $vital->laboratory_note }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="PRESCRIPTION NOTE " value="{{ $vital->prescription_note }}" />
      <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_nextvisit_show')}}" value="{{ $vital->nextvisit }}" />
         </div>
         <div class="md:flex mb-3">
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_referral_edit')}}" value="{{ $vital->referral }}" />
               <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_createdat_show')}}" value="{{ $vital->is_doctor }}" />
          </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientvisit_remarks_show')}} " value="{{ $vital->doctorremark }}" />
     </div>
      @endif
