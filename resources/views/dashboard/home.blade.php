@extends('layouts.dashboard')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Halo, {{$profil->name}}!</h1>
  </div>

    <!-- Dropdown Menu for Shift Selection -->
    <div class="ml-auto">
      <form class="form-inline">
        <div class="form-group">
          <label for="shiftSelect" class="sr-only">Pilih Shift:</label>
          <select id="shiftSelect" name="shift" class="form-control form-control-sm">
            <option value="1">Shift 1</option>
            <option value="2">Shift 2</option>
            <option value="3">Shift 3</option>
          </select>
        </div>
      </form>
    </div>
</div>

  <!-- Content Row -->
  <div class="row">

      <!-- Input data -->
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


      <!-- card verification status -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-gray text-uppercase mb-1">
                            Status Verifikasi
                        </div>
                        <div id="statusText" class="h5 mb-0 font-weight-bold text-danger">Belum Diverifikasi</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Misalnya, Anda memiliki variabel yang menunjukkan apakah sudah diverifikasi
        let isVerified = false; // Ganti dengan logika sebenarnya untuk menentukan status verifikasi
    
        // Fungsi untuk memperbarui status tampilan
        function updateVerificationStatus() {
            const statusTextElement = document.getElementById('statusText');
    
            if (isVerified) {
                statusTextElement.textContent = 'Sudah Diverifikasi';
                statusTextElement.classList.remove('text-danger');
                statusTextElement.classList.add('text-success');
            } else {
                statusTextElement.textContent = 'Belum Diverifikasi';
                statusTextElement.classList.remove('text-success');
                statusTextElement.classList.add('text-danger');
            }
        }
    
        // Panggil fungsi untuk memperbarui status tampilan saat halaman dimuat
        updateVerificationStatus();
    </script>
    





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