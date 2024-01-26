<?php
session_start();
include_once(__DIR__ . "/../../database/dbconnect.php");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: /index.php");
  exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user data
$result = mysqli_query($mysqli, "SELECT * FROM users WHERE id='$user_id'");

if ($result) {
  $user = mysqli_fetch_assoc($result);

  // Check the user's role
  if ($user['role'] != 1) {
    header("Location: /index.php");
    exit();
  }
} else {
  // Handle the case where the query fails
  // You might want to log an error or redirect to an error page
  echo "Error fetching user data.";
  exit();
}
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">MJ</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="/admin/dashboard" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/products" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Produk
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/kategori" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Kategori
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>