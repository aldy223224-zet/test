@extends('layouts.admin')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Halo {{$profil->name}}, {{ $profil->position }}!</h1>
    </div>
    @foreach($productions as $production)
                        <!-- Admin Date Menu -->
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="production_date{{ $production->id }}">Tanggal Produksi</label>
                                <input type="datetime-local" class="form-control" id="production_date{{ $production->id }}" name="production_date" value="{{ \Carbon\Carbon::parse($production->production_date)->format('Y-m-d\TH:i') }}" required>
                                @endforeach
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

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row m-0">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Produksi</h6>
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
            <td>{{ \Carbon\Carbon::parse($production->production_date)->format('d/m/Y') }}</td>
            <td>{{ $production->production_result }}</td>
            <td>{{ $production->shift }}</td>
            <td>
                @if ($production->status == 1)
                    <span class="badge badge-success">Terverifikasi</span>
                @elseif ($production->status == 0)
                    <span class="badge badge-warning">Menunggu verifikasi</span>
                @else
                    <span class="badge badge-danger">Ditolak</span>
                @endif
            </td>
            <td>
                <!-- Verify form -->
                <form action="{{ route('production.verify', $production->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="submit" value="verify">
                    <select name="status" required>
                        <option value="1">Terverifikasi</option>
                        <option value="0">Menunggu verifikasi</option>
                        <option value="2">Ditolak</option>
                    </select>
                    <button class="btn btn-primary btn-sm ml-auto" type="submit">Verifikasi</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
            </div>
        </div>
    </div>

    <!-- Admin Note Menu -->
    <div class="row">
        <div class="col-lg-12">
            <div class="p-4">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Berikan Catatan Hari Ini!</h1>
                </div>
                <form class="user" method="post">
                    <div class="form-group">
                        <input type="text" name="note" class="form-control form-control-user" placeholder="Catatan.....">
                    </div>
                        </div>
                        
                        <button type="submit" name="submit" class="btn btn-primary btn-user btn-block" style="width: 150px; padding: 10px; margin: 0 auto; display: block;">Submit</button>

    <!-- Instructions Card -->
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Petunjuk Penggunaan</h6>
        </div>
        <div class="card-body">
            <p>Pastikan semua data yang telah diinput oleh operator telah diverifikasi dengan teliti sebelum mengakhiri shift. Verifikasi ini penting untuk memastikan bahwa semua informasi yang dimasukkan akurat dan lengkap, sehingga mendukung kelancaran operasi dan menghindari potensi kesalahan.</p>
            <p class="mb-0">Ensure that all data that has been inputted by the operator has been carefully verified before ending the shift. This verification is important to ensure that all information entered is accurate and complete, thus supporting smooth operations and avoiding potential errors.</p>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection