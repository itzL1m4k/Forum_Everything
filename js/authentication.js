$("#register").click(function () {
  $("#container").addClass("active");
});
$("#login").click(function () {
  $("#container").removeClass("active");
});

var urlParams = new URLSearchParams(window.location.search);
var config = urlParams.get("config");

if (config === "login") {
  $("#container").removeClass("active");
} else if (config === "register") {
  $("#container").addClass("active");
}
