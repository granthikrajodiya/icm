"use strict";

window.addEventListener('beforeunload', function (e) {
    if (typeof annotationHelper !== 'undefined') {
        if (annotationHelper.isChanged()) {
            e.preventDefault();
            e.returnValue = 'Do you want to save the changes?';
            annotationHelper.askSaveChange(
                function() {
                    unlockRequestWhenClosingBrowser();
                },
                function() {
                    unlockRequestWhenClosingBrowser();
                }
            );
        } else {
            unlockRequestWhenClosingBrowser();
        }
    }
});

let SummerNoteOptions = {
    backdrop: 'static',
    keyboard: false
};

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    cache: false,
    complete: function () {
        LetterAvatar.transform();
        // if ($('[data-toggle="tooltip"]').length > 0) {
        //     $('[data-toggle="tooltip"]')[0].tooltip();
        // }
    },
});

function show_toastr(title, message, type) {
    var o, i;
    var icon = '';
    var cls = '';

    if (type == "success") {
        icon = "fas fa-check-circle";
        cls = "success";
    } else if(type == "info"){
        icon = "fas fa-exclamation-circle";
        cls = "info";
    }else {
        icon = "fas fa-times-circle";
        cls = "danger";
    }

    $.notify({icon: icon, title: " " + title, message: message, url: ""}, {
        element: "body",
        type: cls,
        allow_dismiss: !0,
        placement: {from: 'top', align: 'right'},
        offset: {x: 15, y: 15},
        spacing: 10,
        z_index: 1080,
        delay: 2500,
        timer: 2000,
        url_target: "_blank",
        mouse_over: !1,
        animate: {enter: o, exit: i},
        template: '<div class="alert alert-{0} alert-icon alert-group alert-notify" data-notify="container" role="alert"><div class="alert-group-prepend alert-content"><span class="alert-group-icon"><i data-notify="icon"></i></span></div><div class="alert-content"><strong data-notify="title">{1}</strong><div data-notify="message">{2}</div></div><button type="button" class="close" data-notify="dismiss" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
    });
}

$(document).ready(function () {
    $(window).resize();
    LetterAvatar.transform();
    // if ($('[data-toggle="tooltip"]').length > 0) {
    //     $('[data-toggle="tooltip"]')[0].tooltip();
    // }

    $('#commonModal-right').on('shown.bs.modal', function () {
        $(document).off('focusin.modal');
    });

    if ($(".summernote-simple").length) {
        setTimeout(function () {
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
                ]
            });
        }, 100);
    }

    $('.dropdown-steady').click(function (e) {
        e.stopPropagation();
    });
});

$(function () {
    var title = $('.active.main_title').attr('data-title');
    if (title != '' && title != undefined) {
        if (title != 'home') {
            $('#menu_title').html(title);
            $('#header_title').html(title);
            $('#title_text').html('');
            $('#title_text').html(title + ' - ' + $('#title_text').attr('data-dash'));
        }
    }

    $(document).on('click', '.back-page', function () {
        if (typeof annotationHelper !== 'undefined') {
            if (annotationHelper.isChanged()) {
                annotationHelper.askSaveChange(
                    function() {
                        unlockRequestWithCloseRequest();
                    },
                    function() {
                        unlockRequestWithCloseRequest();
                    }
                );
            } else {
                unlockRequestWithCloseRequest();
            }
        } else {
            closeRequest();
        }
    });

    $(document).on('click', '.folder-back-page', function (e) {
        e.preventDefault();
        $('#folder-filter-form').trigger('submit');
        return false;
    });
});

function unlockRequestWithCloseRequest() {
    const waitingUnlockRequest = async () => {
        await annotationHelper.unlockRequest();
        setTimeout(function () {
            closeRequest();
        }, 2000);
    };
    waitingUnlockRequest();
}

function unlockRequestWhenClosingBrowser() {
    const waitingUnlockRequest = async () => {
        await annotationHelper.unlockRequest();
        window.close();
    };
    waitingUnlockRequest();
}

function closeRequest() {
    if ($('.main_title').hasClass('active')) {
        window.location.href = $('a.active.main_title').attr('data-link');
    } else {
        window.location.href = $('#home_menu').attr('data-link');
    }
}

function ShowAskSubmitRequest(e, title, size, url) {
    // Remove all size class
    $("#commonModal .modal-dialog").removeClass('modal-sm');
    $("#commonModal .modal-dialog").removeClass('modal-md');
    $("#commonModal .modal-dialog").removeClass('modal-lg');
    $("#commonModal .modal-dialog").removeClass('modal-xl');
    // end

    $("#commonModal .modal-title").html(title);
    $("#commonModal .modal-dialog").addClass('modal-' + size);

    return fetch(url, {})
        .then(response => {
            if (response.redirected) {
                window.location.href = response.url;
                return false;
            } else {
                if ($(".historyTable").length > 0) {
                    $(".historyTable").DataTable().destroy(true);
                }
                return response.text();
            }
        })
        .then((response) => {
            let html;
            try {
                let data = JSON.parse(response);
                html = data?.html ? data.html : data;
            } catch(err) {
                html = response;
            }

            let hasEditor = $(html).find('.summernote-simple, .summernote-simple-sidebar').length !== 0;
            $('#commonModal .modal-body').html(html);
            $("#commonModal").modal('show');
            hasEditor ?
                $("#commonModal").data('bs.modal')._config = SummerNoteOptions
                :
                $("#commonModal").data('bs.modal')._config = {show: true, backdrop: true};
            commonLoader(url);
            loadSortable();
        })
        .catch(error => console.log('Error:', error));

    // $.ajax({
    //     url: url,
    //     cache: false,
    //     beforeSend: function () {
    //         if ($(".historyTable").length > 0) {
    //             $(".historyTable").DataTable().destroy(true);
    //         }
    //     },
    //     success: function(data, status, xhr) {
    //         if (!xhr.responseJSON) {
    //             location.reload();
    //             return false;
    //         }
    //         const html = data?.html ? data.html : data
    //         let hasEditor = $(data).find('.summernote-simple, .summernote-simple-sidebar').length !== 0;
    //         $('#commonModal .modal-body').html(html);
    //         $("#commonModal").modal('show');
    //         hasEditor ?
    //             $("#commonModal").data('bs.modal')._config = SummerNoteOptions
    //             :
    //             $("#commonModal").data('bs.modal')._config = {show: true, backdrop: true};
    //         commonLoader(url);
    //         loadSortable();
    //     },
    //     error: function (data) {
    //         data = data.responseJSON;
    //         show_toastr('Error', data.error, 'error')
    //     }
    // });

    e.stopImmediatePropagation();
    return false;
}

$(document).on('click', 'button[data-ajax-popup-confirm="true"]', function (e) {
    var title = $(this).attr('data-title');
    var size = ($(this).attr('data-size') == '') ? 'md' : $(this).attr('data-size');
    var url = $(this).attr('data-url');
    var text = $('#working-tab').text();
    if (text.indexOf('(0)') == -1) {
        var modalConfirm = function(callback) {
            $("#confirm-submit-request").modal('show');

            $("#bt_submit_request_yes").on("click", function() {
                callback(true);
                $("#confirm-submit-request").modal('hide');
            });

            $("#bt_submit_request_no").on("click", function() {
                callback(false);
                $("#confirm-submit-request").modal('hide');
            });
        };

        modalConfirm(function(confirm) {
            if (!confirm) {
                return false;
            } else {
                ShowAskSubmitRequest(e, title, size, url);
            }
        });
    } else {
        ShowAskSubmitRequest(e, title, size, url);
    }
});

// Common Modal
$(document).on('click', 'a[data-ajax-popup="true"], button[data-ajax-popup="true"], div[data-ajax-popup="true"], span[data-ajax-popup="true"]', function (e) {
    var title = $(this).attr('data-title');
    var size = ($(this).attr('data-size') == '') ? 'md' : $(this).attr('data-size');
    var url = $(this).attr('data-url');

    // Remove all size class
    $("#commonModal .modal-dialog").removeClass('modal-sm');
    $("#commonModal .modal-dialog").removeClass('modal-md');
    $("#commonModal .modal-dialog").removeClass('modal-lg');
    $("#commonModal .modal-dialog").removeClass('modal-xl');
    // end

    $("#commonModal .modal-title").html(title);
    $("#commonModal .modal-dialog").addClass('modal-' + size);

    return fetch(url)
        .then(response => {
            if (response.redirected) {
                window.location.href = response.url;
                return false;
            } else {
                if ($(".historyTable").length > 0) {
                    $(".historyTable").DataTable().destroy(true);
                }
                return response.text();
            }
        })
        .then((response) => {

            let html;
            try {
                let data = JSON.parse(response);
                 html = data?.html ? data.html : data;
            } catch(err) {
                 html = response;
            }

            let hasEditor = $(html).find('.summernote-simple, .summernote-simple-sidebar').length !== 0;
            $('#commonModal .modal-body').empty();
            $('#commonModal .modal-body').html(html);
            $("#commonModal").modal('show');
            hasEditor ?
                $("#commonModal").data('bs.modal')._config = SummerNoteOptions
                :
                $("#commonModal").data('bs.modal')._config = {show: true, backdrop: true};
            commonLoader(url);
            loadSortable();
        })
        .catch(error => console.log('Error:', error));

    // $.ajax({
    //     url: url,
    //     cache: false,
    //     beforeSend: function () {
    //         if ($(".historyTable").length > 0) {
    //             $(".historyTable").DataTable().destroy(true);
    //         }
    //     },
    //     success: function(data, status, xhr) {
    //         // if (!xhr.responseJSON) {
    //         //     location.reload();
    //         //     return false;
    //         // }
    //         const html = data?.html ? data.html : data
    //         let hasEditor = $(data).find('.summernote-simple, .summernote-simple-sidebar').length !== 0;
    //         $('#commonModal .modal-body').empty();
    //         $('#commonModal .modal-body').html(html);
    //         $("#commonModal").modal('show');
    //         hasEditor ?
    //             $("#commonModal").data('bs.modal')._config = SummerNoteOptions
    //             :
    //             $("#commonModal").data('bs.modal')._config = {show: true, backdrop: true};
    //         commonLoader(url);
    //         loadSortable();
    //     },
    //     error: function (data) {
    //         data = data.responseJSON;
    //         show_toastr('Error', data.error, 'error')
    //     }
    // });

    e.stopImmediatePropagation();
    return false;
});

// Common Modal 2
$(document).on('click', 'a[data-ajax-popup2="true"], button[data-ajax-popup2="true"], div[data-ajax-popup2="true"], span[data-ajax-popup2="true"]', function (e) {
    var title = $(this).attr('data-title');
    var size = ($(this).attr('data-size') == '') ? 'md' : $(this).attr('data-size');
    var url = $(this).attr('data-url');

    // Remove all size class
    $("#commonModal2 .modal-dialog").removeClass('modal-sm');
    $("#commonModal2 .modal-dialog").removeClass('modal-md');
    $("#commonModal2 .modal-dialog").removeClass('modal-lg');
    $("#commonModal2 .modal-dialog").removeClass('modal-xl');
    // end

    $("#commonModal2 .modal-title").html(title);
    $("#commonModal2 .modal-dialog").addClass('modal-' + size);

    return fetch(url, {})
        .then(response => {
            if (response.redirected) {
                window.location.href = response.url;
                return false;
            } else {
                if ($(".historyTable").length > 0) {
                    $(".historyTable").DataTable().destroy(true);
                }
                return response.text();
            }
        })
        .then((response) => {
            let html;
            try {
                let data = JSON.parse(response);
                html = data?.html ? data.html : data;
            } catch(err) {
                html = response;
            }

            let hasEditor = $(html).find('.summernote-simple, .summernote-simple-sidebar').length !== 0;
            $('#commonModal2 .modal-body').html(html);
            $("#commonModal2").modal('show');
            hasEditor ?
                $("#commonModal2").data('bs.modal')._config = SummerNoteOptions
                :
                $("#commonModal2").data('bs.modal')._config = {show: true, backdrop: true};
            commonLoader(url);
            loadSortable();
        })
        .catch(error => console.log('Error:', error));

    // $.ajax({
    //     url: url,
    //     cache: false,
    //     beforeSend: function () {
    //         if ($(".historyTable").length > 0) {
    //             $(".historyTable").DataTable().destroy(true);
    //         }
    //     },
    //     success: function(data, status, xhr) {
    //         // if (!xhr.responseJSON) {
    //         //     location.reload();
    //         //     return false;
    //         // }
    //         let hasEditor = $(data).find('.summernote-simple, .summernote-simple-sidebar').length !== 0;
    //         $('#commonModal2 .modal-body').html(data);
    //         $("#commonModal2").modal('show');
    //         hasEditor ?
    //             $("#commonModal2").data('bs.modal')._config = SummerNoteOptions
    //             :
    //             $("#commonModal2").data('bs.modal')._config = {show: true, backdrop: true};
    //         commonLoader();
    //         loadSortable();
    //     },
    //     error: function (data) {
    //         data = data.responseJSON;
    //         show_toastr('Error', data.error, 'error')
    //     }
    // });

    e.stopImmediatePropagation();
    return false;
});

// Common Modal from right side
$(document).on('click', 'a[data-ajax-popup-right="true"], button[data-ajax-popup-right="true"], div[data-ajax-popup-right="true"], span[data-ajax-popup-right="true"]', function (e) {
    var url = $(this).data('url');

    return fetch(url, {})
        .then(response => {
            if (response.redirected) {
                window.location.href = response.url;
                return false;
            } else {
                if ($(".historyTable").length > 0) {
                    $(".historyTable").DataTable().destroy(true);
                }
                return response.text();
            }
        })
        .then((response) => {
            let html;
            try {
                let data = JSON.parse(response);
                html = data?.html ? data.html : data;
            } catch(err) {
                html = response;
            }

            let hasEditor = $(html).find('.summernote-simple, .summernote-simple-sidebar').length !== 0;
            $('#commonModal-right').html(html);
            $("#commonModal-right").modal('show');
            hasEditor ?
                $("#commonModal-right").data('bs.modal')._config = SummerNoteOptions
                :
                $("#commonModal-right").data('bs.modal')._config = {show: true, backdrop: true};
            commonLoader(this.url);
        })
        .catch(error => console.log('Error:', error));

    // $.ajax({
    //     url: url,
    //     cache: false,
    //     success: function(data, status, xhr) {
    //         // if (!xhr.responseJSON) {
    //         //     location.reload();
    //         //     return false;
    //         // }
    //         let hasEditor = $(data).find('.summernote-simple, .summernote-simple-sidebar').length !== 0;
    //         $('#commonModal-right').html(data);
    //         $("#commonModal-right").modal('show');
    //         hasEditor ?
    //             $("#commonModal-right").data('bs.modal')._config = SummerNoteOptions
    //             :
    //             $("#commonModal-right").data('bs.modal')._config = {show: true, backdrop: true};
    //         commonLoader(this.url);
    //     },
    //     error: function (data) {
    //         data = data.responseJSON;
    //         show_toastr('Error', data.error, 'error')
    //     }
    // });
});

// Common Modal for Basic details

$(document).on('click', '.open-basic-details', function (e) {
    var title = $(this).attr('data-title');
    var size = ($(this).attr('data-size') == '') ? 'md' : $(this).attr('data-size');
    var url = $(this).attr('data-url');
    var details = $(this).attr('data-details');

    // Remove all size class
    $("#commonModal .modal-dialog").removeClass('modal-sm');
    $("#commonModal .modal-dialog").removeClass('modal-md');
    $("#commonModal .modal-dialog").removeClass('modal-lg');
    $("#commonModal .modal-dialog").removeClass('modal-xl');
    // end

    $("#commonModal .modal-title").html(title);
    $("#commonModal .modal-dialog").addClass('modal-' + size);

    return fetch(url, {})
        .then(response => {
            if (response.redirected) {
                window.location.href = response.url;
                return false;
            } else {
                if ($(".historyTable").length > 0) {
                    $(".historyTable").DataTable().destroy(true);
                }
                return response.text();
            }
        })
        .then((response) => {
            let html;
            try {
                let data = JSON.parse(response);
                html = data?.html ? data.html : data;
            } catch(err) {
                html = response;
            }

            $('#commonModal .modal-body').html(html);
            $("#commonModal").modal('show');
            commonLoader();
            loadSortable();
        })
        .catch(error => console.log('Error:', error));

    // $.ajax({
    //     url: url,
    //     data: {basic_details:details},
    //     cache: false,
    //     method: 'POST',
    //     beforeSend: function () {
    //         if ($(".historyTable").length > 0) {
    //             $(".historyTable").DataTable().destroy(true);
    //         }
    //     },
    //     success: function(data, status, xhr) {
    //         // if (!xhr.responseJSON) {
    //         //     location.reload();
    //         //     return false;
    //         // }
    //         $('#commonModal .modal-body').html(data);
    //         $("#commonModal").modal('show');
    //         commonLoader();
    //         loadSortable();
    //     },
    //     error: function (data) {
    //         data = data.responseJSON;
    //         show_toastr('Error', data.error, 'error')
    //     }
    // });
    e.stopImmediatePropagation();
    return false;
});

function commonLoader(url) {
    LetterAvatar.transform();

    // if ($('[data-toggle="tooltip"]').length > 0) {
    //     $('[data-toggle="tooltip"]')[0].tooltip();
    // }

    if ($('[data-toggle="tags"]').length > 0) {
        $('[data-toggle="tags"]').tagsinput({tagClass: "badge badge-primary"});
    }

    if ($('[role="iconpicker"]').length > 0) {
        $('[role="iconpicker"]').iconpicker();
    }

    const defaultOptions = [
        ['style', ['style', 'strikethrough']],
        ["font", ["bold", "italic", "underline", "clear"]],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ["para", ["ul", "ol", "paragraph"]],
        ['insert', ['hr', 'link', 'picture', 'table']],
        ['height', ['height']],
        ['view', ['codeview']],
    ];

    function optionsWithoutImage() {
        return [
            ["font", ["bold", "italic", "underline", "clear"]],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ["para", ["ul", "ol", "paragraph"]],
            ['insert', ['hr', 'link']],
        ];
    }

    if ($(".summernote-simple").length) {
        setTimeout(function () {
            $(".summernote-simple").summernote({
                dialogsInBody: !0,
                minHeight: 200,
                toolbar: defaultOptions
                // made the editor similar as custom pages
                // url.indexOf("calendar") !== -1
                //     ? optionsWithoutImage()
                //     : defaultOptions,
            });
        }, 100);
    }

    var e = $(".scrollbar-inner");
    e.length && e.scrollbar().scrollLock()

    var e1 = $(".custom-input-file");
    e1.length && e1.each(function () {
        var e1 = $(this);
        e1.on("change", function (t) {
            !function (e, t, a) {
                var n, o = e.next("label"), i = o.html();
                t && t.files.length > 1 ? n = (t.getAttribute("data-multiple-caption") || "").replace("{count}", t.files.length) : a.target.value && (n = a.target.value.split("\\").pop()), n ? o.find("span").html(n) : o.html(i)
            }(e1, this, t)
        }), e1.on("focus", function () {
            !function (e) {
                e.addClass("has-focus")
            }(e1)
        }).on("blur", function () {
            !function (e) {
                e.removeClass("has-focus")
            }(e1)
        })
    })

    var e2 = $('[data-toggle="autosize"]');
    e2.length && autosize(e2);

    if ($(".historyTable").length > 0) {
        $(".historyTable").DataTable({
            language: tableLangData,
            dom: tableDom,
        });
    }

    if ($(".input-mask").length > 0) {
        $(".input-mask").each(function () {
            $('input[name="' + $(this).attr('name') + '"]').mask($(this).attr('data-mask'));
        });
    }

    var e = $('[data-toggle="password-text"]');
    e.length && e.on("click", function (e) {
        var t, a;
        t = $(this), "password" == (a = $(t.data("target"))).attr("type") ? a.attr("type", "text") : a.attr("type", "password")
    })
}

// Delete to open modal
(function ($, window, i) {
    // Bootstrap 4 Modal
    $.fn.fireModal = function (options) {
        var options = $.extend({
            size: 'modal-md',
            center: false,
            animation: true,
            title: 'Modal Title',
            closeButton: true,
            header: true,
            bodyClass: '',
            footerClass: '',
            body: '',
            buttons: [],
            autoFocus: true,
            created: function () {
            },
            appended: function () {
            },
            onFormSubmit: function () {
            },
            modal: {}
        }, options);

        this.each(function () {
            $(this).attr('class', function (index, className) {
                return className && className.replace(/trigger--fire-modal-\d+/, '');
            });
            i++;
            var id = 'fire-modal-' + i,
                trigger_class = 'trigger--' + id,
                trigger_button = $('.' + trigger_class);

            $(this).addClass(trigger_class);

            // Get modal body
            let body = options.body;

            if (typeof body == 'object') {
                if (body.length) {
                    let part = body;
                    body = body.removeAttr('id').clone().removeClass('modal-part');
                    part.remove();
                } else {
                    body = '<div class="text-danger">Modal part element not found!</div>';
                }
            }

            // Modal base template
            var modal_template = '   <div class="modal' + (options.animation == true ? ' fade' : '') + '" tabindex="-1" role="dialog" id="' + id + '">  ' +
                '     <div class="modal-dialog ' + options.size + (options.center ? ' modal-dialog-centered' : '') + '" role="document">  ' +
                '       <div class="modal-content">  ' +
                ((options.header == true) ?
                    '         <div class="modal-header">  ' +
                    '           <h5 class="modal-title">' + options.title + '</h5>  ' +
                    ((options.closeButton == true) ?
                        '           <button type="button" class="close" data-dismiss="modal" aria-label="Close">  ' +
                        '             <span aria-hidden="true">&times;</span>  ' +
                        '           </button>  '
                        : '') +
                    '         </div>  '
                    : '') +
                '         <div class="modal-body">  ' +
                '         </div>  ' +
                (options.buttons.length > 0 ?
                    '         <div class="modal-footer">  ' +
                    '         </div>  '
                    : '') +
                '       </div>  ' +
                '     </div>  ' +
                '  </div>  ';

            // Convert modal to object
            var modal_template = $(modal_template);

            // Start creating buttons from 'buttons' option
            var this_button;
            options.buttons.forEach(function (item) {
                // get option 'id'
                let id = "id" in item ? item.id : '';

                // Button template
                this_button = '<button type="' + ("submit" in item && item.submit == true ? 'submit' : 'button') + '" class="' + item.class + '" id="' + id + '">' + item.text + '</button>';

                // add click event to the button
                this_button = $(this_button).off('click').on("click", function () {
                    // execute function from 'handler' option
                    item.handler.call(this, modal_template);
                });
                // append generated buttons to the modal footer
                $(modal_template).find('.modal-footer').append(this_button);
            });

            // append a given body to the modal
            $(modal_template).find('.modal-body').append(body);

            // add additional body class
            if (options.bodyClass) $(modal_template).find('.modal-body').addClass(options.bodyClass);

            // add footer body class
            if (options.footerClass) $(modal_template).find('.modal-footer').addClass(options.footerClass);

            // execute 'created' callback
            options.created.call(this, modal_template, options);

            // modal form and submit form button
            let modal_form = $(modal_template).find('.modal-body form'),
                form_submit_btn = modal_template.find('button[type=submit]');

            // append generated modal to the body
            $("body").append(modal_template);

            // execute 'appended' callback
            options.appended.call(this, $('#' + id), modal_form, options);

            // if modal contains form elements
            if (modal_form.length) {
                // if `autoFocus` option is true
                if (options.autoFocus) {
                    // when modal is shown
                    $(modal_template).on('shown.bs.modal', function () {
                        // if type of `autoFocus` option is `boolean`
                        if (typeof options.autoFocus == 'boolean')
                            modal_form.find('input:eq(0)').focus(); // the first input element will be focused
                        // if type of `autoFocus` option is `string` and `autoFocus` option is an HTML element
                        else if (typeof options.autoFocus == 'string' && modal_form.find(options.autoFocus).length)
                            modal_form.find(options.autoFocus).focus(); // find elements and focus on that
                    });
                }

                // form object
                let form_object = {
                    startProgress: function () {
                        modal_template.addClass('modal-progress');
                    },
                    stopProgress: function () {
                        modal_template.removeClass('modal-progress');
                    }
                };

                // if form is not contains button element
                if (!modal_form.find('button').length) $(modal_form).append('<button class="d-none" id="' + id + '-submit"></button>');

                // add click event
                form_submit_btn.click(function () {
                    modal_form.submit();
                });

                // add submit event
                modal_form.submit(function (e) {
                    // start form progress
                    form_object.startProgress();

                    // execute `onFormSubmit` callback
                    options.onFormSubmit.call(this, modal_template, e, form_object);
                });
            }

            $(document).on("click", '.' + trigger_class, function () {
                $('#' + id).modal(options.modal);

                return false;
            });
        });
    }

    // Bootstrap Modal Destroyer
    $.destroyModal = function (modal) {
        modal.modal('hide');
        modal.on('hidden.bs.modal', function () {
        });
    }
})(jQuery, this, 0);

// Basic confirm box
loadConfirm();

function loadConfirm() {
    $('[data-confirm]').each(function () {
        var me = $(this),
            me_data = me.data('confirm');

        me_data = me_data.split("|");
        me.fireModal({
            title: me_data[0],
            body: me_data[1],
            buttons: [
                {
                    text: me.data('confirm-text-yes') || 'Yes',
                    class: 'btn btn-sm btn-danger rounded-pill',
                    handler: function () {
                        $('.modal button').prop('disabled', true);
                        eval(me.data('confirm-yes'));
                    }
                },
                {
                    text: me.data('confirm-text-cancel') || 'Cancel',
                    class: 'btn btn-sm btn-secondary rounded-pill',
                    handler: function (modal) {
                        $.destroyModal(modal);
                        eval(me.data('confirm-no'));
                    }
                }
            ]
        })
    });
}

function loadSortable() {
    setTimeout(function () {
        if ($('.sortable_layout').length > 0 || $('.sortable_navigation').length > 0) {
            // Make Sortable Page Layout
            $('.sortable_layout').sortable(
                {
                    start: function (event, ui) {
                        var start_pos = ui.item.index();
                        ui.item.data('start_pos', start_pos);
                    },
                    update: function (event, ui) {
                        var ids = [];
                        $('.layout_div').each(function () {
                            ids.push($(this).attr('data-id'));
                        });
                        layoutOrder(ids);
                    }
                }
            );
            // Make Public Sortable Navigation Layout
            $('.sortable_navigation').sortable(
                {
                    start: function (event, ui) {
                        var start_pos = ui.item.index();
                        ui.item.data('start_pos', start_pos);
                    },
                    update: function (event, ui) {
                        var ids = [];
                        $('.navigation_div').each(function () {
                            ids.push($(this).attr('data-id'));
                        });
                        navigationOrder(ids);
                    }
                }
            );
        }
    }, 500);
}

/**
 * Manage browser back/forward button event clicking
 */

//Firefox
var perfEntries = performance.getEntriesByType("navigation");

if (perfEntries[0].type === "back_forward") {
    location.reload(true);
}

//Chrome
(function () {
    window.onpageshow = function(event) {
        if (event.persisted) {
            window.location.reload();
        }
    };
})();

// Post Ajax Call
function postAjax(url, data, is_formData, cb) {
    var token = $('meta[name="csrf-token"]').attr('content');
    if (is_formData) {
        var jdata = data;

        $.ajax({
            type: 'POST',
            url: url,
            data: jdata,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                if (typeof (data) === 'object') {
                    cb(data);
                } else {
                    cb(data);
                }
            },
        });
    } else {
        var jdata = {_token: token};
        for (var k in data) {
            jdata[k] = data[k];
        }

        $.ajax({
            type: 'POST',
            url: url,
            data: jdata,
            success: function (data) {
                if (typeof (data) === 'object') {
                    cb(data);
                } else {
                    cb(data);
                }
            },
        });
    }
}

// get Ajax Call
function getAjax(url, cb) {
    $.ajax({
        type: 'get',
        url: url,
        success: function (data) {
            if (typeof (data) === 'object') {
                cb(data);
            } else {
                cb(data);
            }
        },
    });
}

function generatePrint(printData, printGridTitle, header) {
    printJS({
        printable: printData,
        properties: printGridTitle,
        type: 'json',
        gridHeaderStyle: 'color: #8492A6;  border-top: 1px solid #EFF2F7;padding: 15px;font-size: 0.8125rem;text-align:left;',
        gridStyle: 'border-top: 1px solid #EFF2F7;padding: 15px;font-size: 0.8125rem;',
        header: `<h4 class="custom-h4">${header}</h4>`,
        documentTitle: `${header}`,
        targetStyle: '[overflow: visible]'
    });
}

function convertToCSV(objArray) {
    var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
    var str = '';

    for (var i = 0; i < array.length; i++) {
        var line = '';
        for (var index in array[i]) {
            if (line != '') line += ','
            var ele = String(array[i][index]);
            ele = ele.replace(/,/g, "");
            line += ele;
        }

        str += line + '\r\n';
    }

    return str;
}

function exportCSVFile(headers, items, fileTitle) {

    var items = items.map(function(o){
        // use reduce to make objects with only the required properties
        // and map to apply this to the filtered array as a whole
        return headers.reduce(function(newo, name){
            newo[name] = o[name];
            return newo;
        }, {});
    });

    headers = headers.reduce(function(obj, v) {obj[v] = v;return obj;}, {});
    if (headers) {
        items.unshift(headers);
    }

    // Convert Object to JSON
    var jsonObject = JSON.stringify(items);

    var csv = convertToCSV(jsonObject);

    var exportedFilenmae = fileTitle + '.csv' || 'export.csv';

    var blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    if (navigator.msSaveBlob) { // IE 10+
        navigator.msSaveBlob(blob, exportedFilenmae);
    } else {
        var link = document.createElement("a");
        if (link.download !== undefined) { // feature detection
            // Browsers that support HTML5 download attribute
            var url = URL.createObjectURL(blob);
            link.setAttribute("href", url);
            link.setAttribute("download", exportedFilenmae);
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    }
}

$(document).on('click', '.config-menu-has-child .parent-menu', function () {
    $(this).closest('.config-menu-has-child').find('.config-menu-children').slideToggle();
    $(this).toggleClass("down");
});

$('.list-group-item:not(.config)').on('click', function () {
    $('.config-menu-children').hide(300);
    $('.config-menu-has-child .parent-menu').removeClass("down");
});

// Common Modal for Basic details

$(document).on("click", "#AddContentModal", function (e) {
    var title = $(this).attr("data-title");
    var size =
        $(this).attr("data-size") == "" ? "md" : $(this).attr("data-size");
    var url = $(this).attr("data-url");
    var details = $(this).attr("data-details");

    // Remove all size class
    $("#commonModal .modal-dialog").removeClass("modal-sm");
    $("#commonModal .modal-dialog").removeClass("modal-md");
    $("#commonModal .modal-dialog").removeClass("modal-lg");
    $("#commonModal .modal-dialog").removeClass("modal-xl");
    // end

    $("#commonModal .modal-title").html(title);
    $("#commonModal .modal-dialog").addClass("modal-" + size);

    $.ajax({
        url: url,
        cache: false,
        method: "get",
        success: function (data) {
            if(data.Success){
                $("#commonModal .modal-body").html(data.html);
                $("#commonModal").modal("show");
                commonLoader();
                loadSortable();
            }else{
                show_toastr("Error", data.ErrorMessage, "error");
            }
        },
        error: function (data) {
            data = data.responseJSON;
            show_toastr("Error", data.error, "error");
        },
    });
    e.stopImmediatePropagation();
    return false;
});

// Common Side Modal for Basic details

$(document).on("click", 'a[data-ajax-side-popup="true"], button[data-ajax-side-popup="true"], div[data-ajax-side-popup="true"], span[data-ajax-side-popup="true"]', function (e) {
    var title = $(this).attr("data-title");
    var size = $(this).attr("data-size") == "" ? "md" : $(this).attr("data-size");
    var url = $(this).attr("data-url");

    // Remove all size class
    $("#commonSideModal .modal-dialog").removeClass("modal-sm");
    $("#commonSideModal .modal-dialog").removeClass("modal-md");
    $("#commonSideModal .modal-dialog").removeClass("modal-lg");
    $("#commonSideModal .modal-dialog").removeClass("modal-xl");
    // end

    $("#commonSideModal .modal-title").html(title);
    $("#commonSideModal .modal-dialog").addClass("modal-" + size);

    $.ajax({
        url: url,
        cache: false,
        method: "get",
        success: function (data) {
            if(data.Success){
                $("#commonSideModal .scrollbar-inner").html(data.html);
                $("#commonSideModal").modal("show");
                commonLoader();
                loadSortable();
            }else{
                show_toastr("Error", data.ErrorMessage, "error");
            }
        },
        error: function (data) {
            data = data.responseJSON;
            show_toastr("Error", data.error, "error");
        },
    });
    e.stopImmediatePropagation();
    return false;
});
