

$(function() {
	"use strict";

   $(function () {
       $('[data-bs-toggle="tooltip"]').tooltip();
   });

   $(".nav-toggle-icon").on("click", function () {
       $(".wrapper").toggleClass("toggled");
   });

   $(".mobile-toggle-icon").on("click", function () {
       $(".wrapper").addClass("toggled");
   });

   $(function () {
       for (
           var e = window.location,
               o = $(".sidebar-wrapper .tab-content a")
                   .filter(function () {
                       const cek = e.href.search(this.href)
                       return cek > -1;
                    
                    //   const cek = this.href == e

                    //    return (this.href == e.origin+e.pathname) ||
                    //           (this.href+'/create' == e.origin+e.pathname) ||
                    //           (this.href+'/edit' == e.origin+e.pathname) ||
                    //           (this.href+'/show' == e.origin+e.pathname)
                    //          ;
                   })
                   .addClass("active");
           o.is("a");

       )
           o = o.parent("").parent("").addClass("active show");
       // console.log(o[0].id.toString());
       if (o[0]) {
           var tab = "#" + o[0].id.toString();
           $("[data-bs-target='" + tab + "']").addClass("active");
       }
   });

   $(".toggle-icon").click(function () {
       $(".wrapper").hasClass("toggled")
           ? ($(".wrapper").removeClass("toggled"),
             $(".sidebar-wrapper").unbind("hover"))
           : ($(".wrapper").addClass("toggled"),
             $(".sidebar-wrapper").hover(
                 function () {
                     $(".wrapper").addClass("sidebar-hovered");
                 },
                 function () {
                     $(".wrapper").removeClass("sidebar-hovered");
                 }
             ));
   });

   $(".iconmenu .nav-link").on("click", function () {
       let w = $(window).width();
       //   console.log(w);
       if (w >= 1199) {
           $(".wrapper").removeClass("toggled");
       }
   });

   $(".nav-link").click(function () {
        //  $(".wrapper").hasClass("toggled") && $(".wrapper").removeClass("toggled");
       $('[data-bs-toggle="tooltip"]').tooltip("hide");
       $(this).addClass("active");
   });

   $(".list-group-item").click(function () {
       $(".nav-link").removeClass("active");
   });

   $("a").click(function () {
       $('[data-bs-toggle="tooltip"]').tooltip("hide");
   });
   $("button").click(function () {
       $('[data-bs-toggle="tooltip"]').tooltip("hide");
   });


	// $(".search-toggle-icon").on("click", function() {
	// 	$(".top-header .navbar form").addClass("full-searchbar")
	// })
	// $(".search-close-icon").on("click", function() {
	// 	$(".top-header .navbar form").removeClass("full-searchbar")
	// })


	// $(".chat-toggle-btn").on("click", function() {
	// 	$(".chat-wrapper").toggleClass("chat-toggled")
	// }), $(".chat-toggle-btn-mobile").on("click", function() {
	// 	$(".chat-wrapper").removeClass("chat-toggled")
	// }), $(".email-toggle-btn").on("click", function() {
	// 	$(".email-wrapper").toggleClass("email-toggled")
	// }), $(".email-toggle-btn-mobile").on("click", function() {
	// 	$(".email-wrapper").removeClass("email-toggled")
	// }), $(".compose-mail-btn").on("click", function() {
	// 	$(".compose-mail-popup").show()
	// }), $(".compose-mail-close").on("click", function() {
	// 	$(".compose-mail-popup").hide()
	// })


	// $(document).ready(function() {
	// 	$(window).on("scroll", function() {
	// 		$(this).scrollTop() > 300 ? $(".back-to-top").fadeIn() : $(".back-to-top").fadeOut()
	// 	}), $(".back-to-top").on("click", function() {
	// 		return $("html, body").animate({
	// 			scrollTop: 0
	// 		}, 600), !1
	// 	})
	// })


	// // switcher 

	// $("#LightTheme").on("click", function() {
	// 	$("html").attr("class", "light-theme")
	// }),

	// $("#DarkTheme").on("click", function() {
	// 	$("html").attr("class", "dark-theme")
	// }),

	// $("#SemiDarkTheme").on("click", function() {
	// 	$("html").attr("class", "semi-dark")
	// }),

	// $("#MinimalTheme").on("click", function() {
	// 	$("html").attr("class", "minimal-theme")
	// })


	// $("#headercolor1").on("click", function() {
	// 	$("html").addClass("color-header headercolor1"), $("html").removeClass("headercolor2 headercolor3 headercolor4 headercolor5 headercolor6 headercolor7 headercolor8")
	// }), $("#headercolor2").on("click", function() {
	// 	$("html").addClass("color-header headercolor2"), $("html").removeClass("headercolor1 headercolor3 headercolor4 headercolor5 headercolor6 headercolor7 headercolor8")
	// }), $("#headercolor3").on("click", function() {
	// 	$("html").addClass("color-header headercolor3"), $("html").removeClass("headercolor1 headercolor2 headercolor4 headercolor5 headercolor6 headercolor7 headercolor8")
	// }), $("#headercolor4").on("click", function() {
	// 	$("html").addClass("color-header headercolor4"), $("html").removeClass("headercolor1 headercolor2 headercolor3 headercolor5 headercolor6 headercolor7 headercolor8")
	// }), $("#headercolor5").on("click", function() {
	// 	$("html").addClass("color-header headercolor5"), $("html").removeClass("headercolor1 headercolor2 headercolor4 headercolor3 headercolor6 headercolor7 headercolor8")
	// }), $("#headercolor6").on("click", function() {
	// 	$("html").addClass("color-header headercolor6"), $("html").removeClass("headercolor1 headercolor2 headercolor4 headercolor5 headercolor3 headercolor7 headercolor8")
	// }), $("#headercolor7").on("click", function() {
	// 	$("html").addClass("color-header headercolor7"), $("html").removeClass("headercolor1 headercolor2 headercolor4 headercolor5 headercolor6 headercolor3 headercolor8")
	// }), $("#headercolor8").on("click", function() {
	// 	$("html").addClass("color-header headercolor8"), $("html").removeClass("headercolor1 headercolor2 headercolor4 headercolor5 headercolor6 headercolor7 headercolor3")
	// })


	// new PerfectScrollbar(".header-message-list")
    // new PerfectScrollbar(".header-notifications-list")

	$(document)
	.find("form")
	.submit(function (event) {
			// event.preventDefault();
			console.log(event);
			$(this).find(".submit").prop("disabled", true);
			$(this)
					.find(".submit")
					.html(
							`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
					);
			return true;
	});

	$(document).on("click", ".deleteConfirmation", function () {
        var target = $(this).attr("data-target");
        swal({
            title: "Hapus Data?",
            text: "Silahkan Konfirmasi Untuk Menghapus!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Tidak, Batalkan!",
            reverseButtons: true,
        }).then(
            function (e) {
                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr(
                        "content"
                    );
                    $.ajax({
                        type: "DELETE",
                        url: target,
                        data: {
                            _token: CSRF_TOKEN,
                        },
                        dataType: "JSON",
                        success: function (results) {
                            if (results.success === true) {
                                swal({
                                    title: "Sukses",
                                    text: results.message,
                                    type: "success",
                                }).then(function () {
                                    window.location = "";
                                });
                            } else {
                                swal("Error!", results.message, "error");
                            }
                        },
                    });
                } else {
                    e.dismiss;
                }
            },
            function (dismiss) {
                return false;
            }
        );
    });

    $(document).on("click", ".konfirmasi", function () {
        var target = $(this).attr("data-target");
        var pesan = $(this).attr("data-pesan");
        if (!pesan) {
            pesan = "Anda Yakin Ingin Memverifikasi Data Ini ?";
        }
        swal({
            title: "Konfirmasi",
            text: pesan,
            type: "info",
            showCancelButton: true,
            confirmButtonText: "Ya, Lanjutkan!",
            cancelButtonText: "Tidak, Batalkan!",
            reverseButtons: true,
        }).then(
            function (e) {
                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr(
                        "content"
                    );
                    $.ajax({
                        type: "POST",
                        url: target,
                        data: {
                            _token: CSRF_TOKEN,
                        },
                        dataType: "JSON",
                        success: function (results) {
                            if (results.success === true) {
                                let uri_ = results.uri;
                                let hash = results.hash;
                                swal({
                                    title: "Sukses",
                                    text: results.message,
                                    type: "success",
                                }).then(function () {
                                    console.log(uri_);
                                    window.location = uri_ + hash;
                                    if (hash != "") {
                                        location.reload();
                                    }
                                });
                            } else {
                                swal("Error!", results.message, "error");
                            }
                        },
                    });
                } else {
                    e.dismiss;
                }
            },
            function (dismiss) {
                return false;
            }
        );
    });




});