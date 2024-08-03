<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employee';
    protected $guarded = ['id'];

    const DIVISI_OPTIONS = [
        'DINKES',
        'M.YUNUS',
        'RSKJ',
        'BKD',
        'KESBANGPOL',
        'BPBD',
        'BPKD',
        'BPSDM',
        'BADAN PENGHUBUNG',
        'BAPPEPEDA',
        'DE&SDM',
        'DKELPER',
        'DKEPCAPIL',
        'DKP',
        'TEKER TRANS',
        'DISKOMINFOTIK',
        'DISKOPUKM',
        'DLHK',
        'PUPR',
        'PARIWISATA',
        'DPMD',
        'DPPPA',
        'DISPORA',
        'DPMPTSP',
        'DISDIKBUD',
        'DISHUB',
        'DISPERINDAG',
        'DISPERPUSDA',
        'DISPERKAPEM',
        'DISNAKKESWAN',
        'DINSOS',
        'DTPHP',
        'INSPEKTORAT',
        'SAPTOPPP PK',
        'SETDA',
        'SEKWAN',
        'ANALIS SDM APARATUR',
        'ARSIPARIS',
        'PENGGERAK SWADAYA MAS',
        'PRANATA KOMPUTER',
        'P. EKOSISTEM HUTAN',
        'PUSTAKAWAN',
        'WI',
        'PERENCANA',
        'PENYULUH KESMAS',
        'PRANATA HUMAS',
        'RADIOGRAFER',
        'PENYULUH PERTANIAN',
    ];
}
