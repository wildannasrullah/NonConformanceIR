<?php
error_reporting(0);
session_start();
$d=date('d');$m=date('m');$y=date('y');
include('../../config/koneksi.php');
include("../../config/fungsi_ribuan.php");
include("../../config/fungsi_indotgl.php");
//qr
include "phpqrcode/qrlib.php"; //<-- LOKASI FILE UTAMA PLUGINNYA
 
$tempdir = "temp/"; //<-- Nama Folder file QR Code kita nantinya akan disimpan
if (!file_exists($tempdir))#kalau folder belum ada, maka buat.
    mkdir($tempdir);
?>
<?php
$a = mysqli_query($conn, "select *from tb_suratjalan sj left join tb_suratjaland sjd on sj.no_surat_jalan=sjd.no_surat_jalan where sj.no_surat_jalan='$_GET[no_jln]' order by sj.no_surat_jalan desc");
$r = mysqli_fetch_array($a);
$user = mysqli_query($conn, "select *from pengelola p left join departemen d on p.id_dep=d.id_dep where p.username='$_SESSION[username]'");
$dep = mysqli_fetch_array($user);
$variable_s = 6;
echo"
<table border='0' width='100%' cellspacing='0'>
<tr>
	<td colspan='3' width='35%'><img src='logo2.png' width='75%'></td><td width='30%' valign=middle><font size='2'>DIKIRIM KE:</font></td><td  colspan='2' valign='middle'><h3>S U R A T  &nbsp;J A L A N</h3></td>
</tr>
<tr>
	<td colspan='3' valign=middle><font size='2'>JL. RUNGKUT INDUSTRI III NO. 19<BR>+62 31 8438182</font></td><td width='30%' valign='top' colspan='2'><font size='2'>$r[alamat_customer]</font></td>
</tr>
<tr><td colspan='5'></td></tr>
<tr><td width='10%'><font size='2'>No. PO</font></td><td width='1%'>:</td><td colspan='3'><font size='2'>$r[no_po]</font></td></tr>
<tr><td colspan='5' valign=top><hr style='border:0;border-top:3px double black'></td></tr>
</table>
<table width='100%' border='0' cellspacing='0'>
<tr><td width='10%'><font size='2'>No Bukti</font></td><td width='1%'>:</td><td width='25%'><font size='2'>
";
if($dep[id_dep]==$variable_s){
	if($r[no_gid]==""){
		echo $r[no_surat_jalan];
	}else{
		
	echo $r[no_gid];
	}
}else{
	echo $r[no_surat_jalan];
}
echo"
</font></td><td width='15%'><font size='2'>Customer</font></td><td width='1%'>:</td><td> <font size='2'>$r[nama_customer]</font></td><td width='8%'><font size='2'>NoPol</font></td><td width='1%'>:</td><td width='10%'> <font size='2'>$r[nopol_kendaraan]</font></td></tr>
<tr><td><font size='2'>No. SO</font></td><td>:</td><td><font size='2'>$r[no_so]</font></td><td><font size='2'>Tanggal </font></td><td width='1%'>:</td><td> <font size='2'>".tgl_indo($r[tanggal_kirim])."</font></td></tr>
<tr><td><font size='2'>COA</font></td><td>:</td><td><font size='2'>$r[coa]</font></td><td><font size='2'>Keterangan</font></td><td>:</td><td><font size='2'>$r[keterangan]</font></td></tr>
</table>";
?>
										
                            <table width='100%' height='90px' rules="rows" style='margin-top:5px'>
                                <thead>
                                    <tr>
                                        <th align='center' height='20px'><font size='2'>No. </font></th>
                                        <th align='center'><font size='2'>Nama Barang</font></th>
                                        <th align='center'><font size='2'>Jumlah</font></th>
                                        <th align='center'><font size='2'>Satuan</font></th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								$no=1;
								$a1 = mysqli_query($conn, "select *from tb_suratjaland where no_surat_jalan = '$_GET[no_jln]'");
								while($r1 = mysqli_fetch_array($a1)){
								echo"
                                    <tr>
										<td width='2%' align='center' height='20px'><font size='2'>$no. </font></td>
                                        <td width='45%'><font size='2'>$r1[nama_barang]</font></td>
                                        <td width='10%' align='center'><font size='2'>".ribu($r1[jumlah])."</font></td>
                                        <td width='10%' align='center'><font size='2'>".strtoupper($r1[satuan])."</font></td>
                                    </tr>
									";
									$no++;
									$jum=$jum+$r1[jumlah];
									$f = strtoupper($r1[satuan]);
									}
									$tot = $jum;
									$satuan = $f;
									echo"<tr>
											<td colspan='4'>&nbsp;</td>
										</tr>";
									echo"<tr>
											<td colspan='2'><font size='2'> <b>GRAND TOTAL QUANTITY</b></font></td><td align='center'><font size='2'> ".ribu($tot)."</font></td><td align='center'><font size='2'>$satuan </font></td>
										</tr>";
								?>
                                </tbody>
                            </table>
							
							<?php
							$pe = mysqli_query($conn, "select *from pengelola where username = '$r[created_by]'");
							$pengirim = mysqli_fetch_array($pe);
							echo"
<table border='0' width='100%' cellspacing='0' style='margin-top:5px>
<tr>
<td width='40%' rowspan='3' valign='top'>
<table border='0' width='100%' cellspacing='0' style='margin-top:5px'>
<tr><td valign='top'><font size='1.7' align='justify'>1.</font></td><td><font size='1.8' align='justify'>Segala bentuk complaint dan atau reject dapat kami terima max 7 (tujuh) hari setelah barang diterima.</font></td>
	<td height='20px' align='center' width='15%'><b><font size='2'>Penerima</font></b></td><td height='20px' align='center' width='15%'><b><font size='2'>Satpam</font></b></td><td height='20px' align='center' width='15%'><b><font size='2'>Pengemudi</font></b></td><td height='20px' align='center' width='15%'><b><font size='2'>Pengirim</font></b></td>
</tr>
<tr><td valign='top'><font size='1.7' align='justify'>2.</font></td><td><font size='1.8' align='justify'>Hasil analisa complaint dan atau reject dari customer, akan diterbitkan max 7 (tujuh) hari kerja setelah barang reject diterima oleh Krisanthium.</font></td></tr>
<tr><td valign='top'><font size='1.7' align='justify'>3.</font></td><td><font size='1.8' align='justify'>Penggantian barang reject dapat dilakukan setelah dikonfirmasi oleh tim QC Krisanthium.</font></td>
	<td align='center'><font size='2'>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</font></td>
	<td align='center'><font size='2'>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</font></td>
	<td align='center'><font size='2'>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</font></td>
	<td align='center'><font size='2'>( $pengirim[fullname] )</font></td>
</tr>

</table>
</td>


</table>
<table border='0' width='100%' style='margin-top:5px' height='5%'>
<tr>
<td align='left' valign='top'>
";
$isi_teks = "No. :".$_GET[no_jln]."\n Qty: ".$tot." ".$satuan;
$namafile = $_GET[no_jln].$tot.".png";
$quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
$ukuran = 5; //batasan 1 paling kecil, 10 paling besar
$padding = 0;
 
QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);

							?><img src='temp/<?php echo $_GET[no_jln].$tot;?>.png' width='25%'>
<?php
echo"
</td>
<td align='right' valign='top'><b><font size='2'>QF.KOP-PD-8.5.1-001 REV:00</font></b><br><font size='1'><i>This is computer generated delivery order at $r[created_date], by $r[created_by]</font></i></td>
</tr>
</table>
";
?>
                        
<script>
		window.load = print_d();
		function print_d(){
			window.print();
		}
	</script>
	<script>
		window.load = print_dd();
		function print_dd(){
			window.print();
		}
	</script>
<?php
$p = mysqli_fetch_array(mysqli_query($conn, "select jum_print from tb_suratjalan where no_surat_jalan = '$_GET[no_jln]'"));
$jp = ($p[jum_print]+1);
$st = mysqli_query($conn, "update tb_suratjalan set status_printed='Printed', jum_print='$jp', alasan_reprint = '$_GET[reprint]' where no_surat_jalan = '$_GET[no_jln]'");
?>