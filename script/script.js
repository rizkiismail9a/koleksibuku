for (let i = 0; i < nomor.length; i++) {
  nomor[i].innerHTML = i + 1;
  if ((i + 1) % 2 == 0) {
    baris[i].style.backgroundColor = "antiquewhite";
  }
}
