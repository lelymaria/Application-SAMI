  <!--**********************************
            Header start
        ***********************************-->
  <div class="header">
      <div class="header-content">
          <nav class="navbar navbar-expand">
              <div class="collapse navbar-collapse justify-content-between">
                  <div class="header-left">
                      <div class="dashboard_bar">
                            Dashboard
                      </div>
                  </div>
              </div>
          </nav>
      </div>
  </div>
  <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

  <!--**********************************
            Sidebar start
        ***********************************-->
  <div class="dlabnav">
      <div class="dlabnav-scroll">
          <ul class="metismenu" id="menu">
              <li class="dropdown header-profile">
                  <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                      <img src="images/profile/pic1.jpg" width="20" alt="">
                      <div class="header-info ms-3">
                          <span class="font-w600 ">Hi,<b>William</b></span>
                          <small class="text-end font-w400">william@gmail.com</small>
                      </div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end">
                      <a href="app-profile.html" class="dropdown-item ai-icon">
                          <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary"
                              width="18" height="18" viewbox="0 0 24 24" fill="none"
                              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                              <circle cx="12" cy="7" r="4"></circle>
                          </svg>
                          <span class="ms-2">Profile </span>
                      </a>
                      <a href="{{ url('logout') }}" class="dropdown-item ai-icon">
                          <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger"
                              width="18" height="18" viewbox="0 0 24 24" fill="none"
                              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                              <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                              <polyline points="16 17 21 12 16 7"></polyline>
                              <line x1="21" y1="12" x2="9" y2="12"></line>
                          </svg>
                          <span class="ms-2">Logout</span>
                      </a>
                  </div>
              </li>
              @can('operator')
                  <li><a href="/dashboard" class="ai-icon" aria-expanded="false">
                          <i class="flaticon-025-dashboard"></i>
                          <span class="nav-text">Dashboard</span>
                      </a>
                  </li>
                  <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                          <i class="flaticon-045-heart"></i>
                          <span class="nav-text">Manage User</span>
                      </a>
                      <ul aria-expanded="false">
                          <li><a href="/akunkepalap4mp">Kepala P4MP</a></li>
                          <li><a href="/akunjurusan">Jurusan</a></li>
                          <li><a href="/akunauditor">Auditor</a></li>
                          <li><a href="/akunauditee">Auditee</a></li>
                      </ul>
                  </li>
                  <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                          <i class="flaticon-072-printer"></i>
                          <span class="nav-text">Audit Mutu Internal</span>
                      </a>
                      <ul aria-expanded="false">
                          <li><a href="/pedomanami">Pedoman AMI</a></li>
                          <li><a href="/standar">Standar</a></li>
                          <li><a href="/jadwalami">Jadwal AMI</a></li>
                          <li><a href="/pertanyaanstandar">Pertanyaan Standar</a></li>
                          <li><a href="/historiami">History AMI</a></li>
                      </ul>
                  </li>
                  <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                          <i class="flaticon-041-graph"></i>
                          <span class="nav-text">Dokumentasi</span>
                      </a>
                      <ul aria-expanded="false">
                          <li><a href="/dokumentasiAmi">AMI</a></li>
                          <li><a href="/dokumentasiRtm">RTM</a></li>
                      </ul>
                  </li>
                  <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                          <i class="flaticon-050-info"></i>
                          <span class="nav-text">Account</span>
                      </a>
                      <ul aria-expanded="false">
                          <li><a href="/profile">Profile</a></li>
                          <li><a href="/editPassword">Edit Password</a></li>
                      </ul>
                  </li>
              @endcan

              @can('ketuaP4mp')
                  <li><a href="/dash" class="ai-icon" aria-expanded="false">
                          <i class="flaticon-025-dashboard"></i>
                          <span class="nav-text">Dashboard</span>
                      </a>
                  </li>
                  <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                          <i class="flaticon-072-printer"></i>
                          <span class="nav-text">Audit Mutu Internal</span>
                      </a>
                      <ul aria-expanded="false">
                          <li><a href="form-pickers.html">Pedoman AMI</a></li>
                          <li><a href="form-element.html">Monitoring AMI</a></li>
                          <li><a href="form-wizard.html">Verifikasi Tindakan Koreksi</a></li>
                          <li><a href="form-ckeditor.html">Laporan Hasil AMI</a></li>
                          <li><a href="form-validation.html">History AMI</a></li>
                      </ul>
                  </li>
                  <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                          <i class="flaticon-041-graph"></i>
                          <span class="nav-text">Dokumentasi</span>
                      </a>
                      <ul aria-expanded="false">
                          <li><a href="chart-flot.html">AMI</a></li>
                          <li><a href="chart-morris.html">RTM</a></li>
                      </ul>
                  </li>
                  <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                          <i class="flaticon-050-info"></i>
                          <span class="nav-text">Account</span>
                      </a>
                      <ul aria-expanded="false">
                          <li><a href="/profile">Profile</a></li>
                          <li><a href="/editPassword">Edit Password</a></li>
                      </ul>
                  </li>
              @endcan

              @can('timAuditor')
                  <li><a href="/dash" class="ai-icon" aria-expanded="false">
                          <i class="flaticon-025-dashboard"></i>
                          <span class="nav-text">Dashboard</span>
                      </a>
                  </li>
                  <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                          <i class="flaticon-072-printer"></i>
                          <span class="nav-text">Audit Mutu Internal</span>
                      </a>
                      <ul aria-expanded="false">
                          <li><a href="form-pickers.html">Pedoman AMI</a></li>
                          <li><a href="form-element.html">Checklist AMI</a></li>
                          <li><a href="form-wizard.html">Draft Temuan AMI</a></li>
                          <li><a href="form-ckeditor.html">Laporan Hasil AMI</a></li>
                      </ul>
                  </li>
                  <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                          <i class="flaticon-041-graph"></i>
                          <span class="nav-text">Dokumentasi</span>
                      </a>
                      <ul aria-expanded="false">
                          <li><a href="chart-flot.html">AMI</a></li>
                          <li><a href="chart-morris.html">RTM</a></li>
                      </ul>
                  </li>
                  <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                          <i class="flaticon-050-info"></i>
                          <span class="nav-text">Account</span>
                      </a>
                      <ul aria-expanded="false">
                          <li><a href="/profile">Profile</a></li>
                          <li><a href="/editPassword">Edit Password</a></li>
                      </ul>
                  </li>
              @endcan

              @can('auditee')
                  <li><a href="widget-basic.html" class="ai-icon" aria-expanded="false">
                          <i class="flaticon-025-dashboard"></i>
                          <span class="nav-text">Dashboard</span>
                      </a>
                  </li>
                  <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                          <i class="flaticon-072-printer"></i>
                          <span class="nav-text">Audit Mutu Internal</span>
                      </a>
                      <ul aria-expanded="false">
                          <li><a href="form-pickers.html">Pedoman AMI</a></li>
                          <li><a href="form-element.html">Data Dukung</a></li>
                          <li><a href="form-wizard.html">Ketersediaan Dokumen</a></li>
                          <li><a href="form-ckeditor.html">Checklist Hasil AMI</a></li>
                          <li><a href="form-validation.html">Draft Temuan AMI</a></li>
                      </ul>
                  </li>
                  <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                          <i class="flaticon-041-graph"></i>
                          <span class="nav-text">Dokumentasi</span>
                      </a>
                      <ul aria-expanded="false">
                          <li><a href="chart-flot.html">AMI</a></li>
                          <li><a href="chart-morris.html">RTM</a></li>
                      </ul>
                  </li>
                  <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                          <i class="flaticon-050-info"></i>
                          <span class="nav-text">Account</span>
                      </a>
                      <ul aria-expanded="false">
                          <li><a href="/profile">Profile</a></li>
                          <li><a href="/editPassword">Edit Password</a></li>
                      </ul>
                  </li>
              @endcan

              @can('jurusan')
                  <li><a href="/dash" class="ai-icon" aria-expanded="false">
                          <i class="flaticon-025-dashboard"></i>
                          <span class="nav-text">Dashboard</span>
                      </a>
                  </li>
                  <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                          <i class="flaticon-072-printer"></i>
                          <span class="nav-text">Audit Mutu Internal</span>
                      </a>
                      <ul aria-expanded="false">
                          <li><a href="form-pickers.html">Pedoman AMI</a></li>
                          <li><a href="form-element.html">Monitoring</a></li>
                      </ul>
                  </li>
                  <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                          <i class="flaticon-041-graph"></i>
                          <span class="nav-text">Dokumentasi</span>
                      </a>
                      <ul aria-expanded="false">
                          <li><a href="chart-flot.html">AMI</a></li>
                          <li><a href="chart-morris.html">RTM</a></li>
                      </ul>
                  </li>
                  <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                          <i class="flaticon-050-info"></i>
                          <span class="nav-text">Account</span>
                      </a>
                      <ul aria-expanded="false">
                          <li><a href="/profile">Profile</a></li>
                          <li><a href="/editPassword">Edit Password</a></li>
                      </ul>
                  </li>
              @endcan
          </ul>
          <div class="copyright">
              <p><strong>Sistem Audit Mutu Internal POLINDRA</strong> © 2023 </p>
              <p class="fs-12">Made with <span class="heart"></span> by DexignLab</p>
          </div>
      </div>
  </div>
  <!--**********************************
            Sidebar end
        ***********************************-->
