@extends('layouts.admin')

@section('content')
<!-- Begin Page Content -->

<div class="container-fluid">
  
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Halo {{$profil->name}}, {{ $profil->position }}!</h1>
  </div>

  <div class="card shadow mb-4 mt-4 d-none">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Catatan produksi</h6>
    </div>
    <div class="card-body">
      <form method="post">
        @csrf
        <div class="row">
          <div class="col-2">
            <label for="">Tanggal</label>
            <input type="date" class="form-control" name="c_date" required>
          </div>
          <div class="col-2">
            <label for="">Shift admin</label>
            <select class="form-control" id="shift" name="c_shift" required>
              <option value="1">1 (00.00-08.00)</option>
              <option value="2">2 (08.00-16.00)</option>
              <option value="3">3 (16.00-24.00)</option>
            </select>
          </div>
          <div class="col-4">
            <label for="">Catatan</label>
            <input type="text" class="form-control" name="c_note" required>
          </div>
          <div class="col-2">
            <label for="" class="text-white">.</label><br>
            <button type="submit" class="btn btn-primary" name="submit" value="submit_note">Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  
  <div class="d-none">
    <table>
      <tr>
        <td class="px-1"><p class="text-primary m-0">Filter : </p></td>
        <td class="px-1"><input type="date" class="form-control form-control-sm"></td>
        <td class="px-1">
          <select id="shiftSelect" name="shift" class="form-control form-control-sm">
            <option value="1">Shift 1</option>
            <option value="2">Shift 2</option>
            <option value="3">Shift 3</option>
          </select>
        </td>
        <td class="px-1">
          <button type="submit" class="btn btn-primary btn-sm">submit</button>
        </td>
      </tr>
    </table>
    <br>
  </div>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <div class="row m-0">
        <h6 class="m-0 font-weight-bold text-primary my-auto">Tabel Produksi</h6>
        <button class="btn btn-success px-2 ml-auto" onclick="dataexport('excel')">Excel</button>
        <a class="btn btn-danger px-2 ml-2" href="/admin/print-laporan">PDF</a>
        {{-- <button class="btn btn-danger px-2 ml-2" onclick="dataexport('pdf')">PDF</button> --}}
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="myTable2" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th style="min-width: 140px;">Tanggal Produksi</th>
              <th>Shift</th>
              <th>Grup</th>
              <th>SPV</th>
              <th>KASHIF</th>
              <th>Posisi</th>
              <th>Nama</th>
              <th style="min-width: 110px;">Hasil Produksi</th>
              <th style="min-width: 130px;">Catatan operator</th>
              <th style="min-width: 140px;">Status Verifikasi</th>
              <th>Aksi</th>
              <th>Tanggal</th>
              <th>Shift</th>
              <th>Catatan</th>
            </tr>
          </thead>
          <tbody>
            @foreach($productions as $production)
            @php
              $pdate = date_create($production->production_date);   
              $sdate = date_create($production->shift_date);   
            @endphp
            <tr>
              <td>{{ date_format($pdate,"Y/m/d H:i:s") }}</td>
              <td>{{ $production->shift }}</td>
              <td>{{ $production->group }}</td>
              <td>{{ $production->user->KASHIF }}</td>
              <td>{{ $production->user->SPV }}</td>
              <td>{{ $production->position }}</td>
              <td>{{ $production->user->name }}</td>
              <td>{{ $production->production_result }}</td>
              <td>{{ $production->user_note }}</td>
              <td>
                @if ($production->status == 1)
                <span class="badge badge-success">Terverifikasi</span>
                @elseif ($production->status == 0)
                <span class="badge badge-warning">Menunggu verifikasi</span>
                @else
                <span class="badge badge-danger">Ditolak</span>
                <div class="alert alert-danger p-1 mt-1" role="alert" style="font-size: 12px">
                  <b>Catatan : </b><br>{{ $production->note }}
                </div>
                @endif
              </td>
              <td>
                <button type="button" class="btn btn-primary btn-sm ml-auto" onclick="edit({{ $production->id }})" data-toggle="modal" data-target="#edit">Edit</button>
              </td>
              <td>{{ date_format($sdate,"Y/m/d H:i:s") }}</td>
              <td>{{$production->shift_admin}}</td>
              <td>{{$production->shift_note}}</td>
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
      <p>Pastikan semua data yang telah diinput oleh operator telah diverifikasi dengan teliti sebelum mengakhiri shift. Verifikasi ini penting untuk memastikan bahwa semua informasi yang dimasukkan akurat dan lengkap, sehingga mendukung kelancaran operasi dan menghindari potensi kesalahan.</p>
      <p class="mb-0">Ensure that all data that has been inputted by the operator has been carefully verified before ending the shift. This verification is important to ensure that all information entered is accurate and complete, thus supporting smooth operations and avoiding potential errors.</p>
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
            <label for="est">Status</label>
            <select class="form-control" id="est" name="status" required>
            <option value="0">Menunggu Verifikasi</option>
            <option value="1">Terverifikasi</option>
            <option value="2">Ditolak</option>
            </select>
          </div>
          <div class="form-group">
            <label for="note">Catatan</label>
            <input type="text" class="form-control" id="ent" name="note">
          </div>
          <hr>
          <p class="text-primary font-weight-bold">Catatan shift :</p>
          <div class="form-group row">
            <div class="col-4">
              <label for="">Tanggal</label>
              <input type="datetime-local" id="esd" class="form-control" name="shift_date" required>
            </div>
            <div class="col-4">
              <label for="">Shift admin</label>
              <select class="form-control" id="esa" name="shift_admin" required>
                <option value="1">1 (00.00-08.00)</option>
                <option value="2">2 (08.00-16.00)</option>
                <option value="3">3 (16.00-24.00)</option>
              </select>
            </div>
            <div class="col-4">
              <label for="">Catatan</label>
              <input type="text" class="form-control" id="esn" name="shift_note">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" name="submit" value="verify" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  $(document).ready(function () {
    $('#myTable2').DataTable({
      "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All Pages"]],
      "pageLength": 25,
      "language": {
        "paginate": {
          "previous": "<",
          "next": ">"
        }
      },
      "dom": 'Blfrtip',
      "buttons": ['copy', 'csv', 'excel', 'pdf', 'print']
    });
  });
</script>
<script>
    function edit(id){
      $.ajax({
        url: "/api/production/"+id,
        type: 'GET',
        dataType: 'json', // added data type
        success: function(response) {
          var mydata = response.data;
          $("#eid").val(id);
          $("#est").val(mydata.status);
          $("#ent").val(mydata.note);
          $("#esd").val(mydata.shift_date);
          $("#esa").val(mydata.shift_admin);
          $("#esn").val(mydata.shift_note);
          //$("#et").text("Edit Logbook "+mydata.name);
        }
      });
    }
</script>
@endsection