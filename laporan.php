<?php
if (isset($_POST['cari'])) {
    $tgl_awl = $_POST['tgl_awal'];
    $tgl_akhr = $_POST['tgl_akhir'];
    $spp = $_POST['spp'];
    $kelas = $_POST['kelas'];
} else {
    $tgl_awl = '';
    $tgl_akhr = '';
    $spp = '';
    $kelas = '';
}
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
<h1 class="h2 mb-3"><strong>Laporan </strong> || Pembayaran SPP</h1>
<?php
if (!empty($tgl_awl) && !empty($tgl_akhr) && !empty($spp) && !empty($kelas)) {
    $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas INNER JOIN spp ON pembayaran.id_spp=spp.id_spp
    WHERE (DATE(tgl_bayar) BETWEEN '$tgl_awl' AND '$tgl_akhr') AND pembayaran.id_spp='$spp' AND siswa.id_kelas='$kelas'");
    if ($data = mysqli_fetch_array($query)) {
?>
        <h4 class="h4 mb-2">- Siswa Kelas : <?php echo $data['nama_kelas'] ?> - <?php echo $data['kompetensi_keahlian'] ?></h4>
        <h4 class="h4 mb-2">- SPP Tahun : <?php echo $data['tahun'] ?></h4>
        <h4 class="h4 mb-2">- Nominal : Rp. <?php echo number_format($data['nominal'], 2, ',', '.') ?></h4>
        <h4 class="h4 mb-2">- Periode Bayar : <?php echo date('d-m-Y', strtotime($tgl_awl)) . ' s.d ' . date('d-m-Y', strtotime($tgl_akhr)) ?> </h4>
    <?php
    }
} elseif (!empty($tgl_awl) && !empty($tgl_akhr) && !empty($spp)) {
    $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas INNER JOIN spp ON pembayaran.id_spp=spp.id_spp
    WHERE (DATE(tgl_bayar) BETWEEN '$tgl_awl' AND '$tgl_akhr') AND pembayaran.id_spp='$spp'");
    if ($data = mysqli_fetch_array($query)) {
    ?>
        <h4 class="h4 mb-2">- Dengan SPP Tahun : <?php echo $data['tahun'] ?> </h4>
        <h4 class="h4 mb-2">- Nominal : Rp. <?php echo number_format($data['nominal'], 2, ',', '.') ?></h4>
        <h4 class="h4 mb-2">- Periode Bayar : <?php echo date('d-m-Y', strtotime($tgl_awl)) . ' s.d ' . date('d-m-Y', strtotime($tgl_akhr)) ?> </h4>
    <?php
    }
} elseif (!empty($tgl_awl) && !empty($tgl_akhr) && !empty($kelas)) {
    $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas INNER JOIN spp ON pembayaran.id_spp=spp.id_spp
    WHERE (DATE(tgl_bayar) BETWEEN '$tgl_awl' AND '$tgl_akhr') AND siswa.id_kelas='$kelas'");
    if ($data = mysqli_fetch_array($query)) {
    ?>
        <h4 class="h4 mb-2">- Siswa Kelas : <?php echo $data['nama_kelas'] ?> - <?= $data['kompetensi_keahlian'] ?></h4>
        <h4 class="h4 mb-2">- Periode Bayar : <?php echo date('d-m-Y', strtotime($tgl_awl)) . ' s.d ' . date('d-m-Y', strtotime($tgl_akhr)) ?> </h4>
    <?php
    }
} elseif (!empty($tgl_awl) && !empty($tgl_akhr)) {
    $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas INNER JOIN spp ON pembayaran.id_spp=spp.id_spp
    WHERE (DATE(tgl_bayar) BETWEEN '$tgl_awl' AND '$tgl_akhr')");
    if ($g = mysqli_fetch_array($query)) {
    ?>
        <h4 class="h4 mb-2">- Periode Bayar : <?php echo date('d-m-Y', strtotime($tgl_awl)) . ' s.d ' . date('d-m-Y', strtotime($tgl_akhr)) ?> </h4>
    <?php
    }
} elseif (!empty($spp) && !empty($kelas)) {
    $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas INNER JOIN spp ON pembayaran.id_spp=spp.id_spp
    WHERE pembayaran.id_spp='$spp' AND siswa.id_kelas='$kelas'");
    if ($g = mysqli_fetch_array($query)) {
    ?>
        <h4 class="h4 mb-2">- Siswa Kelas : <?php echo $g['nama_kelas'] ?> - <?= $g['kompetensi_keahlian'] ?> </h4>
        <h4 class="h4 mb-2">- SPP Tahun : <?php echo $g['tahun'] ?> </h4>
        <h4 class="h4 mb-2">- Nominal : Rp. <?php echo number_format($g['nominal'], 2, ',', '.') ?></h4>
    <?php
    }
} elseif (!empty($spp)) {
    $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas INNER JOIN spp ON pembayaran.id_spp=spp.id_spp
    WHERE pembayaran.id_spp='$spp'");
    if ($g = mysqli_fetch_array($query)) {
    ?>
        <h4 class="h4 mb-2">- SPP Tahun : <?php echo $g['tahun'] ?> </h4>
        <h4 class="h4 mb-2">- Nominal : Rp. <?php echo number_format($g['nominal'], 2, ',', '.') ?></h4>
    <?php
    }
} elseif (!empty($kelas)) {
    $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas INNER JOIN spp ON pembayaran.id_spp=spp.id_spp
    WHERE siswa.id_kelas='$kelas'");
    if ($g = mysqli_fetch_array($query)) {
    ?>
        <h4 class="h4 mb-2">- Siswa Kelas : <?php echo $g['nama_kelas'] ?> - <?= $g['kompetensi_keahlian'] ?> </h4>
<?php
    }
}
?>

<div class="row">
    <div class="col-12">
        <div class="card flex-fill">
            <div class="card-body">

                <form action="" method="post">
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-lg-2">
                                <label class="form-label">Tanggal Awal</label>
                                <input type="date" name="tgl_awal" class="form-control" value="<?= ($tgl_awl ? $tgl_awl : '') ?>">
                            </div>
                            <div class="col-lg-2">
                                <label class="form-label">Tanggal Akhir</label>
                                <input type="date" name="tgl_akhir" class="form-control" value="<?= ($tgl_akhr ? $tgl_akhr : '') ?>">
                            </div>
                            <div class="col-lg-2">
                                <label class="form-label">SPP</label>
                                <select name="spp" class="form-select">
                                    <option value="">-Pilih-</option>
                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM spp");
                                    while ($spp1 = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?= $spp1['id_spp'] ?>" <?= ($spp == $spp1['id_spp'] ? 'selected' : '') ?>>
                                            <?= $spp1['tahun'] ?> - <?= $spp1['nominal'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="col-lg-2">
                                <label class="form-label">Kelas</label>
                                <select name="kelas" class="form-select">
                                    <option value="">-Pilih-</option>
                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM kelas");
                                    while ($kelas1 = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?= $kelas1['id_kelas'] ?>" <?= ($kelas == $kelas1['id_kelas'] ? 'selected' : '') ?>>
                                            <?= $kelas1['nama_kelas'] ?> - <?= $kelas1['kompetensi_keahlian'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-3" style="margin-top: 2.1%;">
                                <button class="btn btn-success" name="cari"><i data-feather="search"></i></button>
                                <a href="?page=laporan" class="btn btn-success"><i data-feather="refresh-ccw"></i></a>
                                <?php
                                if (!empty($_SESSION['user']['level'] == 'admin')) {
                                    if (isset($_POST['cari'])) {
                                        if (!empty($tgl_awl) && !empty($tgl_akhr) && !empty($spp) && !empty($kelas)) {
                                ?>
                                            <a href="cetak-laporan.php?tgl_awal=<?= $tgl_awl ?>&tgl_akhir=<?= $tgl_akhr ?>&spp=<?= $spp ?>&kelas=<?= $kelas ?>" class="btn btn-success" target="_blank"><i data-feather="printer"></i> Print </a>
                                        <?php
                                        } elseif (!empty($tgl_awl) && !empty($tgl_akhr) && !empty($spp)) {
                                        ?>
                                            <a href="cetak-laporan.php?tgl_awal=<?= $tgl_awl ?>&tgl_akhir=<?= $tgl_akhr ?>&spp=<?= $spp ?>" class="btn btn-success" target="_blank"><i data-feather="printer"></i> Print </a>
                                        <?php
                                        } elseif (!empty($tgl_awl) && !empty($tgl_akhr) && !empty($kelas)) {
                                        ?>
                                            <a href="cetak-laporan.php?tgl_awal=<?= $tgl_awl ?>&tgl_akhir=<?= $tgl_akhr ?>&kelas=<?= $kelas ?>" class="btn btn-success" target="_blank"><i data-feather="printer"></i> Print </a>
                                        <?php
                                        } elseif (!empty($tgl_awl) && !empty($tgl_akhr)) {
                                        ?>
                                            <a href="cetak-laporan.php?tgl_awal=<?= $tgl_awl ?>&tgl_akhir=<?= $tgl_akhr ?>" class="btn btn-success" target="_blank"><i data-feather="printer"></i> Print </a>
                                        <?php
                                        } elseif (!empty($spp) && !empty($kelas)) {
                                        ?>
                                            <a href="cetak-laporan.php?spp=<?= $spp ?>&kelas=<?= $kelas ?>" class="btn btn-success" target="_blank"><i data-feather="printer"></i> Print </a>
                                        <?php
                                        } elseif (!empty($spp)) {
                                        ?>
                                            <a href="cetak-laporan.php?spp=<?= $spp ?>" class="btn btn-success" target="_blank"><i data-feather="printer"></i> Print </a>
                                        <?php
                                        } elseif (!empty($kelas)) {
                                        ?>
                                            <a href="cetak-laporan.php?kelas=<?= $kelas ?>" class="btn btn-success" target="_blank"><i data-feather="printer"></i> Print </a>
                                        <?php
                                        }
                                        ?>
                                    <?php
                                    } else {
                                        $no = 1;
                                    ?>
                                        <a href="cetak-laporan.php" class="btn btn-success" target="_blank"><i data-feather="printer"></i> Print </a>
                                <?php

                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>


                </form>
            </div>

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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_POST['cari'])) {
                            $no = 1;
                            $tgl_awl = $_POST['tgl_awal'];
                            $tgl_akhr = $_POST['tgl_akhir'];
                            $spp = $_POST['spp'];
                            $kelas = $_POST['kelas'];
                            if (!empty($tgl_awl) && !empty($tgl_akhr) && !empty($spp) && !empty($kelas)) {
                                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN spp ON pembayaran.id_spp=spp.id_spp
                                WHERE (DATE(tgl_bayar) BETWEEN '$tgl_awl' AND '$tgl_akhr') AND pembayaran.id_spp='$spp' AND siswa.id_kelas='$kelas'");
                            } elseif (!empty($tgl_awl) && !empty($tgl_akhr) && !empty($spp)) {
                                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN spp ON pembayaran.id_spp=spp.id_spp
                                WHERE (DATE(tgl_bayar) BETWEEN '$tgl_awl' AND '$tgl_akhr') AND pembayaran.id_spp='$spp'");
                            } elseif (!empty($tgl_awl) && !empty($tgl_akhr) && !empty($kelas)) {
                                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN spp ON pembayaran.id_spp=spp.id_spp
                                WHERE (DATE(tgl_bayar) BETWEEN '$tgl_awl' AND '$tgl_akhr') AND siswa.id_kelas='$kelas'");
                            } elseif (!empty($tgl_awl) && !empty($tgl_akhr)) {
                                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN spp ON pembayaran.id_spp=spp.id_spp
                                WHERE (DATE(tgl_bayar) BETWEEN '$tgl_awl' AND '$tgl_akhr')");
                            } elseif (!empty($spp) && !empty($kelas)) {
                                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN spp ON pembayaran.id_spp=spp.id_spp
                                WHERE pembayaran.id_spp='$spp' AND siswa.id_kelas='$kelas'");
                            } elseif (!empty($spp)) {
                                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN spp ON pembayaran.id_spp=spp.id_spp
                                WHERE pembayaran.id_spp='$spp'");
                            } elseif (!empty($kelas)) {
                                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN spp ON pembayaran.id_spp=spp.id_spp
                                WHERE siswa.id_kelas='$kelas'");
                            }
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
                                                        <input type="text" class="form-control" value=" Rp. <?= number_format($data['nominal'] - $data['jumlah_bayar'], 2, ',', '.') ?>" disabled>
                                                        <input type="hidden" name="kekurangan" class="form-control" value="<?= $data['nominal'] - $data['jumlah_bayar'] ?>">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">SPP</label>
                                                        <input type="text" class="form-control" value=" Rp. <?= number_format($data['nominal'], 2, ',', '.') ?>" disabled>
                                                        <input type="hidden" name="id_spp" class="form-control" value="<?= $data['nominal'] ?>">
                                                    </div>
                                                    <div class="mb-4">
                                                        <input type="hidden" name="jmlh_bl" value="<?= $data['jumlah_bayar'] ?>">
                                                        <label class="form-label">Jumlah Bayar</label>
                                                        <input type="text" name="jmlh_bb" class="form-control" oninput="formatCurrency(this)">
                                                    </div>

                                                    <script>
                                                        function formatCurrency(johan) {
                                                            // Mengambil nilai tanpa tanda ribuan
                                                            let value = johan.value.replace(/[^\d]/g, '');

                                                            // Memastikan bahwa value bukan string kosong
                                                            if (value != '') {
                                                                // Menambahkan tanda ribuan dengan menggunakan fungsi regex
                                                                value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

                                                                // Menetapkan nilai yang sudah diformat ke input
                                                                johan.value = value;
                                                            }
                                                        }
                                                    </script>

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