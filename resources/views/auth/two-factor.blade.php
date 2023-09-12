<x-layouts.auth title="{{ __('Two-Factor Authentication') }}">
    <div class="col-sm-8 col-lg-4">
        <div class="card shadow zindex-100 mb-0">
            <div class="card-body px-md-5 py-5">
                <div class="mb-4">
                    <h6 class="h3">{{ __('Verification Code') }}</h6>

                    <div class="w-full d-flex justify-content-center my-4">
                        <img src="{{ asset('assets/img/two-factor/code.png') }}" alt="Verification Code">
                    </div>

                    <p class="text-muted mb-0">{{ __('A verification code has been sent to: :email.', ['email' => user()->masked_email]) }}</p>
                    <p class="text-muted mb-0">{{ __('This code will be valid for 15 minutes.') }}</p>
                </div>

                <span class="clearfix"></span>

                <form method="POST" action="{{ route('two-factor.authenticate', tenant('tenant_id')) }}">
                    @csrf

                    <div class="form-group">
                        <label class="form-control-label">{{ __('Code') }}</label>

                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>

                            <input id="code" type="text"
                                class="form-control @error('code') is-invalid @enderror" 
                                name="code"
                                value="{{ old('code') }}" 
                                required 
                                autocomplete="code" 
                                autofocus />

                            @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <div class="mt-4">
                            <button type="submit" class="btn btn-sm btn-primary btn-icon rounded-pill">
                                <span class="btn-inner--text">{{ __('Validate') }}</span>
                                <span class="btn-inner--icon"><i class="fas fa-long-arrow-alt-right"></i></span>
                            </button>
                        </div>
                    </div>
                </form>

                <form method="POST" action="{{ route('two-factor.send-email', tenant('tenant_id')) }}">
                    @csrf

                    <div class="pt-2">
                        <button type="submit" class="btn btn-link p-0">
                            <small>{{ __("Didn't receive a code? Resend.") }}</small>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.auth>
