<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

class UserTable extends Component
{
    use WithPagination;

    public $search      = '';
    public $roleFilter  = null;
    public $twoStep     = null;
    public $selected    = [];
    public $perPage     = 10;
    public $sortField   = 'id';
    public $sortDir     = 'desc';

    protected $listeners = [
        'new_user'    => '$refresh',
        'update_user' => 'editUser',
        'delete_user' => 'confirmDelete',
    ];

    public function updatingSearch()      { $this->resetPage(); }
    public function updatingRoleFilter()  { $this->resetPage(); }
    public function updatingTwoStep()     { $this->resetPage(); }

    /* ---------- core query ---------- */
    public function getRowsQueryProperty()
    {
        return User::query()
            ->when($this->search, fn($q) =>
                $q->where(function($q){
                    $q->where('name','like',"%{$this->search}%")
                      ->orWhere('email','like',"%{$this->search}%");
                }))
            ->when($this->roleFilter, fn($q) =>
                $q->where('role',$this->roleFilter))
            ->when($this->twoStep, fn($q) =>
                $q->where('two_factor_secret','!=',null))
            ->orderBy($this->sortField,$this->sortDir);
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate($this->perPage);
    }

    /* ---------- actions ---------- */
    public function sort($field)
    {
        $this->sortDir  = $this->sortField === $field && $this->sortDir==='asc' ? 'desc' : 'asc';
        $this->sortField = $field;
    }

    public function toggleSelectAll()
    {
        $this->selected = $this->selected ? [] : $this->rows->pluck('id')->toArray();
    }

    public function confirmDelete($userId)
    {
        User::findOrFail($userId)->delete();
        $this->dispatchBrowserEvent('deleted', ['message'=>'User deleted']);
    }

    public function deleteSelected()
    {
        User::whereIn('id',$this->selected)->delete();
        $this->reset('selected');
        $this->dispatchBrowserEvent('deleted', ['message'=>'Selected users deleted']);
    }

    public function export($format='excel')
    {
        return Excel::download(new UsersExport($this->rowsQuery->get()), "users.$format");
    }
    
    // Called from JS: Livewire.dispatch('update_user', userId)
    public function editUser(int $userId): void
    {
        // 1) emit an event to open an edit-modal, or
        // 2) load the user into a public $form property, etc.
        $this->dispatch('openEditUserModal', userId: $userId);
    }

    public function render()
    {
        return view('livewire.admin.users.user-table',[
            'users'=>$this->rows,
        ]);
    }
}