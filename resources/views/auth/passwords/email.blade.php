<x-layouts.auth title="{{ __('Password reset') }}">
    <div class="col-sm-8 col-lg-5 col-xl-4">
        <div class="card shadow zindex-100 mb-0">
            <div class="card-body px-md-5 py-5">
                <div class="mb-4">
                    <h6 class="h3">{{ __('Password reset') }}</h6>
                    <p class="text-muted">{{ __('Enter your email below to proceed.') }}</p>
                    @if (session('status'))
                        <div class="badge badge-pill badge-primary" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <span class="clearfix"></span>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-control-label">{{ __('Email address') }}</label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="name@example.com" name="email" value="{{ old('email') }}" required
                                autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-sm btn-primary btn-icon rounded-pill">
                            <span class="btn-inner--text">{{ __('Reset password') }}</span>
                            <span class="btn-inner--icon"><i class="fas fa-long-arrow-alt-right"></i></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.auth>
