<?php
if (empty($_SESSION['user']['level'] == 'admin')) {
?>
    <script>
        location.reload();
        alert('Halaman Tidak Dapat Di Akses');
        window.history.back();
    </script>
<?php
}
?>

<h1 class="h3 mb-3"><strong>Halaman </strong> || SPP </h1>
<div class="row">
    <div class="col-12">
        <div class="card flex-fill">
            <div class="card-header">
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#tambahspp">+ Tambah SPP</button>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover cell-border" id="spp">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tahun</th>
                            <th>Nominal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM spp");
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $data['tahun'] ?></td>
                                <td>Rp. <?php echo number_format($data['nominal'], 2, ',', '.') ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editspp<?php echo $data['id_spp'] ?>"><i data-feather="edit"></i>Edit</button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusspp<?php echo $data['id_spp'] ?>"><i data-feather="trash-2"></i>Hapus</button>
                                </td>
                            </tr>
                            <!--MODAL UBAH-->
                            <div class="modal fade" id="editspp<?php echo $data['id_spp'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="col-12">
                                                <big><a href="" data-bs-dismiss="modal"><i class="bi bi-arrow-left" style="float: left; color: black;"></i></a></big>
                                                <div class="text-center">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit SPP</h1>
                                                </div>
                                            </div>
                                        </div>

                                        <form method="post" action="crud/spp.php">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="mb-3">
                                                        <input type="hidden" name="id_spp" value="<?= $data['id_spp'] ?>">
                                                        <label class="form-label">Tahun</label>
                                                        <input type="text" name="tahun" class="form-control" value="<?= $data['tahun'] ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Nominal</label>
                                                        <input type="text" name="nominal" class="form-control" value="<?= $data['nominal'] ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="col-12">
                                                    <div class="text-center">
                                                        <button class="btn btn-success" name="edit"><i data-feather="save"></i></button>
                                                        <button type="reset" class="btn btn-danger"><i data-feather="refresh-ccw"></i></button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i data-feather="corner-up-left"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--MODAL HAPUS-->
                            <div class="modal fade" id="hapusspp<?php echo $data['id_spp'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="col-12">
                                                <big><a href="" data-bs-dismiss="modal"><i class="bi bi-arrow-left" style="float: left; color: black;"></i></a></big>
                                                <div class="text-center">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus SPP</h1>
                                                </div>
                                            </div>
                                        </div>
                                        <form method="post" action="crud/spp.php">
                                            <input type="hidden" name="id_spp" value="<?= $data['id_spp'] ?>">
                                            <div class="modal-body">
                                                <h5 cl class="text-center">Apakah Yakin ingin Menghapus <br>
                                                    <span class="text-danger"><strong><?= $data['tahun'] ?> - <?= $data['nominal'] ?></strong></span>
                                                </h5>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="col-12">
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-primary" name="hapus">Yakin</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sebentar</button>
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
    let table = new DataTable('#spp');
</script>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="tambahspp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-12">
                    <big><a href="" data-bs-dismiss="modal"><i class="bi bi-arrow-left" style="float: left; color: black;"></i></a></big>
                    <div class="text-center">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah SPP</h1>
                    </div>
                </div>
            </div>

            <form method="post" action="crud/spp.php">
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-4">
                            <label class="form-label">Tahun</label>
                            <input type="text" name="tahun" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Nominal</label>
                            <input type="text" name="nominal" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-12">
                        <div class="text-center">
                            <button class="btn btn-success" name="simpan"><i data-feather="save"></i></button>
                            <button type="reset" class="btn btn-danger"><i data-feather="refresh-ccw"></i></button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i data-feather="corner-up-left"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>