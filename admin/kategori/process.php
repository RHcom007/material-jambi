<?php
include_once(__DIR__ . "/../../database/dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_kategori = $_POST["nama"];

    // Validate input
    if (empty($nama_kategori)) {
        echo "Nama barang harus diisi";
    } else {
        //Insert data into kategori table
        $insert_query = "UPDATE kategori SET nama_kategori='$nama_kategori' WHERE id = (SELECT MAX(id) FROM kategori)";
        if (mysqli_query($mysqli, $insert_query)) {
            header("Location: index.php");
            echo "Data berhasil ditambahkan.";
        } else {
            echo "Error: " . $insert_query . "<br>" . mysqli_error($mysqli);
        }
    }
}
