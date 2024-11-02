<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category; // Asegúrate de importar tu modelo

class CategoryTable extends Component
{
    use WithPagination;

    public $search = '';
    public $categoryName; // Para almacenar el nombre de la nueva categoría
    public $categoryId; // Para almacenar el ID de la categoría que se está editando
    public $isOpen = false; // Para manejar el estado del modal
    public $isEditMode = false; // Para manejar el modo de edición


    public function addCategory()
    {
        $this->validate([
            'categoryName' => 'required|string|max:255',
        ]);

        Category::create(['category' => $this->categoryName]); // Guardar la nueva categoría

        // Reiniciar el campo y cerrar el modal
        $this->categoryName = '';
        $this->isOpen = false;

        session()->flash('message', 'Categoría agregada con éxito.');
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        $categories = Category::where('category', 'like', '%' . $this->search . '%')
            ->paginate(9);

        return view('livewire.category-table', [
            'categories' => $categories,
        ]);
    }
    public function edit($id)
    {
        $this->isOpen = true;
        $this->isEditMode = true;

        // Cargar la categoría que se va a editar
        $category = Category::find($id);
        $this->categoryId = $category->id; // Guardar el ID de la categoría
        $this->categoryName = $category->category; // Cargar el nombre de la categoría

    }

    public function updateCategory()
    {
        $this->validate([
            'categoryName' => 'required|string|max:255',
        ]);

        $category = Category::find($this->categoryId);
        $category->update(['category' => $this->categoryName]);

        $this->resetForm();
        session()->flash('message', 'Categoría actualizada con éxito.');
    }

    public function resetForm()
    {
        $this->categoryName = '';
        $this->isOpen = false;
        $this->isEditMode = false;
    }


    public function delete($id)
    {
        Category::destroy($id);
        session()->flash('message', 'Categoría eliminada con éxito.');
    }
}
