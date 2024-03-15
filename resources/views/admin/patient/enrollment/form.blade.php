@if (!$vital->id)
<ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
   <li class="mr-3 lg:text-xl text-xl">
   {{__('label.patientenrollment_search_create')}}
   </li>
</ul>

<div class="md:flex mb-3">
   <div class="md:w-1/12">
   </div>
    <div class="md:w-10/12">
       {{ Form::text('search', null ,array('id'=>'searchpatient', 'class'=>'form-input rounded block w-full p-2 focus:bg-white', 'autocomplete'=>'off')) }}
       <ul id="searchResult"> </ul>
       <span class="clear">
    </div>
</div>
@endif


<ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
   <li class="mr-3 lg:text-xl text-xl">
   {{__('label.patientenrollment_enrollment_create')}}
   </li>
</ul>


<div class="md:flex mb-3">
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "name", 'name' => __('label.patientenrollment_patientname_create'), 'required' => true])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('name', $vital->name ,array('id'=>'nameval', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "name"])
     </div>
     <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "age", 'name' => __('label.patientenrollment_age_create'), 'required' => false])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('age',$vital->age ,array('id'=>'ageval', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "age"])
     </div>

</div>








<div class="md:flex mb-3">
<div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "sexuality", 'name' =>  __('label.patientenrollment_sexuality_create'), 'required' => true])
   </div>
   <div class="md:w-4/12">
      <select name="sexuality"  class="form-select block w-full focus:bg-white p-1" id="sexualityval" readonly>
         @foreach(config('archive.sexuality') as $key => $value)
         <option value="{{ $key }}" {{ ($vital->sexuality == $key) ? 'selected' : '' }}>
            {{ $value }}
         </option>
         @endforeach
      </select>
      @include('helper.formerror', ['error' => "sexuality"])
   </div>
     <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "fatherorhusband", 'name' => __('label.patientenrollment_fatherorhusband_create'), 'required' => false])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('fatherorhusband',$vital->fatherorhusband ,array('id'=>'fatherorhusbandval', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "fatherorhusband"])
     </div>

</div>
<div class="md:flex mb-3">
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "phone", 'name' => __('label.patientenrollment_mobileno_create'), 'required' => false])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('phone',$vital->phone ,array('id'=>'phoneval', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "phone"])
     </div>
     <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "village", 'name' =>  __('label.patientenrollment_village_create'), 'required' => false])
     </div>



<div class="md:w-4/12">
   <select name="village_id" class="form-input rounded block w-full p-1 focus:bg-white form-control-chosen">
      <option value="">SELECT LOCATION</option>
      @foreach($village as $eachvillage)
      <option value="{{ $eachvillage->id }}" {{ ($vital->village_id == $eachvillage->id) ? 'selected' : '' }}>{{ $eachvillage->name }}</option>
      @endforeach
   </select>
   @include('helper.formerror', ['error' => "village_id"])
</div>


</div>
<div class="md:flex mb-3">
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "dob", 'name' =>  __('label.patientenrollment_dob_create'), 'required' => false])
     </div>
     <div class="md:w-4/12">
        {{ Form::date('dob',$vital->dob ,array('id'=>'dobval', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "dob"])
     </div>
     <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "address", 'name' =>  __('label.patientenrollment_address_create'), 'required' => false])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('address',$vital->address ,array('id'=>'addressval', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "address"])
     </div>
</div>
<div class="md:flex mb-3">
     <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "aadharorrational", 'name' =>__('label.patientenrollment_aadharorrational_create'),'required' => false])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('aadharorrational',$vital->aadharorrational ,array('id'=>'aadharorrational', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "aadharorrational"])
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


 <!-- {{-- DOCTOR --}}

<ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
   <li class="mr-3 lg:text-xl text-xl">
   {{__('label.patientenrollment_doctortitle_create')}}
   </li>
</ul>


<div class="md:flex mb-3">
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "doctors", 'name' => __('label.patientenrollment_doctor_create'),'required' => false])
     </div>
     <div class="md:w-4/12">
      {{ Form::select('doctor_id', $doctor, $vital->doctor_id, array('id'=>'', 'class' => 'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "doctors"])
     </div>
</div> -->


 {{-- REMARKS --}}

 <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
   <li class="mr-3 lg:text-xl text-xl">
   {{__('label.patientenrollment_remarks_create')}}
   </li>
</ul>

<div class="md:flex mb-3">
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "remarks", 'name' => __('label.patientenrollment_remarks_create'), 'required' => false])
   </div>
   <div class="md:w-10/12">
      {{ Form::textarea('remarks',$vital->remarks ,array('id'=>'remarks','class'=>'p-1 form-textarea block w-full focus:bg-white', 'rows'=>'2')) }}
      @include('helper.formerror', ['error' => "remarks"])
   </div>
 </div>
