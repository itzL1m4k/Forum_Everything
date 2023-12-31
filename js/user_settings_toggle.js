const sections = $(".settings > div"),
  userButton = $("#user-button"),
  privacyButton = $("#privacy-button"),
  sectionUser = $(".settings__user"),
  sectionPrivacy = $(".settings__privacy"),
  emailInput = $("#settings-email"),
  nickInput = $("#settings-nick"),
  message = $(".message"),
  changebtn = $("#change-data");

function showSection(section) {
  sections.not(section).addClass("hidden");
  section.removeClass("hidden");
}

function changeUserData() {
  emailInput.removeAttr("readonly");
  nickInput.removeAttr("readonly");
  message.removeClass("hidden");
}

changebtn.on("click", function () {
  changeUserData();
});

userButton.on("click", function () {
  showSection(sectionUser);
});

privacyButton.on("click", function () {
  showSection(sectionPrivacy);
});
