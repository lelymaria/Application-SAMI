<?php

namespace App\Http\Controllers;

use App\Models\DataDukungAuditee;
use App\Models\JadwalAmi;
use App\Models\Standar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class DataDukungAuditeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $standar = Standar::whereHas('jadwal.historiAmi', function ($query) {
            $query->where('status', 1);
        })->whereHas('tugasStandar', function ($query) {
            $query->where('id_user', auth()->user()->id);
        });
        $jumlah_yang_sudah_diisi = DataDukungAuditee::whereIn('id_standar', $standar->get()->pluck('id'))->where('id_user', auth()->user()->id);
        $data = [
            'standar' => $standar->latest()->paginate(10),
            'jumlah_yang_sudah_diisi' => $jumlah_yang_sudah_diisi,
            'jumlah_yang_belum_diisi' => $standar->count() - $jumlah_yang_sudah_diisi->count()
        ];
        return view('ami.data_dukung.data_standar', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $dataDukung = DataDukungAuditee::where('id_standar', $id)->where(function ($query) {
            if (auth()->user()->akunAuditee) {
                $query->whereHas('user.akunAuditee', function ($query) {
                    $query->where("id_unit_kerja", auth()->user()->akunAuditee->id_unit_kerja);
                });
            }
            if (auth()->user()->akunAuditor) {
                $query->whereHas('user.akunAuditee', function ($query) {
                    $query->where("id_unit_kerja", auth()->user()->akunAuditor->id_unit_kerja);
                });
            }
        })->latest()->paginate(10);
        $data = [
            'standar' => Standar::findOrFail($id),
            'dataDukung' => $dataDukung
        ];
        return view('ami.data_dukung.data_dukung', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        $standar = Standar::findOrFail($id);
        $request->validate([
            "data_dukung_auditee" => "array",
            "data_dukung_auditee.*" => "required|mimes:doc,docx,pdf,xlsx,xls|file|max:3072",
        ], [
            "data_dukung_auditee.*.max" => "File Data Dukung Maximal 3 MB"
        ]);

        $request->merge([
            "id_standar" => $standar->id
        ]);

        DB::transaction(function () use ($request, $standar) {
            $jadwal_ami = JadwalAmi::where('status', 1)->first();
            if (!$jadwal_ami) {
                return back()->with('error', 'Jadwal AMI tidak tersedia!');
            }

            foreach ($request->data_dukung_auditee as $document) {
                $filename = $document->getClientOriginalName();
                $path = $document->storeAs('data_dukung_auditee', $filename);
                $standar->dataDukungAuditee()->create([
                    'data_file' => $path,
                    'nama_file' => $filename,
                    'id_jadwal' => $jadwal_ami->id,
                    'id_user' => auth()->user()->id
                ]);
            }
        });
        return redirect('/ami/auditee/data_dukung/create/' . $id)->with('message', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataDukungAuditee $dataDukungAuditee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dataDukung = DataDukungAuditee::where('id', $id)->first();
        $data = [
            'update_data_dukung' => $dataDukung
        ];
        return view('ami.data_dukung.update_data_dukung', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataDukungAuditee = DataDukungAuditee::findOrFail($id);
        $request->validate([
            "data_dukung_auditee" => "required|mimes:doc,docx,pdf,xlsx,xls|file|max:3072",
        ]);

        $filename = $request->file('data_dukung_auditee')->getClientOriginalName();

        $dataDukungAuditee->update([
            'data_file' => $request->file('data_dukung_auditee')->storeAs('data_dukung_auditee', $filename),
            'nama_file' => $filename
        ]);

        return back()->with('message', 'Data Berhasil Diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataDukung = DataDukungAuditee::findOrFail($id);
        DB::transaction(function () use ($dataDukung) {
            Storage::delete($dataDukung->data_file);
            $dataDukung->delete();
        });
        return back()->with('message', 'Data Berhasil Terhapus!');
    }

    public function downloadZip($id)
    {
        $zipArchive = new ZipArchive();

        $dataDukung = DataDukungAuditee::where('id_standar', $id)->get();

        $standar = Standar::findOrFail($id);

        if ($zipArchive->open(public_path($standar->nama_standar . ".zip"), ZipArchive::CREATE) === TRUE) {
            foreach ($dataDukung as $data) {
                $path = public_path('storage/' . $data->data_file);
                $relativeName = basename($path);
                $zipArchive->addFile($path, $relativeName);
            }

            $zipArchive->close();
        }

        return Response::download(public_path($standar->nama_standar . ".zip"));
    }
}
