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

<h1 class="h3 mb-3"><strong>Halaman </strong>|| Petugas</h1>
<div class="row">
    <div class="col-12">
        <div class="card flex-fill">
            <div class="card-header">
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#tambahpetugas">+ Tambah Petugas</button>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover cell-border" id="petugas">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Nama Petugas</th>
                            <th>Level</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM petugas");
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $data['username'] ?></td>
                                <td><?php echo $data['nama_petugas'] ?></td>
                                <td><?php echo $data['level'] ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editpetugas<?php echo $data['id_petugas'] ?>"><i data-feather="edit"></i>Edit</button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapuspetugas<?php echo $data['id_petugas'] ?>"><i data-feather="trash-2"></i>Hapus</button>
                                </td>
                            </tr>
                            <!--MODAL UBAH-->
                            <div class="modal fade" id="editpetugas<?php echo $data['id_petugas'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="col-12">
                                                <big><a href="" data-bs-dismiss="modal"><i class="bi bi-arrow-left" style="float: left; color: black;"></i></a></big>
                                                <div class="text-center">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Petugas</h1>
                                                </div>
                                            </div>
                                        </div>

                                        <form method="post" action="crud/petugas.php">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="mb-3">
                                                        <input type="hidden" name="id_petugas" value="<?= $data['id_petugas'] ?>">
                                                        <label class="form-label">Username</label>
                                                        <input type="text" name="username" class="form-control" value="<?= $data['username'] ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Password</label>
                                                        <input type="password" name="password" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Nama Petugas</label>
                                                        <input type="text" name="nama_petugas" class="form-control" value="<?= $data['nama_petugas'] ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Level</label>
                                                        <select name="level" class="form-select" required>
                                                            <option value="admin">Admin</option>
                                                            <option value="petugas" <?php if ($data['level'] == 'petugas') {
                                                                                        echo 'selected';
                                                                                    } ?>>Petugas</option>
                                                        </select>
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
                            <div class="modal fade" id="hapuspetugas<?php echo $data['id_petugas'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="col-12">
                                                <big><a href="" data-bs-dismiss="modal"><i class="bi bi-arrow-left" style="float: left; color: black;"></i></a></big>
                                                <div class="text-center">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Petugas</h1>
                                                </div>
                                            </div>
                                        </div>
                                        <form method="post" action="crud/petugas.php">
                                            <input type="hidden" name="id_petugas" value="<?= $data['id_petugas'] ?>">
                                            <div class="modal-body">
                                                <h5 cl class="text-center">Apakah Yakin ingin Menghapus?<br>
                                                    <span class="text-danger"><strong><?= $data['username'] ?> - <?= $data['nama_petugas'] ?></strong></span>
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
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    let table = new DataTable('#petugas');
</script>
<!-- MODAL TAMBAH -->
<div class="modal fade" id="tambahpetugas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-12">
                    <big><a href="" data-bs-dismiss="modal"><i class="bi bi-arrow-left" style="float: left; color: black;"></i></a></big>
                    <div class="text-center">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Petugas</h1>
                    </div>
                </div>
            </div>

            <form method="post" action="crud/petugas.php">
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-4">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Nama Petugas</label>
                            <input type="text" name="nama_petugas" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Level</label>
                            <select name="level" class="form-select" required>
                                <option value="admin">Admin</option>
                                <option value="petugas">Petugas</option>
                            </select>
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
                </div>
            </form>
        </div>
    </div>
</div>