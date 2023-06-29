<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cetak</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<center>
<body>
	<h1>Toko Sederhana</h1>
	<p>Jln. Gandawijaya No. 11 | (022) 66172888 </p>
	<b>Tanggal : <?= date('d-m-Y'); ?> </b>
<table border="1" width="100%" class="table table-bordered">
	<thead>
		<td>No</td>
		<td>Nama Barang</td>
		<td>Harga Satuan</td>
		<td>Qty</td>
		<td>Total</td>
	</thead>
	<?php
	$nomor = 1;
	$total_bayar = 0;
	include 'koneksi.php'; 
	$data = mysqli_query($koneksi, "SELECT * FROM t_transaksi");
	while ($d = mysqli_fetch_array($data)) {
		$total = $d['jumlah'] * $d['harga'];
		$total_bayar += $total;
	?>
	<tbody>
		<td><?php echo $nomor++ ?></td>
		<td><?php echo $d['nama_barang'];?></td>
		<td><?php echo number_format($d['harga']);?></td>
		<td><?php echo $d['jumlah'];?></td>
		<td><?php echo number_format($total); ?></td>
	</tbody>
	<?php } ?>
	<tr>
	<th colspan="4">Total Bayar</th>
	<th><?php echo 'Rp ', number_format($total_bayar); ?></th>
	</tr>
</table>
<p align="right">Nama Petugas</p>
</body>
</html>

<script>
window.print();
</script>