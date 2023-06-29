<?php 
include 'koneksi.php'; 
$barang = mysqli_query($koneksi,"SELECT * FROM barang");
$jsArray = "var harga = new Array();\n";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Latihan Transaksi Sederhana</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<center>
<body>
<div class="container">
<h3>Membuat Transaksi Sederhana</h3><br>
<form method="post" action="proses_transaksi.php">
	<label>Nama Barang</label>
	<select name="nama_barang" onchange="ketikaPilih(this.value)">
		<option>- Pilih -</option>
		<?php if (mysqli_num_rows($barang)) { ?>
			<?php while ($row_brg = mysqli_fetch_array($barang)) { ?>
				<option value="<?= $row_brg['nama_barang'] ?>"><?= $row_brg['nama_barang'] ?></option>
				<?php $jsArray .= "harga['".$row_brg['nama_barang']."'] = {harga:'".addslashes($row_brg['harga'])."'};\n";?>
		<?php } } ?>
	</select>
	<label>Harga</label>
	<input type="text" name="harga" id="harga">
	<label>Qty</label>
	<input type="text" name="qty">
	<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
</form>
<hr>
<a href="cetak.php" target="_blank">Cetak Transaksi</a>
<br><br>
<table border="1" width="100%" class="table table-bordered">
	<thead>
		<th>No</th>
		<th>Nama Barang</th>
		<th>Harga Satuan</th>
		<th>Qty</th>
		<th>Total</th>
	</thead>
	<?php
	$nomor = 1;
	$total_bayar = 0;
	$data = mysqli_query($koneksi,"SELECT * FROM t_transaksi");
	while($d = mysqli_fetch_array($data)){
		$total = $d['harga'] * $d['jumlah'];
		$total_bayar += $total;
	?>
	<tbody>
		<td><?= $nomor++; ?></td>
		<td><?= $d['nama_barang'] ?></td>
		<td><?= number_format($d['harga']) ?></td>
		<td><?= $d['jumlah'] ?></td>
		<td><?= number_format($total)?></td>
	</tbody>
	<?php } ?>
	<tr>
	<th colspan="4">Total Bayar</th>
	<th><?= number_format($total_bayar); ?></th>
	</tr>
</table>
</div>
</form>

<script type="text/javascript">
	<?= $jsArray;?>
	function ketikaPilih(id_barang) {
		document.getElementById('harga').value = harga[id_barang].harga;
	}
</script>
</body>
</html>