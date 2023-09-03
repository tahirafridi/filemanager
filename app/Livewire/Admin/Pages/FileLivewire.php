<?php

namespace App\Livewire\Admin\Pages;

use Exception;
use Throwable;
use App\Models\File;
use App\Models\Folder;
use App\Models\Setting;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Livewire\Traits\WithDataTable;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class FileLivewire extends Component
{
    use WithDataTable, WithFileUploads;
    
    public $dbModel;
    public $model;
    public $label;
    public $folder;
    public $name, $folder_id, $folders, $file, $shareUrl;
    public $files = [];
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
            'name'      => 'name',
            'title'     => 'Name',
            'class'     => null,
            'style'     => null,
            'width'     => '15%',
            'sort'      => true,
            'search'    => true,
        ], [
            'name'      => 'size',
            'title'     => 'Size',
            'class'     => null,
            'style'     => null,
            'width'     => '15%',
            'sort'      => false,
            'search'    => false,
        ], [
            'name'      => 'downloads',
            'title'     => 'Downloads',
            'class'     => null,
            'style'     => null,
            'width'     => '15%',
            'sort'      => false,
            'search'    => false,
        ], [
            'name'      => 'secret',
            'title'     => 'Secret',
            'class'     => null,
            'style'     => null,
            'width'     => '15%',
            'sort'      => false,
            'search'    => false,
        ], [
            'name'      => 'action',
            'title'     => 'Action',
            'class'     => 'text-center',
            'style'     => null,
            'width'     => '5%',
            'sort'      => false,
            'search'    => false,
        ],
    ];

    protected $rules = [
        'name'      => 'required',
        'folder_id' => 'required',
    ];

    public function mount($folder_id = null)
    {
        $this->label    = "Files";
        $this->dbModel  = File::class;
        $this->folders  = Folder::all();
        $this->folder   = $folder_id ? Folder::find($folder_id) : null;
        $this->shareUrl = null;
    }

    public function edit($id)
    {
        try {
            $this->authorize('file_edit');
    
            $this->reset('name', 'folder_id');

            $this->model = $this->dbModel::findOrFail($id);
            
            $this->name = $this->model->name;
            $this->folder_id = $this->model->folder_id;

            $this->dispatch('showEditModal');
        } catch (Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function update()
    {
        try {
            $this->authorize('file_edit');
    
            $validatedData = $this->validate();

            $this->model->update($validatedData);

            $this->dispatch('closeEditModal');
            $this->dispatch('toastr', setToastrSettings('success', "Recrod successfully updated!"));
        } catch (\Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }
    
    public function showShareForm($id)
    {
        try {
            $this->authorize('file_share');
    
            $this->model = $this->dbModel::findOrFail($id);
            $this->name = $this->model->name;

            $this->share();

            $this->dispatch('showSharegModal');
        } catch (Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function delete($id)
    {
        try {
            $this->authorize('file_delete');
    
            $this->model = $this->dbModel::findOrFail($id);

            $this->dispatch('showDeleteConfirmationModal');
        } catch (Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function confirmDelete()
    {
        try {
            $this->authorize('file_delete');
    
            $this->model->delete();
            $this->model = null;

            $this->dispatch('toastr', setToastrSettings('success', "Record succesfully deleted!"));
        } catch (Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function render()
    {
        $this->authorize('file_access');
        
        $rows = $this->dbModel::search($this->columns, $this->search)->with('folder:id,name')->withCount('statistics');

        if ($this->folder) {
            $rows = $rows->where('folder_id', $this->folder->id);
        }
         
        $rows = $rows->orderBy($this->order_by, $this->direction)->paginate($this->per_page);
        
        return view('livewire.admin.pages.files.index', compact('rows'))->layout('components.layouts.admin.app');
    }

    private function share()
    {
        $settings = Setting::all();
        
        $response = Http::withOptions(["verify" => false])->withHeaders(["Authorization" => "Bearer {$settings[0]->value}"])->post(url('') . "/api/share", [
            'fileKey'   => $this->model->secret,
            'minutes'   => $settings[1]->value,
            'ip'        => $_SERVER['REMOTE_ADDR'],
        ]);

        $response->throw();

        if (!$response->successful()) {
            throw new Exception("Something went wrong, please try again.");
        }

        $this->shareUrl = $response->object()->signedUrl;
    }
}
