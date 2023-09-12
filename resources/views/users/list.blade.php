@if ($users->count() > 0)
    @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            @if (user()->account_type == 4)
                <td>@if (tenant('primary_contact') == $user->id)<i class="fas fa-check text-success"></i>@endif</td>
            @endif
            <td>{{ $user->account_type_name ?? '-' }}</td>
            <td>{{ ucfirst($user->account_status) }}</td>
            <td>
                <div class="actions">
                    <a href="#" class="action-item px-2"
                       data-url="{{ route('user.edit',[tenant('tenant_id'), $user]) }}" data-ajax-popup="true"
                       data-size="xl" data-title="{{__('Edit User')}}">
                        <i class="fas fa-edit"></i>
                    </a>
                </div>
            </td>
        </tr>
    @endforeach
@else
    <tr class="text-center">
        <td colspan="5"><h6>{{__('No data found.')}}</h6></td>
    </tr>
@endif
