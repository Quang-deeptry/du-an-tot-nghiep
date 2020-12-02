$(function ($) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(".stylish-input-group button").on("click", function (e) {
        e.preventDefault();
        let message = $(".stylish-input-group input[type='text']").val();

        $.ajax({
            url: "/subscribe",
            method: "post",
            dataType: "json",
            data: { message },
            success: function (response) {
                setTimeout(function () {
                    const { error, errors, success } = response;

                    if (success) {
                        alert(success);
                        window.location.reload();
                    } else if (errors) {
                        alert(errors.message);
                    } else {
                        alert(error);
                    }
                }, 1500);
            },
        });
    });
});
