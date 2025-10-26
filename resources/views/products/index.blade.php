<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if (isset($message))
        <div>
            {{ $message }}
        </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <x-nav-link class="text-blue-600 hover:text-blue-700" href="{{ route('product.new') }}">New product
                    </x-nav-link>
                </div>

                <div class="text-gray-900 p-2">
                    <table class="overflow-x-auto border border-slate-600 border-dashed">
                        <thead>
                            <tr class="border border-slate-600 border-dashed">
                                {{-- <th>ID</th> --}}
                                <th class="p-4">Name</th>
                                <th>Description</th>
                                <th>Brand</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Stock</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Options</th>
                                {{-- <th>Image</th> --}}
                            </tr>
                        </thead>

                        <tbody class="text-sm">
                            @forelse ($data['data'] as $p)
                            <tr>
                                {{-- <td class="p-4">{{ $p['id'] }}</td> --}}
                                <td class="p-4 border-b">
                                    <span class="font-semibold">
                                        {{ $p['name'] }}
                                    </span>
                                </td>
                                <td class="p-4 border-b">{{ $p['description'] }}</td>
                                <td class="p-4 border-b">{{ $p['brand_name'] }}</td>
                                <td class="p-4 border-b">{{ $p['product_type_name'] }}</td>
                                <td class="p-4 border-b">
                                    <span
                                        class="py-1 px-2 border border-green-400 bg-green-100 text-green-600 rounded-md font-normal capitalize">
                                        {{ $p['status'] }}
                                    </span>
                                </td>
                                <td class="p-4 border-b text-right">{{ $p['stock'] }}</td>
                                <td class="p-4 border-b text-right">{{ $p['sku'] }}</td>
                                <td class="p-4 border-b text-right">{{ number_format($p['price'],2) }}</td>
                                {{-- <td>
                                    @if (isset($p['images'][0]['original_url']))
                                    <img src="{{ $p['images'][0]['original_url'] }}" alt="image" height="35" width="35">
                                    @else
                                    -
                                    @endif
                                </td> --}}
                                <td class="p-4 border-b">
                                    <div x-data="{ open: false }" @click.away="open = false"
                                        class="relative inline-block text-left">

                                        <div>
                                            <button @click="open = !open" type="button"
                                                class="inline-flex items-center justify-center p-1 border border-transparent rounded-full text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                id="menu-button-{{ $p['id'] }}" aria-expanded="true"
                                                aria-haspopup="true">
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path
                                                        d="M10 3a1 1 0 100 2 1 1 0 000-2zM10 8a1 1 0 100 2 1 1 0 000-2zM10 13a1 1 0 100 2 1 1 0 000-2z" />
                                                </svg>
                                            </button>
                                        </div>

                                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                            x-transition:enter-start="transform opacity-0 scale-95"
                                            x-transition:enter-end="transform opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-75"
                                            x-transition:leave-start="transform opacity-100 scale-100"
                                            x-transition:leave-end="transform opacity-0 scale-95"
                                            class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10"
                                            role="menu" aria-orientation="vertical"
                                            aria-labelledby="menu-button-{{ $p['id'] }}" tabindex="-1">
                                            <div class="py-1" role="none">
                                                {{-- <a href="{{ route('items.edit', $item->id) }}" --}} <a href="#"
                                                    class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100"
                                                    role="menuitem" tabindex="-1" id="menu-item-0">
                                                    Editar
                                                </a>

                                                {{-- <form action="{{ route('items.destroy', $item->id) }}"
                                                    method="POST"> --}}
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
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">No hay productos aún.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
