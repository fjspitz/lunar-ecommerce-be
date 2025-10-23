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
                    <x-nav-link href="{{ route('product.new') }}">New product</x-nav-link>
                </div>

                <div class="text-gray-900 p-6">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Brand</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Stock</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Image</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($data['data'] as $p)
                            <tr>
                                <td class="p-4">{{ $p['id'] }}</td>
                                <td class="p-4">{{ $p['name'] }}</td>
                                <td class="p-4">{{ $p['description'] }}</td>
                                <td class="p-4">{{ $p['brand_name'] }}</td>
                                <td class="p-4">{{ $p['product_type_name'] }}</td>
                                <td class="p-4">{{ $p['status'] }}</td>
                                <td class="p-4">{{ $p['stock'] }}</td>
                                <td class="p-4">{{ $p['sku'] }}</td>
                                <td class="p-4">{{ number_format($p['price'],2) }}</td>
                                <td>
                                    @if (isset($p['images'][0]['original_url']))
                                    <img src="{{ $p['images'][0]['original_url'] }}" alt="image" height="35" width="35">
                                    @else
                                    -
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">No hay productos aún.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="p-6" id="paginator">
                        <div class="flex justify-between">
                            <div class="flex-auto">
                                <a href="{{ $data['first_page_url'] }}">Primera página</a>
                            </div>
                            <div>
                                <a href="{{ $data['prev_page_url'] }}">Anterior</a>
                            </div>
                            <div class="flex-auto">
                                <p>Página actual: {{ $data['current_page'] }}</p>
                            </div>
                            <div>
                                <a href="{{ $data['next_page_url'] }}">Siguiente</a>
                            </div>

                            <div class="flex-auto">
                                <a href="{{ $data['last_page_url'] }}">Última página</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
