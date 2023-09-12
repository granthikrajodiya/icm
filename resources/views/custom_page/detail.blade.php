<x-layouts.app
    title="{{ !empty($customPage->title) ? $customPage->title : __('Custom Page') }}"
>
    <div class="card">
        @if(!is_null($customPage))
            <div class="card-body">
                {!! $customPage->detail !!}
            </div>
        @endif
    </div>
</x-layouts.app>
