<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('')  }}
        </h2>
    </x-slot>

    <form action="/or/{{$shoppingCart->id??''}}" method="POST" id="cartForm">
        <div class="container" style="margin-top: 3px;;min-width: 900px">
            <div style="">
                <div class="left-1/3">
                    <div class="alert alert-success" role="alert">
                        <h2 class="alert-heading"><strong>Order Details</strong></h2>
                        <p>View current products prior to submitting the order.</p>
                        <hr/>
                    </div>
                </div>
                <div class="right-2/3">
                    @csrf
                    <input type="hidden" id="shoppingCartId" name="shopping_cart_id"
                           value="{{$shoppingCart->id ?? ''}}">
                </div>
            </div>
            <div id="message" class="text-center">

            </div>
            <div id="centerFloatDiv" class="d-none">
                <div class="divFloat" id="divFloat" style="text-align: center"></div>
            </div>
            <div class="" id="cartContents" style="width:95%; padding:1px;margin:1px;min-width: 800px">
                <table class="display" id="cartTable">
                    <thead>
                    <tr>
                        <th>Quantity</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Handling</th>
                        <th>Frame</th>
                        <th>Handle</th>
                        <th>Lock</th>
                        <th>Glass</th>
                        <th>Frame Thick</th>
                        <th>Sill Option</th>
                        <th>Blind Option</th>
                        <th>Hinge Color</th>
                        <th>Screen Option</th>
                        <th>Price</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($shoppingCart ?? ''  && $cartItemCount > 0)
                        @php
                        foreach($doorViewItems as $item){

                            $wq = $item->getQuantity();
                            $pp = $item->getPrice();
                            $ppp = $pp * $wq
                        @endphp
                            <tr id="itemRow1-{{$item->getId()}}">
                                <td>{{$item->getQuantity()}}</td>
                                <td>{{$item->getName()}}</td>
                                <td>{{$item->getCategoryName()}}</td>
                                <td>{{$item->getSize()}}</td>
                                <td>{{$item->getColor()}}</td>

                                <td>{{$item->getFrame()}}</td>
                                <td>{{$item->getGrid()}}</td>
                                <td>{{$item->getHandle()}}</td>
                                <td>{{$item->getLock()}}</td>
                                <td>${{sprintf('%01.2f',$ppp )}}</td>
                                <td class="delete alert-danger col-1 m-1 p-1"
                                    style="background-color: red; text-align: center;width: 20px; padding-right: 1px; height: 20px; border-radius: 2px"
                                    id="item-{{$item->getId()}}">
                                    X
                                </td>
                            </tr>
                        @php }  @endphp
                    @else
                        <tr id="nothingInYourCartContainer">
                            <td colspan="17">
                                Nothing in your cart!
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>

                <div class="container py-4 mb-5">
                    <h4 class="text-center">Other Products</h4>
                </div>

                <table class="display" id="otherCartTable">
                    <thead>
                    <tr>
                        <th>Quantity</th>
                        <th>Product Name</th>
                        <th>Option</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Price</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($shoppingCart->cartItems))
                        @foreach($shoppingCart->cartItems as $item)
                            <tr id="cartItemRow1-{{$item->id}}">
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->product_name}}</td>
                                <td>{{$item->option_name}}</td>
                                <td>{{$item->product_size}}</td>
                                <td>{{$item->product_color}}</td>
                                <td>${{sprintf('%0.2f',$item->product_unit_price*$item->quantity)}}</td>
                                <td class="delete alert-danger col-1 m-1 p-1"
                                    style="background-color: red; text-align: center;width: 20px; padding-right: 1px; height: 20px; border-radius: 2px"
                                    id="cartItem-{{$item->id}}">
                                    X
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
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

                    <div class="col-4 currSign" id="orderTotalContainer">
                        {{$orderTotal ?? '$ 0.00'}}
                    </div>
                </div>
            </div>
            <div class="alert alert-warning" role="alert" style="width:80%; margin: 5px auto 0;">
                <div class="row">
                    <div class="col-sm" style="text-align: center;">
                        <button type="button"  id="clearCart" class="ml-10 button-gci">
                            <span aria-hidden="true">Clear Cart</span>
                        </button>
                    </div>
                    <div class="col-sm" style="text-align: center;">
                        <button type="button"  id="goBackToCatalogButton"
                                class="ml-10 button-gci">
                            <span aria-hidden="true">Keep Shopping</span>
                        </button>
                    </div>
                    <div class="col-sm" style="text-align: center;">
                        <button type="button"  id="submitOrderButton" class="ml-10 button-gci">
                            <span aria-hidden="true">Submit Order Request...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @section('scripts')
        <script src="{{ asset('js/shoppingcart/cartviewdoor.js') }}" defer></script>
        <script>
        </script>
    @stop
</x-app-layout>
