<?php
include "../koneksi.php";

if (isset($_POST['simpan'])) {
    $nama_kelas = $_POST['nama_kelas'];
    $kompetensi_keahlian = $_POST['kompetensi_keahlian'];
    $validasi = mysqli_query($koneksi, "SELECT * FROM kelas WHERE nama_kelas='$nama_kelas' AND kompetensi_keahlian='$kompetensi_keahlian'");

    if (mysqli_num_rows($validasi) > 0) {
        echo "<script>alert('Kelas dan Jurusan Sudah Di Tambahkan Sebelumnya');location.href='../index.php?page=kelas';</script>";
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO kelas (nama_kelas,kompetensi_keahlian) VALUES ('$nama_kelas','$kompetensi_keahlian')");
        echo "<script>alert('Kelas Berhasil Di Tambahkan');location.href='../index.php?page=kelas';</script>";
    }
}

if (isset($_POST['edit'])) {
    $id = $_POST['id_kelas'];
    $nama_kelas = $_POST['nama_kelas'];
    $kompetensi_keahlian = $_POST['kompetensi_keahlian'];
    $validasi = mysqli_query($koneksi, "SELECT * FROM kelas WHERE nama_kelas ='$nama_kelas' AND kompetensi_keahlian ='$kompetensi_keahlian' AND id_kelas !='$id'");

    if (mysqli_num_rows($validasi) > 0) {
        echo "<script>alert('Kelas Dan Jurusan Sudah Di Tambahkan Sebelumnya');location.href='../index.php?page=kelas';</script>";
    } else {
        $query = mysqli_query($koneksi, "UPDATE kelas SET nama_kelas='$nama_kelas', kompetensi_keahlian='$kompetensi_keahlian' WHERE id_kelas ='$id'");

        if ($query) {
            echo "<script>alert('Data Terupdate');location.href ='../index.php?page=kelas';</script>";
        }
    }
}

if (isset($_POST['hapus'])) {
    $id_kelas = $_POST['id_kelas'];
    $query = mysqli_query($koneksi, "DELETE FROM kelas WHERE id_kelas='$id_kelas'");

    if ($query) {
        echo "<script>alert('Data Berhasil Dihapus');location.href ='../index.php?page=kelas';</script>";
    }
}
