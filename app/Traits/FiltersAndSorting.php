<?php
// app/Traits/Sortable.php
namespace App\Traits;

use Livewire\Attributes\Url;
use Livewire\WithPagination;


trait FiltersAndSorting
{
    use WithPagination;

    #[Url()]
    public $search = '';

    #[Url()]
    public $perPage = 5;

    #[Url()]
    public $roleFilter = '';

    #[Url()]
    public $sortBy = '';

    #[Url()]
    public $sortDir = '';

    public function updatedSearch()
    {
        sleep(1);
        $this->resetPage();
    }

    public function setSortBy($sortBy)
    {
        if ($this->sortBy == $sortBy) {
            $this->sortDir = ($this->sortDir == 'ASC') ? 'DESC' : 'ASC';
            return;
        }

        $this->sortBy = $sortBy;
        $this->sortDir = 'DESC';
    }
}
