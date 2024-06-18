$(function () {
  let selectKecamatan = $("#kecamatan");
  let selectKelurahan = $("#kelurahan");

  // tambah data
  $.ajax({
    method: "GET",
    url: "https://www.emsifa.com/api-wilayah-indonesia/api/districts/6171.json",
    dataType: "json",
  })
    .done(function (data) {
      selectKecamatan.empty();
      let defaultOption = $("<option value='0' selected hidden>Pilih Kecamatan</option>");
      selectKecamatan.append(defaultOption);
      $.each(data, function (key, value) {
        let option = $("<option></option>");
        option.attr("value", `${value.id}-${value.name}`);
        option.text(value.name);
        selectKecamatan.append(option);
      });

      selectKecamatan.on("change", function () {
        let idKecamatan = selectKecamatan.val().split("-");
        selectKelurahan.empty();
        let loadingData = $("<option value='0' selected>Mohon Tunggu! Sedang Memuat Data</option>");
        selectKelurahan.append(loadingData);

        $.ajax({
          method: "GET",
          url: `https://www.emsifa.com/api-wilayah-indonesia/api/villages/${idKecamatan[0]}.json`,
          dataType: "json",
        })
          .done(function (data) {
            selectKelurahan.empty();
            let defaultOption = $("<option value='0' selected hidden>Pilih Kelurahan</option>");
            selectKelurahan.append(defaultOption);
            $.each(data, function (key, value) {
              let option = $("<option></option>");
              option.attr("value", `${value.name}`);
              option.text(value.name);
              selectKelurahan.append(option);
            });
          })
          .fail(function () {
            console.error(`Kesalahan telah terjadi. CEK API WILAYAH! OR ${data}`);
          });
      });
    })
    .fail(function () {
      console.error(`Kesalahan telah terjadi. CEK API WILAYAH! OR ${data}`);
    });

  // edit data
  let editKecamatan = $("#editKecamatan");
  let editKecamatanVal = editKecamatan.val();
  let editKelurahan = $("#editKelurahan");
  let editKelurahanVal = editKelurahan.val();

  $.ajax({
    method: "GET",
    url: "https://www.emsifa.com/api-wilayah-indonesia/api/districts/6171.json",
    dataType: "json",
  })
    .done(function (data) {
      $.each(data, function (key, value) {
        let option = $("<option></option>");
        option.attr("value", `${value.id}-${value.name}`);
        option.text(value.name);
        let splitKecamatan = editKecamatanVal.split("-");
        if (value.name == splitKecamatan[1]) option.attr("selected", true);
        editKecamatan.append(option);
      });

      let idKecamatan = editKecamatan.val().split("-");
      editKelurahan.empty();
      let loadingData = $("<option value='0' selected>Mohon Tunggu! Sedang Memuat Data</option>");
      editKelurahan.append(loadingData);

      $.ajax({
        method: "GET",
        url: `https://www.emsifa.com/api-wilayah-indonesia/api/villages/${idKecamatan[0]}.json`,
        dataType: "json",
      })
        .done(function (data) {
          editKelurahan.empty();
          $.each(data, function (key, value) {
            let option = $("<option></option>");
            option.attr("value", `${value.name}`);
            option.text(value.name);
            if (value.name == editKelurahanVal) option.attr("selected", true);
            editKelurahan.append(option);
          });
        })
        .fail(function () {
          console.error(`Kesalahan telah terjadi. CEK API WILAYAH! OR ${data}`);
        });
    })
    .fail(function (data) {
      console.error(`Kesalahan telah terjadi. CEK API WILAYAH! OR ${data}`);
    });

  editKecamatan.on("change", function () {
    let idKecamatan = editKecamatan.val().split("-");
    editKelurahan.empty();
    let loadingData = $("<option value='0' selected>Mohon Tunggu! Sedang Memuat Data</option>");
    editKelurahan.append(loadingData);

    $.ajax({
      method: "GET",
      url: `https://www.emsifa.com/api-wilayah-indonesia/api/villages/${idKecamatan[0]}.json`,
      dataType: "json",
    })
      .done(function (data) {
        editKelurahan.empty();
        $.each(data, function (key, value) {
          let option = $("<option></option>");
          option.attr("value", `${value.name}`);
          option.text(value.name);
          if (value.name == editKelurahanVal) option.attr("selected", true);
          editKelurahan.append(option);
        });
      })
      .fail(function () {
        console.error(`Kesalahan telah terjadi. CEK API WILAYAH! OR ${data}`);
      });
  });
});
