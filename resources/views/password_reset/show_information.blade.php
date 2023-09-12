<x-layouts.auth title="{{ __('Password reset') }}">
    <div class="col-sm-8 col-lg-5 col-xl-4">
        <div class="card shadow zindex-100 mb-0">
            <div class="card-body px-md-5 py-5 pb-4">
                <div class="mb-4">
                    <h6 class="h3">{{ __('Password reset') }}</h6>
                </div>
                <span class="clearfix"></span>
                @if( isset($notAllowed) )
                    <p class="text-muted">
                        {{ Utility::getValByName('no_password_reset_message') }}
                    </p>
                    <p class="text-muted">{{ __('We apologize for any inconvenience.') }}</p>
                    <p class="text-muted">{{ __('Thank you.') }}</p>
                @elseif(isset($message))
                    <p class="text-muted">
                        {{ $message }}
                    </p>
                @endif

            </div>
            <div class="card-footer px-md-5">
                <a href="{{ route('login', tenant('tenant_id')) }}"
                   class="small font-weight-bold">{{ __('Back to Sign in') }}
                </a>
            </div>
        </div>
    </div>
</x-layouts.auth>
