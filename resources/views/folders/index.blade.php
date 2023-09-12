<x-layouts.app title="{{ Utility::getValByName('folder_menu') }}">
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
                            <h6 class="d-inline-block mb-0"><i class="fas fa-folder-open"></i> <span
                                    id="menu_title">{{ Utility::getValByName('folder_menu') }}</span></h6>
                        </div>
                        <div class="col text-right">
                            <div class="actions">
                                <a href="#" class="action-item mr-3" data-action="search-open"
                                    data-target="#actions-search"><i class="fas fa-search"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center">
                        <tbody class="list" id="tbl_record">
                            @if (count($folders) > 0)
                                @foreach ($folders as $folder)
                                    <tr>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <div>
                                                    <a
                                                        href="{{ route('folder.filter', [tenant('tenant_id'), $folder->encodeFolderName]) }}"><i
                                                            class="fas fa-folder-open fa-2x"></i></a>
                                                </div>
                                                <div class="media-body ml-4">
                                                    <a href="{{ route('folder.filter', [tenant('tenant_id'), $folder->encodeFolderName]) }}"
                                                        class="name mb-0 h6 text-sm">{{ $folder->ViewName }}</a><br>
                                                    <span class="text-muted">{{ $folder->ViewDescription }}</span>
                                                </div>
                                            </div>
                                        </th>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="{{ route('folder.filter', [tenant('tenant_id'), $folder->encodeFolderName]) }}"
                                                    class="action-item" role="button" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-h"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="{{ route('folder.filter', [tenant('tenant_id'), $folder->encodeFolderName]) }}"
                                                        class="dropdown-item">{{ __('Open') }}</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="text-center">
                                    <th>
                                        <h6>{{ __('No data found.') }}</h6>
                                    </th>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}">
    @endpush
    @push('script')

        <script>
            $(document).ready(function() {
                $("#input_keyword").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#tbl_record tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>
    @endpush
</x-layouts.app>
