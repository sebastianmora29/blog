<x-layouts.publico>

    <article class="max-w-7xl mx-auto bg-white p-10 rounded shadow-lg">
        <img class="w-full h-150 object-cover object-center rounded mb-4" src="{{ $post->image }}" alt="">
        <h1 class="text-3xl text-gray-700 font-bold mb-4">{{ $post->titulo }}</h1>
        <div class="text-gray-700 space-y-4">
            {!! ($post->contenido) !!}
        </div>
        <a href="{{ route('posts.index') }}" class="text-blue-600 hover:underline mt-6 inline-block">← Volver al blog</a>
    </article>



</x-layouts.publico>
