let showImage = (e) => {
  var src = $(e).attr("src");
  $("#enlarged-image").attr("src", src);
  $("#overlay").css("display", "block");
};

let hideImage = () => {
  $("#overlay").css("display", "none");
};
