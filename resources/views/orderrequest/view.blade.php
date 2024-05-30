<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details')  }}
        </h2>
    </x-slot>
    <div class="container py-4">
        <h4 style="text-align: center">Order Requests</h4>

        @if(isset($message) && strlen($message)>0)
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
            </div>
        @endif

        <div id="container">
            <table class="table-striped" id="orderRequestTable">
                <thead>
                <tr>
                    <th></th>
                    <th>
                        Request #
                    </th>
                    <th>
                        Date Created
                    </th>
                    <th>
                        PO
                    </th>
                    <th>
                        Order Total
                    </th>
                    <th>
                        Status
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($oRs as $or)
                    <tr>
                        <td class="alert-danger">
                            <div data-bs-toggle="modal" data-bs-target="#deleteOrderRequest{{$or->id}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#FF0000"
                                     class="bi bi-x" viewBox="0 0 16 16">
                                    <path
                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </div>
                            <div class="modal" id="deleteOrderRequest{{$or->id}}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete Order Request</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete order request number #{{$or->id}}?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Cancel
                                            </button>
                                            <button type="button" class="btn btn-primary"
                                                    onclick="deleteOrderRequest({{$or->id}})">Delete Order Request
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{$or->id}}</td>
                        <td>{{$or->created_at}}</td>
                        <td>{{$or->po_number}}</td>
                        <td>{{sprintf('%0.12f',$or->total)}}</td>

                        @if($or->status == 'NOT SUBMITTED')
                            <td class="alert-danger">{{$or->status}}<br/><a href="/or/submit/{{$or->id}}"
                                                                            style="border-radius: 2px; border: 1px solid black; background-color: lightgray; padding: 2px">SUBMIT</a>
                            </td>
                        @elseif($or->status == 'PENDING CONFIRMATION')
                            <td class="alert-warning">
                                {{$or->status}}
                            </td>
                        @else
                            <td>
                                {{$or->status}}
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
    @section('scripts')
        <script src="{{ asset('js/orderrequest/view.js') }}" defer></script>
    @stop
</x-app-layout>
