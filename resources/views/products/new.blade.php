<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- @if(isset($message))
        <div>
            {{ $message }}
        </div>
        @endif --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    New product
                </div>

                @if ($errors->any())
                <div class="p-6 alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li class="text-red-700">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="px-6">
                    <form action="{{ route('product.create') }}" method="POST" class="mb-4"
                        enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-input-label for="name">
                                <span class="text-red-600 font-bold">*</span>
                                Name
                            </x-input-label>
                            <input
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                type="text" id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                            <div>
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-input-label for="description">
                                <span class="text-red-600 font-bold">*</span>
                                Description
                            </x-input-label>

                            <textarea name="description"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                id="description" value="{{ old('description') }}"
                                placeholder="Descripción ampliada del producto. Es el texto que aparecerá en la publicación."></textarea>
                            @error('description')
                            <div>
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-input-label for="brand">
                                <span class="text-red-600 font-bold">*</span>
                                Marca
                            </x-input-label>

                            <select name="brand_id" id="brand"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Sin marca</option>
                                @foreach ($brands as $b)
                                <option value="{{ $b['id'] }}">{{ $b['name'] }}</option>
                                @endforeach
                            </select>

                            @error('brand_id')
                            <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-input-label for="category">
                                <span class="text-red-600 font-bold">*</span>
                                Categoría
                            </x-input-label>

                            <select name="product_type_id" id="category"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Sin categoría</option>
                                @foreach ($categories as $c)
                                <option value="{{ $c['id'] }}">{{ $c['name'] }}</option>
                                @endforeach
                            </select>

                            @error('product_type_id')
                            <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-input-label for="sku">
                                <span class="text-red-600 font-bold">*</span>
                                SKU
                            </x-input-label>
                            <x-text-input id="sku" name="sku" value="{{ old('sku') }}" />
                            @error('sku')
                            <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-input-label for="stock">
                                <span class="text-red-600 font-bold">*</span>
                                Stock
                            </x-input-label>
                            <x-text-input id="stock" name="stock" value="{{ old('stock') }}" />
                            @error('stock')
                            <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-input-label for="precio">
                                <span class="text-red-600 font-bold">*</span>
                                Precio base
                            </x-input-label>
                            <x-text-input id="precio" name="price" value="{{ old('price') }}" />
                            @error('price')
                            <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-input-label for="imagen">
                                <span class="text-red-600 font-bold">*</span>
                                Imagen
                            </x-input-label>

                            <p class="p-2 text-sm text-gray-400">Lorem ipsum dolor sit amet consectetur adipisicing
                                elit. Earum,
                                reprehenderit dolor dolorum commodi molestiae fugit id. Rem placeat quod quae suscipit,
                                corporis asperiores, unde nostrum repellendus vitae ipsum maxime minima.</p>

                            <input type="file" name="image" value="{{ old('image') }}">

                            @error('image')
                            <div>
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-primary-button>Save</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
