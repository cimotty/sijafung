<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function print($id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            return view('livewire.print-employee', compact('employee'));
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }

    public function printByDivisi($divisi)
    {
        $query = Employee::query();

        if ($divisi !== 'Semua OPD') {
            $query->where('divisi', $divisi);
        }

        $employees = $query->get();

        if ($employees->isEmpty()) {
            return redirect()->back()->with('error', 'Data pegawai tidak ditemukan untuk divisi tersebut.');
        }

        return view('livewire.print-employee-divisi', compact('employees', 'divisi'));
    }
}
