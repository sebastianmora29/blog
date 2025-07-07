<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::orderBy('id', 'desc')
                        ->get();

        return view('admin.categorias.index',compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categorias.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validado = $request->validate([
            'nombre' => 'required|string|min:3|max:255'
        ]);

        // Crear la categoría
    Categoria::create($validado);

    session()->flash('swal', [
        'icon' => 'success',
        'title' => 'Bien hecho!',
        'text' => 'La categoria se ha creado correctamente'

    ]);

    // Redireccionar con mensaje
    return redirect()->route('admin.categorias.index')->with('success', 'Categoría creada exitosamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        return view('admin.categorias.edit',compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
            $validado = $request->validate([
            'nombre' => 'required|string|min:3|max:255'
        ]);

        // Crear la categoría
    $categoria->update($validado);

    session()->flash('swal', [
        'icon' => 'success',
        'title' => 'Bien hecho!',
        'text' => 'La categoria se ha actualizado correctamente'

    ]);

    // Redireccionar con mensaje
    return redirect()->route('admin.categorias.index')->with('success', 'Categoría creada exitosamente.');

    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        session()->flash('swal', [
        'icon' => 'success',
        'title' => 'Bien hecho!',
        'text' => 'La categoria se ha eliminado correctamente'

    ]);
    return redirect()->route('admin.categorias.index');
    }
}
