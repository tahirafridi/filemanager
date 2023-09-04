<?php

namespace App\Livewire\Auth\Pages;

use Exception;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    #[Rule('required|email')] 
    public $email;
    #[Rule('required')] 
    public $password;
    public $remember = false;

    public function mount()
    {
        if (auth()->user()) {
            return $this->redirect(session()->pull('url.intended', route('admin.index')), navigate: false);
        }
    }

    public function login()
    {
        $this->validate();
        
        try {
            $auth = Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember);
            
            if ($auth) {
                return $this->redirect(session()->pull('url.intended', route('admin.index')), navigate: false);
            }

            throw new Exception("Login failed! Please try again with valid login credentails.");
        } catch (\Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function render()
    {
        return view('livewire.auth.pages.login')->layout('components.layouts.auth.app');
    }
}
