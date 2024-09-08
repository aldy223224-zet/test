@extends('layouts.admin')

@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Halo, {{$profil->name}}, {{$profil->position}}!</h1>
  </div>
  
  <!-- Content Row -->
  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
    class="fas fa-download fa-sm text-white-50"></i> Unduh Laporan</a>
    
    <button class="btn btn-primary btn-sm ml-auto" data-toggle="modal" data-target="#tambah">Tambah</button>

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
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
              </div>
              <div class="form-group">
                <label for="production_result">Hasil Produksi</label>
                <input type="number" class="form-control" id="production_result" name="production_result" required>
              </div>
              <div class="form-group">
                <label for="note">Catatan</label>
                <input type="text" class="form-control" id="ent" name="noteuser">
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


          <!-- Approach -->
          <div class="card shadow mb-4">
              <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Petunjuk Penggunaan</h6>
              </div>
              <div class="card-body">
                  <p>Pastikan bahwa semua data telah disubmit sebelum mengunduh laporan hari ini.</p>
                  <p class="mb-0">Ensure that all data has been submitted before downloading today's report.</p>
              </div>
          </div>

      </div>
  </div>

</div>
<!-- /.container-fluid -->
@endsection