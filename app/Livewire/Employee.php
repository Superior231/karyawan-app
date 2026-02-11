<?php

namespace App\Livewire;

use App\Models\Employee as ModelsEmployee;
use App\Models\Position;
use Livewire\Component;
use Livewire\WithPagination;

class Employee extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $numberOfPaginatorsRendered = [];
    public $search = '';

    // Filter
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $currentFilter = 'Terbaru';
    
    public $typeFilter = 'All Positions';
    public $currentType = 'All Positions';

    public $positions;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($field == 'latest') {
            $this->sortField = 'joined_at';
            $this->sortDirection = 'desc';
            $this->currentFilter = 'Terbaru';
        } elseif ($field == 'longest') {
            $this->sortField = 'joined_at';
            $this->sortDirection = 'asc';
            $this->currentFilter = 'Terlama';
        } elseif ($field == 'az') {
            $this->sortField = 'name';
            $this->sortDirection = 'asc';
            $this->currentFilter = 'A - Z';
        }

        $this->resetPage();
    }

    public function typeBy($type)
    {
        $this->typeFilter = $type;
        $this->currentType = $type;
        $this->resetPage();
    }

    public function mount()
    {
        $this->positions = Position::orderBy('name', 'asc')->get();
    }

    public function render()
    {
        $query = ModelsEmployee::where('name', 'like', '%'.$this->search.'%');

        if ($this->typeFilter !== 'All Positions') {
            $query->where('position', 'like', '%'.$this->typeFilter.'%');
        }

        $employees = $query->orderBy($this->sortField, $this->sortDirection)->paginate(10);

        return view('livewire.employee', [
            'employees' => $employees,
            'currentFilter' => $this->currentFilter
        ]);
    }
}
