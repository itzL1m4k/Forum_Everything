function scrollToTop() {
  var currentScroll = window.scrollY,
    targetScroll = 0 - currentScroll,
    animationFrame = null;

  let scrollAnimation = (timestamp) => {
    animationFrame || (animationFrame = timestamp);
    var progress = timestamp - animationFrame,
      newPosition = easeInOutQuad(progress, currentScroll, targetScroll, 500);

    window.scrollTo(0, newPosition);

    if (progress < 500) {
      window.requestAnimationFrame(scrollAnimation);
    }
  };

  window.requestAnimationFrame(scrollAnimation);
}

$(window).scroll(function () {
  var $toTopBtn = $("#to-top-btn");
  window.scrollY > 20 ? $toTopBtn.css("display", "block") : $toTopBtn.css("display", "none");
});

$(".scroll-link").click(function (e) {
  e.preventDefault();
  var targetOffset = $(this.getAttribute("href")).offset().top;
  smoothScrollTo(targetOffset);
});

function smoothScrollTo(targetOffset) {
  var currentScroll = window.scrollY,
    scrollDifference = targetOffset - currentScroll,
    animationFrame = null;

  function scrollAnimation() {
    animationFrame || (animationFrame = timestamp);
    var progress = timestamp - animationFrame,
      newPosition = easeInOutQuad(progress, currentScroll, scrollDifference, 500);

    window.scrollTo(0, newPosition);

    if (progress < 500) {
      window.requestAnimationFrame(scrollAnimation);
    }
  }
  window.requestAnimationFrame(scrollAnimation);
}

function easeInOutQuad() {
  return (progress /= duration / 2) < 1
    ? (change / 2) * progress * progress + current
    : (-change / 2) * (--progress * (progress - 2) - 1) + current;
}
