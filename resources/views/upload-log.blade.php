<!--
=========================================================
* Material Dashboard 2 - v3.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2023 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
  <title>
    Material Dashboard 2 by Creative Tim
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('css/material-dashboard.css?v=3.1.0') }}" rel="stylesheet"/>
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
</head>

<body class="g-sidenav-show  bg-gray-200">
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Apache Log Table</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
    
                <!-- Form untuk Upload Log, Filter Tanggal, Hapus Log, dan Unduh XML -->
                <div class="p-3">
                  <form action="/upload-log" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label for="log_file">File Log (.txt):</label>
                      <input type="file" class="form-control" name="log_file" id="log_file" required>
                    </div>
    
                    <div class="mb-3">
                      <label for="start_date">Tanggal Mulai:</label>
                      <input type="date" name="start_date" id="start_date" required>
                    </div>
    
                    <div class="mb-3">
                      <label for="end_date">Tanggal Akhir:</label>
                      <input type="date" name="end_date" id="end_date" required>
                    </div>
    
                    <button type="submit" class="btn btn-primary">Unggah dan Simpan Log</button>
                  </form>
                </div>
    
                <div class="p-3">
                  <h2>Daftar Log Apache</h2>
                  <form action="/clear-logs" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Hapus Semua Log</button>
                  </form>
    
                  <form action="/export-logs" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-success">Unduh Log sebagai XML</button>
                  </form>
                </div>
    
                <!-- Tabel Log -->
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">IP Address</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal & Waktu</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">HTTP Method</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Request URL</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">HTTP Protocol</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Code</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Response Size</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User Agent</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    @forelse($logs as $log)
                      <tr>
                          <td class="align-middle text-center">
                            <p class="text-xs text-secondary mb-0">{{ $log->id }}</p>
                          </td>
                          <td class="align-middle text-center">
                            <p class="text-xs text-secondary mb-0">{{ $log->ip_address }}</p>
                          </td>
                          <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold">{{ $log->date }}</span>
                              <p class="text-xs text-secondary mb-0">{{ $log->time }}</p>
                          </td>
                          <td class="align-middle">
                              <p class="text-xs font-weight-bold mb-0">{{ $log->http_method }}</p>
                          </td>
                          <td class="align-middle">
                            <p class="text-xs text-secondary mb-0">{{ $log->request_url }}</p>
                          </td>
                          <td class="align-middle text-center text-sm">
                              <p class="text-xs text-secondary mb-0">{{ $log->http_protocol }}</p>
                          </td>
                          <td class="align-middle text-center">
                              <span class="badge badge-sm bg-gradient-success">{{ $log->status_code }}</span>
                          </td>
                          <td class="align-middle">
                              <p class="text-xs text-secondary mb-0">{{ $log->response_size }}</p>
                          </td>
                          <td class="align-middle">
                              <p class="text-xs text-secondary mb-0">{{ $log->user_agent }}</p>
                          </td>
                      </tr>
                    @empty
                      <tr>
                          <td colspan="9">Tidak ada log yang tersedia.</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
    
                <div class="d-flex justify-content-center mt-3">
                  {{ $logs->links() }}
                </div>
    
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="material-icons py-2">settings</i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Material UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="material-icons">clear</i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3 d-flex">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-3">
        <div class="mt-2 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <a class="btn bg-gradient-info w-100" href="https://www.creative-tim.com/product/material-dashboard-pro">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/material-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Material%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/material-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>