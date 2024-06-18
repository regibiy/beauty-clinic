/*!
 * Start Bootstrap - Scrolling Nav v5.0.6 (https://startbootstrap.com/template/scrolling-nav)
 * Copyright 2013-2023 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-scrolling-nav/blob/master/LICENSE)
 */
//
// Scripts
//

window.addEventListener("DOMContentLoaded", (event) => {
  // Activate Bootstrap scrollspy on the main nav element
  const mainNav = document.body.querySelector("#mainNav");
  if (mainNav) {
    new bootstrap.ScrollSpy(document.body, {
      target: "#mainNav",
      rootMargin: "0px 0px -40%",
    });
  }

  // Collapse responsive navbar when toggler is visible
  const navbarToggler = document.body.querySelector(".navbar-toggler");
  const responsiveNavItems = [].slice.call(document.querySelectorAll("#navbarResponsive .nav-link"));
  responsiveNavItems.map(function (responsiveNavItem) {
    responsiveNavItem.addEventListener("click", () => {
      if (window.getComputedStyle(navbarToggler).display !== "none") {
        navbarToggler.click();
      }
    });
  });
});

$(function () {
  const showPassword = $("#showPassword"),
    inputPassword = $("#password"),
    showPasswordRegister = $("#showPasswordRegister"),
    inputPasswordRegister = $("#passwordRegister");

  showPassword.on("click", function () {
    if (inputPassword.attr("type") === "password") inputPassword.attr("type", "text");
    else inputPassword.attr("type", "password");
  });

  showPasswordRegister.on("click", function () {
    if (inputPasswordRegister.attr("type") === "password") inputPasswordRegister.attr("type", "text");
    else inputPasswordRegister.attr("type", "password");
  });
});
