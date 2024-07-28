const image = document.querySelector("img");

image.addEventListener("mouseover", () => {
  image.src = image.dataset.src;
});

// JavaScript
window.addEventListener('resize', adjustArticleHeight);

function adjustArticleHeight() {
    var article = document.querySelector('article');
    var table = document.getElementById('ket-qua-tim-kiem');

    if (article && table) {
        var tableHeight = table.offsetHeight;
        article.style.maxHeight = tableHeight + 'px';
    }
}

// Gọi hàm khi trang được tải và thay đổi kích thước cửa sổ
window.addEventListener('load', adjustArticleHeight);

document.addEventListener("DOMContentLoaded", function () {
  var searchIcon = document.querySelector(".searching");
  var searchInput = document.getElementById("searchInput");

  searchIcon.addEventListener("click", function () {
      searchInput.classList.toggle("visible");
      if (searchInput.classList.contains("visible")) {
          searchInput.focus();
      }
  });

  searchInput.addEventListener("blur", function () {
      searchInput.classList.remove("visible");
  });
});