<?php 
session_start();
include '../koneksi.php';

if (!isset($_SESSION['log'])) {
    header('location:../index.php');
} else {
};
$nama = $_SESSION['nama'];
$id = $_GET['produk'];
$namabarang = mysqli_fetch_array(mysqli_query($conn, "select nama FROM tblbarang where kode='$id'"));



$jumlah_juli  = mysqli_fetch_array(mysqli_query($conn, "select jumlah FROM laporan_bulanan WHERE bulan='July'"));
$jumlah_agustus  = mysqli_fetch_array(mysqli_query($conn, "select jumlah FROM laporan_bulanan WHERE bulan='August'"));
$jumlah_september = mysqli_fetch_array(mysqli_query($conn, "select jumlah FROM laporan_bulanan WHERE bulan='September'"));
$jumlah_oktober = mysqli_fetch_array(mysqli_query($conn, "select jumlah FROM laporan_bulanan WHERE bulan='October'"));
$jumlah_november  = mysqli_fetch_array(mysqli_query($conn, "select jumlah FROM laporan_bulanan WHERE bulan='November'"));
$jumlah_desember  = mysqli_fetch_array(mysqli_query($conn, "select jumlah FROM laporan_bulanan WHERE bulan='December'"));

$juli = $jumlah_juli['jumlah']  ;
$agustus = $jumlah_agustus['jumlah'] ;


$september = $jumlah_september['jumlah'] ;
$oktober = $jumlah_oktober['jumlah'];
$november = $jumlah_november['jumlah'];
$desember = $jumlah_desember['jumlah'];
$ma_september = (($jumlah_juli['jumlah'] + $jumlah_agustus['jumlah'] ) /2);
$ma_oktober = ($jumlah_agustus['jumlah'] + $jumlah_september['jumlah'] ) /2;
$ma_november = ($jumlah_september['jumlah'] + $jumlah_oktober['jumlah'] ) /2;
$ma_desember = ($jumlah_oktober['jumlah'] + $jumlah_november['jumlah'] ) /2;
$ma_januari = ($jumlah_november['jumlah'] + $jumlah_desember['jumlah'] ) /2;
$ma_februari = ($jumlah_desember['jumlah'] + $ma_januari) / 2;
$ma_maret = ($ma_januari + $ma_februari) / 2;


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
    <title>PT. NIKI FOUR</title>


</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar" style="background-color: #0d6efd;;">
                <h1 class="sidebar-brand">
                    <i class="align-middle" data-feather="home" style="color:white;"></i> <span class="align-middle"
                        style="color:white;"> &nbsp;PT. METRO BAJA</span>
                </h1>

                <ul class="sidebar-nav">
                    <li class="sidebar-header" style="color:black;">
                        Pages
                    </li>

                    <li class="sidebar-item ">
                        <a class="sidebar-link" href="admin_home.php" style="background-color: #0d6efd;;color:white;">
                            <i class="align-middle" data-feather="sliders" style="color:black;"></i> <span
                                class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item ">
                        <a class="sidebar-link" href="user.php" style="background-color: #0d6efd;;color:white;">
                            <i class="align-middle" data-feather="user" style="color:black;"></i> <span
                                class="align-middle">Data User</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="barang.php" style="background-color: #0d6efd;;color:white;">
                            <i class="align-middle" data-feather="package" style="color:black;"></i> <span
                                class="align-middle">Data Material</span>
                        </a>
                    </li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="hitung3.php" style="background-color: #0d6efd;color:white;">
                            <i class="align-middle" data-feather="bar-chart-2" style="color:black;"></i> <span
                                class="align-middle">Hasil
                                Peramalan</span>
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
            <nav class="navbar navbar-expand navbar-light navbar-bg" style="background-color: #c1daff;">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center "></i>
                </a>

                <div class=" navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">



                        <li class="nav-item dropdown">

                            <a class="nav-link  d-none d-sm-inline-block" href="#">
                                <span class="text-drak">Hallo, <?php echo $nama ?>
                                    (<?php echo $_SESSION['role'] ?>)</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3"><strong>Peramalan Pendapatan </strong> <?php echo $namabarang['nama'] ?></h1>
                    <div class="card flex-fill">
                        <div class="container">
                            <div id="curve_chart" style="width: 100%; height: 500px "></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Hasil Peramalan</h5>
                                </div>
                                <div class="container">
                                    <table class="table table-hover my-0">
                                        <?php
                           
                           $x = 1;
                           $jumlah_x = 0;
                           $jumlah_y = 0;
                           $jumlah_xx = 0;
                           $jumlah_xy = 0;
                           $no =1;
                           $query = mysqli_query($conn, "select * from laporan_bulanan");
                           while ($data = mysqli_fetch_array($query)){
                               $jumlah_x += $x ;
                               $jumlah_y += $data['jumlah'];
                               $jumlah_xx += $x * $x;
                               $jumlah_xy += $x * $data['jumlah'];
                              $x++; } 
                  
                  
                  
                  //error ma
                   $pengurangan_september2 = abs($september - $ma_september);
                  $pengurangan_oktober2 = abs($oktober - $ma_oktober);
                  $pengurangan_november2 = abs($november - $ma_november);
                  $pengurangan_desember2 = abs($desember - $ma_desember);
                  
                  $msema_september = $pengurangan_september2 * $pengurangan_september2 ;
                  $msema_oktober = $pengurangan_oktober2 * $pengurangan_oktober2 ;
                  $msema_november = $pengurangan_november2 * $pengurangan_november2 ;
                  $msema_desember = $pengurangan_desember2 * $pengurangan_desember2 ;
                  
                 
                    $mapema_september = abs($pengurangan_september2 / ($september - 1)* 100 ); 
                
                     
                  $mapema_oktober = $pengurangan_oktober2 / $oktober * 100;
                  $mapema_november = $pengurangan_november2 / $november * 100;
                  $mapema_desember = $pengurangan_desember2 / $desember * 100;

                  
                  
                  $totalmda2 = ( $pengurangan_september2 + $pengurangan_oktober2 + $pengurangan_november2 + $pengurangan_desember2) / 4;
                  $totalmse2 = ($msema_september  + $msema_oktober + $msema_november + $msema_desember) / 4;
                  $totalmape2 = ($mapema_september + $mapema_oktober + $mapema_november + $mapema_desember ) / 4;
                  
                  //hitung exponetial
                  $F1 = $jumlah_y / 6 ;
                  $F2 = $F1 + 0.2 * ($juli - $F1);
                  $F3 = $F2 + 0.2 * ($agustus - $F2);
                  $F4 = $F3 + 0.2 * ($september - $F3);
                  $F5 = $F4 + 0.2 * ($oktober - $F4);
                  $F6 = $F5 + 0.2 * ($november - $F5);
                  $F7 = $F6 + 0.2 * ($desember - $F6);

                  //erro es
                 $pengurangan_juli = abs($juli - $F1);
                 $pengurangan_agustus = abs($agustus - $F2);
                 $pengurangan_september = abs($september - $F3);
                 $pengurangan_oktober = abs($oktober - $F4);
                 $pengurangan_november = abs($november - $F5);
                 $pengurangan_desember = abs($desember - $F6);

                 $msees_juli = abs($pengurangan_juli * $pengurangan_juli) ;
                 $msees_agustus = abs($pengurangan_agustus * $pengurangan_agustus) ;
                 $msees_september = abs($pengurangan_september * $pengurangan_september) ;
                 $msees_oktober = abs($pengurangan_oktober * $pengurangan_oktober) ;
                 $msees_november = abs($pengurangan_november * $pengurangan_november) ;
                 $msees_desember = abs($pengurangan_desember * $pengurangan_desember) ;
              
                 $mapees_juli = abs($pengurangan_juli / $juli* 100);   
                 $mapees_agustus = abs($pengurangan_agustus / $agustus* 100);   
                 $mapees_september = abs($pengurangan_september / $september* 100);    
                 $mapees_oktober = abs($pengurangan_oktober / $oktober* 100);   
                 $mapees_november = abs($pengurangan_november / $november* 100);   
                 $mapees_desember = abs($pengurangan_desember / $desember* 100);   

                 $totalmda = abs( $pengurangan_juli + $pengurangan_agustus + $pengurangan_september + $pengurangan_oktober + $pengurangan_november + $pengurangan_desember) / 6;
                 $totalmse = abs($msees_juli +   $msees_agustus + $msees_september  +$msees_oktober + $msees_november + $msees_desember) / 6;
                 $totalmape = abs( $mapees_juli + $mapees_agustus + $mapees_september + $mapees_oktober + $mapees_november + $mapees_desember ) / 6;

                          ?>
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Bulan</th>
                                                <th scope="col">Jumlah</th>
                                                <th scope="col">Single Exponential Smoothing</th>
                                                <th scope="col">Single Moving Averege</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td>Juli</td>
                                                <td><?php echo $juli ?></td>
                                                <td><?php echo Floor($F1) ?></td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td>Agustus</td>
                                                <td><?php echo $agustus ?></td>
                                                <td><?php echo Floor($F2) ?></td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td>September</td>
                                                <td><?php echo $september ?></td>
                                                <td><?php echo Floor($F3) ?></td>
                                                <td><?php echo Floor($ma_september) ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td>Oktober</td>
                                                <td><?php echo $oktober ?></td>
                                                <td><?php echo Floor($F4) ?></td>
                                                <td><?php echo Floor($ma_oktober) ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td>November</td>
                                                <td><?php echo $november ?>
                                                </td>
                                                <td><?php echo Floor($F5) ?></td>
                                                <td><?php echo Floor($ma_november) ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td>Desember</td>
                                                <td><?php echo $desember ?></td>
                                                <td><?php echo Floor($F6) ?></td>
                                                <td><?php echo Floor($ma_desember) ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td>Januari</td>
                                                <td>0</td>
                                                <td><?php echo Floor($F7) ?></td>
                                                <td><?php echo Floor($ma_januari) ?></td>
                                            </tr>

                                        </tbody>
                                    </table><br>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 col-xxl-3 d-flex">
                            <div class="card flex-fill w-100">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Hasil Error </h5>
                                </div>
                                <table class="table table-hover my-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Single Exponential Smoothing</th>
                                            <th scope="col">Single Moving Averege</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                            <td>MDA = <br><?php echo Floor($totalmda) ?></td>
                                            <td>MDA = <br><?php echo Floor($totalmda2) ?></td>
                                        </tr>
                                        <tr>
                                            <td>MSE = <br><?php echo Floor($totalmse) ?></td>
                                            <td>MSE = <br><?php echo Floor($totalmse2) ?></td>
                                        </tr>
                                        <tr>
                                            <td>MAPE = <br><?php echo Floor($totalmape) ?> %</td>
                                            <td>MAPE = <br><?php echo Floor($totalmape2) ?> %</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <nav>
                        <div class="card flex-fill">
                            <div class="container">
                                <br>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                        aria-selected="true">Proses Single Exponential Smoothing</button>
                                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-profile" type="button" role="tab"
                                        aria-controls="nav-profile" aria-selected="false">Proses Single
                                        Moving
                                        Averege</button>
                                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-contact" type="button" role="tab"
                                        aria-controls="nav-contact" aria-selected="false">Proses
                                        Error</button>
                                </div> <br>
                            </div>
                    </nav>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h3 class="card-title mb-0">Proses Single Exponential Smoothing</h3>
                                </div>
                                <br>
                                <div class="container">
                                    <table class="table table-hover my-0">
                                        <?php $no3 = 1; ?>
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Bulan</th>
                                                <th scope="col">Proses</th>
                                                <th scope="col">Hasil</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $no3++; ?></td>
                                                <td>Juli</td>
                                                <td>
                                                    <?php  echo "a = (2/jumlah n + 1)<br>a = (2 / 6 + 1) = 1.33 / dibulatkan menjadi 0.2 <br>F1 = Total Pendapatan Sebelumnya / Jumlah n <br> F1 = $jumlah_y : 6 =  $F1" ?>
                                                </td>
                                                <td><?php echo $F1 ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $no3++; ?></td>
                                                <td>Agustus</td>
                                                <td>
                                                    <?php  echo "F2 = F1 + a * (Pendapatan Juli - F1)<br>F2 = $F1 + 0.2 * ( $juli - $F1 ) =  $F2" ?>
                                                </td>
                                                <td><?php echo $F2 ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $no3++; ?></td>
                                                <td>September</td>
                                                <td>
                                                    <?php  echo "F3 = F2 + a * (Pendapatan Agustus - F2)<br>F3 = $F2 + 0.2 *( $agustus - $F2 ) =  $F3" ?>
                                                </td>
                                                <td><?php echo $F3 ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $no3++; ?></td>
                                                <td>Oktober</td>
                                                <td>
                                                    <?php  echo "F4 = F3 + a * (Pendapatan September - F3)<br>F4 = $F3 + 0.2 *( $september - $F3 ) =  $F4" ?>
                                                </td>
                                                <td><?php echo $F4 ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $no3++; ?></td>
                                                <td>November</td>
                                                <td>
                                                    <?php  echo "F5 = F4 + a * (Pendapatan Oktober - F4)<br>F5 = $F4 + 0.2 *( $oktober - $F4 ) =  $F5" ?>
                                                </td>
                                                <td><?php echo $F5 ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $no3++; ?></td>
                                                <td>Desember</td>
                                                <td>
                                                    <?php  echo "F6 = F5 + a * (Pendapatan November - F5)<br>F6 = $F5 + 0.2 *( $november - $F5 ) =  $F6" ?>
                                                </td>
                                                <td><?php echo $F6 ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $no3++; ?></td>
                                                <td>Januari</td>
                                                <td>
                                                    <?php  echo "F7 = F6 + a * (Pendapatan Desember - F6)<br>F7 = $F6 + 0.2 *( $desember - $F6 ) =  $F7" ?>
                                                </td>
                                                <td><?php echo $F7 ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h3 class="card-title mb-0">Proses Single Moving Averege</h3>
                                </div>
                                <br>
                                <div class="container">
                                    <table class="table table-hover my-0">
                                        <?php $no2 = 1; ?>
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Bulan</th>
                                                <th scope="col">Proses</th>
                                                <th scope="col">Hasil</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td><?php echo $no2++; ?></td>
                                                <td>September</td>
                                                <td>
                                                    <?php  echo "SMA = (Pendapatan Bulan Juli + Pendapatan Bulan Agustus) : 2 <br> = ( $juli + $agustus ) : 2 =  $ma_september" ?>
                                                </td>
                                                <td><?php echo $ma_september ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $no2++; ?></td>
                                                <td>Oktober</td>
                                                <td>
                                                    <?php  echo "SMA = (Pendapatan Bulan Agustus + Pendapatan Bulan September) : 2 <br> = ( $agustus + $september ) : 2 =  $ma_oktober" ?>
                                                </td>
                                                <td><?php echo $ma_oktober ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $no2++; ?></td>
                                                <td>November</td>
                                                <td>
                                                    <?php  echo "SMA = (Pendapatan Bulan September + Pendapatan Bulan Oktober) : 2 <br> = ( $september + $oktober ) : 2 =  $ma_november" ?>
                                                </td>
                                                <td><?php echo $ma_november ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $no2++; ?></td>
                                                <td>Desember</td>
                                                <td>
                                                    <?php  echo "SMA = (Pendapatan Bulan Oktober + Pendapatan Bulan November) : 2 <br> = ( $oktober + $november ) : 2 =  $ma_desember" ?>
                                                </td>
                                                <td><?php echo $ma_desember ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $no2++; ?></td>
                                                <td>Januari</td>
                                                <td>
                                                    <?php  echo "SMA = (Pendapatan Bulan November + Pendapatan Bulan Desember) : 2 <br> = ( $november + $desember ) : 2 =  $ma_januari" ?>
                                                </td>
                                                <td><?php echo $ma_januari ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>

                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h3 class="card-title mb-0">Proses Error Single Exponential Smoothing</h3>
                                </div>
                                <br>

                                <div class="container">
                                    <table class="table table-hover my-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Bulan</th>
                                                <th scope="col">Jumlah</th>
                                                <th scope="col">Single Exponential Smoothing</th>
                                                <th scope="col">Error MAD<br>(Jumlah - Single Exponential Smoothing)
                                                </th>
                                                <th scope="col">Error MSE<br>(Error MAD x Error MAD)</th>
                                                <th scope="col">Error MAPE<br>(Error MAD / Jumlah x 100 )</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $xE1 = 1;?>
                                            <tr>
                                                <td><?php echo $xE1++; ?></td>
                                                <td>Juli</td>
                                                <td><?php echo $juli ?></td>
                                                <td><?php echo $F1?></td>
                                                <td><?php echo $pengurangan_juli ?></td>
                                                <td><?php echo $msees_juli ?></td>
                                                <td><?php echo $mapees_juli?> %</td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $xE1++; ?></td>
                                                <td>Agustus</td>
                                                <td><?php echo $agustus ?></td>
                                                <td><?php echo $F2 ?></td>
                                                <td><?php echo $pengurangan_agustus ?></td>
                                                <td><?php echo $msees_agustus ?></td>

                                                <td><?php echo $mapees_agustus ?> %</td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $xE1++;?></td>
                                                <td>September</td>
                                                <td><?php echo $september ?></td>
                                                <td><?php echo $F3 ?></td>
                                                <td><?php echo $pengurangan_september ?></td>
                                                <td><?php echo $msees_september ?></td>

                                                <td><?php echo $mapees_desember ?> %</td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $xE1++;?></td>
                                                <td>Oktober</td>
                                                <td><?php echo $oktober ?></td>
                                                <td><?php echo $F4 ?></td>
                                                <td><?php echo $pengurangan_oktober ?></td>
                                                <td><?php echo $msees_oktober ?></td>
                                                <td><?php echo $mapees_oktober ?> %</td>

                                            </tr>
                                            <tr>
                                                <td><?php echo $xE1++; ?></td>
                                                <td>November</td>
                                                <td><?php echo $november ?>
                                                </td>
                                                <td><?php echo $F5 ?></td>
                                                <td><?php echo $pengurangan_november ?></td>
                                                <td><?php echo $msees_november ?></td>
                                                <td><?php echo $mapees_november?> %</td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $xE1++; ?></td>
                                                <td>Desember</td>
                                                <td><?php echo $desember ?></td>
                                                <td><?php echo $F6 ?></td>
                                                <td><?php echo $pengurangan_desember ?></td>
                                                <td><?php echo $msees_desember ?></td>
                                                <td><?php echo $mapees_desember ?> %</td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $xE1++; ?></td>
                                                <td>Januari</td>
                                                <td>0</td>
                                                <td><?php echo $F7 ?></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>Hasil Error (Jumlah Error / 6)</td>
                                                <td></td>
                                                <td></td>
                                                <td><?php echo $totalmda ?></td>
                                                <td><?php echo $totalmse ?></td>
                                                <td><?php echo $totalmape ?> %</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div>
                                        Hasil Error yang paling kecil hasil akhir angka errornya adalah yang lebih baik
                                        metodenya.
                                    </div><br>
                                </div>
                            </div>

                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h3 class="card-title mb-0">Proses Error Single Moving Averege</h3>
                                </div>
                                <div class="container">
                                    <table class="table table-hover my-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Bulan</th>
                                                <th scope="col">Jumlah</th>
                                                <th scope="col">Single Moving Averege</th>
                                                <th scope="col">Error MAD<br>(Jumlah - Single Moving Averege)</th>
                                                <th scope="col">Error MSE<br>(Error MAD x Error MAD)</th>
                                                <th scope="col">Error MAPE<br>(Error MAD / Jumlah x 100 )</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $xE2 = 1;?>
                                            <tr>
                                                <td><?php echo $xE2++; ?></td>
                                                <td>Juli</td>
                                                <td><?php echo $juli ?></td>
                                                <td>0</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $xE2++; ?></td>
                                                <td>Agustus</td>
                                                <td><?php echo $agustus ?></td>
                                                <td>0</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $xE2++; ?></td>
                                                <td>September</td>
                                                <td><?php echo $september ?></td>
                                                <td><?php echo $ma_september ?></td>
                                                <td><?php echo $pengurangan_september2 ?></td>
                                                <td><?php echo $msema_september ?></td>
                                                <td><?php echo $mapema_september ?> %</td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $xE2++; ?></td>
                                                <td>Oktober</td>
                                                <td><?php echo $oktober ?></td>
                                                <td><?php echo $ma_oktober ?></td>
                                                <td><?php echo $pengurangan_oktober2 ?></td>
                                                <td><?php echo $msema_oktober ?></td>
                                                <td><?php echo $mapema_oktober ?> %</td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $xE2++; ?></td>
                                                <td>November</td>
                                                <td><?php echo $november ?>
                                                </td>
                                                <td><?php echo $ma_november ?></td>
                                                <td><?php echo $pengurangan_november2 ?></td>
                                                <td><?php echo $msema_november?></td>
                                                <td><?php echo $mapema_november ?> %</td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $xE2++; ?></td>
                                                <td>Desember</td>
                                                <td><?php echo $desember ?></td>
                                                <td><?php echo $ma_desember ?></td>
                                                <td><?php echo $pengurangan_desember2 ?></td>
                                                <td><?php echo $msema_desember ?></td>
                                                <td><?php echo $mapema_desember ?> %</td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $xE2++; ?></td>
                                                <td>Januari</td>
                                                <td>0</td>
                                                <td><?php echo $ma_januari ?></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>Hasil Error (Jumlah Error / 4)</td>
                                                <td></td>
                                                <td></td>
                                                <td><?php echo $totalmda2 ?></td>
                                                <td><?php echo $totalmse2 ?></td>
                                                <td><?php echo $totalmape2 ?> %</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div>
                                        Hasil Error yang paling kecil hasil akhir angka errornya adalah yang lebih baik
                                        metodenya.
                                    </div><br>
                                </div>
                            </div>
                            <br><br>

                        </div>
                    </div>
                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a class="text-muted" target="_blank"><strong>PT. NIKI FOUR</strong></a> &copy;
                            </p>
                        </div>

                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="../assets/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    });
    $(document).ready(function() {
        $('#example1').DataTable();
    });
    </script>
    <script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Bulan', 'Pengeluaran Barang', 'Single Exponential Smoothing', '	Single Moving Averege'],
            ['Juli', <?php echo $juli;?>, <?php echo $F1;?>, null],
            ['Agustus', <?php echo $agustus;?>, <?php echo $F2;?>, null],
            ['September', <?php echo $september;?>, <?php echo $F3;?>, <?php echo $ma_september ?>],
            ['Oktober', <?php echo $oktober;?>, <?php echo $F4;?>, <?php echo $ma_oktober ?>],
            ['November', <?php echo $november;?>, <?php echo $F5;?>, <?php echo $ma_november ?>],
            ['Desember', <?php echo $desember;?>, <?php echo $F6;?>, <?php echo $ma_desember ?>],
            ['Januari', null, <?php echo $F7;?>, <?php echo $ma_januari ?>],


        ]);

        var options = {
            title: 'PT. METRO BAJA',
            curveType: 'function',
            legend: {
                position: 'bottom'
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
    }
    </script>
</body>

</html>