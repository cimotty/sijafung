<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class EmployeesImport implements ToModel, WithHeadingRow, WithStartRow
{
    public function model(array $row)
    {
        // Cek apakah NIP sudah ada di database
        $existingEmployee = Employee::where('NIP', $row['nip'])->first();

        // Jika NIP sudah ada, kembalikan null untuk mengabaikan data
        if ($existingEmployee) {
            return null;
        }
        
        return new Employee([
            'nama' => $row['nama'],
            'NIP' => $row['nip'],
            'divisi' => $row['divisi'],
            'jabatan' => $row['jabatan_fungsional'],
            'unitKerja' => $row['unit_kerja'],
        ]);
    }

    public function startRow(): int
    {
        return 5;
    }

    public function headingRow(): int
    {
        return 3;
    }
}
