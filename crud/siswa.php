<?php
include "../koneksi.php";

if (isset($_POST['simpan'])) {
    $nisn = $_POST['nisn'];
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $id_kelas = $_POST['id_kelas'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    $pw = md5($_POST['password']);
    $validasi = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisn='$nisn'");
    $validasi2 = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis'");

    if (mysqli_num_rows($validasi) > 0 && mysqli_num_rows($validasi2) > 0) {
        echo "<script>alert('NISN dan NIS Telah Terdaftar Sebelumnya. Harap Masukkan Ulang'); location.href ='../index.php?page=siswa';</script>";
    } elseif (mysqli_num_rows($validasi) > 0) {
        echo "<script>alert('NISN Telah Terdaftar Sebelumnya. Harap Masukkan Ulang'); location.href ='../index.php?page=siswa';</script>";
    } elseif (mysqli_num_rows($validasi2) > 0) {
        echo "<script>alert('NIS Telah Terdaftar Sebelumnya. Harap Masukkan Ulang'); location.href ='../index.php?page=siswa';</script>";
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO siswa (nisn,nis,nama,id_kelas,alamat,no_telp,password)
     VALUES('$nisn','$nis','$nama' ,'$id_kelas','$alamat','$no_telp','$pw')");

        if ($query) {
            echo "<script>alert('Data Berhasil Ditambahkan'); location.href ='../index.php?page=siswa';</script>";
        }
    }
}
if (isset($_POST['edit'])) {
    $oldnisn = $_POST['oldnisn'];
    $nisn = $_POST['nisn'];
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $id_kelas = $_POST['id_kelas'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    $pw = md5($_POST['password']);
    $validasi1 = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisn='$nisn' AND nisn != '$oldnisn'");
    $validasi2 = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis' AND nisn != '$oldnisn'");

    if (mysqli_num_rows($validasi1) > 0 && mysqli_num_rows($validasi2) > 0) {
        echo "<script>alert('NISN dan NIS Sudah Di Pakai Oleh Siswa Lain'); location.href='../index.php?page=siswa';</script>";
    } elseif ((mysqli_num_rows($validasi1) > 0)) {
        echo "<script>alert('NISN Sudah Di Pakai Oleh Siswa Lain'); location.href='../index.php?page=siswa';</script>";
    } elseif (mysqli_num_rows($validasi2) > 0) {
        echo "<script>alert('NIS Sudah Di Pakai Oleh Siswa Lain'); location.href='../index.php?page=siswa';</script>";
    } else {
        if (empty($_POST['password'])) {
            $query = mysqli_query($koneksi, "UPDATE siswa SET nisn='$nisn', nis='$nis', nama='$nama', id_kelas='$id_kelas', alamat='$alamat', no_telp='$no_telp' WHERE nisn='$oldnisn'");
            if ($query) {
                echo "<script>alert('Data Terupdate');location.href ='../index.php?page=siswa';</script>";
            }
        } else {
            $query = mysqli_query($koneksi, "UPDATE siswa SET nisn='$nisn', nis='$nis', nama='$nama', id_kelas='$id_kelas', alamat='$alamat', no_telp='$no_telp', password='$pw' WHERE nisn='$oldnisn'");
            if ($query) {
                echo "<script>alert('Data Terupdate');location.href ='../index.php?page=siswa';</script>";
            }
        }
    }
}

if (isset($_POST['hapus'])) {
    $nisn = $_POST['nisn'];
    $query = mysqli_query($koneksi, "DELETE FROM siswa WHERE nisn='$nisn'");

    if ($query) {
        echo "<script>alert('Data Berhasil Dihapus');location.href ='../index.php?page=siswa';</script>";
    }
}
