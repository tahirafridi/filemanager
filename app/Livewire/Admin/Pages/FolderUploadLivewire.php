<?php

namespace App\Livewire\Admin\Pages;

use Exception;
use Throwable;
use App\Models\Folder;
use App\Models\Setting;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\File as FileModel;
use Illuminate\Support\Facades\File;

class FolderUploadLivewire extends Component
{
    public $label, $setting, $folder_path, $folder_id, $folders;
    public $localFiles = [];
    public $selectedFiles = [];

    public function mount()
    {
        $this->label    = "Local Folder Upload";
        $this->folders  = Folder::all();
        $this->setting  = Setting::where('name', 'local_folder_path')->whereNotNull('value')->first();

        if ($this->setting) {
            $this->folder_path = $this->setting->value;
        }
    }

    public function getFiles()
    {
        try {
            $this->authorize('file_folder_upload');

            $this->selectedFiles = [];
            $this->localFiles = [];
            
            if (empty($this->folder_path)) {
                throw new Exception("Folder path should not be empty.");
            }

            $this->setting->update(['value' => $this->folder_path]);

            foreach (File::allFiles($this->folder_path) as $file) {
                $this->localFiles[] = [
                    'name'  => $file->getFilename(),
                    'path'  => $file->getPathname(),
                ];
            }
            
            $this->dispatch('toastr', setToastrSettings('success', "Local folder files successfully listed."));
        } catch (\Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function store()
    {
        try {
            $this->authorize('file_folder_upload');

            if (!count($this->selectedFiles)) {
                throw new Exception("No file(s) selected");
            }

            foreach ($this->selectedFiles as $key => $file) {
                $file = json_decode($file);

                $row = FileModel::create([
                    'folder_id' => $this->folder_id,
                    'name'      => $file->name,
                    'secret'    => Str::random(60) . $this->folder_id . uniqid(),
                ]);

                $row->addMedia($file->path)->toMediaCollection('files');

                $this->localFiles = array_filter($this->localFiles, function ($value) use ($file) {
                    return $value['name'] != $file->name;
                });
            }

            $this->dispatch('toastr', setToastrSettings('success', "Selected files successfully moved to system."));
        } catch (\Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function render()
    {
        $this->authorize('file_folder_upload');

        return view('livewire.admin.pages.upload.folder')->layout('components.layouts.admin.app');
    }
}
