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

            <span>Marca</span>
            <input type="checkbox" wire:model="columns" value="marca" checked/>

            <span>Categoria</span>
            <input type="checkbox" wire:model="columns" value="categoria" checked/>

            <span>Stock</span>
            <input type="checkbox" wire:model="columns" value="stock" checked/>

            <span>Ventas</span>
            <input type="checkbox" wire:model="columns" value="ventas" checked/>

            <span>estado</span>
            <input type="checkbox" wire:model="columns" value="estado" checked/>

            <span>Fecha de Creacion</span>
            <input type="checkbox" wire:model="columns" value="fecha" checked/>

            <span>Precio</span>
            <input type="checkbox" wire:model="columns" value="precio" checked/>

            <span>Editar</span>
            <input type="checkbox" wire:model="columns" value="editar" checked/>
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
                    @if(in_array('name' , $columns))
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nombre
                        </th>
                    @endif
                    @if(in_array('marca' , $columns))
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Marca
                    </th>
                    @endif
                    @if(in_array('categoria' , $columns))
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Categoría
                        </th>
                     @endif
                    @if(in_array('stock' , $columns))
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Stock
                    </th>
                    @endif
                    @if(in_array('ventas' , $columns))
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Ventas
                    </th>
                    @endif
                    @if(in_array('estado' , $columns))
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Estado
                    </th>
                    @endif
                    @if(in_array('fecha' , $columns))
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Fecha de Creacion
                    </th>
                    @endif
                    @if(in_array('precio' , $columns))
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Precio
                    </th>
                    @endif
                    @if(in_array('editar' , $columns))
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Editar</span>
                    </th>
                    @endif
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($products as $product)
                    @if(in_array('name' , $this->columns))
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
                        @endif
                        @if(in_array('marca' , $columns))
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $product->brand->name }}</div>
                        </td>
                        @endif
                        @if(in_array('categoria' , $columns))
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $product->subcategory->category->name }}</div>
                            <div class="text-sm text-gray-500">{{ $product->subcategory->name }}</div>
                        </td>
                        @endif
                        @if(in_array('stock' , $columns))
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
                        @endif
                        @if(in_array('ventas' , $columns))
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{$product->getSalesAttribute()}}</div>
                        </td>
                        @endif
                        @if(in_array('estado' , $columns))
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $product->status == 1 ? 'red' : 'green'
                            }}-100 text-{{ $product->status == 1 ? 'red' : 'green' }}-800">
                                {{ $product->status == 1 ? 'Borrador' : 'Publicado' }}
                            </span>
                        </td>
                        @endif
                        @if(in_array('fecha' , $columns))
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{$product->created_at}}</div>
                        </td>
                        @endif
                        @if(in_array('precio' , $columns))
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $product->price }} &euro;
                        </td>
                        @endif
                        @if(in_array('editar' , $columns))
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                        </td>
                        @endif
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
