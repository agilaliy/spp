<?php
include 'koneksi.php';

if (empty($_SESSION['user']['level'] == 'admin')) {
?>
    <script>
        location.reload();
        alert('Level Tidak Sesuai Untuk Melakukan Print');
        window.history.back();
    </script>
<?php
}
?>

<script>
    window.print();
</script>
<table border="1" width="100%" cellpadding="5" cellspacing="0">
    <tr>
        <th colspan="9">
            <h2 style="margin: 0;"> Laporan SPP</h2>

        </th>
    </tr>

    <tr>
        <th>No</th>
        <th>Nama Petugas</th>
        <th>Nama Siswa</th>
        <th>Tanggal Bayar</th>
        <th>Bulan Bayar</th>
        <th>Tahun Bayar</th>
        <th>SPP</th>
        <th>Jumlah Bayar</th>
        <th>Status</th>
    </tr>

    <tbody>
        <?php
        if (!empty($_GET['tgl_awal']) && !empty($_GET['tgl_akhir']) && !empty($_GET['spp']) && !empty($_GET['kelas'])) {
            $no = 1;
            $tgl_awl = $_GET['tgl_awal'];
            $tgl_akhr = $_GET['tgl_akhir'];
            $spp = $_GET['spp'];
            $kelas = $_GET['kelas'];
            $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN spp ON pembayaran.id_spp=spp.id_spp
            WHERE (DATE(tgl_bayar) BETWEEN '$tgl_awl' AND '$tgl_akhr') AND pembayaran.id_spp='$spp' AND siswa.id_kelas='$kelas'");
        } elseif (!empty($_GET['tgl_awal']) && !empty($_GET['tgl_akhir']) && !empty($_GET['spp'])) {
            $no = 1;
            $tgl_awl = $_GET['tgl_awal'];
            $tgl_akhr = $_GET['tgl_akhir'];
            $spp = $_GET['spp'];
            $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN spp ON pembayaran.id_spp=spp.id_spp
            WHERE (DATE(tgl_bayar) BETWEEN '$tgl_awl' AND '$tgl_akhr') AND pembayaran.id_spp='$spp'");
        } elseif (!empty($_GET['tgl_awal']) && !empty($_GET['tgl_akhir']) && !empty($_GET['kelas'])) {
            $no = 1;
            $tgl_awl = $_GET['tgl_awal'];
            $tgl_akhr = $_GET['tgl_akhir'];
            $kelas = $_GET['kelas'];
            $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN spp ON pembayaran.id_spp=spp.id_spp
            WHERE (DATE(tgl_bayar) BETWEEN '$tgl_awl' AND '$tgl_akhr') AND siswa.id_kelas='$kelas'");
        } elseif (!empty($_GET['tgl_awal']) && !empty($_GET['tgl_akhir'])) {
            $no = 1;
            $tgl_awl = $_GET['tgl_awal'];
            $tgl_akhr = $_GET['tgl_akhir'];
            $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN spp ON pembayaran.id_spp=spp.id_spp
            WHERE (DATE(tgl_bayar) BETWEEN '$tgl_awl' AND '$tgl_akhr')");
        } elseif (!empty($_GET['spp']) && !empty($_GET['kelas'])) {
            $no = 1;
            $spp = $_GET['spp'];
            $kelas = $_GET['kelas'];
            $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN spp ON pembayaran.id_spp=spp.id_spp
            WHERE pembayaran.id_spp='$spp' AND siswa.id_kelas='$kelas'");
        } elseif (!empty($_GET['spp'])) {
            $no = 1;
            $spp = $_GET['spp'];
            $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN spp ON pembayaran.id_spp=spp.id_spp
            WHERE pembayaran.id_spp='$spp'");
        } elseif (!empty($_GET['kelas'])) {
            $no = 1;
            $kelas = $_GET['kelas'];
            $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN spp ON pembayaran.id_spp=spp.id_spp
            WHERE siswa.id_kelas='$kelas'");
        } else {
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN spp ON pembayaran.id_spp=spp.id_spp ");
        }
        while ($data = mysqli_fetch_array($query)) {

        ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $data['nama_petugas'] ?></td>
                <td><?php echo $data['nama'] ?></td>
                <td><?php echo $data['tgl_bayar'] ?></td>
                <td><?php echo $data['bulan_bayar'] ?></td>
                <td><?php echo $data['tahun_dibayar'] ?></td>
                <td><?php echo $data['tahun'] ?> - Rp. <?php echo number_format($data['nominal']) ?></td>
                <td>Rp. <?php echo number_format($data['jumlah_bayar']) ?></td>
                <td>
                    <?php
                    if ($data['nominal'] > $data['jumlah_bayar']) {
                        echo 'Kurang';
                    } else {
                        echo 'Lunas';
                    }
                    ?>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>