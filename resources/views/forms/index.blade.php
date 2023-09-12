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
                                        <a href="{{ route('forms.index', tenant('tenant_id')) }}"
                                            class="dropdown-item">
                                            <i class="fas fa-table" style="opacity: 0;"></i> {{-- Set opacity to 0 to hide icon but keeps the spacing --}}
                                            {{ __('Grid View') }}
                                        </a>
                                        <a href="{{ route('forms.index', [tenant('tenant_id'), 'list', 'asc']) }}"
                                            class="dropdown-item">
                                            <i class='fa fa-sort-alpha-down'></i>
                                            {{ __('A to Z') }}
                                        </a>
                                        <a href="{{ route('forms.index', [tenant('tenant_id'), 'list', 'desc']) }}"
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
                <div class="scrollbar-inner">
                    <div class="mh-690 min-h-690">
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                @if (count($forms->Data) > 0)
                                    @foreach ($orderBy === "desc" ? $forms->Data->sortByDesc('Name') : $forms->Data as $form)
                                        <a href="{{ route('forms.view', [tenant('tenant_id'), $form->ID]) }}"
                                            class="list-group-item list-group-item-action">
                                            <div class="d-flex">
                                                <div>
                                                    @if (\Storage::exists('logo/' . $form->ID . '.png'))
                                                        <img src="{{ asset(\Storage::url('logo/' . $form->ID . '.png')) }}"
                                                            height="40px" width="40px" class="mr-3">
                                                    @elseif(\Storage::exists('logo/'.$form->ID.'.jpg'))
                                                        <img src="{{ asset(\Storage::url('logo/' . $form->ID . '.jpg')) }}"
                                                            height="40px" width="40px" class="mr-3">
                                                    @else
                                                        <i class="fa fa-file-invoice fa-2x mr-3"></i>
                                                    @endif
                                                </div>
                                                <div>
                                                    <div class="text-sm text-dark font-weight-bold lh-150">
                                                        {{ $form->Name }}</div>
                                                    <small class="d-block text-muted">{{ strlen($form->Description) > 200 ? trim(substr($form->Description,0,200)).'...' : $form->Description }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @else
                                    <li class="media">
                                        <div class="media-body">
                                            <h6 class="text-center">{{ __('No data found.') }}</h6>
                                        </div>
                                    </li>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
