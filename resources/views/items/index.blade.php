<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Items') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between">
                        <div class="">
                            <h2 class="text-gray-900 text-lg">List of items</h2>
                        </div>
                        <div class="">
                            <x-red-button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-new')" >Add new</x-red-button>
                        </div>
                    </div>
                </div>
                <div class="p-6">

                    @if(session('status'))
                    <div class="">
                        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)" class="flex items-center justify-between p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg">
                            <p><strong>Success!</strong> {{session('status')}} </p>
                            <button @click="show = false" class="font-bold text-lg leading-none">&times;</button>
                        </div>
                    </div>
                    @endif

                    <div class="bg-white rounded-md overflow-hidden">
                        <table class="w-full">
                            <thead class="bg-red-700">
                                <tr class="text-white">
                                    <th class="px-8 py-4 text-start">Item Name</th>
                                    <th class="px-8 py-4 text-start">Stock</th>
                                    <th class="px-8 py-4 text-start">Category</th>
                                    <th class="px-8 py-4 text-start">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                    <tr class="border border-b-1">
                                        <td class="px-8 py-4 text-start">{{ $item->item_name }}</td>
                                        <td class="px-8 py-4 text-start">{{$item->stock}} unit</td>
                                        <td class="px-8 py-4 text-start">{{$item->category->category_name}}</td>
                                        <td class="px-8 py-4 text-start"><a href="{{route('items.show', $item->uuid)}}">detail</a></td>
                                    </tr>
                                @empty
                                    <tr class="border border-b-1">
                                        <td colspan="4" class="px-8 py-4 text-center">Empty Item</td>
                                    </tr>
                                @endforelse
                                
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $items->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <x-modal name="create-new" :show="$errors->any()" focusable>
        <div class="p-8">
            <h3 class="text-slate-900 text-lg font-semibold">Create New Item</h3>
            <form action="{{route('items.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="py-2">
                    <label for="item_name">Item Name</label>
                    <x-text-input type="text" name="item_name" id="item_name" class="block mt-1 w-full" required :value="old('item_name')" />
                    <x-input-error :messages="$errors->get('item_name')" />
                </div>
                <div class="py-2">
                    <label for="brand">Brand</label>
                    <x-text-input type="text" name="brand" id="brand" class="block mt-1 w-full" required :value="old('brand')" />
                    <x-input-error :messages="$errors->get('brand')" />
                </div>
                <div class="py-2">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option value="" disabled>Choose Category</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('category')" />
                </div>
                <div class="py-2">
                    <label for="stock">Stock</label>
                    <x-text-input type="number" name="stock" id="stock" class="block mt-1 w-full" required :value="old('stock')" />
                    <x-input-error :messages="$errors->get('stock')" />
                </div>
                <div class="py-2">
                    <label for="image">Image</label>
                    <x-text-input type="file" name="image" id="image" class="block mt-1 w-full py-4 px-2 border border-dashed" required :value="old('image')" />
                    <x-input-error :messages="$errors->get('image')" />
                </div>
                <div class="py-2">
                    <label for="description">Description</label>
                    <textarea name="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="description">{{old('description')}}</textarea>
                    <x-input-error :messages="$errors->get('description')" />
                </div>
                <div class="py-4">
                    <x-red-button type="submit">Add</x-red-button>
                </div>
            </form>
        </div>
    </x-modal>

</x-app-layout>
