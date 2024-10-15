<?php
namespace App\Livewire;

use App\Models\Category;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CategoryTable extends TableComponent
{
    public function query()
    {
        return Category::query();
    }

    public function columns(): array
    {
        return [
            Column::make('Category', 'category')
                ->sortable()
                ->searchable(),
        ];
    }
}
