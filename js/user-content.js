let getCookie = (e) => {
  let match = document.cookie.match("(^|[^;]+)\\s*" + e + "\\s*=\\s*([^;]+)");
  return match ? match.pop() : "";
};

const cookieName = getCookie("login_cookie");
const accountElements = $(".yourAccount, .about-code, .show-new-post, .comment-add");
const loginNavElements = $(".login-nav");
const notLoginElements = $(".not-login");

if ("" === cookieName) {
  $.ajax({
    url: "./php/check-session.php",
    dataType: "json",
    success: function (data) {
      if (!0 === data.login) {
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
