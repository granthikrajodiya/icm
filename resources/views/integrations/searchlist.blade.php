<x-layouts.app title="{{ $restIntegration->name }}">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-0 pb-0">
                    <div class="row justify-content-between align-items-center">
                        <div class="col">
                            <h6 class="d-inline-block mb-0">
                                <i class="fas fa-list mr-2"></i>
                                <span id="menu_title">{{ $restIntegration->name }}</span>
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    @if ($is_success == true)
                        <div class="table-responsive">
                            <table class="table align-items-center dataTable">
                                <thead>
                                    <tr>
                                        @foreach ($titles as $title)
                                            <th class="pointer text-dark" id="{{ str_replace(' ', '_', $title) }}">
                                                {{ $title }}
                                            </th>
                                        @endforeach
                                        <th data-orderable="false"></th>
                                    </tr>
                                </thead>
                                <tbody id="tbl_record">
                                    @foreach ($details as $key => $list)
                                        <tr>
                                            @php

                                                $basic_details_array = [];
                                                $basic_details_keys = array_intersect(array_keys($list), $basic_details);
                                                foreach ($basic_details_keys as $k1 => $v1) {
                                                    $basic_details_array[$v1] = $list[$v1];
                                                }
                                                $no = 0;
                                            @endphp

                                            @foreach ($list as $k => $v)

                                                @if (in_array($k, $titles))

                                                    @if ($no == 0)

                                                        <td scope="row">
                                                            <div class="media align-items-center">
                                                                @if ($details_type == 1)
                                                                    <div>
                                                                        <a href="javascript:void(0)"
                                                                           class="open-basic-details"
                                                                           data-details="{{ json_encode($basic_details_array) }}"
                                                                           data-url="{{ route('integration.basic.detail', tenant('tenant_id')) }}"
                                                                           data-size="md"
                                                                           data-title="{{ __('Basic Details') }}"
                                                                        >
                                                                            <i class="fas fa-file fa-2x"></i>
                                                                        </a>
                                                                    </div>
                                                                @elseif($details_type == 2)
                                                                    <div>
                                                                        <a href="javascript:void(0)"
                                                                           data-id="get-integration-details{{ $key }}"
                                                                           class="open_doc">
                                                                            <i class="fas fa-file fa-2x"></i>
                                                                        </a>
                                                                    </div>
                                                                @endif

                                                                <div class="media-body ml-4">
                                                                    <a href="" class="name mb-0 h6 text-sm">
                                                                        <span class="span-date">
                                                                            {{ Utility::isDateSortFormat($v) }}
                                                                        </span>
                                                                        {{ Utility::isDate($v) }}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <span class="span-date">
                                                                {{ Utility::isDateSortFormat($v) }}
                                                            </span>
                                                            {{ Utility::isDate($v) }}
                                                        </td>
                                                    @endif
                                                    @php $no++; @endphp
                                                @endif
                                            @endforeach
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a href="#" class="action-item" role="button"
                                                       data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="false">
                                                        <i class="fas fa-ellipsis-h"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        @if ($details_type == 1)
                                                            <a href="javascript:void(0)"
                                                               class="dropdown-item open-basic-details"
                                                               data-details="{{ json_encode($basic_details_array) }}"
                                                               data-url="{{ route('integration.basic.detail', tenant('tenant_id')) }}"
                                                               data-size="md"
                                                               data-title="{{ __('Basic Details') }}">{{ __('Open') }}</a>
                                                        @elseif($details_type == 2)
                                                            <a href="javascript:void(0)" class="dropdown-item open_doc"
                                                               data-id="get-integration-details{{ $key }}">{{ __('Open') }}</a>
                                                            <x-form
                                                                :action="route('integration.detail', [tenant('tenant_id'), 'restIntegration' => $list_id])"
                                                                id="get-integration-details{{ $key }}">
                                                                <input type="hidden" name="url"
                                                                       value="{{ Crypt::encrypt($list['url']) }}">
                                                            </x-form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <li class="media py-5">
                            <div class="media-body">
                                <h6 class="text-center">
                                    {{ __('An error occurred retrieving') . ' ' . $restIntegration->name . '. ' . __('Please contact your system administrator for assistance.') }}
                                </h6>
                            </div>
                        </li>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script type="text/javascript">
            @if ($details_type == 2)
            $('.open_doc').on('click', function () {
                var form_id = $(this).data('id');
                $(`#${form_id}`).trigger("submit");
            });
            @endif
        </script>
    @endpush
</x-layouts.app>
