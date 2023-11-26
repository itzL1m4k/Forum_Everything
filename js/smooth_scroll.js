let scrollToTop = () => {
  var currentScroll = window.scrollY,
    targetScroll = 0 - currentScroll,
    startTime = null;

  let animateScroll = (timestamp) => {
    startTime || (startTime = timestamp);
    var elapsedTime = timestamp - startTime,
      nextScroll = easeInOutQuad(elapsedTime, currentScroll, targetScroll, 500);

    window.scrollTo(0, nextScroll);

    if (elapsedTime < 500) {
      window.requestAnimationFrame(animateScroll);
    }
  };

  window.requestAnimationFrame(animateScroll);
};

$(window).scroll(function () {
  var toTopButton = $("#to-top-btn");
  window.scrollY > 20 ? toTopButton.css("display", "block") : toTopButton.css("display", "none");
});

$(".scroll-link").click(function (event) {
  event.preventDefault();
  smoothScrollTo($($(this).attr("href")).offset().top);
});

let smoothScrollTo = (targetScroll) => {
  var currentScroll = window.scrollY,
    scrollDifference = targetScroll - currentScroll,
    startTime = null;

  let animateScroll = (timestamp) => {
    startTime || (startTime = timestamp);
    var elapsedTime = timestamp - startTime,
      nextScroll = easeInOutQuad(elapsedTime, currentScroll, scrollDifference, 500);

    window.scrollTo(0, nextScroll);

    if (elapsedTime < 500) {
      window.requestAnimationFrame(animateScroll);
    }
  };

  window.requestAnimationFrame(animateScroll);
};

let easeInOutQuad = (time, start, change, duration) =>
  (time /= duration / 2) < 1
    ? (change / 2) * time * time + start
    : (-change / 2) * (--time * (time - 2) - 1) + start;
