<?php
include "../koneksi.php";
$op=isset($_GET['op'])?$_GET['op']:null;
function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}
if($op=='ambilbarang'){
    $data=mysqli_query($conn, "select * from tblbarang");
    echo '<option selected>Pilih Barang...</option>';
    while($r=mysqli_fetch_array($data)){
        echo "<option value='$r[kode]'>$r[nama]</option>";
    }
}elseif($op=='ambildata'){
    $kode=$_GET['kode'];
    $dt=mysqli_query($conn, "select * from tblbarang where kode='$kode'");
    $d=mysqli_fetch_array($dt);
    echo $d['nama']."|".$d['hrg_jual']."|".$d['stok'];
}elseif($op=='barang'){
    $brg=mysqli_query($conn, "select * from tblsementara");
    echo "<thead>
            <tr>
                <td>Kode Barang</td>
                <td>Nama</td>
                <td>Harga</td>
                <td>Jumlah Beli</td>
                <td>Subtotal</td>
                <td>Tools</td>
            </tr>
        </thead>";
    $total=mysqli_fetch_array(mysqli_query($conn, "select sum(subtotal) as total from tblsementara"));
    while($r=mysqli_fetch_array($brg)){
        $harga_1 = rupiah($r['harga']);
        $sub_1 = rupiah($r['subtotal']);
        $sub_2 = rupiah($total['total']);
        echo "<tr>
                <td>$r[kode]</td>
                <td>$r[nama]</td>
                <td> $harga_1</td>
                <td><input type='text' name='jum' value='$r[jumlah]' class='span2'></td>
                <td> $sub_1</td>
                <td><a href='pk.php?op=hapus&kode=$r[kode]' id='hapus'>Hapus</a></td>
            </tr>";
    }
    echo "<tr>
        <td colspan='3'>Total</td>
        <td colspan='4'>$sub_2</td>
    </tr>";
}elseif($op=='tambah'){
    $kode=$_GET['kode'];
    $nama=$_GET['nama'];
    $harga=$_GET['harga'];
    $jumlah=$_GET['jumlah'];
    $subtotal=$harga*$jumlah;
    
    $tambah=mysqli_query($conn, "INSERT into tblsementara (kode,nama,harga,jumlah,subtotal)
                        values ('$kode','$nama','$harga','$jumlah','$subtotal')");
    
    if($tambah){
        echo "sukses";
    }else{
        echo "ERROR";
    }
}elseif($op=='hapus'){
    $kode=$_GET['kode'];
    $del=mysqli_query($conn, "delete from tblsementara where kode='$kode'");
    if($del){
        echo "<script>window.location='kasir_transaksi.php?page=penjualan&act=tambah';</script>";
    }else{
        echo "<script>alert('Hapus Data Berhasil');
            window.location='kasir_transaksi.php?page=penjualan&act=tambah';</script>";
    }
}elseif($op=='proses'){
    $nota=$_GET['nota'];
    $tanggal=$_GET['tanggal'];
    $to=mysqli_fetch_array(mysqli_query($conn, "select sum(subtotal) as total from tblsementara"));
    $tot=$to['total'];
    $simpan=mysqli_query($conn, "insert into penjualan(nonota,tanggal,total)
                        values ('$nota','$tanggal','$tot')");
    if($simpan){
        $query=mysqli_query($conn, "select * from tblsementara");
        while($r=mysqli_fetch_row($query)){
            mysqli_query($conn, "insert into detailpenjualan(nonota,tanggal,kode,harga,jumlah,subtotal)
                        values('$nota','$tanggal','$r[0]','$r[2]','$r[3]','$r[4]')");
            mysqli_query($conn, "update tblbarang set stok=stok-'$r[3]'
                        where kode='$r[0]'");
        }
        //hapus seluruh isi tabel sementara
        mysqli_query($conn, "truncate table tblsementara");
        echo "sukses";
    }else{
        echo "ERROR";
    }
}
?>