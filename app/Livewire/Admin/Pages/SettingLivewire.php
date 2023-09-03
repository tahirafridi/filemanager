<?php

namespace App\Livewire\Admin\Pages;

use Exception;
use Throwable;
use App\Models\User;
use App\Models\Setting;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class SettingLivewire extends Component
{
    use WithFileUploads;
    
    public $label;
    public $user;
    public $settings;
    public $apiToken;
    public $minutes;
    public $logo;

    public function mount()
    {
        $this->label    = "Settings";
        $this->user     = User::find(auth()->user()->id);
        $this->settings = Setting::all();
        $this->apiToken = $this->settings[0]->value ?? '';
        $this->minutes  = $this->settings[1]->value ?? '';
    }

    public function createApiToken()
    {
        try {
            $this->authorize('setting_edit');
            
            $this->user->tokens()->delete();

            $this->apiToken = preg_replace('/(\d+)\|/i', '', $this->user->createToken('wp_token')->plainTextToken);
            $this->settings[0]->update(['value' => $this->apiToken]);

            $this->dispatch('toastr', setToastrSettings('success', "API token generated successfully."));
        } catch (\Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function saveMinutes()
    {
        try {
            $this->authorize('setting_edit');

            $this->settings[1]->update(['value' => $this->minutes]);

            $this->dispatch('toastr', setToastrSettings('success', "Record successfully saved."));
        } catch (\Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
        
    }

    public function saveLogo()
    {
        try {
            $this->authorize('setting_edit');

            if (!$this->logo) {
                throw new Exception("Please select logo file");
            }

            $this->logo->storeAs('photos', $this->logo->getClientOriginalName());

            $this->settings[2]->update(['value' => $this->logo->getClientOriginalName()]);

            $this->reset('logo');

            $this->dispatch('toastr', setToastrSettings('success', "Record successfully saved."));
        } catch (\Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
        
    }

    public function render()
    {
        $this->authorize('setting_access');

        return view('livewire.admin.pages.settings.index')->layout('components.layouts.admin.app');
    }
}
