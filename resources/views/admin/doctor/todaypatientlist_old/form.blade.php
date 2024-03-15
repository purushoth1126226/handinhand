





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
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_fatherorhusband_edit')}}"  value="{{ $vital->fatherorhusband }}" />
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_mobileno_edit')}}"  value="{{ $vital->phone }}" />
         </div>
         <div class="md:flex mb-3">
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_village_edit')}}"  value="{{ $vital->village->name }}" />
         @if($vital->dob)
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_dob_edit')}}"  value="{{date('d-m-Y', strtotime($vital->dob))}}" />
         @endif
         </div>
         <div class="md:flex mb-3">
          <x-admin.layouts.adminshowlabeldetails  title="{{ __('label.patientenrollment_aadharorrational_create')}}"  value="{{$vital->aadharorrational}}" />
        </div>
         <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
          <li class="mr-3 lg:text-xl text-xl">
          {{__('label.patientdoctor_vitals_edit')}}
            </li>
         </ul>
         <div class="md:flex mb-3">
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_temperature_edit')}}"  value="{{ $vital->temperature }}" />
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_bloodpressure_edit')}}"  value="{{ $vital->bloodpressure }}" />
         </div>
         <div class="md:flex mb-3">
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_height_edit')}}" value="{{ $vital-> height}}" />
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_weight_edit')}}"  value="{{ $vital->weight }}" />
         </div>
         <div class="md:flex mb-3">
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_pulserate_edit')}}"  value="{{ $vital->pulserate }}" />
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_respiratory_edit')}}"  value="{{ $vital->respiratoryrate }}" />
         </div>
         <div class="md:flex mb-3">
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_sptwo_edit')}}"  value="{{ $vital->spo_two }}" />
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_painscale_edit')}}"  value="{{ $vital->painscaleone }}" />
         </div>
         <div class="md:flex mb-3">
            <!-- <x-admin.layouts.adminshowlabeldetails title='PAIN SCALE TWO' value="{{ $vital-> painscaletwo}}" /> -->
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_location_edit')}}"  value="{{ $vital-> location}}" />
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_character_edit')}}"  value="{{ $vital-> character}}" />
         </div>
         <div class="md:flex mb-3">
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_allergy_edit')}}" value="{{ $vital->allergy->pluck('name')->implode(', ') }}" />
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_currentcomplaints_edit')}}"  value="{{ $vital->illness->pluck('name')->implode(', ') }}" />

         </div>
         <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_alcohol_edit')}}"  value="{{isset($vital) && ($vital->alcohol == 0)  ? 'NO' : 'YES' }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_smoking_edit')}}"  value="{{isset($vital) && ($vital->smoking == 0)  ? 'NO' : 'YES' }}" />
         </div>
         <div class="md:flex mb-3">
           <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_tobacco_edit')}}" value="{{isset($vital) && ($vital->tobacco == 0)  ? 'NO' : 'YES' }}" />
           <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_others_edit')}}"  value="{{ $vital-> others}}" />
         </div>
         <div class="md:flex mb-3">
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_doctor_edit')}}"  value="{{ $vital->doctors}}" />
         </div>

         <div class="md:flex mb-3">
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_createdat_edit')}}"   value="{{date('d-m-Y', strtotime($vital->created_at)) }}" />
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_createdby_edit')}}"   value="{{ $vital->created_by }}" />
         </div>
         @if($vital->updated_by)
         <div class="md:flex mb-3">
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_updatedat_edit')}}"   value="{{date('d-m-Y', strtotime($vital->updated_at)) }}" />
            <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientdoctor_updatedby_edit')}}"   value="{{ $vital->updated_by}}" />
         </div>
         @endif



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

    <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
      <li class="mr-3 lg:text-xl text-xl">
      MORBIDITY
      </li>
   </ul>

    <div class="md:flex mb-3">
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "morbidity", 'name' =>'MORBIDITY', 'required' => false])
   </div>
     <div class="md:w-10/12">
        {{ Form::textarea('morbidity',$vital->morbidity ,array('id'=>'morbidity', 'class'=>'form-input rounded block w-full p-1 focus:bg-white','rows'=>'2')) }}
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

   {{-- PRESCRIPTION --}}


    <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
      <li class="mr-3 lg:text-xl text-xl">
      {{__('label.patientdoctor_prescription_edit')}}
      </li>
   </ul>



   <div id="app">
      <table class="shadow-lg bg-white">
         <tr>
            <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-4">{{__('label.patientdoctor_sno_edit')}}</th>
           <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-80">{{__('label.patientdoctor_drug_edit')}}</th>
           <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-32">{{__('label.patientdoctor_morning_edit')}}</th>
           <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-32">{{__('label.patientdoctor_afternoon_edit')}}</th>
           <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-32">{{__('label.patientdoctor_evening_edit')}}</th>
           <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-32">{{__('label.patientdoctor_night_edit')}}</th>
           <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">{{__('label.patientdoctor_bf_edit')}}</th>
           <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">{{__('label.patientdoctor_af_edit')}}</th>
           <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">{{__('label.patientdoctor_count_edit')}}</th>
           <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">{{__('label.patientdoctor_pharmacy_edit')}}</th>
         </tr>
         <tr v-for="(item, index) in form.drug">
            <td class="border border-gray-400 px-3 py-2 w-5">
               <span>@{{ index+1 }}</span>

            </td>
           <td class="border border-gray-400 px-3 py-2 w-80">
               <select name=drug[] v-model="item.drug" class="form-input rounded block w-full p-1 focus:bg-white">
                  <option disabled value="">Please select one</option>
                  <option v-for="item in druglist" :value="item.id">@{{ item.name}}</option>
              </select>

              {{-- <select v-model="product.name" class="table-control" @change="ProductChange(product, index, $event.target.value)">
               <option v-for="opt in salesList" :value="opt.name">@{{ opt.name }} </option>
            </select> --}}

              {{-- <select name=drug[] v-model="item.drug" class="table-control" @change="ProductChange(product, index, $event.target.value)">
               <option v-for="opt in salesList" :value="item.key">@{{ opt.name }} </option>
            </select> --}}

            </td>
           <td class="border border-gray-400 px-3 py-2">
            <center>  <input :value="index" name=morning[] v-model="item.morning" type="checkbox" class="form-checkbox h-5 w-5"></center>
           </td>
           <td class="border border-gray-400 px-3 py-2">
            <center>  <input :value="index" name=afternoon[] v-model="item.afternoon" type="checkbox" class="form-checkbox h-5 w-5"></center>
           </td>
           <td class="border border-gray-400 px-3 py-2">
            <center>  <input :value="index" name=evening[] v-model="item.evening" type="checkbox" class="form-checkbox h-5 w-5"></center>
           </td>
           <td class="border border-gray-400 px-3 py-2">
            <center>  <input :value="index" name=night[] v-model="item.night" type="checkbox" class="form-checkbox h-5 w-5"></center>
           </td>
           <td class="border border-gray-400 px-3 py-2">
            <center>  <input :value="index" name=bf[] v-model="item.bf" type="checkbox" class="form-checkbox h-5 w-5"></center>
           </td>
           <td class="border border-gray-400 px-3 py-2">
            <center>  <input :value="index" name=af[] v-model="item.af" type="checkbox" class="form-checkbox h-5 w-5"></center>
           </td>
           <td class="border border-gray-400 px-3 py-2">
            <input name=count[] v-model="item.count" type="text" class="form-input rounded block w-full p-1 focus:bg-white">
         </td>
         <td class="border border-gray-400 px-3 py-2 w-32">
            <span @click="addLine" class="bg-green-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
            >
        <i class="fas fa-plus"></i>
      </span>

      <span @click="remove(item)" class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
            >
        <i class="fas fa-trash"></i>
      </span>
         </td>
         </tr>
       </table>
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
