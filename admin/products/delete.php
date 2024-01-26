<?php
include_once(__DIR__ . "/../../database/dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];

    // Delete data from kategori table
    $delete_query = "DELETE FROM barang WHERE id=$id";
    if (mysqli_query($mysqli, $delete_query)) {
        header("Location: index.php"); // Redirect to index.php after successful delete
        exit();
    } else {
        echo "Error: " . $delete_query . "<br>" . mysqli_error($mysqli);
    }
}
