<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

  <!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
      <i class="fa fa-bars"></i>
  </button>


  <a class="sidebar-brand d-flex align-items-center justify-content-center">
    <div class="sidebar-brand-icon">
        <img id="logo" src="/img/img1.png" width="150">
    </div>
</a>



  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">

    <!-- Nav Item - Time, Date, and Day Information -->
    <li class="nav-item no-arrow row">
        <span class="my-auto mr-3 d-none d-lg-inline text-gray-600 small" style="margin-top: 30px; display: inline-block;">
            <span id="currentTime"></span> | <span id="currentDate"></span>
        </span>
    </li>

      <div class="topbar-divider d-none d-sm-block"></div>

      <script>
        function updateTime() {
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const now = new Date();
            const day = days[now.getDay()];
            const date = now.getDate().toString().padStart(2, '0');
            const month = (now.getMonth() + 1).toString().padStart(2, '0'); // bulan dimulai dari 0
            const year = now.getFullYear();
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');
            
            document.getElementById('currentTime').innerHTML = `${hours}:${minutes}:${seconds}`;
            document.getElementById('currentDate').innerHTML = `${day}, ${date}-${month}-${year}`;
        }
    
        // Panggil updateTime setiap detik
        setInterval(updateTime, 1000);
    
        // Panggilan awal
        updateTime();
    </script>




      <!-- Nav Item - User Information -->
      <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{$profil->name}}</span>
              <img class="img-profile rounded-circle"
                  src="/img/undraw_profile.svg">
          </a>
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
              aria-labelledby="userDropdown">
              <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profil
              </a>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="/admin/logout">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Keluar
              </a>
          </div>
          
      </li>

  </ul>

</nav>
<!-- End of Topbar -->