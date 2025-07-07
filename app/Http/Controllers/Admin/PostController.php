<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Etiqueta;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();

        return view('admin.posts.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required',
            'slug' => 'required|unique:posts',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        $data['user_id'] = auth()->id();

        $post = Post::create($data);

        session()->flash('swal', [
        'icon' => 'success',
        'title' => 'Bien hecho!',
        'text' => 'El post se ha creado correctamente'

    ]);

        return redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categorias = Categoria::all();
        $etiquetas = Etiqueta::all();
        return view('admin.posts.edit', compact('post', 'categorias', 'etiquetas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        
        $data = $request->validate([
            'titulo' => 'required',
            'slug' => 'required|unique:posts,slug,'.$post->id,
            'categoria_id' => 'required|exists:categorias,id',
            'extracto' => 'nullable',
            'contenido' => 'nullable',
            'imagen' => 'nullable|image',
            'etiquetas' => 'nullable|array',
            'etiquetas.*' => 'exists:etiquetas,id',
            'publicado' => 'nullable|boolean'
        ]);

        if ($request->hasFile('imagen')) {

            if ($post->img_path) {
                Storage::delete($post->img_path);
            }


            $data ['img_path'] = Storage::put('posts', $request->imagen);
        }

        $post->update($data);

        $post->etiquetas()->sync($data['etiquetas'] ?? []);

        session()->flash('swal', [
        'icon' => 'success',
        'title' => 'Bien hecho!',
        'text' => 'El post se ha actualizado correctamente'

    ]);

        return redirect()->route('admin.posts.edit', $post);
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

        if ($post->img_path) {
                Storage::delete($post->img_path);
            }

        $post->delete();

        session()->flash('swal', [
        'icon' => 'success',
        'title' => 'Bien hecho!',
        'text' => 'El post se ha eliminado correctamente'

    ]);
    return redirect()->route('admin.posts.index');
    }
    
}
