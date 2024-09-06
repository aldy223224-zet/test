<!DOCTYPE html>
<html lang="en">

<head>
  @include('partials.dashboard-head')
</head>

<body id="page-top">

  <script>
    @if(session()->has('success'))
      Swal.fire({title:'Berhasil', text:'{{session('success')}}', icon:'success'})
    @endif
    @if(session()->has('error'))
      Swal.fire({title:'Error!', text:'{{session('error')}}', icon:'error'})
    @endif
    @if(session()->has('info'))
      Swal.fire({title:'Info', text:'{{session('info')}}', icon:'info'})
    @endif
    @if($errors->any())
      Swal.fire({title:'Error!', html:'{!! implode('', $errors->all(':message<br>')) !!}', icon:'error'})
    @endif
  </script>
  
  <!-- Page Wrapper -->
  <div id="wrapper">
    
    @include('partials.admin-sidebar')
    
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        
      <!-- Main Content -->
      <div id="content">
        @include('partials.admin-topbar')
        @yield('content')
      </div>
        
      <!-- End of Main Content -->
      @include('partials.admin-footer')

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ingin Mengakhiri Sesi?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih "Keluar" jika ingin mengakhiri sesi.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="/logout">Keluar</a>
            </div>
        </div>
    </div>
  </div>

  @include('partials.dashboard-script')

</body>

</html>