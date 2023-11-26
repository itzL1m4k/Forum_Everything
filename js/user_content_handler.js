function getCookie(name) {
  let cookieMatch = document.cookie.match("(^|[^;]+)\\s*" + name + "\\s*=\\s*([^;]+)");
  return cookieMatch ? cookieMatch.pop() : "";
}

const cookieName = getCookie("login_cookie"),
  accountElements = $(".yourAccount, .about-code, .show-new-post, .comment-add"),
  loginNavElements = $(".login-nav"),
  notLoginElements = $(".not-login");

if (cookieName === "") {
  $.ajax({
    url: "./php/check_session.php",
    dataType: "json",
    success: function (response) {
      if (response.login) {
        accountElements.removeClass("hidden");
        loginNavElements.addClass("hidden");
        notLoginElements.addClass("hidden");
      }
    },
    error: function (error) {
      console.log("Błąd podczas sprawdzania sesji:", error);
    },
  });
} else {
  accountElements.removeClass("hidden");
  loginNavElements.addClass("hidden");
  notLoginElements.addClass("hidden");
}
