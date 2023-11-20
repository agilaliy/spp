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

<h1 class="h3 mb-3"><strong>Halaman </strong>|| Kelas</h1>
<div class="row">
    <div class="col-12">
        <div class="card flex-fill">
            <div class="card-header">
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#tambahkelas">+ Tambah Kelas</button>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover cell-border" id="kelas">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Kompetensi Keahlian</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM kelas");
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $data['nama_kelas'] ?></td>
                                <td><?php echo $data['kompetensi_keahlian'] ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editkelas<?php echo $data['id_kelas'] ?>"><i data-feather="edit"></i>Edit</button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapuskelas<?php echo $data['id_kelas'] ?>"><i data-feather="trash-2"></i>Hapus</button>
                                </td>
                            </tr>
                            <!--MODAL UBAH-->
                            <div class="modal fade" id="editkelas<?php echo $data['id_kelas'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="col-12">
                                                <big><a href="" data-bs-dismiss="modal"><i class="bi bi-arrow-left" style="float: left; color: black;"></i></a></big>
                                                <div class="text-center">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Kategori</h1>
                                                </div>
                                            </div>
                                        </div>

                                        <form method="post" action="crud/kelas.php">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="mb-3">
                                                        <input type="hidden" name="id_kelas" value="<?= $data['id_kelas'] ?>">
                                                        <label class="form-label">Nama Kelas</label>
                                                        <input type="text" name="nama_kelas" class="form-control" value="<?= $data['nama_kelas'] ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Kompetensi Keahlian</label>
                                                        <input type="text" name="kompetensi_keahlian" class="form-control" value="<?= $data['kompetensi_keahlian'] ?>" required>
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
                            <div class="modal fade" id="hapuskelas<?php echo $data['id_kelas'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="col-12">
                                                <big><a href="" data-bs-dismiss="modal"><i class="bi bi-arrow-left" style="float: left; color: black;"></i></a></big>
                                                <div class="text-center">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Kelas</h1>
                                                </div>
                                            </div>
                                        </div>
                                        <form method="post" action="crud/kelas.php">
                                            <input type="hidden" name="id_kelas" value="<?= $data['id_kelas'] ?>">
                                            <div class="modal-body">
                                                <h5 cl class="text-center">Apakah Yakin ingin Menghapus <br>
                                                    <span class="text-danger"><strong><?= $data['nama_kelas'] ?> - <?= $data['kompetensi_keahlian'] ?></strong></span>
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
    let table = new DataTable('#kelas');
</script>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="tambahkelas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-12">
                    <big><a href="" data-bs-dismiss="modal"><i class="bi bi-arrow-left" style="float: left; color: black;"></i></a></big>
                    <div class="text-center">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Kelas</h1>
                    </div>
                </div>
            </div>

            <form method="post" action="crud/kelas.php">
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-4">
                            <label class="form-label">Nama Kelas</label>
                            <input type="text" name="nama_kelas" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Kompetensi Keahlian</label>
                            <input type="text" name="kompetensi_keahlian" class="form-control" required>
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