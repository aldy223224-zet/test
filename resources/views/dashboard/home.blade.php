@extends('layouts.dashboard')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Halo, {{$profil->name}}!</h1>
  </div>

  <!-- Content Row -->
  <div class="row">

      <!-- Earnings (Monthly) Card Example -->
      <div class="row">
        <div class="col-lg-12">
          <div class="p-4">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Masukan Hasil Produksi!</h1>
            </div>
            <form class="user" method="post">
              @csrf
              <div class="form-group">
                <input type="number" name="username" class="form-control form-control-user" placeholder="Hasil Produksi.....">
              </div>
              <button type="submit" name="submit" class="btn btn-primary btn-user btn-block" style="width: 150px; padding: 10px; margin: 0 auto; display: block;">Submit</button>


      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                              Status Verifikasi</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">Belum Diferifikasi</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>





          <!-- Approach -->
          <div class="card shadow mb-4">
              <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Petunjuk Penggunaan</h6>
              </div>
              <div class="card-body">
                  <p>Sebelum meninggalkan aplikasi, pastikan bahwa semua data yang Anda submit telah diverifikasi. Jika data Anda belum terverifikasi, harap menunggu proses verifikasi atau hubungi Kashif atau Supervisor (SPV) yang bertugas untuk bantuan lebih lanjut.</p>
                  <p class="mb-0">Before leaving the application, please ensure that all the data you submitted has been verified. If your data has not been verified, please wait for the verification process or contact Kashif or the Supervisor (SPV) on duty for further assistance.</p>
              </div>
          </div>

      </div>
  </div>

</div>
<!-- /.container-fluid -->
@endsection