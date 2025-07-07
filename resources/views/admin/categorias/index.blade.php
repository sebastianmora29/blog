<x-layouts.app :title="__('Dashboard')">

    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item :href="route('dashboard')">
            Admin
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>
            Categorias
        </flux:breadcrumbs.item>
        
    </flux:breadcrumbs>

    <div class="flex justify-end mb-4">
        <x-boton href="{{ route('admin.categorias.create') }}">
            Nuevo
        </x-boton>
    </div>

<x-table>
    <x-slot name="header">
        <th class="px-6 py-3">ID</th>
        <th class="px-6 py-3">Nombre</th>
        <th class="px-10 py-3 text-right">Editar</th>
    </x-slot>

    @foreach ($categorias as $categoria)
        <x-table.row>
            <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                {{ $categoria->id }}
            </th>
            <td class="px-6 py-4">
                {{ $categoria->nombre }}
            </td>
            
            <td class="px-6 py-4">
                <div class="flex justify-end space-x-2">
                    
                    <x-boton href="{{ route('admin.categorias.edit', $categoria) }}">
                        Editar
                    </x-boton>

                    <form class="delete-form" action="{{ route('admin.categorias.destroy', $categoria) }}" method="POST" >
                        @csrf
                        @method('DELETE')

                        <div class="flex justify-end">
                        <flux:button variant="danger" type="submit">
                        Eliminar
                        </flux:button>
                        </div>
                    </form>

                </div>
            </td>
            
        </x-table.row>
    @endforeach
</x-table>

    @push('js')

        <script>
            forms = document.querySelectorAll('.delete-form');

            forms.forEach(form => {
                form.addEventListener('submit', (e) => {
                    e.preventDefault();

                    Swal.fire({
                        title: "Estas seguro/a?",
                        text: "¡No podrás revertir esto!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Si, eliminar!",
                        cancelButtonText: "Cancelar",
                    }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        }
                    });
                })
            });
        </script>

    @endpush

</x-layouts.app>