<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Employee;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Imports\EmployeesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class EmployeesTable extends Component
{
    public $pegawai_id, $nama, $NIP, $divisi, $jabatan, $unitKerja, $keterangan, $sertifikat;
    public $search;
    public $searchDivisi = '';
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
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

    // Atribut Menampilkan Data PerDivisi
    public $divisiList;
    public $selectedDivisi = 'Semua OPD';
    public $totalEmployees;
    public $totalByDivisi = 0;
    public $totalByJobTitle = [];
    // 
    
    protected $updatesQueryString = [
        'perPage' => ['except' => 25],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage($value)
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->loadEmployees();
        $this->divisiList = Employee::DIVISI_OPTIONS;
        $this->calculateTotals();
    }

    public function render()
    {
        $query = Employee::query()->with('certificates');

        if ($this->selectedDivisi != 'Semua OPD') {
            $query->where('divisi', $this->selectedDivisi);
        }

        // Menambahkan filter pencarian
        $query->where(function($subquery) {
            $subquery->where('nama', 'like', '%'.$this->search.'%')
                    ->orWhere('NIP', 'like', '%'.$this->search.'%')
                    ->orWhere('divisi', 'like', '%'.$this->search.'%')
                    ->orWhere('jabatan', 'like', '%'.$this->search.'%')
                    ->orWhere('unitKerja', 'like', '%'.$this->search.'%');
        });

        // Menambahkan pengurutan
        if ($this->sortBy && in_array($this->sortBy, ['nama', 'NIP', 'divisi', 'jabatan', 'unitKerja'])) {
            $query->orderBy($this->sortBy, $this->sortDirection);
        }

        $employee = $query->paginate($this->perPage);

        return view('livewire.employees-table', [
            'employee' => $employee,
            'jobTitleCounts' => $this->jobTitleCounts,
        ]);
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

    // Search Per Divisi
        public function updatedSearchDivisi()
        {
            $this->divisiList = array_filter(Employee::DIVISI_OPTIONS, function($divisi) {
                return stripos($divisi, $this->searchDivisi) !== false;
            });

            asort($this->divisiList);
        }

        public function updatedSelectedDivisi()
        {
            $this->calculateTotals();
        }

        public function calculateTotals()
        {
            if ($this->selectedDivisi === 'Semua OPD') {
                $this->totalByDivisi = Employee::count();
                $this->jobTitleCounts = Employee::select('jabatan', Employee::raw('count(*) as total'))
                    ->groupBy('jabatan')
                    ->get()
                    ->pluck('total', 'jabatan')
                    ->toArray();
            } else {
                $this->totalByDivisi = Employee::where('divisi', $this->selectedDivisi)->count();
                $this->jobTitleCounts = Employee::select('jabatan', Employee::raw('count(*) as total'))
                    ->where('divisi', $this->selectedDivisi)
                    ->groupBy('jabatan')
                    ->get()
                    ->pluck('total', 'jabatan')
                    ->toArray();
            }

            ksort($this->jobTitleCounts);
        }
    // 

    public function openModalCreate()
    {
        $this->isModalCreate = true;
        $this->resetValidation();
    }

    public function openModalUpdate($id)
    {
        $this->isModalUpdate = true;
        $this->resetValidation();
        $employee = Employee::findOrFail($id);
        $this->pegawai_id = $id;
        $this->Updatenama = $employee->nama;
        $this->UpdateNIP = $employee->NIP;
        $this->UpdateDivisi = $employee->divisi;
        $this->UpdateDivisi = $employee->divisi;
        $this->Updatejabatan = $employee->jabatan;
        $this->UpdateunitKerja = $employee->unitKerja;
        $this->UpdateSertifikat = $employee->sertifikat;
        $this->Updateketerangan = $employee->keterangan;
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
        $this->divisi = '';
        $this->jabatan = '';
        $this->unitKerja = '';
        $this->sertifikat = '';
        $this->keterangan = '';
        $this->searchDivisi = '';
        $this->divisiList = Employee::DIVISI_OPTIONS;
    }
    
    public function store()
    {
        $validatedData = $this->validate([
            'nama' => 'required',
            'NIP' => 'required|unique:employee|numeric',
            'divisi' => 'required|in:' . implode(',', Employee::DIVISI_OPTIONS),
            'jabatan' => 'required',
            'unitKerja' => 'required',
            'sertifikat.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'keterangan' => 'nullable',
        ],[
            'nama.required' => 'Nama harus diisi',
            'NIP.required' => 'NIP harus diisi',
            'NIP.unique' => 'NIP sudah ada',
            'NIP.numeric' => 'NIP harus berupa angka',
            'divisi.required' => 'Divisi harus dipilih',
            'divisi.in' => 'Divisi yang dipilih tidak valid',
            'jabatan.required' => 'Jabatan harus diisi',
            'sertifikat.*.mimes' => 'File harus berupa PDF, JPG, JPEG, atau PNG',
            'sertifikat.*.max' => 'Ukuran file maksimal 2MB',
            'unitKerja.required' => 'Unit Kerja harus diisi',
        ]);

        $employee = Employee::create([
            'nama' => $validatedData['nama'],
            'NIP' => $validatedData['NIP'],
            'divisi' => $validatedData['divisi'],
            'jabatan' => $validatedData['jabatan'],
            'unitKerja' => $validatedData['unitKerja'],
            'keterangan' => $validatedData['keterangan'],
        ]);

        if ($this->sertifikat) {
            foreach ($this->sertifikat as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('sertifikat', $fileName, 'public');
                $employee->certificates()->create(['file_path' => $filePath]);
            }
        }

        session()->flash('success', 'Data Pegawai Berhasil Ditambahkan');
        $this->closeModalCreate();
        $this->resetInputFields();
    }


    public function update()
    {
        $employee = Employee::find($this->pegawai_id);

        $validatedData = $this->validate([
            'Updatenama' => 'required',
            'UpdateNIP' => 'required|unique:employee,NIP,' . $this->pegawai_id,
            'UpdateDivisi' => 'required',
            'Updatejabatan' => 'required',
            'UpdateunitKerja' => 'required',
            'UpdateSertifikat.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'Updateketerangan' => 'nullable',
        ],[
            'Updatenama.required' => 'Nama harus diisi',
            'UpdateNIP.required' => 'NIP harus diisi',
            'UpdateNIP.unique' => 'NIP sudah ada',
            'Updatejabatan.required' => 'Jabatan harus diisi',
            'UpdateunitKerja.required' => 'Unit Kerja harus diisi',
            'UpdateSertifikat.*.mimes' => 'Sertifikat harus dalam format: pdf, jpg, jpeg, atau png',
            'UpdateSertifikat.*.max' => 'Ukuran file sertifikat tidak boleh lebih dari 2MB',
        ]);

        // Hapus sertifikat lama jika diperlukan
        if ($this->UpdateSertifikat) {
            // Hapus sertifikat lama
            foreach ($employee->certificates as $certificate) {
                Storage::disk('public')->delete($certificate->file_path);
                $certificate->delete();
            }

            // Upload sertifikat baru
            foreach ($this->UpdateSertifikat as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('sertifikat', $fileName, 'public');
                $employee->certificates()->create(['file_path' => $filePath]);
            }
        }

        if ($employee) {
            $employee->update([
                'nama' => $this->Updatenama,
                'NIP' => $this->UpdateNIP,
                'divisi' => $this->UpdateDivisi,
                'jabatan' => $this->Updatejabatan,
                'unitKerja' => $this->UpdateunitKerja,
                'keterangan' => $this->Updateketerangan,
            ]);

            session()->flash('success', 'Data Pegawai Berhasil Diupdate');
            $this->closeModalUpdate();
        }
    }

    public function delete()
    {
        // Temukan pegawai berdasarkan ID
        $employee = Employee::find($this->pegawai_id);

        if ($employee) {
            // Hapus sertifikat yang terkait
            foreach ($employee->certificates as $certificate) {
                // Hapus file dari storage
                Storage::disk('public')->delete($certificate->file_path);
                // Hapus record sertifikat dari database
                $certificate->delete();
            }

            // Hapus data pegawai
            $employee->delete();

            session()->flash('success', 'Data Pegawai Berhasil Dihapus');
        } else {
            session()->flash('error', 'Data Pegawai Tidak Ditemukan');
        }

        $this->closeModalDelete();
    }    

    // Selected
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
        // Temukan pegawai yang dipilih
        $employees = Employee::whereIn('id', $this->selectedRows)->get();

        foreach ($employees as $employee) {
            // Hapus sertifikat yang terkait dengan pegawai
            foreach ($employee->certificates as $certificate) {
                // Hapus file sertifikat dari storage
                Storage::disk('public')->delete($certificate->file_path);
                // Hapus record sertifikat dari database
                $certificate->delete();
            }

            // Hapus data pegawai
            $employee->delete();
        }

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
        ],[
            'fileImport.required' => 'File import tidak boleh kosong',
            'fileImport.mimes' => 'Format file harus berupa xlsx atau xls'
        ]);        

        Excel::import(new EmployeesImport, $this->fileImport->getRealPath());
        // try {
        // } catch (\Exception $e) {
        //     $this->dispatchBrowserEvent($this->closeModalImport());
        //     session()->flash('error', 'Pastikan isian Excel yang diupload sesuai format!');
        //     return;
        // }

        session()->flash('success', 'Data berhasil diimport.');

        $this->closeModalImport();
    }
}
