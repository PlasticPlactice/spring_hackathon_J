// ---ページタブ---
document.addEventListener("DOMContentLoaded", function () {
  const tabs = document.querySelectorAll("#page-tab h2");

  tabs.forEach(tab => {
    tab.addEventListener("click", function () {
      tabs.forEach(t => t.classList.remove("active"));
      this.classList.add("active");
    });
  });
});

// ---コメントを削除---
document.querySelector(".comment-delete").addEventListener("click", function() {
  document.querySelector(".delete-menu").style.display = "block";
});

document.querySelector(".confirm-delete").addEventListener("click", function() {
  // コメントを削除する処理（例: 対象のコメントを取得し、removeする）
  document.querySelector(".delete-menu").style.display = "none"; // メニューを非表示にする
});

