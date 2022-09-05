<?php
include "header.php"
?>

<form action="proses_tambah_buku.php" method="post" enctype="multipart/form-data">
    Judul buku :
    <input type="text" name="judul" value="" class="form-control">
    Deskripsi singkat :
    <input type="text" name="desc" value="" class="form-control">
    Pengarang :
    <input type="text" name="pengarang" value="" class="form-control">
    id_buku :
    <input type="number" name="id_buku" value="" class="form-control">
    Sampul:
    <input type="file" name="foto" value="" accept="image/*" class="form-control">
    <input type="submit" value="Upload Image" name="submit">
</form>