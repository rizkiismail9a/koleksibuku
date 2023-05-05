$(document).ready(function () {
  $(".tombol-cari").hide();
  $(".pencarian").on("keyup", () => {
    $(".navigasi").hide();
    $(".cetak").hide();
    $.get("liveSearch.php?keyword=" + $(".pencarian").val(), (data) => {
      if ($(".pencarian").val() === "") {
        document.location.href = "index.php";
      }
      $(".table-wrapper").html(data);
    });
  });
});
