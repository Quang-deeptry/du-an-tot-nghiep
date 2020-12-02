$(function ($) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $(".created_category").click(function (e) {
        e.preventDefault();

        let category_name = $("input[name='category_name']").val();
        $.ajax({
            url: "/admin-newsflash/list-category/create",
            method: "post",
            dataType: "json",
            data: {
                category_name,
            },
            success: function (response) {
                const { success, errors, error } = response;
                if (errors) {
                    let html = `<div class="alert alert-danger">${errors.category_name}</div>`;
                    $(".response-mess").html(html);
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
