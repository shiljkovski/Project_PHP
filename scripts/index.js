$(document).ready(function () {
  let clickedCategories = {};

  $(".category-btn").click(function () {
    let id = $(this).attr("id");
    var bookCards = $(".book-card");

    clickedCategories[id] = !clickedCategories[id];
    if (clickedCategories[id]) {
      $(this).addClass("bg-success");
      $(this).removeClass("bg-danger");
    } else {
      $(this).addClass("bg-danger");
      $(this).removeClass("bg-success");
    }

    bookCards.each(function () {
      let book = $(this);
      let categoryId = book.data("category-id");
      if (clickedCategories[categoryId]) {
        book.removeClass("d-none");
      } else {
        book.addClass("d-none");
      }
    });

    if (!Object.values(clickedCategories).includes(true)) {
      bookCards.removeClass("d-none");
    }
  });

  $(".book-card").click(function () {
    let bookId = $(this).data("book-id");
    let url = "bookinfo.php?id=" + bookId;
    window.location.href = url;
  });
});
