<?php

namespace App\Exports;

use App\Models\Admin\Druginward\Inwarditem;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InwarditemExport implements FromCollection, WithHeadings
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

        return $enrollment = Inwarditem::whereBetween('created_at', array($start, $end))
            ->where('balance', '<>', 0)
            ->select(array('drug_name', 'expiry_date', 'qty', 'balance', 'unit', 'bacth_id', 'manufacture_date','expiry_alertdate'))
            ->orderby('expiry_date', 'desc')
            ->get();

    }

    public function headings(): array
    {
        return [
            'DRUG',
            'EXPIRY DATE',
            'QTY',
            'BALANCE',
            'UNIT',
            'BATCH ID',
            'MANUFACTURE DATE',
            'EXPIRY ALERT DATE'
        ];
    }
}
