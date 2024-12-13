<?php

namespace App\Livewire;

use App\Models\User;
use App\Traits\FiltersAndSorting;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Datatable extends Component
{
    use FiltersAndSorting;

    // Add Custom functions aside from mount

    public function mount()
    {
        // Implement default column sort and direction
        // Editable
        $this->sortBy = 'created_at';
        $this->sortDir = 'DESC';
    }


    public function deleteUser($userId)
    {
        sleep(2);
        // Find and delete the user by ID
        $user = User::findOrFail($userId);

        if ($user) {
            $user->delete();
            session()->flash('message', 'User deleted successfully!');
        }
    }

    public function render()
    {
        // Table headers and columns - columns from db table
        // Editable
        $theaders = [
            [
                'displayHeaderCol' => 'Name',
                'col' => 'name',
            ],
            [
                'displayHeaderCol' => 'Email',
                'col' => 'email',
            ],
            [
                'displayHeaderCol' => 'Role',
                'col' => 'is_admin',
            ],
            [
                'displayHeaderCol' => 'Joined',
                'col' => 'created_at',
            ],
            [
                'displayHeaderCol' => 'Last update',
                'col' => 'updated_at',
            ],
        ];


        $users = User::search($this->search)
            ->when($this->roleFilter != '', function ($query) {
                $query->where('is_admin', $this->roleFilter);
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);


        return view('livewire.datatable', [
            'users' => $users,
            'theaders' => $theaders
        ]);
    }
}
