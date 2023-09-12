<x-layouts.app title="{{ __('Dashboards') }}">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center">
                        <div class="col">
                            <h6 class="mb-0"><span id="menu_title">{{ __('Dashboards') }}</span></h6>
                        </div>
                        <div class="col text-right">
                            <div class="actions">
                                <div class="dropdown">
                                    <a href="#" class="action-item" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{ route('dashboards.index', tenant('tenant_id')) }}"
                                            class="dropdown-item">
                                            <i class="fas fa-table" style="opacity: 0;"></i> {{-- Set opacity to 0 to hide icon but keeps the spacing --}}
                                            {{ __('Grid View') }}
                                        </a>
                                        <a href="{{ route('dashboards.index', [tenant('tenant_id'), 'list', 'asc']) }}"
                                            class="dropdown-item">
                                            <i class='fa fa-sort-alpha-down'></i>
                                            {{ __('A to Z') }}
                                        </a>
                                        <a href="{{ route('dashboards.index', [tenant('tenant_id'), 'list', 'desc']) }}"
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
                            @if (count($dashboards->Data) > 0)
                                @foreach ($orderBy === "desc" ? $dashboards->Data->sortByDesc('Name') : $dashboards->Data as $dashboard)
                                    @php
                                        $viewurl = explode(config('ilinx.flex_url').'/embedded-dashboard?param=',$dashboard->ViewUrl);
                                        $url = route('dashboards.detail',[tenant('tenant_id'), $viewurl[1]]);
                                    @endphp
                                    <a href="{{ $url }}" class="list-group-item list-group-item-action">
                                        <div class="d-flex">
                                            <div>
                                                <i class="fa fa-chart-area fa-2x mr-3"></i>
                                            </div>
                                            <div>
                                                <div class="text-sm text-dark font-weight-bold lh-150">
                                                    {{ $dashboard->Name }}
                                                </div>
                                                <small class="d-block text-muted">{{ strlen($dashboard->Description) > 200 ? trim(substr($dashboard->Description,0,200)).'...' : $dashboard->Description }}</small>
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
