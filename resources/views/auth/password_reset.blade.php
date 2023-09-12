<x-layouts.auth title="{{ __('Password reset') }}">
    <div class="col-sm-8 col-lg-5 col-xl-4">
        <div class="card shadow zindex-100 mb-0">
            <div class="card-body px-md-5 py-5">
                <div class="mb-4">
                    <h6 class="h3">{{ __('Password reset') }}</h6>
                </div>
                <span class="clearfix"></span>
                <p class="text-muted">
                    {{ __('In order to reset your account password please contact our offices by calling (360)555-1212 between the hours of 8:00AM and 5:00PM Pacific.') }}
                </p>
                <p class="text-muted">{{ __('We apologize for any inconvenience.') }}</p>
                <p class="text-muted">{{ __('Thank you.') }}</p>
            </div>
            @if (tenant()->user_register)
                <div class="card-footer px-md-5"><small>{{ __('Not registered?') }}</small>
                    <a href="{{ route('register', $tenantId) }}"
                        class="small font-weight-bold">{{ __('Create account') }}</a>
                </div>
            @endif
        </div>
    </div>
</x-layouts.auth>
