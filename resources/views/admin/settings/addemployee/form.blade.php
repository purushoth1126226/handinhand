
<div class="md:flex mb-3">
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "name", 'name' => __('label.settings_name_form'), 'required' => true])
    </div>
    <div class="md:w-4/12">
       {{ Form::text('name',$addemployee->name ,array('id'=>'name', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
       @include('helper.formerror', ['error' => "name"])
    </div>
  <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "designation", 'name' => __('label.settings_designation_form'), 'required' => true])
    </div>
    <div class="md:w-4/12">
       {{ Form::text('designation',$addemployee->designation ,array('id'=>'designation', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
       @include('helper.formerror', ['error' => "designation"])
    </div>

</div>
<div class="md:flex mb-3">
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "phone", 'name' => __('label.settings_mobileno_form'), 'required' => true])
    </div>
    <div class="md:w-4/12">
       {{ Form::text('phone',$addemployee->phone ,array('id'=>'phone', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
       @include('helper.formerror', ['error' => "phone"])
    </div>
  <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "phone_two", 'name' => __('label.settings_altno_form'), 'required' => false])
    </div>
    <div class="md:w-4/12">
       {{ Form::text('phone_two',$addemployee->phone_two ,array('id'=>'phone_two', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
       @include('helper.formerror', ['error' => "phone_two"])
   </div>
</div>
<div class="md:flex mb-3">
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "department", 'name' =>__('label.settings_department_form'), 'required' => true])
    </div>
    <div class="md:w-4/12">
       {{ Form::text('department',$addemployee->department ,array('id'=>'department', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
       @include('helper.formerror', ['error' => "department"])
   </div>
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "employee_id", 'name' => __('label.settings_empid_form'), 'required' => false])
    </div>
    <div class="md:w-4/12">
       {{ Form::text('employee_id',$addemployee->employee_id ,array('id'=>'employee_id', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
       @include('helper.formerror', ['error' => "employee_id"])
   </div>
</div>
<div class="md:flex mb-3">
  <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "role_id", 'name' =>__('label.settings_role_form'), 'required' => false])
    </div>

  <div class="md:w-4/12">
     <select name="role_id" id="role_id" class="form-input rounded block w-full p-1 focus:bg-white"  readonly>
      @foreach($roles as $key => $value)
         <option  value="{{ $key }}" {{ ($addemployee->role_id == $key) ? 'selected' : '' }} >
            {{ $value }}
         </option>
      @endforeach
   </select>

      @include('helper.formerror', ['error' => "role_id"])
   </div>
  <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "doj", 'name' => __('label.settings_doj_form'), 'required' => false])
    </div>
    <div class="md:w-4/12">
       {{ Form::date('doj',$addemployee->doj ,array('id'=>'doj', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
       @include('helper.formerror', ['error' => "doj"])
    </div>
</div>
<div class="md:flex mb-3">
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "dob", 'name' =>__('label.settings_dob_form'), 'required' => false])
    </div>
    <div class="md:w-4/12">
       {{ Form::date('dob',$addemployee->dob ,array('id'=>'dob', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
       @include('helper.formerror', ['error' => "dob"])
   </div>
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "email", 'name' => __('label.settings_email_form'), 'required' => true])
    </div>
    <div class="md:w-4/12">
       {{ Form::text('email',$addemployee->email ,array('id'=>'email', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
       @include('helper.formerror', ['error' => "email"])
    </div>
</div>

<div class="md:flex mb-3">
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "password", 'name' => __('label.settings_password_form'), 'required' => true])
    </div>
    <div class="md:w-4/12">
       {{ Form::text('password', '' ,array('id'=>'password', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
       @include('helper.formerror', ['error' => "password"])
    </div>
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "status", 'name' => __('label.settings_status_form'), 'required' => false])
    </div>
    <div class="md:w-4/12">
      {{ Form::select('status', ['ACTIVE', 'INACTIVE'], $addemployee->status, ['class' => 'rounded form-select block w-full focus:bg-white p-1']) }}
       @include('helper.formerror', ['error' => "status"])
    </div>
</div>
<div class="md:flex mb-3">
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "address", 'name' => __('label.settings_address_form'), 'required' => false])
    </div>
    <div class="md:w-4/12">
      {{ Form::textarea('address',$addemployee->address ,array('id'=>'', 'class'=>'rounded form-textarea block w-full focus:bg-white p-1', 'rows'=>'2')) }}
       @include('helper.formerror', ['error' => "address"])
    </div>
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "language", 'name' =>  __('label.settings_language_form'), 'required' => false])
    </div>
   <div class="md:w-4/12">
      <select name="language" class="form-select block w-full focus:bg-white p-1" id="language" readonly>
         @foreach(config('archive.language') as $key => $value)
         <option value="{{ $key }}" {{ ($addemployee->language == $key) ? 'selected' : '' }}>
            {{ $value }}
         </option>
         @endforeach
      </select>
      @include('helper.formerror', ['error' => "language"])
   </div>

</div>
<div class="md:flex mb-3">
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "remarks", 'name' => __('label.settings_remark_form'), 'required' => false])
    </div>
    <div class="md:w-4/12">
      {{ Form::textarea('remarks',$addemployee->remarks ,array('id'=>'', 'class'=>'rounded form-textarea block w-full focus:bg-white p-1', 'rows'=>'2')) }}
       @include('helper.formerror', ['error' => "remarks"])
    </div>
</div>
