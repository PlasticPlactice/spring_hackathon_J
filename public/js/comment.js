// ---投稿ボタンの色変化---
document.getElementById("comment-input").addEventListener("input", function() {
    const commentInput = document.getElementById("comment-input");
    const sendButton = document.querySelector(".send-button");

    if (commentInput.value.trim() !== "") {
        sendButton.style.color = "var(--main-color)";
        sendButton.style.cursor = "pointer";
        sendButton.classList.add("active");
    } else {
        sendButton.style.color = "var(--light-gray)";
        sendButton.style.cursor = "default";
        sendButton.classList.remove("active");
    }
});
