@extends('layouts.dashboard')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Halo, {{$profil->name}}!</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
              class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
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
                  <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
              </div>
              <div class="card-body">
                  <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                      CSS bloat and poor page performance. Custom CSS classes are used to create
                      custom components and custom utility classes.</p>
                  <p class="mb-0">Before working with this theme, you should become familiar with the
                      Bootstrap framework, especially the utility classes.</p>
              </div>
          </div>

      </div>
  </div>

</div>
<!-- /.container-fluid -->
@endsection