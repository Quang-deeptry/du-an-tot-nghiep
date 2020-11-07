$(function ($) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    var count_1 = $("#count_comment-1").text();
    var count_2 = $("#count_comment-1").text();
    $("#button-sendMess").on("click", function (e) {
        e.preventDefault();
        count_1++;
        count_2++;
        $("#button-sendMess").hide();
        $("#button-loading").show();
        let post_id = $("#post_id").text();
        let message = $("#message").val();
        setTimeout(function () {
            $.ajax({
                url: "/posts/post-detail/send-message",
                type: "POST",
                data: { post_id, message },
                cache: false,
                dataType: "json",
                success: function () {
                    loadComments();
                },
            });
        }, 1000);
    });

    loadComments();

    function loadComments() {
        let post_id = $("#post_id").text();
        $.ajax({
            url: "/posts/getcomments?id=" + post_id,
            method: "GET",
            dataType: "json",
            success: function (response) {
                const { data, count } = response;
                let dataHtml = "";
                for (let item of data) {
                    dataHtml += `
                    <li>
                        <div class="media media-none-xs">
                            <img src="${window.location.origin}/clients/img/blog1.jpg" class="img-fluid rounded-circle"
                                alt="comments">
                            <div class="media-body comments-content media-margin30">
                                <h3 class="title-semibold-dark">
                                    <a href="${window.location.protocol}//${window.location.host}/auth-posts/${item.user.username}">${item.user.username} ,
                                    </a>
                                    <span>${item.created_at}</span>
                                </h3>
                                <p>${item.comment}</p>
                            </div>
                        </div>
                    </li>
                    `;
                }
                $("#res-comments").html(dataHtml);
                $("#button-sendMess").show();
                $("#button-loading").hide();

                $(".count_comment").text(count);
            },
        });
    }
});

// fa-comments smooth scroll
$("a").click(function () {
    $("html, body").animate(
        {
            scrollTop: $($(this).attr("href")).offset().top,
        },
        500
    );
    return false;
});
