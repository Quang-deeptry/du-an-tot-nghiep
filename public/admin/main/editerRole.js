$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(".click-update").click(function (e) {
        e.preventDefault();

        let name = $("input[name='name']").val();
        let id = $("input[name='id']").val();

        setTimeout(function () {
            $.ajax({
                url: "/admin-newsflash/change-roles/update",
                method: "post",
                dataType: "json",
                data: {
                    id,
                    name,
                },
                success: function (response) {
                    let html = `<div class="alert alert-${response.alert}"><b>${response.mess}</b></div>`;
                    $("#response-mess").html(html);
                    $("#response-mess").fadeIn().delay(2000).fadeOut("slow");
                    if (response.alert == "success") {
                        setTimeout(function () {
                            window.location.href =
                                window.location.origin +
                                "/admin-newsflash/change-roles";
                        }, 4500);
                    }
                },
            });
        }, 2000);
    });
});
