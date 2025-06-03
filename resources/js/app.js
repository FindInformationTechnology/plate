import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const links = document.querySelectorAll(".nav-link:not([data-bs-toggle])");
const logo = document.getElementById("page-transition-logo");

links.forEach(link => {
  link.addEventListener("click", function (e) {
    // Only apply to links with actual URLs, not javascript:void(0)
    if (this.getAttribute("href") && !this.getAttribute("href").includes("javascript:")) {
      e.preventDefault();
      const href = this.getAttribute("href");

      logo.classList.remove("hidden");
      logo.classList.add("show");

      setTimeout(() => {
        window.location.href = href;
      }, 800);
    }
  });
});
