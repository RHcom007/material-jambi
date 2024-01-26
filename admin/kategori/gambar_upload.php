<?php
include_once(__DIR__ . "/../../database/dbconnect.php");

$targetDir = __DIR__ . "\..\../uploads/kategori/"; // Directory where you want to store uploaded images

if (!empty($_FILES["file"]["name"])) {
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allow certain file formats
    $allowedTypes = array("jpg", "jpeg", "png", "gif");
    if (in_array($fileType, $allowedTypes)) {
        // Upload file to server
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            echo "File berhasil diupload.";

            // Insert image file path into kategori table
            $targetFilePath = str_replace('C:\xampp\htdocs\admin\kategori\..\..', '', $targetFilePath);
            var_dump($targetFilePath);
            $insert_query = "INSERT INTO kategori (image_url) VALUES ('$targetFilePath')";
            if (!mysqli_query($mysqli, $insert_query)) {
                echo "Error: " . $insert_query . "<br>" . mysqli_error($mysqli);
            }
        } else {
            echo "Terjadi kesalahan saat mengupload file.";
        }
    } else {
        echo "Format file tidak diizinkan. Hanya file JPG, JPEG, PNG, dan GIF yang diperbolehkan.";
    }
}
