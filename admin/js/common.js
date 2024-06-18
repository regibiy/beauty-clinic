function validasiForm() {
  let selectKecamatan = $("#kecamatan");
  let selectKelurahan = $("#kelurahan");
  if (selectKecamatan.val() == "0" || selectKelurahan.val() == "0") {
    alert("Silakan pilih data Kecamatan dan Kelurahan!");
    return false;
  }
  return true;
}

function validasiFormJamOp() {
  let selectKlinik = $("#nama");
  if (selectKlinik.val() == 0) {
    alert("Silakan pilih data Klinik!");
    return false;
  }
  return true;
}

$(function () {
  //olah data klinik
  $(document).on("click", "#viewImage", function () {
    const gambar = $(this).data("gambar");
    let nama = $("#viewImage").attr("data-nama");
    $("#imgTag").attr("src", `../assets/uploaded-file/${gambar}`);
    $("#viewImageModal").modal("show");
    $("#viewImageModalLabel").text(`Gambar ${nama}`);
  });

  $(document).on("click", "#deleteData", function () {
    const nama = $(this).data("nama");
    let userResponse = confirm(`Apakah Anda yakin akan menghapus data ${nama}?`);
    const id = $(this).data("id");
    const gambar = $(this).data("gambar");
    if (userResponse) {
      $.ajax({
        method: "POST",
        url: "../api/hapus-klinik.php",
        data: { id: id, gambar: gambar },
      })
        .done(function (data) {
          if (data == "1") {
            alert("Data Klinik berhasil dihapus!");
            window.location = "klinik.php";
          } else {
            alert("Data Klinik gagal dihapus!");
          }
        })
        .fail(function (data) {
          console.error(data);
        });
    }
  });

  // olah data jam operasional
  const checkTutup = $("#keterangan");
  checkTutup.on("click", function () {
    if (checkTutup.is(":checked")) {
      $("#jamBuka").attr("disabled", true);
      $("#jamTutup").attr("disabled", true);
      checkTutup.attr("value", "Tutup");
    } else {
      $("#jamBuka").attr("disabled", false);
      $("#jamTutup").attr("disabled", false);
      checkTutup.attr("value", "Buka");
    }
  });

  $(document).on("click", "#deleteDataJamOp", function () {
    const nama = $(this).data("nama");
    let userResponse = confirm(`Apakah Anda yakin akan menghapus data Jam Operasional ${nama}?`);
    const id = $(this).data("id");
    if (userResponse) {
      $.ajax({
        method: "POST",
        url: "../api/hapus-jam-op.php",
        data: { id: id },
      })
        .done(function (data) {
          if (data == "1") {
            alert("Data Jam Operasional berhasil dihapus!");
            window.location = "jam-operasional.php";
          } else {
            alert("Data Jam Operasional gagal dihapus!");
          }
        })
        .fail(function (data) {
          console.error(data);
        });
    }
  });

  //olah data sosmed
  $(document).on("click", "#deleteDataSosmed", function () {
    const namaSosmed = $(this).data("nama-sosmed");
    const namaklinik = $(this).data("nama-klinik");

    let userResponse = confirm(`Apakah Anda yakin akan menghapus data Media Sosial ${namaSosmed} dari ${namaklinik}?`);
    const id = $(this).data("id");
    if (userResponse) {
      $.ajax({
        method: "POST",
        url: "../api/hapus-sosmed.php",
        data: { id: id },
      })
        .done(function (data) {
          if (data == "1") {
            alert("Data Sosial Media berhasil dihapus!");
            window.location = "sosmed.php";
          } else {
            alert("Data Sosial Media gagal dihapus!");
          }
        })
        .fail(function (data) {
          console.error(data);
        });
    }
  });

  //olah data treatment
  $(document).on("click", "#deleteDataTreatment", function () {
    const namaTreatment = $(this).data("nama-treatment");
    const namaklinik = $(this).data("nama-klinik");

    let userResponse = confirm(`Apakah Anda yakin akan menghapus data Treatment ${namaTreatment} dari ${namaklinik}?`);
    const id = $(this).data("id");
    if (userResponse) {
      $.ajax({
        method: "POST",
        url: "../api/hapus-treatment.php",
        data: { id: id },
      })
        .done(function (data) {
          if (data == "1") {
            alert("Data Treatment berhasil dihapus!");
            window.location = "treatment.php";
          } else {
            alert("Data Treatment gagal dihapus!");
          }
        })
        .fail(function (data) {
          console.error(data);
        });
    }
  });
});
