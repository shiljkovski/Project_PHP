$(document).ready(function () {
  $('input[name="status"]').change(function () {
    let selectedValue = parseInt($('input[name="status"]:checked').val());
    $("#selectedValue").text(selectedValue);

    let statusWrappers = $(".status-wrapper");
    statusWrappers.each((i, wrapper) => {
      if (i == selectedValue) {
        wrapper.classList.remove("d-none");
      } else {
        wrapper.classList.add("d-none");
      }
    });
  });
});
