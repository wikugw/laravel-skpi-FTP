<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;

class c_aktor extends Controller
{

    public function loginKaryawan(Request $request) {
       $client = new \GuzzleHttp\Client();
       $data =   [
              'multipart' => [
                  [
                    'name'     => 'no_induk',
                    'contents' => $request->no_induk,
                  ],
                  [
                    'name'     => 'password',
                    'contents' => $request->password,
                  ]
                ]
                ];
      $url = env('Base_url').'auth';
      $req = $client->request("POST", $url, $data);
      $response = $req->getBody();
      $akses = json_decode($response, true);
      session(['message' => $akses['message']]);
      if (session('message') == 'masukkan kosong' || session('message') == 'salah' || session('message') == 'akun tidak ditemukan') {
        return redirect('/');
      } elseif (session('message') == 'data user') {
        session(['no_induk' => $akses['data']['no_induk']]);
        session(['nama' => $akses['data']['name']]);
        session(['jabatan' => $akses['data']['jabatan']]);
        switch (session('jabatan')) {
          case 'Kemahasiswaan' :
            return redirect('/kemahasiswaan');
            break;
          case 'Akademik':
            return redirect('/akademik');
            break;
        }
      }
    }

    public function loginMahasiswa(Request $request) {
      $mahasiswa ='';
        $data1 = [
            'nim' => e($request->input('no_induk')),
            'pass' => e($request->input('password')),
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://backend-bem.herokuapp.com/auth/login",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data1),
            CURLOPT_HTTPHEADER => array(
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
            ),
        ));
        $response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $err = curl_error($curl);
        curl_close($curl);
        $json = json_decode($response, true);
        if ($err) {
          return redirect('/login');
        } elseif ($status == '410') {
          return redirect('/login');
        } else {
          // if ($json['fakultas'] =='Teknologi Pertanian') {
          if ($json['fakultas'] =='Fakultas Ilmu Komputer') {
            $client = new \GuzzleHttp\Client();
            $data =   [
                    'multipart' => [
                        [
                          'name'     => 'no_induk',
                          'contents' => $json['nim'],
                        ],
                        [
                          'name'     => 'name',
                          'contents' => $json['nama'],
                        ],
                        [
                          'name'     => 'prodi',
                          'contents' => $json['prodi'],
                        ],
                        [
                          'name'     => 'fakultas',
                          'contents' => $json['fakultas'],
                        ],
                        [
                          'name'     => 'jabatan',
                          'contents' => 'Mahasiswa',
                        ],
                        [
                          'name'     => 'password',
                          'contents' => $request->input('password'),
                        ]
                    ]
                ];
            $url = env('Base_url').'register';
            $req = $client->request("POST", $url, $data);
            $response = $req->getBody();
              session(['nama' => $json['nama']]);
              session(['no_induk' => $json['nim']]);
              session(['prodi' => $json['prodi']]);
              return redirect('/mahasiswa');
          } else {
            return redirect ('/login');
          }

        }
    }

    public function logout(){
      session()->forget('no_induk');
      session()->forget('nama');
      session()->forget('prodi');
      session()->forget('jabatan');
      return redirect ('/');
    }
}
