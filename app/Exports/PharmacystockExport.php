<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Admin\Master\Drug;
use App\Models\Admin\Druginward\Inwarditem;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PharmacystockExport implements FromCollection, WithHeadings
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
       
       
        // $drugexpiry =   $inwarditem = Inwarditem::whereDate('expiry_date', '<>', Carbon::now())
        // ->pluck('drug_id');
        return $pharmacystock =Drug::whereBetween('created_at', array($start, $end))
        ->where('currentstock', '>=', 0)
        // ->whereIn('id', $inwarditem)
        ->select(array('uniqid', 'name', 'manufacture_name', 'generic_name','currentstock'))
        ->orderby('created_at', 'desc')
        ->get();

    
    }

    public function headings(): array
    {
        return [
            'ID',
            'DRUG',
            'MANUFACTURE NAME',
            'GENERIC NAME',
            'CURRENT STOCK',
        ];
    }
}
