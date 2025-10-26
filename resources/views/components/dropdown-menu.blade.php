<div>
    <div x-data="{ open: false }" @click.away="open = false" class="relative inline-block text-left">

        <div>
            <button @click="open = !open" type="button"
                class="inline-flex items-center justify-center p-1 border border-transparent rounded-full text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                id="menu-button-{{ $item_id }}" aria-expanded="true" aria-haspopup="true">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    aria-hidden="true">
                    <path
                        d="M10 3a1 1 0 100 2 1 1 0 000-2zM10 8a1 1 0 100 2 1 1 0 000-2zM10 13a1 1 0 100 2 1 1 0 000-2z" />
                </svg>
            </button>
        </div>

        <div x-show="open" x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10"
            role="menu" aria-orientation="vertical" aria-labelledby="menu-button-{{ $item_id }}" tabindex="-1">
            <div class="py-1" role="none">
                {{-- <a href="{{ route('items.edit', $item->id) }}" --}} <a href="#"
                    class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" tabindex="-1"
                    id="menu-item-0">
                    Editar
                </a>

                {{-- <form action="{{ route('items.destroy', $item->id) }}" method="POST"> --}}
                    <form action="#" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-red-600 w-full text-left block px-4 py-2 text-sm hover:bg-red-50"
                            role="menuitem" tabindex="-1" id="menu-item-1">
                            Eliminar
                        </button>
                    </form>
            </div>
        </div>
    </div><!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->
</div>
