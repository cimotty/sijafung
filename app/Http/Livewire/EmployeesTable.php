<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Employee;

class EmployeesTable extends Component
{
    public $pegawai_id, $nama, $NIP, $jabatan, $unitKerja;
    public $search;

    public $isModalCreate = false;  
    public $isModalUpdate = false;  
    public $isModalDelete = false;
    public $isModalImport = false;

    public $filter;
    public $sortBy = 'nama';
    public $sortDirection = 'asc';

    public function render()
    {
        $query = Employee::query();

        // Menambahkan filter pencarian
        $query->where(function($subquery) {
            $subquery->where('nama', 'like', '%'.$this->search.'%')
                    ->orWhere('NIP', 'like', '%'.$this->search.'%')
                    ->orWhere('jabatan', 'like', '%'.$this->search.'%')
                    ->orWhere('unitKerja', 'like', '%'.$this->search.'%');
        });

        // Menambahkan pengurutan
        if ($this->sortBy && in_array($this->sortBy, ['nama', 'NIP', 'jabatan', 'unitKerja'])) {
            $query->orderBy($this->sortBy, $this->sortDirection);
        }

        $employee = $query->paginate(10); 

        return view('livewire.employees-table', ['employee' => $employee]);
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortBy = $field;
    }

    public function openModalCreate()
    {
        $this->isModalCreate = true;
    }

    public function openModalUpdate($id)
    {
        $this->isModalUpdate = true;
        $employee = Employee::findOrFail($id);
        $this->pegawai_id = $id;
        $this->Updatenama = $employee->nama;
        $this->UpdateNIP = $employee->NIP;
        $this->Updatejabatan = $employee->jabatan;
        $this->UpdateunitKerja = $employee->unitKerja;
    }

    public function openModalDelete($id)
    {
        $this->isModalDelete = true;
        $this->pegawai_id = $id;
    }

    public function openModalImport()
    {
        $this->isModalImport = true;
    }

    public function closeModalCreate()
    {
        $this->isModalCreate = false;
    }

    public function closeModalUpdate()
    {
        $this->isModalUpdate = false;
        $this->resetInputFields();
    }

    public function closeModalDelete()
    {
        $this->isModalDelete = false;
    }

    public function ConfirmCreate()
    {
        $this->openModalCreate();
    }
    
    private function resetInputFields()
    {
        $this->pegawai_id = '';
        $this->nama = '';
        $this->NIP = '';
        $this->jabatan = '';
        $this->unitKerja = '';
    }
    public function store()
    {
        $validatedData = $this->validate([
            'nama' => 'required',
            'NIP' => 'required',
            'jabatan' => 'required',
            'unitKerja' => 'required',
        ]);

        Employee::updateOrCreate(['id' => $this->pegawai_id], $validatedData);

        session()->flash('message', 'Data Pegawai Berhasil Ditambahkan');

        $this->closeModalCreate();
        $this->resetInputFields();
    }

    public function update()
    {
        $validatedData = $this->validate([
            'Updatenama' => 'required',
            'UpdateNIP' => 'required',
            'Updatejabatan' => 'required',
            'UpdateunitKerja' => 'required',
        ]);
        
        $employee = Employee::find($this->pegawai_id);
        
        if ($employee) {
            $employee->update([
                'nama' => $this->Updatenama,
                'NIP' => $this->UpdateNIP,
                'jabatan' => $this->Updatejabatan,
                'unitKerja' => $this->UpdateunitKerja,
            ]);

            session()->flash('message', 'Data Pegawai Berhasil Diupdate');
            $this->closeModalUpdate();
        }
    }

    public function delete(){
        Employee::find($this->pegawai_id)->delete();
        session()->flash('message', 'Data Pegawai Berhasil Dihapus');
        $this->closeModalDelete();
    }
    
    public function confirmDeleteSelectedRows()
    {
        $selectedIds = $this->selectedRows;

        if (count($selectedIds) > 0) {
            // Lakukan penghapusan item yang dipilih
            foreach ($selectedIds as $id) {
                $employee = Employee::find($id);
                if ($employee) {
                    $employee->delete();
                }
            }

            // Kosongkan kembali selectedRows setelah menghapus
            $this->selectedRows = [];
            
            // Tampilkan pesan sukses atau sesuai kebutuhan
            session()->flash('message', 'Data pegawai yang dipilih berhasil dihapus.');
        } else {
            // Tampilkan pesan bahwa tidak ada item yang dipilih
            session()->flash('message', 'Tidak ada data pegawai yang dipilih untuk dihapus.');
        }
    }
}
