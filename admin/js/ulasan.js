$(function () {
  //olah ulasan diterima
  $(document).on("click", "#approveUlasan", function () {
    const nama = $(this).data("nama");
    let userResponse = confirm(`Setujui ulasan dari ${nama}?`);
    if (userResponse) {
      const id = $(this).data("id");
      $.ajax({
        method: "POST",
        url: "../api/ulasan-diterima.php",
        data: { id: id },
      })
        .done(function (data) {
          if (data == "1") {
            alert("Ulasan berhasil disetujui!");
            window.location = "ulasan.php";
          } else {
            alert("Ulasan gagal disetujui!");
            window.location = "ulasan.php";
          }
        })
        .fail(function (data) {
          console.error(data);
        });
    }
  });

  //olah ulasan ditolak
  $(document).on("click", "#rejectUlasan", function () {
    const nama = $(this).data("nama");
    let userResponse = confirm(`Tolak ulasan dari ${nama}?`);
    if (userResponse) {
      const id = $(this).data("id");
      $.ajax({
        method: "POST",
        url: "../api/ulasan-ditolak.php",
        data: { id: id },
      })
        .done(function (data) {
          if (data == "1") {
            alert("Ulasan berhasil ditolak!");
            window.location = "ulasan.php";
          } else {
            alert("Ulasan gagal ditolak!");
            window.location = "ulasan.php";
          }
        })
        .fail(function (data) {
          console.error(data);
        });
    }
  });
});
