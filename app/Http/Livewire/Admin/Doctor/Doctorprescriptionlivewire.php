<?php

namespace App\Http\Livewire\Admin\Doctor;

use App\Models\Admin\Master\Drug;
use App\Models\Admin\Patients\Doctorprescription;
use Livewire\Component;

class Doctorprescriptionlivewire extends Component
{
    public $query;
    public $drug;
    public $doctorprescription = [];
    public $vital_id;

    protected $rules = [
        'doctorprescription.*.count' => 'required',

    ];

    protected $messages = [
        'doctorprescription.*.count.required' => 'Cannot empty.',

    ];

    public function mount($vital_id)
    {
        $this->vital_id = $vital_id;

        foreach (Doctorprescription::where('vital_id', $vital_id)->get() as $key => $value) {
            array_push($this->doctorprescription, [
                'vital_id' => $value->vital_id,
                'drug_id' => $value->drug_id,
                'drugname' => $value->drugname,
                'morning' => $value->morning,
                'afternoon' => $value->afternoon,
                'evening' => $value->evening,
                'night' => $value->night,
                'bf' => $value->bf,
                'af' => $value->af,
                'count' => $value->count,
            ]);
        }
    }

    public function updatedQuery()
    {

        $collection = collect($this->doctorprescription);
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

        $this->doctorprescription[] = [
            'vital_id' => $this->vital_id,
            'drug_id' => $drug->id,
            'drugname' => $drug->name,
            'morning' => false,
            'afternoon' => false,
            'evening' => false,
            'night' => false,
            'bf' => false,
            'af' => false,
            'count' => 0,
        ];

        $this->query = '';
        $this->drug = [];
        $this->validate();

    }

    public function removeitem($key)
    {

        unset($this->doctorprescription[$key]);
    }

    public function doctorprescriptionlivewirevalidation()
    {

        $this->validate();
    }

    public function render()
    {
        return view('livewire.admin.doctor.doctorprescriptionlivewire');
    }
}
