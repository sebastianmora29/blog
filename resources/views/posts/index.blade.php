<x-layouts.publico>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        @foreach($posts as $post)
            <article class="bg-white rounded shadow-lg overflow-hidden">
                <img class="h-60 w-full object-cover object-center" src="{{ $post->image }}" alt="">
                <div class="p-4 text-gray-800">
                    <h2 class="font-bold text-lg mb-2">
                        <a href="{{ route('posts.show', $post) }}" class="hover:underline text-black">
                            {{ $post->titulo }}
                        </a>
                    </h2>
                    <p class="text-sm text-gray-700">
                        {{ $post->extracto }}
                    </p>
                </div>
            </article>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $posts->links() }}
    </div>

</x-layouts.publico>

