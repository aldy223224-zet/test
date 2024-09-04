@extends('layouts.dashboard')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Halo, {{$profil->name}}!</h1>
    </div>

    <h1 class="h3 mb-2 text-gray-800">Tabel Produksi {{ $profil->position }}</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row m-0">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Produksi</h6>
                <button class="btn btn-primary btn-sm ml-auto" data-toggle="modal" data-target="#tambahModal">Tambah</button>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
            <th>Posisi</th>
            <th>Grup</th>
            <th>Tanggal Input</th>
            <th>Hasil Produksi</th>
            <th>Shift</th>
            <th>Status Verifikasi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productions as $production)
        <tr>
            <td>{{ $production->user->name }}</td>
            <td>{{ $production->user->position }}</td>
            <td>{{ $production->user->group }}</td>
            <td>{{ $production->production_date }}</td>
            <td>{{ $production->production_result }}</td>
            <td>{{ $production->shift }}</td>
            <td>
                @if($production->status == 1)
                Verified
                @elseif($production->status == 0)
                Waiting for Verification
                @else
                Denied
                @endif
            </td>
            <td>
                <!-- Verify form -->
                <form action="{{ route('production.verify', $production->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="submit" value="verify">
                    <select name="status" required>
                        <option value="1">Verified</option>
                        <option value="0">Waiting</option>
                        <option value="2">Denied</option>
                    </select>
                    <input type="text" name="note" placeholder="Add a note (optional)">
                    <button type="submit">Submit</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
            </div>
        </div>
    </div>

    <!-- Tambah Modal -->
    <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Hasil Produksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('production.store') }}">
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="submit" value="store" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of Tambah Modal -->

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

</div>
<!-- /.container-fluid -->

@endsection
