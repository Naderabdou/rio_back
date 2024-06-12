// Aos
AOS.init();

setTimeout(() => {
  $(".loading").fadeOut(1000);
}, 1000);

window.onload = function () {
  setTimeout(() => {
    $(".header-pages").addClass("active");
  }, 500);
};

lightGallery(document.getElementById("lightgallery"), {
  thumbnail: true,
  selector: ".image-item",
});

$(".btn-all-categories").click((e) => {
  e.preventDefault();
  $(".btn-all-categories").toggleClass("active");
  $(".all-categories").toggleClass("active");
});

$(".remove-cart-header").click(function (e) {
  e.preventDefault();
  $(this).parents("li").fadeOut();
});
$(".delete-cart").click(function (e) {
  e.preventDefault();
  $(this).parents("tr").fadeOut();
});

$(".btn-cart-nav").click((e) => {
  e.preventDefault();
  $(".cart-header").toggleClass("active");
});

$(".close-cart-header").click((e) => {
  e.preventDefault();
  $(".cart-header").removeClass("active");
});


$(".all-categories ul > li > button").click(function (e) {
  e.preventDefault();
  $(this).next().addClass("active");
});
$(".back-categories").click(function (e) {
  e.preventDefault();
  $(this).parents(".show-categories").removeClass("active");
});

$(".text-ask-aboutus ul li h2").click(function (e) {
  e.preventDefault();
  $(this).next().slideToggle(300);
  $(this).parent().toggleClass("active");
});


$(document).ready(function () {
  $(".minus").click(function () {
    var $input = $(this).parent().find("input");
    var count = parseInt($input.val()) - 1;
    count = count < 1 ? 1 : count;
    $input.val(count);
    $input.change();
    return false;
  });
  $(".plus").click(function () {
    var $input = $(this).parent().find("input");
    $input.val(parseInt($input.val()) + 1);
    $input.change();
    return false;
  });
});


// slider detalis
if ($(".slider-main").length) {
  $(".slider-main").slick({
    slidesToShow: 1,
    arrows: false,
    asNavFor: ".slider-nav",
    vertical: true,
    verticalSwiping: true,
    centerMode: true,
  });
}
if ($(".slider-nav").length) {
  $(".slider-nav").slick({
    slidesToShow: 4,
    asNavFor: ".slider-main",
    vertical: true,
    focusOnSelect: true,
    autoplay: true,
    centerMode: true,
  });
}
// start sldier services

if ($("#slider-hero").length) {
  $("#slider-hero").owlCarousel({
    loop: true,
    margin: 0,
    nav: true,
    items: 1,
    autoplayTimeout: 3500,
    autoplayHoverPause: false,
    rtl: true,
    autoplay: true,
    autoplayHoverPause: true,
    dots: false,
    smartSpeed: 700,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
      },
    },
  });
}

if ($("#offers-products").length) {
  $("#offers-products").owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    items: 3,
    autoplayTimeout: 3500,
    autoplayHoverPause: false,
    rtl: true,
    autoplay: false,
    autoplayHoverPause: true,
    dots: false,
    smartSpeed: 700,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 2,
      },

      1000: {
        items: 3,
      },
    },
  });
}

if ($("#categories").length) {
  $("#categories").owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    items: 6,
    autoplayTimeout: 3500,
    autoplayHoverPause: false,
    rtl: true,
    autoplay: false,
    autoplayHoverPause: true,
    dots: false,
    smartSpeed: 700,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        stagePadding: 70,

      },
      450: {
        items: 2,
      },
      600: {
        items: 3,
      },
      768: {
        items: 4,
      },
      992: {
        items: 5,
      },
      1000: {
        items: 6,
      },
    },
  });
}

if ($("#banners").length) {
  $("#banners").owlCarousel({
    loop: true,
    margin: 10,
    nav: false,
    items: 6,
    autoplayTimeout: 3500,
    autoplayHoverPause: false,
    rtl: true,
    autoplay: false,
    autoplayHoverPause: true,
    dots: false,
    smartSpeed: 700,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
      },
      450: {
        items: 1,
      },
      600: {
        items: 2,
      },
    },
  });
}

$(".remove_mune").click(function () {
  $("#menu-div").removeClass("active");
  $(".bg_menu").removeClass("active");
});

function open() {
  $(".navicon").addClass("is-active");
  $("#menu-div").addClass("active");
  $("#times-ican").addClass("active");
  $(".bg_menu").addClass("active");
}

function close() {
  $(".navicon").removeClass("is-active");
  $("#menu-div").removeClass("active");
  $("#times-ican").removeClass("active");
  $(".bg_menu").removeClass("active");
  $(".all-categories").removeClass("active");
  $(".btn-all-categories").removeClass("active");
  $(".show-categories").removeClass("active");

  $(".remove-mune").click(function () {
    $("#menu-div").removeClass("active");
    $(".bg_menu").removeClass("active");
    $(".times-ican").removeClass("active");
  });
}

$("#times-ican").click(function () {
  if ($(this).hasClass("active")) {
    close();
  } else {
    open();
  }
});

$(".btns_menu_responsive").click(function (e) {
  close();
});

$(".remove-mune").click(function () {
  $("#menu-div").removeClass("active");
  $(".bg_menu").removeClass("active");
  $(".times-ican").removeClass("active");
  $(".navicon").removeClass("is-active");
});

$("#menu-div a").click(function () {
  e.preventDefault();
});

var $winl = $(window); // or $box parent container
var $boxl = $("#menu-div, #times-ican ,.btn-all-categories ,  .all-categories");
$winl.on("click.Bst", function (event) {
  if (
    $boxl.has(event.target).length === 0 && //checks if descendants of $box was clicked
    !$boxl.is(event.target) //checks if the $box itself was clicked
  ) {
    close();
  }
});
