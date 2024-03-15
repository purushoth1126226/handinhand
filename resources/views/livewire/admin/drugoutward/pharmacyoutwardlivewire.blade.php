<div class="">
    <div class="w-75 mx-auto">
        <div class="md:w-10/12">
            <input type="text" class="form-input rounded block w-full p-2 focus:bg-white" placeholder="Drug Item Search"
                wire:model="query" {{-- wire:keydown.escape="reset"
                wire:keydown.tab="reset"
                wire:keydown.ArrowUp="decrementHighlight"
                wire:keydown.ArrowDown="incrementHighlight"
                wire:keydown.enter="selectContact" --}} />

            <ul wire:loading class="absolute z-10 list-group bg-white w-4/5 rounded-t-none shadow-lg">
                <li class="list-item">Searching...</li>
            </ul>

            @if (!empty($query))
                <ul class="absolute z-10 list-group bg-white w-9/12 rounded-t-none shadow-lg p-2">
                    @if (!empty($drug))
                        @foreach ($drug as $i => $eachdrug)
                            <li wire:click="additem({{ $eachdrug['id'] }})"
                                class="p-2 border-b-2 border-white font-bold rounded bg-green-300 text-grey-400 cursor-pointer hover:bg-green-400">
                                DRUG NAME: {{ $eachdrug['name'] }}
                                <span
                                    class="float-right text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-black bg-white last:mr-0 mr-1">
                                    GENERIC NAME: {{ $eachdrug['generic_name'] }}</span>

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
        <table class="text-md table-fixed mb-5">
            <thead>
                <tr>

                    <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">DRUG</th>
                    <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">QTY</th>
                    <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">BALANCE</th>
                    <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">UNIT</th>
                    <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">VARIANT</th>
                    <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">BATCH ID</th>
                    <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">MANUFACTURE DATE</th>
                    <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">EXPIRY DATE</th>
                    <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">EXPIRY ALERTDATE</th>
                    <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3">RECIEVED QTY</th>

                    {{-- <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3" >ANOTHER RECIEVED QTY</th> --}}

                    <th class="bg-blue-100 border border-gray-400 text-center px-5 py-3"></th>
                </tr>
            </thead>
            <tbody class="border border-gray-600 text-center ">
                @foreach ($pharmacyoutward as $key => $value)
                    <tr>
                        <td class="border border-gray-600">
                            <input wire:model="pharmacyoutward.{{ $key }}.vital_id" name="vital_id[]"
                                type="hidden">
                            <input wire:model="pharmacyoutward.{{ $key }}.inward_id" name="inward_id[]"
                                type="hidden">
                            <input wire:model="pharmacyoutward.{{ $key }}.drug_id" name="drug_id[]"
                                type="hidden">
                            <input wire:model="pharmacyoutward.{{ $key }}.drug_name" name="drug_name[]"
                                type="text" class="" readonly>
                        </td>
                        <td class="border border-gray-600"><input wire:model="pharmacyoutward.{{ $key }}.qty"
                                name="qty[]" type="text" class="w-2/5" readonly></td>
                        <td class="border border-gray-600"><input
                                wire:model="pharmacyoutward.{{ $key }}.balance" name="balance[]" type="text"
                                class="w-2/5" readonly></td>
                        <td class="border border-gray-600"><input wire:model="pharmacyoutward.{{ $key }}.unit"
                                name="unit[]" type="text" class="w-2/5" readonly></td>
                        <td class="border border-gray-600"><input
                                wire:model="pharmacyoutward.{{ $key }}.variant" name="variant[]" type="text"
                                class="w-3/5" readonly></td>
                        <td class="border border-gray-600"><input
                                wire:model="pharmacyoutward.{{ $key }}.bacth_id" name="bacth_id[]" type="text"
                                class="w-4/5" readonly></td>
                        <td class="border border-gray-600"><input
                                wire:model="pharmacyoutward.{{ $key }}.manufacture_date"
                                name="manufacture_date[]" value="" placeholder="YYY/MM/DD" type="date" class="w-4/5"
                                readonly></td>
                        <td class="border border-gray-600"><input
                                wire:model="pharmacyoutward.{{ $key }}.expiry_date" name="expiry_date[]"
                                value="" placeholder="YYY/MM/DD" type="date" class="w-4/5" readonly></td>
                        <td class="border border-gray-600"><input
                                wire:model="pharmacyoutward.{{ $key }}.expiry_alertdate"
                                name="expiry_alertdate[]" value="" placeholder="YYY/MM/DD" type="date" class="w-4/5"
                                readonly></td>


                        <td class="border border-gray-600">
                            @if ($pharmacyoutward[$key]['recordstatus'])
                                <span
                                    class="float-left bg-green-600 text-white ml-2 px-1 rounded-lg">{{ (int) $pharmacyoutward[$key]['received_qty'] + (int) $pharmacyoutward[$key]['outward_qty'] }}
                                </span>
                            @endif
                            <input wire:model="pharmacyoutward.{{ $key }}.received_qty" name="received_qty[]" type="hidden" >

                            <input wire:model="pharmacyoutward.{{ $key }}.outward_qty"
                                wire:change="pharmacyoutwardlivewirevalidation({{ $key }})"
                                wire:keyup="pharmacyoutwardlivewirevalidation({{ $key }})"
                                name="outward_qty[]" type="text" class="form-input w-2/5 focus:bg-white">

                            @error('pharmacyoutward.' . $key . '.outward_qty') <br>
                            <span class="text-red-600 text-sm"> {{ $message }}</span> @enderror
                        </td>

                        {{-- <td  class="border border-gray-600">

                       <input wire:model="pharmacyoutward.{{$key}}.received_qty" wire:change="pharmacyoutwardlivewirevalidation"  wire:keyup="pharmacyoutwardlivewirevalidation"  name="received_qty[]" type="text" class="form-input w-2/5 focus:bg-white" autofocus>

                       @error('pharmacyoutward.' . $key . '.received_qty')<br> <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                  </td> --}}

                        <td class="border border-gray-600"><button
                                wire:click.prevent="removeitem({{ $key }})"><i
                                    class="fas fa-trash text-red-700"></i> </button></td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    ​
</div>
