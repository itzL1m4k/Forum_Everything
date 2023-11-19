$(document).ready(function () {
  const sections = $(".settings > div");
  const userButton = $("#user-button");
  const privacyButton = $("#privacy-button");
  const sectionUser = $(".settings__user");
  const sectionPrivacy = $(".settings__privacy");
  const emailInput = $("#settings-email");
  const nickInput = $("#settings-nick");
  const message = $(".message");
  const changebtn = $("#change-data");

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
