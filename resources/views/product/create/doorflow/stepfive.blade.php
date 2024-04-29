<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a Product') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="container" style="margin-top: 3px; min-width: 600px">
            <form class="row g-3" action="/p/doorflow/five" method="POST" enctype="multipart/form-data"
                  id="additionalOptionsPriceForm">
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
                        <div class="container">
                            <div class="row flex" style="border-bottom: 1px solid lightgray">
                                <div class="col-4 m-1 p-1 fw-bold ">
                                    <h4>SDL Option Prices</h4>
                                </div>
                                <div class="col-1  m-1 p-1"></div>
                                <div class="col-2 m-1 p-1">
                                </div>
                                <div class="col-4 m-1 p-1">
                                </div>
                            </div>
                            <div class="row flex">
                                <div class="col-2 m-1 p-1">
                                </div>
                                <div class="col-2 p-1 m-1">
                                    <label for="sdlAllSamePrice" class="fw-bolder"
                                           style="text-transform:capitalize;font-size: xx-small;">
                                        SDL Price Same for all sizes?
                                    </label>
                                </div>
                                <div class="col-5 p-1 m-1">
                                    <select id="sdlAllSamePriceSelect" name="sdl_all_same_price"
                                            style="font-size: small;border-radius: 3px">
                                        <option value="0" selected>NO - Each size has a price.</option>
                                        <option value="1">YES - Same price for all sizes.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row flex d-none allSDLPriceRow">
                                <div class="col-2 m-1 p-1">
                                </div>
                                <div class="col-2 p-1 m-1">
                                    <label for="sdlAllSamePrice" class="fw-bolder"
                                           style="text-transform:capitalize;font-size: xx-small;">
                                        Price for SDL Option
                                    </label>
                                </div>
                                <div class="col-5 p-1 m-1">
                                    <input type="number" id="sdlOptionsPrice" name="sdl_options_price"
                                           style="font-size: small;border-radius: 3px">
                                </div>
                            </div>
                            @foreach($door->doorMeasurements as $m)
                                <div class="row flex sdlPriceRow">
                                    <div class="col-2 p-1 m-1">
                                        W{{$m->width}} x H{{$m->height}}
                                    </div>
                                    <div class="col-2 p-1 m-1">
                                        <label for="isNA">NA?</label>
                                        <input type="checkbox" class="sdlIsNA" name="sdl_is_na-{{$m->id}}"
                                               id="sdlIsNA-{{$m->id}}">
                                    </div>
                                    <div class="col-4 p-1 m-1">
                                        <input type="number" class="form-control dataField sdlOptionPRice"
                                               placeholder="price"
                                               name="sdl_option_price-{{$m->id}}"
                                               id="sdl_option_price-{{$m->id}}"
                                               value="0">
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        <div class="container">
                            <div class="row flex" style="border-bottom: 1px solid lightgray">
                                <div class="col-4 m-1 p-1 fw-bold ">
                                    <h4>GBG Option Prices</h4>
                                </div>
                                <div class="col-1  m-1 p-1"></div>
                                <div class="col-2 m-1 p-1">
                                </div>
                                <div class="col-4 m-1 p-1">
                                </div>
                            </div>
                            <div class="row flex">
                                <div class="col-2 m-1 p-1">
                                </div>
                                <div class="col-2 p-1 m-1">
                                    <label for="gbgAllSamePrice" class="fw-bolder"
                                           style="text-transform:capitalize;font-size: xx-small;">
                                        GBG Price Same for all sizes?
                                    </label>
                                </div>
                                <div class="col-5 p-1 m-1">
                                    <select id="gbgAllSamePriceSelect" name="gbg_all_same_price"
                                            style="font-size: small;border-radius: 3px">
                                        <option value="0" selected>NO - Each size has a price.</option>
                                        <option value="1">YES - Same price for all sizes.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row flex d-none allGBGPriceRow">
                                <div class="col-2 m-1 p-1">
                                </div>
                                <div class="col-2 p-1 m-1">
                                    <label for="gbgAllSamePrice" class="fw-bolder"
                                           style="text-transform:capitalize;font-size: xx-small;">
                                        Price for GBG Option
                                    </label>
                                </div>
                                <div class="col-5 p-1 m-1">
                                    <input type="number" id="gbgOptionsPrice" name="gbg_options_price"
                                           style="font-size: small;border-radius: 3px" value="0">
                                </div>
                            </div>
                            @foreach($door->doorMeasurements as $m)
                                <div class="row flex gbgPriceRow">
                                    <div class="col-2 p-1 m-1">
                                        W{{$m->width}} x H{{$m->height}}
                                    </div>
                                    <div class="col-2 p-1 m-1">
                                        <label for="isNA">NA?</label>
                                        <input type="checkbox" class="gbgIsNA" name="gbg_is_na-{{$m->id}}"
                                               id="gbgIsNA-{{$m->id}}">
                                    </div>
                                    <div class="col-4 p-1 m-1">
                                        <input type="number" class="form-control dataField gbgOptionPrice"
                                               placeholder="Price"
                                               name="gbg_option_price-{{$m->id}}"
                                               id="gbg_option_price-{{$m->id}}"
                                               value="0">
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        <div class="container">
                            <div class="row flex" style="border-bottom: 1px solid lightgray">
                                <div class="col-7 m-1 p-1 fw-bold " style="font-size: small">
                                    <h4>Handle Type Prices</h4>
                                    <p style="font-size: small;font-variant: all-small-caps">(IF "included" put '0' for
                                        the price.)</p>
                                </div>
                                <div class="col-1  m-1 p-1"></div>
                                <div class="col-2 m-1 p-1">
                                </div>
                            </div>
                            @foreach($door->additionalOptions as $a)
                                @if($a->group_name == 'HANDLE_TYPE_OPTION')
                                    <div class="row flex">
                                        <div class="col-3 p-1 m-1">
                                            {{$a->name}}
                                        </div>
                                        <div class="col-2 p-1 m-1">
                                            {{$a->doorMeasurement->width}} x {{$a->doorMeasurement->height}}
                                        </div>
                                        <div class="col-2 p-1 m-1">
                                            <label for="isNA">NA?</label>
                                            <input type="checkbox" class="handleTypeIsNa"
                                                   name="handle_type_is_na-{{$a->id}}"
                                                   id="handleTypeIsNA-{{$a->id}}">
                                        </div>
                                        <div class="col-4 p-1 m-1">
                                            <input type="number" class="form-control dataField" placeholder="Price"
                                                   name="handle_type_price-{{$a->id}}"
                                                   id="handle_type_price-{{$a->id}}"
                                                   value="0">
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                            <div style="margin: 12px;"></div>
                            <div class="row flex" style="border-bottom: 1px solid lightgray">
                                <div class="col-7 m-1 p-1 fw-bold " style="font-size: small">
                                    <h4>Lock Set Prices</h4>
                                    <p style="font-size: small;font-variant: all-small-caps">(IF "included" put '0' for
                                        the price.)</p>
                                </div>
                                <div class="col-3 m-1 p-1">
                                </div>
                            </div>
                            @foreach($door->additionalOptions as $a)
                                @if($a->group_name == 'LOCK_SET_OPTION')
                                    <div class="row flex">
                                        <div class="col-3 p-1 m-1">
                                            {{$a->name}}
                                        </div>
                                        <div class="col-2 p-1 m-1">
                                            {{$a->doorMeasurement->width}} x {{$a->doorMeasurement->height}}
                                        </div>
                                        <div class="col-2 p-1 m-1">
                                            <label for="isNA">NA?</label>
                                            <input type="checkbox" class="lockSetIsNA" name="lock_set_is_na-{{$a->id}}"
                                                   id="lockSetIsNA-{{$a->id}}">
                                        </div>
                                        <div class="col-4 p-1 m-1">
                                            <input type="number" class="form-control dataField" placeholder="Price"
                                                   name="lock_set_price-{{$a->id}}"
                                                   id="lock_set_price-{{$a->id}}"
                                                   value="0">
                                        </div>
                                    </div>
                                @endif
                            @endforeach


                            <?php
                            $glassOptionCounter = 0;
                            $customOptCounter = 0;
                            $lastCustomOptionId = -1;
                            ?>
                            @foreach($door->additionalOptions as $a)
                                @if($a->group_name == 'GLASS_OPTION' && $a->has_price)
                                    @if($glassOptionCounter==0)
                                        <div style="margin: 12px;"></div>
                                        <div class="row flex" style="border-bottom: 1px solid lightgray">
                                            <div class="col-7 m-1 p-1 fw-bold " style="font-size: small">
                                                <h4>Glass Option Prices</h4>
                                                <p style="font-size: small;font-variant: all-small-caps">(IF "included"
                                                    put '0' for
                                                    the price.)</p>
                                            </div>
                                            <div class="col-3 m-1 p-1">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row flex">
                                        <div class="col-3 p-1 m-1">
                                            {{$a->name}}
                                        </div>
                                        <div class="col-2 p-1 m-1">
                                            {{$a->doorMeasurement->width}} x {{$a->doorMeasurement->height}}
                                        </div>
                                        <div class="col-2 p-1 m-1">
                                            <label for="isNA">NA?</label>
                                            <input type="checkbox" class="lockSetIsNA" name="lock_set_is_na-{{$a->id}}"
                                                   id="lockSetIsNA-{{$a->id}}">
                                        </div>
                                        <div class="col-4 p-1 m-1">
                                            <input type="number" class="form-control dataField" placeholder="Price"
                                                   name="glass_option_price-{{$a->id}}"
                                                   id="lock_set_price-{{$a->id}}"
                                                   value="0">
                                        </div>
                                    </div>
                                    <?php $glassOptionCounter++; ?>
                                @endif
                                @if($a->is_custom_option> 0 && $a->has_price)
                                    @if($customOptCounter==0)
                                        <div style="margin: 12px;"></div>
                                        <div class="row flex" style="border-bottom: 1px solid lightgray">
                                            <div class="col-7 m-1 p-1 fw-bold " style="font-size: small">
                                                <h4>{{$a->group_name}}</h4>
                                                <p style="font-size: small;font-variant: all-small-caps">(IF "included"
                                                    put '0' for
                                                    the price.)</p>
                                            </div>
                                            <div class="col-3 m-1 p-1">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row flex">
                                        <div class="col-3 p-1 m-1">
                                            {{$a->name}}
                                        </div>
                                        <div class="col-2 p-1 m-1">
                                            {{$a->doorMeasurement->width}} x {{$a->doorMeasurement->height}}
                                        </div>
                                        <div class="col-2 p-1 m-1">
                                            <label for="isNA">NA?</label>
                                            <input type="checkbox" class="lockSetIsNA" name="lock_set_is_na-{{$a->id}}"
                                                   id="lockSetIsNA-{{$a->id}}">
                                        </div>
                                        <div class="col-4 p-1 m-1">
                                            <input type="number" class="form-control dataField" placeholder="Price"
                                                   name="custom_option_price-{{$a->id}}"
                                                   id="lock_set_price-{{$a->id}}"
                                                   value="0">
                                        </div>
                                    </div>
                                    <?php $customOptCounter++; ?>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>

    <div class="row bottom-button-bar" role="alert">
        <div class="col">
            <button class="btn btn-primary" id="continueButton">Continue...</button>
        </div>
    </div>
    <div class="d-none">

        @section('scripts')
            <script src="{{ asset('js/product/door/utility5.js') }}" defer></script>
    @stop
</x-app-layout>
