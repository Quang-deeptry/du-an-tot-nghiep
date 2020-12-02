$(function ($) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $("#delete_post").on("click", function (e) {
        if (confirm("Bạn có muốn xóa mục đã chọn?")) {
            $(this).prop("disabled", true);
            var checkeds = $("input:checkbox:checked")
                .map(function () {
                    return $(this).val();
                })
                .get();
            if (checkeds[0] == "on") {
                checkeds.shift();
            }

            $.ajax({
                url: "/admin-newsflash/auth-posts-unapproval/deletes-checked",
                type: "POST",
                dataType: "json",
                data: { checkeds: JSON.stringify(checkeds) },
                success: function (response) {
                    const { error, success } = response;
                    setTimeout(() => {
                        if (success) {
                            let html = `<div class="alert alert-success col-md-4">${success}</div>`;
                            $(".response_remove").html(html);

                            setTimeout(() => {
                                $(".response_remove")
                                    .delay(1000)
                                    .fadeOut("slow");

                                setTimeout(() => {
                                    window.location.reload();
                                }, 2300);
                            }, 700);
                        } else {
                            let html = `<div class="alert alert-danger col-md-4">${error}</div>`;
                            $(".response_remove").append(html);

                            setTimeout(() => {
                                $(".response_remove")
                                    .delay(1000)
                                    .fadeOut("slow");
                            }, 700);

                            setTimeout(() => {
                                window.location.reload();
                            }, 2300);
                        }

                        $("#delete_post").attr("disabled", false);
                    }, 2000);
                },
            });
        }
    });
});
