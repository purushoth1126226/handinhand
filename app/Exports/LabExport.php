<?php

namespace App\Exports;

use App\Models\Admin\Patients\Vital;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LabExport implements FromCollection, WithHeadings
{

    protected $vital;
    protected $labinvestigationname;

    public function __construct($vital, $labinvestigationname)
    {
        $this->vital = $vital;
        $this->labinvestigationname = $labinvestigationname;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $arr = [];
        foreach ($this->vital as $key => $value) {
            array_push($arr, [
                'sno' => $key + 1,
                'uniqid' => $value['uniqid'],
                'name' => $value['name'],
                'phone' => $value['phone'],
                'age' => $value['age'],
                'lab' => ($this->labinvestigationname) ? $this->labinvestigationname : $value->labinvestigation->pluck('name')->implode(', '),
                'created_at' => $value['created_at'],
            ]);
        }

        return collect($arr);

    }

    public function headings(): array
    {
        return [
            'S.NO',
            'ENROLLMENT ID',
            'NAME',
            'PHONE NO',
            'AGE',
            'LAB INVESTIGATION',
            'DATE',
        ];
    }
}
