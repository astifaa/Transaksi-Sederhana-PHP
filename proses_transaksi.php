<?php 
// koneksi database
include 'koneksi.php';

// simpan data
$nb = $_POST['nama_barang'];
$hrg = $_POST['harga'];
$qty = $_POST['qty'];

// menginput data ke database
mysqli_query($koneksi, "INSERT INTO t_transaksi (nama_barang, harga, 
jumlah) VALUES ('$nb', '$hrg', '$qty')");

// mengalihkan halaman kembali ke transaksisederhana.php
header("location:transaksisederhana.php");
?>