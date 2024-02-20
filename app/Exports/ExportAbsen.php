<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportAbsen implements FromCollection, WithHeadings
{
    protected $siswa;
    protected $jumlahKehadiran;
    protected $jumlahPertemuan;

    public function __construct($siswa, $jumlahKehadiran, $jumlahPertemuan)
    {
        $this->siswa = $siswa;
        $this->jumlahKehadiran = $jumlahKehadiran;
        $this->jumlahPertemuan = $jumlahPertemuan;
    }


    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Jumlah Masuk',
            'Jumlah Pertemuan',
            // Add more headers as needed here
        ];
    }


    public function collection()
    {
        // Format data yang sesuai untuk diekspor ke dalam Excel
        $data = [];
        $index = 1;
        foreach ($this->siswa as $student) {
            $data[] = [
                'No' => $index++,
                'Nama' => $student->nama,
                'Jumlah Kehadiran' => isset($this->jumlahKehadiran[$student->nama]) ? $this->jumlahKehadiran[$student->nama] : 0,
                'Jumlah Pertemuan' => $this->jumlahPertemuan,
            ];
        }

        return collect($data);
    }   
}
