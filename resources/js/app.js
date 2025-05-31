import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

  const links = document.querySelectorAll(".nav-link");
  const logo = document.getElementById("page-transition-logo");

  links.forEach(link => {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      const href = this.getAttribute("href");

      logo.classList.remove("hidden");
      logo.classList.add("show");

      setTimeout(() => {
        window.location.href = href;
      }, 800); // مدة الأنيميشن
    });
  });
