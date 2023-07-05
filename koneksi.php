<?php 


// isi nama host, username mysql, dan password mysql anda
$conn = mysqli_connect("localhost", "root", "", "produk_matrial");
if (!$conn) {
	echo "Mohon maaf anda gagal terhubung ke database";
} else {
};
?>