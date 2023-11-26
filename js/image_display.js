let showImage = (a) => {
  var e = $(a).attr("src");
  $("#enlarged-image").attr("src", e);
  $("#overlay").css("display", "block");
};

let hideImage = () => {
  $("#overlay").css("display", "none");
};
