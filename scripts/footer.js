$(document).ready(function () {
  let authorEl = $("#quote-author");
  let quoteEl = $("#quote-content");
  $.ajax({
    url: "https://api.quotable.io/random",
    method: "GET",
    success: function (response) {
      quoteEl.text(response.content);
      authorEl.text(response.author);
    },
    error: function () {
      quoteEl.text("An error occurred while fetching the quote.");
    },
  });
});
