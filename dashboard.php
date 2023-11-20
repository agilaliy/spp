<?php
if (!empty($_SESSION['user']['level'])) {
?>
    <h1 class="h3 mb-3"><strong>Halaman </strong> || Dashboard</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td width="12%"> Username </td>
                            <td width="1"> : </td>
                            <td> <?= $_SESSION['user']['username'] ?></td>
                        </tr>
                        <tr>
                            <td width="12"> Nama Petugas</td>
                            <td width="1"> : </td>
                            <td> <?= $_SESSION['user']['nama_petugas'] ?></td>
                        </tr>
                        <tr>
                            <td width="12"> Level </td>
                            <td width='1'> : </td>
                            <td> <?= $_SESSION['user']['level'] ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Jumlah Kelas</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="home"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">
                                    <?php
                                    $u = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM kelas");
                                    $k = mysqli_fetch_array($u);
                                    echo $k['total']
                                    ?>
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Jumlah Siswa</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="users"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">
                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM siswa ");
                                    $y = mysqli_fetch_array($query);
                                    echo $y['total'];
                                    ?>
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Jumlah Saldo</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="dollar-sign"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">
                                    <?php
                                    $p = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) AS total FROM pembayaran");
                                    $d = mysqli_fetch_array($p);
                                    echo 'Rp ' . number_format($d['total'], 2, ',', '.');
                                    ?>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php
} else {
?>
    <h1 class="h3 mb-3"><strong>Halaman </strong> || History</h1>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <h1 class="h3 mb-2"> History Siswa </h1>

                    <tr>
                        <td width="12%"> NISN </td>
                        <td width="1">:</td>
                        <td><?php echo $_SESSION['user']['nisn'] ?></td>
                    </tr>
                    <td width="12%"> Nama </td>
                    <td width="1">:</td>
                    <td><?php echo $_SESSION['user']['nama'] ?></td>
                    </tr>
                    <?php
                    $nisn = $_SESSION['user']['nisn'];
                    $g = mysqli_query($koneksi, "SELECT * FROM siswa INNER JOIN kelas ON kelas.id_kelas=siswa.id_kelas WHERE nisn='$nisn'");
                    $h = mysqli_fetch_array($g);
                    ?>
                    <tr>
                        <td width="12"> Kelas Dan Jurusan </td>
                        <td width="1"> : </td>
                        <td> <?= $h['nama_kelas'] ?> - <?= $h['kompetensi_keahlian'] ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card flex-fill">
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover cell-border" id="siswa">
                        <thead>
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
                        </thead>
                        <tbody>
                            <?php
                            $nisn = $_SESSION['user']['nisn'];
                            $no = 1;
                            $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN spp ON pembayaran.id_spp=spp.id_spp WHERE pembayaran.nisn='$nisn'");

                            while ($data = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $data['nama_petugas'] ?></td>
                                    <td><?php echo $data['nama'] ?></td>
                                    <td><?php echo $data['tgl_bayar'] ?></td>
                                    <td><?php echo $data['bulan_bayar'] ?></td>
                                    <td><?php echo $data['tahun_dibayar'] ?></td>
                                    <td><?php echo $data['tahun'] ?> - Rp. <?php echo number_format($data['nominal'], 2, ',', '.') ?></td>
                                    <td> Rp. <?php echo number_format($data['jumlah_bayar'], 2, ',', '.') ?></td>
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
                </div>

            </div>
        </div>
    </div>
<?php
}

?>