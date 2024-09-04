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
                            <th>Group</th>
                            <th>Shift</th>
                            <th>Tanggal</th>
                            <th>Hasil</th>
                            <th>Status</th>
                            <th>Aksi</th> <!-- Added action column -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productions as $p)
                            @php
                                $pdate = date_create($p->production_date);
                            @endphp
                            <tr>
                                <td>{{ $profil->name }}</td>
                                <td>{{ $profil->position }}</td>
                                <td>{{ $profil->group }}</td>
                                <td>{{ $p->shift }}</td>
                                <td>{{ date_format($pdate,"Y/m/d") }}</td>
                                <td>{{ $p->production_result }}</td>
                                <td style="text-align: center; vertical-align: middle;">
                                    @if ($p->status == 1)
                                        <span class="badge badge-success">Terverifikasi</span>
                                    @elseif ($p->status == 0)
                                        <span class="badge badge-warning">Menunggu verifikasi</span>
                                    @else
                                        <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($p->status == 0)
                                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editModal{{ $p->id }}">Edit</button>
                                    @else
                                        <button class="btn btn-sm btn-secondary" disabled>Edit</button>
                                    @endif
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $p->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $p->id }}">Edit Hasil Produksi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ route('production.update', $p->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="production_date{{ $p->id }}">Tanggal Produksi</label>
                                                    <input type="datetime-local" class="form-control" id="production_date{{ $p->id }}" name="production_date" value="{{ \Carbon\Carbon::parse($p->production_date)->format('Y-m-d\TH:i') }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="shift{{ $p->id }}">Pilih Shift</label>
                                                    <select class="form-control" id="shift{{ $p->id }}" name="shift" required>
                                                        <option value="1" {{ $p->shift == 1 ? 'selected' : '' }}>1</option>
                                                        <option value="2" {{ $p->shift == 2 ? 'selected' : '' }}>2</option>
                                                        <option value="3" {{ $p->shift == 3 ? 'selected' : '' }}>3</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="production_result{{ $p->id }}">Hasil Produksi</label>
                                                    <input type="number" class="form-control" id="production_result{{ $p->id }}" name="production_result" value="{{ $p->production_result }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Edit Modal -->

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
