<?php

namespace App\Livewire\Admin\Pages;

use Exception;
use Throwable;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Spatie\Permission\Models\Role;
use App\Livewire\Traits\WithDataTable;
use Spatie\Permission\Models\Permission;

class RoleLivewire extends Component
{
    public $dbModel, $model, $label, $permissions;
    #[Rule('required')] 
    public $name;
    public $selectedPermissions = [];
    public $columns = [
        [
            'name'      => 'id',
            'title'     => 'ID',
            'class'     => null,
            'style'     => null,
            'width'     => '7%',
            'sort'      => false,
            'search'    => false,

        ], [
            'name'      => 'name',
            'title'     => 'Name',
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

    public function mount()
    {
        $this->label    = "Roles";
        $this->dbModel  = Role::class;
    }

    public function create()
    {
        try {
            $this->authorize('role_create');

            $this->reset('name', 'selectedPermissions');

            $this->permissions = Permission::all();

            $this->dispatch('showAddModal');
        } catch (\Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function store()
    {
        try {
            $this->authorize('role_create');

            $validatedData = $this->validate();

            $row = $this->dbModel::create($validatedData);

            $row->syncPermissions($this->selectedPermissions);

            $this->dispatch('closeAddModal');
            $this->dispatch('toastr', setToastrSettings('success', "Record successfully created!"));
        } catch (\Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function edit(Role $role)
    {
        try {
            $this->authorize('role_edit');

            $this->reset('name', 'selectedPermissions');

            $this->model = $role;

            $this->selectedPermissions = $this->model->permissions->pluck('id')->toArray();
            
            $this->name = $this->model->name;

            $this->permissions = Permission::all();

            $this->dispatch('showEditModal');
        } catch (Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function update()
    {
        try {
            $this->authorize('role_edit');

            $validatedData = $this->validate();
    
            $this->model->update($validatedData);

            $this->model->syncPermissions($this->selectedPermissions);

            $this->dispatch('closeEditModal');
            $this->dispatch('toastr', setToastrSettings('success', "Record successfully updated!"));
        } catch (\Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function render()
    {
        $this->authorize('role_access');
        
        $rows = $this->dbModel::all();

        return view('livewire.admin.pages.roles.index', compact('rows'))->layout('components.layouts.admin.app');
    }
}
