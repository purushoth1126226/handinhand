<div class="md:flex mb-3">
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "name", 'name' => __('label.village_name_create'), 'required' => true])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('name',$village->name ,array('id'=>'name', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "name"])
     </div>
</div>
