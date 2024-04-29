<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details')  }}
        </h2>
    </x-slot>
    <div class="container py-4">

        <div class="container">
            <div class="row flex">
                <div class="small" style="text-transform: capitalize;">Order Details</div>
            </div>

            <div class="row flex">
                <div class="col-2 p-1 m-1">
                    <h2>Order Date</h2>
                </div>
                <div class="col-2 p-1 m-1">
                    <h2>Order Quantity</h2>
                </div>
                <div class="col-2 p-1 m-1">
                    <h2>Order Total</h2>
                </div>

                <div class="col-2 p-1 m-1">
                    <h2>Order Quantity</h2>
                </div>


                <div class="col-3 p-1 m-1">
                    <h2 style="font-weight: bolder">STATUS</h2>
                </div>
            </div>
            <div class="row flex" style="margin-bottom: 5px;">
                <hr/>
            </div>
            <div id="orderContainer" style="min-height: 200px">


                @if(@isset($orders))
                    @foreach($orders as $order)
                        <div class="row flex">
                            <p>{{$lineItem??''}}</p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    @section('scripts')
    @stop
</x-app-layout>
