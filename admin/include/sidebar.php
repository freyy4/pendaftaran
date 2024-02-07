  <?php
  session_start();
  if (empty($_SESSION['login'])) {
    header("Location:../../index.php");
  }
  $user = $_SESSION['email'];
  ?>

  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    </div>
    <ul class="nav">
      <li class="nav-item profile">
        <div class="profile-desc">
          <div class="profile-pic">
            <div class="count-indicator">
              <img class="img-xs rounded-circle " src="assets/images/faces/face0.png" alt="">
              <span class="count bg-success"></span>
            </div>
            <div class="profile-name">
              <h5 class="mb-0 font-weight-normal"><?php echo $user; ?></h5>
              <span>Admin</span>
            </div>
          </div>
        </div>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="dash.php">
          <span class="menu-icon">
            <i class="mdi mdi-speedometer"></i>
          </span>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-icon">
            <i class="mdi mdi-laptop"></i>
          </span>
          <span class="menu-title">PMI dan Agency</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="admin.php">Pekerja Migran Indonesia</a></li>
            <li class="nav-item"> <a class="nav-link" href="daftar_admin2.php">Data Admin</a></li>
            <li class="nav-item"> <a class="nav-link" href="daftar_admin.php">Agency</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" data-bs-toggle="collapse" href="#aduan" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-icon">
            <i class="mdi mdi-wallet"></i>
          </span>
          <span class="menu-title">Pengaduan</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="aduan">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="aduan/index.php">Tambah Pengaduan</a></li>
            <li class="nav-item"> <a class="nav-link" href="daftar_pengaduan.php">Data Pengaduan</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="https://chat.crystalbirumeuligo.com/login">
          <span class="menu-icon">
            <i class="mdi mdi-speedometer"></i>
          </span>
          <span class="menu-title">Chat</span>
        </a>
      </li>
    </ul>
  </nav>