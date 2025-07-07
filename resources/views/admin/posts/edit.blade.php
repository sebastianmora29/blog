<x-layouts.app :title="__('Categorias')">

    @push('css')

        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />

    @endpush

    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item :href="route('dashboard')">
            Admin
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('admin.posts.index')"> 
            Posts
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>
            Editar
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="w-full p-4 bg-[#171717] border border-gray-700 rounded-lg shadow-sm text-white">

        

        @if (session('success'))
            <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 border border-green-400 rounded">
                {{ session('success') }}
            </div>
        @endif


        @if ($errors->any())
            <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 border border-red-400 rounded">
                <strong>¡Ups! Hubo algunos errores:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="w-full" action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4 relative w-full aspect-video">
                
                <img id="imgPreview" class="w-full h-full object-cover object-center" src="{{ $post->img_path ? asset('storage/' . $post->img_path) : 'https://img.freepik.com/vector-premium/vector-icono-imagen-predeterminado-pagina-imagen-faltante-diseno-sitio-web-o-aplicacion-movil-no-hay-foto-disponible_87543-11093.jpg'}}" alt="">


                <div class="absolute top-4 right-4">
                    <label class="p-2 text-sm text-gray-700 bg-gray-100 border border-gray-400 rounded cursor-pointer">
                        Cambiar imagen
                        <input class="hidden" type="file" name="imagen" id="imagen" accept="image/*" onchange="previewImage(event, '#imgPreview')">
                    </label>
                </div>
            </div>
            
            <div class="mb-4">
                <label for="nombre" class="block mb-2 text-sm font-medium text-white">
                    Titulo
                </label>
                <input
                    type="text" id="titulo" name="titulo" value="{{ old('titulo', $post->titulo) }}" class="block w-full p-2.5 text-sm text-gray-900 bg-gray-50 border rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:focus:border-blue-500 {{ $errors->has('titulo') ? 'border-red-500' : 'border-gray-300 dark:border-gray-600' }}" placeholder="Escribe un titulo para el post" required />
                @error('Titulo')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="slug" class="block mb-2 text-sm font-medium text-white">
                    Slug
                </label>
                <input
                    type="text" id="slug" name="slug" value="{{ old('slug', $post->slug) }}" class="block w-full p-2.5 text-sm text-gray-900 bg-gray-50 border rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:focus:border-blue-500 {{ $errors->has('slug') ? 'border-red-500' : 'border-gray-300 dark:border-gray-600' }}" placeholder="Escribe el slug del post" required />
                @error('Slug')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
            <flux:select label="Categorias" name="categoria_id" >
                @foreach($categorias as $categoria)

                    <flux:select.option value="{{$categoria->id}}" >
                        {{$categoria->nombre}}
                    </flux:select.option>

                @endforeach
            </flux:select>
            </div>

            <div class="mb-4">
            <flux:textarea label='Resumen' name='extracto' >
                {{ old('extracto', $post->extracto)}}
            </flux:textarea>
            </div>

        

            <div>
                <p class="font-medium text-sm mb-1">Contenido</p>
                <div id="editor">{!! old('contenido', $post->contenido) !!}</div>
                    <textarea class="hidden" name="contenido" id="contenido"></textarea>

                </div>
            </div>

            <div >
                <p class="text-sm font-medium mb-2">Etiquetas</p>
                <ul>
                    @foreach($etiquetas as $etiqueta)
                    <li>
                        <label for=" ">
                            <input type="checkbox" name="etiquetas[]" value="{{$etiqueta->id}}" @checked(in_array($etiqueta->id, $post->etiquetas->pluck('id')->toArray()))>
                                {{$etiqueta->nombre}}

                        </label>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div >
                <p class="text-sm font-medium mb-2">Estado</p>
            
                <div class="mb-4 flex items-center space-x-6">
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="publicado" value="0" @checked(old('publicado', $post->publicado) == 0)>
                        <span>No publicado</span>
                    </label>
                </div>

                <div class="mb-4 flex items-center space-x-6">
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="publicado" value="1" @checked(old('publicado', $post->publicado) == 1)> 
                        <span>Publicado</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end mb-2">
                <flux:button variant="primary" type="submit">
                    Guardar
                </flux:button>
            </div>
        </form>
    </div>

    @push('js')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script>
        const quill = new Quill('#editor', {
            theme: 'snow'
        });

        // Copiar contenido al iniciar
        document.querySelector('#contenido').value = quill.root.innerHTML;

        // Copiar contenido al modificar
        quill.on('text-change', () => {
            document.querySelector('#contenido').value = quill.root.innerHTML;
        });
    </script>

    @endpush


</x-layouts.app>
