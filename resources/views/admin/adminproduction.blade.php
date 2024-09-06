@extends('layouts.admin')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Halo {{$profil->name}}, {{ $profil->position }}!</h1>
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
        <button class="btn btn-danger px-2 ml-2" onclick="dataexport('pdf')">PDF</button>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="myTable2" width="100%" cellspacing="0">
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
            @php
             $pdate = date_create($production->production_date);   
            @endphp
            <tr>
              <td>{{ $production->user->name }}</td>
              <td>{{ $production->position }}</td>
              <td>{{ $production->group }}</td>
              <td>{{ date_format($pdate,"Y/m/d") }}</td>
              <td>{{ $production->production_result }}</td>
              <td>{{ $production->shift }}</td>
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
          //$("#et").text("Edit Logbook "+mydata.name);
        }
      });
    }
</script>
@endsection