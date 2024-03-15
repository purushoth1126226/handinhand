   {{-- PRESCRIPTION --}}


 <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
   <li class="mr-3 lg:text-xl text-xl">
   PRESCRIPTION
   </li>
</ul>


<div id="app">
<table class="shadow-lg bg-white">
   <tr>
      <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-4">S.No</th>
     <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-80">Drug</th>
     <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-32">Morning</th>
     <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-32">Afternoon</th>
     <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-32">Evening</th>
     <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-32">Night</th>
     <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">BF</th>
     <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">AF</th>
     <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">Count</th>
     <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">Action</th>
   </tr>
   <tr v-for="(item, index) in form.drug">
      <td class="border border-gray-400 px-3 py-2 w-5">
         <span>@{{ index+1 }}</span>

      </td>
     <td class="border border-gray-400 px-3 py-2 w-80">
         {{-- <input  v-model="item.drug" type="text" class="form-input rounded block w-full p-1 focus:bg-white"> --}}
         <select name=drug[] v-model="item.drug" class="form-input rounded block w-full p-1 focus:bg-white">
            <option disabled value="">Please select one</option>
            <option v-for="item in druglist" :value="item.key">@{{ item.value}}</option>
        </select>



      </td>
     <td class="border border-gray-400 px-3 py-2">
      <center><input name=morning[] v-model="item.morning" type="checkbox" class="form-checkbox h-5 w-5"></center>
     </td>
     <td class="border border-gray-400 px-3 py-2">
      <center>  <input name=afternoon[] v-model="item.afternoon" type="checkbox" class="form-checkbox h-5 w-5"></center>
     </td>
     <td class="border border-gray-400 px-3 py-2">
      <center>  <input name=evening[] v-model="item.evening" type="checkbox" class="form-checkbox h-5 w-5"></center>
     </td>
     <td class="border border-gray-400 px-3 py-2">
      <center>  <input name=night[] v-model="item.night" type="checkbox" class="form-checkbox h-5 w-5"></center>
     </td>
     <td class="border border-gray-400 px-3 py-2">
      <center>  <input name=bf[] v-model="item.bf" type="checkbox" class="form-checkbox h-5 w-5"></center>
     </td>
     <td class="border border-gray-400 px-3 py-2">
      <center>  <input name=af[] v-model="item.af" type="checkbox" class="form-checkbox h-5 w-5"></center>
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



   <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-2">
    <li class="mr-3 lg:text-xl text-xl">
       ENROLLMENT DETAILS
      </li>
   </ul>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title='ID' value="{{ $vital->uniqid }}" />
         <x-admin.layouts.adminshowlabeldetails title='PATIENT NAME' value="{{ $vital->name }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title='AGE' value="{{ $vital->age }}" />
         <x-admin.layouts.adminshowlabeldetails title='SEXUALITY' value="{{ Config('archive.sexuality')[$vital->sexuality] }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title='FATHER OR HUSBAND' value="{{ $vital->fatherorhusband }}" />
         <x-admin.layouts.adminshowlabeldetails title='MOBILE NUMBER' value="{{ $vital->phone }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title='LOCATION' value="{{ $vital->village->name }}" />
         <x-admin.layouts.adminshowlabeldetails title='DOB' value="{{ $vital->dob }}" />
      </div>
      <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
       <li class="mr-3 lg:text-xl text-xl">
         VITALS DETAILS
         </li>
      </ul>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title='TEMPERATURE' value="{{ $vital->temperature }}" />
         <x-admin.layouts.adminshowlabeldetails title='BLOOD PRESSURE' value="{{ $vital->bloodpressure }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title='HEIGHT' value="{{ $vital-> height}}" />
         <x-admin.layouts.adminshowlabeldetails title='WEIGHT' value="{{ $vital->weight }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title='PULSE RATE' value="{{ $vital->pulserate }}" />
         <x-admin.layouts.adminshowlabeldetails title='RESPIRATORY RATE' value="{{ $vital->respiratoryrate }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title='SpO2' value="{{ $vital->spo_two }}" />
         <x-admin.layouts.adminshowlabeldetails title='PAIN SCALE ONE' value="{{ $vital->painscaleone }}" />
      </div>
      <div class="md:flex mb-3">
         <!-- <x-admin.layouts.adminshowlabeldetails title='PAIN SCALE TWO' value="{{ $vital-> painscaletwo}}" /> -->
         <x-admin.layouts.adminshowlabeldetails title='LOCATION' value="{{ $vital-> location}}" />
         <x-admin.layouts.adminshowlabeldetails title='CHARACTER' value="{{ $vital-> character}}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title='ALLERGY' value="{{ $vital->allergy->pluck('name')->implode(', ') }}" />
         <x-admin.layouts.adminshowlabeldetails title='CURRENT COMPLAINTS' value="{{ $vital->illness->pluck('name')->implode(', ') }}" />

      </div>
      <div class="md:flex mb-3">
      <x-admin.layouts.adminshowlabeldetails title='ALCOHOL' value="{{isset($vital) && ($vital->status == 0)  ? 'YES' : 'NO' }}" />
      <x-admin.layouts.adminshowlabeldetails title='SMOKING' value="{{isset($vital) && ($vital->status == 0)  ? 'YES' : 'NO' }}" />
      </div>
      <div class="md:flex mb-3">
        <x-admin.layouts.adminshowlabeldetails title='TOBACCO' value="{{isset($vital) && ($vital->status == 0)  ? 'YES' : 'NO' }}" />
        <x-admin.layouts.adminshowlabeldetails title='OTHERS' value="{{ $vital-> others}}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title='DOCTOR' value="{{ $vital->doctors}}" />
      </div>

      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title='CREATED AT' value="{{ $vital->created_at }}" />
         <x-admin.layouts.adminshowlabeldetails title='CREATED BY' value="{{ $vital->created_by }}" />
      </div>
      @if($vital->updated_by)
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title='UPDATED AT' value="{{ $vital->created_at }}" />
         <x-admin.layouts.adminshowlabeldetails title='UPDATED BY' value="{{ $vital->updated_at }}" />
      </div>
      @endif
   </div>
</main>


<!-- DOCTOR EXAMINATION -->

<main class="w-full flex-grow px-6 py-2">

<div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white container mx-auto">


 {{-- PHYSICAL AND GENERAL EXAM --}}


 <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
   <li class="mr-3 lg:text-xl text-xl">
   PHYSICAL AND GENERAL EXAMINATION
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


{{-- DIAGNOSIS --}}


<ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
   <li class="mr-3 lg:text-xl text-xl">
      DIAGNOSIS
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
   LAB INVESTIGATION
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
   PRESCRIPTION
   </li>
</ul>









<div class="md:flex my-3">
   {{-- <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "tabletcount", 'name' => "TABLET COUNT",'required' => false])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('tabletcount',$vital->tabletcount ,array('id'=>'tabletcount', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "tabletcount"])
     </div> --}}
     <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "nextvisit", 'name' => "NEXT VISIT",'required' => false])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('nextvisit',$vital->nextvisit ,array('id'=>'nextvisit', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "nextvisit"])
     </div>
</div>

 {{-- REMARKS --}}

 <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
   <li class="mr-3 lg:text-xl text-xl">
      REMARKS
   </li>
</ul>

<div class="md:flex mb-3">
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "doctorremark", 'name' => "DOCTOR REMARKS", 'required' => false])
   </div>
   <div class="md:w-10/12">
      {{ Form::textarea('doctorremark',$vital->doctorremark ,array('id'=>'doctorremark','class'=>'p-1 form-textarea block w-full focus:bg-white', 'rows'=>'2')) }}
      @include('helper.formerror', ['error' => "doctorremark"])
   </div>
 </div>
