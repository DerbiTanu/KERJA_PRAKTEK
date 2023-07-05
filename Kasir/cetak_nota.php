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

     <title>cetak nota</title>
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
                 <p size="4">Jl.Puspitek Raya No.83 , Buaran Kec.Serpong Kota Tangerang Selatan Banten</p>
             </center>
             <center>
                 <p>Dicetak pada tanggal <?php echo date('d-M-Y') ; ?> jam <?php
date_default_timezone_set('Asia/Jakarta');
echo date(' H:i:s'); 
?> oleh
                     <?php echo $nama ; ?> sebagai <?php echo $_SESSION['role'] ; ?> </p>
             </center>
             <hr>
             <width="100" height="75"><br>
                 </hr>
                 <?php 
    $nota=$_GET['nota'];
    $query=mysqli_query($conn, "select penjualan.nonota,detailpenjualan.kode,tblbarang.nama,
    detailpenjualan.harga,detailpenjualan.jumlah,detailpenjualan.subtotal
    from detailpenjualan,penjualan,tblbarang
    where penjualan.nonota=detailpenjualan.nonota and tblbarang.kode=detailpenjualan.kode
    and detailpenjualan.nonota='$nota'");
    $nomor=mysqli_fetch_array(mysqli_query($conn, "select * from penjualan where nonota='$nota'")); ?>
                 <div class="row">
                     <div class="col-3">
                         <label for="inputEmail4" class="form-label">Nota</label>
                         <input type="text" class="form-control" value="<?php echo $nomor['nonota'] ?>" placeholder="
                             First name" aria-label="First name" disabled>
                     </div>
                     <div class="col-3">
                         <label for="inputEmail4" class="form-label">Tanggal</label>
                         <input type="text" class="form-control" value="<?php echo $nomor['tanggal'] ?>"
                             placeholder="Last name" aria-label="Last name" disabled>
                     </div>
                 </div>

                 <br />
                 <br />

                 <table class='table table-hover'>
                     <thead>
                         <tr>
                             <td>Kode Barang</td>
                             <td>Nama</td>
                             <td>Harga</td>
                             <td>Jumlah</td>
                             <td>Subtotal</td>
                         </tr>
                     </thead><?php
        while($r=mysqli_fetch_row($query)){ ?>
                     <tr>
                         <td><?php echo $r[1] ?></td>
                         <td><?php echo $r[2] ?></td>
                         <td><?php echo rupiah($r[3]) ?></td>
                         <td><?php echo $r[4] ?></td>
                         <td><?php echo rupiah($r[5]) ?></td>
                     </tr><?php
        }
        ?><tr>
                         <td colspan='4'>
                             <h4 align='right'>Total</h4>
                         </td>
                         <td colspan='5'>
                             <h4><?php echo rupiah($nomor['total']) ?></h4>
                         </td>
                     </tr>
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