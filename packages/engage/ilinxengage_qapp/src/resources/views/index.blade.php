@push('css')
    {{-- <link rel="stylesheet" href="{{ asset('packages/engage/ilinxengage_qapp/assets/css/qapp_custom.css') }}"> --}}
    <style>
        .form-builder-dialog{
            z-index: 9999999 !important;
        }

        .form-wrap.form-builder .frmb{
            min-height: 602px !important;
        }
    </style>

@endpush
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header actions-toolbar border-0">
                    <div class="row justify-content-between align-items-center">
                        <div class="col">
                            <h6 class="mb-0">{{ __('Quick Apps') }}</h6>
                        </div>
                        <div class="col text-right">
                            <div class="actions">
                                <a href="#" data-url="{{ route('qapp.create', tenant('tenant_id')) }}" data-size="md" data-ajax-popup="true"
                                    data-title="{{ __('New Quick App') }}" class="action-item"><i class="fas fa-plus"></i><span class="d-sm-inline-block">{{ __('Add') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-0 px-1 pb-3">
                    <div class="table-responsive" id="">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Online') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $qapps = \Engage\Ilinxengage_qapp\Models\QappDefinition::where('tenant_id', \Auth::user()->tenant_id)->get();
                                @endphp
                                @foreach ($qapps as $qapp)
                                    <tr>
                                        <td>{{ $qapp->name }}</td>
                                        <td>
                                            @if($qapp->online == 1)
                                                <i class="fas fa-check text-success"></i>
                                            @endif
                                        </td>
                                        <td>{{ $qapp->description }}</td>
                                        <td>
                                            <div class="actions">
                                                <a href="#" class="action-item px-2" data-url="{{ route('qapp.edit', [tenant('tenant_id'), $qapp->id]) }}"
                                                    data-ajax-popup="true" data-size="xl"
                                                    data-title="{{ __('Edit Quick App') }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#" class="action-item text-danger px-2"
                                                    data-confirm="{{ __('Are You Sure?') }}|{{ __('This action can not be undone. Do you want to continue?') }}"
                                                    data-confirm-yes="document.getElementById('delete-faq-{{ $qapp->id }}').submit();">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </div>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['qapp.destroy', [tenant('tenant_id'), $qapp->id]],
                                                'id' => 'delete-faq-' . $qapp->id,
                                            ]) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@push('script')
    <script src="https://formbuilder.online/assets/js/form-render.min.js"></script>
    <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
    {{-- <script src="{{ asset('assets/js/form-render.min.js') }}"></script>
    <script src="{{ asset('assets/js/form-builder.min.js') }}"></script> --}}
@endpush
