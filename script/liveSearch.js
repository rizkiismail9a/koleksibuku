$(document).ready(() => {
  $(".tombol-cari").hide();
  $(".pencarian").on("keyup", () => {
    $(".navigasi").hide();
    $.get("liveSearch.php?keyword=" + $(".pencarian").val(), (data) => {
      if ($(".pencarian").val() === "") {
        document.location.href = "index.php";
      }
      $(".table-wrapper").html(data);
    });
  });
});
