<div class="md:flex mb-3">
      <div class="md:w-2/12">
        @include('helper.formlabel', ['for' => "company", 'name' =>__('label.suppplier_companyname_create'), 'required' => true])
       </div>
       <div class="md:w-4/12">
          {{ Form::text('company',$supplier->company ,array('id'=>'company', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
           @include('helper.formerror', ['error' => "company"])
       </div>




    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "name", 'name' =>__('label.suppplier_name_create'), 'required' => true])
     </div>
     <div class="md:w-4/12">
        {{ Form::text('name',$supplier->name ,array('id'=>'name', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
         @include('helper.formerror', ['error' => "name"])
     </div>


  {{-- <div class="md:w-1/12">
   @include('helper.formlabel', ['for' => "active", 'name' => "STATUS", 'required' => true])
  </div>
  <div class="md:w-1/12 pt-1">
      {!! Form::checkbox('active',  null,  isset($supplier) ? $supplier->active : 0 ,array('id'=>'active','class'=>'form-checkbox h-5 w-5 text-green-600')) !!}
      @include('helper.formerror', ['error' => "active"])
  </div> --}}
</div>




<div class="md:flex mb-3">
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "phone", 'name' =>__('label.suppplier_contactmobno_create'), 'required' => true])
    </div>
    <div class="md:w-4/12">
       {{ Form::text('phone',$supplier->phone ,array('id'=>'phone','class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
        @include('helper.formerror', ['error' => "phone"])
    </div>

    <div class="md:w-2/12">
        @include('helper.formlabel', ['for' => "phone_two", 'name' =>__('label.suppplier_phno_create'), 'required' => false])
      </div>
      <div class="md:w-4/12">
         {{ Form::text('phone_two',$supplier->phone_two ,array('id'=>'phone_two','class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
          @include('helper.formerror', ['error' => "phone_two"])
      </div>
 </div>





 <div class="md:flex mb-3">
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "email", 'name' => __('label.suppplier_email_create'), 'required' => false])
    </div>
    <div class="md:w-4/12">
       {{ Form::text('email',$supplier->email ,array('id'=>'email','class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
        @include('helper.formerror', ['error' => "email"])
    </div>
    <div class="md:w-2/12">
        @include('helper.formlabel', ['for' => "billing_address", 'name' =>__('label.suppplier_address_create'), 'required' => true])
      </div>
      <div class="md:w-4/12">
          {{ Form::textarea('billing_address',$supplier->billing_address ,array('id'=>'billing_address','class'=>'p-1 form-textarea block w-full focus:bg-white', 'rows'=>'2')) }}
          @include('helper.formerror', ['error' => "billing_address"])
      </div>

 </div>



 <div class="md:flex mb-3">
    <div class="md:w-2/12">
        @include('helper.formlabel', ['for' => "city", 'name' =>__('label.suppplier_city_create'), 'required' => false])
      </div>
      <div class="md:w-4/12">
         {{ Form::text('city',$supplier->city ,array('id'=>'city','class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
          @include('helper.formerror', ['error' => "city"])
      </div>
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "state", 'name' =>__('label.suppplier_state_create'), 'required' => false])
    </div>
    <div class="md:w-4/12">
       {{ Form::text('state',$supplier->state ,array('id'=>'state','class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
        @include('helper.formerror', ['error' => "state"])
    </div>

 </div>


 <div class="md:flex mb-3">
    <div class="md:w-2/12">
        @include('helper.formlabel', ['for' => "pincode", 'name' =>__('label.suppplier_pincode_create'), 'required' => false])
      </div>
      <div class="md:w-4/12">
         {{ Form::text('pincode',$supplier->pincode ,array('id'=>'pincode','class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
          @include('helper.formerror', ['error' => "pincode"])
      </div>
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "gstin", 'name' =>__('label.suppplier_gstin_create'), 'required' => false])
    </div>
    <div class="md:w-4/12">
       {{ Form::text('gstin',$supplier->gstin ,array('id'=>'gstin','class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
        @include('helper.formerror', ['error' => "gstin"])
    </div>

 </div>


 <div class="md:flex mb-3">
    <div class="md:w-2/12">
        @include('helper.formlabel', ['for' => "pan", 'name' =>__('label.suppplier_pan_create'), 'required' => false])
      </div>
      <div class="md:w-4/12">
         {{ Form::text('pan',$supplier->pan ,array('id'=>'pan','class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
          @include('helper.formerror', ['error' => "pan"])
      </div>
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "bankname", 'name' =>__('label.suppplier_bankname_create'), 'required' => false])
    </div>
    <div class="md:w-4/12">
       {{ Form::text('bankname',$supplier->bankname ,array('id'=>'bankname','class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
        @include('helper.formerror', ['error' => "bankname"])
    </div>

 </div>



 <div class="md:flex mb-3">
    <div class="md:w-2/12">
        @include('helper.formlabel', ['for' => "bankifsc", 'name' =>__('label.suppplier_ifsc_create'), 'required' => false])
      </div>
      <div class="md:w-4/12">
         {{ Form::text('bankifsc',$supplier->bankifsc ,array('id'=>'bankifsc','class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
          @include('helper.formerror', ['error' => "bankifsc"])
      </div>
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "bankbranch", 'name' =>__('label.suppplier_bankbranch_create'), 'required' => false])
    </div>
    <div class="md:w-4/12">
       {{ Form::text('bankbranch',$supplier->bankbranch ,array('id'=>'bankbranch','class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
        @include('helper.formerror', ['error' => "bankbranch"])
    </div>

 </div>

 <div class="md:flex mb-3">

    <div class="md:w-2/12">
        @include('helper.formlabel', ['for' => "bankaccountnumber", 'name' =>__('label.suppplier_acno_create'), 'required' => false])
      </div>
      <div class="md:w-4/12">
         {{ Form::text('bankaccountnumber',$supplier->bankaccountnumber ,array('id'=>'bankaccountnumber','class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
          @include('helper.formerror', ['error' => "bankaccountnumber"])
      </div>

    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "remarks", 'name' =>__('label.suppplier_remarks_create'), 'required' => false])
    </div>
    <div class="md:w-4/12">
       {{ Form::textarea('remarks',$supplier->remarks ,array('id'=>'remarks','class'=>'p-1 form-textarea block w-full focus:bg-white', 'rows'=>'2')) }}
        @include('helper.formerror', ['error' => "place_of_supply"])
    </div>
 </div>
