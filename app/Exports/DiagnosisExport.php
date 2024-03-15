<?php

namespace App\Exports;

use App\Models\Admin\Patients\Vital;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DiagnosisExport implements FromCollection, WithHeadings
{

    protected $vital;
    protected $diagnosisname;

    public function __construct($vital, $diagnosisname)
    {
        $this->vital = $vital;
        $this->diagnosisname = $diagnosisname;
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
                'diagnosis' => ($this->diagnosisname) ? $this->diagnosisname : $value->diagnosis->pluck('name')->implode(', '),
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
            'DIAGNOSIS',
            'DATE',
        ];
    }
}
