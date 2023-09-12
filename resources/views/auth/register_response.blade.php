<x-layouts.auth title="{{ __('Register') }}">
    <div class="col-sm-8 col-lg-5">
        <div class="card shadow zindex-100 mb-0">
            <div class="card-body px-md-5 py-5">
                <div class="mb-3">
                    <h6 class="h3">{{ $message['header'] }}</h6>
                </div>
                <span class="clearfix"></span>
                <div>{!! $message['msg'] !!}</div>
            </div>
            <div class="card-footer px-md-5">
                <a href="{{ route('login', $tenantId) }}" class="small font-weight-bold">{{ __('Sign In') }}</a>
            </div>
        </div>
    </div>
</x-layouts.auth>
