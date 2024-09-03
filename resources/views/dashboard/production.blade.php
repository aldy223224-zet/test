@extends('layouts.dashboard')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Tabel Produksi</h1>
  <p class="mb-4"> 
      Pastikan semua data yang telah diinput oleh operator telah diverifikasi dengan teliti sebelum mengakhiri shift. Verifikasi ini penting untuk memastikan bahwa semua informasi yang dimasukkan akurat dan lengkap, sehingga mendukung kelancaran operasi dan menghindari potensi kesalahan. <a target="_blank"
          href="https://datatables.net">official DataTables documentation</a>.</p>
  <p class="mb-6"> 
      Ensure that all data that has been inputted by the operator has been carefully verified before ending the shift. This verification is important to ensure that all information entered is accurate and complete, thus supporting smooth operations and avoiding potential errors. <a target="_blank"
      href="https://datatables.net">official DataTables documentation</a>.</p>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
        <div class="row m-0">
          <h6 class="m-0 font-weight-bold text-primary">Tabel Produksi</h6>
          <button class="btn btn-primary btn-sm ml-auto" data-toggle="modal" data-target="#tambah">Tambah</button>
        </div>
      </div>
      <div class="card-body">
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
              </tr>
            </thead>
            <tbody>
              @foreach ($productions as $p)
              @php
                $pdate = date_create($p->production_date);
              @endphp
              <tr>
                <td>{{$profil->name}}</td>
                <td>{{$profil->position}}</td>
                <td>{{$profil->group}}</td>
                <td>{{$p->shift}}</td>
                <td>{{ date_format($pdate,"Y/m/d") }}</td>
                <td>{{$p->production_result}}</td>
                <td style="text-align: center; vertical-align: middle;">
                  @if ($p->status==1)
                    <span class="badge bg-success">Terverifikasi</span>
                  @elseif ($p->status==0)
                    <span class="badge bg-warning">Menunggu verifikasi</span>
                  @else
                    <span class="badge bg-danger">Ditolak</span>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
  </div>

</div>
<!-- /.container-fluid -->


<!-- Modal -->
<div class="modal fade" id="tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Hasil Produksi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post">
        @csrf
        <div class="modal-body">
          <div class="form-group row">
            <div class="col-12 col-md-4">
              <label>Tanggal produksi</label>
              <input type="datetime-local" class="form-control" id="production_date" name="production_date" required>
            </div>
            <div class="col-6 col-md-4">
              <label>Pilih shift</label>
              <select class="form-control" id="shift" name="shift" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
              </select>
            </div>
            <div class="col-6 col-md-4">
              <label>Hasil produksi</label>
              <input type="number" class="form-control" id="production_result" name="production_result" required>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-end">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" name="submit" value="store">Submit</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- Include FullCalendar and Bootstrap JS/CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            selectable: true,
            headerToolbar: false,
            dateClick: function(info) {
                // Set the selected date to the hidden input field
                document.getElementById('selectedDate').value = info.dateStr;
                document.getElementById('selectedDateText').innerHTML = "Tanggal yang dipilih: <span class='font-weight-bold'>" + info.dateStr + "</span>";

                // Hide the dropdown after selecting a date
                $('.dropdown-menu').removeClass('show');
            }
        });
        calendar.render();

        // Ensure the dropdown toggle works correctly
        $('#calendarDropdownButton').on('click', function() {
            $('.dropdown-menu').toggleClass('show');
        });

        // Close the dropdown if clicked outside
        $(document).on('click', function(event) {
            if (!$(event.target).closest('#calendarDropdownButton').length) {
                $('.dropdown-menu').removeClass('show');
            }
        });
    });

    // Function to update verification status (as provided earlier)
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

    // Call the function to update verification status on page load
    updateVerificationStatus();
</script>

@endsection
