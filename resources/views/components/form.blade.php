@props(['action' => null, 'put' => false, 'get' => false, 'patch' => false, 'delete' => false, 'upload' => false])

@php
    $method = isset($method) ? 'GET' : 'POST';
@endphp

<form {{ $attributes }} method="{{ $method }}"
      @if ($action) action="{{ $action }}" @endif
      @if ($upload) enctype="multipart/form-data" @endif>
    @if ($method === 'POST')
        @csrf
    @endif

    @if ($put)
        @method('PUT')
    @endif

    @if ($patch)
        @method('PATCH')
    @endif

    @if ($delete)
        @method('DELETE')
    @endif

    {{ $slot }}
</form>
