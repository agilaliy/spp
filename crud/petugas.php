<?php
include "../koneksi.php";

if (isset($_POST['simpan'])) {
    $username = $_POST['username'];
    $pw = md5($_POST['password']);
    $nama_petugas = $_POST['nama_petugas'];
    $level = $_POST['level'];
    $validasi = mysqli_query($koneksi, "SELECT * FROM petugas WHERE username='$username'");

    if (mysqli_num_rows($validasi) > 0) {
        echo "<script>alert('Username Sudah Terdaftar'); location.href='../index.php?page=petugas';</script>";
    } else
        $query = mysqli_query($koneksi, "INSERT INTO petugas (username,password,nama_petugas,level) VALUES('$username','$pw','$nama_petugas','$level')");

    if ($query) {
        echo "<script>alert('Data Berhasil Ditambahkan'); location.href ='../index.php?page=petugas';</script>";
    }
}

if (isset($_POST['edit'])) {
    $id = $_POST['id_petugas'];
    $username = $_POST['username'];
    $pw = md5($_POST['password']);
    $nama_petugas = $_POST['nama_petugas'];
    $level = $_POST['level'];
    $validasi = mysqli_query($koneksi, "SELECT * FROM petugas WHERE id_petugas != '$id' AND username = '$username'");

    if (mysqli_num_rows($validasi) > 0) {
        echo "<script>alert('Username Telah Terdaftar'); location.href='../index.php?page=petugas';</script>";
    } elseif (empty($_POST['password'])) {
        $query = mysqli_query($koneksi, "UPDATE petugas SET username='$username', nama_petugas='$nama_petugas', level='$level' WHERE id_petugas='$id'");
        if ($query) {
            echo "<script>alert('Data Terupdate');location.href ='../index.php?page=petugas';</script>";
        }
    } else {
        $query = mysqli_query($koneksi, "UPDATE petugas SET username='$username',password='$pw', nama_petugas='$nama_petugas', level='$level' WHERE id_petugas='$id'");
        if ($query) {
            echo "<script>alert('Data Terupdate');location.href ='../index.php?page=petugas';</script>";
        }
    }
}

if (isset($_POST['hapus'])) {
    $id = $_POST['id_petugas'];
    $query = mysqli_query($koneksi, "DELETE FROM petugas WHERE id_petugas='$id'");

    if ($query) {
        echo "<script>alert('Data Berhasil Dihapus');location.href ='../index.php?page=petugas';</script>";
    }
}
