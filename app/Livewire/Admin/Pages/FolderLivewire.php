<?php

namespace App\Livewire\Admin\Pages;

use Exception;
use Throwable;
use App\Models\Folder;
use Livewire\Component;
use App\Livewire\Traits\WithDataTable;

class FolderLivewire extends Component
{
    use WithDataTable;
    
    public $dbModel;
    public $model;
    public $label;
    public $name;
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
            'name'      => 'name',
            'title'     => 'Name',
            'class'     => null,
            'style'     => null,
            'width'     => '15%',
            'sort'      => true,
            'search'    => true,
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
        'name' => 'required',
    ];

    public function mount()
    {
        $this->label    = "Folders";
        $this->dbModel  = Folder::class;
    }

    public function create()
    {
        try {
            $this->authorize('folder_create');

            $this->reset('name', 'folder_id');

            $this->dispatch('setFocus', '#add_modal #name');
            $this->dispatch('showAddModal');
        } catch (Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function store()
    {
        try {
            $this->authorize('folder_create');

            $validatedData = $this->validate();

            $row = $this->dbModel::create($validatedData);

            $this->resetPage();

            $this->dispatch('closeAddModal');
            $this->dispatch('toastr', setToastrSettings('success', "Recrod successfully created!"));
        } catch (\Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function edit($id)
    {
        try {
            $this->authorize('folder_edit');

            $this->reset('name');

            $this->model = $this->dbModel::findOrFail($id);
            
            $this->name = $this->model->name;

            $this->dispatch('showEditModal');
        } catch (Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function update()
    {
        try {
            $this->authorize('folder_edit');

            $validatedData = $this->validate();
    
            $this->model->update($validatedData);

            $this->dispatch('closeEditModal');
            $this->dispatch('toastr', setToastrSettings('success', "Recrod successfully updated!"));
        } catch (\Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function delete($id)
    {
        try {
            $this->authorize('folder_delete');

            $this->model = $this->dbModel::findOrFail($id);

            $this->dispatch('showDeleteConfirmationModal');
        } catch (Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function confirmDelete()
    {
        try {
            $this->authorize('folder_delete');

            $this->model->delete();
            $this->model = null;

            $this->dispatch('toastr', setToastrSettings('success', "Record succesfully deleted!"));
        } catch (Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function render()
    {
        $this->authorize('folder_access');
        
        $rows = $this->dbModel::search($this->columns, $this->search)->orderBy($this->order_by, $this->direction)->paginate($this->per_page);

        return view('livewire.admin.pages.folders.index', compact('rows'))->layout('components.layouts.admin.app');
    }
}
