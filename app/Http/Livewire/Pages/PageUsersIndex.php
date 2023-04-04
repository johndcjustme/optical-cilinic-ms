<?php

namespace App\Http\Livewire\Pages;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\User;

use App\Traits\SharedVariables;
use App\Traits\Modal;

class PageUsersIndex extends Component
{
    use WithPagination;
    use SharedVariables;
    use Modal;

    public $i = 1;


    public function mount() 
    {
        $this->paginate = 70;
    }

    public function render()
    {
        $users = User::select(['id', 'name', 'email', 'facebook', 'mobile', 'created_at']);

        if (Auth::user()->hasRole('admin')) {
            $users->whereRoleIs(['admin','staff']);
        }
        if (Auth::user()->hasRole('staff')) {
            $users->whereRoleIs('staff');
        }


        if (!empty($this->search)) {
            $search = "%$this->search%";
            $users->where('name', 'like', $search);
        }

        return view('livewire.pages.page-users-index', [
            'users' => $users->get(),
        ]);
    }

    public function delete() {
        User::destroy([1,2]);
    }

    public function restore($id) {
        User::where('id', $id)->restore();
    }
}
