@foreach ($tableBody as $k => $fields)
    @php
        $field_values = array_values($fields);
    @endphp
    <div class="col-xl-3 col-lg-4 col-sm-6 grid_record">
        <div class="card hover-shadow-lg">
            <div class="card-header border-0 pb-0 pt-2 px-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div></div>
                    <div class="text-right">
                        <div class="actions">
                            <div class="dropdown action-item">
                                <a href="#" class="action-item" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="#" data-url="{{ $fields['ViewUrl'] }}"
                                       class="dropdown-item task_detail">{{__('Open')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body text-center">
                <h5 class="h6 mt-4">
                    <a href="#" data-url="{{ $fields['ViewUrl'] }}" class="task_detail">{{ $field_values[0] }}</a>
                </h5>
                <p class="mb-0">{{ $field_values[1] }}</p>
                @if (!empty($field_values[2]))
                    <p class="text text-xs">{{ $field_values[2] }}</p>
                @endif
            </div>
        </div>
    </div>
@endforeach
