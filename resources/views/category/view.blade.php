<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>
    <div class="container py-4">
        <div class="card">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
                @if(isset($categories))
                    <form method="post">
                        <table class="table table-striped" id="userTable" style="width: 100%">
                        <thead>
                        <th></th>
                        <th>Category Name</th>
                        <th>Notes</th>
                        <th>Sort Order</th>
                        <th>Products in Category</th>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)

                            <?php /* echo  '<pre>'; var_dump($category); echo  '</pre>';die;*/ ?>

                            <tr class="categoryRow"  style="cursor: pointer ">
                                <td class="d-none">{{$category->id}}</td>
                                <td class="alert-info delete"
                                    style="text-align: center;cursor:pointer;background: red"
                                    id="deleteCategory-{{$category->id}}-{{$category->category_name}}"
                                    href="/c/delete/{{$category->id}}">
                                        <span>
                                            <p id="deleteCategory-{{$category->id}}-{{$category->category_name}}"
                                               class="deleteCategory">X</p>
                                        </span>
                                </td>
                                <td id="categoryRow-{{$category->id}}">
                                    <a href="/c/edit/{{$category->id}}" style="color: black;cursor: pointer" >{{$category->category_name}}</a>
                                </td>
                                <td>
                                    <a href="/c/edit/{{$category->id}}" style="color: black;cursor: pointer" >{{$category->category_note}}</a>
                                </td>

                                <td><input type="number" min="1" name="sort_order[]" value="{{$category->sort_order}}" id="sort_order{{$category->id}}"   onchange="sortioraafer('{{$category->id}}')" > </td>
{{--                                @if($category->type=='DOORS')--}}
{{--                                    <td>{{sizeof($category->door)}}</td>--}}
{{--                                @if($category->type=='OTHERS')--}}
{{--                                    <td>{{sizeof($category->products)}}</td>--}}
{{--                                @else--}}

                                <td>{{$category->products_sum}}</td>
{{--                                    <td>{{sizeof($category->type)}}</td>--}}
{{--                                @endif--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </form>
                @endif
            </div>
            <div class="align-content-end " style="margin-right: 20px; text-align: right">
                <a href="{{route('ccreate')}}">
                    <button class="btn btn-primary mb-3">Create a new category</button>
                </a>
            </div>
        </div>
    </div>
    @section('scripts')
        <script src="{{ asset('js/category/view.js') }}" defer></script>
        <script>
            var sort_order;
            function sortioraafer(idd){
                sort_order = $('#sort_order'+idd).val();
                $.ajax({
                    type:'POST',
                    url:'/c/updateSortCategory',
                    data:{
                        _token: "{{ csrf_token() }}",
                        idd         : idd,
                        sort_order  : sort_order
                    },
                    success: function( msg ) {
                       // alert('Sort Order Updated');
                    }
                });
            }
        </script>
    @stop
</x-app-layout>
