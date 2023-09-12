<x-layouts.app title="{{ $docs }}">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header actions-toolbar border-0">
                    <div class="actions-search" id="actions-search">
                        <div class="input-group input-group-merge input-group-flush">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent"><i class="fas fa-search"></i></span>
                            </div>
                            <input type="text" class="form-control form-control-flush" id="input_keyword"
                                   placeholder="{{ __('Type keyword..') }}">
                            <div class="input-group-append">
                                <a href="#" class="input-group-text bg-transparent" data-action="search-close"
                                    data-target="#actions-search"><i class="fas fa-times"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-between align-items-center">
                        <div class="col">
                            <h6 class="d-inline-block mb-0"><i class="fa fa-file"></i>
                                {{ __('Documents : ') . $docs . ' ' }} <span
                                    class="badge badge-success badge-xs">{{ $arrDocData['cntNewDoc'] }}</span></h6>
                            <span class="d-block text-sm font-italic">{{ $arrDocData['cntDoc'] . __(' documents') }}
                            </span>
                        </div>
                        <div class="col text-right">
                            <div class="actions">
                                <a href="#" class="action-item mr-3" data-action="search-open"
                                   data-target="#actions-search"><i class="fas fa-search"></i></a>
                                <div class="dropdown mr-3">
                                    <a href="#" class="action-item" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-filter"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end"
                                         style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(22px, 25px, 0px);">
                                        <a class="dropdown-item {{ $orderBy == 'newest' || empty($orderBy) ? 'active' : '' }}"
                                           href="{{ route('docs.grid.index', [tenant('tenant_id'), $docs, 'newest']) }}">
                                            <i class="fas fa-sort-amount-down"></i>{{ __('Newest') }}
                                        </a>
                                        <a class="dropdown-item {{ $orderBy == 'asc' ? 'active' : '' }}"
                                           href="{{ route('docs.grid.index', [tenant('tenant_id'), $docs, 'asc']) }}">
                                            <i class="fas fa-sort-alpha-down"></i>{{ __('From A-Z') }}
                                        </a>
                                        <a class="dropdown-item {{ $orderBy == 'desc' ? 'active' : '' }}"
                                           href="{{ route('docs.grid.index', [tenant('tenant_id'), $docs, 'desc']) }}">
                                            <i class="fas fa-sort-alpha-up"></i>{{ __('From Z-A') }}
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a href="#" class="action-item" role="button" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{ route('docs.index', [tenant('tenant_id'), $docs]) }}"
                                           class="dropdown-item">{{ __('List View') }}</a>
                                        @if (!empty($newDocUrl))
                                            <a href="#" class="dropdown-item"
                                               data-url="{{ route('docs.popup', tenant('tenant_id')) }}"
                                               data-ajax-popup="true" data-size="md"
                                               data-title="{{ __('Document Upload') }}">{{ __('New Document') }}</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row" id="grid_data">
                        @foreach ($documentData as $key => $doc)
                            @php
                                $icon = Utility::GetDocProp($doc, 'Icon');
                                $icon = !empty($icon) ? $icon : 'fa fa-file-text-o';
                                $icon .= ' fa-2x';
                            @endphp
                            <div class="col-xl-3 col-lg-4 col-sm-6 grid_record">
                                <div class="card hover-shadow-lg">
                                    <div class="card-header border-0 pb-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div></div>
                                            <div class="text-right">
                                                <div class="actions">
                                                    <div class="dropdown action-item" data-toggle="dropdown">
                                                        <a href="#" class="action-item"><i
                                                                class="fas fa-ellipsis-h"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a href="{{ route('docs.view', [tenant('tenant_id'), $doc->DocID]) }}"
                                                               class="dropdown-item">{{ __('Open') }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body text-center">
                                        <a href="{{ route('docs.view', [tenant('tenant_id'), $doc->DocID]) }}"
                                           class="hover-translate-y-n3 text text-muted">
                                            <i class="{{ $icon }}"></i>
                                        </a>
                                        <h5 class="h6 mt-4"><a
                                                href="{{ route('docs.view', [tenant('tenant_id'), $doc->DocID]) }}">{{ Utility::GetDocProp($doc, 'Title') }}</a>
                                        </h5>
                                        <p class="mb-0">
                                            {{ !empty(Utility::GetDocProp($doc, 'Subtitle')) ? Utility::GetDocProp($doc, 'Subtitle') : '' }}
                                        </p>
                                        <p class="text text-xs">
                                            {{ !empty(Utility::GetDocProp($doc, 'Excerpt')) ? Utility::GetDocProp($doc, 'Excerpt') : '' }}
                                        </p>
                                        <span class="clearfix"></span>
                                        <span
                                            class="badge badge-pill {{ Utility::GetDocProp($doc, 'badge-class') }}">{{ Utility::GetDocProp($doc, 'Status') }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            $(document).ready(function () {
                $("#input_keyword").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    $("#grid_data .grid_record").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>
    @endpush
</x-layouts.app>
