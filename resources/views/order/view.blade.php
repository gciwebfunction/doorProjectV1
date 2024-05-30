<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details')  }}

        </h2>
    </x-slot>
    <div class="container py-4">
        <h4 style="text-align: center">
            Confirmed Orders  @php // echo $user->usertype ; die;@endphp
        </h4>
        <div class="container">
            <table class="table-striped" id="orderTable">
                <thead>
                <tr>
                    <th>Order #</th>
                    <th>Order Date</th>
                    <th>Order Total</th>
                    <th>Status</th>
                    <th>Print</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @if(@isset($orders))
                    @foreach($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>@php echo date( 'm-d-Y', strtotime($order->created_at)) @endphp</td>
                            <td class="currSign">
                                {{sprintf('%01.2f', $order->total_order_amount)}}

{{--                                {{money_format('%.2n',$order->total_order_amount)}}--}}
                            </td>
                            <td>CREATED</td>
                            <td>

                                <a title="Print Order" href="/o/orPrint/{{$order->id}}" target="_blank"
                                   style="text-align:center;border-radius: 2px; border: 1px solid black; background-color: lightgray;margin-left: 11px;padding-bottom:5px; "><img src="/img/printicon.png" ></a>
                            </td>
                            <td>
                                <a title="Delete Order" href="/o/orderDelete/{{$order->id}}"
                                   style="padding-bottom:5px;text-align:center;border-radius: 2px; border: 1px solid black; background-color: lightgray;margin-left: 11px; "><img src="/img/deleteOrder.png" ></a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
        <h4 id="current_order_reqss" style="text-align: center"> In Process Requests</h4>
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
                </tr>
                </thead>
                <tbody>
                @foreach($oRs as $or)
                    <tr>
                        <td class="alert-danger">
                            @php
                                if($user->usertype != 'sales')  {
                            @endphp
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
                            @php
                                }
                            @endphp

                        </td>
                        <td>
                            {{$or->id}}
                        </td>
                        <td>

                            @php echo date( 'm-d-Y', strtotime($or->created_at)) @endphp
                        </td>
                        <td>
                            {{$or->po_number}}
                        </td>
                        <td class="currSign">
{{--                            {{money_format('%.2n',$or->total)}}--}}
                            {{sprintf('%01.2f', $or->total)}}
                        </td>
                        <td>
                            @foreach($status as $s)
                                @if($or->status == $s->id)
                                    {{$s->status}}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <a style="border-radius: 2px; border: 1px solid black; background-color: lightgray; padding: 3px" href="/o/Editmanufacturerdetailview/{{$or->id}}">
                                View
                            </a>
                            @if($or->status != '1017')
                                {{-- 3rd level flow starts  --}}
                                @if($user->usertype == 'manufacturer' &&  $or->current_level == 3 && $or->request_type == '3 level' )
                                    |<a style="border-radius: 2px; border: 1px solid black; background-color: lightgray; padding: 3px" href="/o/editManufacturerform/{{$or->id}}">Edit</a>|<a style="border-radius: 2px; border: 1px solid black;color:white; background-color: green;padding: 3px" href="/o/editManufacturereqconfirm/{{$or->id}}">Confirm</a>
                                @endif

                                @if($user->usertype == 'distributor' &&  $or->current_level == 4 && $or->request_type == '3 level' )
                                    |<a style="border-radius: 2px; border: 1px solid black; background-color: lightgray; padding: 3px" href="/o/editManufacturerform/{{$or->id}}">Edit</a>|<a style="border-radius: 2px; border: 1px solid black; background-color: green; color:white;padding: 3px" href="/o/editManufacturereqconfirm/{{$or->id}}">Confirm</a>
                                @endif

                                @if($user->usertype == 'dealer' &&  $or->current_level == 5 &&  $or->request_type == '3 level'  )
                                    |<a style="border-radius: 2px; border: 1px solid black; background-color: lightgray; padding: 3px" href="/o/editManufacturerform/{{$or->id}}">Edit</a>|<a style="border-radius: 2px; border: 1px solid black; background-color: green;color:white; padding: 3px" href="/o/orderReqconfirm/{{$or->id}}">Confirm</a>|<a style="border-radius: 2px; border: 1px solid black; background-color: red; padding: 3px" href="/o/rejectOrderrequest/{{$or->id}}">Reject</a>
                                @endif
                                {{-- 3rd level flow starts  --}}

                                {{-- 2nd level flow starts  --}}
                                @if($user->usertype == 'manufacturer' &&  $or->current_level == 2 && $or->request_type == '2 level' )
                                    |<a style="border-radius: 2px; border: 1px solid black; background-color: lightgray; padding: 3px" href="/o/editManufacturerform/{{$or->id}}">Edit</a>|<a style="border-radius: 2px; border: 1px solid black; background-color: green; color:white; padding: 3px" href="/o/editManufacturereqconfirm/{{$or->id}}">Confirm</a>
                                @endif
                                @if(($user->usertype == 'distributor' &&  $or->current_level == 3 && $or->request_type == '2 level' )  or  ( $user->usertype == 'sales' ||  $user->usertype == 'sales_manager' ||   $user->usertype == 'sales_user') )
                                    |<a style="border-radius: 2px; border: 1px solid black; color:white;background-color: green; padding: 3px" href="/o/editManufacturereqconfirm/{{$or->id}}">Confirm</a>|<a style="border-radius: 2px; border: 1px solid black; background-color: red;color:white; padding: 3px" href="/o/rejectOrderrequest/{{$or->id}}">Reject</a>
                                @endif
                                @if($user->usertype == 'direct_dealer' &&  $or->current_level == 3 && $or->request_type == '2 level' )
                                    |<a style="border-radius: 2px; border: 1px solid black; background-color: green; color:white;padding: 3px" href="/o/editManufacturereqconfirm/{{$or->id}}">Confirm</a>|<a style="border-radius: 2px; border: 1px solid black; background-color: red; color:white;padding: 3px" href="/o/rejectOrderrequest/{{$or->id}}">Reject</a>
                                @endif
                                {{-- 2nd level flow ends  --}}

                                {{-- start the condition for the  sales level 2  --}}
                                @if($user->usertype == 'sales' &&  $or->current_level == 2 && $or->request_type == '2 level' )
                                    |<a style="border-radius: 2px; border: 1px solid black; background-color: lightgray; padding: 3px" href="/o/editManufacturerform/{{$or->id}}">Edit</a>
                                @endif
                                {{-- end  the condition for the  sales level 2  --}}
                                |<a style="border-radius: 2px; border: 1px solid black; background-color: lightgray; padding: 3px" target="_blank" href="/o/Editmanufacturerdetailprint/{{$or->id}}">Print</a>





                            @endif
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>


<style href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"></style><style href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css"></style>


@section('scripts')


        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
{{--        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>--}}
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>







        <script src="{{ asset('js/order/view.js') }}" defer></script>
@stop
</x-app-layout>
