<?php

namespace App\Livewire\Admin\Pages;

use Exception;
use Throwable;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Livewire\Traits\WithDataTable;
use App\Notifications\NewUserNotification;
use Illuminate\Support\Facades\Notification;

class UserLivewire extends Component
{
    use WithDataTable;
    
    public $dbModel;
    public $model;
    public $label;
    public $name, $email, $status, $roles, $role;
    public $statuses    = ['Active', 'Inactive'];
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
            'name'      => 'email',
            'title'     => 'Email',
            'class'     => null,
            'style'     => null,
            'width'     => '20%',
            'sort'      => true,
            'search'    => true,
        ], [
            'name'      => 'role',
            'title'     => 'Role',
            'class'     => null,
            'style'     => null,
            'width'     => '5%',
            'sort'      => true,
            'search'    => true,
        ], [
            'name'      => 'status',
            'title'     => 'Status',
            'class'     => 'text-center',
            'style'     => 'color:#fff',
            'width'     => '5%',
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
        'name'      => 'required',
        'email'     => 'required|email|unique:users,email',
        'role'      => 'required',
        'status'    => 'required|in:Active,Inactive',
    ];

    public function mount()
    {
        $this->label    = "Users";
        $this->dbModel  = User::class;
    }

    public function create()
    {
        try {
            $this->authorize('user_create');

            $this->reset('name', 'email', 'status', 'role');

            $this->dispatch('showAddModal');
        } catch (Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function store()
    {
        DB::beginTransaction();
        
        try {
            $this->authorize('user_create');
    
            $validatedData = $this->validate();

            $passwordString = Str::random(6);
            $validatedData['password'] = Hash::make($passwordString);

            $row = $this->dbModel::create($validatedData);
            $row->syncRoles($this->role);

            $row->password_string = $passwordString;
            
            Notification::send($row, new NewUserNotification($row));

            $this->resetPage();

            $this->dispatch('closeAddModal');
            $this->dispatch('toastr', setToastrSettings('success', "Record successfully created!"));

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function edit(User $user)
    {
        try {
            $this->authorize('user_edit');
    
            $this->reset('name', 'email', 'status', 'role');

            $this->model = $user;
            
            $this->name = $this->model->name;
            $this->email = $this->model->email;
            $this->status = $this->model->status;
            $this->role = $this->model->roles()->first()->name ?? null;

            $this->dispatch('showEditModal');
        } catch (Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function update()
    {
        DB::beginTransaction();

        try {
            $this->authorize('user_edit');
    
            $this->rules['email'] = 'required|email|unique:users,email,' . $this->model->id;

            $validatedData = $this->validate();
            
            if ((auth()->user()->id == $this->model->id) && ($validatedData['status'] == 'Inactive')) {
                throw new \Exception("You can not inactivate your own account.");
            }

            $this->model->update($validatedData);

            $this->model->syncRoles($this->role);

            $this->dispatch('closeEditModal');
            $this->dispatch('toastr', setToastrSettings('success', "Record successfully updated!"));

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function delete(User $user)
    {
        try {
            $this->authorize('user_delete');
    
            $this->model = $user;

            if (isset($this->model->email, $this->model->name) AND ($this->model->id == auth()->user()->id)) {
                throw new Exception("Sorry! You can not delete your own account.");
            }

            $this->dispatch('showDeleteConfirmationModal');
        } catch (Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function confirmDelete()
    {
        try {
            $this->authorize('user_delete');
    
            $this->model->delete();
            $this->model = null;

            $this->dispatch('toastr', setToastrSettings('success', "Record succesfully deleted!"));
        } catch (Throwable $th) {
            $this->dispatch('toastr', setToastrSettings('error', $th->getMessage()));
        }
    }

    public function render()
    {
        $this->authorize('user_access');

        $this->roles = Role::all();
        $rows = $this->dbModel::search($this->columns, $this->search)->with('roles')->orderBy($this->order_by, $this->direction)->paginate($this->per_page);

        return view('livewire.admin.pages.users.index', compact('rows'))->layout('components.layouts.admin.app');
    }
}
