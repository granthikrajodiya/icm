<div class="col-12">
    @if (count($tableBody) > 0)
        <div class="table-responsive">
            <table class="table align-items-center">
                <thead class="list">
                <tr>
                    @foreach($tableHeader as $header)
                        <th>{{ Str::replace('ICM_','',$header) }}</th>
                    @endforeach
                    <th></th>
                </tr>
                </thead>
                <tbody class="list" id="task_tbl">
                    @foreach ($tableBody as $k => $fields)
                        <tr>
                            @if (count($fields) > 0)
                                @foreach (array_values($fields) as $field)
                                    @if ($loop->iteration == 1)
                                        <td>
                                            <a href="#" data-title="{{$field}}" data-url="{{$fields['ViewUrl']}}"
                                               class="font-weight-700 text text-muted task_detail">{{ $field }}</a>
                                        </td>
                                    @else
                                        <td>{{ $field }}</td>
                                    @endif
                                @endforeach
                            @endif
                            <td class="text-right">
                                <div class="dropdown">
                                    <a href="#" class="action-item" role="button" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" data-title="{{array_values($fields)[0]}}"
                                           data-url="{{$fields['ViewUrl']}}"
                                           class="dropdown-item task_detail">{{__('Open')}}</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <li class="media">
            <div class="media-body">
                <h6 class="text-center">{{__('No data found.')}}</h6>
            </div>
        </li>
    @endif
</div>
