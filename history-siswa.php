<?php
if (empty($_SESSION['user']['level'])) {
?>
    <script>
        location.reload();
        alert('Halaman Tidak Dapat Di Akses');
        window.history.back();
    </script>
<?php
}
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <h1 class="h3 mb-4"> History Siswa </h1>
                    <h1 class="h4 mb-3">Keterangan</h1>
                    <tr>
                        <td width="12%"> NISN </td>
                        <td width="1%"> : </td>
                        <td><?= $_GET['nisn'] ?> </td>
                    </tr>
                    <tr>
                        <td width="12%"> Nama </td>
                        <td width="1%"> : </td>
                        <td><?= $_GET['nama'] ?> </td>
                    </tr>
                    <tr>
                        <td width="12%"> Kelas Dan Jurusan </td>
                        <td width="1%"> : </td>
                        <td><?= $_GET['kelas'] ?> - <?= $_GET['jurusan'] ?> </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card flex-fill">
            <div class="card-body">
                <?php
                if (!empty($_SESSION['user']['level'] != 'petugas')) {
                ?>
                    <a href="cetak-history.php?nisn=<?= $_GET['nisn'] ?>" class="btn btn-success btn-sm mb-3" target="_blank"><i data-feather="printer"></i> Print </a>
                <?php
                }
                ?>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nisn = $_GET['nisn'];
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
                                <td>
                                    <?php if ($data['nominal'] == $data['jumlah_bayar']) {
                                    ?>
                                        <button type="button" class="btn btn-success btn-sm"> Lunas </button>
                                    <?php
                                    } else {
                                    ?>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editpembayaran<?php echo $data['id_pembayaran'] ?>"><i data-feather="edit"></i>Lunasi</button>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <!--MODAL UBAH-->
                            <div class="modal fade" id="editpembayaran<?php echo $data['id_pembayaran'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="col-12">
                                                <big><a href="" data-bs-dismiss="modal"><i class="bi bi-arrow-left" style="float: left; color: black;"></i></a></big>
                                                <div class="text-center">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Lunasi</h1>
                                                </div>
                                            </div>
                                        </div>

                                        <form method="post" action="crud/pembayaran.php">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="mb-4">
                                                        <input type="hidden" name="id_pembayaran" value="<?= $data['id_pembayaran'] ?>">
                                                        <label class="form-label">Nama Siswa</label>
                                                        <select name="nisn" class="form-select" value="<?= $data['nisn'] ?>" disabled>
                                                            <?php
                                                            $query1 = mysqli_query($koneksi, "SELECT * FROM siswa");
                                                            while ($siswa = mysqli_fetch_array($query1)) {
                                                            ?>
                                                                <option <?php if ($data['nisn'] == $siswa['nisn']) {
                                                                            echo 'selected';
                                                                        } ?>><?php echo $siswa['nama'] ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Tanggal Bayar</label>
                                                        <input type="date" name="tgl_bayarl" class="form-control" value="<?= $data['tgl_bayar'] ?>" disabled>
                                                        <input type="hidden" name="tgl_bayarb" class="form-control" value="<?= date('Y-m-d') ?>">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-labeal">Bulan Bayar</label>
                                                        <input type="text" name="bln_bayar" class="form-control" value="<?= $data['bulan_bayar'] ?>" disabled>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Tahun Bayar</label>
                                                        <input type="text" name="thn_bayar" class="form-control" value="<?= $data['tahun_dibayar'] ?>" disabled>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Kekurangan</label>
                                                        <input type="text" name="kekurangan" class="form-control" value="<?= $data['nominal'] - $data['jumlah_bayar'] ?>" readonly>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">SPP</label>
                                                        <input type="text" name="id_spp" class="form-control" value="<?= $data['nominal'] ?>" readonly>
                                                    </div>
                                                    <div class="mb-4">
                                                        <input type="hidden" name="jmlh_bl" value="<?= $data['jumlah_bayar'] ?>">
                                                        <label class="form-label">Jumlah Bayar</label>
                                                        <input type="text" name="jmlh_bb" class="form-control">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <div class="col-12">
                                                        <div class="text-center">
                                                            <button class="btn btn-success" name="lunasi"><i data-feather="save"></i></button>
                                                            <button type="reset" class="btn btn-danger"><i data-feather="refresh-ccw"></i></button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i data-feather="corner-up-left"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<script>
    let table = new DataTable('#siswa');
</script>