
@if(!tenant()->user_register)
    <script>window.location = "/{{ tenant('tenant_id') }}/login";</script>
@endif

<x-layouts.auth title="{{ __('Register') }}">
    @php($tenant_id = tenant('tenant_id') ?? 'host')

    <div class="col-sm-8 col-lg-5">
        <div class="card shadow zindex-100 mb-0">
            @if (env('ILINX_REGISTRATION_FORM_URL') && !empty(env('ILINX_REGISTRATION_FORM_URL')))
                <iframe id="registerFrame" scrolling="no" src="{!! env('ILINX_REGISTRATION_FORM_URL') !!}"
                    style="height:720px;width: 561px;"></iframe>
            @else
                <div class="card-body px-md-5 py-5">
                    <div class="mb-3">
                        <h6 class="h3">{{ __('Create account') }}</h6>
                    </div>
                    <span class="clearfix"></span>
                    <form method="POST" action="{{ route('register', $tenant_id) }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Name') }}</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Username') }}</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input id="username" type="text"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    value="{{ old('username') }}" required autocomplete="username">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Email address') }}</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="form-control-label">{{ __('Password') }}</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">
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
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Confirm password') }}</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="my-4">
                            <div class="custom-control custom-checkbox mb-3">
                                <input required type="checkbox" class="custom-control-input" id="check-terms">
                                <label class="custom-control-label" for="check-terms">{{ __('I agree to the') }} <a
                                        href="{{ Utility::getValByName('terms_conditions') }}"
                                        target="_blank">{{ __('Terms and conditions') }}</a></label>
                            </div>
                        </div>
                        @if (Session::has('reg_error'))
                            <label
                                class="form-control-label text text-danger">{{ Session::get('reg_error') }}</label>
                            {{ Session::forget('reg_error') }}
                        @endif
                        <div class="mt-4">
                            <button type="submit" class="btn btn-sm btn-primary btn-icon rounded-pill">
                                <span class="btn-inner--text">{{ __('Create my account') }}</span>
                                <span class="btn-inner--icon"><i class="fas fa-long-arrow-alt-right"></i></span>
                            </button>
                        </div>
                    </form>
                </div>
            @endif
            <div class="card-footer px-md-5"><small>{{ __('Already have an acocunt?') }}</small>
                <a href="{{ route('login', $tenant_id) }}" class="small font-weight-bold">{{ __('Sign in') }}</a>
            </div>
        </div>
    </div>
</x-layouts.auth>
