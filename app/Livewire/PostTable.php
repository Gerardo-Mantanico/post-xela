<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class PostTable extends PowerGridComponent
{
    public string $tableName = 'post-table-cq1gy3-table';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Post::query()->orderBy('id_post'); // Asegúrate de usar id_post
    }


    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id_post')
            ->add('id_user')
            ->add('title')
            ->add('date_event_formatted', fn(Post $model) => Carbon::parse($model->date_event)->format('d/m/Y'))
            ->add('time_event')
            ->add('capacity')
            ->add('confirmed')
            ->add('address')
            ->add('description')
            ->add('id_category')
            ->add('state_publication')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id post', 'id_post'),
            Column::make('Id user', 'id_user'),
            Column::make('Title', 'title')
                ->sortable()
                ->searchable(),

            Column::make('Date event', 'date_event_formatted', 'date_event')
                ->sortable(),

            Column::make('Time event', 'time_event')
                ->sortable()
                ->searchable(),

            Column::make('Capacity', 'capacity')
                ->sortable()
                ->searchable(),

            Column::make('Confirmed', 'confirmed')
                ->sortable()
                ->searchable(),

            Column::make('Address', 'address')
                ->sortable()
                ->searchable(),

            Column::make('Description', 'description')
                ->sortable()
                ->searchable(),

            Column::make('Id category', 'id_category'),
            Column::make('State publication', 'state_publication')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('date_event'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    public function actions(Post $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: ' . $row->id_post)
                //->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id_post])
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
