<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportKegiatan implements FromCollection,WithHeadings
{

    protected $pertemuan;

    public function __construct(Collection $pertemuan)
    {
        $this->pertemuan = $pertemuan;
    }

    public function headings(): array
    {
        return [
            'No',
            'Judul Pertemuan',
            'Kegiatan',
            'Tanggal',
            // Add more headers as needed here
        ];
    }

    /**
     * 
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Mapping data pertemuan ke dalam format yang sesuai
        $formattedPertemuan = $this->pertemuan->map(function ($item, $index) {
            return [
                'No' => $index + 1, // Nomor
                'Judul Pertemuan' => $item->judul_pertemuan,
                'Kegiatan' => $item->kegiatan,
                'Tanggal' => Carbon::parse($item->tgl_pertemuan)->format('d F Y')
            ];
        });

        return $formattedPertemuan;
    }
}
