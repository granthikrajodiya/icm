"use strict";

let SummerNoteOptions = {
    backdrop: "static",
    keyboard: false,
};

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    cache: false,
    complete: function () {
        LetterAvatar.transform();
        $('[data-toggle="tooltip"]').tooltip();
    },
});

function show_toastr(title, message, type) {
    var o, i;
    var icon = "";
    var cls = "";

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

    $.notify(
        { icon: icon, title: " " + title, message: message, url: "" },
        {
            element: "body",
            type: cls,
            allow_dismiss: !0,
            placement: { from: "top", align: "right" },
            offset: { x: 15, y: 15 },
            spacing: 10,
            z_index: 1080,
            delay: 2500,
            timer: 2000,
            url_target: "_blank",
            mouse_over: !1,
            animate: { enter: o, exit: i },
            template:
                '<div class="alert alert-{0} alert-icon alert-group alert-notify" data-notify="container" role="alert"><div class="alert-group-prepend alert-content"><span class="alert-group-icon"><i data-notify="icon"></i></span></div><div class="alert-content"><strong data-notify="title">{1}</strong><div data-notify="message">{2}</div></div><button type="button" class="close" data-notify="dismiss" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>',
        }
    );
}

$(document).ready(function () {
    $(window).resize();
    LetterAvatar.transform();
    $('[data-toggle="tooltip"]').tooltip();

    $("#commonModal-right").on("shown.bs.modal", function () {
        $(document).off("focusin.modal");
    });

    if ($(".summernote-simple").length) {
        setTimeout(function () {
            $(".summernote-simple").summernote({
                dialogsInBody: !0,
                minHeight: 200,
                toolbar: [
                    ["style", ["style", "strikethrough"]],
                    ["font", ["bold", "italic", "underline", "clear"]],
                    ["fontname", ["fontname"]],
                    ["fontsize", ["fontsize"]],
                    ["color", ["color"]],
                    ["para", ["ul", "ol", "paragraph"]],
                    ["insert", ["hr", "link", "picture"]],
                    ["height", ["height"]],
                    ["view", ["codeview"]],
                ],
            });
        }, 100);
    }

    $(".dropdown-steady").click(function (e) {
        e.stopPropagation();
    });
});

$(function () {
    var title = $(".active.main_title").attr("data-title");
    if (title != "" && title != undefined) {
        if (title != "home") {
            $("#menu_title").html(title);
            $("#header_title").html(title);
            $("#title_text").html("");
            $("#title_text").html(
                title + " - " + $("#title_text").attr("data-dash")
            );
        }
    }

    $(document).on("click", ".back-page", function () {
        if ($(".main_title").hasClass("active")) {
            window.location.href = $("a.active.main_title").attr("data-link");
        } else {
            window.location.href = $("#home_menu").attr("data-link");
        }
    });

    $(document).on("click", ".folder-back-page", function (e) {
        e.preventDefault();
        $("#folder-filter-form").trigger("submit");
        return false;
    });
});

// Common Modal
$(document).on(
    "click",
    'a[data-ajax-popup="true"], button[data-ajax-popup="true"], div[data-ajax-popup="true"], span[data-ajax-popup="true"]',
    function (e) {
        var title = $(this).attr("data-title");
        var size =
            $(this).attr("data-size") == "" ? "md" : $(this).attr("data-size");
        var url = $(this).attr("data-url");

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
            beforeSend: function () {
                if ($(".historyTable").length > 0) {
                    $(".historyTable").DataTable().destroy(true);
                }
            },
            success: function (data) {
                const html = data?.html ? data.html : data;
                let hasEditor =
                    $(data).find(
                        ".summernote-simple, .summernote-simple-sidebar"
                    ).length !== 0;
                $("#commonModal .modal-body").html(html);
                $("#commonModal").modal({
                    backdrop: "static",
                    keyboard: false,
                    show: true, // added property here
                });
                hasEditor
                    ? (
                        $("#commonModal").modal({
                            backdrop: "static",
                            keyboard: false,
                        })
                    )
                    : (
                        $("#commonModal").modal({
                            show: true,
                            backdrop: "static",
                            keyboard: false,
                        })
                     );
                commonLoader(url);
                loadSortable();
            },
            error: function (data) {
                data = data.responseJSON;
                show_toastr("Error", data.error, "error");
            },
        });
        e.stopImmediatePropagation();
        return false;
    }
);

// Common Modal 2
$(document).on(
    "click",
    'a[data-ajax-popup2="true"], button[data-ajax-popup2="true"], div[data-ajax-popup2="true"], span[data-ajax-popup2="true"]',
    function (e) {
        var title = $(this).attr("data-title");
        var size =
            $(this).attr("data-size") == "" ? "md" : $(this).attr("data-size");
        var url = $(this).attr("data-url");

        // Remove all size class
        $("#commonModal2 .modal-dialog").removeClass("modal-sm");
        $("#commonModal2 .modal-dialog").removeClass("modal-md");
        $("#commonModal2 .modal-dialog").removeClass("modal-lg");
        $("#commonModal2 .modal-dialog").removeClass("modal-xl");
        // end

        $("#commonModal2 .modal-title").html(title);
        $("#commonModal2 .modal-dialog").addClass("modal-" + size);

        $.ajax({
            url: url,
            cache: false,
            beforeSend: function () {
                if ($(".historyTable").length > 0) {
                    $(".historyTable").DataTable().destroy(true);
                }
            },
            success: function (data) {
                let hasEditor =
                    $(data).find(
                        ".summernote-simple, .summernote-simple-sidebar"
                    ).length !== 0;
                $("#commonModal2 .modal-body").html(data);
                //$("#commonModal2").modal("show");
                $("#commonModal2").modal({
                    backdrop: "static",
                    keyboard: false,
                    show: true, // added property here
                });
                hasEditor
                    ? (
                        $("#commonModal2").modal({
                            backdrop: "static",
                            keyboard: false,
                        })
                    )
                    :(
                        $("#commonModal2").modal({
                            backdrop: "static",
                            keyboard: false,
                            show: true, // added property here
                        })
                    )
                commonLoader();
                loadSortable();
            },
            error: function (data) {
                data = data.responseJSON;
                show_toastr("Error", data.error, "error");
            },
        });
        e.stopImmediatePropagation();
        return false;
    }
);

// Common Modal 3
$(document).on(
    "click",
    'a[data-ajax-popup3="true"]',
    function (e) {
        var title = $(this).attr("data-title");
        var size =
            $(this).attr("data-size") == "" ? "md" : $(this).attr("data-size");
        var url = $(this).attr("data-url");

        // Remove all size class
        $("#commonModal3 .modal-dialog").removeClass("modal-sm");
        $("#commonModal3 .modal-dialog").removeClass("modal-md");
        $("#commonModal3 .modal-dialog").removeClass("modal-lg");
        $("#commonModal3 .modal-dialog").removeClass("modal-xl");
        // end

        $("#commonModal3 .modal-title").html(title);
        $("#commonModal3 .modal-dialog").addClass("modal-" + size);

        $.ajax({
            url: url,
            cache: false,
            beforeSend: function () {
                if ($(".historyTable").length > 0) {
                    $(".historyTable").DataTable().destroy(true);
                }
            },
            success: function (data) {
                $("#commonModal3 .modal-body").html(data);
                $("#commonModal3").modal({
                    backdrop: "static",
                    keyboard: false,
                    show: true, // added property here
                });
                commonLoader();
                loadSortable();
            },
            error: function (data) {
                data = data.responseJSON;
                show_toastr("Error", data.error, "error");
            },
        });
        e.stopImmediatePropagation();
        return false;
    }
);


// Common Modal from right side
$(document).on(
    "click",
    'a[data-ajax-popup-right="true"], button[data-ajax-popup-right="true"], div[data-ajax-popup-right="true"], span[data-ajax-popup-right="true"]',
    function (e) {
        var url = $(this).data("url");

        $.ajax({
            url: url,
            cache: false,
            success: function (data) {
                let hasEditor =
                    $(data).find(
                        ".summernote-simple, .summernote-simple-sidebar"
                    ).length !== 0;
                $("#commonModal-right").html(data);
                $("#commonModal-right").modal("show");
                hasEditor
                    ? (
                        $("#commonModal-right").modal({
                            backdrop: "static",
                            keyboard: false,
                        })
                    )
                    : (
                        $("#commonModal-right").modal({
                            show: true,
                            backdrop: true,
                        })
                    );
                commonLoader(this.url);
            },
            error: function (data) {
                data = data.responseJSON;
                show_toastr("Error", data.error, "error");
            },
        });
    }
);

// Common Modal for Basic details

$(document).on("click", ".open-basic-details", function (e) {
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
        data: { basic_details: details },
        cache: false,
        method: "POST",
        beforeSend: function () {
            if ($(".historyTable").length > 0) {
                $(".historyTable").DataTable().destroy(true);
            }
        },
        success: function (data) {
            $("#commonModal .modal-body").html(data);
            $("#commonModal").modal("show");
            commonLoader();
            loadSortable();
        },
        error: function (data) {
            data = data.responseJSON;
            show_toastr("Error", data.error, "error");
        },
    });
    e.stopImmediatePropagation();
    return false;
});

function commonLoader(url) {
    LetterAvatar.transform();
    $('[data-toggle="tooltip"]').tooltip();
    if ($('[data-toggle="tags"]').length > 0) {
        $('[data-toggle="tags"]').tagsinput({
            tagClass: "badge badge-primary",
        });
    }

    if ($('[role="iconpicker"]').length > 0) {
        $('[role="iconpicker"]').iconpicker();
    }

    const defaultOptions = [
        ["style", ["style", "strikethrough"]],
        ["font", ["bold", "italic", "underline", "clear"]],
        ["fontname", ["fontname"]],
        ["fontsize", ["fontsize"]],
        ["color", ["color"]],
        ["para", ["ul", "ol", "paragraph"]],
        ["insert", ["hr", "link", "picture", "table"]],
        ["height", ["height"]],
        ["view", ["codeview"]],
    ];

    function optionsWithoutImage() {
        return [
            ["font", ["bold", "italic", "underline", "clear"]],
            ["fontname", ["fontname"]],
            ["fontsize", ["fontsize"]],
            ["color", ["color"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["insert", ["hr", "link"]],
        ];
    }

    if ($(".summernote-simple").length) {
        setTimeout(function () {
            $(".summernote-simple").summernote({
                dialogsInBody: !0,
                minHeight: 200,
                toolbar:
                    url.indexOf("calendar") !== -1
                        ? optionsWithoutImage()
                        : defaultOptions,
            });
        }, 100);
    }

    var e = $(".scrollbar-inner");
    e.length && e.scrollbar().scrollLock();

    var e1 = $(".custom-input-file");
    e1.length &&
        e1.each(function () {
            var e1 = $(this);
            e1.on("change", function (t) {
                !(function (e, t, a) {
                    var n,
                        o = e.next("label"),
                        i = o.html();
                    t && t.files.length > 1
                        ? (n = (
                              t.getAttribute("data-multiple-caption") || ""
                          ).replace("{count}", t.files.length))
                        : a.target.value &&
                          (n = a.target.value.split("\\").pop()),
                        n ? o.find("span").html(n) : o.html(i);
                })(e1, this, t);
            }),
                e1
                    .on("focus", function () {
                        !(function (e) {
                            e.addClass("has-focus");
                        })(e1);
                    })
                    .on("blur", function () {
                        !(function (e) {
                            e.removeClass("has-focus");
                        })(e1);
                    });
        });

    var e2 = $('[data-toggle="autosize"]');
    e2.length && autosize(e2);

    if ($(".historyTable").length > 0) {
        $(".historyTable").DataTable({
            language: tableLangData,
        });
    }

    if ($(".input-mask").length > 0) {
        $(".input-mask").each(function () {
            $('input[name="' + $(this).attr("name") + '"]').mask(
                $(this).attr("data-mask")
            );
        });
    }

    var e = $('[data-toggle="password-text"]');
    e.length &&
        e.on("click", function (e) {
            var t, a;
            (t = $(this)),
                "password" == (a = $(t.data("target"))).attr("type")
                    ? a.attr("type", "text")
                    : a.attr("type", "password");
        });
}

// Delete to open modal
(function ($, window, i) {
    // Bootstrap 4 Modal
    $.fn.fireModal = function (options) {
        var options = $.extend(
            {
                size: "modal-md",
                center: false,
                animation: true,
                title: "Modal Title",
                closeButton: true,
                header: true,
                bodyClass: "",
                footerClass: "",
                body: "",
                buttons: [],
                autoFocus: true,
                created: function () {},
                appended: function () {},
                onFormSubmit: function () {},
                modal: {},
            },
            options
        );

        this.each(function () {
            i++;
            var id = "fire-modal-" + i,
                trigger_class = "trigger--" + id,
                trigger_button = $("." + trigger_class);

            $(this).addClass(trigger_class);

            // Get modal body
            let body = options.body;

            if (typeof body == "object") {
                if (body.length) {
                    let part = body;
                    body = body
                        .removeAttr("id")
                        .clone()
                        .removeClass("modal-part");
                    part.remove();
                } else {
                    body =
                        '<div class="text-danger">Modal part element not found!</div>';
                }
            }

            // Modal base template
            var modal_template =
                '   <div class="modal' +
                (options.animation == true ? " fade" : "") +
                '" tabindex="-1" role="dialog" id="' +
                id +
                '">  ' +
                '     <div class="modal-dialog ' +
                options.size +
                (options.center ? " modal-dialog-centered" : "") +
                '" role="document">  ' +
                '       <div class="modal-content">  ' +
                (options.header == true
                    ? '         <div class="modal-header">  ' +
                      '           <h5 class="modal-title">' +
                      options.title +
                      "</h5>  " +
                      (options.closeButton == true
                          ? '           <button type="button" class="close" data-dismiss="modal" aria-label="Close">  ' +
                            '             <span aria-hidden="true">&times;</span>  ' +
                            "           </button>  "
                          : "") +
                      "         </div>  "
                    : "") +
                '         <div class="modal-body">  ' +
                "         </div>  " +
                (options.buttons.length > 0
                    ? '         <div class="modal-footer">  ' +
                      "         </div>  "
                    : "") +
                "       </div>  " +
                "     </div>  " +
                "  </div>  ";

            // Convert modal to object
            var modal_template = $(modal_template);

            // Start creating buttons from 'buttons' option
            var this_button;
            options.buttons.forEach(function (item) {
                // get option 'id'
                let id = "id" in item ? item.id : "";

                // Button template
                this_button =
                    '<button type="' +
                    ("submit" in item && item.submit == true
                        ? "submit"
                        : "button") +
                    '" class="' +
                    item.class +
                    '" id="' +
                    id +
                    '">' +
                    item.text +
                    "</button>";

                // add click event to the button
                this_button = $(this_button)
                    .off("click")
                    .on("click", function () {
                        // execute function from 'handler' option
                        item.handler.call(this, modal_template);
                    });
                // append generated buttons to the modal footer
                $(modal_template).find(".modal-footer").append(this_button);
            });

            // append a given body to the modal
            $(modal_template).find(".modal-body").append(body);

            // add additional body class
            if (options.bodyClass)
                $(modal_template)
                    .find(".modal-body")
                    .addClass(options.bodyClass);

            // add footer body class
            if (options.footerClass)
                $(modal_template)
                    .find(".modal-footer")
                    .addClass(options.footerClass);

            // execute 'created' callback
            options.created.call(this, modal_template, options);

            // modal form and submit form button
            let modal_form = $(modal_template).find(".modal-body form"),
                form_submit_btn = modal_template.find("button[type=submit]");

            // append generated modal to the body
            $("body").append(modal_template);

            // execute 'appended' callback
            options.appended.call(this, $("#" + id), modal_form, options);

            // if modal contains form elements
            if (modal_form.length) {
                // if `autoFocus` option is true
                if (options.autoFocus) {
                    // when modal is shown
                    $(modal_template).on("shown.bs.modal", function () {
                        // if type of `autoFocus` option is `boolean`
                        if (typeof options.autoFocus == "boolean")
                            modal_form.find("input:eq(0)").focus();
                        // the first input element will be focused
                        // if type of `autoFocus` option is `string` and `autoFocus` option is an HTML element
                        else if (
                            typeof options.autoFocus == "string" &&
                            modal_form.find(options.autoFocus).length
                        )
                            modal_form.find(options.autoFocus).focus(); // find elements and focus on that
                    });
                }

                // form object
                let form_object = {
                    startProgress: function () {
                        modal_template.addClass("modal-progress");
                    },
                    stopProgress: function () {
                        modal_template.removeClass("modal-progress");
                    },
                };

                // if form is not contains button element
                if (!modal_form.find("button").length)
                    $(modal_form).append(
                        '<button class="d-none" id="' +
                            id +
                            '-submit"></button>'
                    );

                // add click event
                form_submit_btn.click(function () {
                    modal_form.submit();
                });

                // add submit event
                modal_form.submit(function (e) {
                    // start form progress
                    form_object.startProgress();

                    // execute `onFormSubmit` callback
                    options.onFormSubmit.call(
                        this,
                        modal_template,
                        e,
                        form_object
                    );
                });
            }

            $(document).on("click", "." + trigger_class, function () {
                $("#" + id).modal(options.modal);

                return false;
            });
        });
    };

    // Bootstrap Modal Destroyer
    $.destroyModal = function (modal) {
        modal.modal("hide");
        modal.on("hidden.bs.modal", function () {});
    };
})(jQuery, this, 0);

// Basic confirm box
loadConfirm();

function loadConfirm() {
    $("[data-confirm]").each(function () {
        var me = $(this),
            me_data = me.data("confirm");

        me_data = me_data.split("|");
        me.fireModal({
            title: me_data[0],
            body: me_data[1],
            buttons: [
                {
                    text: me.data("confirm-text-yes") || "Yes",
                    class: "btn btn-sm btn-danger rounded-pill",
                    handler: function () {
                        eval(me.data("confirm-yes"));
                    },
                },
                {
                    text: me.data("confirm-text-cancel") || "Cancel",
                    class: "btn btn-sm btn-secondary rounded-pill",
                    handler: function (modal) {
                        $.destroyModal(modal);
                        eval(me.data("confirm-no"));
                    },
                },
            ],
        });
    });
}

function loadSortable() {
    setTimeout(function () {
        if (
            $(".sortable_layout").length > 0 ||
            $(".sortable_navigation").length > 0
        ) {
            // Make Sortable Page Layout
            $(".sortable_layout").sortable({
                start: function (event, ui) {
                    var start_pos = ui.item.index();
                    ui.item.data("start_pos", start_pos);
                },
                update: function (event, ui) {
                    var ids = [];
                    $(".layout_div").each(function () {
                        ids.push($(this).attr("data-id"));
                    });
                    layoutOrder(ids);
                },
            });
            // Make Public Sortable Navigation Layout
            $(".sortable_navigation").sortable({
                start: function (event, ui) {
                    var start_pos = ui.item.index();
                    ui.item.data("start_pos", start_pos);
                },
                update: function (event, ui) {
                    var ids = [];
                    $(".navigation_div").each(function () {
                        ids.push($(this).attr("data-id"));
                    });
                    navigationOrder(ids);
                },
            });
        }
    }, 500);
}
