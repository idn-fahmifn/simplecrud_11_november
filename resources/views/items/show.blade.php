<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between">
                        <div class="">
                            <h2 class="text-gray-900 text-xl font-semibold">{{$item->item_name}}</h2>
                        </div>
                        <div class="">
                            <form action="{{route('items.destroy', $item->uuid)}}" method="post">
                                @csrf
                                @method('delete')
                                <x-primary-button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-new')" >Edit</x-primary-button>
                                <x-red-button type="submit" onclick="return confirm('are u sure?')" >Delete</x-red-button>
                            </form>
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
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <div class="">
                                <div class="py-2">
                                    <p class="font-bold">Item Name</p>
                                    <span class="font-sm">{{$item->item_name}}</span>
                                </div>
                                <div class="py-2">
                                    <p class="font-bold">Category</p>
                                    <span class="font-sm">{{$item->category->category_name}}</span>
                                </div>
                                <div class="py-2">
                                    <p class="font-bold">Brand</p>
                                    <span class="font-sm">{{$item->brand}}</span>
                                </div>
                                <div class="py-2">
                                    <p class="font-bold">Stock</p>
                                    <span class="font-sm">{{$item->stock}} unit {{ $item->stock <= 5 ? ' | stock menipis!' : '' }} </span>
                                </div>
                                <div class="py-2">
                                    <p class="font-bold">Item Description</p>
                                    <span class="font-sm">{{$item->desc}}</span>
                                </div>
                                
                            </div>
                            <div class="border border-dashed rounded-md grid justify-center">
                                <img src="{{asset('storage/images/items/'.$item->image)}}" alt="Image Item" class="img-fluid" width="200px" height="auto">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <x-modal name="create-new" :show="$errors->any()" focusable>
        <div class="p-8">
            <h3 class="text-slate-900 text-lg font-semibold">Edit Item</h3>
            <form action="{{route('items.update', $item->uuid)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="py-2">
                    <label for="item_name">Item Name</label>
                    <x-text-input type="text" name="item_name" id="item_name" class="block mt-1 w-full" required :value="old('item_name', $item->item_name)" />
                    <x-input-error :messages="$errors->get('item_name')" />
                </div>
                <div class="py-2">
                    <label for="brand">Brand</label>
                    <x-text-input type="text" name="brand" id="brand" class="block mt-1 w-full" required :value="old('brand', $item->brand)" />
                    <x-input-error :messages="$errors->get('brand')" />
                </div>
                <div class="py-2">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option value="" disabled>Choose Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category') ?? $category->id)>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('category')" />
                </div>
                <div class="py-2">
                    <label for="stock">Stock</label>
                    <x-text-input type="number" name="stock" id="stock" class="block mt-1 w-full" required :value="old('stock', $item->stock)" />
                    <x-input-error :messages="$errors->get('stock')" />
                </div>
                <div class="py-2">
                    <label for="image">Image</label>
                    <img src="{{asset('storage/images/items/'.$item->image)}}" alt="Image Item" class="img-fluid" width="60px" height="auto">
                    <x-text-input type="file" name="image" id="image" class="block mt-1 w-full py-4 px-2 border border-dashed" :value="old('image')" />
                    <x-input-error :messages="$errors->get('image')" />
                </div>
                <div class="py-2">
                    <label for="description">Description</label>
                    <textarea name="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="description">{{old('description', $item->desc)}}</textarea>
                    <x-input-error :messages="$errors->get('description')" />
                </div>
                <div class="py-4">
                    <x-red-button type="submit">Add</x-red-button>
                </div>
            </form>
        </div>
    </x-modal>

</x-app-layout>
