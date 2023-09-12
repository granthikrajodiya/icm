<x-layouts.auth title="{{ __('Logging out...') }}">
    <div class="col-sm-8 col-lg-4">
        <div class="card shadow zindex-100 mb-0">
            <div class="card-body px-md-5 py-5">
                 <div class="text-center mb-4">
                    <h1 class="h3 mb-0 text-gray-800">
                        {{ __('Logging out...') }}
                    </h1>
                    <h1 class="h5 py-2 fw-light">{{$message}}</h1>
                </div>
                <div class="text-center">
                    <i class="fas fa-2x fa-spinner fa-spin text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth>

<script>
    window.onload = function() {
        setTimeout(function() {
            window.location.href = "{{ route('logout', tenant('tenant_id')) }}";
        }, 3000);
    }
</script>
