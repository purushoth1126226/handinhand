<ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
   <li class="mr-3 lg:text-xl text-xl">
   {{__('label.inward_name_create')}}
   </li>
</ul>

<div class="md:flex mb-3">
   <div class="md:w-2/12">
   @include('helper.formlabel', ['for' => "supplier_name", 'name' => __('label.inward_name_create'), 'required' => true])
   </div>
    <div class="md:w-8/12">
       {{ Form::text('supplier_name', $inward->supplier_name ,array('id'=>'searchsupplier', 'class'=>'form-input rounded block w-full p-2 focus:bg-white','Placeholder'=>'Search Supplier Name and Company Name', 'autocomplete'=>'off')) }}
       <ul id="searchResult" class="absolute z-10 w-7/12"> </ul>
       <span class="clear">
    </div>
</div>





<div class="md:flex mb-3">
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "supplier_uniqid", 'name' => __('label.inward_uniqid_create'), 'required' => true])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('supplier_uniqid',$inward->supplier_uniqid ,array('id'=>'supplier_uniqid', 'class'=>'rounded block w-full p-1 bg-white focus:bg-white','readonly' => 'readonly')) }}
         @include('helper.formerror', ['error' => "supplier_uniqid"])
     </div>

      <div class="md:w-2/12">
        @include('helper.formlabel', ['for' => "companyname", 'name' => __('label.inward_companyname_create'), 'required' => true])
       </div>
       <div class="md:w-4/12">
          {{ Form::text('companyname',$inward->companyname ,array('id'=>'companyname', 'class'=>'rounded block w-full p-1 focus:bg-white' , 'readonly' => 'readonly')) }}
           @include('helper.formerror', ['error' => "companyname"])
       </div>
</div>



<!-- <div class="md:flex mb-3"> -->



<!--
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "supplier_name", 'name' => "SUPPLIER NAME", 'required' => true])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('supplier_name',$inward->supplier_name ,array('id'=>'supplier_name', 'class'=>'rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "supplier_name"])
     </div> -->

<!-- </div> -->



<div class="md:flex mb-3">
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "phone", 'name' => __('label.inward_contactmobno_create'), 'required' => true])
    </div>
    <div class="md:w-4/12">
       {{ Form::text('phone',$inward->phone ,array('id'=>'phone','class'=>'rounded block w-full p-1 focus:bg-white' , 'readonly' => 'readonly')) }}
        @include('helper.formerror', ['error' => "phone"])
    </div>

    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "date", 'name' => __('label.inward_date_create'), 'required' => true])
   </div>
   <div class="md:w-4/12">
   {{ Form::text('date',($inward->date)?$inward->date:\Carbon\Carbon::now()->format('Y-m-d h:i:s') ,array('id'=>'date','class'=>'form-input rounded block w-full p-1 focus:bg-white',  'readonly' => 'readonly')) }}
      @include('helper.formerror', ['error' => "date"])
      <!-- {{ Form::date('date',Carbon\Carbon::parse($inward->date)->format('Y-m-d'), array('id'=>'date','class'=>'rounded block w-full p-1 focus:bg-white',  'readonly' => 'readonly')) }}
      @include('helper.formerror', ['error' => "date"]) -->
   </div>
 </div>


 <div class="md:flex mb-3">
    <div class="md:w-2/12">
        @include('helper.formlabel', ['for' => "address", 'name' => __('label.inward_address_create'), 'required' => true])
      </div>
      <div class="md:w-4/12">
          {{ Form::textarea('address',$inward->address ,array('id'=>'address','class'=>'p-1 block w-full focus:bg-white', 'rows'=>'2'  , 'readonly' => 'readonly')) }}
          @include('helper.formerror', ['error' => "address"])
      </div>
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "remarks", 'name' => __('label.inward_remarks_create'), 'required' => false])
    </div>
    <div class="md:w-4/12">
       {{ Form::textarea('remarks',$inward->remarks ,array('id'=>'remarks','class'=>'p-1 form-textarea block w-full focus:bg-white', 'rows'=>'2')) }}
        @include('helper.formerror', ['error' => "place_of_supply"])
    </div>

 </div>

 <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
   <li class="mr-3 lg:text-xl text-xl">
   {{__('label.inward_title_create')}}
   </li>
</ul>
 @if($errors->any())
     @foreach ($errors->all() as $error)
         <div class="text-red-600">{{$error}}</div>
     @endforeach
 @endif

{{-----INWARD ITEM------}}


    @livewire('admin.druginward.inwarditemlivewire', ['inward_id' => $inward->id])
