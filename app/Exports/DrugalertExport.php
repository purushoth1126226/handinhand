<?php

namespace App\Exports;

use App\Models\Admin\Druginward\Inwarditem;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DrugalertExport implements FromCollection, WithHeadings
{

    protected $start;
    protected $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $start = Carbon::parse($this->start . " 00:00:00");
        $end = Carbon::parse($this->end . " 23:59:59");

        return $enrollment = Inwarditem::whereBetween('expiry_alertdate', array($start, $end))
            ->where('balance', '>=', 0)
            ->select(array('drug_name', 'expiry_alertdate', 'qty', 'balance', 'unit', 'bacth_id', 'manufacture_date'))
            ->orderby('expiry_alertdate', 'desc')
            ->get();

    }

    public function headings(): array
    {
        return [
            'DRUG',
            'EXPIRY ALERT DATE',
            'QTY',
            'BALANCE',
            'UNIT',
            'BATCH ID',
            'MANUFACTURE DATE',
        ];
    }
}
