<?php
include 'koneksi.php';
$db = new database();

$pesan = '';
$tipe_pesan = '';
$showModal = false;

// Proses tambah guru
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nip = trim($_POST['nip']);
    $nama = trim($_POST['nama']);
    $jeniskelamin = trim($_POST['jeniskelamin']);
    $alamat = trim($_POST['alamat']);
    $kodeagama = trim($_POST['agama']);
    $kodegolongan = trim($_POST['golongan']);
    $nohp = trim($_POST['nohp']);

    if ($nip && $nama && $jeniskelamin && $alamat && $kodeagama && $kodegolongan && $nohp) {
        $berhasil = $db->tambah_guru($nip, $nama, $jeniskelamin, $alamat, $kodegolongan, $kodeagama, $nohp);
        if ($berhasil) {
            $pesan = "Guru <strong>$nama</strong> berhasil ditambahkan!";
            $tipe_pesan = 'success';
        } else {
            $pesan = "Gagal menambahkan guru! Mungkin NIP, Nama, atau No HP sudah terdaftar.";
            $tipe_pesan = 'danger';
        }
        $showModal = true;
    }
}
?>
<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SMK S Ska | Tambah Guru</title>
    <link rel="icon" type="image/png" href="dist/assets/img/image.png" />
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="AdminLTE 4 | General Form Elements" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"
    />
    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="dist/css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Home</a></li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Contact</a></li>
          </ul>
          <!--end::Start Navbar Links-->
          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::Navbar Search-->
            <li class="nav-item">
              <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="bi bi-search"></i>
              </a>
            </li>
            <!--end::Navbar Search-->
            <!--begin::Messages Dropdown Menu-->
            <li class="nav-item dropdown">
              <a class="nav-link" data-bs-toggle="dropdown" href="#">
                <i class="bi bi-chat-text"></i>
                <span class="navbar-badge badge text-bg-danger">3</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <a href="#" class="dropdown-item">
                  <!--begin::Message-->
                  <div class="d-flex">
                    <div class="flex-shrink-0">
                      <img
                        src="dist/assets/img/user1-128x128.jpg"
                        alt="User Avatar"
                        class="img-size-50 rounded-circle me-3"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <h3 class="dropdown-item-title">
                        Brad Diesel
                        <span class="float-end fs-7 text-danger"
                          ><i class="bi bi-star-fill"></i
                        ></span>
                      </h3>
                      <p class="fs-7">Call me whenever you can...</p>
                      <p class="fs-7 text-secondary">
                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                      </p>
                    </div>
                  </div>
                  <!--end::Message-->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <!--begin::Message-->
                  <div class="d-flex">
                    <div class="flex-shrink-0">
                      <img
                        src="dist/assets/img/user8-128x128.jpg"
                        alt="User Avatar"
                        class="img-size-50 rounded-circle me-3"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <h3 class="dropdown-item-title">
                        John Pierce
                        <span class="float-end fs-7 text-secondary">
                          <i class="bi bi-star-fill"></i>
                        </span>
                      </h3>
                      <p class="fs-7">I got your message bro</p>
                      <p class="fs-7 text-secondary">
                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                      </p>
                    </div>
                  </div>
                  <!--end::Message-->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <!--begin::Message-->
                  <div class="d-flex">
                    <div class="flex-shrink-0">
                      <img
                        src="dist/assets/img/user3-128x128.jpg"
                        alt="User Avatar"
                        class="img-size-50 rounded-circle me-3"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <h3 class="dropdown-item-title">
                        Nora Silvester
                        <span class="float-end fs-7 text-warning">
                          <i class="bi bi-star-fill"></i>
                        </span>
                      </h3>
                      <p class="fs-7">The subject goes here</p>
                      <p class="fs-7 text-secondary">
                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                      </p>
                    </div>
                  </div>
                  <!--end::Message-->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
              </div>
            </li>
            <!--end::Messages Dropdown Menu-->
            <!--begin::Notifications Dropdown Menu-->
            <li class="nav-item dropdown">
              <a class="nav-link" data-bs-toggle="dropdown" href="#">
                <i class="bi bi-bell-fill"></i>
                <span class="navbar-badge badge text-bg-warning">15</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-envelope me-2"></i> 4 new messages
                  <span class="float-end text-secondary fs-7">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-people-fill me-2"></i> 8 friend requests
                  <span class="float-end text-secondary fs-7">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                  <span class="float-end text-secondary fs-7">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer"> See All Notifications </a>
              </div>
            </li>
            <!--end::Notifications Dropdown Menu-->
            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
              <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
              </a>
            </li>
            <!--end::Fullscreen Toggle-->
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img
                  src="dist/assets/img/user2-160x160.jpg"
                  class="user-image rounded-circle shadow"
                  alt="User Image"
                />
                <span class="d-none d-md-inline">Alexander Pierce</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::User Image-->
                <li class="user-header text-bg-primary">
                  <img
                    src="dist/assets/img/user2-160x160.jpg"
                    class="rounded-circle shadow"
                    alt="User Image"
                  />
                  <p>
                    Alexander Pierce - Web Developer
                    <small>Member since Nov. 2023</small>
                  </p>
                </li>
                <!--end::User Image-->
                <!--begin::Menu Body-->
                <li class="user-body">
                  <!--begin::Row-->
                  <div class="row">
                    <div class="col-4 text-center"><a href="#">Followers</a></div>
                    <div class="col-4 text-center"><a href="#">Sales</a></div>
                    <div class="col-4 text-center"><a href="#">Friends</a></div>
                  </div>
                  <!--end::Row-->
                </li>
                <!--end::Menu Body-->
                <!--begin::Menu Footer-->
                <li class="user-footer">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                  <a href="#" class="btn btn-default btn-flat float-end">Sign out</a>
                </li>
                <!--end::Menu Footer-->
              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->
      <?php include "Sidebar.php"; ?>
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Tambah Guru</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">General Form</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row g-4">
              <!--begin::Col-->
              <div class="col-md-12">
                <!--begin::Form Validation-->
                <div class="card card-info card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header"><div class="card-title">Form Tambah Guru</div></div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form class="needs-validation" id="formGuru" method="post" novalidate>
                    <div class="card-body">
                      <div class="row g-3">
                        <!-- Nama Lengkap -->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Nama Lengkap</label>
                          <input type="text" class="form-control" name="nama" id="validationCustom01" maxlength="60" required />
                          <div class="invalid-feedback">Nama guru harus diisi!</div>
                        </div>
                        
                        <!-- Agama -->
                        <div class="col-md-6">
                          <label for="validationCustom04" class="form-label">Agama</label>
                          <select class="form-select" id="validationCustom04" name="agama" required>
                            <option value="" selected disabled>Pilih agama...</option>
                            <?php
                            $result = $db->koneksi->query("SELECT * FROM agama");
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='".$row['kodeagama']."'>".$row['agama']."</option>";
                            }
                            ?>
                          </select>
                          <div class="invalid-feedback">Agama harus dipilih!</div>
                        </div>

                        <!-- NIP -->
                        <div class="col-md-6">
                          <label for="validationCustom02" class="form-label">NIP</label>
                          <input type="text" class="form-control" name="nip" id="validationCustom02" maxlength="18" pattern="[0-9]*" required />
                          <div class="invalid-feedback">NIP harus diisi dengan 18 digit angka!</div>
                        </div>

                        <!-- Golongan -->
                        <div class="col-md-6">
                          <label for="validationCustom05" class="form-label">Golongan</label>
                          <select class="form-select" id="validationCustom05" name="golongan" required>
                            <option value="" selected disabled>Pilih golongan...</option>
                            <?php
                            $result = $db->koneksi->query("SELECT * FROM golonganguru");
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='".$row['kodegolongan']."'>".$row['golongan']."</option>";
                            }
                            ?>
                          </select>
                          <div class="invalid-feedback">Golongan harus dipilih!</div>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="col-md-6">
                          <label for="validationCustom03" class="form-label">Jenis Kelamin</label>
                          <select class="form-select" id="validationCustom03" name="jeniskelamin" required>
                            <option value="" selected disabled>Pilih jenis kelamin...</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                          </select>
                          <div class="invalid-feedback">Jenis kelamin harus dipilih!</div>
                        </div>

                        <!-- Nomor HP -->
                        <div class="col-md-6">
                          <label for="validationCustom06" class="form-label">Nomor HP</label>
                          <input type="tel" class="form-control" id="validationCustom06" pattern="[0-9]{10,13}" required name="nohp" placeholder="081234567890" maxlength="13"/>
                          <div class="invalid-feedback">Nomor HP harus 10-13 digit angka!</div>
                        </div>

                        <!-- Alamat -->
                        <div class="col-md-12">
                          <label for="validationCustom08" class="form-label">Alamat</label>
                          <textarea class="form-control" id="validationCustom08" name="alamat" required ></textarea>
                          <div class="invalid-feedback">Alamat harus diisi!</div>
                        </div>
                      </div>
                    </div>

                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" name="simpan" id="btnSimpan">Simpan</button>
                        <a href="dataguru.php">
                        <button class="btn btn-secondary" type="button">Cencel</button>
                      </a>
                    </div>
                  </form>
                  <!--end::Form-->
                    <!-- Modal Konfirmasi -->
                    <div class="modal fade" id="modalKonfirmasi" tabindex="-1">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content bg-white">
                          <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">Konfirmasi</h5>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <div class="modal-body" id="isiKonfirmasi">
                            <!-- diisi JS -->
                          </div>
                          <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-success" id="btnYaTambah">Ya, Tambahkan</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--end::Modal Konfirmasi-->   
                    <!--begin::JavaScript-->
                    <script>
                      // Example starter JavaScript for disabling form submissions if there are invalid fields
                      (() => {
                        'use strict';

                        // Fetch all the forms we want to apply custom Bootstrap validation styles to
                        const forms = document.querySelectorAll('.needs-validation');

                        // Loop over them and prevent submission
                        Array.from(forms).forEach((form) => {
                          form.addEventListener(
                            'submit',
                            (event) => {
                              if (!form.checkValidity()) {
                                event.preventDefault();
                                event.stopPropagation();
                              }

                              form.classList.add('was-validated');
                            },
                            false,
                          );
                        });
                      })();
                    </script>
                    <!--end::JavaScript-->
                </div>
                <!--end::Form Validation -->
              </div>
              <!--end::Col-->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
      <!--begin::Footer-->
      <footer class="app-footer">
        <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline">Anything you want</div>
        <!--end::To the end-->
        <!--begin::Copyright-->
        <strong>
          Copyright &copy; 2014-2024&nbsp;
          <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
        </strong>
        All rights reserved.
        <!--end::Copyright-->
      </footer>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="dist/js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <?php if ($showModal): ?>
    <div class="modal fade show" style="display:block;" id="modalPesan" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-<?= $tipe_pesan ?>">
          <div class="modal-header bg-<?= $tipe_pesan ?>">
            <h5 class="modal-title text-white">
              <?= $tipe_pesan === 'success' ? 'Berhasil!' : 'Gagal!' ?>
            </h5>
            <button type="button" class="btn-close" onclick="location.href='tambahguru.php'"></button>
          </div>
          <div class="modal-body">
            <p><?= $pesan ?></p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-outline-<?= $tipe_pesan ?>" onclick="location.href='<?= $tipe_pesan === 'success' ? 'dataguru.php' : 'tambahguru.php' ?>'">Tutup</button>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>

    <!-- JavaScript -->
    <script>
      // Form validation
      (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach((form) => {
          form.addEventListener('submit', (event) => {
            if (!form.checkValidity()) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      })();

      // Confirmation modal
      document.getElementById('btnSimpan').addEventListener('click', function() {
        const form = document.getElementById('formGuru');
        if (!form.checkValidity()) {
          form.classList.add('was-validated');
          return;
        }

        const data = {
          nama: document.querySelector('[name="nama"]').value,
          nip: document.querySelector('[name="nip"]').value,
          jeniskelamin: document.querySelector('[name="jeniskelamin"] option:checked')?.text,
          agama: document.querySelector('[name="agama"] option:checked')?.text,
          golongan: document.querySelector('[name="golongan"] option:checked')?.text,
          nohp: document.querySelector('[name="nohp"]').value,
          alamat: document.querySelector('[name="alamat"]').value
        };

        document.getElementById('isiKonfirmasi').innerHTML = `
          Yakin ingin menambahkan Guru:
          <br><strong>Nama:</strong> ${data.nama}
          <br><strong>NIP:</strong> ${data.nip}
          <br><strong>Jenis Kelamin:</strong> ${data.jeniskelamin}
          <br><strong>Agama:</strong> ${data.agama}
          <br><strong>Golongan:</strong> ${data.golongan}
          <br><strong>No HP:</strong> ${data.nohp}
          <br><strong>Alamat:</strong> ${data.alamat}
        `;

        new bootstrap.Modal(document.getElementById('modalKonfirmasi')).show();
      });

      document.getElementById('btnYaTambah').addEventListener('click', function() {
        document.getElementById('formGuru').submit();
      });

    </script>
    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>
