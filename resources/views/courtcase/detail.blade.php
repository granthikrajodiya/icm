<x-layouts.app
    title="{{ $case.' - '.$response->Data->BatchProfileName.' - '.$response->Data->BatchName }}"
>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-10">
                            <div class="media">
                                <i class="fa fa-users fa-2x text-primary mt-1"></i>
                                <div class="media-body ml-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            {{ __('Case Number') }} :
                                            <b>{{ $arrHeader['Case Number'] }}</b>
                                        </div>
                                        <div class="col-md-6">
                                            {{ __('Case Name') }} :
                                            <b>{{ $arrHeader['Case Name'] }}</b>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            {{ __('Status') }} :
                                            <b>{{ $arrHeader['Status'] }}</b>
                                        </div>
                                        <div class="col-md-6">
                                            {{ __('Date Filed') }} :
                                            <b>{{ !empty($arrHeader['Date Filed']) ? Utility::getDateFormatted($arrHeader['Date Filed']) : '-' }}</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col text-right">
                            <x-dropdown>
                                <x-dropdown.menu>Refresh</x-dropdown.menu>
                                <x-dropdown.menu>Print...</x-dropdown.menu>
                                <x-dropdown.menu
                                    :data-url="route('courtcase.history', [tenant('tenant_id'), $arrHeader['Case Number'], $batchId])"
                                    data-ajax-popup="true" :data-title="__('History and Notes')">
                                    History and Notes
                                </x-dropdown.menu>
                                <x-dropdown.menu>New...</x-dropdown.menu>
                                <x-dropdown.menu>Save</x-dropdown.menu>
                                <x-dropdown.menu>Close</x-dropdown.menu>
                            </x-dropdown>

                            <a href="javascript:void(0)" class="back-page">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-2">
                    <x-tabs id="court-cases-detail-tabs" overflow menu-class="mr-auto">
                        <x-slot name="menu">
                            <x-tabs.menu id="case-info" active>{{ __('Case Info') }}</x-tabs.menu>
                            <x-tabs.menu id="parties-members" class="tab-view">{{ __('Parties & Members') }}</x-tabs.menu>
                            <x-tabs.menu id="scheduling" class="tab-view">{{ __('Scheduling') }}</x-tabs.menu>
                            <x-tabs.menu id="deadlines" class="tab-view">{{ __('Deadlines') }}</x-tabs.menu>
                            <x-tabs.menu id="keyword" class="tab-view">{{ __('Keyword') }}</x-tabs.menu>
                            <x-tabs.menu id="motions" class="tab-view">{{ __('Motions') }}</x-tabs.menu>
                            <x-tabs.menu id="orders">{{ __('Orders') }}</x-tabs.menu>
                            <x-tabs.menu id="documents">{{ __('Documents') }}</x-tabs.menu>
                            <x-tabs.menu id="closing">{{ __('Closing') }}</x-tabs.menu>
                            <x-tabs.menu id="log">{{ __('Logs') }}</x-tabs.menu>
                            <x-tabs.menu id="notes">{{ __('Notes') }}</x-tabs.menu>
                        </x-slot>

                        <x-tabs.tab id="case-info" active>
                            <div class="row">
                                <x-select name="board" container-class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <option value="{{ $arrHeader['Board'] }}">
                                        {{ $arrHeader['Board'] }}
                                    </option>
                                </x-select>

                                <x-input.text name="case_number" :value="$arrHeader['Case Number']"
                                              container-class="col-xs-12 col-sm-12 col-md-3 col-lg-3"/>


                                <x-select name="status" container-class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <option value="{{ $arrHeader['Status'] }}">
                                        {{ $arrHeader['Status'] }}
                                    </option>
                                </x-select>

                                <x-input.text type="date" name="date_filed"
                                              :value="carbon($arrHeader['Date Filed'])->format('Y-m-d')"
                                              container-class="col-xs-12 col-sm-12 col-md-3 col-lg-3"/>
                            </div>
                            <div class="row">
                                <x-input.text name="case_name" :value="$arrHeader['Case Number']"
                                              container-class="col-xs-12 col-sm-12 col-md-12 col-lg-12"/>
                            </div>
                            <div class="row">
                                <x-input.text name="reason_appealed" :value="$arrHeader['Reason Appealed']"
                                              container-class="col-xs-12 col-sm-12 col-md-12 col-lg-12"/>
                            </div>
                            <div class="row">
                                <x-select name="county" label="County"
                                          container-class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <option value="{{ $arrHeader['County'] }}">
                                        {{ $arrHeader['County'] }}
                                    </option>
                                </x-select>

                                <x-select name="city" label="City"
                                          container-class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <option value="{{ $arrHeader['City'] }}">
                                        {{ $arrHeader['City'] }}
                                    </option>
                                </x-select>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card hover-shadow-lg">
                                        <div class="card-header">
                                            <h5 class="h6 mb-0">Case Summary</h5>
                                        </div>
                                        <div class="card-body">
                                            <div>
                                                {{ __('Mediation Status') }} :
                                                <b>{{ $arrHeader['Mediation Status'] }}</b>
                                            </div>
                                            <div>
                                                {{ __('Date Closed') }} :
                                                <b>{{ $arrHeader['Date Closed'] }}</b>
                                            </div>
                                            <div>
                                                {{ __('Reconsideration Granted') }} :
                                                <b>{{ $arrHeader['Reconsideration Granted'] }}</b>
                                            </div>
                                            <div>
                                                {{ __('Appealed to Superior Court') }} :
                                                <b>{{ $arrHeader['Appealed to Superior Court'] }}</b>
                                            </div>
                                            <div>
                                                {{ __('Presiding Officer') }} :
                                                <b>{{ $arrHeader['Presiding Officer'] }}</b>
                                            </div>
                                        </div>
                                        <div class="card-footer py-2 text-right">
                                            <a href="#" class="text-sm text-primary font-weight-bold">
                                                {{ __('Case History…') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card hover-shadow-lg">
                                        <div class="card-header">
                                            <h5 class="h6 mb-0">Other Info</h5>
                                        </div>
                                        <div class="card-body">
                                            <x-select name="dispositive_motion_deadline">
                                                <option value="{{ $arrHeader['Dispositive Motion Deadline'] }}">
                                                    {{ $arrHeader['Dispositive Motion Deadline'] }}
                                                </option>
                                            </x-select>
                                            <x-select name="closing_briefs_filed">
                                                <option value="{{ $arrHeader['Closing Briefs Filed'] }}">
                                                    {{ $arrHeader['Closing Briefs Filed'] }}
                                                </option>
                                            </x-select>
                                            <x-input.text name="archive_reference"
                                                          :value="$arrHeader['Archive Reference']"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card hover-shadow-lg">
                                        <div class="card-header">
                                            <h5 class="h6 mb-0">Case Consolidation</h5>
                                        </div>
                                        <div class="card-body">
                                            <x-input.textarea name="master" rows="7">
                                                {{ $arrHeader['Master'] }}
                                            </x-input.textarea>
                                        </div>
                                        <div class="card-footer py-2 text-right">
                                            <a href="#" class="text-sm text-primary font-weight-bold">
                                                {{ __('Manage…') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 pt-4">
                                    <x-button sm pill right>{{ __('Save') }}</x-button>
                                    <x-button type="button" sm secondary pill right
                                              data-dismiss="modal">{{ __('Cancel') }}</x-button>
                                </div>
                            </div>
                        </x-tabs.tab>
                        <x-tabs.tab id="parties-members"></x-tabs.tab>
                        <x-tabs.tab id="scheduling"></x-tabs.tab>
                        <x-tabs.tab id="deadlines"></x-tabs.tab>
                        <x-tabs.tab id="keyword"></x-tabs.tab>
                        <x-tabs.tab id="motions"></x-tabs.tab>
                        <x-tabs.tab id="orders"></x-tabs.tab>
                        <x-tabs.tab id="documents"></x-tabs.tab>
                        <x-tabs.tab id="closing"></x-tabs.tab>
                        <x-tabs.tab id="log"></x-tabs.tab>
                        <x-tabs.tab id="notes"></x-tabs.tab>
                    </x-tabs>
                </div>
            </div>
        </div>
    </div>
    @push('theme-script')
        <script src="{{ asset('assets/js/chart.js') }}"></script>
    @endpush
    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/css/docuvieware-min.css') }}">
        <script src="{{ asset('assets/js/docuvieware-min.js') }}"></script>
    @endpush
    @push('script')

        <script>
            $(document).ready(function () {
                var tab = 'request-number';
                @if ($tab = Session::get('court-case-tab-status'))
                var tab = '{{ $tab }}';
                @endif
                setTimeout(function () {
                    $("#court-cases-detail-tabs .nav-item #" + tab + "-tab").trigger("click");
                }, 10);
            })
            var currentRequest = null;
            $(document).on('click', '#add_user_note', function () {
                var user_note = $("input[name='user_note']").val();
                $.ajax({
                    type: "POST",
                    url: '{{ route('courtcase.note.store',[tenant('tenant_id'),$batchId]) }}',
                    data: {
                        notes: user_note,
                        batchId: $(this).attr('data-from')
                    },
                    cache: false,
                    success: function(data, status, xhr) {
                        if (!xhr.responseJSON) {
                            location.reload();
                            return false;
                        }
                        if (!data.is_success) {
                            show_toastr('Error', data.message, 'error');
                        } else {
                            var note = data.data;
                            $("input[name='user_note']").val('');
                            $('.historyTable').dataTable().fnDestroy();
                            if(note.status == "create"){
                                $("#user_notes_records").append(`<tr id="${note.id}"><td>${note.date}</td><td>${note.user.name}</td><td>${note.notes}</td></tr>`);
                            }else{
                                $("#user_notes_records").find(`#${note.id}`).html(`<td>${note.date}</td><td>${note.user.name}</td><td>${note.notes}</td>`);
                            }
                            $(".historyTable").DataTable();
                            show_toastr('Success', data.message, 'success');
                        }
                    }
                });
            });
        </script>
    @endpush
</x-layouts.app>
