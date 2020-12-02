// var pageNumber = 2;

// $(document).ready(function () {
//     $.ajax({
//         type: "GET",
//         url: "/admin-newsflash/trang-chu?page=" + pageNumber,
//         success: function (data) {
//             pageNumber += 1;
//             if (data.length == 0) {
//             } else {
//                 $(".users-list").append(data.html);
//             }
//         },
//         error: function (data) {},
//     });
// });

// $(window).scroll(function () {
//     if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
//         $.ajax({
//             type: "GET",
//             url: "/admin-newsflash/trang-chu?page=" + pageNumber,
//             success: function (data) {
//                 pageNumber += 1;
//                 if (data.length == 0) {
//                 } else {
//                     $(".users-list").append(data.html);
//                 }
//             },
//             error: function (data) {},
//         });
//     }
// });

// function loadMoreUsers() {
//     $.ajax({
//         type: "GET",
//         url: "/admin-newsflash/trang-chu?page=" + pageNumber,
//         success: function (data) {
//             pageNumber += 1;
//             if (data.length == 0) {
//                 // :( no more articles
//             } else {
//                 $(".users-list").append(data.html);
//             }
//         },
//         error: function (data) {},
//     });
// }
