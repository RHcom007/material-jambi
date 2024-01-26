<?php
include_once(__DIR__ . "/../../database/dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nama_barang = $_POST["nama_barang"];
    $harga = $_POST["harga"];
    $deskripsi_singkat = $_POST["deskripsi_singkat"];
    $kategori_id = $_POST["kategori_id"];

    // Validate input
    if (empty($nama_barang) || empty($harga) || empty($deskripsi_singkat) || empty($kategori_id)) {
        echo "Semua kolom harus diisi.";
    } else {
        // Update data in barang table
        $update_query = "UPDATE barang SET nama_barang='$nama_barang', harga='$harga', deskripsi_singkat='$deskripsi_singkat', kategori_id='$kategori_id' WHERE id=$id";

        if (mysqli_query($mysqli, $update_query)) {
            header("Location: index.php"); // Redirect to index.php after successful update
            exit();
        } else {
            echo "Error: " . $update_query . "<br>" . mysqli_error($mysqli);
        }
    }
} else {
    // Display the form for editing
    $id = $_GET["id"];
    $result = mysqli_query($mysqli, "SELECT * FROM barang WHERE id=$id");
    $barang = mysqli_fetch_assoc($result);
    $result1 = mysqli_query($mysqli, "SELECT * FROM kategori");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <?php include __DIR__ . '/../layouts/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include __DIR__ . '/../layouts/sidebar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v1</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Form Edit Barang</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method='post' action='edit.php?id=<?php echo $id; ?>'>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="namabarang">Nama Barang</label>
                                            <input type="text" class="form-control" id="namabarang" placeholder="Masukkan nama barang" name="nama_barang" value="<?= $barang['nama_barang'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="harga">Harga Barang</label>
                                            <input type="text" class="form-control" id="harga" placeholder="Masukkan Harga" name='harga' value="<?= $barang['harga'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="deskripsisingkat">Deskripsi Singkat</label>
                                            <input type="text" class="form-control" id="deskripsisingkat" placeholder="Masukkan Deskripsi Singkat" name='deskripsi_singkat' value="<?= $barang['deskripsi_singkat'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleSelectBorder">Kategori</label>
                                            <select class="custom-select form-control-border" id="exampleSelectBorder" name='kategori_id'>
                                                <?php while ($row = mysqli_fetch_assoc($result1)) : ?>
                                                    <option value='<?= $row['id'] ?>' <?php if ($row['id'] == $barang['kategori_id']) echo 'selected'; ?>>
                                                        <?= $row['nama_kategori'] ?>
                                                    </option>
                                                <?php endwhile ?>
                                            </select>
                                        </div>
                                        <input type="hidden" name="id" value="<?= $id ?>">
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include __DIR__ . '/../layouts/footer.php'; ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>
</body>

</html>