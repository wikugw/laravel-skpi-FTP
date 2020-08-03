@extends('layouts.master')
  @section('content')
    <div class="main">
      <div class="main-content">
        <div class="container-fluid">
          <div class="panel panel-headline">
            <div class="panel-body">
              <div class="row">
                <a href="/akademik/export" class="btn btn-success btn-xs float-right">Unduh Excel</a>
              </div>
            </div>
          </div>
        </div>

        <div class="container-fluid">
          <div class="panel panel-headline">
            <div class="panel-heading">
              <h3 class="panel-title">Daftar Prestasi Mahasiswa</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <table class="table table-hover table-bordered" id="tabel_akademik">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>NIM</th>
                      <th>Program Studi</th>
                      <th>Jenis Prestasi</th>
                      <th>Nama Kegiatan</th>
                      <th>Lokasi Kegiatan</th>
                      <th>Tahun</th>
                      <th>Tingkat Kegiatan</th>
                      <th>Posisi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data_prestasi as $prestasi)
                    <tr>
                      <td>{{$prestasi->user->name}}</td>
                      <td>{{$prestasi->no_induk}}</td>
                      <td>{{$prestasi->user->prodi}}</td>
                      <td>{{$prestasi->jenis}}</td>
                      <td>{{$prestasi->nama_prestasi}}</td>
                      <td>{{$prestasi->lokasi}}</td>
                      <td>{{$prestasi->tahun}}</td>
                      <td>{{$prestasi->tingkat}}</td>
                      <td>{{$prestasi->posisi}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  @endsection
  @section('script')
    <script type="text/javascript">
      $(document).ready(function() {
        $('#tabel_akademik').DataTable();
      } );
    </script>
  @endsection
