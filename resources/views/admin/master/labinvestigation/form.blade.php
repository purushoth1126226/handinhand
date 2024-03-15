<div class="md:flex mb-3">
    <div class="md:w-3/12">
      @include('helper.formlabel', ['for' => "name", 'name' => __('label.labinvestigation_name_create'), 'required' => true])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('name',$labinvestigation->name ,array('id'=>'name', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "name"])
     </div>
</div>

<div class="md:flex mb-3">
<div class="md:w-2/12">
  @include('helper.formlabel', ['for' => "range", 'name' =>  __('label.labinvestigation_range_create'), 'required' => true])
 </div>
 <div class="md:w-10/12">
  {{ Form::textarea('range',$labinvestigation->range ,array('id'=>'range', 'class'=>'summernote p-1 form-textarea block w-full focus:bg-white', 'rows'=>'2')) }}
   @include('helper.formerror', ['error' => "range"])
</div>
</div>
