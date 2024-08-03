<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('NIP')->unique();
            $table->string('jabatan');
            $table->enum('divisi',[
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
                ]
            );
            $table->string('unitKerja');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};
