document.addEventListener("DOMContentLoaded", function () {
    const tabs = document.querySelectorAll("#page-tab h2");
  
    tabs.forEach(tab => {
      tab.addEventListener("click", function () {
        tabs.forEach(t => t.classList.remove("active"));
        this.classList.add("active");
      });
    });
  });