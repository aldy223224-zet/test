@extends('layouts.dashboard')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Halo, {{$profil->name}}!</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <div class="row m-0">
          <h6 class="m-0 font-weight-bold text-primary">Tabel Produksi {{ $profil->position }}</h6>
          <button class="btn btn-primary btn-sm ml-auto" data-toggle="modal" data-target="#tambah">Tambah</button>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Posisi</th>
                <th>Group</th>
                <th>Shift</th>
                <th>Tanggal</th>
                <th>Hasil</th>
                <th>Catatan</th>
                <th>Status</th>
                <th>Aksi</th>
                <!-- Added action column -->
              </tr>
            </thead>
            <tbody>
              @foreach ($productions as $p)
              @php
              $pdate = date_create($p->production_date);
              @endphp
              <tr>
                <td>{{ $profil->name }}</td>
                <td>{{ $p->position }}</td>
                <td>{{ $p->group }}</td>
                <td>{{ $p->shift }}</td>
                <td>{{ date_format($pdate,"Y/m/d") }}</td>
                <td>{{ $p->production_result }}</td>
                <td>{{ $p->user_note }}</td>
                {{ $p->group }}
                {{ $p->shift }}
                <td style="text-align: center; vertical-align: middle;">
                  @if ($p->status == 1)
                    <span class="badge badge-success">Terverifikasi</span>
                  @elseif ($p->status == 0)
                    <span class="badge badge-warning">Menunggu verifikasi</span>
                  @else
                    <span class="badge badge-danger">Ditolak</span>
                    <div class="alert alert-danger p-1 mt-1" role="alert" style="font-size: 12px">
                      <b>Catatan : </b><br>{{ $p->note }}
                    </div>
                  @endif
                </td>
                <td>
                  @if ($p->status==0||$p->status==2)
                    <button class="btn btn-sm btn-info" onclick="edit({{ $p->id }})" data-toggle="modal" data-target="#edit">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="hapus({{ $p->id }})" data-toggle="modal" data-target="#hapus">Hapus</button>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Instructions Card -->
    <div class="card shadow mb-4 mt-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Petunjuk Penggunaan</h6>
      </div>
      <div class="card-body">
          <p>Sebelum meninggalkan aplikasi, pastikan bahwa semua data yang Anda submit telah diverifikasi. Jika data Anda belum terverifikasi, harap menunggu proses verifikasi atau hubungi Kashif atau Supervisor (SPV) yang bertugas untuk bantuan lebih lanjut.</p>
          <p class="mb-0">Before leaving the application, please ensure that all the data you submitted has been verified. If your data has not been verified, please wait for the verification process or contact Kashif or the Supervisor (SPV) on duty for further assistance.</p>
      </div>
    </div>

    <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Hasil Produksi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST">
            @csrf
            <div class="modal-body">
              <div class="form-group">
                <label for="production_date">Tanggal Produksi</label>
                <input type="datetime-local" class="form-control" id="production_date" name="production_date" required>
              </div>
              <div class="form-group">
                <label for="shift">Pilih Shift</label>
                <select class="form-control" id="shift" name="shift" required>
                  <option value="1">1 (00.00-08.00)</option>
                  <option value="2">2 (08.00-16.00)</option>
                  <option value="3">3 (16.00-24.00)</option>
                </select>
              </div>
              <div class="form-group">
                <label for="production_result">Hasil Produksi</label>
                <input type="number" class="form-control" id="production_result" name="production_result" required>
              </div>
              <div class="form-group">
                <label for="note">Catatan</label>
                <input type="text" class="form-control" name="user_note">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" name="submit" value="store" class="btn btn-primary">Tambah</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="et">Edit Hasil Produksi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST">
            @csrf
            <input type="hidden" class="d-none" id="eid" name="id">
            <div class="modal-body">
              <div class="form-group">
                <label for="epd">Tanggal Produksi</label>
                <input type="datetime-local" class="form-control" id="epd" name="production_date" required>
              </div>
              <div class="form-group">
                <label for="esh">Pilih Shift</label>
                <select class="form-control" id="esh" name="shift" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                </select>
              </div>
              <div class="form-group">
                <label for="epr">Hasil Produksi</label>
                <input type="number" class="form-control" id="epr" name="production_result" required>
              </div>
              <div class="form-group">
                <label for="note">Catatan</label>
                <input type="text" class="form-control" id="eun" name="user_note">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" name="submit" value="update" class="btn btn-primary">Simpan Perubahan</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ht">Hapus Hasil Produksi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST">
            @csrf
            <input type="hidden" class="d-none" id="hi" name="id">
            <div class="modal-body">
              <p id="hd">Apakah anda yakin ingin menghapus hasil produksi ini?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" name="submit" value="destroy" class="btn btn-danger">Hapus</button>
            </div>
          </form>
        </div>
      </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection


@section('script')
<script>
    function edit(id){
      $.ajax({
        url: "/api/production/"+id,
        type: 'GET',
        dataType: 'json', // added data type
        success: function(response) {
          var mydata = response.data;
          $("#eid").val(id);
          $("#epd").val(mydata.production_date);
          $("#epr").val(mydata.production_result);
          $("#esh").val(mydata.shift);
          $("#eun").val(mydata.user_note);
          //$("#et").text("Edit Logbook "+mydata.name);
        }
      });
    }
    function hapus(id){
      $.ajax({
        url: "/api/production/"+id,
        type: 'GET',
        dataType: 'json', // added data type
        success: function(response) {
          var mydata = response.data;
          $("#hi").val(id);
          $("#hd").text("Apakah anda yakin ingin menghapus hasil produksi tanggal "+mydata.production_date.split("T")[0]+"?");
        }
      });
    }
</script>
@endsection
