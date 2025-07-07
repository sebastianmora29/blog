<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Etiqueta;
use Illuminate\Http\Request;

class EtiquetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etiquetas = Etiqueta::all();
        return view('admin.etiquetas.index', compact('etiquetas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.etiquetas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|min:3|max:255|unique:etiquetas'
        ]);

        // Crear la categoría
    Etiqueta::create($data);

    session()->flash('swal', [
        'icon' => 'success',
        'title' => 'Bien hecho!',
        'text' => 'La etiqueta se ha creado correctamente'

    ]);

    return redirect()->route('admin.etiquetas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Etiqueta $etiqueta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etiqueta $etiqueta)
    {
        return view('admin.etiquetas.edit',compact('etiqueta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Etiqueta $etiqueta)
    {
        $data = $request->validate([
            'nombre' => 'required|string|min:3|max:255|unique:etiquetas,nombre,' . $etiqueta->id 
        ]);

        $etiqueta->update($data);

        session()->flash('swal', [
        'icon' => 'success',
        'title' => 'Bien hecho!',
        'text' => 'La etiqueta se ha actualizado correctamente'

    ]);

    return redirect()->route('admin.etiquetas.edit', $etiqueta);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etiqueta $etiqueta)
    {
        $etiqueta->delete();

        session()->flash('swal', [
        'icon' => 'success',
        'title' => 'Bien hecho!',
        'text' => 'La etiqueta se ha eliminado correctamente'

    ]);
    return redirect()->route('admin.etiquetas.index');
    }
    
}
