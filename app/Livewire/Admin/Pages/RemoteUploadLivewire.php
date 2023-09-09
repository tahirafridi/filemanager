<?php

namespace App\Livewire\Admin\Pages;

use Exception;
use Throwable;
use App\Models\Folder;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\RemoteUpload;
use App\Livewire\Traits\WithDataTable;

class RemoteUploadLivewire extends Component
{
    use WithDataTable;
    
    public $dbModel;
    public $model;
    public $label;
    public $folder_id, $folders, $urls;
    public $columns = [
        [
            'name'      => 'id',
            'title'     => 'ID',
            'class'     => null,
            'style'     => null,
            'width'     => '7%',
            'sort'      => true,
            'search'    => true,

        ], [
            'name'      => 'folder',
            'title'     => 'Folder',
            'class'     => null,
            'style'     => null,
            'width'     => '15%',
            'sort'      => false,
            'search'    => false,
        ], [
            'name'      => 'url',
            'title'     => 'URL',
            'class'     => null,
            'style'     => null,
            'width'     => '15%',
            'sort'      => true,
            'search'    => true,
        ], [
            'name'      => 'status',
            'title'     => 'Status',
            'class'     => null,
            'style'     => null,
            'width'     => '15%',
            'sort'      => true,
            'search'    => true,
        ],
    ];

    public function mount($folder_id = null)
    {
        $this->label    = "Remote Upload";
        $this->dbModel  = RemoteUpload::class;
        $this->folders  = Folder::all();
    }

    protected $rules = [
        'urls' => 'required',
    ];

    public function store()
    {
        try {
            $this->authorize('file_remote_upload');
            
            $validatedData = $this->validate();
            $urls = explode("\n", $this->urls);

            foreach ($urls as $url) {
                $row = RemoteUpload::create([
                    'folder_id' => $this->folder_id,
                    'url'       => $url,
                ]);
            }
            
            $this->reset('urls');
            $this->dispatch('toastr', setToastrSettings('success', "Record successfully created!"));
        } catch (\Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function render()
    {
        $this->authorize('file_remote_upload');

        $rows = $this->dbModel::search($this->columns, $this->search)
            ->with('folder')
            ->orderBy($this->order_by, $this->direction)
        ->paginate($this->per_page);

        return view('livewire.admin.pages.upload.remote', ['rows' => $rows])->layout('components.layouts.admin.app');
    }
}
