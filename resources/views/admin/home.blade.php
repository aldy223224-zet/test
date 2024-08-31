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