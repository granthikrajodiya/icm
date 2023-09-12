<x-layouts.app
    title="{{__('Dashboard')}}"
    header="{{ Utility::getSalutation().' '.user()->name.'!' }}"
>
    @if(!is_array($responseArr['top']) && !is_array($responseArr['middle']) && !is_array($responseArr['bottom']))
        @if($responseArr['top']->count() > 0 || $responseArr['middle']->count() > 0 || $responseArr['bottom']->count() > 0)
            @if($responseArr['layout_type'] == 1)
                @include('admin.fixed_layout',['layouts'=>$responseArr])
            @else
                @include('admin.dynamic_layout',['layouts'=>$responseArr])
            @endif

        @endif
    @endif
</x-layouts.app>
