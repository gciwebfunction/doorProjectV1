<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('')  }}
        </h2>
    </x-slot>

    <div class="container" style="margin-top: 3px;">
        <div style="display: grid; grid-template-columns: 1fr 3fr">
            <div class="left-1/3">
                <div class="alert alert-success" role="alert">
                    <h2 class="alert-heading"><strong>Shopping Cart</strong></h2>
                    <p>View current products prior to submitting the order.</p>
                    <hr>

                </div>

            </div>
            <div class="right-2/3">
                <form action="/o" method="POST" id="cartForm">
                    @csrf
                    <input type="hidden" id="shoppingCartId" name="shopping_cart_id"
                           value="{{$shoppingCart->id ?? ''}}">

                    <div class="container">


                        <hr class="mb-5"/>
                        <div class="row flex p-3 m-1" style="border-bottom: 1px solid gray">
                            <div class="col-4">
                                Quantity
                            </div>
                            <div class="col-4">
                                Item
                            </div>
                            <div class="col-4">
                                Price
                            </div>
                        </div>
                        @if($shoppingCart ?? ''  && $cartItemCount > 0)
                            @foreach($shoppingCart->cartItems as $item)
                                <div class="row flex p-3 m-1" style="border-bottom: 1px solid gray">
                                    <div class="col-4">
                                        {{$item->quantity}}
                                    </div>
                                    <div class="col-4">
                                        {{$item->product_name}}
                                    </div>
                                    <div class="col-4 currSign">
                                        {{$item->product_unit_price}}
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="row flex p-2" id="nothingInYourCartContainer">
                                <div class="col-12">
                                    Nothing in your cart!
                                </div>
                            </div>
                        @endif
                        <div class="row flex p-1 m-1">
                            <div class="col-12">
                                <hr/>
                            </div>
                        </div>
                        <div class="row flex p-1 m-1">
                            <div class="col-4">
                            </div>
                            <div class="col-4">
                                Order Subtotal
                            </div>
                            <div class="col-4 currSign" id="orderSubtotalContainer">
                                {{$cartSubtotal ?? '0.00'}}
                            </div>
                        </div>
                        <div class="row flex p-1 m-1">
                            <div class="col-4">
                            </div>
                            <div class="col-4">
                                Order Discounts
                            </div>
                            <div class="col-4 currSign" id="orderDiscountContainer">
                                {{$orderDiscount ?? '0.00'}}
                            </div>
                        </div>
                        <div class="row flex p-1 m-1">
                            <div class="col-4">
                            </div>
                            <div class="col-4">
                                Order Total
                            </div>
                            <div class="col-4  currSign" id="orderTotalContainer">
                                {{$orderTotal ?? '0.00'}}
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-warning" role="alert" style="width:80%; margin: 5px auto 0;">
                        <div class="row">
                            <div class="col-sm" style="text-align: center;">
                                <button type="button" value="clearCart" id="clearCart" class="ml-10 button-gci">
                                    <span aria-hidden="true">Clear Cart</span>
                                </button>
                            </div>
                            <div class="col-sm" style="text-align: center;">
                                <button type="button" value="clearCart" id="goBackToCatalogButton"
                                        class="ml-10 button-gci">
                                    <span aria-hidden="true">Keep Shopping</span>
                                </button>
                            </div>
                            <div class="col-sm" style="text-align: center;">
                                <button type="button" value="clearCart" id="submitOrderButton" class="ml-10 button-gci">
                                    <span aria-hidden="true">Submit Order...</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    @section('scripts')
        <script src="{{ asset('js/shoppingcart/cartview.js') }}" defer></script>
        <script>
        </script>
    @stop
</x-app-layout>
