<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a Product') }}
        </h2>
    </x-slot>

    <div class="container" style="margin-top: 3px">
        <form class="row g-3" action="/p/doorflow/three" method="POST" enctype="multipart/form-data"
              id="productPricesForm">
            <input type="hidden" value="{{$door->id}}" name="door_id" id="doorId">
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 3fr">
                <div class="left-1/3" style="margin-right: 2px; padding-right: 1px">
                    <div class="alert alert-success" role="alert">
                        <h2 class="alert-heading"><strong>Product</strong></h2>
                        <p>Set prices for sizes / options.</p>
                        <hr>

                    </div>
                </div>
                <div class="right-2/3">
                    <div class="d-none"> {{ $tabindex = 0 }}</div>
                    @foreach($door->interiorColors as $color)
                        @foreach($door->doorMeasurements as $m)
                            <div class="row">
                                <input type="hidden" name="price-{{$color->id}}{{$m->id}}">
                                <div class="col-1 p-3 m-3">
                                    {{$color->color}}:
                                </div>
                                <div class="col-2 p-3 m-3">
                                    {{$m->width}} x {{$m->height}}
                                </div>
                                <div class="col-2 p-3 m-3">
                                    <label for="isNA">NA?</label>
                                    <input type="checkbox" class="sizePriceNA" name="is_na-{{$color->id}}{{$m->id}}"
                                           id="isNA-{{$loop->parent->index}}{{$loop->index}}" tabindex="-1">
                                </div>
                                <div class="col-1 p-3 m-3">
                                    <input type="number" class="sizePrice dataField" placeholder="price"
                                           id="sizePrice-{{$loop->parent->index}}{{$loop->index}}"
                                           name="sizePrice-{{$color->id}}{{$m->id}}" value="0"
                                    >
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </form>
    </div>

    <div class="row bottom-button-bar" role="alert">
            <div class="col">
                <button class="btn btn-primary" id="continueButton">Continue...</button>
            </div>
        </div>
    @section('scripts')
        <script src="{{ asset('js/product/door/utility3.js') }}" defer></script>
    @stop
</x-app-layout>
