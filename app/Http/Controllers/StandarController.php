<?php

namespace App\Http\Controllers;

use App\Models\AkunAuditor;
use App\Models\JadwalAmi;
use App\Models\KopSurat;
use App\Models\LayananAkademik;
use App\Models\Standar;
use App\Models\Level;
use App\Models\PertanyaanStandar;
use App\Models\ProgramStudi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;

class StandarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'standar' => Standar::whereHas('jadwal', function ($query) {
                $query->where('id_jadwal', auth()->user()->id);
            })->latest()->paginate(10)
        ];
        return view('ami.standar.standar', $data);
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
        $jadwal_ami = JadwalAmi::where('status', 1)->first();
        if (!$jadwal_ami) {
            return redirect('/ami/standar')->with('error', 'jadwal ami tidak tersedia!');
        }

        $request->validate([
            "nama_standar" => "required",
        ]);

        $request->merge([
            "id_jadwal" => $jadwal_ami->id
        ]);

        DB::transaction(function () use ($request) {
            return Standar::create($request->all());
        });
        return redirect('/ami/standar')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Standar $standar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $idStandar)
    {
        $standar = Standar::findOrFail($idStandar);
        $data = [
            "update_standar" => $standar
        ];
        return view('ami.standar.update_standar', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idStandar)
    {
        $standar = Standar::findOrFail($idStandar);
        $request->validate([
            "nama_standar" => "required"
        ]);

        DB::transaction(function () use ($request, $standar) {
            $standar->update($request->all());
        });
        return redirect('/ami/standar')->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $idStandar)
    {
        $standar = Standar::findOrFail($idStandar);
        DB::transaction(function () use ($standar) {
            $standar->pertanyaanStandar()->delete();
            $standar->tugasStandar()->delete();
            $standar->dataDukungAuditee()->delete();
            $standar->uraianTemuanAmi()->delete();
            $standar->verifikasiKp4mp()->delete();
            $standar->analisaTindakanAmi()->delete();
            $standar->delete();
        });
        return redirect('/ami/standar')->with('message', 'Data Berhasil Terhapus!');
    }

    public function ketersediaanDokumen($id)
    {
        $standar = Standar::findOrFail($id);
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
                $listKetersediaanYa[] = $ketersediaanDokumen->ketersediaan_dokumen === 'ya' ? 'Ya' : '';
                $listKeteresediaanTidak[] = $ketersediaanDokumen->ketersediaan_dokumen === 'tidak' ? 'Tidak' : '';
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

    public function checklistAudit($id)
    {
        $standar = Standar::findOrFail($id);
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
            $layanan = LayananAkademik::where('id', $unitKerjaId)->first();
            $unitKerja = $layanan->nama_layanan;

            if (!$layanan) {
                // Jika tidak ditemukan di LayananAkademik, coba ambil dari ProgramStudi
                $prodi = ProgramStudi::where('id', $unitKerjaId)->first();
                $unitKerja = $prodi->nama_prodi;
                if (!$prodi) {
                    return back()->with('error', 'Unit Kerja tidak ditemukan.');
                }
            }
        } elseif ($user->akunAuditee) {
            $nama = $user->akunAuditee->nama;

            // Jika user adalah akunAuditee, ambil informasi unit kerja dari akunAuditee
            $unitKerjaId = $user->akunAuditee->id_unit_kerja;

            $layanan = LayananAkademik::where('id', $unitKerjaId)->first();
            $unitKerja = $layanan->nama_layanan;

            if (!$layanan) {
                // Jika tidak ditemukan di LayananAkademik, coba ambil dari ProgramStudi
                $prodi = ProgramStudi::where('id', $unitKerjaId)->first();
                $unitKerja = $prodi->nama_prodi;
                if (!$prodi) {
                    return back()->with('error', 'Unit Kerja tidak ditemukan.');
                }
            }
        } else {
            // Jika user tidak memiliki peran yang sesuai, berikan pesan error
            return back()->with('error', 'Anda tidak memiliki akses yang sesuai.');
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
                $listKesesuaianYa[] = $cheklistAudit->kesesuaian === 'ya' ? 'Ya' : '';
                $listKesesuaianTidak[] = $cheklistAudit->kesesuaian === 'tidak' ? 'Tidak' : '';
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


    public function dokDraftTemuan($id)
    {
        $standar = Standar::findOrFail($id);
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

            $layanan = LayananAkademik::where('id', $unitKerjaId)->first();
            $unitKerja = $layanan->nama_layanan;

            if (!$layanan) {
                $prodi = ProgramStudi::where('id', $unitKerjaId)->first();
                $unitKerja = $prodi->nama_prodi;
                if (!$prodi) {
                    return back()->with('error', 'Unit Kerja tidak ditemukan.');
                }
            }
        } else {
            // Jika user tidak memiliki peran yang sesuai, berikan pesan error
            return back()->with('error', 'Anda tidak memiliki akses yang sesuai.');
        }

        $template = new \PhpOffice\PhpWord\TemplateProcessor('./draft_temuan_ami/draft_temuan_ami.docx');
        $template->setValues([
            "nama_formulir" => $standar->uraianTemuanAmi->kopSurat->nama_formulir,
            "no_dokumen" => $standar->uraianTemuanAmi->kopSurat->no_dokumen,
            "no_revisi" => $standar->uraianTemuanAmi->kopSurat->no_revisi,
            "tanggal_berlaku" => $standar->uraianTemuanAmi->kopSurat->tanggal_berlaku,
            "halaman" => $standar->uraianTemuanAmi->kopSurat->halaman,
            "nama_standar" => $standar->nama_standar,
            "lead_auditor" => $akunAuditor->nama,  //?
            "unit_kerja" => $unitKerja,
            "anggota_audior" => $anggotaAuditorsNamesString, //?
            "akun_auditee" => $akunAuditee->akunAuditee->nama, //?
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
