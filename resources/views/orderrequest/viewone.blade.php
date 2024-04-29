<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Request Information')  }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <h5>Order Information</h5>
        <div class="row">
            <div class="col" style="width: 49%; border: 1px solid lightgray">
                <h5>Buyer Information</h5>
            </div>
            <div class="col" style="width: 49%; border: 1px solid lightgray">
                <h5>Seller Information</h5>
            </div>
        </div>
    </div>

    @section('scripts')
        {{--        <script src="{{ asset('js/orderrequest/view.js') }}" defer></script>--}}
    @stop
</x-app-layout>

