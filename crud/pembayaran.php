<?php
include '../koneksi.php';

if (isset($_POST['simpan'])) {
    $id_petugas = $_SESSION['user']['id_petugas'];
    $nisn = $_POST['nisn'];
    $tgl_bayar = $_POST['tgl_bayar'];
    $bln_bayar = $_POST['bln_bayar'];
    $thn_bayar = $_POST['thn_bayar'];
    $spp = $_POST['id_spp'];
    $jumlah_bayar = str_replace('.', '', $_POST['jmlh_bayar']);
    $validasi = mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE nisn='$nisn' AND id_spp='$spp'");

    $t = mysqli_query($koneksi, "SELECT * FROM spp WHERE id_spp='$spp'");
    $d = mysqli_fetch_array($t);

    $total = $d['nominal'];
    $sisa = $jumlah_bayar - $d['nominal'];
    if (mysqli_num_rows($validasi) > 0) {
        echo "<script>alert('Siswa Sudah Pernah Melakukah Pembayaran Untuk SPP ini'); location.href ='../index.php?page=laporan';</script>";
    } elseif ($jumlah_bayar > $d['nominal']) {
        $query = mysqli_query($koneksi, "INSERT INTO pembayaran (id_petugas,nisn,tgl_bayar,bulan_bayar,tahun_dibayar,id_spp,jumlah_bayar)
            VALUES ('$id_petugas','$nisn','$tgl_bayar','$bln_bayar','$thn_bayar','$spp','$total')");
        if ($query) {
            echo "<script>alert('SPP Terbayar || Saldo Anda Di Kembalikan Sebesar : Rp  " . number_format($sisa, 2, ',', '.') . "');location.href ='../index.php?page=laporan';</script>";
        }
    } elseif ($jumlah_bayar < $d['nominal']) {
        $kekurangan = $d['nominal'] - $jumlah_bayar;
        $query = mysqli_query($koneksi, "INSERT INTO pembayaran (id_petugas,nisn,tgl_bayar,bulan_bayar,tahun_dibayar,id_spp,jumlah_bayar)
        VALUES ('$id_petugas','$nisn','$tgl_bayar','$bln_bayar','$thn_bayar','$spp','$jumlah_bayar')");
        if ($query) {
            echo "<script>alert('SPP Terbayar || Kekurangan Sebesar : Rp " . number_format($kekurangan, 2, ',', '.') . "');location.href='../index.php?page=laporan';</script>";
        }
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO pembayaran (id_petugas,nisn,tgl_bayar,bulan_bayar,tahun_dibayar,id_spp,jumlah_bayar)
            VALUES ('$id_petugas','$nisn','$tgl_bayar','$bln_bayar','$thn_bayar','$spp','$jumlah_bayar')");
        if ($query) {
            echo "<script>alert('SPP Terbayar'); location.href='../index.php?page=laporan';</script>";
        }
    }
}


if (isset($_POST['lunasi'])) {
    $id_pembayaran = $_POST['id_pembayaran'];
    $tgl_bayarb = $_POST['tgl_bayarb'];
    $kekurangan = $_POST['kekurangan'];
    $jumlah_bl = $_POST['jmlh_bl'];
    $jumlah_bb = str_replace('.', '', $_POST['jmlh_bb']);
    $spp = $_POST['id_spp'];
    $total = $jumlah_bl + $kekurangan;
    $total1 = $jumlah_bl + $jumlah_bb;
    $sisa = $jumlah_bb - $kekurangan;
    $sisa1 = $kekurangan - $jumlah_bb;
    $sisa2 = $spp - $total1;
    if ($jumlah_bb > $kekurangan) {
        $query = mysqli_query($koneksi, "UPDATE pembayaran SET tgl_bayar='$tgl_bayarb', jumlah_bayar='$total' WHERE id_pembayaran='$id_pembayaran'");
        echo "<script>alert('SPP Terbayar || Saldo Anda Di Kembalikan Sebesar : Rp " . number_format($sisa, 2, ',', '.') . "');location.href ='../index.php?page=laporan';</script>";
    } elseif ($jumlah_bb < $kekurangan) {
        $query = mysqli_query($koneksi, "UPDATE pembayaran SET tgl_bayar='$tgl_bayarb', jumlah_bayar='$total1' WHERE id_pembayaran='$id_pembayaran'");
        echo "<script>alert('SPP Terbayar || Kekurangan SPP Sebesar : Rp " . number_format($sisa2, 2, ',', '.') . "');location.href ='../index.php?page=laporan';</script>";
    } else {
        $query = mysqli_query($koneksi, "UPDATE pembayaran SET tgl_bayar='$tgl_bayarb', jumlah_bayar='$total1' WHERE id_pembayaran='$id_pembayaran'");
        echo "<script>alert('SPP Terbayar || Saldo Anda Di Kembalikan Sebesar : Rp " . number_format($sisa1, 2, ',', '.') . "');location.href ='../index.php?page=laporan';</script>";
    }
}
