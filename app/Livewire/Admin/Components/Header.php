<?php

namespace App\Livewire\Admin\Components;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Header extends Component
{
    public $form = [];

    public function editProfile()
    {
        try {
            $this->reset('form');

            $row = User::findOrFail(auth()->id());

            $this->form = $row->toArray();

            $this->dispatch('showEditProfileModal');
        } catch (\Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function updateProfile()
    {
        $validated_data = Validator::make($this->form, [
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,' . auth()->user()->id,
            'password'  => 'nullable|min:6|confirmed',
        ])->validate();

        try {
            if (isset($validated_data['password'])) {
                $validated_data['password'] = Hash::make($this->form['password']);
            }

            User::findOrFail(auth()->id())->update($validated_data);

            $this->dispatch('closeEditProfileModal');
            $this->dispatch('toastr', setToastrSettings('success', "Record succesfully updated!"));
        } catch (\Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.admin.components.header');
    }
}
