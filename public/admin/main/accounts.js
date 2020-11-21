$(function ($) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $(".click-update").click(function (e) {
        e.preventDefault();

        let id = $("input[name='id']").val();
        let username = $("input[name='username']").val();
        let email = $("input[name='email']").val();
        let password = $("input[name='password']").val();
        let role = $(".custom-select").val();

        setTimeout(function () {
            $.ajax({
                url: "/admin-newsflash/manager-accounts/update",
                method: "post",
                dataType: "json",
                data: {
                    id,
                    username,
                    email,
                    password,
                    role,
                },
                success: function (response) {
                    let html = `<div class="alert alert-${response.alert}"><b>${response.mess}</b></div>`;
                    $("#response-mess").html(html);
                    $("#response-mess").fadeIn().delay(2000).fadeOut("slow");
                    if (response.alert == "success") {
                        setTimeout(function () {
                            window.location.href =
                                window.location.origin +
                                "/admin-newsflash/manager-accounts";
                        }, 4500);
                    }
                },
            });
        }, 2000);
    });
});
