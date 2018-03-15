"use strict";

var emitter = window.top.jsEmailBuilderEmitter;

function dialogSendTestEmail() {
    swal({
            title: "Send test email",
            text: "Enter email address to send:",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "john@example.com",
            showLoaderOnConfirm: true,
        },
        function (inputValue) {
            if (inputValue === false) return false;

            if (inputValue === "") {
                swal.showInputError("Please enter email address to send.");
                return false
            }

            var templateHTML = $('#templateHTML').val();

            var data = {};
            data.action = 'send-test-emails';
            data.emails = inputValue;
            data.templateHTML = templateHTML; // Base64 Encode

            $.ajax({
                url: config.send_script,
                type: 'POST',
                dataType: 'json',
                data: data,
                success: function (data) {
                    if (data['type'] == 'success') {
                        // show error message
                        swal("Nice!", "Email has been sent to: " + inputValue, "success");
                    } else {
                        swal("Oops!", "An error is occurred", "error");
                    }

                },
                error: function (xhr, err) {
                    // Log errors if AJAX call is failed
                    console.log(xhr);
                    console.log(err);
                }
            });
            return false;

        });
};


function dialogExportHTML() {
    swal({
            title: "Export to HTML",
            text: "Export template to single HTML file",
            type: "info",
            showCancelButton: true,
            showLoaderOnConfirm: true,
        },
        function () {
            setTimeout(function () {
                swal("Template has been exported successfully");
                $('#export-form [name="type"]').val('html');
                $('#export-form').submit();
            }, 1000);
        });
};

function dialogExportZip() {
    swal({
            title: "Export to ZIP",
            text: "Export template to zip-archive",
            type: "info",
            showCancelButton: true,
            showLoaderOnConfirm: true,
        },
        function () {
            setTimeout(function () {
                swal("Template has been exported successfully");
                $('#export-form [name="type"]').val('zip');
                $('#export-form').submit();
            }, 1000);
        });

};

emitter.on('init', function () {
    $('[data-action="send-test-email"]').on('click', function (event) {
        dialogSendTestEmail();
    });
    $('[data-action="export-html"]').on('click', function (event) {
        dialogExportHTML();
    });
    $('[data-action="export-zip"]').on('click', function (event) {
        dialogExportZip();
    });
});
