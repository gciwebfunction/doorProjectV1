<!-- Navigation Links -->
@php
    $noti3 = $orderRequests3lvel[0]->counttii??0;
    $noti2 = $orderRequests2lvel[0]->counttii??0;
    $not_tot  = $noti3+$noti2;
@endphp
<div class="container sticky-top bg-white" style="min-width: 1300px; border-bottom: 1px solid gray">
    <header
        class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4  bg">
{{--        <a class="navbar-brand" href="{{ url('/') }}">GCI</a>--}}

        <img src="{{asset('storage/neumadoor-logo.jpg')}}">

        <ul class="nav mb-2 justify-content-center mb-md-0">

            @can(['c_sales_manager','c_distributor','c_sales_user','c_direct_dealer'])
                <x-nav-link :href="route('manufdashboard')" :active="request()->routeIs('manufdashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link>
            @else
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link>
            @endcan


            <li><form method="get" name="category_select"  id="category_select" action="/category_dashboard/id">
                    <select style="cursor:pointer;"  name="category_list" class="hero" id="main_drop"  onchange="this.form.submit()" required>
                        <option value="">Category</option>
                        @php
                            foreach ($categoriesdeop as $category){
                        @endphp
                        <option value="{{$category->id}}">{{ __($category->category_name) }}</option>
                        @php
                            }
                        @endphp
                </select>
                </form>
            </li>


            @can('r_category')
                <x-nav-link :href="route('cview')" :active="request()->routeIs('cview')">
                    {{ __('Categories Management') }}
                </x-nav-link>
            @endcan
            @can('c_product')
                <x-nav-link :href="route('pview')" :active="request()->routeIs('pview')">
                    {{ __('Product Management') }}
                </x-nav-link>
            @endcan
            @can('r_user')
                <x-nav-link :href="route('uview')" :active="request()->routeIs('uview')">
                    {{ __('Users') }}
                </x-nav-link>
            @endcan
            @can('cf_order')
                <x-nav-link :href="route('oview')" :active="request()->routeIs('oview')">
                    {{ __('Orders') }} ({{$not_tot}})
                </x-nav-link>
            @endcan



        </ul>

        <ul class="nav mb-2  mb-md-0">
            @can('r_order')
                <x-nav-link :href="route('cartviewdoor',['shoppingCartId'=>0])"
                            :active="request()->routeIs('cartviewdoor',['shoppingCartId'=>0])">
{{--                    <img src="/img/shoppingCartPng.png" title="Shopping Cart" width="35" >--}}
                    Cart
                    </a>
                </x-nav-link>
            @endcan
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-nav-link :href="route('logout')"
                                                   onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                Logout
                            </x-nav-link>
                        </form>

            <li><div class="dropdown">

                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false" style="   text-transform: capitalize;">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li>{{ Auth::user()->email }}</li>
                        <li><hr class="dropdown-divider"> </li>
                        <li>
                            <x-responsive-nav-link :href="route('permviewuser')">
                                {{ __('User Details') }}
                            </x-responsive-nav-link>
                        </li>
                    </ul>
                </div></li>
        </ul>

{{--        <form method="POST" action="{{ route('logout') }}">--}}
{{--            @csrf--}}
{{--            <x-responsive-nav-link :href="route('logout')"--}}
{{--                                   onclick="event.preventDefault();--}}
{{--                                        this.closest('form').submit();">--}}
{{--                <ul class="navbar-nav me-auto mb-2 mb-md-0" style="padding-right: 10px;">--}}
{{--                    <li class="nav-item">{{ __('Log Out') }}</li>--}}
{{--                </ul>--}}
{{--            </x-responsive-nav-link>--}}
{{--        </form>--}}



    </header>
</div>

<style>
    .hero{
        color: #0056b2;
        margin-top: 8px;
        border: none;
        font-size: small;
    }
</style>








