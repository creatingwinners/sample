<?php

namespace App\Exports;

use App\Voucher;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;


class ParticipantExport implements FromCollection, WithHeadings, ShouldAutoSize
{

    use Exportable;

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'Voucher',
            'Price',
            'Coupon',
            'Email',
            'Name',
            'Address',
            'Housenumber',
            'Zipcode',
            'City',
            'IP',
            'Created',
        ];
    }

}
