<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between">
                        <div class="">
                            <h2 class="text-gray-900 text-xl font-semibold">{{$category->category_name}}</h2>
                            <p class="text-gray-900 mt-2">List of items in the category {{$category->category_name}}</p>
                        </div>
                        <div class="">
                            <x-red-button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-new')" >Edit</x-red-button>
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
                                    <th class="px-8 py-4 text-start">Brand</th>
                                    <th class="px-8 py-4 text-start">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr class="border border-b-1">
                                        <td class="px-8 py-4 text-start">Nama Barang</td>
                                        <td class="px-8 py-4 text-start">10 Unit</td>
                                        <td class="px-8 py-4 text-start"><a href="">detail</a></td>
                                    </tr>                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <x-modal name="create-new" :show="$errors->any()" focusable>
        <div class="p-8">
            <h3 class="text-slate-900 text-lg font-semibold">Edit Category</h3>
            <form action="{{route('category.update', $category->uuid)}}" method="post">
                @csrf
                @method('put')
                <div class="py-6">
                    <label for="cat_name">Category Name</label>
                    <x-text-input type="text" name="cat_name" id="cat_name" class="block mt-1 w-full" required :value="old('cat_name', $category->category_name)" />
                    <x-input-error :messages="$errors->get('cat_name')" />
                </div>
                <div class="">
                    <x-red-button type="submit">Update</x-red-button>
                </div>
            </form>
        </div>
    </x-modal>

</x-app-layout>
