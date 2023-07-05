<?php 
session_start();
include '../koneksi.php';

if (!isset($_SESSION['log'])) {
    header('location:../index.php');
} else {
};
$nama = $_SESSION['nama'];

$query=mysqli_query($conn, "select * from penjualan ORDER BY nonota DESC");
function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="../assets/img/icons/icon-48x48.png" />
    <link href="../assets/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <script src="js/jquery.js"></script>
    <script src="js/jquery.ui.datepicker.js"></script>
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/cover/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>PT. METRO BAJA</title>
    <script>
    //mendeksripsikan variabel yang akan digunakan
    var nota;
    var tanggal;
    var kode;
    var nama;
    var harga;
    var jumlah;
    var stok;
    $(function() {
        //meload file pk dengan operator ambil barang dimana nantinya
        //isinya akan masuk di combo box
        $("#kode").load("pk.php", "op=ambilbarang");

        //meload isi tabel
        $("#barang").load("pk.php", "op=barang");

        //mengkosongkan input text dengan masing2 id berikut
        $("#nama").val("");
        $("#harga").val("");
        $("#jumlah").val("");
        $("#stok").val("");

        //jika ada perubahan di kode barang
        $("#kode").change(function() {
            kode = $("#kode").val();

            //tampilkan status loading dan animasinya
            $("#status").html("loading. . .");
            $("#loading").show();

            //lakukan pengiriman data
            $.ajax({
                url: "proses.php",
                data: "op=ambildata&kode=" + kode,
                cache: false,
                success: function(msg) {
                    data = msg.split("|");

                    //masukan isi data ke masing - masing field
                    $("#nama").val(data[0]);
                    $("#harga").val(data[1]);
                    $("#stok").val(data[3]);
                    $("#jumlah").focus();
                    //hilangkan status animasi dan loading
                    $("#status").html("");
                    $("#loading").hide();
                }
            });
        });

        //jika tombol tambah di klik
        $("#tambah").click(function() {
            kode = $("#kode").val();
            stok = $("#stok").val();
            jumlah = $("#jumlah").val();
            if (kode == "Kode Barang") {
                alert("Kode Barang Harus diisi");
                exit();
            } else if (jumlah < 1) {
                alert("Jumlah beli tidak boleh 0");
                $("#jumlah").focus();
                exit();
            }
            nama = $("#nama").val();
            harga = $("#harga").val();


            $("#status").html("sedang diproses. . .");
            $("#loading").show();

            $.ajax({
                url: "pk.php",
                data: "op=tambah&kode=" + kode + "&nama=" + nama + "&harga=" + harga +
                    "&jumlah=" + jumlah,
                cache: false,
                success: function(msg) {
                    if (msg == "sukses") {
                        $("#status").html("Berhasil disimpan. . .");
                    } else {
                        $("#status").html("ERROR. . .");
                    }
                    $("#loading").hide();
                    $("#nama").val("");
                    $("#harga").val("");
                    $("#jumlah").val("");
                    $("#stok").val("");
                    $("#kode").load("pk.php", "op=ambilbarang");
                    $("#barang").load("pk.php", "op=barang");
                }
            });
        });

        //jika tombol proses diklik
        $("#proses").click(function() {
            nota = $("#nota").val();
            tanggal = $("#tanggal").val();

            $.ajax({
                url: "pk.php",
                data: "op=proses&nota=" + nota + "&tanggal=" + tanggal,
                cache: false,
                success: function(msg) {
                    if (msg == 'sukses') {
                        $("#status").html('Pesanan Pembelian berhasil');
                        alert('Pesanan Berhasil');
                        window.location.reload();

                    } else {
                        $("#status").html('Pesanan Gagal');
                        alert('Pesanan Gagal');
                        exit();
                    }
                    $("#kode").load("pk.php", "op=ambilbarang");
                    $("#barang").load("pk.php", "op=barang");
                    $("#loading").hide();
                    $("#nama").val("");
                    $("#harga").val("");
                    $("#jumlah").val("");
                    $("#stok").val("");
                }
            })
        })
    });
    </script>

</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar" style="background-color: #0d6efd;">
                <h1 class="sidebar-brand">
                    <i class="align-middle" data-feather="home" style="color:white;"></i> <span class="align-middle"
                        style="color:white;"> &nbsp;PT. METRO BAJA</span>
                </h1>

                <ul class="sidebar-nav">
                    <li class="sidebar-header" style="color:black;">
                        Pages
                    </li>

                    <li class="sidebar-item ">
                        <a class="sidebar-link" href="kasir_home.php" style="background-color: #0d6efd;color:white;">
                            <i class="align-middle" data-feather="sliders" style="color:black;"></i> <span
                                class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="kasir_transaksi.php?page=penjualan&act=tambah"
                            style="background-color: #0d6efd;color:white;">
                            <i class="align-middle" data-feather="shopping-cart" style="color:black;"></i> <span
                                class="align-middle">Tambah Pesanan</span>
                        </a>
                    </li>
                    <li class="sidebar-item ">
                        <a class="sidebar-link" href="kasir_transaksi.php"
                            style="background-color: #0d6efd;color:white;">
                            <i class="align-middle" data-feather="clipboard" style="color:black;"></i> <span
                                class="align-middle">Data Pesanan</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="kasir_produk.php" style="background-color: #0d6efd;color:white;">
                            <i class="align-middle" data-feather="package" style="color:black;"></i> <span
                                class="align-middle">Data Material</span>
                        </a>
                    </li>


                </ul>

                <div class="sidebar-cta">
                    <div class="sidebar-cta-content" style="background-color: #0d6efd">
                        <div class="d-grid">
                            <a href="../logout.php" class="btn btn-light">Log out</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg" style="background-color: #c1daff">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">



                        <li class="nav-item dropdown">

                            <a class="nav-link  d-none d-sm-inline-block" href="#">
                                <span class="text-dark">Hallo, <?php echo $nama ?>
                                    (<?php echo $_SESSION['role'] ?>)</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">

                    <h4 class=" mb-3"><strong>Data</strong> Pesanan</h6><br>


                        <?php
                $no = 1;
                $p=isset($_GET['act'])?$_GET['act']:null;
                switch($p){
                    default: ?>

                        <div class="card "><br>

                            <div class="card-body">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href='?page=penjualan&act=tambah' class='btn btn-primary'>Tambah Pesanan</a>
                                    <a href='cetak_transaksi.php' class='btn btn-primary'>Cetak Laporan</a>
                                </div>
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>No. Nota</td>
                                            <td>Tanggal</td>
                                            <td>Jumlah</td>
                                            <td>Tools</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                            
                            while($r=mysqli_fetch_array($query)){
                            ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $r['nonota'] ?></td>
                                            <td><?php echo $r['tanggal'] ?></td>
                                            <td><?php echo rupiah($r['total'])?></td>
                                            <td><a class="btn btn-primary"
                                                    href="cetak_nota.php?nota=<?php echo $r['nonota'] ?>">Cetak
                                                    Nota</a></td>
                                        </tr><?php
                            } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <?php
                        
                        break;
                    case "tambah":
                        $tgl=date('Y-m-d');
                        //untuk autonumber di nota
                        $query = mysqli_query($conn, "SELECT max(nonota) as kodeTerbesar FROM penjualan");
                        $data = mysqli_fetch_array($query);
                           $kodeBarang = $data['kodeTerbesar'];
                           $urutan = (int) substr($kodeBarang, 3, 3);
                           $urutan++;
                           $huruf = "BRG";
                           $kodeBarang = $huruf . sprintf("%03s", $urutan);
                           
                        echo "  
                        <br>
                        <div class='card '>
                        <div class='card-body'>
                        <div class='row'>
                            <div class='col'>
                            <label for='nputEmail4' class='form-label'>No. Nota</label>
                                    <input type='text' id='nota' value='$kodeBarang' class='form-control' placeholder='First name' aria-label='First name' disabled>
                            </div>
                            <div class='col'>
                            <label for='nputEmail4' class='form-label'>Tanggal</label>
                                     <input type='text' id='tanggal' value='$tgl' class='form-control' placeholder='First name' aria-label='First name'>
                            </div>
                        </div><br>";
                            
                            echo'<legend>Pesanan Penjualan</legend><br>
                        
                            <div class="card alert-warning">
                            <div class="card-body">
                            <div class="row g-3">
                            <div class="col-md-3">
                                <label for="inputState" class="form-label">Nama Barang</label>
                                <select id="kode" class="form-select">
                                <option selected>Choose...</option>
                                <option>...</option>
                                </select>
                                </div>
                                
                            <div class="col-3">
                            <label for="inputState" class="form-label">Harga</label>
                                <input type="text" id="harga" class="form-control" placeholder="Harga" aria-label="First name" disabled>
                            </div>
                            <input type="hidden" id="nama" class="form-control" placeholder="First name" aria-label="First name" disabled>
                            <div class="col-3">
                            <label for="inputState" class="form-label">Stok Saat Ini</label>
                                <input type="text" id="stok"  class="form-control" placeholder="Stok" aria-label="First name" disabled>
                            </div>
                            <div class="col-3">
                            <label for="inputState" class="form-label">Jumlah Yang Dibeli</label>
                                <input type="text" id="jumlah" class="form-control" placeholder="Jumlah" aria-label="First name">
                            </div>
                            <button class="btn btn-primary" id="tambah" type="submit">Tambah</button>
                            </div></div></div>
                            <br>


                            
                            
                            <div class="card">
                            <div class="card-body">
                            <table id="barang" class="table table-striped" style="width:100%">
                                    
                            </table>
                            <div class="form-actions">
                            <button class="btn btn-primary" id="proses" type="submit">Proses</button>
                            </div></div>  
                            </div></div></div>';
                        break;
                    case "detail":
                        echo "<legend>Nota Penjualan</legend>";
                        $nota=$_GET['nota'];
                        $query=mysqli_query($conn, "select penjualan.nonota,detailpenjualan.kode,tblbarang.nama,
                                           detailpenjualan.harga,detailpenjualan.jumlah,detailpenjualan.subtotal
                                           from detailpenjualan,penjualan,tblbarang
                                           where penjualan.nonota=detailpenjualan.nonota and tblbarang.kode=detailpenjualan.kode
                                           and detailpenjualan.nonota='$nota'");
                        $nomor=mysqli_fetch_array(mysqli_query($conn, "select * from penjualan where nonota='$nota'"));
                        echo "<div class='navbar-form pull-left'>
						      Nota : <input type='text' value='$nomor[nonota]' disabled>
                                <input type='text' value='$nomor[tanggal]' disabled>
                            </div>";
						echo "<br/>";
						echo "<br/>";
						echo "<br/>";
                        echo "<table class='table table-hover'>
                                <thead>
                                    <tr>
                                        <td>Kode Barang</td>
                                        <td>Nama</td>
                                        <td>Harga</td>
                                        <td>Jumlah</td>
                                        <td>Subtotal</td>
                                    </tr>
                                </thead>";
                                while($r=mysqli_fetch_row($query)){
                                    echo "<tr>
                                            <td>$r[1]</td>
                                            <td>$r[2]</td>
                                            <td>$r[3]</td>
                                            <td>$r[4]</td>
                                            <td>$r[5]</td>
                                        </tr>";
                                }
                                echo "<tr>
                                        <td colspan='4'><h4 align='right'>Total</h4></td>
                                        <td colspan='5'><h4>$nomor[total]</h4></td>
                                    </tr>
                                    </table>";
                        break;
                }
                ?>


                        <footer class="footer">
                            <div class="container-fluid">
                                <div class="row text-muted">
                                    <div class="col-6 text-start">
                                        <p class="mb-0">
                                            <a class="text-muted" target="_blank"><strong>PT. METRO BAJA</strong></a>
                                            &copy;
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </footer>
                </div>
        </div>

        <script src="../assets/js/app.js"></script>
        <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        });
        $(document).ready(function() {
            $('#barang').DataTable();
        });
        </script>

</body>

</html>