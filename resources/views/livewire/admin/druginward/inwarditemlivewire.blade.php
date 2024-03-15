<div class="">
    <div class="w-75 mx-auto">
        <div class="md:w-10/12">
            <input
                type="text"
                class="form-input rounded block w-full p-2 focus:bg-white"
                placeholder="Drug Item Search"
                wire:model="query"
                {{-- wire:keydown.escape="reset"
                wire:keydown.tab="reset"
                wire:keydown.ArrowUp="decrementHighlight"
                wire:keydown.ArrowDown="incrementHighlight"
                wire:keydown.enter="selectContact" --}}
            />

            <ul wire:loading class="absolute z-10 list-group bg-white w-4/5 rounded-t-none shadow-lg">
                <li class="list-item">Searching...</li>
            </ul>

            @if(!empty($query))
                <ul class="absolute z-10 list-group bg-white w-9/12 rounded-t-none shadow-lg p-2">
                    @if(!empty($drug))
                        @foreach($drug as $i => $eachdrug)
                            <li wire:click="additem({{$eachdrug['id']}})"  class="p-2 border-b-2 border-white rounded font-bold bg-green-300 text-grey-400 cursor-pointer hover:bg-green-400">
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
   </div>
    <div style="overflow-y:hidden; overflow-x:auto;" class="container">
        <table class="w-1/4 text-md">
            <thead>
                <tr>
                <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">{{__('label.inward_drug_create')}}</th>
         <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">{{__('label.inward_qty_create')}}</th>
         <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">{{__('label.inward_unit_create')}}</th>
         <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">{{__('label.inward_variant_create')}}</th>
         <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">{{__('label.inward_batchid_create')}}</th>
         <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">{{__('label.inward_manufacturedate_create')}}</th>
         <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">{{__('label.inward_expirydate_create')}}</th>
         <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3" >{{__('label.inward_expiryalertdate_create')}}</th>
         <!-- <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3" >{{__('label.inward_price_create')}}</th> -->
        
          <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3"></th>

                </tr>
              </thead>
              <tbody class="border border-gray-600 text-center ">
                  @foreach ($inwarditem as $key => $value)
                  <tr>
                    <td  class="border border-gray-600  p-1">
                    <!-- <input wire:model="inwarditem.{{$key}}.id" name="id[]" type="hidden"> -->
                    <input wire:model="inwarditem.{{$key}}.inward_id" name="inward_id[]" type="hidden">
                        <input wire:model="inwarditem.{{$key}}.drug_id" name="drug_id[]" type="hidden">
                        <input wire:model="inwarditem.{{$key}}.drug_name"  name="drug_name[]" wire:change="Inwarditemlivewirevalidation"  wire:keyup="Inwarditemlivewirevalidation"  readonly>
                        @error('inwarditem.'.$key.'.drug_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </td>
                    <td  class="border border-gray-600 p-1">
                    <input wire:model="inwarditem.{{$key}}.qty" wire:change="Inwarditemlivewirevalidation"  wire:keyup="Inwarditemlivewirevalidation" name="qty[]" type="text" class="form-input w-2/5">
                     @error('inwarditem.'.$key.'.qty') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </td>

                    <td  class="border border-gray-600 p-1">
                    <input wire:model="inwarditem.{{$key}}.unit" wire:change="Inwarditemlivewirevalidation"  wire:keyup="Inwarditemlivewirevalidation" name="unit[]" type="text" class="form-input w-2/5">
                    @error('inwarditem.'.$key.'.unit') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </td>
                    <td  class="border border-gray-600 p-1">
                    <input wire:model="inwarditem.{{$key}}.variant" wire:change="Inwarditemlivewirevalidation"  wire:keyup="Inwarditemlivewirevalidation" name="variant[]" readonly>
                    @error('inwarditem.'.$key.'.variant') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </td>
                    <td  class="border border-gray-600 p-1">
                    <input wire:model="inwarditem.{{$key}}.bacth_id" wire:change="Inwarditemlivewirevalidation"  wire:keyup="Inwarditemlivewirevalidation" name="bacth_id[]" type="text" class="form-input">
                    @error('inwarditem.'.$key.'.bacth_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </td>
                    <td  class="border border-gray-600 p-1">

                    <input wire:model="inwarditem.{{$key}}.manufacture_date" wire:change="Inwarditemlivewirevalidation"  wire:keyup="Inwarditemlivewirevalidation" name="manufacture_date[]" value="" placeholder="MM/DD/YYYY"   type="date" class="form-input">
                    @error('inwarditem.'.$key.'.manufacture_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </td>
                    <td  class="border border-gray-600 p-1">
                    <input wire:model="inwarditem.{{$key}}.expiry_date" wire:change="Inwarditemlivewirevalidation"  wire:keyup="Inwarditemlivewirevalidation" name="expiry_date[]" value="" placeholder="YYYY/MM/DD"   type="date"  class="form-input">
                    @error('inwarditem.'.$key.'.expiry_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </td>
                    <td  class="border border-gray-600 p-1">
                    <input wire:model="inwarditem.{{$key}}.expiry_alertdate" wire:change="Inwarditemlivewirevalidation"  wire:keyup="Inwarditemlivewirevalidation" name="expiry_alertdate[]" value="" placeholder="YYYY/MM/DD"   type="date"  class="form-input">
                    @error('inwarditem.'.$key.'.expiry_alertdate') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </td>
                    <!-- <td  class="border border-gray-600 p-1">
                    <input wire:model="inwarditem.{{$key}}.price" wire:change="Inwarditemlivewirevalidation"  wire:keyup="Inwarditemlivewirevalidation" name="price[]" type="text" class="form-input">
                    @error('inwarditem.'.$key.'.price') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </td> -->
                    @if(!$inwarditem[$key]['recordstatus'])
                
                    <td  class="border border-gray-600 p-1"><button wire:click.prevent="removeitem({{$key}})"><i class="fas fa-trash text-red-700"></i> </button></td>
                    @endif
                  </tr>
                  @endforeach
              </tbody>
        </table>
      </div>
​
</div>
