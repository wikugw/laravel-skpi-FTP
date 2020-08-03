@extends('layouts.master')
  @section('content')
      <div class="main">
        <div class="main-content">
          <div class="container-fluid">
            <div class="panel panel-headline">
              <div class="panel-body">
                <div class="row">
                  <!-- modal tambah prestasi -->
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary btn-xs float-right"
                  data-toggle="modal" data-target="#exampleModal">
                    Tambah Prestasi
                  </button>
                  <a href="/mahasiswa/export" class="btn btn-danger btn-xs float-right">Unduh Draft</a>
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Tambah Prestasi</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="/mahasiswa/tambah" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                              <label for="exampleFormControlSelect1" data-toggle="tooltip" data-placement="right"
                              title="jenis kegiatan dipilih">Jenis Prestasi</label>
                              <select name="jenis" class="form-control" id="jenisPrestasi">
                                <option>Karya Ilmiah</option>
                                <option>Prestasi Akademik</option>
                                <option>Pengabdian Masyarakat</option>
                                <option>Organisasi Mahasiswa</option>
                                <option>Religi</option>
                                <option>Kesenian</option>
                                <option>Olahraga</option>
                                <option>Pelatihan/Sertifikasi</option>
                                <option>Kedisiplinan</option>
                                <option>Lain-lain</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Nama Kegiatan</label>
                              <input class="form-control" name="nama_prestasi" id="namaKegiatan" placeholder="Nama Kegiatan" required>
                            </div>
                            <div class="form-group">
                             <label for="exampleInputEmail1">Lokasi Kegiatan</label>
                             <input class="form-control" name="lokasi" id="lokasiKegiatan" placeholder="Lokasi Kegiatan" required>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Tahun Kegiatan</label>
                              <input class="form-control" name="tahun" id="tahunKegiatan" placeholder="Tahun Kegiatan" onkeypress="isInputNumber(event)" required>
                            </div>
                              <div class="form-group">
                                <label for="exampleFormControlSelect1">Tingkat Kegiatan</label>
                                <select class="form-control" name="tingkat" id="tingkatKejuaraan">
                                  <option>Internasional</option>
                                  <option>Nasional</option>
                                  <option>Regional</option>
                                  <option>Universitas</option>
                                  <option>Fakultas</option>
                                  <option>Jurusan/Program Studi</option>
                                  <option>Komunitas Studi</option>
                                  <option> - </option>
                                </select>
                              </div>
                            <div class="form-group">
                              <label for="exampleFormControlSelect1">Posisi/Jabatan</label>
                              <select class="form-control" name="posisi" id="posisi">
                                <option disabled>- jika prestasi berupa perlombaan</option>
                                <option>Juara 1</option>
                                <option>Juara 2</option>
                                <option>Juara 3</option>
                                <option>Finalis</option>
                                <option>Terpilih</option>
                                <option disabled>- jika prestasi berupa kepanitiaan/keorganisasian</option>
                                <option>Ketua</option>
                                <option>Wakil Ketua</option>
                                <option>Pengurus 1</option>
                                <option>Pengurus 2</option>
                                <option>Anggota</option>
                                <option disabled>- lain - lain</option>
                                <option> - </option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="exampleFormControlTextarea1">Uraian Kegiatan/Prestasi</label>
                              <textarea class="form-control" name="uraian" id="exampleFormControlTextarea1" rows="3" placeholder="Informasi tambahan mengenai kegiatan" required></textarea>
                            </div>
                            <div class="form-group">
                              <label for="exampleFormControlTextarea1">Dokumen Pendukung</label>
                              <input type="file" accept="image/*" id="fotoPrestasi" name="foto" class="form-control" onchange="return fileValidation()" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Simpan</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="container-fluid">
            <div class="panel panel-headline">
              <div class="panel-heading">
                <h3 class="panel-title">Riwayat prestasi mahasiswa</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <table class="table table-hover table-bordered" id="tabel_mahasiswa">
                    <thead>
                      <tr>
                        <th>Jenis Prestasi</th>
                        <th>Nama Kegiatan</th>
                        <th>Lokasi Kegiatan</th>
                        <th>Tahun Kegiatan</th>
                        <th>Tingkat Kegiatan</th>
                        <th>Posisi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($data_prestasi as $prestasi)
                      <tr>
                        <td>{{$prestasi->jenis}}</td>
                        <td>{{$prestasi->nama_prestasi}}</td>
                        <td>{{$prestasi->lokasi}}</td>
                        <td>{{$prestasi->tahun}}</td>
                        <td>{{$prestasi->tingkat}}</td>
                        <td>{{$prestasi->posisi}}</td>
                        <td>
                          <?php
                          switch ($prestasi->status)
                          {
                              case 'Verifikasi':
                                  echo "<span class='label label-success'>".$prestasi->status."</span>";
                                  break;
                              case 'Menunggu':
                                  echo "<span class='label label-warning'>".$prestasi->status."</span>";
                                  break;
                              case 'Ditolak':
                                  echo "<span class='label label-default'>".$prestasi->status."</span>";
                                  break;
                              default:
                                  echo "<span class='label label-default'>".$prestasi->status."</span>";
                          }
                          ?>
                        </td>
                        <td>
                            @if ($prestasi->status!='Verifikasi')
                              <a href="/mahasiswa/{{$prestasi->id_prestasi}}/hapus"
                                class="btn btn-danger btn-xs"
                                onclick="return confirm('Apakah Anda Yakin Akan Menghapus Prestasi yang Dipilih')">Hapus</a>
                            @endif
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
  @endsection
  @section('script')
    <script type="text/javascript">
      $(document).ready(function() {
        $('#tabel_mahasiswa').DataTable();
      } );

      function fileValidation(){
        var fileInput = document.getElementById("fotoPrestasi");
        var filePath = fileInput.value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

        if(!allowedExtensions.exec(filePath)){
          alert('Mohon Upload Dokumen dengan format gambar (.jpeg/.jpg/.png/.gif)!');
          fileInput.value = '';
          return false;
        }
      }

      function isInputNumber(evt){
               var ch = String.fromCharCode(evt.which);
               if(!(/[0-9]/.test(ch))){
                   evt.preventDefault();
               }
           }
    </script>
  @endsection
