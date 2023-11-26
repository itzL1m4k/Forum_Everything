var $cookies = $("#cookies"),
  $acceptBtn = $("#accept");

if ("true" === sessionStorage.getItem("logged")) {
  $cookies.hide();
} else {
  $cookies.show();
}

$acceptBtn.on("click", function () {
  $cookies.hide();
  sessionStorage.setItem("cookies_accept", "true");
  sessionStorage.setItem("logged", "true");
});

if ("true" === sessionStorage.getItem("cookies_accept")) {
  $cookies.hide();
  sessionStorage.setItem("logged", "true");
}
