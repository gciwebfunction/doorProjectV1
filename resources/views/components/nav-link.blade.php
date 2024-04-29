@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'nav-link px-2 link-secondary active'
                : 'nav-link px-2 link-secondary ';
@endphp
<li class="" style="font-size: small">
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
</li>
