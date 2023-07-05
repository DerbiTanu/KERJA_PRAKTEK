<?php 
session_start();
include '../koneksi.php';

if (!isset($_SESSION['log'])) {
    header('location:login.php');
} else {
};

$nama = $_SESSION['nama'];

$query=mysqli_query($conn, "select * from penjualan");
function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Laporan</title>
</head>

<body>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <br>
        &nbsp; &nbsp; <a href="kasir_transaksi.php">Kembali</a>
        <div class="container"></br></br>
            <h1>
                <center>
                    <p size="4">PT. METRO BAJA</p>
                </center>
            </h1>
            <center>
                <p size="4">Jl.Puspitek Raya No.83 , Buaran Kec.Serpong Kota Tangerang Selatan Banten
                </p>
            </center>
            <center>
                <p>Dicetak pada tanggal  <?php echo date('d-M-Y') ; ?> jam <?php
date_default_timezone_set('Asia/Jakarta');
echo date(' H:i:s'); ?> oleh
                    <?php echo $nama ; ?> sebagai <?php echo $_SESSION['role'] ; ?> </p>
            </center>
            <hr>
            <width="100" height="75"><br>
                </hr>


                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>No. Nota</td>
                            <td>Tanggal</td>
                            <td>Jumlah</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                            $query=mysqli_query($conn, "select * from penjualan");
                            while($r=mysqli_fetch_array($query)){
                            ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $r['nonota'] ?></td>
                            <td><?php echo $r['tanggal'] ?></td>
                            <td><?php echo rupiah($r['total'])?></td>
                        </tr><?php
                            } ?>
                    </tbody>
                </table>
        </div>
    </body>

    </html>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
    window.print();
    </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>