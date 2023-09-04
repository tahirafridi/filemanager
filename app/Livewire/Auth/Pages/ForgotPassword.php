<?php

namespace App\Livewire\Auth\Pages;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendPasswordResetNotification;

class ForgotPassword extends Component
{
    #[Rule('required|email')] 
    public $email;

    public function generatePasswordResetLink()
    {
        DB::beginTransaction();

        try {
            $user = User::where(['email' => $this->email])->first();

            if (!$user) {
                throw new Exception("We can't find a user with your provided email address, please try again with correct email.");
            }

            $token = Str::random(60);

            //  Create Password Reset Token
            $password_resets = DB::table('password_resets')
                                    ->insert([
                                        'email' => $this->email,
                                        'token' => $token,
                                        'created_at' => Carbon::now()
                                    ]);

            $user->password_reset_token = $token;

            Notification::send($user, new SendPasswordResetNotification($user));

            $this->reset('email');

            $this->dispatch('toastr', setToastrSettings('success', "We've sent you password reset link, please check your email."));

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function render()
    {
        return view('livewire.auth.pages.forgot-password')->layout('components.layouts.auth.app');
    }
}
