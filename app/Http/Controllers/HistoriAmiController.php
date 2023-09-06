<?php

namespace App\Http\Controllers;

use App\Models\AkunAuditee;
use App\Models\AkunAuditor;
use App\Models\HistoriAmi;
use App\Models\LaporanAmi;
use App\Models\LayananAkademik;
use App\Models\PertanyaanStandar;
use App\Models\ProgramStudi;
use App\Models\Standar;
use App\Models\TugasStandar;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use ZipArchive;

class HistoriAmiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pelaksanaan_ami' => HistoriAmi::latest()->paginate(10)
        ];
        return view('ami.pelaksanaan_ami.tahun_pelaksanaan', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "tahun_ami" => "required"
        ]);

        $request->merge([
            "status" => 1
        ]);

        DB::transaction(function () use ($request) {
            HistoriAmi::create($request->all());
        });
        return redirect('/ami/jadwal_pelaksanaan')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(HistoriAmi $historiAmi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pelaksanaan_ami = HistoriAmi::findOrFail($id);
        $data = [
            "update_pelaksanaan" => $pelaksanaan_ami
        ];
        return view('ami.pelaksanaan_ami.update_pelaksanaan', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pelaksanaan_ami = HistoriAmi::findOrFail($id);
        $request->validate([
            "tahun_ami" => "required"
        ]);

        DB::transaction(function () use ($request, $pelaksanaan_ami) {
            $pelaksanaan_ami->update($request->all());
        });
        return redirect('/ami/jadwal_pelaksanaan')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelaksanaan_ami = HistoriAmi::findOrFail($id);
        DB::transaction(function () use ($pelaksanaan_ami) {
            $pelaksanaan_ami->delete();
        });
        return redirect('/ami/jadwal_pelaksanaan')->with('message', 'Data Berhasil Terhapus!');
    }

    public function historiAmi()
    {
        $data = [
            'pelaksanaan_ami' => HistoriAmi::where('status', 0)->get()
        ];
        return view('ami.histori.histori_ami', $data);
    }

    public function historiAmiData($id)
    {
        $data = [
            'akun_auditee' => AkunAuditee::whereHas('jadwal.historiAmi', function ($query) use ($id) {
                $query->where('id', $id);
            })->latest()->paginate(10),
        ];
        return view('ami.histori.histori_data', $data);
    }

    public function menuAuditee($id)
    {
        $auditee = AkunAuditee::where('id', $id)->first();
        $data = [
            'auditee' => $auditee
        ];
        return view('ami.histori.menu_auditee', $data);
    }

    public function dataDukungAuditee($id)
    {
        $user = User::findOrFail($id);

        $data = [
            "user" => $user
        ];

        return view('ami.histori.menu_auditee.data_dukung', $data);
    }

    public function ketersediaan($id)
    {
        $user = User::findOrFail($id);

        $data = [
            "user" => $user
        ];

        return view('ami.histori.menu_auditee.ketersediaan_dokumen', $data);
    }

    public function checklist($id)
    {
        $user = User::findOrFail($id);

        $data = [
            "user" => $user
        ];

        return view('ami.histori.menu_auditee.checklist', $data);
    }

    public function temuan($id)
    {
        $user = User::findOrFail($id);

        $data = [
            "user" => $user
        ];

        return view('ami.histori.menu_auditee.temuan', $data);
    }

    public function dokumentasiAmi()
    {
        return view('ami.histori.dokumentasi.dokumentasi_ami');
    }

    public function dokumentasiRtm()
    {
        return view('ami.histori.dokumentasi.dokumentasi_rtm');
    }

    public function downloadLaporanAmi($id)
    {
        $user = User::findOrFail($id);
        $tugasStandar = LaporanAmi::whereHas('jadwal.historiAmi', function ($query) {
            $query->whereStatus(0);
        })->whereIdUnitKerja($user->akunAuditee->id_unit_kerja)->first();

        return response()->download("storage/" . $tugasStandar->file_laporan_ami);
    }

    public function downloadDataDukungAuditee($id)
    {
        $zipArchive = new ZipArchive();

        $tugasStandar = TugasStandar::findOrFail($id);

        $dataDukung = $tugasStandar->standar->dataDukungAuditeeTidakAktif()->whereIdUser($tugasStandar->id_user)->get();

        $nama_file = $tugasStandar->standar->nama_standar . '_' . $tugasStandar->user->nip . '.zip';

        if ($zipArchive->open(public_path($nama_file), ZipArchive::CREATE) === TRUE) {
            foreach ($dataDukung as $data) {
                $path = public_path('storage/' . $data->data_file);
                $zipArchive->addFile($path, $data->nama_file);
            }
            $zipArchive->close();
        }

        return Response::download(public_path($nama_file));
    }

    public function downloadKetersediaan($id)
    {
        $standar = Standar::whereHas('jadwal.historiAmi', function ($query) {
            $query->whereStatus(0);
        })->whereId($id)->first();

        if (
            !$standar->pertanyaanStandar ||
            !$standar->pertanyaanStandar->ketersediaanDokumen ||
            !$standar->tugasStandar
        ) {
            return back()->with('error', 'Data Belum Lengkap, Tidak Dapat Mengunduh Dokumen. Tolong Lengkapi Data Terlebih Dahulu!');
        }

        $akunAuditor = AkunAuditor::where(function ($query) {
            if (auth()->user()->akunAuditee) {
                $query->where("id_unit_kerja", auth()->user()->akunAuditee->id_unit_kerja);
            }

            if (auth()->user()->akunAuditor) {
                $query->where("id_unit_kerja", auth()->user()->akunAuditor->id_unit_kerja);
            }
        })->first();

        $pertanyaanStandar = PertanyaanStandar::where('id_standar', $id)
            ->get();
        $listNamadokumen = [];
        $listKetersediaanYa = [];
        $listKeteresediaanTidak = [];
        $listPic = [];

        $listPertanyaan = [];
        foreach ($pertanyaanStandar as $index => $pertanyaan) {
            $ketersediaanDokumen = $pertanyaan->ketersediaanDokumen;
            // If Ketersediaan Dokumen exists, retrieve its properties
            if ($ketersediaanDokumen) {
                $listNamadokumen[] = $ketersediaanDokumen->nama_dokumen;
                $listKetersediaanYa[] = $ketersediaanDokumen->ketersediaan_dokumen === 'ya' ? 'V' : '';
                $listKeteresediaanTidak[] = $ketersediaanDokumen->ketersediaan_dokumen === 'tidak' ? 'V' : '';
                $listPic[] = $ketersediaanDokumen->pic;
            } else {
                $listNamadokumen[] = '';
                $listKetersediaanYa[] = '';
                $listKeteresediaanTidak[] = '';
                $listPic[] = '';
            }
            $pertanyaan = strip_tags($pertanyaan->list_pertanyaan_standar);
            $listPertanyaan[] =  $index + 1 . '. ' . $pertanyaan;
        }
        $pertanyaanStandar = implode("\n", $listPertanyaan);

        $template = new \PhpOffice\PhpWord\TemplateProcessor('./ketersediaan_dokumen/ketersediaan_dokumen.docx');
        $template->setValues([
            "nama_formulir" => $standar->pertanyaanStandar->ketersediaanDokumen->kopSurat->nama_formulir,
            "no_dokumen" => $standar->pertanyaanStandar->ketersediaanDokumen->kopSurat->no_dokumen,
            "no_revisi" => $standar->pertanyaanStandar->ketersediaanDokumen->kopSurat->no_revisi,
            "tanggal_berlaku" => $standar->pertanyaanStandar->ketersediaanDokumen->kopSurat->tanggal_berlaku,
            "halaman" => $standar->pertanyaanStandar->ketersediaanDokumen->kopSurat->halaman,
            "no_audit" => $standar->pertanyaanStandar->ketersediaanDokumen->no_audit,
            "tanggal_input_dokKetersediaan" => Carbon::parse($standar->pertanyaanStandar->ketersediaanDokumen->tanggal_input_dokKetersediaan)->toDateString(),
            "akun_auditor" => $akunAuditor->nama,
            "nip" => $akunAuditor->user->nip,
            "nama_standar" => $standar->nama_standar,
            "list_pertanyaan_standar" =>  str_replace("\n", '<w:br/>', htmlspecialchars($pertanyaanStandar)),
            "nama_dokumen" => str_replace("\n", '<w:br/>', htmlspecialchars(implode("\n", $listNamadokumen))),
            "ketersediaan_ya" => str_replace("\n", '<w:br/>', htmlspecialchars(implode("\n", $listKetersediaanYa))),
            "ketersediaan_tidak" => str_replace("\n", '<w:br/>', htmlspecialchars(implode("\n", $listKeteresediaanTidak))),
            "pic" => str_replace("\n", '<w:br/>', htmlspecialchars(implode("\n", $listPic))),
        ]);

        $fileName = 'arsip/dok_ketersediaan/' . date('d-m-Y') . ' Ketersediaan Dokumen Auditee.docx';
        $template->saveAs($fileName);
        return Response::download(public_path($fileName));
    }

    public function downloadChecklist($id)
    {
        $standar = Standar::whereHas('jadwal.historiAmi', function ($query) {
            $query->whereStatus(0);
        })->whereId($id)->first();

        if (
            !$standar->pertanyaanStandar ||
            !$standar->pertanyaanStandar->cheklistAudit ||
            !$standar->pertanyaanStandar->cheklistAudit->kopSurat ||
            !$standar->tugasStandar
        ) {
            return back()->with('error', 'Data Belum Lengkap, Tidak Dapat Mengunduh Dokumen. Tolong Lengkapi Data Terlebih Dahulu!');
        }

        $user = auth()->user(); // Mengambil informasi user yang terotentikasi
        $unitKerja = "";
        $nama = "";
        if ($user->akunAuditor) {
            $nama = $user->akunAuditor->nama;

            // Jika user adalah akunAuditor, ambil informasi unit kerja dari akunAuditor
            $unitKerjaId = $user->akunAuditor->id_unit_kerja;

            // Cek apakah unitKerjaId sesuai dengan id_unit_kerja pada LayananAkademik
            $prodi = ProgramStudi::where('id', $unitKerjaId)->first();
            $unitKerja = $prodi->nama_prodi;

            if (!$prodi) {
                // Jika tidak ditemukan di LayananAkademik, coba ambil dari ProgramStudi
                $layanan = LayananAkademik::where('id', $unitKerjaId)->first();
                $unitKerja = $layanan->nama_layanan;
                if (!$layanan) {
                    return back()->with('error', 'Unit Kerja tidak ditemukan.');
                }

                $nama = $user->akunAuditee->nama;
            }
        } elseif ($user->akunAuditee) {
            $nama = $user->akunAuditee->nama;

            // Jika user adalah akunAuditee, ambil informasi unit kerja dari akunAuditee
            $unitKerjaId = $user->akunAuditee->id_unit_kerja;

            $prodi = ProgramStudi::where('id', $unitKerjaId)->first();
            $unitKerja = $prodi->nama_prodi;

            if (!$prodi) {
                // Jika tidak ditemukan di LayananAkademik, coba ambil dari ProgramStudi
                $layanan = LayananAkademik::where('id', $unitKerjaId)->first();
                $unitKerja = $layanan->nama_layanan;
                if (!$layanan) {
                    return back()->with('error', 'Unit Kerja tidak ditemukan.');
                }
            }
        }

        $pertanyaanStandar = PertanyaanStandar::where('id_standar', $id)->get();
        $listHasilObservasi = [];
        $listKesesuaianYa = [];
        $listKesesuaianTidak = [];
        $listCatatanKhusus = [];
        $listTanggapanAuditee = [];

        $listPertanyaan = [];
        foreach ($pertanyaanStandar as $index => $pertanyaan) {
            $cheklistAudit = $pertanyaan->cheklistAudit;

            if ($cheklistAudit) {
                $listHasilObservasi[] = $cheklistAudit->hasil_observasi;
                $listKesesuaianYa[] = $cheklistAudit->kesesuaian === 'ya' ? 'V' : '';
                $listKesesuaianTidak[] = $cheklistAudit->kesesuaian === 'tidak' ? 'V' : '';
                $listCatatanKhusus[] = $cheklistAudit->catatan_khusus;
                $listTanggapanAuditee[] = $cheklistAudit->tanggapanChecklist->tanggapan_auditee;
            } else {
                $listHasilObservasi[] = '';
                $listKesesuaianYa[] = '';
                $listKesesuaianTidak[] = '';
                $listCatatanKhusus[] = '';
                $listTanggapanAuditee[] = '';
            }

            $pertanyaan = strip_tags($pertanyaan->list_pertanyaan_standar);
            $listPertanyaan[] =  ($index + 1) . '. ' . $pertanyaan;
        }
        $pertanyaanStandar = implode("\n", $listPertanyaan);

        $template = new \PhpOffice\PhpWord\TemplateProcessor('./checklist_ami/dokumen_checklist.docx');
        $template->setValues([
            "nama_formulir" => $standar->pertanyaanStandar->cheklistAudit->kopSurat->nama_formulir,
            "nama_standar" => $standar->pertanyaanStandar->cheklistAudit->kopSurat->nama_standar,
            "no_dokumen" => $standar->pertanyaanStandar->cheklistAudit->kopSurat->no_dokumen,
            "no_revisi" => $standar->pertanyaanStandar->cheklistAudit->kopSurat->no_revisi,
            "tanggal_berlaku" => $standar->pertanyaanStandar->cheklistAudit->kopSurat->tanggal_berlaku,
            "halaman" => $standar->pertanyaanStandar->cheklistAudit->kopSurat->halaman,
            "unit_kerja" => $unitKerja,
            "tanggal_input_dokChecklist" => Carbon::parse($standar->pertanyaanStandar->cheklistAudit->tanggal_input_dokChecklist)->toDateString(),
            "akun_auditor" => $standar->pertanyaanStandar->cheklistAudit->user->akunAuditor->nama,
            "nip" => $user->nip,
            "list_pertanyaan_standar" => str_replace("\n", '<w:br/>', htmlspecialchars($pertanyaanStandar)),
            "hasil_observasi" => str_replace("\n", '<w:br/>', htmlspecialchars(implode("\n", $listHasilObservasi))),
            "kesesuaian_ya" => str_replace("\n", '<w:br/>', htmlspecialchars(implode("\n", $listKesesuaianYa))),
            "kesesuaian_tidak" => str_replace("\n", '<w:br/>', htmlspecialchars(implode("\n", $listKesesuaianTidak))),
            "catatan_khusus" => str_replace("\n", '<w:br/>', htmlspecialchars(implode("\n", $listCatatanKhusus))),
            "tanggapan_auditee" => str_replace("\n", '<w:br/>', htmlspecialchars(implode("\n", $listTanggapanAuditee))),
        ]);

        $fileName = 'arsip/dok_checklist/' . date('d-m-Y') . ' Check List Audit.docx';
        $template->saveAs($fileName);
        return Response::download(public_path($fileName));
    }

    public function downloadDraftTemuan($id)
    {
        $standar = Standar::whereHas('jadwal.historiAmi', function ($query) {
            $query->whereStatus(0);
        })->whereId($id)->first();

        if (
            !$standar->uraianTemuanAmi ||
            !$standar->uraianTemuanAmi->kopSurat ||
            !$standar->tugasStandar ||
            !$standar->uraianTemuanAmi->checklist_uraian ||
            !$standar->analisaTindakanAmi ||
            !$standar->analisaTindakanAmi->tanggal_penyelesaian ||
            !$standar->verifikasiKp4mp ||
            !$standar->verifikasiKp4mp->verifikasi_kp4mp ||
            !$standar->verifikasiKp4mp->tanggal_verifikasi
        ) {
            return back()->with('error', 'Data Belum Lengkap, Tidak Dapat Mengunduh Dokumen. Tolong Lengkapi Data Terlebih Dahulu!');
        }

        // $lead_auditor = Level::where("name", "Lead Auditor")->first();
        // $anggota_auditor = Level::where("name", "Anggota Auditor")->first();
        $userId = []; // Use an array to store user IDs
        foreach ($standar->tugasStandar as $stdr) {
            $userId[] = $stdr->id_user; // Append user IDs to the array
        }

        // Now you have an array of user IDs, let's retrieve the users
        $akunAuditor = AkunAuditor::where('id_user', $userId)->first(); // Find users with the given IDs


        // Retrieve the lead auditor's unitkerja ID
        $leadAuditor = AkunAuditor::where('id_user', $userId)->first();
        $leadAuditorUnitKerjaId = $leadAuditor->id_unit_kerja;

        // Retrieve anggota_auditor users from the same unitkerja
        $anggotaAuditors = User::whereHas('akunAuditor', function ($query) use ($leadAuditorUnitKerjaId) {
            $query->where('id_unit_kerja', $leadAuditorUnitKerjaId);
        })->whereHas('levelRole', function ($query) {
            $query->where('name', 'Anggota Auditor');
        })->get();


        // Now you have a collection of users with akunAuditee from the same unitkerja

        $anggotaAuditorsName = []; // Initialize an array to store anggota_auditor names

        foreach ($anggotaAuditors as $index => $anggotaAuditor) {
            $anggotaAuditorsName[] = htmlspecialchars(($index + 1) . ". " . $anggotaAuditor->akunAuditor->nama); // Add index and HTML-encode each anggota_auditor name
        }

        $anggotaAuditorsNamesString = implode('<w:br/>', $anggotaAuditorsName);
        $unitKerjaId = $akunAuditor->id_unit_kerja;
        $unitKerja = "";
        $akunAuditee = User::whereHas('akunAuditee', function ($query) use ($unitKerjaId) {
            $query->where('id_unit_kerja', $unitKerjaId);
        })->first();


        if ($akunAuditor) {

            $unitKerjaId = $akunAuditor->id_unit_kerja;

            $prodi = ProgramStudi::where('id', $unitKerjaId)->first();
            $unitKerja = $prodi->nama_prodi;

            if (!$prodi) {
                $layanan = LayananAkademik::where('id', $unitKerjaId)->first();
                $unitKerja = $layanan->nama_layanan;

                if (!$layanan) {
                    return back()->with('error', 'Unit Kerja tidak ditemukan.');
                }
            }
        }

        $template = new \PhpOffice\PhpWord\TemplateProcessor('./draft_temuan_ami/draft_temuan_ami.docx');
        $template->setValues([
            "nama_formulir" => $standar->uraianTemuanAmi->kopSurat->nama_formulir,
            "no_dokumen" => $standar->uraianTemuanAmi->kopSurat->no_dokumen,
            "no_revisi" => $standar->uraianTemuanAmi->kopSurat->no_revisi,
            "tanggal_berlaku" => $standar->uraianTemuanAmi->kopSurat->tanggal_berlaku,
            "halaman" => $standar->uraianTemuanAmi->kopSurat->halaman,
            "nama_standar" => $standar->nama_standar,
            "lead_auditor" => $akunAuditor->nama,
            "unit_kerja" => $unitKerja,
            "anggota_audior" => $anggotaAuditorsNamesString,
            "akun_auditee" => $akunAuditee->akunAuditee->nama,
            "uraian_ketidaksesuaian" => $standar->uraianTemuanAmi->uraian_ketidaksesuaian,
            "checklist_uraia_c" => $standar->uraianTemuanAmi->checklist_uraian === 'NC' ? 'V' : '',
            "checklist_uraia_o" => $standar->uraianTemuanAmi->checklist_uraian === 'O' ? 'V' : '',
            "tanggal_pelaksanaan" => Carbon::parse($standar->uraianTemuanAmi->tanggal_pelaksanaan)->toDateString(),
            "tanggal_penyelesaian" => Carbon::parse($standar->analisaTindakanAmi->tanggal_penyelesaian)->toDateString(),
            "analisa_masalah" => $standar->analisaTindakanAmi->analisa_masalah,
            "tindakan_koreksi" => $standar->analisaTindakanAmi->tindakan_koreksi,
            "verifikasi_kp4mp" => $standar->verifikasiKp4mp->verifikasi_kp4mp,
            "tanggal_verifikasi" => Carbon::parse($standar->verifikasiKp4mp->tanggal_verifikasi)->toDateString()
        ]);

        $fileName = 'arsip/dok_temuan/' . date('d-m-Y') . ' Temuan Audit Mutu Internal.docx';
        $template->saveAs($fileName);
        return Response::download(public_path($fileName));
    }
}
