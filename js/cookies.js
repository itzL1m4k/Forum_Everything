$(document).ready(function () {
  var $e = $("#cookies"),
    $t = $("#accept");

  if (sessionStorage.getItem("logged") === "true") {
    $e.hide();
  } else {
    $e.show();
  }

  $t.on("click", function () {
    $e.hide();
    sessionStorage.setItem("cookies_accept", "true");
    sessionStorage.setItem("logged", "true");
  });

  if (sessionStorage.getItem("cookies_accept") === "true") {
    $e.hide();
    sessionStorage.setItem("logged", "true");
  }
});
