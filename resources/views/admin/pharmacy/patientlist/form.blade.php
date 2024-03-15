<ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-2">
    <li class="mr-3 lg:text-xl text-xl">
    {{__('label.patientpharmacy_enrollment_edit')}}
      </li>
   </ul>

      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_id_edit')}}"   value="{{ $vital->uniqid }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_patientname_edit')}}" value="{{ $vital->name }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_age_edit')}}" value="{{ $vital->age }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_sexuality_edit')}}" value="{{ Config('archive.sexuality')[$vital->sexuality] }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_fatherorhusband_edit')}}" value="{{ $vital->fatherorhusband }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_mobileno_edit')}}" value="{{ $vital->phone }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_village_edit')}}" value="{{ ($vital->village && $vital->village->name)?($vital->village->name):'' }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_dob_edit')}}" value="{{ $vital->dob }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails  title="{{ __('label.patientenrollment_aadharorrational_create')}}"  value="{{$vital->aadharorrational}}" />
      </div>
      <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
       <li class="mr-3 lg:text-xl text-xl">
       {{__('label.patientpharmacy_vitals_edit')}}
         </li>
      </ul>

      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_mobileno_edit')}}"  value="{{ $vital->temperature }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_bloodpressure_edit')}}" value="{{ $vital->bloodpressure }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_height_edit')}}" value="{{ $vital-> height}}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_weight_edit')}}" value="{{ $vital->weight }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_pulserate_edit')}}" value="{{ $vital->pulserate }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_respiratory_edit')}}" value="{{ $vital->respiratoryrate }}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_sptwo_edit')}}" value="{{ $vital->spo_two }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_painscale_edit')}}" value="{{ $vital->painscaleone }}" />
      </div>
      <div class="md:flex mb-3">
         <!-- <x-admin.layouts.adminshowlabeldetails title='PAIN SCALE TWO' value="{{ $vital-> painscaletwo}}" /> -->
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_location_edit')}}" value="{{ $vital-> location}}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_mobileno_edit')}}" value="{{ $vital-> character}}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_allergy_edit')}}" value="{{ $vital->allergy->pluck('name')->implode(', ') }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_currentcomplaints_edit')}}" value="{{ $vital->illness->pluck('name')->implode(', ') }}" />

      </div>
      <div class="md:flex mb-3">
      <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_alcohol_edit')}}" value="{{isset($vital) && ($vital->alcohol == 0)  ? 'NO' : 'YES' }}" />
      <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_smoking_edit')}}" value="{{isset($vital) && ($vital->smoking == 0)  ? 'NO' : 'YES' }}" />
      </div>
      <div class="md:flex mb-3">
        <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_tobacco_edit')}}" value="{{isset($vital) && ($vital->tobacco == 0)  ? 'NO' : 'YES' }}" />
        <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_others_edit')}}" value="{{ $vital-> others}}" />
      </div>
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_doctor_edit')}}" value="{{ $vital->doctors}}" />
      </div>

      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_createdat_edit')}}" value="{{ date('d-m-Y', strtotime($vital->created_at))  }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_createdby_edit')}}" value="{{ $vital->created_by }}" />
      </div>
      @if($vital->updated_by)
      <div class="md:flex mb-3">
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_updatedat_edit')}}" value="{{date('d-m-Y', strtotime($vital->updated_at)) }}" />
         <x-admin.layouts.adminshowlabeldetails title="{{__('label.patientpharmacy_updatedby_edit')}}" value="{{ $vital->updated_by}}" />
      </div>
      @endif





      {{-- PRESCRIPTION --}}


      <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
         <li class="mr-3 lg:text-xl text-xl">
         {{__('label.patientpharmacy_prescription_edit')}}
         </li>
      </ul>

      <div id="app" class="flex justify-between p-2 mx-8">
         <table class="shadow-lg bg-white">
            <tr>
               <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-4">  {{__('label.patientpharmacy_sno_edit')}}</th>
              <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-80">{{__('label.patientpharmacy_drug_edit')}}</th>
              <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-32">{{__('label.patientpharmacy_morning_edit')}}</th>
              <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-32">{{__('label.patientpharmacy_afternoon_edit')}}</th>
              <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-32">{{__('label.patientpharmacy_evening_edit')}}</th>
              <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-32">{{__('label.patientpharmacy_night_edit')}}</th>
              <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">{{__('label.patientpharmacy_bf_edit')}}</th>
              <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">{{__('label.patientpharmacy_af_edit')}}</th>
              <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">{{__('label.patientpharmacy_count_edit')}}</th>
              <!-- <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">{{__('label.patientpharmacy_title_edit')}}</th> -->
            </tr>
            <tr v-for="(item, index) in form.drug">
               <td class="border border-gray-400 px-3 py-2 w-5">
                  <span>@{{ index+1 }}</span>

               </td>
              <td class="border border-gray-400 px-3 py-2 w-80">
                <input type="hidden" name="doctorprescription_id[]" class="form-control" readonly v-model="item.id">
                <span>@{{ item.drugname }}</span>

               </td>
              <td class="border border-gray-400 px-3 py-2">
               <center>
                <span class="rounded-full h-8 w-8 flex items-center justify-center bg-green-500" v-if="item.morning"></span>
                <span v-else>-</span>
              </center>
              </td>
              <td class="border border-gray-400 px-3 py-2">
               <center>
                <span class="rounded-full h-8 w-8 flex items-center justify-center bg-green-500" v-if="item.afternoon"></span>
                <span v-else>-</span>
              </center>
              </td>
              <td class="border border-gray-400 px-3 py-2">
                <center>
                    <span class="rounded-full h-8 w-8 flex items-center justify-center bg-green-500" v-if="item.evening"></span>
                    <span v-else>-</span>
                  </center>
              </td>
              <td class="border border-gray-400 px-3 py-2">
                <center>
                    <span class="rounded-full h-8 w-8 flex items-center justify-center bg-green-500" v-if="item.night"></span>
                    <span v-else>-</span>
                  </center>
              </td>
              <td class="border border-gray-400 px-3 py-2">
                <center>
                    <span class="rounded-full h-8 w-8 flex items-center justify-center bg-green-500" v-if="item.bf"></span>
                    <span v-else>-</span>
                  </center>
              </td>
              <td class="border border-gray-400 px-3 py-2">
                <center>
                    <span class="rounded-full h-8 w-8 flex items-center justify-center bg-green-500" v-if="item.af"></span>
                    <span v-else>-</span>
                  </center>
              </td>
              <td class="border border-gray-400 px-3 py-2">
                <span>@{{ item.count }}</span>
            </td>
            <!-- <td class="border border-gray-400 px-3 py-2 w-32">
                <input name=pharmacycount[] v-model="item.pharmacycount" type="text" class="form-input rounded block w-full p-1 focus:bg-white">
            </td> -->
            </tr>
          </table>
         </div>

   {{---DRUG OUTWARD----}}


    <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
         <li class="mr-3 lg:text-xl text-xl">
         DRUG OUTWARD
         </li>
      </ul>

 @if($errors->any())
     @foreach ($errors->all() as $error)
         <div class="text-red-600">{{$error}}</div>
     @endforeach
 @endif


 @livewire('admin.drugoutward.pharmacyoutwardlivewire', ['vital_id' => $vital->id])

  {{-- REMARKS --}}

  <ul class="flex justify-between bg-blue-500 text-white rounded p-2 my-4">
    <li class="mr-3 lg:text-xl text-xl">
    {{__('label.patientpharmacy_remark_edit')}}
    </li>
 </ul>

 <div class="md:flex mb-3">
    <div class="md:w-2/12">
       @include('helper.formlabel', ['for' => "pharmacyremarks", 'name' =>__('label.patientpharmacy_remark_edit'), 'required' => false])
    </div>
    <div class="md:w-10/12">
       {{ Form::textarea('pharmacyremarks',$vital->pharmacyremarks ,array('id'=>'pharmacyremarks', 'class'=>'p-1 form-textarea block w-full focus:bg-white', 'rows'=>'2')) }}
       @include('helper.formerror', ['error' => "pharmacyremarks"])
    </div>
  </div>
