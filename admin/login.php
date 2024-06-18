<?php
require_once("bootstrap.php");

if (isset($_SESSION["login_admin"])) header("Location: index.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST["username"]);
    $password = $conn->real_escape_string($_POST["password"]);

    $sql = "SELECT * FROM tbl_admin WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows < 1) {
        redirect_alert("Username tidak terdaftar!", "login.php");
        exit();
    } else {
        $data = $result->fetch_assoc();
        if ($data["password"] != $password) {
            redirect_alert("Username atau Password salah!", "login.php");
            exit();
        } else {
            $_SESSION["login_admin"] = true;
            $_SESSION["nama_admin"] = $data["nama"];
            header("Location: index.php");
        }
    }
}


require_once("views/header-login.php");

?>

<div class="d-flex align-items-center min-vh-100">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-12">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat Datang, Admin!</h1>
                                    </div>
                                    <form class="user" method="post" action="" autocomplete="off">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Masuk</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
</body>

</html>