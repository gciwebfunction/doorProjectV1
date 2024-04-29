<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permission Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(isset($permissions))
                        <table class="table table-striped" id="productTable" style="width: 100%">
                            <thead>
                            <th>Permission Name</th>
                            <th>Slug</th>
                            <th>ID</th>
                            </thead>
                            <tbody>
                            @foreach($permissions as $permission)
                                <tr class="" style="cursor: pointer">
                                    <td class="d-none">{{$permission->id}}</td>
                                    <td>{{$permission->name}}</td>
                                    <td>{{$permission->slug}}</td>
                                    <td>{{$permission->id}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
