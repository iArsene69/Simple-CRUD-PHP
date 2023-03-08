<?php
include 'modul/gallery.php';

$galery = new Gallery($koneksi);

?>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="col">
						<h3 class="card-title">Data Galery</h3>
					</div>
					<div class="col text-right">
						<a href="#" class="btn btn-info btn-sm" data-toggle="modal"
							data-target="#modal-tambah">Tambah</a>
					</div>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Nama Foto</th>
								<th>Foto</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$tampil = $galery->tampilGallery();
							while ($data_galery = $tampil->fetch_object()) :
							?>
							<tr>
								<td><?= $data_galery->nama ?></td>
								<td width="40%"><img src="img/testi/<?= $data_galery->gambar ?>" class="img-thumbnail"
										width="20%">
								</td>
								<td width="15%" align="center"><a href="#" class="btn btn-sm btn-success ubah-galery"
										data-toggle="modal" data-target="#modal-ubah" data-id="<?= $data_galery->id ?>"
										data-nm="<?= $data_galery->nama ?>" data-ft="<?= $data_galery->gambar ?>"><i
											class="fa fa-pencil-alt" aria-hidden="true"></i></a> | <a href="#"
										class="btn btn-sm btn-danger btn-hapus" data-toggle="modal"
										data-target="#modal-hapus" data-id="<?= $data_galery->id ?>"><i
											class="fa fa-trash" aria-hidden="true"></i></a>
								</td>

							</tr>
							<?php
							endwhile;
							?>
						</tbody>

					</table>
				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
	</div>
</div>

<!-- modal tambah -->
<div class="modal fade" id="modal-tambah">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Galery</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" action="" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="card-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Nama Foto</label>
							<input type="text" class="form-control" id="namafoto" name="namafoto"
								placeholder="Masukkan Nama Foto">
						</div>
						<div class="form-group">
							<label for="exampleInputFile">Foto</label>
							<div class="input-group">
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="filefoto" name="filefoto">
									<label class="custom-file-label" for="exampleInputFile">Pilih file</label>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
					<button type="submit" id="submit" class="btn btn-primary btnsimpan" name="tambah"
						value="tambah">Simpan</button>
				</div>
			</form>
			<?php
			if (@$_POST['tambah']) {
				$nama = $koneksi->con->real_escape_string($_POST['namafoto']);

				$ekstensi = explode(".", $_FILES['filefoto']['name']);
				$namabaru = $nama . "." . end($ekstensi);
				$sumberfoto = $_FILES['filefoto']['tmp_name'];

				$upload = move_uploaded_file($sumberfoto, 'img/testi/' . $namabaru);
				if ($upload) {
					$galery->tambahGallery($nama, $namabaru);
					echo "<script>
						window.location='?pages=gallery';
						toastr.success('Tambah data Berhasil');
					</script>";
				} else {
					echo "<script>alert('Upload Gagal')</script>";
				}
			}
			?>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<!-- modal ubah -->
<div class="modal fade" id="modal-ubah">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Galery</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="card-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Nama Foto</label>
							<input type="hidden" id="idfoto" name="idfoto">
							<input type="text" class="form-control" id="namafoto" name="namafoto"
								placeholder="Masukkan Nama Foto">
						</div>
						<div class="form-group">
							<label for="exampleInputFile">Foto</label>
							<div class="input-group">
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="filefoto" name="filefoto">
									<label class="custom-file-label" for="exampleInputFile">Pilih file</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<img src="" alt="" id="gambar" class="img-thumbnail">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
					<button type="submit" id="rubah" class="btn btn-primary btnsimpan" name="rubah"
						value="simpan">Simpan</button>
				</div>
			</form>
			<?php

			?>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<!-- modal hapus -->
<div class="modal fade" id="modal-hapus">
	<div class="modal-dialog">
		<div class="modal-content bg-danger">
			<div class="modal-header">
				<h4 class="modal-title">Hapus Data</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" action="" enctype="multipart/form-data">
				<div class="modal-body">
					<input type="hidden" name="idfoto" id="idfoto">
					<p>Hapus Data?&hellip;</p>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
					<button type="submit" id="hapus" name="hapus" value="hapus"
						class="btn btn-outline-light btnHapus">Hapus</button>
				</div>
			</form>
			<?php
			if (@$_POST['hapus']) {
				$idfoto = $_POST['idfoto'];
				if ($idfoto != '') {
					$fotoAwal = $galery->tampilGallery($idfoto)->fetch_object()->gambar;
					unlink('img/galery/' . $fotoAwal);
					$galery->hapusGallery("DELETE FROM `gallery` WHERE id='$idfoto'");
					echo "<script>window.location='?pages=gallery';</script>";
				}
			}
			?>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<script src="plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
$(document).on('click', '.ubah-galery', function() {
	var idfoto = $(this).data('id');
	var nama = $(this).data('nm');
	var foto = $(this).data('ft');

	$('#modal-ubah #idfoto').val(idfoto);
	$('#modal-ubah #namafoto').val(nama);
	$('#modal-ubah #gambar').attr("src", "img/testi/" + foto);
})

$(document).ready(function(e) {
	$('#form').on('submit', function(e) {
		e.preventDefault();
		$.ajax({
			url: 'modul/ubahgal.php',
			type: 'POST',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(pesan) {
				$('.table').html(pesan);
			}
		});
	});

})

$(document).on('click', '.btn-hapus', function() {
	var idfoto = $(this).data('id');
	$('#modal-hapus #idfoto').val(idfoto);
})
</script>