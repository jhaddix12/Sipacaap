jQuery("document").ready(function ($) {
  var menuBtn = $("nav .menu-icon"),
    menu = $(".nav__list");

  menuBtn.click(function () {
    if (menu.hasClass("show")) {
      menu.removeClass("show");
    } else {
      menu.addClass("show");
    }
  });
});
function viewMore() {
  var button = document.getElementById("button1");
  var article = document.getElementById("article1");
  var ver = document.getElementById("view1");
  ver.style.display = "block";
  button.style.display = "none";
  article.style.height = "536.37px";
}

function viewLess() {
  var button = document.getElementById("button1");
  var article = document.getElementById("article1");
  var ver = document.getElementById("view1");
  ver.style.display = "none";
  button.style.display = "block";
  article.removeAttribute("style");
}

function concatenate( proyectoFoto) {
  var val;
  val = "uploads/fotos/"+ proyectoFoto;
  return val;
}
