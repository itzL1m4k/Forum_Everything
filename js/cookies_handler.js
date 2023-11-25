var $cookies = $("#cookies");
var $acceptBtn = $("#accept");

sessionStorage.getItem("logged") === "true" ? $cookies.hide() : $cookies.show();

$acceptBtn.on("click", function () {
  $cookies.hide();
  sessionStorage.setItem("cookies_accept", "true");
  sessionStorage.setItem("logged", "true");
});

if (sessionStorage.getItem("cookies_accept") === "true") {
  $cookies.hide();
  sessionStorage.setItem("logged", "true");
}
