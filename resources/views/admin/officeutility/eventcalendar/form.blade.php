
<div class="md:flex mb-3">
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "title", 'name' => "TITLE", 'required' => true]) 
     </div>
     <div class="md:w-8/12">
        {{ Form::text('title',$eventcalendar->title ,array('id'=>'title', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
        @include('helper.formerror', ['error' => "title"])
     </div>

  <div class="md:w-1/12">
   @include('helper.formlabel', ['for' => "active", 'name' => "STATUS", 'required' => true]) 
  </div>
  <div class="md:w-1/12 p-1">
      {!! Form::checkbox('active',  null,  isset($eventcalendar) ? $eventcalendar->active : 0 ,array('id'=>'active','class'=>'form-checkbox h-5 w-5 text-green-600')) !!}
     @include('helper.formerror', ['error' => "active"])
  </div>
</div>

 <div class="md:flex mb-6">
   <div class="md:w-2/12">
     @include('helper.formlabel', ['for' => "start", 'name' => "START DATE", 'required' => true])
   </div>
   <div class="md:w-2/12">
      {{ Form::text('start',$eventcalendar->start ,array('id'=>'datepicker1','class'=>'form-input rounded block w-full p-1 focus:bg-white','readonly'=>'readonly')) }}
      @include('helper.formerror', ['error' => "start"])
   </div>
   <div class="md:w-2/12">
     @include('helper.formlabel', ['for' => "end", 'name' => "END DATE", 'required' => true])
   </div>
   <div class="md:w-2/12">
      {{ Form::text('end',$eventcalendar->end ,array('id'=>'datepicker2','class'=>'form-input rounded block w-full p-1 focus:bg-white','readonly'=>'readonly')) }} 
      @include('helper.formerror', ['error' => "end"])
   </div>


    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "remarks", 'name' => "REMARKS", 'required' => false])
    </div>
    <div class="md:w-2/12">
       {{ Form::textarea('remarks',$eventcalendar->remarks ,array('id'=>'remarks','class'=>'p-1 form-textarea block w-full focus:bg-white', 'rows'=>'2')) }}
       @include('helper.formerror', ['error' => "remarks"])
    </div>
 </div>
