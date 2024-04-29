<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a Product') }}
        </h2>
    </x-slot>
    <div class="container py-4">
        <div class="container" style="margin-top: 3px; min-width: 600px">
            <form class="row g-3" action="/p/editdoorflow/updatestepthree" method="POST" enctype="multipart/form-data"
                  id="additionalOptionsPriceForm">
                <input type="hidden" value="{{$door->id}}" name="door_id" id="doorId">
                <input type="hidden" id="hiddenIdList" name="hidden_id_list" value="">
                @csrf

                <div style="display: grid; grid-template-columns: 1fr 3fr">
                    <div class="left-1/3" style="margin-right: 2px; padding-right: 1px">
                        <div class="alert alert-success" role="alert">
                            <h2 class="alert-heading"><strong>Edit Product Information</strong></h2>
                            <p>Set prices for sizes / options.</p>
                            <hr>

                        </div>
                    </div>
                    <div class="right-2/3">

                        <div class="accordion" id="accordianContainer">
                            @foreach($uniqueOptionList as $uniqueOption)
                                <?php $counter = 0; $kk = 0  ?>
                                @foreach($door->additionalOptions as $a)


                                    @if($uniqueOption == $a->group_name )


                                        @if($counter==0)
                                            <div class="card">
                                                <div class="card-header" id="heading{{$loop->index}}">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button"
                                                                data-toggle="collapse"
                                                                data-target="#collapse{{$loop->index}}"
                                                                @if($loop->index>0)
                                                                aria-expanded="false"
                                                                @else
                                                                aria-expanded="true"
                                                                @endif
                                                                aria-controls="collapse{{$loop->index}}">
                                                                {{$a->group_name}}
 {{--                                                            @switch($a->group_name)--}}
{{--                                                                @case("OPT_SPEC")--}}
{{--                                                                Optional specification--}}
{{--                                                                @break--}}
{{--                                                                @case("GLASS_OPTION")--}}
{{--                                                                Glass Options--}}
{{--                                                                @break--}}
{{--                                                                @case("GLASS_DEPTH_OPTION")--}}
{{--                                                                Glass Depth--}}
{{--                                                                @break--}}
{{--                                                                @case("HANDLE_TYPE_OPTION")--}}
{{--                                                                Handle Types--}}
{{--                                                                @break--}}
{{--                                                                @case("LOCK_SET_OPTION")--}}
{{--                                                                Lock Set--}}
{{--                                                                @break--}}
{{--                                                                @case("GLASS_GRID")--}}
{{--                                                                Glass Grid Options--}}
{{--                                                                @break--}}
{{--                                                                @case("FRAME_THICKNESS_OPTION")--}}
{{--                                                                Frame Thickness--}}
{{--                                                                @break--}}
{{--                                                                @default--}}
{{--                                                                {{'mango'}}--}}
{{--                                                                {{$a->group_name}}--}}
{{--                                                            @endswitch--}}
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="collapse{{$loop->index}}"
                                                     class="collapse {{$loop->index>0?'':'show'}}"
                                                     aria-labelledby="heading{{$loop->index}}"
                                                     data-parent="#accordianContainer">
                                                    <div class="card-body">
                                                        @endif
                                                        <div class="row flex sdlPriceRow">
                                                            <div class="col-2 p-1 m-1">
                                                                {{$a->name}}
                                                            </div>
                                                            <div class="col-2 p-1 m-1">
                                                                @foreach($door->doorMeasurements as $m)
                                                                    @if($a->door_measurement_id == $m->id)
                                                                        W{{$m->width}} x H{{$m->height}}
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                            {{--  name="sdl_is_na-{{$a->id}}"--}}
                                                            <div class="col-2 p-1 m-1">
                                                                <label style="visibility: hidden" for="isNA">NA?</label>
                                                                <input type="hidden" name="arr_vale[]"  value="{{$a->id}}">


                                                                <input style="visibility: hidden" type="checkbox" class="sdlIsNA"
                                                                    name="sdl_is_na[]"
                                                                    id="sdlIsNA-{{$a->id}}"
                                                                @php
                                                                if(  empty($a->disabled ) || $a->disabled  == '0'){
                                                                    $valuee = '0' ;
                                                                    $cjecke = '';
                                                                    $diabled = '';
                                                                    $readonl = '';

                                                                } else{
                                                                    $valuee = '1' ;
                                                                    $cjecke = 'checked';
                                                                    $diabled = 'disabled';
                                                                    $readonl = 'readonly';
                                                                }

                                                                //$valuee = '1';
                                                                $cjecke = $a->disabled == 0 ? '':'checked="checked"' ;
                                                                @endphp
                                                                       {{$cjecke}}
                                                                        value="{{$valuee}}"

                                                                >
                                                            </div>
                                                            <div class="col-4 p-1 m-1">
                                                                <input type="number"
                                                                       class="form-control dataField sdlOptionPRice"
                                                                       placeholder="Price"
{{--                                                                       name="sdl_option_price-{{$a->id}}"--}}
                                                                       name="sdl_option_price[]"
                                                                       id="sdl_option_price-{{$a->id}}"
                                                                       value="{{$a->price}}"   >
                                                            </div>
                                                        </div>
                                                        <?php $counter++?>
                                                        @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach

{{--                                            logic for glass grid etc--}}

                                                <div class="card">
                                                    <div class="card-header" id="heading381">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse381999" aria-expanded="false" aria-controls="collapse381999">
                                                                GLASS_GRID
                                                            </button>
                                                        </h5>
                                                    </div>
                                                    <div id="collapse381999" class="collapse " aria-labelledby="heading381999" data-parent="#accordianContainer">
                                                        <div class="card-body">
                                                            @foreach($addOn_option_GG as $a)
                                                                <div class="row flex sdlPriceRow">
                                                            {{--  loop the options --}}


                                                                <div class="col-2 p-1 m-1">
                                                                    {{$a->name}}
                                                                </div>
                                                                <div class="col-2 p-1 m-1">
                                                                    @foreach($door->doorMeasurements as $m)
                                                                        @if($a->door_measurement_id == $m->id)
                                                                            W{{$m->width}} x H{{$m->height}}
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                                {{--  name="sdl_is_na-{{$a->id}}"--}}
                                                                <div class="col-2 p-1 m-1">
                                                                    <label style="visibility: hidden" for="isNA">NA?</label>
                                                                    <input type="hidden" name="arr_vale[]"  value="{{$a->id}}">


                                                                    <input style="visibility: hidden" type="checkbox" class="sdlIsNA"
                                                                           name="sdl_is_na[]"
                                                                           id="sdlIsNA-{{$a->id}}"
                                                                           @php
                                                                               if(  empty($a->disabled ) || $a->disabled  == '0'){
                                                                                   $valuee = '0' ;
                                                                                   $cjecke = '';
                                                                                   $diabled = '';
                                                                                   $readonl = '';

                                                                               } else{
                                                                                   $valuee = '1' ;
                                                                                   $cjecke = 'checked';
                                                                                   $diabled = 'disabled';
                                                                                   $readonl = 'readonly';
                                                                               }

                                                                               //$valuee = '1';
                                                                               $cjecke = $a->disabled == 0 ? '':'checked="checked"' ;
                                                                           @endphp
                                                                           {{$cjecke}}
                                                                           value="{{$valuee}}"

                                                                    >
                                                                </div>
                                                                <div class="col-4 p-1 m-1">
                                                                    <input type="number"
                                                                           class="form-control dataField sdlOptionPRice"
                                                                           placeholder="Price"
                                                                           {{--                                                                       name="sdl_option_price-{{$a->id}}"--}}
                                                                           name="sdl_option_price[]"
                                                                           id="sdl_option_price-{{$a->id}}"
                                                                           value="{{$a->price}}"   >
                                                                </div>




                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>






                        </div>
                        <div style="margin: 12px;"></div>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="" style=";text-align: right; margin-top: 5px; padding-top: 2px;">
        <div class="alert alert-warning" role="alert" style="; margin: 5px auto 0; text-align: right">
            <div class="row">
                <div class="col-sm" style="text-align: right;">
                    <button class="button-gci" id="continueButton">
                        Continue...
                    </button>
                </div>
            </div>
        </div>
    </div>

    </div>
    <div class="d-none">

    </div>
    @section('scripts')
        <script src="{{ asset('js/product/door/editutility5.js') }}" defer></script>
    @stop
</x-app-layout>
