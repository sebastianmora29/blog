<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Categoria;

class CategoriaTable extends Component
{
    public function render()
    {

        return view('livewire.categoria-table', [
            'categorias' => Categoria::all(),
        ]);
    }
}

