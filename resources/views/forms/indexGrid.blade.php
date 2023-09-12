<x-layouts.app title="{{ __('Forms') }}">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center">
                        <div class="col">
                            <h6 class="mb-0"><span id="menu_title">{{ __('Forms') }}</span></h6>
                        </div>
                        <div class="col text-right">
                            <div class="actions">
                                <div class="dropdown">
                                    <a href="#" class="action-item" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{ route('forms.index', [tenant('tenant_id'), 'list']) }}"
                                            class="dropdown-item">
                                            <i class="fas fa-list" style="opacity: 0;"></i> {{-- Set opacity to 0 to hide icon but keeps the spacing --}}
                                            {{ __('List View') }}
                                        </a>
                                        <a href="{{ route('forms.index', [tenant('tenant_id'), 'asc']) }}"
                                            class="dropdown-item">
                                            <i class="fa fa-sort-alpha-down"></i>
                                            {{ __('A to Z') }}
                                        </a>
                                        <a href="{{ route('forms.index', [tenant('tenant_id'), 'desc']) }}"
                                            class="dropdown-item">
                                            <i class="fa fa-sort-alpha-up"></i>
                                            {{ __('Z to A') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        @if (count($forms->Data) > 0)
                            @foreach ($view === "desc" ? $forms->Data->sortByDesc('Name') : $forms->Data as $form)
                                <div class="col-xl-3 col-lg-4 col-sm-6">
                                    <div class="card hover-shadow-lg">
                                        <div class="card-body text-center">
                                            <a href="{{ route('forms.view', [tenant('tenant_id'), $form->ID]) }}"
                                                class="hover-translate-y-n3 text text-muted">
                                                @if (\Storage::exists('logo/' . $form->ID . '.png'))
                                                    <img src="{{ asset(\Storage::url('logo/' . $form->ID . '.png')) }}"
                                                        height="40px" width="40px">
                                                @elseif(\Storage::exists('logo/'.$form->ID.'.jpg'))
                                                    <img src="{{ asset(\Storage::url('logo/' . $form->ID . '.jpg')) }}"
                                                        height="40px" width="40px">
                                                @else
                                                    <i class="fa fa-file-invoice fa-2x mr-3"></i>
                                                @endif
                                            </a>
                                            <h5 class="h6 mt-4">
                                                <a href="{{ route('forms.view', [tenant('tenant_id'), $form->ID]) }}">
                                                    {{ $form->Name }}
                                                </a>
                                            </h5>
                                            <p class="text text-xs">{{ strlen($form->Description) > 200 ? trim(substr($form->Description,0,200)).'...' : $form->Description }}</p>
                                        </div>
                                        <div class="card-footer text-right text-sm">
                                            <a href="{{ route('forms.view', [tenant('tenant_id'), $form->ID]) }}">
                                                {{ __('Open') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-12">
                                <div class="card hover-shadow-lg">
                                    <div class="card-body text-center">
                                        <h5 class="h6 mt-4">{{ __('No data found.') }}</h5>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
