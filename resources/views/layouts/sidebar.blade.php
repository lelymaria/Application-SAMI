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
                        <span class="font-w600 ">Hallo,<b>@if (auth()->user()->akunOperator)
                            {{ auth()->user()->akunOperator->nama }}
                        @elseif (auth()->user()->kepalaP4mp)
                            {{ auth()->user()->kepalaP4mp->nama }}
                        @elseif (auth()->user()->akunJurusan)
                            {{ auth()->user()->akunJurusan->nama }}
                        @elseif (auth()->user()->akunAuditee)
                            {{ auth()->user()->akunAuditee->nama }}
                        @else
                            {{ auth()->user()->akunAuditor->nama }}
                        @endif</b></span>
                        <small class="font-w400">{{ auth()->user()->levelRole->name }}</small>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="{{ url('/profile') }}" class="dropdown-item ai-icon">
                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18"
                            height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span class="ms-2">Profile</span>
                    </a>
                    <a href="{{ url('logout') }}" class="dropdown-item ai-icon">
                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18"
                            height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        <span class="ms-2">Logout</span>
                    </a>
                </div>
            </li>
            @can('operator')
                <li><a href="{{ url('/dashboard') }}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-025-dashboard"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-043-menu"></i>
                        <span class="nav-text">Data</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ url('/data/layanan_akademik') }}">Layanan Akademik</a></li>
                        <li><a href="{{ url('/data/datajurusan') }}">Jurusan</a></li>
                        <li><a href="{{ url('/data/dataprodi') }}">Prodi</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-045-heart"></i>
                        <span class="nav-text">Manage User</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ url('/manage_user/akun_operator') }}">Operator</a></li>
                        <li><a href="{{ url('/manage_user/kepalaP4mp') }}">Kepala P4MP</a></li>
                        <li><a href="{{ url('/manage_user/akun_jurusan') }}">Jurusan</a></li>
                        <li><a href="{{ url('/manage_user/lead_auditor') }}">Auditor</a></li>
                        <li><a href="{{ url('/manage_user/akun_auditee') }}">Auditee</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-072-printer"></i>
                        <span class="nav-text">Audit Mutu Internal</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ url('/ami/pedomanAmi') }}">Pedoman AMI</a></li>
                        <li><a href="{{ url('/ami/kop_surat') }}">KOP Surat</a></li>
                        <li><a href="{{ url('/ami/standar') }}">Standar</a></li>
                        <li><a href="{{ url('/ami/jadwalAmi') }}">Jadwal AMI</a></li>
                        <li><a href="{{ url('/ami/data_standar') }}">Pertanyaan Standar</a></li>
                        <li><a href="{{ url('/historiami') }}">History AMI</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-041-graph"></i>
                        <span class="nav-text">Dokumentasi</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ url('/dokumentasiAmi/undangan') }}">AMI</a></li>
                        <li><a href="{{ url('/dokumentasiRtm/undangan') }}">RTM</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-050-info"></i>
                        <span class="nav-text">Account</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ url('/profile/edit') }}">Profile</a></li>
                        <li><a href="{{ url('/password/edit') }}">Edit Password</a></li>
                    </ul>
                </li>
            @endcan

            @can('ketuaP4mp')
                <li><a href="/dashboard" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-025-dashboard"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-072-printer"></i>
                        <span class="nav-text">Audit Mutu Internal</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ url('/ami/pedomanAmi') }}">Pedoman AMI</a></li>
                        <li><a href="/monitoringamiP4mp">Monitoring AMI</a></li>
                        <li><a href="{{ url('/ami/verifikasi_ami') }}">Draft Temuan AMI</a></li>
                        <li><a href="{{ url('/ami/laporan_ami') }}">Laporan Hasil AMI</a></li>
                        <li><a href="/historiAll">History AMI</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-041-graph"></i>
                        <span class="nav-text">Dokumentasi</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ url('/dokumentasiAmi/undangan') }}">AMI</a></li>
                        <li><a href="{{ url('/dokumentasiRtm/undangan') }}">RTM</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-050-info"></i>
                        <span class="nav-text">Account</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ url('/profile/edit') }}">Profile</a></li>
                        <li><a href="{{ url('/password/edit') }}">Edit Password</a></li>
                    </ul>
                </li>
            @endcan

            @can('lead')
                <li><a href="/dashboard" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-025-dashboard"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-072-printer"></i>
                        <span class="nav-text">Audit Mutu Internal</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ url('/ami/pedomanAmi') }}">Pedoman AMI</a></li>
                        <li><a href="{{ url('/ami/checklist_audit') }}">Checklist AMI</a></li>
                        <li><a href="{{ url('/ami/uraian_ami') }}">Draft Temuan AMI</a></li>
                        <li><a href="{{ url('/ami/laporan_ami') }}">Laporan Hasil AMI</a></li>
                        <li><a href="/historiAll">History AMI</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-041-graph"></i>
                        <span class="nav-text">Dokumentasi</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ url('/dokumentasiAmi/undangan') }}">AMI</a></li>
                        <li><a href="{{ url('/dokumentasiRtm/undangan') }}">RTM</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-050-info"></i>
                        <span class="nav-text">Account</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ url('/profile/edit') }}">Profile</a></li>
                        <li><a href="{{ url('/password/edit') }}">Edit Password</a></li>
                    </ul>
                </li>
            @endcan

            @can('anggota')
                <li><a href="/dashboard" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-025-dashboard"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-072-printer"></i>
                        <span class="nav-text">Audit Mutu Internal</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ url('/ami/pedomanAmi') }}">Pedoman AMI</a></li>
                        <li><a href="{{ url('/ami/checklist_audit') }}">Checklist AMI</a></li>
                        <li><a href="{{ url('/ami/uraian_ami') }}">Draft Temuan AMI</a></li>
                        <li><a href="{{ url('/ami/laporan_ami') }}">Laporan Hasil AMI</a></li>
                        <li><a href="/historiAll">History AMI</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-041-graph"></i>
                        <span class="nav-text">Dokumentasi</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ url('/dokumentasiAmi/undangan') }}">AMI</a></li>
                        <li><a href="{{ url('/dokumentasiRtm/undangan') }}">RTM</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-050-info"></i>
                        <span class="nav-text">Account</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ url('/profile/edit') }}">Profile</a></li>
                        <li><a href="{{ url('/password/edit') }}">Edit Password</a></li>
                    </ul>
                </li>
            @endcan

            @can('auditee')
                <li><a href="/dashboard" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-025-dashboard"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-072-printer"></i>
                        <span class="nav-text">Audit Mutu Internal</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ url('/ami/pedomanAmi') }}">Pedoman AMI</a></li>
                        <li><a href="{{ url('/ami/auditee/data_dukung') }}">Data Dukung</a></li>
                        <li><a href="{{ url('/ami/ketersediaan_dokumen') }}">Ketersediaan Dokumen</a></li>
                        <li><a href="{{ url('/ami/tanggapan_audit') }}">Checklist Hasil AMI</a></li>
                        <li><a href="{{ url('/ami/analisa_tindakan_ami') }}">Draft Temuan AMI</a></li>
                        <li><a href="{{ url('/ami/laporan_ami') }}">Laporan Hasil AMI</a></li>
                        <li><a href="/historiAll">History AMI</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-041-graph"></i>
                        <span class="nav-text">Dokumentasi</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ url('/dokumentasiAmi/undangan') }}">AMI</a></li>
                        <li><a href="{{ url('/dokumentasiRtm/undangan') }}">RTM</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-050-info"></i>
                        <span class="nav-text">Account</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ url('/profile/edit') }}">Profile</a></li>
                        <li><a href="{{ url('/password/edit') }}">Edit Password</a></li>
                    </ul>
                </li>
            @endcan

            @can('jurusan')
                <li><a href="/dashboard" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-025-dashboard"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-072-printer"></i>
                        <span class="nav-text">Audit Mutu Internal</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ url('/ami/pedomanAmi') }}">Pedoman AMI</a></li>
                        <li><a href="/monitoringamiP4mp">Monitoring</a></li>
                        <li><a href="/historiAll">History AMI</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-041-graph"></i>
                        <span class="nav-text">Dokumentasi</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ url('/dokumentasiAmi/undangan') }}">AMI</a></li>
                        <li><a href="{{ url('/dokumentasiRtm/undangan') }}">RTM</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-050-info"></i>
                        <span class="nav-text">Account</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ url('/profile/edit') }}">Profile</a></li>
                        <li><a href="{{ url('/password/edit') }}">Edit Password</a></li>
                    </ul>
                </li>
            @endcan
        </ul>
        <div class="copyright">
            <p><strong>Sistem Audit Mutu Internal POLINDRA</strong> © 2023 </p>
            <p class="fs-12">Made with <span class="heart"></span> by POLINDRA</p>
        </div>
    </div>
</div>
<!--**********************************
                  Sidebar end
              ***********************************-->
