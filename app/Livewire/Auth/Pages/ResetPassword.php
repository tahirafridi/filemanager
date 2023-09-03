<?php

namespace App\Livewire\Auth\Pages;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPassword extends Component
{
    public $token;
    public $email;
    public $password;
    public $password_confirmation;
    private $minutes = 30;

    public function mount($token)
    {
        $this->token = $token;
    }

    public function resetPassword()
    {
        $this->validate([
            'email'     => 'required|email',
            'password'  => 'required|confirmed|min:6',
        ]);

        DB::beginTransaction();

        try {
            $user = User::where(['email' => $this->email])->first();

            if (!$user) {
                throw new Exception("We can't find a user with your provided email address, please try again with correct email.");
            }

            $passwordReset = DB::table('password_resets')->where(['email' => $user->email, 'token' => $this->token])->first();

            if (!$passwordReset) {
                throw new Exception("Password reset token not found, please retry forgot password option.");
            }

            if (Carbon::now() >= Carbon::parse($passwordReset->created_at)->addMinutes($this->minutes)) {
                throw new Exception("Password reset token has expired, please retry forgot password option.");
            }

            $user->password = Hash::make($this->password);

            $user->save();

            DB::table('password_resets')
                ->where(['token' => $this->token])
                ->update([
                    'created_at' => Carbon::parse($passwordReset->created_at)->subHours(2),
                ]);

            session()->flash('success', "Password has reset sucessfully.");

            DB::commit();

            return $this->redirect(route('login'), navigate: true);
        } catch (\Throwable $th) {
            DB::rollBack();

            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function render()
    {
        return view('livewire.auth.pages.reset-password')->layout('components.layouts.auth.app');
    }
}
