
// common loader

function openCommonLoader(title,size,url) {

    console.log('>>> dlc_custom openCommonLoader url: ' + url);

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
        //type: 'GET',
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
            //$("#commonModal").modal("show");
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
    return false;
}
