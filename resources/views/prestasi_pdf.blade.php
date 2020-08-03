
<head>

  <style>
    .prestasi, .sirah, .tubuh {
      border: 1px solid black;
      border-collapse: collapse;
    }
    .sirah, .tubuh {
      padding: 15px;
      text-align: left;
    }
    table#t01 {
      width: 100%;
      background-color: #f1f1c1;
    }
  </style>

</head>

<body>
  <div class="logo" style="margin: 0 0 0 20%; position: absolute">
    <!-- <a><img src="{{asset('/images/logo-min.jpg')}}"  style="width: 110px"alt=""></a> -->
  </div>
  <div class="oke" style="text-align:center; font-size : 12px; line-height: 5px">
    <p>KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</p>
    <p>UNIVERSITAS BRAWIJAYA</p>
    <b>FAKULTAS TEKNOLOGI PERTANIAN</b>
    <p>Jl. Veteran, Malang, 65145, Indonesia </p>
    <p>Telp.: (0341)580106; Fax : (0341)568917</p>
    <p>https://tp.ub.ac.id    E-mail : ftp_ub@ub.ac.id</p>
    <b style="font-size : 30px">___________________________________________________________</b>
  </div>
  <p style="text-align:center">DRAFT PRESTASI MAHASISWA</p>

  <div class="tabel " style="font-size : 12px;">
    <table class="" style="width:100%">
      <tr style="border-style: none">
        <td >Nama</td>
        <td>: {{$user->name}}</td>
        <td style="text-align: right">Program Studi </td>
        <td>: {{$user->prodi}}</td>
      </tr>
      <tr>
        <td>NIM </td>
        <td>: {{$user->no_induk}}</td>
      </tr>
    </table>
  </div>
<br>
  <table class="prestasi"style="width:100%; font-size : 12px">
  <thead>
    <tr>
      <th class="sirah">JENIS PRESTASI</th>
      <th class="sirah">NAMA KEGIATAN</th>
      <th class="sirah">POSISI</th>
      <th class="sirah">TAHUN</th>
      <th class="sirah">TINGKAT</th>
    </tr>
  </thead>
  <tbody>
    @foreach($prestasi as $p)
    <tr>
      <td class="tubuh">{{$p->jenis}}</td>
      <td class="tubuh">{{$p->nama_prestasi}}</td>
      <td class="tubuh">{{$p->posisi}}</td>
      <td class="tubuh">{{$p->tahun}}</td>
      <td class="tubuh">{{$p->tingkat}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
<br><br>
<div style="width: 50%; float:left">
  <div class="ttd" style="font-size : 12px">
  <p style="text-align:left; padding-left: 100px">Menyetujui,</p>
  <p style="text-align:left; padding-left: 100px">Dekan Fakultas Teknologi Pertanian</p>
  <br style="text-align:left; padding-left: 100px"></br>
  <br style="text-align:left; padding-left: 100px"></br>
  <br style="text-align:left; padding-left: 100px"></br>
  <p style="text-align:left; padding-left: 100px">Dr. Ir. Imam Santoso, MP.</p>
  <p style="text-align:left; padding-left: 100px">NIP. 19681005 199512 1 001</p>
  </div>
</div>

<div style="width: 50%; float:right">
  <div class="ttd" style="font-size : 12px">
  <p style="text-align:left; padding-left: 100px">Mengetahui,</p>
  <p style="text-align:left; padding-left: 100px">Wakil Dekan III Bidang Kemahasiswaan</p>
  <br style="text-align:left; padding-left: 100px"></br>
  <br style="text-align:left; padding-left: 100px"></br>
  <br style="text-align:left; padding-left: 100px"></br>
  <p style="text-align:left; padding-left: 100px">Yusuf Hendrawan, STP. M.App.Life.Sc. Ph.D</p>
  <p style="text-align:left; padding-left: 100px">NIP. 19810516 200312 1 002</p>
  </div>
</div>
<!-- <div class="col-md-12">
  <div class="col-md-6">

  </div>
</div> -->
</body>
