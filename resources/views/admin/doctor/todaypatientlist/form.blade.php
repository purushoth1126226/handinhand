
      <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-2">
       <li class="mr-3 lg:text-xl text-xl">
       {{__('label.patientdoctor_enrollment_edit')}}
         </li>
      </ul>
         <div class="md:flex mb-3">
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_id_edit')}}"  value="{{ $vital->uniqid }}" />
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_patientname_edit')}}"  value="{{ $vital->name }}" />
         </div>
         <div class="md:flex mb-3">
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_age_edit')}}"  value="{{ $vital->age }}" />
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_sexuality_edit')}}"  value="{{ Config('archive.sexuality')[$vital->sexuality] }}" />
         </div>
         <div class="md:flex mb-3">
         <div class="md:w-2/12 ">
           <label class="block text-gray-800 font-bold md:text-left mb-3 md:mb-0 ml-1">
           {{__('label.patientdoctor_fatherorhusband_edit')}}<span class="text-dark">:</span>
           </label>
        </div>
       <div class="md:w-4/12">
         <label class="block text-blue-800 font-bold md:text-left mb-3 md:mb-0 ml-3">
         {{ $vital->fatherorhusband }}
         </label>
       </div>
       <div class="md:w-2/12 ">
           <label class="block text-gray-800 font-bold md:text-left mb-3 md:mb-0 ml-1">
           {{__('label.patientdoctor_mobileno_edit')}}<span class="float-right text-dark px-1">:</span>
           </label>
        </div>
       <div class="md:w-4/12">
         <label class="block text-blue-800 font-bold md:text-left mb-3 md:mb-0 ml-3">
         {{ $vital->phone }}
         </label>
       </div>

         </div>
         <div class="md:flex mb-3">
            @if($vital->village_id)
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_village_edit')}}"  value="{{ $vital->village->name }}" />
         @endif
         @if($vital->dob)
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_dob_edit')}}"  value="{{date('d-m-Y', strtotime($vital->dob))}}" />
         @endif
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










       

 {{-- Vitals --}}

<ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
   <li class="mr-3 lg:text-xl text-xl">
  {{__('label.patientenrollment_vitals_create')}}
   </li>
</ul>



<div class="md:flex mb-3">
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "temperature", 'name' =>  __('label.patientenrollment_temperature_create'),'required' => false])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('temperature',$vital->temperature ,array('id'=>'temperature', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "temperature"])
     </div>
     <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "bloodpressure", 'name' => __('label.patientenrollment_bloodpressure_create') ,'required' => false])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('bloodpressure',$vital->bloodpressure ,array('id'=>'bloodpressure', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "bloodpressure"])
     </div>
</div>
<div class="md:flex mb-3">
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "height", 'name' =>  __('label.patientenrollment_height_create') ,'required' => false])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('height',$vital->height ,array('id'=>'height', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "height"])
     </div>
     <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "weight", 'name' =>  __('label.patientenrollment_weight_create')  ,'required' => false])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('weight',$vital->weight ,array('id'=>'weight', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "weight"])
     </div>
</div>
<div class="md:flex mb-3">
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "pulserate", 'name' =>  __('label.patientenrollment_pulserate_create')   ,'required' => false])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('pulserate',$vital->pulserate ,array('id'=>'pulserate', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "pulserate"])
     </div>
     <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "respiratoryrate", 'name' => __('label.patientenrollment_respiratoryrate_create')  , 'required' => false])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('respiratoryrate',$vital->respiratoryrate ,array('id'=>'respiratoryrate', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "respiratoryrate"])
     </div>
</div>
<div class="md:flex mb-3">
 <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "spo_two", 'name' => __('label.patientenrollment_spotwo_create') , 'required' => false])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('spo_two',$vital->spo_two ,array('id'=>'spo_two', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "spo_two"])
     </div>
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "painscale", 'name' => __('label.patientenrollment_painscale_create') ,'required' => false])
     </div>
     <div class="md:w-4/12">
      <select name="painscaleone" class="form-select block w-full focus:bg-white p-1" id="painscaleone" readonly>
         @foreach(config('archive.painscale') as $key => $value)
         <option value="{{ $key }}" {{ ($vital->painscaleone == $value) ? 'selected' : '' }}>
            {{ $value }}
         </option>
         @endforeach
      </select>
         @include('helper.formerror', ['error' => "painscaleone"])
     </div>
</div>
<div class="md:flex mb-3">
     {{-- <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "painscaletwo", 'name' => "PAIN SCALE",'required' => false])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('painscaletwo',$vital->painscaletwo ,array('id'=>'painscaletwo', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "painscaletwo"])
     </div> --}}
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "location", 'name' =>  __('label.patientenrollment_location_create'),'required' => false])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('location',$vital->location ,array('id'=>'location', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "location"])
     </div>
     <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "character", 'name' =>  __('label.patientenrollment_character_create'),'required' => false])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('character',$vital->character ,array('id'=>'character', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "character"])
     </div>
</div>



{{-- ALLERGY  --}}


<ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
  <li class="mr-3 lg:text-xl text-xl">
  {{__('label.patientenrollment_allergy_create')}}
  </li>
</ul>

<div class="md:flex mb-3">
<div class="md:w-11/12">
  <select name="allergy_select[]" id="allergyoption" class="form-select block w-full focus:bg-white dynamic  js-example-basic-multiple_one" multiple="multiple">
     <option value="">Select Allergy</option>
  </select>
  @include('helper.formerror', ['error' => "allergy_select"])
</div>
</div>



<div class="md:flex mb-3">
  
  <div class="md:w-10/12">
     {{ Form::textarea('allergy_note',$vital->allergy_note ,array('id'=>'allergy_note', 'placeholder'=>'Allergy Note' ,'class'=>'form-input rounded block w-full p-1 focus:bg-white','rows'=>'2')) }}
      @include('helper.formerror', ['error' => "allergy_note"])
  </div>

</div>


 {{-- CURRENT COMPLAINTS --}}


 <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
   <li class="mr-3 lg:text-xl text-xl">
   {{__('label.patientenrollment_currentcomplaints_create')}}
   </li>
</ul>

<div class="md:flex mb-3">
<div class="md:w-11/12">
   <select name="illness_select[]" id="illnessoption" class="form-select block w-full focus:bg-white dynamic  js-example-basic-multiple_one" multiple="multiple">
      <option value="">Select Illness</option>
   </select>
   @include('helper.formerror', ['error' => "illness_select"])
</div>
</div>
<div class="md:flex mb-3">
  
  <div class="md:w-10/12">
     {{ Form::textarea('illness_note',$vital->illness_note ,array('id'=>'illness_note', 'placeholder'=>'Illness Note' ,'class'=>'form-input rounded block w-full p-1 focus:bg-white','rows'=>'2')) }}
      @include('helper.formerror', ['error' => "illness_note"])
  </div>

</div>




 {{-- PSYCHOLOGICAL HISTORY --}}


 <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
   <li class="mr-3 lg:text-xl text-xl">
   {{__('label.patientenrollment_psychological_create')}}
   </li>
</ul>


<div class="md:flex mb-3">


   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "alcohol", 'name' => __('label.patientenrollment_alcohol_create'), 'required' => false])
     </div>
     <div class="md:w-2/12 pt-1">
         {!! Form::checkbox('alcohol',  null,  isset($vital) ? $vital->alcohol : 0 ,array('id'=>'alcohol','class'=>'form-checkbox h-5 w-5 text-green-600')) !!}
        @include('helper.formerror', ['error' => "alcohol"])
     </div>

   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "smoking", 'name' => __('label.patientenrollment_smoking_create'), 'required' => false])
   </div>
   <div class="md:w-1/12 pt-1">
      {!! Form::checkbox('smoking',  null,  isset($vital) ? $vital->smoking : 0 ,array('id'=>'smoking','class'=>'form-checkbox h-5 w-5 text-green-600')) !!}
      @include('helper.formerror', ['error' => "smoking"])
   </div>
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "tobacco", 'name' => __('label.patientenrollment_tobacco_create'), 'required' => false])
   </div>
   <div class="md:w-1/12 pt-1">
      {!! Form::checkbox('tobacco',  null,  isset($vital) ? $vital->tobacco : 0 ,array('id'=>'tobacco','class'=>'form-checkbox h-5 w-5 text-green-600')) !!}
      @include('helper.formerror', ['error' => "tobacco"])
   </div>
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "others", 'name' => __('label.patientenrollment_others_create'),'required' => false])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('others',$vital->others ,array('id'=>'others', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "others"])
     </div>

</div>














   <!-- DOCTOR EXAMINATION -->



    {{-- PHYSICAL AND GENERAL EXAM --}}


    <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
      <li class="mr-3 lg:text-xl text-xl">
      {{__('label.patientdoctor_physicalandgeneral_edit')}}
      </li>
   </ul>

   <div class="md:flex mb-3">
   <div class="md:w-11/12">
      <select name="physicalandgeneralexamination_select[]" id="physicalandgeneralexaminationoption" class="form-select block w-full focus:bg-white dynamic  js-example-basic-multiple_one" multiple="multiple">
         <option value="">Select Physical and General Examination</option>
      </select>
      @include('helper.formerror', ['error' => ""])
   </div>
   </div>



    {{-- MORBIDITY --}}

  

    <div class="md:flex mb-3">
  
     <div class="md:w-10/12">
        {{ Form::textarea('morbidity',$vital->morbidity ,array('id'=>'morbidity', 'placeholder'=>'Morbidity' ,'class'=>'form-input rounded block w-full p-1 focus:bg-white','rows'=>'2')) }}
         @include('helper.formerror', ['error' => "morbidity"])
     </div>

   </div>

   {{-- DIAGNOSIS --}}


   <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
      <li class="mr-3 lg:text-xl text-xl">
      {{__('label.patientdoctor_diagnosis_edit')}}
      </li>
   </ul>

   <div class="md:flex mb-3">
   <div class="md:w-11/12">
      <select name="diagnosis_select[]" id="diagnosisoption" class="form-select block w-full focus:bg-white dynamic  js-example-basic-multiple_one" multiple="multiple">
         <option value="">Select Diagnosis </option>
      </select>
      @include('helper.formerror', ['error' => ""])
   </div>
   </div>
   <div class="md:flex mb-3">
  
  <div class="md:w-10/12">
     {{ Form::textarea('diagnosis_note',$vital->diagnosis_note ,array('id'=>'diagnosis_note', 'placeholder'=>'Diagnosis Note' ,'class'=>'form-input rounded block w-full p-1 focus:bg-white','rows'=>'2')) }}
      @include('helper.formerror', ['error' => "diagnosis_note"])
  </div>

</div>


   <div id='drugname'>

   </div>



   {{-- LAB INVESTIGATION --}}


    <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
      <li class="mr-3 lg:text-xl text-xl">
      {{__('label.patientdoctor_labinvestigation_edit')}}
      </li>
   </ul>

   <div class="md:flex mb-3">
   <div class="md:w-11/12">
      <select name="labinvestigation_select[]" id="labinvestigationoption" class="form-select block w-full focus:bg-white dynamic  js-example-basic-multiple_one" multiple="multiple">
         <option value="">Select Lab Investigation </option>
      </select>
      @include('helper.formerror', ['error' => ""])
   </div>
   </div>
   <div class="md:flex mb-3">
  
  <div class="md:w-10/12">
     {{ Form::textarea('laboratory_note',$vital->laboratory_note ,array('id'=>'laboratory_note', 'placeholder'=>'Lab Note' ,'class'=>'form-input rounded block w-full p-1 focus:bg-white','rows'=>'2')) }}
      @include('helper.formerror', ['error' => "laboratory_note"])
  </div>
     </div>


   {{-- PRESCRIPTION --}}


    <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
      <li class="mr-3 lg:text-xl text-xl">
      {{__('label.patientdoctor_prescription_edit')}}
      </li>
   </ul>

   @livewire('admin.doctor.doctorprescriptionlivewire', ['vital_id' => $vital->id])


   <div class="md:flex mb-3">
  
  <div class="md:w-10/12">
     {{ Form::textarea('prescription_note',$vital->prescription_note ,array('id'=>'prescription_note', 'placeholder'=>'Prescription  Note' ,'class'=>'form-input rounded block w-full p-1 focus:bg-white','rows'=>'2')) }}
      @include('helper.formerror', ['error' => "prescription_note"])
  </div>
     </div>

   <div class="md:flex my-3">
      {{-- <div class="md:w-2/12">
         @include('helper.formlabel', ['for' => "tabletcount", 'name' =>__('label.patientdoctor_count_edit'),'required' => false])
        </div>
        <div class="md:w-4/12">
           {{ Form::text('tabletcount',$vital->tabletcount ,array('id'=>'tabletcount', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
            @include('helper.formerror', ['error' => "tabletcount"])
        </div> --}}
        <div class="md:w-2/12">
         @include('helper.formlabel', ['for' => "nextvisit", 'name' => __('label.patientdoctor_nextvisit_edit'),'required' => false])
        </div>
        <div class="md:w-4/12">
           {{ Form::text('nextvisit',$vital->nextvisit ,array('id'=>'nextvisit', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
            @include('helper.formerror', ['error' => "nextvisit"])
        </div>
        <div class="md:w-2/12">
         @include('helper.formlabel', ['for' => "referral", 'name' => __('label.patientdoctor_referral_edit'),'required' => false])
        </div>
        <div class="md:w-4/12">
           {{ Form::text('referral',$vital->referral ,array('id'=>'referral', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
            @include('helper.formerror', ['error' => "referral"])
        </div>
   </div>

    {{-- REMARKS --}}

    <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
      <li class="mr-3 lg:text-xl text-xl">
      {{__('label.patientdoctor_remarkstitle_edit')}}
      </li>
   </ul>

   <div class="md:flex mb-3">
      <div class="md:w-2/12">
         @include('helper.formlabel', ['for' => "doctorremark", 'name' => __('label.patientdoctor_doctorremarks_edit'), 'required' => false])
      </div>
      <div class="md:w-10/12">
         {{ Form::textarea('doctorremark',$vital->doctorremark ,array('id'=>'doctorremark','class'=>'p-1 form-textarea block w-full focus:bg-white', 'rows'=>'2')) }}
         @include('helper.formerror', ['error' => "doctorremark"])
      </div>
    </div>
