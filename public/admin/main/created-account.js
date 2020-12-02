$(function ($) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $(".created_account").click(function (e) {
        e.preventDefault();

        let username = $("input[name='username']").val();
        let email = $("input[name='email']").val();
        let password = $("input[name='password']").val();
        let role = $(".role").val();

        $.ajax({
            url: "/admin-newsflash/manager-accounts",
            method: "post",
            dataType: "json",
            data: {
                username,
                email,
                password,
                role,
            },
            success: function (response) {
                const { success, errors, error } = response;

                if (errors) {
                    $(".error_username").text(errors.username);
                    $(".error_email").text(errors.email);
                    $(".error_password").text(errors.password);
                    $(".error_role").text(errors.role);
                } else if (success) {
                    let html = `<div class="alert alert-success">${success}</div>`;
                    $(".response-mess").html(html);
                    setTimeout(function () {
                        $("#modal-default").modal("hide");
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    }, 1500);
                } else {
                    let html = `<div class="alert alert-danger">${error}</div>`;
                    $(".response-mess").html(html);
                }
            },
        });
    });
});
