<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\prestasiExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Auth;


class c_prestasi extends Controller
{
  //fungsi menampilkan prestasi
  public function indexMahasiswa()
  {
    $client = new \GuzzleHttp\Client();
    $url = env('Base_url').'mahasiswa/'.session('no_induk');
    $request = $client->get($url);
    $response = json_decode($request->getBody());
    return view('v_mahasiswa', ['data_prestasi' => $response]);
  }

  //fungsi menambah prestasi
  public function tambahPrestasi(Request $request)
  {
    $client = new \GuzzleHttp\Client();
    $image_path = $request->file('foto')->getPathname();
    $image_org  = $request->file('foto')->getClientOriginalName();
    $data =   [
            'multipart' => [
                [
                    'name'     => 'foto',
                    'filename' => $image_org,
                    'contents' => fopen( $image_path, 'r' ),
                ],
                [
                  'name'     => 'jenis',
                  'contents' => $request->jenis,
                ],
                [
                  'name'     => 'nama_prestasi',
                  'contents' => $request->nama_prestasi,
                ],
                [
                  'name'     => 'lokasi',
                  'contents' => $request->lokasi,
                ],
                [
                  'name'     => 'tahun',
                  'contents' => $request->tahun,
                ],
                [
                  'name'     => 'tingkat',
                  'contents' => $request->tingkat,
                ],
                [
                  'name'     => 'posisi',
                  'contents' => $request->posisi,
                ],
                [
                  'name'     => 'uraian',
                  'contents' => $request->uraian,
                ],
                [
                  'name'     => 'no_induk',
                  'contents' => session('no_induk'),
                ]
            ]
        ];
    $url = env('Base_url').'mahasiswa/prestasitambah';
    // $url = "http://localhost:8090/mahasiswa/prestasitambah";
    $req = $client->request("POST", $url, $data);
    $response = $req->getBody();
    // return $response;
    return redirect('/mahasiswa');
  }

  //fungsi menampilkan prestasi butuh Verifikasi
  public function indexKemahasiswaan()
  {
    $client = new \GuzzleHttp\Client();
    $url1 = env('Base_url').'kemahasiswaan';
    $request = $client->get($url1);
    $response = json_decode($request->getBody());
    $url2 = env('Base_url').'kemahasiswaan/listuser';
    $request2 = $client->get($url2);
    $response2 = json_decode($request2->getBody());
    return view('v_kemahasiswaan', ['data_prestasi' => $response, 'list_user'=> $response2]);
  }

  //fungsi menampilkan prestasi telah Verifikasi
  public function indexAkademik()
  {
    $client = new \GuzzleHttp\Client();
    $url = env('Base_url').'akademik';
    $request = $client->get($url);
    $response = json_decode($request->getBody());
    return view('v_akademik', ['data_prestasi' => $response]);
  }

  //fungsi menghapus prestasi pada halaman Mahasiswa
  public function hapus($id_prestasi)
  {
    $client = new \GuzzleHttp\Client();
    $url = env('Base_url').'mahasiswa/'.$id_prestasi.'/hapus';
    $request = $client->delete($url);
    return redirect('/mahasiswa');
  }

  //fungsi menolak prestasi pada halaman Kemahasiswaan
  public function tolak($id_prestasi)
  {
    $client = new \GuzzleHttp\Client();
    $url = env('Base_url').'kemahasiswaan/'.$id_prestasi.'/tolak';
    $request = $client->put($url);
    return redirect('/kemahasiswaan');
  }

  //fungsi verifikasi prestasi pada halaman Kemahasiswaan
  public function verifikasi($id_prestasi){
    $client = new \GuzzleHttp\Client();
    $url = env('Base_url').'kemahasiswaan/'.$id_prestasi.'/verifikasi';
    $request = $client->put($url);
    $response = json_decode($request->getBody());
    return redirect('/kemahasiswaan');
  }

  public function exportExcel1()
   {
     $client = new \GuzzleHttp\Client();
     $url = env('Base_url').'akademik/exportexcel';
     $request = $client->get($url);
     $response = json_decode($request->getBody());
     $excel = new prestasiExport($response);
     return Excel::download($excel, 'prestasi.xlsx');
   }

   public function exportExcel()
    {
      $client = new \GuzzleHttp\Client();
      $url = env('Base_url').'mahasiswa/165150701111020';
      $request = $client->get($url);
      $response = json_decode($request->getBody());
      $excel = new prestasiExport($response);
      return Excel::download($excel, 'prestasi.xlsx');
    }

   public function exportDraft()
   {
     $client = new \GuzzleHttp\Client();
     $url = env('Base_url').'mahasiswa/exportpdf/'.session('no_induk');
     $request = $client->get($url);
     $response = json_decode($request->getBody());
     $data_prestasi = $response->data_prestasi;
     $data_user = $response->user;
     $pdf = PDF::loadView('prestasi_pdf', ['prestasi' => $data_prestasi,'user'=>$data_user]);
     return $pdf->download('draft.pdf');
     // return $response;
   }

   public function tambahKegiatan(Request $request)
   {

     $client = new \GuzzleHttp\Client();
     $image_path = $request->file('foto')->getPathname();
     $image_org  = $request->file('foto')->getClientOriginalName();
     $data =   [
             'multipart' => [
                 [
                     'name'     => 'foto',
                     'filename' => $image_org,
                     'contents' => fopen( $image_path, 'r' ),
                 ],
                 [
                   'name'     => 'jenis',
                   'contents' => $request->jenisPrestasi,
                 ],
                 [
                   'name'     => 'nama_prestasi',
                   'contents' => $request->namaPrestasi,
                 ],
                 [
                   'name'     => 'lokasi',
                   'contents' => $request->lokasiKegiatan,
                 ],
                 [
                   'name'     => 'tahun',
                   'contents' => $request->tahunKegiatan,
                 ],
                 [
                   'name'     => 'tingkat',
                   'contents' => $request->tingkatKejuaraan,
                 ],
                 [
                   'name'     => 'posisi',
                   'contents' => $request->posisi,
                 ],
                 [
                   'name'     => 'uraian',
                   'contents' => $request->uraian,
                 ],
                 [
                   'name'     => 'list_user',
                   'contents' => $request->list_user,
                 ]
             ]
         ];
     $url = env('Base_url').'kemahasiswaan/kegiatantambah';
     $req = $client->request("POST", $url, $data);
     $response = $req->getBody();
     return $response;
   }
}
