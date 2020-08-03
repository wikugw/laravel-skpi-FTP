@extends('layouts.master')
<link rel="stylesheet" type="text/css" href="{{asset('ftp/css/lightbox.min.css')}}">
<script src="{{asset('ftp/js/lightbox-plus-jquery.min.js')}}"></script>
  @section('content')
      <div class="main">
        <div class="main-content">
          <div class="container-fluid">
            <div class="panel panel-headline">
              <div class="panel-body">
                <div class="row">
                  <button type="button" class="btn btn-primary btn-xs float-right"
                  data-toggle="modal" data-target="#exampleModal">
                    Tambah Kegiatan
                  </button>
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Tambah Kegiatan</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form  method="post" enctype="multipart/form-data">
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
                              <input class="form-control" name="nama_prestasi" id="namaPrestasi" placeholder="Nama Kegiatan" required>
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
  											    	<label for="exampleInputEmail1">Nama Peserta</label><p></p>
                              <div class="autocomplete" style="width:300px;">
  												     <input class="form-control" id="namaPeserta" placeholder="Nama Peserta" autocomplete="off" required>
                             </div>
  											       <button type="button" id="btnTambahPeserta" class="btn btn-info">tambah</button><br>
  														<div id="pesertaTerpilih" class="btn-group" role="group" aria-label="Basic example"></div>
  												  </div>
                            <div class="form-group">
                              <label for="exampleFormControlTextarea1">Uraian Kegiatan/Prestasi</label>
                              <textarea class="form-control" name="uraian" id="uraian" rows="3" placeholder="Informasi tambahan mengenai kegiatan" required></textarea>
                            </div>
                            <div class="form-group">
                              <label for="exampleFormControlTextarea1">Dokumen Pendukung</label>
                              <input type="file" accept="image/*" id="fotoPrestasi" name="foto" class="form-control" onchange="return fileValidation()" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <img src="{{asset('loading.gif')}}" id="loading3" width="30px" style="visibility:hidden"  alt="">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" id="btnSubmit" class="btn btn-primary">Submit</button>
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
                  <table class="table table-hover table-bordered" id="tabel_kemahasiswaan">
                  <thead>
                    <tr>
                      <th>Nama Peserta</th>
                      <th>NIM</th>
                      <th>Jenis Prestasi</th>
                      <th>Nama Kegiatan</th>
                      <th>Lokasi Kegiatan</th>
                      <th>Tahun Kegiatan</th>
                      <th>Tingkat Kegiatan</th>
                      <th>Posisi</th>
                      <th>Foto</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data_prestasi as $prestasi)
                    <tr>
                      <td>{{$prestasi->user->name}}</td>
                      <td>{{$prestasi->no_induk}}</td>
                      <td>{{$prestasi->jenis}}</td>
                      <td>{{$prestasi->nama_prestasi}}</td>
                      <td>{{$prestasi->lokasi}}</td>
                      <td>{{$prestasi->tahun}}</td>
                      <td>{{$prestasi->tingkat}}</td>
                      <td>{{$prestasi->posisi}}</td>
                      <td>

                        <a href="{{ env('Base_url').'/images/'.$prestasi->foto}}" data-lightbox="mygallery">Lihat</a>
                      </td>
                      <td>
                        <a href="/kemahasiswaan/{{$prestasi->id_prestasi}}/verifikasi"
                          class="btn btn-info btn-xs"
                          onclick="return confirm('Apakah Anda Yakin Akan Verifikasi Prestasi yang Dipilih?')">Verifikasi</a>
                        <a href="/kemahasiswaan/{{$prestasi->id_prestasi}}/tolak"
                          class="btn btn-danger btn-xs"
                          onclick="return confirm('Apakah Anda Yakin Akan Menolak Prestasi yang Dipilih?')">Tolak</a>
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
    var token = '{{ Session::token() }}';
      $(document).ready(function() {
        $('#tabel_kemahasiswaan').DataTable();
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

      var array_listTerpilih = [];
      document.getElementById('btnTambahPeserta').addEventListener('click', function(){
  			var namaPeserta = document.getElementById('namaPeserta').value;
  			var buttons = document.createElement('button');
        nimPeserta = namaPeserta.split("-");
        nimPeserta = nimPeserta[1];
        console.log(nimPeserta);
        if(namaPeserta == "") {
          alert("tidak boleh kosong");

        } else {
          if (array_listTerpilih.includes(nimPeserta)) {
            console.log(array_listTerpilih);
            alert("Peserta sudah dipilih");
          }else{
            buttons.className = 'btn btn-info';
      			buttons.innerHTML = namaPeserta;
      			buttons.style = 'margin:5px';
      			buttons.id = 'buttons'+namaPeserta;
        		var div= document.getElementById('pesertaTerpilih');
        }


    			buttons.onclick = function () {
    				var elem = document.getElementById(this.id);
            elem.parentElement.removeChild(elem);
            nim = elem.innerHTML;
            nim = nim.split("-");
            nim = nim[1];
            array_listTerpilih = array_listTerpilih.filter(function(e) { return e !== nim });
    			}

    			div.appendChild(buttons);
          index = namaPeserta.split("-");
          array_listTerpilih.push(index[1]);
        }

  		});


      document.getElementById("btnSubmit").addEventListener('click', function(){
        var jenisPrestasi = document.getElementById("jenisPrestasi").value;
        var namaPrestasi = document.getElementById("namaPrestasi").value;
        var lokasiKegiatan = document.getElementById("lokasiKegiatan").value;
        var tahunKegiatan = document.getElementById("tahunKegiatan").value;
        var tingkatKejuaraan = document.getElementById("tingkatKejuaraan").value;
        var uraian = document.getElementById("uraian").value;
        var foto = document.getElementById('fotoPrestasi');
        var posisi = document.getElementById('posisi').value;
        var image = foto.files[0];
        jObject= JSON.stringify(array_listTerpilih);

        if (jenisPrestasi == null) {
          alert('harap diisi!');
          return;
        } else if (namaPrestasi == "") {
          alert('nama kegiatan harap diisi!');
          return;
        } else if (lokasiKegiatan == "") {
          alert('lokasi harap diisi!');
          return;
        } else if (tahunKegiatan == "") {
          alert('tahun harap diisi!');
          return;
        } else if (uraian == "") {
          alert('uraian kegiatan harap diisi!');
          return;
        } else if (image == null) {
          alert('harap upload dokumentasi kegiatan!');
          return;
        } else if (array_listTerpilih.length == 0) {
          alert('nama peserta harap diisi! (minimal 1 peserta)');
          return;
        }

        var form = new FormData();
        form.append('jenisPrestasi', jenisPrestasi);
        form.append('list_user',jObject);
        form.append('foto',image);
        form.append('_token', token);
        form.append('namaPrestasi', namaPrestasi);
        form.append('lokasiKegiatan', lokasiKegiatan);
        form.append('tahunKegiatan', tahunKegiatan);
        form.append('tingkatKejuaraan', tingkatKejuaraan);
        form.append('posisi',posisi);
        form.append('uraian',uraian);

        $.ajax({
                  method: 'POST',
                  url:'/kemahasiswaan/tambah',
                  cache: false,
                  beforeSend : function(request){
                    var x = document.getElementById('loading3');
                    x.style.visibility = 'visible';
                  },
                  contentType: false,
                  processData: false,
                  traditional: true,
                  data: form
                }).done(function(msg){
                  console.log(msg);
                    window.location='{{url ('/kemahasiswaan')}}';
                });

      });

      var list_user = <?php echo json_encode($list_user); ?>;
      var array_user = [];
      for (var i = 0; i < list_user.length; i++) {
        array_user.push(list_user[i].name+'-'+list_user[i].no_induk);
      }

      autocomplete(document.getElementById("namaPeserta"), array_user);
      function autocomplete(inp, arr) {
      /*the autocomplete function takes two arguments,
      the text field element and an array of possible autocompleted values:*/
      var currentFocus;
      /*execute a function when someone writes in the text field:*/
      inp.addEventListener("input", function(e) {
          var a, b, i, val = this.value;
          /*close any already open lists of autocompleted values*/
          closeAllLists();
          if (!val) { return false;}
          currentFocus = -1;
          /*create a DIV element that will contain the items (values):*/
          a = document.createElement("DIV");
          a.setAttribute("id", this.id + "autocomplete-list");
          a.setAttribute("class", "autocomplete-items");
          /*append the DIV element as a child of the autocomplete container:*/
          this.parentNode.appendChild(a);
          /*for each item in the array...*/
          for (i = 0; i < arr.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
              /*create a DIV element for each matching element:*/
              b = document.createElement("DIV");
              /*make the matching letters bold:*/
              b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
              b.innerHTML += arr[i].substr(val.length);
              /*insert a input field that will hold the current array item's value:*/
              b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
              /*execute a function when someone clicks on the item value (DIV element):*/
              b.addEventListener("click", function(e) {
                  /*insert the value for the autocomplete text field:*/
                  inp.value = this.getElementsByTagName("input")[0].value;
                  /*close the list of autocompleted values,
                  (or any other open lists of autocompleted values:*/
                  closeAllLists();
              });
              a.appendChild(b);
            }
          }
      });
      /*execute a function presses a key on the keyboard:*/
      inp.addEventListener("keydown", function(e) {
          var x = document.getElementById(this.id + "autocomplete-list");
          if (x) x = x.getElementsByTagName("div");
          if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
          } else if (e.keyCode == 38) { //up
            /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
          } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
              /*and simulate a click on the "active" item:*/
              if (x) x[currentFocus].click();
            }
          }
      });
      function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
      }
      function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
          x[i].classList.remove("autocomplete-active");
        }
      }
      function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
          if (elmnt != x[i] && elmnt != inp) {
            x[i].parentNode.removeChild(x[i]);
          }
        }
      }
      /*execute a function when someone clicks in the document:*/
      document.addEventListener("click", function (e) {
          closeAllLists(e.target);
      });
    }
    </script>
  @endsection
