<?php

namespace App\Http\Livewire\Admin\Drugoutward;

use App\Models\Admin\Druginward\Inwarditem;
use App\Models\Admin\Master\Drug;
use App\Models\Admin\Pharmacy\Pharmacyoutward;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Pharmacyoutwardlivewire extends Component
{

    public $query;
    public $drug;
    public $pharmacyoutward = [];
    public $vital_id;
    public $removekey;
    public $received_qty= [];

    protected $listeners = ['removedrug'];

    protected $rules = [
        "pharmacyoutward.*.outward_qty" => "required|lte:pharmacyoutward.*.balance",
    ];

    protected $messages = [
        'pharmacyoutward.*.outward_qty.required' => 'Cannot empty.',
        'lte' => 'Must be less than or equal to balance',
    ];

    public function mount($vital_id)
    {
        $this->vital_id = $vital_id;

        foreach (Pharmacyoutward::where('vital_id', $vital_id)->get() as $key => $value) {
            array_push($this->pharmacyoutward, [
                'outward_id' => $value->id,
                'vital_id' => $value->vital_id,
                'inward_id' => $value->inward_id,
                'drug_id' => $value->drug_id,
                'drug_name' => $value->drug_name,
                'qty' => $value->qty,
                'balance' => $value->balance,
                'unit' => $value->unit,
                'variant' => $value->variant,
                'bacth_id' => $value->bacth_id,
                'manufacture_date' => Carbon::parse($value->manufacture_date)->format('Y-m-d'),
                'expiry_date' => Carbon::parse($value->expiry_date)->format('Y-m-d'),
                'expiry_alertdate' => Carbon::parse($value->expiry_alertdate)->format('Y-m-d'),
                'received_qty' => $value->received_qty,
                'outward_qty' => 0,
                'recordstatus' => true,

            ]);
        }
    }

    public function updatedQuery()
    {

        $inwarditem_drugid = Inwarditem::whereDate('expiry_date', '<>', Carbon::now())
            ->where('balance', '<>', 0)
            ->pluck('drug_id');

        $this->drug = Drug::where('currentstock', '!=', 0)
            ->whereIn('id', $inwarditem_drugid)
            ->where(fn($drugquery) =>
                $drugquery->where('name', 'like', '%' . $this->query . '%')
                    ->orWhere('generic_name', 'like', '%' . $this->query . '%')
            )
            ->take(10)
            ->get()
            ->toArray();

    }

    public function additem($id)
    {
        $collection = collect($this->pharmacyoutward);
        $plucked = $collection->pluck('bacth_id');

        $drug = Drug::find($id);
        $inwarditem = Inwarditem::whereNotIn('bacth_id', $plucked)
            ->where('balance', '>', 0)
            ->where('drug_id', $id)
            ->first();

        if ($inwarditem) {
            $this->pharmacyoutward[] = [
                'outward_id' => null,
                'vital_id' => $this->vital_id,
                'inward_id' => $inwarditem->id,
                'drug_id' => $drug->id,
                'drug_name' => $drug->name,
                'qty' => $inwarditem->qty,
                'unit' => $inwarditem->unit,
                'balance' => $inwarditem->balance,
                'variant' => $inwarditem->variant,
                'bacth_id' => $inwarditem->bacth_id,
                'manufacture_date' => Carbon::parse($inwarditem->manufacture_date)->format('Y-m-d'),
                'expiry_date' => Carbon::parse($inwarditem->expiry_date)->format('Y-m-d'),
                'expiry_alertdate' => Carbon::parse($inwarditem->expiry_alertdate)->format('Y-m-d'),
                'received_qty' => 0,
                'outward_qty' => 0,
                'recordstatus' => false,

            ];
        }
        $this->query = '';
        $this->drug = [];
        $this->validate();

    }

    public function alertConfirm()
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'message' => 'Are you sure?',
            'text' => 'If deleted, you will not be able to recover this imaginary file!',
        ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function removeitem($key)
    {
        $this->removekey = $key;
        if ($this->pharmacyoutward[$key]['recordstatus']) {
            /* Write Delete Logic */
            $this->dispatchBrowserEvent('swal:confirm', [
                'type' => 'warning',
                'message' => 'Are you sure?',
                'text' => 'If deleted, you will not be able to recover this drug!',
            ]);
        } else {
            unset($this->pharmacyoutward[$this->removekey]);
        }

    }

    public function removedrug()
    {

        try {
            DB::beginTransaction();
            $inwarditem = Inwarditem::find($this->pharmacyoutward[$this->removekey]['inward_id']);
            $inwarditem->balance = $this->pharmacyoutward[$this->removekey]['balance'] + $this->pharmacyoutward[$this->removekey]['received_qty'];
            $inwarditem->save();

            $drug = Drug::find($this->pharmacyoutward[$this->removekey]['drug_id']);
            $drug->currentstock = $drug->currentstock + $this->pharmacyoutward[$this->removekey]['received_qty'];
            $drug->save();

            Pharmacyoutward::find($this->pharmacyoutward[$this->removekey]['outward_id'])->delete();

            unset($this->pharmacyoutward[$this->removekey]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            Log::error('someting went to wrong');
        }
    }

    public function pharmacyoutwardlivewirevalidation($key)
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.admin.drugoutward.pharmacyoutwardlivewire');
    }
}
