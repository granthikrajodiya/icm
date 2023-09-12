<x-layouts.auth title="{{ __('Login') }}">
    @php($tenant_id = tenant('tenant_id') ?? 'host')

    <div class="col-sm-8 col-lg-4">
        <div class="card shadow zindex-100 mb-0">
            <div class="card-body px-md-5 py-5">
                <div class="mb-4">
                    <h6 class="h3">{{ __('Login') }}</h6>
                    <p class="text-muted mb-0">{{ __('Sign in to your account to continue.') }}</p>
                </div>
                <span class="clearfix"></span>
                <form method="POST" action="{{ route('login', $tenant_id) }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-control-label">{{ __('Username') }}</label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input id="username" type="text"
                                class="form-control @error('username') is-invalid @enderror" name="username"
                                value="{{ old('username') }}" required autocomplete="username" />
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <label class="form-control-label">{{ __('Password') }}</label>
                            </div>

                        </div>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password" />
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <a href="#" data-toggle="password-text" data-target="#password">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                        @if(session()->has('success'))
                            <div class="valid-feedback" style="display: block !important;" role="alert">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        <div class="my-4">
                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-sm btn-primary btn-icon rounded-pill">
                                <span class="btn-inner--text">{{ __('Sign in') }}</span>
                                <span class="btn-inner--icon"><i class="fas fa-long-arrow-alt-right"></i></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            @if (tenant()->user_register)
                <div class="card-footer px-md-5" style="display: flex;justify-content: space-between;">
                    <a href="{{ route('register', $tenant_id) }}" class="small font-weight-bold">{{ __('Create account') }}</a>
					@if (Route::has('password.reset.request'))
						<a href="{{ route('password.reset.request', $tenant_id) }}" class="small font-weight-bold">{{ __('Lost password?') }}</a>
					@endif
                </div>
            @endif
        </div>
    </div>
</x-layouts.auth>
