<x-layouts.app title="{{ __('Chats') }}">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header actions-toolbar border-0">
                <div class="actions-search" id="actions-search">
                    <div class="input-group input-group-merge input-group-flush">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-transparent"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control form-control-flush" id="input_keyword" placeholder="{{ __('Type keyword..') }}">
                        <div class="input-group-append">
                            <a href="#" class="input-group-text bg-transparent" data-action="search-close" data-target="#actions-search"><i class="fas fa-times"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between align-items-center">
                    <div class="col">
                        <h6 class="d-inline-block mb-0">{{ __('Chats') }}</h6>
                    </div>
                    <div class="col text-right">
                        <div class="actions">
                            <a href="#" class="action-item mr-3" data-action="search-open" data-target="#actions-search"><i class="fas fa-search"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center">
                    <tbody class="list" id="tbl_record">
                    @foreach($chatUsers as $user)
                        <tr>
                            <th scope="row">
                                <div class="media align-items-center">
                                    <div>
                                        <a href=""><i class="fas fa-user fa-2x"></i></a>
                                    </div>
                                    <div class="media-body ml-4">
                                        <a href="" class="name mb-0 h6 text-sm">{{ $user->FullName }}</a><br>
                                        <span class="text-muted">{{ $user->Email }}</span>
                                    </div>
                                </div>
                            </th>
                            <td class="text-right">
                                <div class="dropdown">
                                    <a href="" class="action-item" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="" class="dropdown-item">{{ __('Open') }}</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        $(document).ready(function () {
            $("#input_keyword").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#tbl_record tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endpush
</x-layouts.app>
