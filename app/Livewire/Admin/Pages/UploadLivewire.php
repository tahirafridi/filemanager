<?php

namespace App\Livewire\Admin\Pages;

use Exception;
use Throwable;
use App\Models\File;
use App\Models\Folder;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class UploadLivewire extends Component
{
    use WithFileUploads;
    
    public $dbModel;
    public $model;
    public $label;
    public $folder_id, $folders;
    public $files = [];

    public function mount($folder_id = null)
    {
        $this->label    = "Upload";
        $this->dbModel  = File::class;
        $this->folders  = Folder::all();
    }

    protected $rules = [
        'files.*' => 'required',
    ];

    public function store()
    {
        try {
            $this->authorize('file_upload');
            
            $validatedData = $this->validate();

            if (!count($this->files)) {
                throw new \Exception("No file(s) selected, please select file(s).");
            }

            foreach ($this->files as $file) {
                $row = File::create([
                    'folder_id' => $this->folder_id,
                    'name'      => $file->getClientOriginalName(),
                    'secret'    => Str::random(60) . $this->folder_id . uniqid(),
                ]);

                if ($file->isValid()) {
                    $row->copyMedia($file->path())->toMediaCollection('files');
                }
            }
            
            $this->reset('files');
            $this->dispatch('FilePondReset');
            $this->dispatch('toastr', setToastrSettings('success', "Recrod successfully created!"));
        } catch (\Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function render()
    {
        $this->authorize('file_upload');

        return view('livewire.admin.pages.upload.index')->layout('components.layouts.admin.app');
    }
}
