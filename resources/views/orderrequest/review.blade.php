<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details')  }}
        </h2>
    </x-slot>
    <div class="container py-4">
        <div id="container">
            <div class="mb-3">
                <label for="distributorSelect" class="form-label">Distributor</label>
                <select class="form-control" id="distributorSelect" name="distributor">
                    <option value="-1">No distributor selected.</option>
                    @foreach($distributors as $distributor)
                        <option value="{{$distributor->id}}">{{$distributor->distributor_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="dealerSelect" class="form-label">Distributor</label>
                <select class="form-control" id="dealerSelect" name="dealer">
                    <option value="-1">No dealer selected.</option>
                    @foreach($dealers as $dealer)
                        <option value="{{$dealer->id}}">{{$dealer->distributor_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
        </div>
    </div>

    @section('scripts')
{{--        <script src="{{ asset('js/orderrequest/view.js') }}" defer></script>--}}
    @stop
</x-app-layout>
