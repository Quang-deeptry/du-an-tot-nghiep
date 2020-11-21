$(function ($) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $(".click-editer").click(function () {
        $(".card").hide();
        $(".contact-form").show();
    });

    $(".click-reload").click(function () {
        $(".card").show();
        $(".contact-form").hide();
    });

    $(".click-load").hide();

    $(".click-update").click(function (e) {
        e.preventDefault();
        $(".click-load").show();
        $(".click-update").hide();
        let name = $("input[name='name']").val();
        let email = $("input[name='email']").val();
        let password = $("input[name='password']").val();

        setTimeout(function () {
            $.ajax({
                url: "/user-update",
                method: "POST",
                dataType: "json",
                data: {
                    name,
                    email,
                    password,
                },
                success: function (response) {
                    $(".click-load").hide();
                    $(".click-update").show();

                    let mess = `<code>${response.mess}</code>`;
                    $(".form-response").html(mess);
                },
            });
        }, 2000);
    });
});
