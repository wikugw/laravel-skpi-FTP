<?php

namespace App\Exports;

use App\m_prestasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class prestasiExport implements FromCollection, ShouldAutoSize, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      $client = new \GuzzleHttp\Client();
      $request = $client->get(env('Base_url').'akademik');
      $response = json_decode($request->getBody());
      return collect($response);
        // return m_prestasi::where('status','Verifikasi')->get();
    }

    public function map($prestasi): array
    {
        return [
            $prestasi->user->name,
            $prestasi->user->no_induk,
            $prestasi->user->prodi,
            $prestasi->jenis,
            $prestasi->nama_prestasi,
            $prestasi->lokasi,
            $prestasi->tahun,
            $prestasi->tingkat,
            $prestasi->posisi
        ];
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIM',
            'Program Studi',
            'Jenis Prestasi',
            'Nama Kegiatan',
            'Lokasi Kegiatan',
            'Tahun',
            'Tingkat Kegiatan',
            'Posisi'
        ];
    }
}
