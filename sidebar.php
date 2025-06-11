<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <a href="./index.php" class="brand-link">
      <img src="dist/assets/img/image.png" alt="SMK Logo" class="brand-image"/>
      <span class="brand-text fw-light">SMK Suka Surakarta</span>
    </a>
  </div>
  <!--end::Sidebar Brand-->

  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
        
        <!-- Dashboard -->
        <li class="nav-item">
          <a href="index.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'index.php' ? 'active' : '' ?>">
            <i class="nav-icon bi bi-house-door"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <!-- Data -->
        <li class="nav-item <?= in_array(basename($_SERVER['PHP_SELF']), ['datasiswa.php','datajurusan.php','dataagama.php', 'dataguru.php']) ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-database-fill"></i>
            <p>
              Data
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="datasiswa.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'datasiswa.php' ? 'active' : '' ?>">
                <i class="nav-icon bi bi-people-fill"></i>
                <p>Siswa</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="datajurusan.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'datajurusan.php' ? 'active' : '' ?>">
                <i class="nav-icon bi bi-book-fill"></i>
                <p>Jurusan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="dataagama.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'dataagama.php' ? 'active' : '' ?>">
                <i class="nav-icon bi bi-star-fill"></i>
                <p>Agama</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="dataguru.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'dataguru.php' ? 'active' : '' ?>">
                <i class="nav-icon bi bi-person-lines-fill"></i>
                <p>Guru</p>
              </a>
            </li>
          </ul>
        </li>
        
        <li class="nav-item <?= in_array(basename($_SERVER['PHP_SELF']), ['tambahsiswa.php','tambahjurusan.php','tatambahgama.php', 'tambahguru.php']) ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-plus-square-fill"></i>
            <p>
              Tambah
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="tambahsiswa.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'tambahsiswa.php' ? 'active' : '' ?>">
                <i class="nav-icon bi bi-people-fill"></i>
                <p>Tambah Siswa</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="tambahjurusan.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'tambahjurusan.php' ? 'active' : '' ?>">
                <i class="nav-icon bi bi-book-fill"></i>
                <p>Tambah Jurusan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="tambahagama.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'tambahagama.php' ? 'active' : '' ?>">
                <i class="nav-icon bi bi-star-fill"></i>
                <p>Tambah Agama</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="tambahguru.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'tambahguru.php' ? 'active' : '' ?>">
                <i class="nav-icon bi bi-person-lines-fill"></i>
                <p>Tambah Guru</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
  <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->