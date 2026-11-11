<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between">
                        <div class="">
                            <h2 class="text-gray-900 text-lg">List of category</h2>
                        </div>
                        <div class="">
                            <x-primary-button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-new')" >Add new</x-primary-button>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="bg-white rounded-md overflow-hidden">
                        <table class="w-full">
                            <thead class="bg-red-700">
                                <tr class="text-white">
                                    <th class="px-8 py-4 text-start">Category Name</th>
                                    <th class="px-8 py-4 text-start">Total Item</th>
                                    <th class="px-8 py-4 text-start">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border border-b-1">
                                    <td class="px-8 py-4 text-start">Elektronik</td>
                                    <td class="px-8 py-4 text-start">10 Unit</td>
                                    <td class="px-8 py-4 text-start"><a href="">detail</a></td>
                                </tr>
                                <tr class="border border-b-1">
                                    <td class="px-8 py-4 text-start">Elektronik</td>
                                    <td class="px-8 py-4 text-start">10 Unit</td>
                                    <td class="px-8 py-4 text-start"><a href="">detail</a></td>
                                </tr>
                                <tr class="border border-b-1">
                                    <td class="px-8 py-4 text-start">Elektronik</td>
                                    <td class="px-8 py-4 text-start">10 Unit</td>
                                    <td class="px-8 py-4 text-start"><a href="">detail</a></td>
                                </tr>
                                <tr class="border border-b-1">
                                    <td class="px-8 py-4 text-start">Elektronik</td>
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


    <x-modal name="create-new" :show="false" focusable>
        <div class="p-8">
            <h3 class="text-slate-900">Create New Category</h3>
            <form action="" method="post">
                
            </form>
        </div>
    </x-modal>

</x-app-layout>
