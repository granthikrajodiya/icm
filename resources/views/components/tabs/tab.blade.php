@props(['id', 'active' => false])

<div class="tab-pane fade @if ($active) active show @endif" id="{{ $id }}" role="tabpanel" aria-labelledby="{{ $id }}-tab">
    <div class="row">
        <div class="col-12">
            {{ $slot }}
        </div>
    </div>
</div>
