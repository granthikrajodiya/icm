@props([
    'menu',
    'id',
    'menuClass' => null,
    'overflow' => null,
    'bordered' => null
])

<ul {{ $attributes->except('class')->class([
    'nav nav-tabs',
    'nav-overflow' => $overflow,
    'nav-bordered' => $bordered,
])->merge(['class' => $menuClass]) }} role="tablist" id="{{ $id }}">
    {{ $menu }}
</ul>

<div class="tab-content pt-3 min-h-430">
    {{ $slot }}
</div>
