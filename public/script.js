$(document).ready(() => {
  $(".number-format").on("input", function () {
    let value = $(this).val().replace(/[^\d]/g, "");

    if (value !== "") {
      value = parseInt(value);
      value = value.toLocaleString("id-ID");
    }

    $(this).val(value);
  });
});

// delegated event handler
$("#detail-wrapper").on("input", ".number-format", function () {
  let value = $(this).val().replace(/[^\d]/g, "");

  if (value !== "") {
    value = parseInt(value);
    value = value.toLocaleString("id-ID");
  }

  $(this).val(value);
});
