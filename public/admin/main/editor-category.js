$(function ($) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $(".click-update").click(function (e) {
        e.preventDefault();

        let id = $("input[name='id']").val();
        let category = $("input[name='category']").val();
        $.ajax({
            url: "/admin-newsflash/list-category/editer",
            method: "post",
            dataType: "json",
            data: {
                id,
                category,
            },
            success: function (response) {
                setTimeout(function () {
                    let html = `<div class="alert alert-${response.alert}"><b>${response.mess}</b></div>`;
                    $("#response-mess").html(html);
                    $("#response-mess").fadeIn().delay(1500).fadeOut("slow");
                    if (response.alert == "success") {
                        setTimeout(function () {
                            window.location.href =
                                window.location.origin +
                                "/admin-newsflash/list-category";
                        }, 2000);
                    }
                }, 1000);
            },
        });
    });
});
