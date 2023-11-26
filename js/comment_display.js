$(".show-comments").on("click", function () {
  let postId = $(this).data("postId"),
    comments = $(`.comment[data-post-id="${postId}"]`);

  comments.toggleClass("hidden");

  $(this).text(function (index, text) {
    return text === "Pokaż komentarze" ? "Ukryj komentarze" : "Pokaż komentarze";
  });
});
