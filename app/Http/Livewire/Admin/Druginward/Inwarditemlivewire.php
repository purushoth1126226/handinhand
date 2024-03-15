<?php

namespace App\Http\Livewire\Admin\Druginward;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Admin\Master\Drug;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Admin\Druginward\Inwarditem;
use App\Models\Admin\Pharmacy\Pharmacyoutward;

class Inwarditemlivewire extends Component
{

    public $query;
    public $drug;
    public $inwarditem = [];
    public $inward_id;
    public $pharmacyoutward;
    public $removekey;

    protected $listeners = ['removedrug'];


    protected $rules = [
        'inwarditem.*.drug_name' => 'required',
        'inwarditem.*.qty' => 'required|integer',
        'inwarditem.*.unit' => 'required',
        'inwarditem.*.variant' => 'required',
        'inwarditem.*.bacth_id' => 'required',
         'inwarditem.*.bacth_id' => 'required|min:1|unique:inwarditems,bacth_id,',
        'inwarditem.*.manufacture_date' => 'required',
        'inwarditem.*.expiry_date' => 'required',
        'inwarditem.*.expiry_alertdate' => 'required',
        // 'inwarditem.*.price' => 'required',
    ];

    protected $messages = [
        'inwarditem.*.drug_name.required' => 'Cannot empty.',
        'inwarditem.*.qty.required' => 'Cannot empty.',
        'inwarditem.*.qty.integer' => 'Number.',
        'inwarditem.*.unit.required' => 'Cannot empty.',

        'inwarditem.*.variant.required' => 'Cannot empty.',
        'inwarditem.*.bacth_id.required' => 'Cannot empty.',
        'unique'=> 'batch id must be unqiue',

        'inwarditem.*.manufacture_date.required' => 'Cannot empty.',

        'inwarditem.*.expiry_date.required' => 'Cannot empty.',

        'inwarditem.*.expiry_alertdate.required' => 'Cannot empty.',

        'inwarditem.*.notification_link.required' => 'Cannot empty.',
        // 'inwarditem.*.price.required' => 'The Price  cannot be empty.',

    ];

    public function mount($inward_id)
    {
        $this->inward_id = $inward_id;
       

        foreach (Inwarditem::where('inward_id', $inward_id)->get() as $key => $value) {
            array_push($this->inwarditem, [
                'id' => $value->id,
                'inward_id' => $value->inward_id,
                'drug_id' => $value->drug_id,
                'drug_name' => $value->drug_name,
                'qty' => $value->qty,
                'unit' => $value->unit,
                'variant' => $value->variant,
                'bacth_id' => $value->bacth_id,
                'manufacture_date' => Carbon::parse($value->manufacture_date)->format('Y-m-d'),
                'expiry_date' => Carbon::parse($value->expiry_date)->format('Y-m-d'),
                'expiry_alertdate' => Carbon::parse($value->expiry_alertdate)->format('Y-m-d'),
                // 'price' => $value->price,
                'recordstatus'=>true,

            ]);
        }

    }

    public function updatedQuery()
    {
       
        $collection = collect($this->inwarditem);
        $plucked = $collection->pluck('drug_id');


        $this->drug = Drug::whereNotIn('id', $plucked)
            ->where(function ($drugquery) {
                $drugquery->where('name', 'like', '%' . $this->query . '%')
                    ->orWhere('generic_name', 'like', '%' . $this->query . '%');

            })
            ->take(10)
            ->get()
            ->toArray();
       

    }

    public function additem($id)
    {
        

        $drug = Drug::find($id);

        $this->inwarditem[] = [
        
           
            'inward_id' => $this->inward_id,
            'drug_id' => $drug->id,
            'drug_name' => $drug->name,
            'qty' => '',
            'unit' => '',
            'variant' => Config('archive.drug_variant')[$drug->drug_variant],
            'bacth_id' => '',
            'manufacture_date' => '',
            'expiry_date' => '',
            'expiry_alertdate' => '',
            // 'price' => 0,
            'recordstatus'=>false,

        ];

        $this->query = '';
        $this->drug = [];
        $this->validate();

    }

    public function removeitem($key)
    {
        $this->removekey = $key;
        
        $collection = collect($this->inwarditem);
        $plucked = $collection->pluck('bacth_id');

        
        $pharmacyoutward = Pharmacyoutward::whereIn('bacth_id', $plucked )
        ->get()
        ->toArray();
       

        
        if(!$pharmacyoutward)
        {
    
          if ($this->inwarditem[$key]['recordstatus']) {
                    /* Write Delete Logic */
                    $this->dispatchBrowserEvent('swal:confirm', [
                        'type' => 'warning',
                        'message' => 'Are you sure?',
                        'text' => 'If deleted, you will not be able to recover this drug!',
                    ]);
                } else {
                    unset($this->inwarditem[$this->removekey]);

                }
        }elseif($this->inwarditem[$key]['recordstatus']){

              $this->dispatchBrowserEvent('swal:hello', [
                
                'text' => 'You will not be able to delete  this Drug!',
            ]);

        }else{

            unset($this->inwarditem[$this->removekey]);
        }

    }

    public function removedrug()
    {

        try {
            DB::beginTransaction();
          
            $drug = Drug::find($this->inwarditem[$this->removekey]['drug_id']);
            $drug->currentstock = $drug->currentstock - $this->inwarditem[$this->removekey]['qty'];
            $drug->save();

            Inwarditem::find($this->inwarditem[$this->removekey]['id'])->delete();

            unset($this->inwarditem[$this->removekey]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            Log::error('someting went to wrong');
        }
    }
   

    public function Inwarditemlivewirevalidation()
    {

        $this->validate();
    }

    public function render()
    {
        return view('livewire.admin.druginward.inwarditemlivewire');
    }
}
