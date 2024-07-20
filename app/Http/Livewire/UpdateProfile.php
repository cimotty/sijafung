<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class UpdateProfile extends Component
{
    public $nama, $email, $kataSandiLama, $kataSandi, $konfirmasiKataSandi;
    public $showPassword = false;
    
    public function render()
    {
        $user = User::where('id', auth()->user()->id)->first();

        if($this->nama === null){
            $this->nama = $user->name;
        }
        if($this->email === null){
            $this->email = $user->email;
        }
        return view('livewire.update-profile');
    }

    public function update_profil()
    {
        $validatedData = $this->validate([
            'nama' => 'required',
            'email' => 'required',
        ]);
        
        auth()->user()->update([
            'name' => ($validatedData['nama']),
            'email' => ($validatedData['email'])
        ]);
        
            session()->flash('success', 'Data Profil Berhasil Diupdate');
    }

    public function toggleShowPassword()
    {
        $this->showPassword = !$this->showPassword;
    }

    public function update_sandi(){
        $validatedData = $this->validate([
            'kataSandiLama' => ['required', 'not_regex:/\s/'],
            'kataSandi' => ['required', 'not_regex:/\s/', 'min:5'],
            'konfirmasiKataSandi' => ['same:kataSandi'],
        ]);

        $currentPassword = auth()->user()->password;

        if (!Hash::check($validatedData['kataSandiLama'], $currentPassword)) {
            $this->addError('kataSandiLama', 'Kata sandi lama salah.');
            return;
        }

        auth()->user()->update([
            'password' => bcrypt($validatedData['kataSandi']),
        ]);

        $this->kataSandiLama = '';
        $this->kataSandi = '';
        $this->konfirmasiKataSandi = '';

        session()->flash('success', 'Kata sandi berhasil diperbarui!');
    }
}
