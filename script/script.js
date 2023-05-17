// for (let i = 0; i < nomor.length; i++) {
//   nomor[i].innerHTML = i + 1;
//   if ((i + 1) % 2 == 0) {
//     baris[i].style.backgroundColor = "antiquewhite";
//   }
// }

const tombolCari = document.querySelector(".tombol-cari");
const tempatInputKeywordPencarian = document.querySelector(".pencarian");

const table = document.querySelector(".table-wrapper");
const paginasi = document.querySelector(".paginasi");

const tambahBuku = document.querySelector(".tambah");
const tombolBalik = document.querySelector(".back");
tombolCari.style.display = "none";
tempatInputKeywordPencarian.addEventListener("keyup", () => {
  tambahBuku.style.display = "none";
  tombolBalik.style.display = "block";
  paginasi.style.display = "none";

  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      table.innerHTML = xhr.responseText;
      // paginasi.innerHTML = xhr.responseText;
    }
  };
  if (tempatInputKeywordPencarian.value == "") {
    document.location.href = "index.php";
    return false;
  }
  xhr.open("GET", `liveSearch.php?keyword=${tempatInputKeywordPencarian.value}`, true);
  xhr.send();
});
