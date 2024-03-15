<?php

namespace App\Exports;

use App\Models\Admin\Patients\Vital;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VitalExport implements FromCollection, WithHeadings
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

        return $vital = Vital::whereBetween('created_at', array($start, $end))
            ->select('uniqid', 'name', 'phone', 'created_at')
            ->orderby('created_at', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'VITAL ID',
            'NAME',
            'PHONE NO',
            'DATE',
        ];
    }
}
