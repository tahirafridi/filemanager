<?php

namespace App\Livewire\Traits;

use Livewire\WithPagination;

trait WithDataTable
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $per_page = 10;
    public $search = null;
    public $order_by = 'id';
    public $direction = 'desc';

    public function sort($column)
    {
        $this->order_by = $column;
        $this->direction = $this->direction === 'desc' ? 'asc' : 'desc';
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
