$(function () {
  const klinikSatu = $("#klinikSatu");
  const klinikDua = $("#klinikDua");
  const buttonBanding = $("#buttonBanding");

  buttonBanding.on("click", function () {
    if (klinikSatu.val() == 0 || klinikDua.val() == 0) {
      alert("Harap memilih klinik yang akan dibandingkan!");
      return false;
    }

    if (klinikSatu.val() == klinikDua.val()) {
      alert("Tidak dapat membandingkan dua data yang sama!");
      return false;
    }

    window.location = `banding.php?id-satu=${klinikSatu.val()}&id-dua=${klinikDua.val()}#compare`;
  });
});
