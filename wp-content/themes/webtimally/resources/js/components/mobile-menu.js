(function () {
  window.addEventListener("load", function () {
    const mobileMenu = {
      dom: {
        toggle: "#primary-menu-toggle",
      },
      toggleMenu() {
        document.querySelector(this.dom.toggle).classList.toggle("is-open");
      },
      init() {
        document.querySelector(this.dom.toggle).addEventListener("touchend", () => {
          this.toggleMenu();
        });
      },
    };
    mobileMenu.init();
  });
})();
