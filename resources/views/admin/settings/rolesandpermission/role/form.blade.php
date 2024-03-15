<div class="md:flex mb-3">
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "name", 'name' => "ROLE", 'required' => true])
   </div>
   <div class="md:w-8/12">
      {{ Form::text('name',$role->name ,array('id'=>'name', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
      @include('helper.formerror', ['error' => "name"])
   </div>
</div>
<div>
   <p class="text-xl p-2 flex items-center bg-blue-200 mb-6">
      <i class="fas fa-list mr-3"></i>
      <input type="checkbox" class="form-checkbox h-5 w-5 mx-3 text-green-600" id="ckbCheckAll"/>
      ADMIN SIDE NAVBAR
   </p>

   @foreach($permission->where('permissionsheading', "side_nav")->chunk(3) as $chunk)
   <div class="md:flex mb-3 mx-4">
            @foreach($chunk as $value)
            <div class="md:w-1/3">
              <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
              {{ $value->name }}</label>
            </div>
            @endforeach
  </div>
 @endforeach
</div>



<p class="text-xl p-2 flex items-center bg-blue-200 mb-2">
   <i class="fas fa-list mr-3"></i>ALLERGY
</p>


@foreach($permission->where('permissionsheading', "allergy")->chunk(3) as $chunk)
<div class="md:flex mb-3 mx-4">
         @foreach($chunk as $value)
         <div class="md:w-1/3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach



{{-- DIAGNOSIS --}}

<p class="text-xl p-2 flex items-center bg-blue-200 mb-2">
   <i class="fas fa-list mr-3"></i>DIAGNOSIS
</p>

@foreach($permission->where('permissionsheading', "diagnosis")->chunk(3) as $chunk)
<div class="md:flex mb-3 mx-4">
         @foreach($chunk as $value)
         <div class="md:w-1/3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach




<p class="text-xl p-2 flex items-center bg-blue-200 mb-2">
   <i class="fas fa-list mr-3"></i>LAB INVESTIGATION
</p>

@foreach($permission->where('permissionsheading', "labinvestigation")->chunk(3) as $chunk)
<div class="md:flex mb-3 mx-4">
         @foreach($chunk as $value)
         <div class="md:w-1/3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach






<p class="text-xl p-2 flex items-center bg-blue-200 mb-2">
   <i class="fas fa-list mr-3"></i>DRUG
</p>


@foreach($permission->where('permissionsheading', "drug")->chunk(3) as $chunk)
<div class="md:flex mb-3 mx-4">
         @foreach($chunk as $value)
         <div class="md:w-1/3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach



<p class="text-xl p-2 flex items-center bg-blue-200 mb-2">
   <i class="fas fa-list mr-3"></i>PHYSICAL AND GENERAL EXAMINATION
</p>


@foreach($permission->where('permissionsheading', "physicalandgeneralexam")->chunk(3) as $chunk)
<div class="md:flex mb-3 mx-4">
         @foreach($chunk as $value)
         <div class="md:w-1/3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach



<p class="text-xl p-2 flex items-center bg-blue-200 mb-2">
   <i class="fas fa-list mr-3"></i>LOCATION
</p>


@foreach($permission->where('permissionsheading', "village")->chunk(3) as $chunk)
<div class="md:flex mb-3 mx-4">
         @foreach($chunk as $value)
         <div class="md:w-1/3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach


<p class="text-xl p-2 flex items-center bg-blue-200 mb-2">
   <i class="fas fa-list mr-3"></i>ILLNESS
</p>

@foreach($permission->where('permissionsheading', "illness")->chunk(3) as $chunk)
<div class="md:flex mb-3 mx-4">
         @foreach($chunk as $value)
         <div class="md:w-1/3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach

<p class="text-xl p-2 flex items-center bg-blue-200 mb-2">
   <i class="fas fa-list mr-3"></i>SUPPLIER
</p>


@foreach($permission->where('permissionsheading', "supplier")->chunk(3) as $chunk)
<div class="md:flex mb-3 mx-4">
         @foreach($chunk as $value)
         <div class="md:w-1/3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach

<p class="text-xl p-2 flex items-center bg-blue-200 mb-2">
   <i class="fas fa-list mr-3"></i>INWARD
</p>


@foreach($permission->where('permissionsheading', "inward")->chunk(3) as $chunk)
<div class="md:flex mb-3 mx-4">
         @foreach($chunk as $value)
         <div class="md:w-1/3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach

<p class="text-xl p-2 flex items-center bg-blue-200 mb-2">
   <i class="fas fa-list mr-3"></i>PHARMACY STOCK
</p>


@foreach($permission->where('permissionsheading', "pharmacystock")->chunk(3) as $chunk)
<div class="md:flex mb-3 mx-4">
         @foreach($chunk as $value)
         <div class="md:w-1/3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach

<p class="text-xl p-2 flex items-center bg-blue-200 mb-2">
   <i class="fas fa-list mr-3"></i>PATIENT ENROLLMENT
</p>


@foreach($permission->where('permissionsheading', "patientenrollment")->chunk(3) as $chunk)
<div class="md:flex mb-3 mx-4">
         @foreach($chunk as $value)
         <div class="md:w-1/3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach


<p class="text-xl p-2 flex items-center bg-blue-200 mb-2">
   <i class="fas fa-list mr-3"></i>PATIENT ENROLLMENT HSISTORY
</p>


@foreach($permission->where('permissionsheading', "patientenrollmenthistory")->chunk(3) as $chunk)
<div class="md:flex mb-3 mx-4">
         @foreach($chunk as $value)
         <div class="md:w-1/3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach


<p class="text-xl p-2 flex items-center bg-blue-200 mb-2">
   <i class="fas fa-list mr-3"></i>PATIENT ENROLLMENT VITALS HSISTORY
</p>


@foreach($permission->where('permissionsheading', "patientenrollmentvitalshistory")->chunk(3) as $chunk)
<div class="md:flex mb-3 mx-4">
         @foreach($chunk as $value)
         <div class="md:w-1/3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach



<p class="text-xl p-2 flex items-center bg-blue-200 mb-2">
   <i class="fas fa-list mr-3"></i>DOCTOR
</p>

@foreach($permission->where('permissionsheading', "patientdoctor")->chunk(3) as $chunk)
<div class="md:flex mb-3 mx-4">
         @foreach($chunk as $value)
         <div class="md:w-1/3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach


<p class="text-xl p-2 flex items-center bg-blue-200 mb-2">
   <i class="fas fa-list mr-3"></i>PATIENT VISIT HISTORY
</p>

@foreach($permission->where('permissionsheading', "patientdoctorhistory")->chunk(3) as $chunk)
<div class="md:flex mb-3 mx-4">
         @foreach($chunk as $value)
         <div class="md:w-1/3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach


<p class="text-xl p-2 flex items-center bg-blue-200 mb-2">
   <i class="fas fa-list mr-3"></i>LABORATORY
</p>

@foreach($permission->where('permissionsheading', "patientlab")->chunk(3) as $chunk)
<div class="md:flex mb-3 mx-4">
         @foreach($chunk as $value)
         <div class="md:w-1/3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach



<p class="text-xl p-2 flex items-center bg-blue-200 mb-2">
   <i class="fas fa-list mr-3"></i>LABORATORY HISTORY
</p>

@foreach($permission->where('permissionsheading', "patientlabhistory")->chunk(3) as $chunk)
<div class="md:flex mb-3 mx-4">
         @foreach($chunk as $value)
         <div class="md:w-1/3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach


<p class="text-xl p-2 flex items-center bg-blue-200 mb-2">
   <i class="fas fa-list mr-3"></i>PHARMACY
</p>

@foreach($permission->where('permissionsheading', "patientpharmacy")->chunk(3) as $chunk)
<div class="md:flex mb-3 mx-4">
         @foreach($chunk as $value)
         <div class="md:w-1/3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach



<p class="text-xl p-2 flex items-center bg-blue-200 mb-2">
   <i class="fas fa-list mr-3"></i>PHARMACY HISTORY
</p>

@foreach($permission->where('permissionsheading', "patientpharmacyhistory")->chunk(3) as $chunk)
<div class="md:flex mb-3 mx-4">
         @foreach($chunk as $value)
         <div class="md:w-1/3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach



<p class="text-xl p-2 flex items-center bg-blue-200 mb-2">
   <i class="fas fa-list mr-3"></i>PATIENT ENROLLMENT REPORT
</p>


@foreach($permission->where('permissionsheading', "patientenrollmentreport")->chunk(3) as $chunk)
<div class="md:flex mb-3 mx-4">
         @foreach($chunk as $value)
         <div class="md:w-1/3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach


<p class="text-xl p-2 flex items-center bg-blue-200 mb-2">
   <i class="fas fa-list mr-3"></i>PATIENT VITAL REPORT
</p>

@foreach($permission->where('permissionsheading', "patientvitalreport")->chunk(3) as $chunk)
<div class="md:flex mb-3 mx-4">
         @foreach($chunk as $value)
         <div class="md:w-1/3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach


<p class="text-xl p-2 flex items-center bg-blue-200 mb-2">
   <i class="fas fa-list mr-3"></i>DIAGNOSIS REPORT
</p>

@foreach($permission->where('permissionsheading', "diagnosisreport")->chunk(3) as $chunk)
<div class="md:flex mb-3 mx-4">
         @foreach($chunk as $value)
         <div class="md:w-1/3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach

<p class="text-xl p-2 flex items-center bg-blue-200 mb-2">
   <i class="fas fa-list mr-3"></i>LAB REPORT
</p>

@foreach($permission->where('permissionsheading', "labreport")->chunk(3) as $chunk)
<div class="md:flex mb-3 mx-4">
         @foreach($chunk as $value)
         <div class="md:w-1/3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach

<p class="text-xl p-2 flex items-center bg-blue-200 mb-2">
   <i class="fas fa-list mr-3"></i>EXPIRY DRUG REPORT
</p>

@foreach($permission->where('permissionsheading', "expirydrugreport")->chunk(3) as $chunk)
<div class="md:flex mb-3 mx-4">
         @foreach($chunk as $value)
         <div class="md:w-1/3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach


<p class="text-xl p-2 flex items-center bg-blue-200 mb-2">
   <i class="fas fa-list mr-3"></i>EXPIRY DRUG ALERT REPORT
</p>

@foreach($permission->where('permissionsheading', "expiryalertdrugreport")->chunk(3) as $chunk)
<div class="md:flex mb-3 mx-4">
         @foreach($chunk as $value)
         <div class="md:w-1/3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach



<div>
   <p class="text-xl p-2 flex items-center bg-blue-200 mb-6">
      <i class="fas fa-list mr-3"></i> SETTINGS
   </p>


   @foreach($permission->where('permissionsheading', "settings")->chunk(3) as $chunk)
   <div class="md:flex mb-3 mx-4">
            @foreach($chunk as $value)
            <div class="md:w-1/3">
              <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
              {{ $value->name }}</label>
            </div>
            @endforeach
   </div>
   @endforeach
</div>


 <p class="text-xl p-2 flex items-center bg-blue-200 mb-2">
   <i class="fas fa-list mr-3"></i>ROLE
</p>

@foreach($permission->where('permissionsheading', "role")->chunk(3) as $chunk)
<div class="md:flex mb-3 mx-4">
         @foreach($chunk as $value)
         <div class="md:w-1/3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach 



<p class="text-xl p-2 flex items-center bg-blue-200 mb-2">
   <i class="fas fa-list mr-3"></i>TRACKINGS
</p>


@foreach($permission->where('permissionsheading', "logininfo")->chunk(3) as $chunk)
<div class="md:flex mb-3 mx-4">
         @foreach($chunk as $value)
         <div class="md:w-1/3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach


@foreach($permission->where('permissionsheading', "useractivity")->chunk(3) as $chunk)
<div class="md:flex mb-3 mx-4">
         @foreach($chunk as $value)
         <div class="md:w-1/3">
           <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox h-5 w-5 text-blue-600')) }}
           {{ $value->name }}</label>
         </div>
         @endforeach
</div>
@endforeach
