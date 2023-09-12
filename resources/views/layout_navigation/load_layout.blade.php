<div class="row align-items-center">
    <div class="col">
        <ul class="nav nav-tabs nav-bordered mb-3">
            <li class="nav-item">
                <a href="#home_navigation" data-toggle="tab" aria-expanded="true" class="nav-link active">
                    <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                    <span class="d-lg-block">{{ __('Home Page Layout')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#layout_navigation" data-toggle="tab" aria-expanded="false" class="nav-link">
                    <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                    <span class="d-lg-block">{{ __('Navigation')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#security" data-toggle="tab" aria-expanded="false" class="nav-link">
                    <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                    <span class="d-lg-block">{{ __('Security')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#properties" data-toggle="tab" aria-expanded="false" class="nav-link">
                    <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                    <span class="d-lg-block">{{ __('Properties')}}</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="tab-content">
            <div class="tab-pane active show" id="home_navigation">
                <div class="row">
                    <div class="col-12 text-right pb-2">
                        <div class="actions">
                            <a class="action-item add_page_layout pointer" id="add_layout"
                               data-url="{{route('layout.create',tenant('tenant_id'),)}}" data-ajax-popup2="true"
                               data-size="md" data-title="{{__('Create New Home Page Card')}}">
                                <i class="fas fa-plus"></i>
                                <span class="d-sm-inline-block">{{__('Add')}}</span>
                            </a>
                        </div>
                    </div>
                </div>

                @if ($layouts['top']->count() > 0 || $layouts['middle']->count() > 0 || $layouts['bottom']->count() > 0)
                    @if ($layouts['top']->count() > 0)
                        <div class="row sortable_layout">
                            @foreach ($layouts['top'] as $top_layout)
                                <div class="{{$top_layout->returnClass()}} p-1 layout_div"
                                     data-id="{{$top_layout->id}}">
                                    <div class="card">
                                        <div class="card-body pt-0 px-3">
                                            <div class="row">
                                                <div class="col-6 text-left py-2">
                                                    <i class="fas fa-expand-arrows-alt cursor-grabbing"></i>
                                                </div>
                                                <div class="col-6 text-right px-0">
                                                    <div class="dropdown action-item">
                                                        <a class="action-item pointer" role="button"
                                                           data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item pointer edit_page_layout"
                                                               data-source="{{$top_layout->data_source}}"
                                                               data-url="{{ route('layout.edit', ['tenant' => tenant('tenant_id') , 'layout' => $top_layout->id]) }}"
                                                               data-ajax-popup2="true" data-size="md"
                                                               data-title="{{__('Edit Card')}}">{{__('Edit')}}</a>
                                                            <a class="dropdown-item pointer"
                                                               data-confirm="{{__('Are You Sure?')}}|{{__('This action can not be undone. Do you want to continue?')}}"
                                                               data-confirm-yes="deleteChildLayoutNavigation('{{route('layout.destroy',[tenant('tenant_id'),$top_layout->id])}}');">{{__('Delete')}}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 overflow-hidden text-truncate">
                                                    <small class="cursor-grabbing"><b>{{$top_layout->title}}</b></small><br>
                                                    <small>{{__('Max Item : ').$top_layout->max_item}}</small> <br>
                                                    <small>{{__('Source : ').$top_layout->data_source}}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>{{__('No Top Layout Found.')}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($layouts['middle']->count() > 0)
                        <div class="row">
                            <div class="col-12">
                                <hr>
                            </div>
                        </div>
                    @endif
                    @if ($layouts['middle']->count() > 0)
                        <div class="row sortable_layout">
                            @foreach ($layouts['middle'] as $middle_layout)
                                <div class="{{$middle_layout->returnClass()}} col-3 p-1 layout_div" data-id="{{$middle_layout->id}}" >
                                    <div class="card">
                                        <div class="card-body pt-0 px-3">
                                            <div class="row">
                                                <div class="col-6 text-left py-2">
                                                    <i class="fas fa-expand-arrows-alt cursor-grabbing"></i>
                                                </div>
                                                <div class="col-6 text-right px-0">
                                                    <div class="dropdown action-item">
                                                        <a class="action-item pointer" role="button"
                                                           data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item pointer edit_page_layout"
                                                               data-source="{{$middle_layout->data_source}}"
                                                               data-url="{{ route('layout.edit',[tenant('tenant_id'),$middle_layout->id]) }}"
                                                               data-ajax-popup2="true" data-size="md"
                                                               data-title="{{__('Edit Card')}}">{{__('Edit')}}</a>
                                                            <a class="dropdown-item pointer"
                                                               data-confirm="{{__('Are You Sure?')}}|{{__('This action can not be undone. Do you want to continue?')}}"
                                                               data-confirm-yes="deleteChildLayoutNavigation('{{route('layout.destroy',[tenant('tenant_id'),$middle_layout->id])}}');">{{__('Delete')}}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 overflow-hidden text-truncate">
                                                    <small
                                                            class="cursor-grabbing"><b>{{$middle_layout->title}}</b></small><br>
                                                    <small>{{__('Max Item : ').$middle_layout->max_item}}</small> <br>
                                                    <small>{{__('Source : ').$middle_layout->data_source}}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>{{__('No Middle Layout Found.')}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($layouts['bottom']->count() > 0)
                        <div class="row">
                            <div class="col-12">
                                <hr>
                            </div>
                        </div>
                    @endif
                    @if ($layouts['bottom']->count() > 0)
                        <div class="row sortable_layout">
                            @foreach ($layouts['bottom'] as $bottom_layout)
                                <div class="{{$bottom_layout->returnClass()}} p-1 layout_div" data-id="{{$bottom_layout->id}}">
                                    <div class="card">
                                        <div class="card-body pt-0 px-3">
                                            <div class="row">
                                                <div class="col-6 text-left py-2">
                                                    <i class="fas fa-expand-arrows-alt cursor-grabbing"></i>
                                                </div>
                                                <div class="col-6 text-right px-0">
                                                    <div class="dropdown action-item">
                                                        <a class="action-item pointer" role="button"
                                                           data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item pointer edit_page_layout"
                                                               data-source="{{$bottom_layout->data_source}}"
                                                               data-url="{{ route('layout.edit',[tenant('tenant_id'),$bottom_layout->id]) }}"
                                                               data-ajax-popup2="true" data-size="md"
                                                               data-title="{{__('Edit Card')}}">{{__('Edit')}}</a>
                                                            <a class="dropdown-item pointer"
                                                               data-confirm="{{__('Are You Sure?')}}|{{__('This action can not be undone. Do you want to continue?')}}"
                                                               data-confirm-yes="deleteChildLayoutNavigation('{{route('layout.destroy',[tenant('tenant_id'),$bottom_layout->id])}}');">{{__('Delete')}}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 overflow-hidden text-truncate">
                                                    <small
                                                            class="cursor-grabbing"><b>{{$bottom_layout->title}}</b></small><br>
                                                    <small>{{__('Max Item : ').$bottom_layout->max_item}}</small> <br>
                                                    <small>{{__('Source : ').$bottom_layout->data_source}}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>{{__('No Bottom Layout Found.')}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h6>{{__('No data found.')}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="tab-pane" id="layout_navigation">
                <div class="row">
                    <div class="col-12 text-right pb-2">
                        <div class="actions">
                            <a class="action-item add_page_navigation pointer"
                               data-url="{{route('navigation.create',tenant('tenant_id'))}}" data-ajax-popup2="true"
                               data-size="md" data-title="{{__('Create New Navigation Element')}}">
                                <i class="fas fa-plus"></i>
                                <span class="d-sm-inline-block">{{__('Add')}}</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-light">
                                <tr>
                                    <th>{{__('Title')}}</th>
                                    <th>{{__('Nav Panel')}}</th>
                                    <th>{{__('Top Menus')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody class="sortable_navigation">
                                @if ($navigations->count() > 0)
                                    @foreach ($navigations as $navigation)
                                        <tr data-id="{{$navigation->id}}" class="navigation_div">
                                            <td class="w-25 cursor-grabbing">{{ $navigation->title }}</td>
                                            <td class="w-25"><i
                                                        class="fas fa-{{($navigation->show_nav_menu == 1) ? 'check' : ''}} text-success"></i>
                                            </td>
                                            <td class="w-25"><i
                                                        class="fas fa-{{($navigation->show_top_menu == 1) ? 'check' : ''}} text-success"></i>
                                            </td>
                                            <td class="w-25">
                                                <div class="actions">
                                                    <i class="fas fa-expand-arrows-alt cursor-grabbing px-2"></i>
                                                    <a class="action-item pointer px-2 edit_navigation"
                                                       data-source="{{$navigation->data_source}}"
                                                       data-url="{{ route('navigation.edit',[tenant('tenant_id'),$navigation]) }}"
                                                       data-ajax-popup2="true" data-size="md"
                                                       data-title="{{__('Edit Navigation')}}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a class="action-item pointer text-danger px-2"
                                                       data-confirm="{{__('Are You Sure?')}}|{{__('This action can not be undone. Do you want to continue?')}}"
                                                       data-confirm-yes="deleteChildLayoutNavigation('{{route('navigation.destroy',[tenant('tenant_id'),$navigation->id])}}',true);">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th scope="col" colspan="4"><h6
                                                    class="text-center">{{__('No Navigation elements defined.')}}</h6>
                                        </th>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="security">
                <div class="row">
                    <div class="col-12 pl-5">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="all_user_groups" value="all_user_groups"
                                   {{ !isset($selectedSecurityGroups)  ? 'checked' : '' }} name="user_groups_type"
                                   class="custom-control-input">
                            <label class="custom-control-label"
                                   for="all_user_groups">{{__('All user groups can access this layout.')}}</label>
                        </div>
                    </div>
                    <div class="col-12 pl-5">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="selected_user_groups" value="selected_user_groups"
                                   {{ isset($selectedSecurityGroups)  ? 'checked' : '' }} name="user_groups_type"
                                   class="custom-control-input">
                            <label class="custom-control-label"
                                   for="selected_user_groups">{{__('Only users within the selected groups can access this layout')}}</label>
                        </div>
                        <div id='layout-security-loader' class="min-h-250 d-none">
                            <img src="{{asset('assets/img/loading.gif')}}" height="50px" width="50px" class="loading"
                                 alt="">
                        </div>
                        <div class="pl-5 py-2" id="security_group_div">

                        </div>
                        <div class="text-right pt-3">
                            <x-button sm pill>{{ __('Update') }}</x-button>
                            <x-button type="button" sm secondary pill data-dismiss="modal">{{ __('Close') }}</x-button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="properties">
                <div class="row">
                    <x-input.text required name="title" container-class="col-8" :value="$layout->title ?? ''" id="layout_navigation_title" :maxlength="100"/>
                    <x-select name="user_group" container-class="col-4" required >
                        @foreach ($userGroup as $value => $label)
                            <option value="{{ $value }}" @if ($value == $layoutDefinition->user_group) selected @endif>
                                {{ $label }}
                            </option>
                        @endforeach
                    </x-select>
                </div>

                <div class="col-12 pb-5">
                    <x-input.radio id="customRadio13"
                        name="navigation_layout"
                        value="{!! \App\Models\LayoutDefinition::NAVIGATION_LAYOUT_GRID !!}"
                        label="Navigation Grid"
                        :checked="$layoutDefinition->navigation_layout == \App\Models\LayoutDefinition::NAVIGATION_LAYOUT_GRID  ?? ''"
                    />
                    <x-input.radio
                        id="customRadio14"
                        name="navigation_layout"
                        value="{!! \App\Models\LayoutDefinition::NAVIGATION_LAYOUT_LIST !!}"
                        label="Navigation List"
                        :checked="$layoutDefinition->navigation_layout == \App\Models\LayoutDefinition::NAVIGATION_LAYOUT_LIST  ?? ''"
                    />
                </div>

                <div class="col-12 pb-3">
                    <x-input.radio id="customRadio3"
                        name="fixed_layout"
                        value="0"
                        label="Dynamic Home Page Layout"
                        :checked="$layoutDefinition->fixed_layout == 0 ?? ''"
                    />
                    <x-input.radio
                        id="customRadio4"
                        name="fixed_layout"
                        value="1"
                        label="Fixed Home Page Layout"
                        :checked="$layoutDefinition->fixed_layout == 1 ?? ''"
                    />
                </div>

                <div class="row">
                    <x-input.text type="number"
                        name="top_card_height"
                        id="top_card_height"
                        default="{{env('FIXED_MIN_TOP_CARD_HEIGHT')}}"
                        value="{{ $layoutDefinition->top_card_height ?? env('FIXED_MIN_TOP_CARD_HEIGHT') }}"
                        label="{{ 'Top Card Height (px)' }}"
                        container-class="col-4"
                        :disabled="$layoutDefinition->fixed_layout == 0 ?? ''"
                        min="{{env('FIXED_MIN_TOP_CARD_HEIGHT')}}"
                    />

                    <x-input.text type="number"
                        name="middle_card_height"
                        id="middle_card_height"
                        default="{{ env('FIXED_MIN_MIDDLE_CARD_HEIGHT') }}"
                        value="{{ $layoutDefinition->middle_card_height  ?? env('FIXED_MIN_MIDDLE_CARD_HEIGHT')  }}"
                        label="{{ 'Middle Card Height (px)'}}"
                        container-class="col-4"
                        :disabled="$layoutDefinition->fixed_layout == 0 ?? ''"
                        min="{{ env('FIXED_MIN_MIDDLE_CARD_HEIGHT') }}"
                    />

                    <x-input.text type="number"
                        name="bottom_card_height"
                        id="bottom_card_height"
                        default="{{ env('FIXED_MIN_BOTTOM_CARD_HEIGHT') }}"
                        min="{{ env('FIXED_MIN_BOTTOM_CARD_HEIGHT') }}"
                        value="{{ $layoutDefinition->bottom_card_height ??  env('FIXED_MIN_BOTTOM_CARD_HEIGHT') }}"
                        label="{{ 'Bottom Card Height (px)' }}"
                        container-class="col-4"
                        :disabled="$layoutDefinition->fixed_layout == 0 ?? ''"
                    />
                </div>

                <div class="text-right pt-3">
                    <x-button type="submit" class="layout_selector" sm pill>{{ __('Update') }}</x-button>
                    <x-button type="button" sm secondary pill data-dismiss="modal">{{ __('Close') }}</x-button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on('change', 'input[name="user_groups_type"]', function () {
        const userGroup = $('#user_group').val();
        if ($(this).val() == "selected_user_groups") {
            return SecurityGroups(userGroup, "{{ $id }}");
        }

        $('#security_group_div').empty().hide();
    });
    $(document).ready(function () {
        const userGroup = $('input[name="user_groups_type"]:checked').val();
        if (userGroup == "selected_user_groups") {
            SecurityGroups(1, "{{ $id }}");
        }
    })
</script>
