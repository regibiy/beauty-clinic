<?php
require_once("bootstrap.php");

if (!isset($_SESSION["login_admin"])) header("Location: login.php");

$data = [
  "title" => "Dashboard",
  "dashboard" => "active",
  "data_klinik" => null,
  "data_ulasan" => null,
  "detail_klinik" => null,
  "jam_operasional" => null,
  "sosmed" => null,
  "treatment" => null,
];

$sql = "SELECT COUNT(id) AS total_klinik FROM tbl_klinik";
$result = $conn->query($sql);
$total_klinik = $result->fetch_assoc();

$sql = "SELECT COUNT(id) AS total_pengguna FROM tbl_user";
$result = $conn->query($sql);
$total_pengguna = $result->fetch_assoc();

$sql = "SELECT COUNT(id) AS total_ulasan FROM tbl_ulasan";
$result = $conn->query($sql);
$total_ulasan = $result->fetch_assoc();

$sql = "SELECT COUNT(id) AS total_admin FROM tbl_admin";
$result = $conn->query($sql);
$total_admin = $result->fetch_assoc();

require_once("views/header.php");
?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <!-- Content Row -->
  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Klinik Kecantikan</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_klinik["total_klinik"] ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-table fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Akun Pengguna</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pengguna['total_pengguna'] ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Ulasan</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $total_ulasan["total_ulasan"] ?></div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Admin</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_admin["total_admin"] ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-table fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php
require_once("views/footer.php");
?>