<x-layouts.auth title="{{ __('Password reset') }}">
    <div class="col-sm-8 col-lg-5 col-xl-4">
        <div class="card shadow zindex-100 mb-0">
            <div class="card-body px-md-5 py-5">
                <div class="mb-2">
                    <h6 class="h3">{{ __('Reset Password') }}</h6>
                </div>
                <span class="clearfix"></span>
                <form method="POST" action="{{ route('password.reset', tenant('tenant_id')) }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="tenant_id" value="{{ isset($tenant_id) ? $tenant_id : null }}">
                    <div class="form-group">
                        <label class="form-control-label">{{ __('Username') }}</label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                                   placeholder="Username" name="username" value="{{ isset($username) ? $username : '' }}" required
                                   autocomplete="username" autofocus {{ isset($username) ? 'readonly': ''  }}>
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @if(session()->has('success'))
                                <div class="valid-feedback" style="display: block !important;" role="alert">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-control-label">{{ __('Password') }}</label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <a href="#" data-toggle="password-text" data-target="#password">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </span>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-control-label">{{ __('Confirm password') }}</label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input id="password-confirm" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required
                                   autocomplete="new-password">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <a href="#" data-toggle="password-text" data-target="#password-confirm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </span>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    @error('extra_error')
                    <div class="form-group">
                        <small class="text-danger font-weight-bold">{{ $message }}</small>
                    </div>
                    @enderror
                    <div class="mt-4">
                        <button type="submit" class="btn btn-sm btn-primary btn-icon rounded-pill">
                            <span class="btn-inner--text">{{ __('Reset password') }}</span>
                            <span class="btn-inner--icon"><i class="fas fa-long-arrow-alt-right"></i></span>
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer px-md-5">
                <a href="{{ route('login', tenant('tenant_id')) }}"
                   class="small font-weight-bold">{{ __('Back to Sign in') }}
                </a>
            </div>
        </div>
    </div>
</x-layouts.auth>
