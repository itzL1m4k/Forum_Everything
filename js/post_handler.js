function togglePostView() {
  $(".show-new-post").toggleClass("hidden");
  $(".create-new-post").toggleClass("hidden");
}

$("#post-button").on("click", togglePostView);
$("#post-button-decline").on("click", togglePostView);
