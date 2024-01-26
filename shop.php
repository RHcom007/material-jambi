<?php
include_once(__DIR__ . "/database/dbconnect.php");
$sql = "SELECT * FROM barang WHERE 1";

// Filter by category
if (isset($_GET['category']) && !empty($_GET['category'])) {
    if ($_GET['category'] != 'none') {
        $category = (int)$_GET['category'];
        $sql .= " AND kategori_id = $category";
    }
}

// Search
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($mysqli, $_GET['search']);
    $sql .= " AND (nama_barang LIKE '%$search%' OR deskripsi LIKE '%$search%')";
}

$sql .= " ORDER BY id DESC";
$result = mysqli_query($mysqli, $sql);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);


$result = mysqli_query($mysqli, "SELECT * FROM kategori ORDER BY id DESC");
$kategori = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MultiShop - Online Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <?php include_once(__DIR__ . "/layouts/topbar.php") ?>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <?php include_once(__DIR__ . "/layouts/header.php") ?>
    <!-- Navbar End -->


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shop List</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter Kategori</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" class='' id="kategori-0" name="kategori-filter" value="none" <?php if (!isset($_GET['category']) || $_GET['category'] == 'none') : ?> checked <?php endif ?>>
                            <label class='' for="kategori-0">Tidak ada</label>
                        </div>

                        <?php foreach ($kategori as $row) : ?>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <input type="radio" class='' id="kategori-<?= $row['id'] ?>" name="kategori-filter" value="<?= $row['id'] ?>" <?php if (isset($_GET['category']) && $_GET['category'] == $row['id']) : ?> checked <?php endif ?>>
                                <label class='' for="kategori-<?= $row['id'] ?>"><?= $row['nama_kategori'] ?></label>
                            </div>
                        <?php endforeach; ?>

                    </form>
                </div>
                <!-- Price End -->
            </div>

            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <!-- <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button> -->
                            </div>
                            <div class="ml-2">
                                <!-- <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Latest</a>
                                        <a class="dropdown-item" href="#">Popularity</a>
                                        <a class="dropdown-item" href="#">Best Rating</a>
                                    </div>
                                </div>
                                <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">10</a>
                                        <a class="dropdown-item" href="#">20</a>
                                        <a class="dropdown-item" href="#">30</a>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>

                    <?php foreach ($data as $row) : ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="<?= $row['image_url'] ?>" alt="">
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="/detail.php?id=<?= $row['id'] ?>"><?= $row['nama_barang'] ?></a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5><?= $row['harga'] ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>


                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->


    <!-- Footer Start -->
    <?php include_once(__DIR__ . "/layouts/footer.php") ?>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get all radio buttons with the name "kategori-filter"
            var categoryRadios = document.querySelectorAll('input[name="kategori-filter"]');

            // Add change event listener to each radio button
            categoryRadios.forEach(function(radio) {
                radio.addEventListener('change', function() {
                    // Get the selected category value
                    var selectedCategory = document.querySelector('input[name="kategori-filter"]:checked').value;

                    // Redirect to the desired URL with the selected category
                    window.location.href = "/shop.php?category=" + selectedCategory;
                });
            });
        });
    </script>
</body>

</html>