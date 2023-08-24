<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JadwalAmi extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'jadwal_ami';
    protected $fillable = ['nama_jadwal', 'jadwal_mulai', 'jadwal_selesai', 'id_tahun_ami', 'status'];

    public function historiAmi()
    {
        return $this->hasOne(HistoriAmi::class, 'id', 'id_tahun_ami');
    }

    public function kepalaP4mp()
    {
        return $this->hasMany(KepalaP4mp::class, 'id_jadwal', 'id');
    }

    public function akunAuditee()
    {
        return $this->hasMany(AkunAuditee::class, 'id_jadwal', 'id');
    }

    public function akunJurusan()
    {
        return $this->hasMany(AkunJurusan::class, 'id_jadwal', 'id');
    }

    public function pedoman()
    {
        return $this->hasMany(PedomanAmi::class, 'id_jadwal', 'id');
    }

    public function standar()
    {
        return $this->hasMany(Standar::class, 'id_jadwal', 'id');
    }

    public function pertanyaanStandar()
    {
        return $this->hasMany(JadwalAmi::class, 'id_jadwal', 'id');
    }

    public function tugasStandar()
    {
        return $this->hasMany(TugasStandar::class, 'id_jadwal', 'id');
    }

    public function undanganAmi()
    {
        return $this->hasMany(UndanganAmi::class, 'id_jadwal', 'id');
    }

    public function daftarHadirAmi()
    {
        return $this->hasMany(DaftarHadirAmi::class, 'id_jadwal', 'id');
    }

    public function fotoKegiatanAmi()
    {
        return $this->hasMany(FotoKegiatanAmi::class, 'id_jadwal', 'id');
    }

    public function notulensiAmi()
    {
        return $this->hasMany(NotulensiAmi::class, 'id_jadwal', 'id');
    }

    public function kopSurat()
    {
        return $this->hasMany(KopSurat::class, 'id_jadwal', 'id');
    }

    public function dataDukungAuditee()
    {
        return $this->hasMany(DataDukungAuditee::class, 'id_jadwal', 'id');
    }

    public function ketersediaanDokumen()
    {
        return $this->hasMany(KetersediaanDokumen::class, 'id_jadwal', 'id');
    }

    public function checklistAudit()
    {
        return $this->hasMany(CheckListAudit::class, 'id_jadwal', 'id');
    }

    public function tanggapanChecklist()
    {
        return $this->hasMany(TanggapanCheckListAudit::class, 'id_jadwal', 'id');
    }

    public function verifikasiKp4mp()
    {
        return $this->hasMany(VerifikasiTemuanAmi::class, 'id_jadwal', 'id');
    }

    public function analisaTindakanAmi()
    {
        return $this->hasMany(AnalisadanTindakanTemuanAmi::class, 'id_jadwal', 'id');
    }

    public function uraianTemuanAmi()
    {
        return $this->hasMany(UraianTemuanAmi::class, 'id_jadwal', 'id');
    }

    public function laporanAmi()
    {
        return $this->hasMany(LaporanAmi::class, 'id_jadwal', 'id');
    }
}
