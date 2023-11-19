const showNewPostEl = $(".show-new-post"),
  createNewPostEl = $(".create-new-post"),
  postButtonEl = $("#post-button"),
  declineButtonEl = $("#post-button-decline");

const togglePostView = () => {
  showNewPostEl.toggleClass("hidden");
  createNewPostEl.toggleClass("hidden");
};

postButtonEl.on("click", togglePostView);
declineButtonEl.on("click", togglePostView);
