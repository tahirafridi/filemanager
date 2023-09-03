<?php

namespace App\Livewire\Admin\Pages;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DashboardLivewire extends Component
{
    public $dashboard = [];

    public function mount()
    {
        $this->dashboard['users_count'] = DB::table('users')->count();
        $this->dashboard['folders_count'] = DB::table('folders')->count();
        $this->dashboard['files_count'] = DB::table('files')->count();
        $this->dashboard['downloads_count'] = DB::table('statistics')->count();
        $this->dashboard['total_filesize'] = DB::table('media')->sum('size');
    }
    
    public function render()
    {
        if (session('error')) {
            $this->dispatch('toastr', setToastrSettings('error', session('error')));
        }

        return view('livewire.admin.pages.dashboard')->layout('components.layouts.admin.app');
    }
}
