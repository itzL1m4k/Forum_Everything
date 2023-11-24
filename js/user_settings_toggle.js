$(document).ready(function () {
  const sections = $(".settings > div"),
    userButton = $("#user-button"),
    privacyButton = $("#privacy-button"),
    sectionUser = $(".settings__user"),
    sectionPrivacy = $(".settings__privacy"),
    emailInput = $("#settings-email"),
    nickInput = $("#settings-nick"),
    message = $(".message"),
    changebtn = $("#change-data");

  const showSection = (element) => {
    sections.not(element).addClass("hidden");
    element.removeClass("hidden");
  };

  const changeUserData = () => {
    emailInput.removeAttr("readonly");
    nickInput.removeAttr("readonly");
    message.removeClass("hidden");
  };

  changebtn.on("click", function () {
    changeUserData();
  });

  userButton.on("click", function () {
    showSection(sectionUser);
  });

  privacyButton.on("click", function () {
    showSection(sectionPrivacy);
  });
});
