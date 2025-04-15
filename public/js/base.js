var userIcon = document.getElementById("user-icon");
var userMenu = document.getElementById("user-menu");
var userSection = document.getElementById("user-section");
var userIconChange = document.getElementById("user-icon-change");
var userIconInput = document.getElementById("user-icon-input");
var csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');

// ユーザーアイコンクリック時
userIcon.addEventListener("click", function () {
    if (userMenu.style.display === "block") {
        userMenu.style.display = "none";
        userIcon.style.border = "none";
    } else {
        userMenu.style.display = "block";
        userIcon.style.border = "3px solid var(--white)";
    }
});

// メニュー外クリックでメニューを閉じる
document.addEventListener("click", function (event) {
    if (!userSection.contains(event.target)) {
        userMenu.style.display = "none";
        userIcon.style.border = "none";
    }
});

// 「アイコン変更」でファイル選択
userIconChange.addEventListener("click", function (e) {
    e.preventDefault();
    userIconInput.click();
});

// // ファイル選択後の処理
// userIconInput.addEventListener("change", function () {
//     var file = this.files[0];
//     if (!file) return;

//     var formData = new FormData();
//     formData.append("icon", file);

//     fetch("/api/user/icon", {
//         method: "POST",
//         headers: {
//             "X-CSRF-TOKEN": csrfTokenMeta.getAttribute("content")
//         },
//         body: formData
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.success && data.icon_url) {
//             userIcon.src = data.icon_url;
//             alert("アイコンを変更しました");
//         } else {
//             alert("アイコンのアップロードに失敗しました");
//         }
//     })
//     .catch(error => {
//         console.error("アップロードエラー:", error);
//         alert("エラーが発生しました");
//     });
// });