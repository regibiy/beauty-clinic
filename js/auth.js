$(function () {
  //proses registrasi
  $("#btnRegister").on("click", function () {
    $("#modalRegister").modal("show");
  });

  let spinnerRegister = $("#spinnerRegister");
  spinnerRegister.hide();

  $("#btnRegisterModal").on("click", function (event) {
    event.preventDefault();
    let usernameResponse = $("#usernameRegister").val(),
      namaResponse = $("#namaRegister").val(),
      emailResponse = $("#emailRegister").val(),
      passwordResponse = $("#passwordRegister").val();
    if (usernameResponse.length < 1 || namaResponse.length < 1 || emailResponse.length < 1 || passwordResponse.length < 1) {
      alert("Harap isi semua field data!");
    } else {
      spinnerRegister.show();
      let isUsernameUsed = false,
        isEmailUsed = false;
      $.ajax({
        method: "GET",
        url: "api/ambil-data-user.php",
        dataType: "json",
      })
        .done(function (data) {
          spinnerRegister.hide();
          $.each(data, function (key, value) {
            if (value.username == usernameResponse) {
              alert("Username telah digunakan!");
              isUsernameUsed = true;
              return false;
            }

            if (value.email == emailResponse) {
              alert("Email telah digunakan!");
              isEmailUsed = true;
              return false;
            }
          });

          if (!isUsernameUsed && !isEmailUsed) {
            spinnerRegister.show();
            $.ajax({
              method: "POST",
              url: "api/registrasi-user.php",
              data: { username: usernameResponse, nama: namaResponse, email: emailResponse, password: passwordResponse },
            }).done(function (data) {
              spinnerRegister.hide();
              if (data == 1) alert("Pendaftaran berhasil dilakukan! Silakan Masuk!");
              else alert("Pendaftaran gagal dilakukan!");
              $("#modalRegister").modal("hide");
            });
          }
        })
        .fail(function (data) {
          console.error(data);
        });
    }
  });

  // proses login
  let spinnerLogin = $("#spinnerLogin");
  spinnerLogin.hide();
  $("#buttonLogin").on("click", function (event) {
    event.preventDefault();
    let username = $("#username").val(),
      password = $("#password").val();
    if (username.length < 1 || password.length < 1) {
      alert("Harap isi semua field data!");
    } else {
      spinnerLogin.show();
      $.ajax({
        method: "GET",
        url: "api/ambil-data-spesifik-user.php",
        data: { username: username, password: password },
        dataType: "json",
      })
        .done(function (data) {
          spinnerLogin.hide();
          if (data == 0) {
            alert("Username tidak terdaftar!");
            return false;
          }
          if (data[0].verify == false) alert("Username atau Password salah!");
          else $("#formLogin").submit();
        })
        .fail(function (data) {
          console.error(data);
        });
    }
  });
});
