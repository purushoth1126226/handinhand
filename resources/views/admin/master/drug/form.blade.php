<!--
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif -->




<div class="md:flex mb-3">
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "name", 'name' =>__('label.drug_name_create'), 'required' => true])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('name',$drug->name ,array('id'=>'name', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "name"])
     </div>
    <!-- <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "drug_id", 'name' =>'drug ID', 'required' => true])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('drug_id',$drug->drug_id ,array('id'=>'drug_id', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "drug_id"])
     </div> -->
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "generic_name", 'name' =>__('label.drug_genericname_create'), 'required' => true])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('generic_name',$drug->generic_name ,array('id'=>'generic_name', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "generic_name"])
     </div>
</div>
<div class="md:flex mb-3">
  <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "drug_variant", 'name' =>__('label.drug_variant_create'), 'required' => true])
    </div>
   <div class="md:w-4/12">
     <select name="drug_variant" id="drug_variant" class="form-input rounded block w-full p-1 focus:bg-white"  readonly>
       @foreach(config('archive.drug_variant') as $key => $value)
         <option  value={{ $key }} {{ ($drug->drug_variant == $key) ? 'selected' : '' }} >
            {{ $value }}
         </option>
      @endforeach
    </select>
      @include('helper.formerror', ['error' => "drug_variant"])
   </div>

   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "drug_classification", 'name' =>__('label.drug_classification_create'), 'required' => true])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('drug_classification',$drug->drug_classification ,array('id'=>'drug_classification', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "drug_classification"])
     </div>

</div>





<div class="md:flex mb-3">

    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "manufacture_name", 'name' =>__('label.drug_manufacturename_create'), 'required' => true])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('manufacture_name',$drug->manufacture_name ,array('id'=>'manufacture_name', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "manufacture_name"])
     </div>

     <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "dosage", 'name' =>__('label.drug_dosage_create'), 'required' => false])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('dosage',$drug->dosage ,array('id'=>'dosage', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "dosage"])
     </div>
</div>


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

    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "remarks", 'name' =>__('label.drug_remark_show'), 'required' => false])
     </div>
     <div class="md:w-4/12">
        {{ Form::textarea('remarks',$drug->remarks ,array('id'=>'remarks', 'class'=>'form-input rounded block w-full p-1 focus:bg-white', 'rows'=>'remarks')) }}
         @include('helper.formerror', ['error' => "remarks"])
     </div>

</div>
