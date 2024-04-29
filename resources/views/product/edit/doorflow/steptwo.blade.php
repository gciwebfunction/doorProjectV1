<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a Product') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="container" style="margin-top: 3px">
            <form class="row g-3" action="/p/editdoorflow/updatesteptwo" method="POST" enctype="multipart/form-data"
                  id="editProductForm">
                <input type="hidden" id="doorId" name="door_id" value="{{$door->id}}">

                @csrf

                <div style="display: grid; grid-template-columns: 1fr 3fr">
                    <div class="left-1/3" style="margin-right: 2px; padding-right: 1px">
                        <div class="alert alert-success" role="alert">
                            <h2 class="alert-heading"><strong>Product - {{$door->name}}</strong></h2>
                            <p>Edit product details.</p>
                            <hr>

                        </div>
                    </div>
                    <div class="right-2/3">

                        <div class="accordion" id="accordianContainer">
                            @foreach($door->interiorColors as $color)
                                <div class="card">
                                    <div class="card-header" id="heading{{$loop->index}}">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                                    data-target="#collapse{{$loop->index}}"
                                                    @if($loop->index>0)
                                                    aria-expanded="false"
                                                    @else
                                                    aria-expanded="true"
                                                    @endif
                                                    aria-controls="collapse{{$loop->index}}">
                                                {{$color->color}}
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapse{{$loop->index}}" class="collapse {{$loop->index>0?'':'show'}}"
                                         aria-labelledby="heading{{$loop->index}}" data-parent="#accordianContainer">
                                        <div class="card-body">
                                            @foreach($door->doorMeasurements as $m)
                                                <div class="row flex sdlPriceRow">
                                                    <div class="col-2 p-1 m-1">
                                                        {{$color->color}}
                                                    </div>
                                                    <div class="col-2 p-1 m-1">
                                                        W{{$m->width}} x H{{$m->height}}
                                                    </div>
                                                    <div class="col-4 p-1 m-1">
                                                        <label for="isNA">Not available in this size</label>
                                                        <input type="checkbox" class="finishIsNA"
                                                               name="finish_is_na-{{$m->id}}"
                                                               id="finishIsNA-{{$m->id}}">
                                                    </div>
                                                    <div class="col-2 p-1 m-1">
                                                        <input type="number"
                                                               style="text-align: right"
                                                               class="form-control dataField finishPrice"
                                                               placeholder="Price"
                                                               name="finish_price-{{$m->id}}-{{$color->id}}"
                                                               id="finish_price-{{$m->id}}-{{$color->id}}"
                                                               value="">
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div style="visibility: hidden; max-height: 1px !important;" id="doorFinishPriceContainer"  >
                            @foreach($doorFinishPrices as $fp)
                                <div id="finishPrice-{{$fp->door_measurement_id}}-{{$fp->interior_color_id}}">{{$fp->price}}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div id="errorContainer">
                    @if($errors)
                        @foreach($errors as $error)
                            <span class="invalid-feedback" role="alert">
                            <strong>{{$error}}</strong>
                        </span>
                            <hr/>
                        @endforeach
                    @endif
                </div>
            </form>
        </div>
    </div>
    <div class="" style=";text-align: right; margin-top: 5px; padding-top: 2px;">
        <div class="alert alert-warning" role="alert" style="; margin: 5px auto 0; text-align: right">
            <div class="row">
                <div class="col-sm" style="text-align: right;">
                    <button class="btn btn-primary mb-3" id="submitEditButton"> Continue...
                    </button>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        <script src="{{ asset('js/product/door/editutility2.js') }}" defer></script>
    @stop
</x-app-layout>
