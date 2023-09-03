<?php

namespace App\Livewire\Admin\Pages;

use Exception;
use Throwable;
use App\Models\File;
use Livewire\Component;
use App\Models\Statistic;
use App\Livewire\Traits\WithDataTable;

class StatisticLivewire extends Component
{
    use WithDataTable;
    
    public $dbModel;
    public $model;
    public $label, $file;
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
            'name'      => 'signed_minutes',
            'title'     => 'Expired in',
            'class'     => null,
            'style'     => null,
            'width'     => '15%',
            'sort'      => true,
            'search'    => true,
        ], [
            'name'      => 'ip',
            'title'     => 'IP',
            'class'     => null,
            'style'     => null,
            'width'     => '15%',
            'sort'      => false,
            'search'    => false,
        ], [
            'name'      => 'created_at',
            'title'     => 'Created At',
            'class'     => null,
            'style'     => null,
            'width'     => '15%',
            'sort'      => false,
            'search'    => false,
        ],
    ];

    public function mount($file_id)
    {
        $this->label    = "Statistics";
        $this->dbModel  = Statistic::class;
        $this->file     = File::findOrFail($file_id);
    }

    public function render()
    {
        $this->authorize('file_statistics');

        $rows = $this->dbModel::search($this->columns, $this->search)
            ->with('file')
            ->where('file_id', $this->file->id)
            ->orderBy($this->order_by, $this->direction)
        ->paginate($this->per_page);
        
        return view('livewire.admin.pages.statistics.index', compact('rows'))->layout('components.layouts.admin.app');
    }
}
