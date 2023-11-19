$(".show-comments").on("click", function () {
  const postId = $(this).data("postId");
  const comments = $(`.comment[data-post-id="${postId}"]`);

  comments.toggleClass("hidden");

  $(this).text(function (i, text) {
    return text === "Pokaż komentarze" ? "Ukryj komentarze" : "Pokaż komentarze";
  });
});
