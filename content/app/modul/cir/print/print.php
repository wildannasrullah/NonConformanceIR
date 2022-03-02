<?php
error_reporting(0);
session_start();
$d=date('d');$m=date('m');$y=date('y');
include('../../../../../config/koneksi.php');

include("../../../../../config/fungsi_ribuan.php");
include("../../../../../config/fungsi_indotgl.php");


$jk = mysqli_query($conn, "select *from mjeniskoreksi where idKoreksi IN ('1','2','3','4','5') order by idKoreksi ASC");
$a = mysqli_query($conn, "select *from cir_customer where codeCustCare = '$_GET[code]'");
$r = mysqli_fetch_array($a);
$cc = mysqli_query($conn, "select *from cir_correction_imm where codeCustCare='$_GET[code]';");
$c2 = mysqli_fetch_array($cc);
$query = "select *from cir_correction_type where codeCustCare = '$_GET[code]' AND CreatedBy = '$c2[createdBy]';";
$sq = mysqli_query($conn, $query);
$aa = mysqli_query($conn, "select *from cir_verifikasi where codeCustCare='$_GET[code]'");
$ap = mysqli_fetch_array($aa);
$verby = mysqli_fetch_array(mysqli_query($conn, "select *from muser where username = '$ap[verifiedBy]'"));
$w = mysqli_query($conn, "CALL SP_simKOP('$r[GID]')");
$g = mysqli_fetch_array($w);


$u = mysqli_fetch_array(mysqli_query($conn, "select *from muser where username = '$r[createdBy]'"));
$u1 = mysqli_fetch_array(mysqli_query($conn, "select *from muser where username = '$r[approvedBy]'"));
$u2 = mysqli_fetch_array(mysqli_query($conn, "select *from muser where username = '$r[CreatedBy]'"));
$u3 = mysqli_fetch_array(mysqli_query($conn, "select *from muser where username = '$r[ApprovedBy]'"));
echo"
<table border='1' width='100%' cellspacing='0'>
<tr>
	<td width='25%' align='center'>
		<img src='logo2.png' width='75%' >
		<br><font size='2'>Jl. Rungkut Industri III / 19<BR>Surabaya 60293</font>
	</td>
	<td width='45%' align='center' >
		<b><font size='4'><u>CUSTOMER INFORMATION REPORT</u></font></b>
	</td>
</tr>

<tr>
	<td colspan='3'>
		<table width='100%' cellspacing='0'>
		<tr>
			<td width='15%' colspan='9'><font size='2'>&nbsp;Kategori :</font></td>
		</tr>
		<tr>
			<td width='10%'></td><td width='36%'><b>$r[status]</b></td><td width='15%' colspan='5'><font size='2'>&nbsp;<b>No</b></font></td><td width='1%'>:</td><td  width='35%'>&nbsp;$r[codeCustCare]</td>
		</tr>
		<tr>
			<td width='10%'></td><td width='36%'></td><td width='5%' colspan='5'><font size='2'>&nbsp;<b>Tanggal</b></font></td><td>:</td><td>&nbsp;".tgl_indo($r[tgl_lapor])."</td>
		</tr>
	</td>
</tr>
</table>

<hr>
<table width='100%' cellspacing='0'>
	
		<tr><td width='1%'><font size='2'>1.&nbsp;</font></td><td width='10%'><font size='2'>Perusahaan</font></td><td width='1%'>:</td><td width='30%'>$r[companyName]</td></tr>
		<tr><td width='1%'><font size='2'>2.&nbsp;</font></td><td width='10%'><font size='2'>Email Pelanggan</font></td><td width='1%'>:</td><td width='30%'>$r[info_via]</td></tr>
		<tr><td width='1%'><font size='2'>3.&nbsp;</font></td><td width='10%'><font size='2'>Informasi Pelanggan</font></td><td width='1%'>:</td><td width='30%'>$r[customerInfo]</td></tr>
	
</table>
<hr>
<table width='100%' cellspacing='2'>
<tr><td width='100%' colspan='5'><font size='2'>Data-data Keluhan / Pujian :</font></td></tr>
<tr><td width='100%' colspan='5'></td></tr><tr><td width='100%' colspan='5'></td></tr><tr><td width='100%' colspan='5'></td></tr>
<tr>
	<td width='15%'><font size='2'>1. Nama Barang</font></td>
		<td width='1%'>:</td>
		<td width='30%'><font size='2'>".strtoupper($r[productName])."</font></td>
</tr>
<tr>
	<td><font size='2'>2. Kode Desain</font></td>
		<td>:</td>
		<td  colspan='2'><font size='2'>$g[materialcode]</font>
		</td>
</tr>
<tr>
	<td><font size='2'>3. Status</font></td>
		<td>:</td>
		<td  colspan='2'><font size='2'>$r[status]</font>
		</td>
</tr>
<tr>
	<td><font size='2'>4. Jumlah Kerusakan</font></td>
		<td>:</td>
		<td><font size='2'>$r[jumKerusakan] PCS</font></td>
</tr>
<tr>
	<td><font size='2'>5. Kode Produksi</font></td>
	<td>:</td>
	<td><font size='2'>$g[sodocno]</font></td>
</tr>
<tr>
	<td><font size='2'>6. Tanggal Kirim</font></td>
		<td>:</td>
		<td><font size='2'>$g[docdate]</font></td>
</tr>
<tr>
	<td><font size='2'>7. Jumlah Kirim</font></td>
		<td>:</td>
		<td><font size='2'>$g[qtydelivered]</font></td>
</tr>
<tr>
	<td><font size='2'>8. No. Surat Jalan</font></td>
		<td>:</td>
		<td><font size='2'>$r[GID]</font></td>
</tr>
<tr>
	<td><font size='2'>9. No. Work Order</font></td>
		<td>:</td>
		<td><font size='2'>$g[information]</font></td>
</tr>
</table>";
?>
										
                            
							<hr>
	<table width='100%'>
	<tr><td  colspan='5'><font size='2'><u>Tindakan Koreksi :</u></font></td></tr>
	<tr><td   colspan='5'><font size='2'><u></u></font></td></tr>
	<tr><td  colspan='5' align='center'> 
	 <?php
			$cek_user = array();
			while($row = mysqli_fetch_assoc($sq)) {
					$cek_user [ $row['jenis_koreksi'] ] = $row['jenis_koreksi'];
			}
            foreach($cek_user as $kode=>$cu) {
						$check_list[]=$cu;
			}  
			$checked= $check_list;
while($j = mysqli_fetch_array($jk)){
	$checked= $check_list;
	?>
	<input type='checkbox' name='jenis_koreksi[]' value="<?php echo $j[jenisKoreksi]; ?>" style='height:20px;width:20px;background-color:white' <?php in_array ($j[jenisKoreksi], $checked) ? print "checked" : ""; ?>>&nbsp;<?php echo $j[jenisKoreksi];?>&nbsp;&nbsp;
<?php
} 
	?>
	</tr>
	<tr><td colspan='5'><font size='2'><u>Root Cause :</u></font></td></tr>
		<tr><td colspan='5' height='50px' valign='top'><font size='2'><?php echo $c2[rootCause]; ?></font></td></tr>
	<tr><td colspan='5'><font size='2'><u>Corrective Action :</u></font></td></tr>
		<tr><td colspan='5' height='50px' valign='top'><font size='2'><?php echo $c2[correctiveAct]; ?></font></td></tr>
	
	
	</table>
    <hr>
	<br>
	<table width='100%' style='margin-top:5px'>
	<tr><td width='20%'><font size='2'>Status :</font></td><td colspan='3' valign='top'  width='40%'><font size='2'><?php echo strtoupper($ap[statusKasus]); ?></font></td>
		<td width='20%'><font size='2'></font></td><td colspan='3' valign='top'  width='40%'><font size='2'></font></td></tr>
	<tr><td width='20%'><font size='2'>Tanggal verifikasi :</font></td><td colspan='3' valign='top'  width='30%'><font size='2'><?php echo $ap[verifiedDate]; ?></font></td>
		<td width='15%'><font size='2'>Diverifikasi oleh :</font></td><td colspan='3' valign='top'  width='40%'><font size='2'><?php echo $verby[fullName]; ?></font></td></tr>
	</table>
	<hr /><br>
	<table width='100%' style='margin-top:5px'>
                                <thead>
                                    <tr><td width='10%'></td>
                                        <td width='50%' align='left'><font size='2'>Dibuat Oleh :<br>
																					  <br><br><br><br>Nama     :<br>
																					  Tanggal	:<br>
										<u>Sales & Shipping Staff</u></font><br></td>
                                        <td width='50%' align='left'><font size='2'>Mengetahui :<br>
																					  <br><br><br><br>Nama     :<br>
																					  Tanggal	:<br>
										<u>Marketing Chief</u></font><br></td>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								echo"
									";
									
								?>
								<tr><td colspan='5'><font size='2'><br></font></td></tr>
                                </tbody>
                            </table>
	<table width='100%'>
	<tr><td align='left'><font size='2'><i></i></font><td><td align='right'><font size='2'><i></i></font><td></tr>
	<tr><td align='left'><font size='2'>QF.KOP-MK-8.2.1-001 REV : 01</font><td><td align='right'><font size='2'><i></i></font><td></tr>
	</table>
	
<script>
		window.load = print_d();
		function print_d(){
			window.print();
		}
</script>