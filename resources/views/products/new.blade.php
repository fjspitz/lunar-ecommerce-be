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
                <div class="p-6 text-3xl">
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
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                                type="text" id="name" name="name" value="{{ old('name') }}"
                                placeholder="El nombre del producto a publicar">
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
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                                id="description" value="{{ old('description') }}"
                                placeholder="Descripción ampliada del producto. Es el texto que aparecerá en la publicación."></textarea>
                            @error('description')
                            <div>
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>

                        <div class="flex space-x-4">
                            <div class="mt-4 w-1/2">
                                <x-input-label for="brand">
                                    <span class="text-red-600 font-bold">*</span>
                                    Marca
                                </x-input-label>

                                <select name="brand_id" id="brand"
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                                    <option value="">Sin marca</option>
                                    @foreach ($brands as $b)
                                    <option value="{{ $b['id'] }}">{{ $b['name'] }}</option>
                                    @endforeach
                                </select>

                                @error('brand_id')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-4 w-1/2">
                                <x-input-label for="category">
                                    <span class="text-red-600 font-bold">*</span>
                                    Categoría
                                </x-input-label>

                                <select name="product_type_id" id="category"
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                                    <option value="">Sin categoría</option>
                                    @foreach ($categories as $c)
                                    <option value="{{ $c['id'] }}">{{ $c['name'] }}</option>
                                    @endforeach
                                </select>

                                @error('product_type_id')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="sku">
                                <span class="text-red-600 font-bold">*</span>
                                SKU
                            </x-input-label>
                            <x-text-input id="sku" name="sku" value="{{ old('sku') }}" class="w-full"
                                placeholder="Ej.: DEPOR-XYZ-BLN-41" />
                            @error('sku')
                            <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- <div class="mt-4">
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" class="rounded border-gray-300 h-4 w-4">
                                <label class="font-medium text-gray-700">Publicar el precio con impuestos
                                    incluido.</label>
                            </div>
                        </div> --}}

                        <div class="mt-4 w-1/4">
                            <x-input-label for="stock">
                                <span class="text-red-600 font-bold">*</span>
                                Stock
                            </x-input-label>

                            <x-text-input type="number" min="0" step="1" id="stock" name="stock"
                                value="{{ old('stock') }}" class="w-full" />
                            @error('stock')
                            <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4 w-1/4">
                            <x-input-label for="precio">
                                <span class="text-red-600 font-bold">*</span>
                                Precio base
                            </x-input-label>

                            <div class="flex">
                                <div class="flex items-center px-4 bg-gray-300 text-white rounded-l">ARS</div>

                                <input
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm rounded-r-md"
                                    type="number" min="0" step="0.01" id="precio" name="price"
                                    value="{{ old('price') }}" class="w-full" />
                            </div>

                            @error('price')
                            <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-input-label for="imagen">
                                <span class="text-red-600 font-bold">*</span>
                                Imagen
                            </x-input-label>

                            <p class="p-2 text-sm text-gray-400">Lorem ipsum dolor sit amet consectetur
                                adipisicing
                                elit. Earum,
                                reprehenderit dolor dolorum commodi molestiae fugit id. Rem placeat quod quae suscipit,
                                corporis asperiores, unde nostrum repellendus vitae ipsum maxime minima.</p>

                            <input type="file" name="image" value="{{ old('image') }}"
                                class="border border-gray-300 w-1/4 rounded-r">

                            @error('image')
                            <div>
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <fieldset class="p-4 border border-slate-300 rounded flex-col">
                                <legend class="text-lg font-semibold px-2">Opciones de envio</legend>

                                <div class="mb-4">
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" class="rounded border-gray-300 h-4 w-4">
                                        <label class="font-medium text-gray-700">Enviable</label>
                                    </div>
                                </div>

                                <div class="flex space-x-4">
                                    <div class="mb-2">
                                        <label for="" class="font-medium text-sm text-gray-700 block">Longitud</label>
                                        <div class="flex">
                                            <input type="number" min="0" step="0.01"
                                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm rounded-l-md">
                                            <select name=""
                                                class="border-gray-300 shadow-sm rounded-r-md flex items-center px-4 bg-gray-300 text-white font-bold">
                                                <option value="m">m</option>
                                                <option value="mm">mm</option>
                                                <option value="cm">cm</option>
                                                <option value="ft">ft</option>
                                                <option value="in">in</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <label for="" class="font-medium text-sm text-gray-700  block">Anchura</label>
                                        <div class="flex">
                                            <input type="number" min="0" step="0.01"
                                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm rounded-l-md">

                                            <select name=""
                                                class="border-gray-300 shadow-sm rounded-r-md flex items-center px-4 bg-gray-300 text-white font-bold">
                                                <option value="m">m</option>
                                                <option value="mm">mm</option>
                                                <option value="cm">cm</option>
                                                <option value="ft">ft</option>
                                                <option value="in">in</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="flex space-x-4">
                                    <div class="mb-2">
                                        <label for="" class="font-medium text-sm text-gray-700 block">Altura</label>
                                        <div class="flex">
                                            <input type="number" min="0" step="0.01"
                                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm rounded-l-md">

                                            <select name=""
                                                class="border-gray-300 shadow-sm rounded-r-md flex items-center px-4 bg-gray-300 text-white font-bold">
                                                <option value="m">m</option>
                                                <option value="mm">mm</option>
                                                <option value="cm">cm</option>
                                                <option value="ft">ft</option>
                                                <option value="in">in</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="mb-2">
                                        <label for="" class="font-medium text-sm text-gray-700 block">Peso</label>

                                        <div class="flex">
                                            <input type="number" min="0" step="0.01"
                                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm rounded-l-md">

                                            <select name=""
                                                class="border-gray-300 shadow-sm rounded-r-md flex items-center px-4 bg-gray-300 text-white font-bold">
                                                <option value="m">m</option>
                                                <option value="mm">mm</option>
                                                <option value="cm">cm</option>
                                                <option value="ft">ft</option>
                                                <option value="in">in</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </fieldset>
                        </div>

                        <div class="flex space-x-2 justify-end">
                            <a href="{{ route('product.index') }}"
                                class="mt-4 inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold 
                                text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 
                                focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">Cancel</a>

                            <div class="mt-4">
                                <x-primary-button>Save</x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
