<?php
if ($_POST) {
    $judul_buku = $_POST['judul'];
    $deskripsi = $_POST['desc'];
    $pengarang = $_POST['pengarang'];
    $id_buku = $_POST['id_buku'];
    $target_dir = "assets/foto_produk/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));




    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }


    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["foto"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";

        // if everything is ok, try to upload file
    } elseif (empty($judul_buku)) {
        echo "<script>alert('judul buku tidak boleh kosong');location.href='tambahbuku.php';</script>";
    } elseif (empty($deskripsi)) {
        echo "<script>alert('deskripsi tidak boleh kosong');location.href='tambahbuku.php';</script>";
    } elseif (empty($pengarang)) {
        echo "<script>alert('pengarang tidak boleh kosong');location.href='tambahbuku.php';</script>";
    } else {
        include "connect.php";
        $insert = mysqli_query($conn, "insert into buku (id_buku, nama_buku,pengarang, deskripsi, foto) value ('" . $id_buku . "','" . $judul_buku . "','" . $pengarang . "','" . $deskripsi . "','" . $target_file . "')") or die(mysqli_error($conn));
        if ($insert) {
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["foto"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
            echo "<script>alert('Sukses menambahkan Buku');location.href='buku.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan Buku');location.href='buku.php';</script>";
        }
    }
}
