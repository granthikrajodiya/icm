<x-layouts.app title="{{ __('Calendar') }}">

    @push('theme-script')
        <script src="{{ asset('assets/libs/dragula/dist/dragula.min.js') }}"></script>
        <script src="{{ asset('assets/libs/summernote/summernote-bs4.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('assets/libs/summernote/summernote-bs4.css') }}">
    @endpush

    <div class="page-title">
        <div class="card mb-0">
            <div class="card-body py-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col d-flex align-items-center col-lg-3">
                        <h5 class="fullcalendar-title h4 d-inline-block font-weight-400 mb-0"></h5>
                    </div>

                    <div class="col-lg-9 mt-3 mt-lg-0 text-lg-right">
                        {{-- <span id="timezone-offset" class="timezone-offset"></span> --}}
                        <select name="timezone" label="Timezone" id="timezone" class="form-control timezone-selector mr-2">
                            @foreach ($timezones as $timezone)
                                <option value="{{ $timezone }}">
                                    {{ $timezone }}
                                </option>
                            @endforeach
                        </select>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="#" class="fullcalendar-btn-prev btn btn-sm btn-neutral">
                                <i class="fas fa-angle-left"></i>
                            </a>
                            <a href="#" class="fullcalendar-btn-next btn btn-sm btn-neutral">
                                <i class="fas fa-angle-right"></i>
                            </a>
                        </div>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="#" class="btn btn-sm btn-neutral active" data-calendar-view="month">{{ __('Month') }}</a>
                            <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="agendaWeek">{{ __('Week') }}</a>
                            <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="agendaDay">{{ __('Day') }}</a>
                            <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="listWeek">{{ __('List') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-0">
        <div class="col">
            <div class="card overflow-hidden">
                <div class="calendar card-body" id="calendar" data-toggle="task-calendar"></div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="{{ asset('assets/js/scrollTo.js') }}"></script>
        <script>
            var userPerms =  @json($userPerms);

            //timezone
            var user_timezone = moment.tz.guess();

            $('#timezone').val(user_timezone).prop('selected', true);

            //all_day
            if ($('input[name=all_day]').is(':checked')) {
                $('.time_selector').addClass('d-none');
            } else {
                $('.time_selector').removeClass('d-none');
            }
            console.log({!! json_encode($arrData) !!});

            var e, t, a = $('[data-toggle="task-calendar"]');

            a.length && (t = {
                header: {right: "", center: "", left: ""},
                buttonIcons: {prev: "calendar--prev", next: "calendar--next"},
                theme: !1,
                selectable: !0,
                selectHelper: !0,
                editable: false,
                events: {!! json_encode($arrData) !!},
                eventStartEditable: !1,
                displayEventEnd: true,
                scrollTime: "{{ Utility::getSiteContent('day_start') }}",
                timeZone: user_timezone,
                dayClick: function (e, jsEvent, view) {
                    var title = '{{ __("Create New Event") }}';
                    var url = '{{ route("calendar.create",tenant('tenant_id')) }}';
                    if(userPerms.length > 0){
                        if (typeof url != 'undefined') {
                            $("#commonModal .modal-title").html(title);
                            $("#commonModal .modal-dialog").addClass('modal-lg');
                            $("#commonModal .modal-dialog").addClass('ow-break-word');
                            $("#commonModal .modal-title").addClass('ow-anywhere');
                            $("#commonModal").modal('show');
                            $.get(url, {}, function (data) {

                                $('#commonModal .modal-body').html(data);
                                createWysiwyg();
                                if (view.name != 'month') {
                                    $("#start_time").val(e.format('HH:mm')), $("#end_time").val(e.add(30, 'minutes').format('HH:mm'));
                                }
                                $("#start_date").val(e.format('YYYY-MM-DD')), $("#end_date").val(e.format('YYYY-MM-DD'));

                                //timezone
                                $('#timezone_create').val(user_timezone).prop('selected', true);

                                //set the current time of current timezone in 24 hour format
                                var currTimeMin = moment.tz(user_timezone).minute();
                                var roundedTime = moment().add(currTimeMin > 30 && 1 , 'hours').minutes(currTimeMin <= 30 ? 30 : 0);

                                $('#create_start_time').val(roundedTime.format('HH:mm'));

                                var addedEndTime = roundedTime.add(30, 'minutes').format('HH:mm');
                                $('#create_end_time').val(addedEndTime);

                                //resizable and draggable
                                $('#commonModal  .modal-content').resizable({
                                    alsoResize: ".modal-dialog",
                                    handles: 'e, w',
                                    minWidth: 520,
                                });

                                // $('#commonModal .modal-dialog').draggable();
                            });
                        }
                    }else{
                        show_toastr("Info", "Not enough permissions to create calendar events.", "info");
                    }

                },
                eventResize: function (event) {

                    var eventObj = {
                        start: event.start.format(),
                        end: event.end.format(),
                    };

                    $.ajax({
                        url: event.resize_url,
                        method: 'PUT',
                        data: eventObj,
                        success: function (response) {
                        },
                        error: function (data) {
                            data = data.responseJSON;
                        }
                    });
                },
                viewRender: function (t) {
                    e.fullCalendar("getDate").month(), $(".fullcalendar-title").html(t.title),
                    remakeCalendarTimezone(user_timezone)

                    var currentView = e.fullCalendar("getView").name
                    if(currentView === 'agendaDay'){
                        var headerText = $('.fc-day-header').data('date');
                        $('.fc-day-header').text( moment(headerText).format('dddd'));
                    }
                },
                windowResize: function(view, el) {
                    //column header format
                    var currentView = e.fullCalendar("getView").name

                    if ($(window).width() < 720){
                        if(currentView === 'month' || currentView === 'agendaWeek'){
                            e.fullCalendar('option', {
                                displayEventTime: false,
                                columnHeaderText: function(mom) {
                                    switch(mom.weekday()) {
                                        case 0:
                                        case 6:
                                            return 'S';
                                            break;
                                        case 2:
                                        case 4:
                                            return 'T';
                                            break;
                                        case 1:
                                            return 'M';
                                            break;
                                        case 3:
                                            return 'W';
                                            break;
                                        case 5:
                                            return 'F';
                                            break;
                                    }
                                }
                            });
                        }
                    }else{
                        if(currentView === 'agendaWeek'){
                            e.fullCalendar('option', {
                                displayEventTime: false,
                                columnHeaderText: function(mom) {
                                    return mom.format(' ddd M/D')
                                }
                            });
                        }else{
                            e.fullCalendar('option', {
                                displayEventTime: false,
                                columnHeaderText: function(mom) {
                                    return mom.format('ddd')
                                }
                            });
                        }

                    }
                },
                eventClick: function (e, t) {
                    var title = e.title;
                    var url = e.url;

                    if (typeof url != 'undefined') {
                        $("#commonModal .modal-title").html(title);
                        $("#commonModal .modal-dialog").addClass('modal-lg');
                        $("#commonModal .modal-dialog").addClass('ow-break-word');
                        $("#commonModal .modal-title").addClass('ow-anywhere');
                        $("#commonModal").modal('show');
                        $.get(url, {}, function (data) {
                            $('#commonModal .modal-body').html(data);
                            var offset = moment.tz(e.timezone).utcOffset();
                            offset = offset / (60);

                            var result = offset > 0 ? '+' + offset : offset;
                            $('#timezone-offset').text('(GMT'+ result + ')');
                        });

                        return false;
                    }
                },

                eventRender: function(event, el) {
                    //timezone  feature display at the calendar
                    // if (event.start.hasZone()) {
                    //     el.find('.fc-title').after(
                    //         $('<div class="tzo"/>').text("GMT" + moment(event.start).tz(event.timezone).format('Z'))
                    //     );
                    // }
                }
            }, (e = a).fullCalendar(t),
                $("body").on("click", "[data-calendar-view]", function (t) {
                    t.preventDefault(), $("[data-calendar-view]").removeClass("active"), $(this).addClass("active");
                    var a = $(this).attr("data-calendar-view");
                    e.fullCalendar("changeView", a)
                }),
                $("body").on("click", ".fullcalendar-btn-next", function (t) {
                    t.preventDefault(), e.fullCalendar("next")
                }),
                $("body").on("click", ".fullcalendar-btn-prev", function (t) {
                    t.preventDefault(), e.fullCalendar("prev")
                }),
                $("body").on("change", ".timezone-selector", function (t) {
                    t.preventDefault(),
                    remakeCalendarTimezone(this.value)
                })
            );

            function createWysiwyg() {
                $(".summernote-simple").summernote({
                    dialogsInBody: !0,
                    minHeight: 200,
                    toolbar: [
                        ['style', ['style', 'strikethrough']],
                        ["font", ["bold", "italic", "underline", "clear"]],
                        ['fontname', ['fontname']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ["para", ["ul", "ol", "paragraph"]],
                        ['insert', ['hr', 'link', 'picture']],
                        ['height', ['height']],
                        ['view', ['codeview']],
                    ],
                });
            }

            // Dynamic date format generator
            const getFormat = (d) => {
                if(d.includes("T")){
                    return "YYYY-MM-DDTHH:mm:ss";
                } else {
                    return "YYYY-MM-DD";
                }
            }

            // all_day checker
            $(document).on("change", 'input[name=all_day]', function(e) {
                if ($(this).is(':checked')) {
                    $('.time_selector').addClass('d-none');
                    $(this).val(1);
                } else {
                    $('.time_selector').removeClass('d-none');
                    $(this).val(0);
                }
            });

            function remakeCalendarTimezone(timezone){
                e.fullCalendar('option', 'timezone', timezone || false);

                // Remove all events
                e.fullCalendar('removeEvents');

                // Add events with new timezone offset
                const newEvents = {!! json_encode($arrData) !!};
                var newEventSource = [];
                newEvents.forEach(event => {
                    var start;
                    var end;

                    var new_start =  moment.tz(event.start, event.timezone).format();
                    var new_end =  moment.tz(event.end, event.timezone).format();

                    start = moment.tz(new_start, timezone).format();
                    end = event.end ? moment.tz(new_end, timezone).format() : start;

                    var newEvent = event;

                    newEvent.start = start;
                    newEvent.end = end;
                    newEventSource.push(newEvent);
                });

                e.fullCalendar('addEventSource', newEventSource );
            }


        </script>
    @endpush
    </x-layouts.app>
