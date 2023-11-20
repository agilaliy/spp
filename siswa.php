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

<h1 class="h3 mb-3"> <strong>Halaman </strong> || Siswa</h1>
<div class="row">
    <div class="col-12">
        <div class="card flex-fill">
            <div class="card-header">
                <?php
                if (!empty($_SESSION['user']['level'] == 'admin')) {
                ?>
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#tambahsiswa">+ Tambah Siswa</button>
                <?php
                }
                ?>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover cell-border" id="siswa">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NISN</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Kompetensi Keahlian</th>
                            <th>Alamat</th>
                            <th>No Telepon</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM siswa INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas");
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td style="width: 1%;"><?php echo $no++ ?></td>
                                <td><?php echo $data['nisn'] ?></td>
                                <td><?php echo $data['nis'] ?></td>
                                <td><?php echo $data['nama'] ?></td>
                                <td><?php echo $data['nama_kelas'] ?></td>
                                <td style="width: 10 %;"><?php echo $data['kompetensi_keahlian'] ?></td>
                                <td><?php echo $data['alamat'] ?></td>
                                <td><?php echo $data['no_telp'] ?></td>
                                <td style="<?= (empty($_SESSION['user']['level'] != 'admin') ? 'width: 13%;' : 'width : 3%;') ?>">
                                    <?php
                                    if (!empty($_SESSION['user']['level'] == 'admin')) {
                                    ?>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editsiswa<?php echo $data['nisn'] ?>"><i data-feather="edit"></i></button>
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapussiswa<?php echo $data['nisn'] ?>"><i data-feather="trash-2"></i></button>
                                    <?php
                                    }
                                    ?>
                                    <a href="?page=history-siswa&nisn=<?= $data['nisn'] ?>&nama=<?= $data['nama'] ?>&kelas=<?= $data['nama_kelas'] ?>&jurusan=<?= $data['kompetensi_keahlian'] ?>" class="btn btn-info btn-sm" name="coba"><i data-feather="file-text"></i></a>
                                </td>
                            </tr>
                            <!--MODAL UBAH-->
                            <div class="modal fade" id="editsiswa<?php echo $data['nisn'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="col-12">
                                                <big><a href="" data-bs-dismiss="modal"><i class="bi bi-arrow-left" style="float: left; color: black;"></i></a></big>
                                                <div class="text-center">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Siswa</h1>
                                                </div>
                                            </div>
                                        </div>

                                        <form method="post" action="crud/siswa.php">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="mb-4">
                                                        <input type="hidden" name="oldnisn" value="<?= $data['nisn'] ?>">
                                                        <label class="form-label">NISN</label>
                                                        <input type="text" name="nisn" class="form-control" value="<?= $data['nisn'] ?>" required>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">NIS</label>
                                                        <input type="text" name="nis" class="form-control" value="<?= $data['nis'] ?>" required>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Nama</label>
                                                        <input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>" required>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Kelas dan Kompetensi Keahlian</label>
                                                        <select name="id_kelas" class="form-select" required>
                                                            <?php
                                                            $query1 = mysqli_query($koneksi, "SELECT * FROM kelas");
                                                            while ($kelas = mysqli_fetch_array($query1)) {
                                                            ?>
                                                                <option value="<?php echo $kelas['id_kelas'] ?>" <?php if ($data['id_kelas'] == $kelas['id_kelas']) {
                                                                                                                        echo 'selected';
                                                                                                                    } ?>><?php echo $kelas['nama_kelas'] ?> - <?php echo $kelas['kompetensi_keahlian'] ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Alamat</label>
                                                        <input type="text" name="alamat" class="form-control" value="<?= $data['alamat'] ?>" required>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">No Telepon</label>
                                                        <input type="text" name="no_telp" class="form-control" value="<?= $data['no_telp'] ?>" required>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Password</label>
                                                        <input type="password" name="password" class="form-control">
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
                            <div class="modal fade" id="hapussiswa<?php echo $data['nisn'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="col-12">
                                                <big><a href="" data-bs-dismiss="modal"><i class="bi bi-arrow-left" style="float: left; color: black;"></i></a></big>
                                                <div class="text-center">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Siswa</h1>
                                                </div>
                                            </div>
                                        </div>
                                        <form method="post" action="crud/siswa.php">
                                            <input type="hidden" name="nisn" value="<?= $data['nisn'] ?>">
                                            <div class="modal-body">
                                                <h5 cl class="text-center">Apakah Yakin ingin Menghapus <br>
                                                    <span class="text-danger"><strong><?= $data['nisn'] ?> - <?= $data['nama'] ?></strong></span>
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
    let table = new DataTable('#siswa');
</script>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="tambahsiswa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-12">
                    <big><a href="" data-bs-dismiss="modal"><i class="bi bi-arrow-left" style="float: left; color: black;"></i></a></big>
                    <div class="text-center">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Siswa</h1>
                    </div>
                </div>
            </div>

            <form method="post" action="crud/siswa.php">
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-4">
                            <label class="form-label">NISN</label>
                            <input type="text" name="nisn" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">NIS</label>
                            <input type="text" name="nis" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Kelas dan Kompetensi Keahlian</label>
                            <select name="id_kelas" class="form-select" required>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM kelas");
                                while ($kelas = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $kelas['id_kelas'] ?>"><?php echo $kelas['nama_kelas'] ?> - <?php echo $kelas['kompetensi_keahlian'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Alamat</label>
                            <input type="text" name="alamat" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">No Telepon</label>
                            <input type="text" name="no_telp" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
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