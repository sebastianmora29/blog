<x-layouts.app :title="__('Categorias')">

    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item :href="route('dashboard')">
            Admin
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('admin.categorias.index')"> 
            Categorias
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>
            Nuevo
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

        <form class="w-full" action="{{ route('admin.categorias.store') }}" method="POST">
            @csrf

            
            <div class="mb-4">
                <label for="nombre" class="block mb-2 text-sm font-medium text-white">
                    Nombre
                </label>
                <input
                    type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" class="block w-full p-2.5 text-sm text-gray-900 bg-gray-50 border rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:focus:border-blue-500 {{ $errors->has('nombre') ? 'border-red-500' : 'border-gray-300 dark:border-gray-600' }}" placeholder="Ingresa una categoría" required />
                @error('nombre')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end mb-2">
                <flux:button variant="primary" type="submit">
                    Guardar
                </flux:button>
            </div>
        </form>
    </div>

</x-layouts.app>
