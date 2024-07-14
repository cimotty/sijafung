<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Employee;
use App\Imports\EmployeesImport;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class EmployeesTable extends Component
{
    public $pegawai_id, $nama, $NIP, $jabatan, $unitKerja;
    public $search;
    use WithPagination;
    public $perPage = 25;

    // Atribut CRUD
    public $isModalCreate = false;  
    public $isModalUpdate = false;  
    public $isModalDelete = false;
    public $isModalImport = false;
    // 

    // Atribut Filter
    public $filter;
    public $sortBy = 'nama';
    public $sortDirection = 'asc';
    // 

    // Atribut Select
    public $selectedRows = [];
    public $employees;
    public $selectPageRows;
    public $deleteType = 'single';
    //
    
    // Atribut Import
    public $fileImport;
    use WithFileUploads;
    //
    

    protected $updatesQueryString = [
        'perPage' => ['except' => 25],
    ];

    public function updatedPerPage($value)
    {
        $this->resetPage();
    }

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

        $employee = $query->paginate($this->perPage);

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
        $this->deleteType = 'single';
        $this->isModalDelete = true;
        $this->pegawai_id = $id;
        $this->dispatchBrowserEvent('show-delete-modal');
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
        $this->reset(['deleteType', 'pegawai_id']);
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

        session()->flash('success', 'Data Pegawai Berhasil Ditambahkan');

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

            session()->flash('success', 'Data Pegawai Berhasil Diupdate');
            $this->closeModalUpdate();
        }
    }

    public function delete(){
        Employee::find($this->pegawai_id)->delete();
        session()->flash('success', 'Data Pegawai Berhasil Dihapus');
        $this->closeModalDelete();
    }
    

    // Selected
    public function mount()
    {
        $this->loadEmployees();
    }

    public function loadEmployees()
    {
        $this->employees = Employee::all();
    }

    public function updatedSelectPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->employees->pluck('id')->map(function ($id) {
                return (string) $id;
            });
        } else {
            $this->reset(['selectedRows', 'selectPageRows']);
        }
    }

    public function confirmDeleteSelectedRows()
    {
        $this->deleteType = 'multiple';
        $this->isModalDelete = true;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteSelectedRows()
    {
        Employee::whereIn('id', $this->selectedRows)->delete();
        session()->flash('success', 'Data pegawai yang dipilih berhasil dihapus');
        $this->closeModalDelete();
    }
    //
    

    public function closeModalImport()
    {
        $this->isModalImport = false;
    }

    public function importItems()
    {
        $this->validate([
            'fileImport' => 'required|file|mimes:xlsx,xls', 
        ]);

        Excel::import(new EmployeesImport, $this->fileImport->getRealPath());

        session()->flash('success', 'Data berhasil diimport.');

        $this->closeModalImport();
    }
}
