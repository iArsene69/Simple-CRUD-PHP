<?php
include 'modul/kelas.php';

$kelas = new Kelas($koneksi);

error_reporting(0);
?>


<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="col">
						<h3 class="card-title">Data Kelas</h3>
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
								<th>Nama Kelas</th>
								<th>Deskripsi</th>
								<th>Cover</th>
								<th>Edit</th>
							</tr>
						</thead>
						<tbody>
							<?php
                            $tampil = $kelas->tampilKelas();
                            while ($data_kelas = $tampil->fetch_object()):
                            ?>
							<tr>
								<td>
									<?= $data_kelas->nama ?>
								</td>
								<td>
									<?= $data_kelas->deskripsi ?>
								</td>
								<td width="40%"><img src="img/cover/<?= $data_kelas->foto ?>" class="img-thumbnail"
										width="20%">
								</td>
								<td width="15%" align="center"><a href="#" class="btn btn-sm btn-success ubah-kelas"
										data-toggle="modal" data-target="#modal-ubah" data-id="<?= $data_kelas->id ?>"
										data-nm="<?= $data_kelas->nama ?>" data-ft="<?= $data_kelas->foto ?>"><i
											class="fa fa-pencil-alt" aria-hidden="true"></i></a> | <a href="#"
										class="btn btn-sm btn-danger btn-hapus" data-toggle="modal"
										data-target="#modal-hapus" data-id="<?= $data_kelas->id ?>"><i
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
				<h4 class="modal-title">Tambah Kelas</h4>
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
							<label>Deskripsi</label>
							<textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="Tulis Deskripsi...">Tulis Deskripsi...</textarea>
						</div>
						<div class="form-group">
							<label for="exampleInputFile">Foto</label>
							<div class="input-group">
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="filefoto" name="filefoto">
									<label class="custom-file-label" for="exampleInputFile">Pilih file</label>
								</div>
								<!-- <div class="input-group-append">
									<span class="input-group-text">Upload</span>
								</div> -->
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
					<button type="submit" id="submit" class="btn btn-primary btnsimpan" name="tambah"
						value="simpan">Simpan</button>
				</div>
			</form>
			<?php
            if (@$_POST['tambah']) {
	            $nama = $koneksi->con->real_escape_string($_POST['namafoto']);
	            $deskripsi = $koneksi->con->real_escape_string($_POST['deskripsi']);
	            $eksteni = explode('.', $_FILES['filefoto']['name']);
	            $namabaru = $nama . '.' . end($eksteni);
	            $sumberfile = $_FILES['filefoto']['tmp_name'];
	            $upload = move_uploaded_file($sumberfile, 'img/cover/' . $namabaru);

	            if ($upload) {
		            $kelas->tambahKelas($nama, $deskripsi, $namabaru);
		            //header('Location: ?pages=kelas');
            		echo "<script>window.location='?pages=kelas';</script>";
	            } else {
		            echo "<script>alert('upload gagal');</script>";
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
				<h4 class="modal-title">Edit Kelas</h4>
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
							<label>Deskripsi</label>
							<textarea class="form-control" name="ubahdes" id="ubahdes" placeholder="Tulis Deskripsi..."></textarea>
						</div>
						<div class="form-group">
							<label for="exampleInputFile">Foto</label>
							<div class="input-group">
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="filefoto" name="filefoto">
									<label class="custom-file-label" for="exampleInputFile">Pilih file</label>
								</div>
								<!-- <div class="input-group-append">
									<span class="input-group-text">Upload</span>
								</div> -->
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
				<div class="modal-body" sumberfile>
					<input type="hidden" name="idfoto" id="idfoto">
					<p>Hapus Cover&hellip;</p>
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
		            $fotoAwal = $kelas->tampilKelas($idfoto)->fetch_object()->foto;
		            unlink('img/cover/' . $fotoAwal);
		            $kelas->hapusKelas("DELETE FROM class WHERE id='$idfoto'");
		            //header('location:?pages=kelas');
            		echo "<script>window.location='?pages=kelas';</script>";
	            }
            }
            ?>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>

<script>
  $(function () {
    // Summernote
    $('#deskripsi').summernote()
	$('#ubahdes').summernote()

    // // CodeMirror
    // CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
    //   mode: "htmlmixed",
    //   theme: "monokai"
    // });
  })
</script>

<script type="text/javascript">
	$(document).on('click', '.ubah-kelas', function () {
		var idfoto = $(this).data('id');
		var nama = $(this).data('nm');
		var deskripsi = $(this).data('ds');
		var foto = $(this).data('ft');

		$('#modal-ubah #idfoto').val(idfoto);
		$('#modal-ubah #namafoto').val(nama);
		$('#modal-ubah #deskripsi').val(deskripsi);
		$('#modal-ubah #gambar').attr("src", "img/cover/" + foto);
	})

	$(document).ready(function (e) {
		$('#form').on('submit', function (e) {
			e.preventDefault();
			$.ajax({
				url: 'modul/ubah.php',
				type: 'POST',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				success: function (pesan) {
					$('.table').html(pesan);
				}
			});
		});

	})

	$(document).on('click', '.btn-hapus', function () {
		var idfoto = $(this).data('id');
		$('#modal-hapus #idfoto').val(idfoto);
	})
</script>