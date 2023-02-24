<div>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                Lista de productos 2
            </h2>

            <x-button-link class="ml-auto" href="{{route('admin.products.create')}}">
                Agregar producto
            </x-button-link>
        </div>

    </x-slot>


    <div class="mt-5 ml-5">
        <x-jet-label value="Mostras Usuario" />
        <label>
            <select class="form-control" wire:model="pageNum">
                <option value="" selected disabled>Seleccione una numero</option>
                @foreach($pages as $page)
                    <option value="{{ $page }}">{{ $page }}</option>
                @endforeach
            </select>
        </label>
    </div>

    <div class="mt-5 ml-5">
        <label>
            <span>Nombre</span>
            <input type="checkbox" wire:model="columns" value="name" checked/>
        </label>
        <label>
            <span>Marca</span>
            <input type="checkbox" wire:model="columns" value="marca" checked/>
        </label>
        <label>
            <span>Categoria</span>
            <input type="checkbox" wire:model="columns" value="categoria" checked/>
        </label>
        <label>
            <span>Stock</span>
            <input type="checkbox" wire:model="columns" value="stock" checked/>
        </label>
        <label>
            <span>Vetas</span>
            <input type="checkbox" wire:model="columns" value="vetas" checked/>
        </label>
        <label>
            <span>estado</span>
            <input type="checkbox" wire:model="columns" value="estado" checked/>
        </label>
        <label>
            <span>Fecha de Creacion</span>
            <input type="checkbox" wire:model="columns" value="fecha" checked/>
        </label>
        <label>
            <span>Precio</span>
            <input type="checkbox" wire:model="columns" value="precio" checked/>
        </label>
    </div>

    <x-table-responsive>
        <div class="px-6 py-4">
            <x-jet-input class="w-full"
                         wire:model="search"
                         type="text"
                         placeholder="Introduzca el nombre del producto a buscar" />
        </div>

        @if($products->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Marca
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Categoría
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Stock
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Ventas
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Estado
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Fecha de Creacion
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Precio
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Editar</span>
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($products as $product)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 object-cover">
                                    <img class="h-10 w-10 rounded-full" src="{{ $product->images->count() ? Storage::url($product->images->first()->url) : 'img/default.jpg'  }}" alt="">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $product->name }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $product->brand->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $product->subcategory->category->name }}</div>
                            <div class="text-sm text-gray-500">{{ $product->subcategory->name }}</div>
                        </td>
                        @if($product->subcategory->color && $product->subcategory->size)
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{$product->stock}}</div>
                            </td>
                        @elseif($product->subcategory->color && !$product->subcategory->size)
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{$product->stock}}</div>
                            </td>
                        @else
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{$product->stock}}</div>
                            </td>
                        @endif
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{$product->getSalesAttribute()}}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $product->status == 1 ? 'red' : 'green'
                            }}-100 text-{{ $product->status == 1 ? 'red' : 'green' }}-800">
                                {{ $product->status == 1 ? 'Borrador' : 'Publicado' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{$product->created_at}}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $product->price }} &euro;
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="px-6 py-4">
                No existen productos coincidentes
            </div>
        @endif

        @if($products->hasPages())
            <div class="px-6 py-4">
                {{ $products->links() }}
            </div>
        @endif
    </x-table-responsive>
</div>
