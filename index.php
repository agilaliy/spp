<?php
include 'koneksi.php';
if (empty($_SESSION['user'])) {
	header('location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<title> SPP -
		<?php
		$page = isset($_GET['page']) ? $_GET['page'] : 'Dashboard';
		$cek = preg_replace('/-/', ' ', $page);
		$title = ucwords($cek);
		echo $title;
		?>
	</title>
	<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.php">
					<span class="align-middle">Pembayaran SPP</span>
				</a>
				<?php
				if (!empty($_SESSION['user']['level']) && !empty($_SESSION['user']['level'] == 'admin')) {

				?>
					<ul class="sidebar-nav">
						<li class="sidebar-header">
							Halaman
						</li>

						<li class="sidebar-item 
					<?php
					if (empty($_GET['page'])) {
						echo 'active';
					}
					?>">
							<a class="sidebar-link" href="index.php">
								<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
							</a>
						</li>

						<li class="sidebar-item 
					<?php
					if ($page == 'petugas') {
						echo 'active';
					}
					?>">
							<a class="sidebar-link" href="?page=petugas">
								<i class="align-middle" data-feather="user"></i> <span class="align-middle">Petugas</span>
							</a>
						</li>

						<li class="sidebar-item
					<?php
					if ($page == 'kelas') {
						echo 'active';
					}
					?>
					">
							<a class="sidebar-link" href="?page=kelas">
								<i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Kelas</span>
							</a>
						</li>

						<li class="sidebar-item
					<?php
					if ($page == 'siswa' || $page == 'history-siswa') {
						echo 'active';
					}
					?>
					">
							<a class="sidebar-link" href="?page=siswa">
								<i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Siswa</span>
							</a>
						</li>

						<li class="sidebar-item
					<?php
					if ($page == 'spp') {
						echo 'active';
					}
					?>
					">
							<a class="sidebar-link" href="?page=spp">
								<i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">SPP</span>
							</a>
						</li>

						<li class="sidebar-item
					<?php
					if ($page == 'laporan') {
						echo 'active';
					}
					?>
					">
							<a class="sidebar-link" href="?page=laporan">
								<i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Laporan</span>
							</a>
						</li>
					</ul>
					<div class="sidebar-cta">
						<div class="sidebar-cta-content">
							<div class="d-grid">
								<button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#tambahtransaksi">+ Tambah Transaksi</button>
							</div>
						</div>
					</div>
				<?php

				} elseif (!empty($_SESSION['user']['level']) && !empty($_SESSION['user']['level'] == 'petugas')) {
				?>
					<ul class="sidebar-nav">
						<li class="sidebar-header">
							Halaman
						</li>

						<li class="sidebar-item 
					<?php
					if (empty($_GET['page'])) {
						echo 'active';
					}
					?>">
							<a class="sidebar-link" href="index.php">
								<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
							</a>
						</li>

						<li class="sidebar-item
					<?php
					if ($page == 'siswa' || $page == 'history-siswa') {
						echo 'active';
					}
					?>
					">
							<a class="sidebar-link" href="?page=siswa">
								<i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Siswa</span>
							</a>
						</li>

						<li class="sidebar-item
					<?php
					if ($page == 'laporan') {
						echo 'active';
					}
					?>
					">
							<a class="sidebar-link" href="?page=laporan">
								<i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Laporan</span>
							</a>
						</li>
					</ul>
					<div class="sidebar-cta">
						<div class="sidebar-cta-content">
							<div class="d-grid">
								<button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#tambahtransaksi">+ Tambah Transaksi</button>
							</div>
						</div>
					</div>
				<?php
				} else {
				?>
					<ul class="sidebar-nav">
						<li class="sidebar-header">
							Halaman
						</li>

						<li class="sidebar-item 
					<?php
					if (empty($_GET['page'])) {
						echo 'active';
					}
					?>">
							<a class="sidebar-link" href="index.php">
								<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">History</span>
							</a>
						</li>
					</ul>
				<?php
				}
				?>


			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">

						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
								<i class="align-middle" data-feather="settings"></i>
							</a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">

							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="logout.php">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

					<?php
					$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
					include $page . '.php';
					?>

				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>AdminKit</strong></a> - <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>Bootstrap Admin
										Template</strong></a> &copy;
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>



	<script src="js/app.js"></script>
	<!-- MODAL TAMBAH -->
	<div class="modal fade" id="tambahtransaksi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<div class="col-12">
						<big><a href="" data-bs-dismiss="modal"><i class="bi bi-arrow-left" style="float: left; color: black;"></i></a></big>
						<div class="text-center">
							<h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Transaksi</h1>
						</div>
					</div>
				</div>

				<form method="post" action="crud/pembayaran.php">
					<div class="modal-body">
						<div class="row">
							<div class="mb-4">
								<label class="form-label">Nama Siswa</label>
								<select name="nisn" class="form-select">
									<?php
									$query = mysqli_query($koneksi, "SELECT * FROM siswa");
									while ($siswa = mysqli_fetch_array($query)) {
									?>
										<option value="<?php echo $siswa['nisn'] ?>"><?php echo $siswa['nama'] ?></option>
									<?php
									}
									?>
								</select>
							</div>
							<input type="hidden" name="tgl_bayar" class="form-control" value="<?php echo date('Y-m-d') ?>">
							<input type="hidden" name="bln_bayar" class="form-control" value="<?php echo date('F') ?>">
							<input type="hidden" name="thn_bayar" class="form-control" value="<?php echo date('Y') ?>">
							<div class="mb-4">
								<label class="form-label">SPP</label>
								<select name="id_spp" class="form-select">
									<?php
									$query = mysqli_query($koneksi, "SELECT * FROM spp");
									while ($spp = mysqli_fetch_array($query)) {
									?>
										<option value="<?php echo $spp['id_spp'] ?>"><?php echo $spp['tahun'] ?> - Rp. <?php echo number_format($spp['nominal'], 2, ',', '.') ?></option>
									<?php
									}
									?>
								</select>
							</div>
							<div class="mb-4">
								<label class="form-label">Jumlah Bayar</label>
								<input type="text" name="jmlh_bayar" class="form-control" oninput="formatCurrency(this)">
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


</body>

</html>