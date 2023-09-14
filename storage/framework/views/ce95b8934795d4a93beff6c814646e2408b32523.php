<?php if (isset($component)) { $__componentOriginal64991b2ba2a9e76530ef8b84daa936f7a6c0a751 = $component; } ?>
<?php $component = App\View\Components\Layouts\Auth::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layouts.auth'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Layouts\Auth::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('Login')).'']); ?>
    <?php ($tenant_id = tenant('tenant_id') ?? 'host'); ?>

    <div class="col-sm-8 col-lg-4">
        <div class="card shadow zindex-100 mb-0">
            <div class="card-body px-md-5 py-5">
                <div class="mb-4">
                    <h6 class="h3"><?php echo e(__('Login')); ?></h6>
                    <p class="text-muted mb-0"><?php echo e(__('Sign in to your account to continue.')); ?></p>
                </div>
                <span class="clearfix"></span>
                <form method="POST" action="<?php echo e(route('login', $tenant_id)); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label class="form-control-label"><?php echo e(__('Username')); ?></label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input id="username" type="text"
                                class="form-control <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="username"
                                value="<?php echo e(old('username')); ?>" required autocomplete="username" />
                            <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <label class="form-control-label"><?php echo e(__('Password')); ?></label>
                            </div>

                        </div>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input id="password" type="password"
                                class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required
                                autocomplete="current-password" />
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <a href="#" data-toggle="password-text" data-target="#password">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                        <?php if(session()->has('success')): ?>
                            <div class="valid-feedback" style="display: block !important;" role="alert">
                                <?php echo e(session()->get('success')); ?>

                            </div>
                        <?php endif; ?>
                        <div class="my-4">
                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="remember"
                                    <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                <label class="custom-control-label" for="remember"><?php echo e(__('Remember Me')); ?></label>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-sm btn-primary btn-icon rounded-pill">
                                <span class="btn-inner--text"><?php echo e(__('Sign in')); ?></span>
                                <span class="btn-inner--icon"><i class="fas fa-long-arrow-alt-right"></i></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <?php if(tenant()->user_register): ?>
                <div class="card-footer px-md-5" style="display: flex;justify-content: space-between;">
                    <a href="<?php echo e(route('register', $tenant_id)); ?>" class="small font-weight-bold"><?php echo e(__('Create account')); ?></a>
					<?php if(Route::has('password.reset.request')): ?>
						<a href="<?php echo e(route('password.reset.request', $tenant_id)); ?>" class="small font-weight-bold"><?php echo e(__('Lost password?')); ?></a>
					<?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal64991b2ba2a9e76530ef8b84daa936f7a6c0a751)): ?>
<?php $component = $__componentOriginal64991b2ba2a9e76530ef8b84daa936f7a6c0a751; ?>
<?php unset($__componentOriginal64991b2ba2a9e76530ef8b84daa936f7a6c0a751); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/ICM/ILINXEngage (6-26-2023)/code /resources/views/auth/login.blade.php ENDPATH**/ ?>