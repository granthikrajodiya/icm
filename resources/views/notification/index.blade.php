<x-layouts.app title="{{ __('Notifications') }}" header="{{ __('Notifications') }}">
    <div class="row min-750">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center">
                        <div class="col">
                            <h6 class="mb-0"><span id="menu_title">{{ __('Notifications') }}</span></h6>
                        </div>
                        <div class="col text-right">
                            <div class="actions">
                                <div class="dropdown">
                                    <a href="#" class="action-item" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{ route('notification.mark.read', tenant('tenant_id')) }}"
                                            class="dropdown-item"><i class="fas fa-check"></i>
                                            {{ __('Mark all notifications as read') }}</a>
                                        <a href="{{ route('notification.index', [tenant('tenant_id'), 'date_desc']) }}"
                                            class="dropdown-item {{ request()->segment(2) == 'date_desc' || empty(request()->segment(2)) ? 'active' : '' }}"><i
                                                class="fas fa-sort-amount-down"></i> {{ __('Newest') }}</a>
                                        <a href="{{ route('notification.index', [tenant('tenant_id'), 'date_asc']) }}"
                                            class="dropdown-item {{ request()->segment(2) == 'date_asc' ? 'active' : '' }}"><i
                                                class="fas fa-sort-amount-up"></i> {{ __('Oldest') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" style="table-layout: fixed">
                            <tbody>
                                @if ($notifications->count() > 0)
                                    @foreach ($notifications as $notification)
                                        <tr>
                                            <td class="p-0" style="white-space: unset !important;">
                                                <div class="list-group list-group-flush">
                                                    <div  class="list-group-item list-group-item-action ">

                                                        {{-- @if ($notification->created_at > user()->notifications_read && $notification->created_at <= user()->last_login_at)
                                                        <small class="float-right badge badge-sm badge-info">{{__('Unread')}}</small> --}}
                                                        @if($notification->created_at > user()->last_login_at && $notification->created_at > user()->notifications_read)
                                                            <small
                                                                class="float-right badge badge-sm badge-success">{{ __('New') }}</small>
                                                        @endif
                                                        <div class="d-flex">
                                                            <div><i
                                                                    class="fas {{ !empty($notification->type) ? $notification->type : 'fa-cogs' }} mr-3 font-size-20 mt-2"></i>
                                                            </div>
                                                            <div style="max-width: 100%;">
                                                                <div class="text-sm font-weight-bold d-inline">
                                                                    {{ $notification->text }}
                                                                </div>
                                                                <small
                                                                    class="d-block text-muted font-weight-bold">{{ Utility::getDateFormatted($notification->created_at, true) }}</small>
                                                                @if (!empty($notification->link_title) && !empty($notification->link_color) && !empty($notification->link_url) && !empty($notification->link_type))

                                                                    @if ($notification->link_type == 'calendar')
                                                                        <a class="calendar_notif"
                                                                        href="{!! \App\Models\UserNotification::getLink($notification) !!}"
                                                                        data-title="{!! \App\Models\Calendar::getCalendarName($notification->link_url)  !!}">
                                                                            <small
                                                                                class="float-left badge badge-sm {{ $notification->link_color }} text-white"
                                                                                data-type='{{$notification->link_type}}'
                                                                            >
                                                                                {{ $notification->link_title }}
                                                                            </small>
                                                                        </a>
                                                                    @else
                                                                        <a href="{!! \App\Models\UserNotification::getLink($notification) !!}"
                                                                        data-title="{!! $notification->link_title !!}"
                                                                        class="from_notification">
                                                                            <small class="float-left badge badge-sm {{ $notification->link_color }} text-white" >{{ $notification->link_title }}</small>
                                                                        </a>
                                                                    @endif

                                                                    <div class="clearfix"></div>

                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="py-3">
                                            <div class="list-group list-group-flush text-center">
                                                <h6>{{ __('No New Notifications') }}</h6>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')

    <script>
        $(document).on('click', '.calendar_notif', function (e) {
            var url = $(this).attr('href');
            e.preventDefault();
            var title = $(this).attr('data-title');

            if (typeof url != 'undefined') {
                $("#commonModal .modal-title").html(title);
                $("#commonModal .modal-dialog").addClass('modal-md');
                $("#commonModal").modal('show');
                $.get(url, {}, function (data) {
                    $('#commonModal .modal-body').html(data);
                });
                return false;
            }else{
                console.log("url is incorrect")
            }
        });

    </script>
@endpush
</x-layouts.app>
