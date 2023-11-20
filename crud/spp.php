<?php
include "../koneksi.php";

if (isset($_POST['simpan'])) {
    $tahun = $_POST['tahun'];
    $nominal = $_POST['nominal'];
    $validasi = mysqli_query($koneksi, "SELECT * FROM spp WHERE tahun='$tahun'");

    if (mysqli_num_rows($validasi) > 0) {
        echo "<script>alert('Tahun Telah Terpakai'); location.href='../index.php?page=spp';</script>";
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO spp (tahun,nominal) VALUES('$tahun','$nominal')");
        if ($query) {
            echo "<script>alert('Data Berhasil Ditambahkan'); location.href ='../index.php?page=spp';</script>";
        }
    }
}

if (isset($_POST['edit'])) {
    $id = $_POST['id_spp'];
    $tahun = $_POST['tahun'];
    $nominal = $_POST['nominal'];
    $validasi = mysqli_query($koneksi, "SELECT * FROM spp WHERE tahun = '$tahun' AND id_spp != '$id'");

    if (mysqli_num_rows($validasi) > 0) {
        echo "<script>alert('Tahun Telah Terpakai'); location.href='../index.php?page=spp';</script>";
    } else {
        $query = mysqli_query($koneksi, "UPDATE spp SET tahun='$tahun', nominal='$nominal' WHERE id_spp='$id'");

        if ($query) {
            echo "<script>alert('Data Terupdate');location.href ='../index.php?page=spp';</script>";
        }
    }
}

if (isset($_POST['hapus'])) {
    $id_spp = $_POST['id_spp'];
    $query = mysqli_query($koneksi, "DELETE FROM spp WHERE id_spp='$id_spp'");

    if ($query) {
        echo "<script>alert('Data Berhasil Dihapus');location.href ='../index.php?page=spp';</script>";
    }
}
