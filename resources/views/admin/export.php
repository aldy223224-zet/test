<?php
require '2024_09_03_125718_create_productions_table.php'



?>
<html>
<head>
  <title>Stock Barang</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
<div class="container">
			<h2>Stock Bahan</h2>
			<h4>(Inventory)</h4>
				<div class="data-tables datatable-dark">
					
        <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
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
        @foreach($productions as $production)
        <tr>
            <td>{{ \Carbon\Carbon::parse($production->production_date)->format('d/m/Y') }}</td>
            <td>{{ $production->shift }}</td>
            <td>{{ $production->user->group }}</td>
            <td>{{ $production->user->SPV}}</td>
            <td>{{ $production->user->KASHIF }}</td>
            <td>{{ $production->user->position }}</td>
            <td>{{ $production->user->name }}</td>
            <td>{{ $production->production_result }}</td>
            <td>{{ $production->usernote }}</td>
            <td style="text-align: center; vertical-align: middle;">
                  @if ($p->status == 1)
                    <span>Terverifikasi</span>
                  @elseif ($p->status == 0)
                    <span>Menunggu verifikasi</span>
                  @else
                    <span>Ditolak</span>
                    <div class="alert alert-danger p-1 mt-1" role="alert" style="font-size: 12px">
                    </div>
            <td>{{ $production->user->name }}</td>
            <td>{{ $production->user->position }}</td>
            <td>{{ $production->user->group }}</td>
            <td>{{ \Carbon\Carbon::parse($production->production_date)->format('d/m/Y') }}</td>
            <td>{{ $production->production_result }}</td>
            <td>{{ $production->shift }}</td>
            @endforeach
    </tbody>
</table>
					
				</div>
</div>
	
<script>
$(document).ready(function() {
    $('#dataTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy','csv','excel', 'pdf', 'print'
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

	

</body>

</html>