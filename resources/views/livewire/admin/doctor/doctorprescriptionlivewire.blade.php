<div class="">
    <div class="w-75 mx-auto">
        <div class="">
            <input
                type="text"
                class="form-input rounded block w-full p-2 focus:bg-white"
                placeholder="Drug Search..."
                wire:model="query"
                {{-- wire:keydown.escape="reset"
                wire:keydown.tab="reset"
                wire:keydown.ArrowUp="decrementHighlight"
                wire:keydown.ArrowDown="incrementHighlight"
                wire:keydown.enter="selectContact" --}}
            />

            <ul wire:loading class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
                <li class="list-item">Searching...</li>
            </ul>

            @if(!empty($query))
                <ul class="absolute z-10 list-group bg-white w-10/12 rounded-t-none shadow-lg p-2">
                    @if(!empty($drug))
                        @foreach($drug as $i => $eachdrug)
                        <li wire:click="additem({{$eachdrug['id']}})"  class="p-2 border-b-2 font-bold border-white rounded bg-green-300 text-grey-400 cursor-pointer hover:bg-green-400">
                             DRUG NAME: {{ $eachdrug['name'] }}
                             <span class="float-right text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-black bg-white last:mr-0 mr-1"> GENERIC NAME: {{ $eachdrug['generic_name'] }}</span>

                              </li>
                        @endforeach
                    @else
                        <li class="">
                            No results!
                            <span class="">0</span>
                          </li>
                    @endif
                </ul>
            @endif
        </div>
​
​
​
​
​

​
​
   </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-32">{{__('label.patientdoctor_drug_edit')}}</th>
         <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-32">{{__('label.patientdoctor_morning_edit')}}</th>
         <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-32">{{__('label.patientdoctor_afternoon_edit')}}</th>
         <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-32">{{__('label.patientdoctor_evening_edit')}}</th>
         <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-32">{{__('label.patientdoctor_night_edit')}}</th>
         <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-32">{{__('label.patientdoctor_bf_edit')}}</th>
         <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-32">{{__('label.patientdoctor_af_edit')}}</th>
         <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-32" >{{__('label.patientdoctor_count_edit')}}</th>
         <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3 w-32"></th>
                </tr>
              </thead>
              <tbody class="border border-gray-400 text-center">
                  @foreach ($doctorprescription as $key => $value)
                  <tr>
                    <td  class="border border-gray-400">
                    <input wire:model="doctorprescription.{{$key}}.vital_id" name="vital_id[]" type="hidden">
                        <input wire:model="doctorprescription.{{$key}}.drug_id" name="drug_id[]" type="hidden">
                        <input wire:model="doctorprescription.{{$key}}.drugname"  wire:change="doctorprescriptionlivewirevalidation"  wire:keyup="doctorprescriptionlivewirevalidation"  name="drugname[]" type="text" class="form-input" readonly>
                        @error('doctorprescription.'.$key.'.drug_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </td>
                    <td  class="border border-gray-400"><input wire:model="doctorprescription.{{$key}}.morning" name="morning[]" value="{{$key}}" type="checkbox" class="form-checkbox"></td>
                    <td  class="border border-gray-400"><input wire:model="doctorprescription.{{$key}}.afternoon" name="afternoon[]" value="{{$key}}" type="checkbox" class="form-checkbox"></td>
                    <td  class="border border-gray-400"><input wire:model="doctorprescription.{{$key}}.evening" name="evening[]" value="{{$key}}" type="checkbox" class="form-checkbox"></td>
                    <td  class="border border-gray-400"><input wire:model="doctorprescription.{{$key}}.night" name="night[]" value="{{$key}}" type="checkbox" class="form-checkbox"></td>
                    <td  class="border border-gray-400"><input wire:model="doctorprescription.{{$key}}.bf" name="bf[]" value="{{$key}}" type="checkbox" class="form-checkbox"></td>
                    <td  class="border border-gray-400"><input wire:model="doctorprescription.{{$key}}.af" name="af[]" value="{{$key}}" type="checkbox" class="form-checkbox"></td>
                    <td  class="border border-gray-400">
                    <input wire:model="doctorprescription.{{$key}}.count" wire:change="doctorprescriptionlivewirevalidation"  wire:keyup="doctorprescriptionlivewirevalidation" name="count[]" type="text" class="form-input">
                    @error('doctorprescription.'.$key.'.count') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </td>
                    <td  class="border border-gray-400"><button wire:click.prevent="removeitem({{$key}})"><i class="fas fa-trash text-red-700"></i> </button></td>

                  </tr>
                  @endforeach
              </tbody>
        </table>
      </div>
​
</div>
