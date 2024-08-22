<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employee';
    protected $guarded = ['id'];

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
    
    const DIVISI_OPTIONS = [
        'Dinas Kesehatan',
        'RSUD dr. M. Yunus',
        'RSKJ Soeprapto',
        'Badan Kepegawaian Daerah',
        'Kesatuan Bangsa dan Politik',
        'Badan Penanggulangan Bencana Daerah',
        'Badan Pengelolaan Keuangan Daerah',
        'Badan Pengembangan SDM',
        'Badan Penghubung',
        'Badan Perencanaan, Penelitian dan Pengembangan Daerah',
        'Dinas Energi dan SDM',
        'Dinas Kelautan dan Perikanan',
        'Dinas Kependudukan dan Catatan Sipil',
        'Dinas Ketahanan Pangan',
        'Dinas Ketenagakerjaan dan Transmigrasi',
        'Dinas Komunikasi Informatika dan Statistik',
        'Dinas Koperasi dan Usaha Kecil Menengah',
        'Dinas Lingkungan Hidup dan Kehutanan',
        'Dinas Pekerjaan Umum dan Penataan Ruang',
        'Dinas Pariwisata',
        'Dinas Pemberdayaan Masyarakat dan Desa',
        'Dinas Pemberdayaan Perempuan Dan Perlindungan Anak',
        'Dinas Pemuda dan Olahraga',
        'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu',
        'Dinas Pendidikan dan Kebudayaan',
        'Dinas Perhubungan',
        'Dinas Perindustrian dan Perdagangan',
        'Dinas Perpustakaan dan Kearsipan',
        'Dinas Perumahan dan Kawasan Pemukiman',
        'Dinas Peternakan dan Kesehatan Hewan',
        'Dinas Sosial',
        'Dinas Tanaman Pangan, Hortikultura dan Perkebunan',
        'Inspektorat',
        'Satpol Pamong Praja dan Pemadam Kebakaran',
        'Sekretariat Daerah',
        'Sekretariat DPRD',
    ];
}
