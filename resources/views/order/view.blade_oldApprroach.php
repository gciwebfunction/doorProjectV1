<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details')  }}
        </h2>
    </x-slot>
    <div class="container py-4">
        <h4 style="text-align: center">Current Orders</h4>
        <div class="container">
            <table class="table-striped" id="orderTable">
                <thead>
                <tr>
                    <th>
                        Order Date
                    </th>
                    <th>
                        Order Total
                    </th>
                    <th>
                        Status
                    </th>
                    <th>
                        Print
                    </th>
                </tr>
                </thead>
                <tbody>
                @if(@isset($orders))
                    @foreach($orders as $order)
                        <tr>
                            <td>{{$order->created_at}}</td>
                            <td class="currSign">
                                {{sprintf('%01.2f', $order->total_order_amount)}}

{{--                                {{money_format('%.2n',$order->total_order_amount)}}--}}
                            </td>
                            <td>CREATED</td>
                            <td>

                                <a title="Print Order" href="/o/Orprint/{{$order->id}}" target="_blank"
                                   style="text-align:center;border-radius: 2px; border: 1px solid black; background-color: lightgray;margin-left: 11px; "><img src="/img/printicon.png" ></a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
        <h4 style="text-align: center">Current Order Requests</h4>
        <div class="container">
            <table class="table-striped" id="orderRequestTable">
                <thead>
                <tr>
                    <th></th>
                    <th>Request #</th>
                    <th>Date Created</th>
                    <th>PO</th>
                    <th>Order Total</th>
                    <th>Status</th>
                    <th>Action</th>
{{--                    <th>--}}
{{--                        CONFIRM W/O CHANGE--}}
{{--                    </th>--}}
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
                        <td>
                            {{$or->id}}
                        </td>
                        <td>
                            {{$or->created_at}}
                        </td>
                        <td>
                            {{$or->po_number}}
                        </td>
                        <td class="currSign">
{{--                            {{money_format('%.2n',$or->total)}}--}}
                            {{sprintf('%01.2f', $or->total)}}
                        </td>






                        @if($or->status == 1001)
                            <td class="alert-danger">
                                @foreach($status as $s)
                                    @if($or->status == $s->id)
                                        {{$s->status}}
                                    @endif
                                @endforeach
                                <br/><a href="/or/submit/{{$or->id}}"
                                        style="border-radius: 2px; border: 1px solid black; background-color: lightgray; padding: 3px">Submit</a>
                            </td>
                        @elseif($or->status == 1002)
                            <td class="alert-warning">
                                @foreach($status as $s)
                                    @if($or->status == $s->id)
                                        {{$s->status}}
                                    @endif
                                @endforeach
                                @can('cf_order')
                                    <br/><a href="/or/confirm/{{$or->id}}"
                                            style="border-radius: 2px; border: 1px solid black; background-color: lightgray; padding: 3px">Confirm</a>
                                @endcan
                            </td>
                        @else
                            <td>
                                @foreach($status as $s)
                                    @if($or->status == $s->id)
                                        {{$s->status}}



                                            <br>
                                            @if($user->usertype == 'manufacturer' &&  ($or->status != 1014)  )
                                                <a style="border-radius: 2px; border: 1px solid black; background-color: lightgray; padding: 3px" href="/o/editManufacturerform/{{$or->id}}">Edit</a> | <a href="/or/confirm/{{$or->id}}" style="border-radius: 2px; border: 1px solid black; background-color: lightgray; padding: 3px">Confirm</a>
                                            @endif

                                            @if($user->usertype == 'distributor' &&  ($or->status == 1014)  )
                                                <a style="border-radius: 2px; border: 1px solid black; background-color: lightgray; padding: 3px" href="/o/editManufacturerform/{{$or->id}}">Edit</a> | <a href="/or/confirm/{{$or->id}}" style="border-radius: 2px; border: 1px solid black; background-color: lightgray; padding: 3px">Confirm</a>
                                            @endif

                                            @if($or->req_generator_type == 'dealer' &&  ($or->status == 1013)  )
                                                <a style="border-radius: 2px; border: 1px solid black; background-color: lightgray; padding: 3px" href="/o/editManufacturerform/{{$or->id}}">Edit</a>
                                                @if($or->req_generator_type != 'dealer'  )
                                                    | <a href="/or/confirm/{{$or->id}}" style="border-radius: 2px; border: 1px solid black; background-color: lightgray; padding: 3px"> </a>
                                                @endif
                                            @endif

                                            @if($user->usertype == 'distributor' &&  ($or->status == 1013)  )
                                                <a style="border-radius: 2px; border: 1px solid black; background-color: lightgray; padding: 3px" href="/o/Editmanufacturerdetailview/{{$or->id}}">view</a>
                                                @if($or->req_generator_type != 'dealer'  )
                                                    | <a href="/or/confirm/{{$or->id}}" style="border-radius: 2px; border: 1px solid black; background-color: lightgray; padding: 3px"> </a>
                                                @endif
                                            @endif







{{--                                            @if($user->usertype == 'distributor' &&  ($or->status == 1013)  )--}}
{{--                                                <a style="border-radius: 2px; border: 1px solid black; background-color: lightgray; padding: 3px" href="/o/Editmanufacturerdetailview/{{$or->id}}">viewsdsdf</a>--}}
{{--                                                @if($or->req_generator_type != 'dealer'  )--}}
{{--                                                    | <a href="/or/confirm/{{$or->id}}" style="border-radius: 2px; border: 1px solid black; background-color: lightgray; padding: 3px"> </a>--}}
{{--                                                @endif--}}
{{--                                            @endif--}}

                                    @endif
                                @endforeach
                            </td>


                            <td></td>

                        @endif

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @section('scripts')
        <script src="{{ asset('js/order/view.js') }}" defer></script>
    @stop
</x-app-layout>
