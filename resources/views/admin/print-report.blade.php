<!DOCTYPE html>
<html>
  <head>
    @include('partials.dashboard-head')
  </head>
  <body class="">
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-8 text-center">
          <h2 class="mb-4">Laporan</h2>
          <div class="mb-3">
            <strong>Nama:</strong> {{$profil->name}}
          </div>
          <div class="mb-3">
            <strong>Tanggal:</strong> <span id="tanggal"></span>
          </div>
          <table class="table table-bordered mt-4">
            <thead class="table-dark">
              <tr>
                <th>Tanggal Produksi</th>
                <th>Shift</th>
                <th>Grup</th>
                <th>SPV</th>
                <th>KASHIF</th>
                <th>Posisi</th>
                <th>Nama</th>
                <th>Hasil Produksi</th>
                <th>Catatan operator</th>
                <th>Status Verifikasi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($productions as $p)
              @php
              $pdate = date_create($p->production_date);
              @endphp
              <tr>
                <td>{{ date_format($pdate,"Y/m/d") }}</td>
                <td>{{ $p->shift }}</td>
                <td>{{ $p->group }}</td>
                <td>{{ $p->user->SPV }}</td>
                <td>{{ $p->user->KASHIF }}</td>
                <td>{{ $p->position }}</td>
                <td>{{ $p->user->name }}</td>
                <td>{{ $p->production_result }}</td>
                <td>{{ $p->noteuser }}</td>
                <td style="text-align: center; vertical-align: middle;">
                      @if ($p->status == 1)
                        <span>Terverifikasi</span>
                      @elseif ($p->status == 0)
                        <span>Menunggu verifikasi</span>
                      @else
                        <span>Ditolak</span>
                        <div class="alert alert-danger p-1 mt-1" role="alert" style="font-size: 12px">
                        </div>
                      @endif
              </tr>
                      @endforeach
            </tbody>
          </table>
          <button class="btn btn-primary no-print" onclick="window.print()">Print</button>
        </div>
      </div>
    </div>
    <script>
      // Menampilkan tanggal hari ini
      const today = new Date();
      const formattedDate = today.toLocaleDateString('id-ID', {
          day: '2-digit',
          month: '2-digit',
          year: 'numeric'
      });
      document.getElementById('tanggal').textContent = formattedDate;
    </script>
    <!-- Argon Scripts -->
    @include('partials.dashboard-script')
    @yield('script')
  </body>
</html>