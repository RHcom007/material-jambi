<?php
include_once(__DIR__ . "/../../database/dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_barang = $_POST["nama_barang"];
    $harga = $_POST["harga"];
    $deskripsi_singkat = $_POST["deskripsi_singkat"];
    $kategori_id = $_POST["kategori_id"]; // Assuming this is the correct field name from the select element

    // Validate input (you may want to add more validation based on your requirements)
    if (empty($nama_barang) || empty($harga) || empty($deskripsi_singkat) || empty($kategori_id)) {
        echo "Semua kolom harus diisi.";
    } else {
        // Update the newly inserted row
        $update_query = "UPDATE barang SET nama_barang='$nama_barang', harga='$harga', deskripsi_singkat='$deskripsi_singkat', kategori_id='$kategori_id' WHERE id = (SELECT MAX(id) FROM barang)";
        if (mysqli_query($mysqli, $update_query)) {
            header("Location: index.php"); // Redirect to index.php after successful delete
            echo "Data barang berhasil diupdate.";
        } else {
            echo "Error: " . $update_query . "<br>" . mysqli_error($mysqli);
        }
    }
}
