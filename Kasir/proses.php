<?php
include "../koneksi.php";
$data=mysqli_query($conn, "select * from tblbarang");
$op=isset($_GET['op'])?$_GET['op']:null;
function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}

if($op=='kode'){
    echo"<option>Kode Barang</option>";
    while($r=mysqli_fetch_array($data)){
        echo "<option value='$r[kode]'>$r[kode]</option>";
    }
}elseif($op=='barang'){
    echo'
    <a href="?page=barang&act=tambah" class="btn btn-primary">Tambah Barang</a><br><br>
    <table id="example1" class="table table-striped" style="width:100%">
    <thead class="thead-dark">
        <tr>
        <td>Kode Barang</td>
        <td>Nama Barang</td>
        <td>Harga Beli</td>
        <td>Harga Jual</td>
        <td>Stok</td>
        </tr>
    </thead>
    <tbody>';
  
	while ($b=mysqli_fetch_array($data)){
        $h_beli = rupiah($b['hrg_beli']);
        $h_beli = rupiah($b['hrg_jual']);
        echo"<tr>
                <td>$b[kode]</td>
                <td>$b[nama]</td>
                <td>$h_beli</td>
                <td>$h_beli</td>
                <td>$b[stok]</td>
            </tr>";
        }
    echo " </tbody>
    </table>";
}elseif($op=='ambildata'){
    $kode=$_GET['kode'];
    $dt=mysqli_query($conn, "select * from tblbarang where kode='$kode'");
    $d=mysqli_fetch_array($dt);
    echo $d['nama']."|".$d['hrg_beli']."|".$d['hrg_jual']."|".$d['stok'];
}elseif($op=='cek'){
    $kd=$_GET['kd'];
    $sql=mysqli_query($conn, "select * from tblbarang where kode='$kd'");
    $cek=mysqli_num_rows($sql);
    echo $cek;
}elseif($op=='update'){
    $kode=$_GET['kode'];
    $nama=htmlspecialchars($_GET['nama']);
    $beli=htmlspecialchars($_GET['beli']);
    $jual=htmlspecialchars($_GET['jual']);
    $stok=htmlspecialchars($_GET['stok']);
    
    $update=mysqli_query($conn, "update tblbarang set nama='$nama',
                        hrg_beli='$beli',
                        hrg_jual='$jual',
                        stok='$stok'
                        where kode='$kode'");
    if($update){
        echo "Sukses
        
        "
        ;
    }else{
        echo "ERROR. . .";
    }
}elseif($op=='delete'){
    $kode=$_GET['kode'];
    $del=mysqli_query($conn, "delete from tblbarang where kode='$kode'");
    if($del){
        echo "sukses";
    }else{
        echo "ERROR";
    }
}elseif($op=='simpan'){
    $kode=$_GET['kode'];
    $nama=htmlspecialchars($_GET['nama']);
    $jual=htmlspecialchars($_GET['jual']);
    $beli=htmlspecialchars($_GET['beli']);
    $stok=htmlspecialchars($_GET['stok']);
    
    $tambah=mysqli_query($conn, "insert into tblbarang (kode,nama,hrg_beli,hrg_jual,stok)
                        values ('$kode','$nama','$beli','$jual','$stok')");
    if($tambah){
        echo "sukses";
    }else{
        echo "error";
    }
}
?>