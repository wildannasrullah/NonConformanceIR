<?php
error_reporting(0);
session_start();
$d=date('d');$m=date('m');$y=date('y');
include('../../../../../config/koneksi.php');

include("../../../../../config/fungsi_ribuan.php");
include("../../../../../config/fungsi_indotgl.php");

$a = mysqli_query($conn, "select *from ncar ni left join ncar_correction nc on ni.ncarCode=nc.ncarCode left join ncar_correction_type nct on nc.idCorNcar=nct.idCorNcar  left join departemen d on ni.idDepart=d.idDepart where nc.idCorNcar='$_GET[coir]'");
$r = mysqli_fetch_array($a);
$aud = mysqli_fetch_array(mysqli_query($conn, "select *from muser where username = '$r[auditor]'"));
$aue = mysqli_fetch_array(mysqli_query($conn, "select *from muser where username = '$r[auditee]'"));

$u = mysqli_fetch_array(mysqli_query($conn, "select *from muser where username = '$r[createdBy]'"));
$u1 = mysqli_fetch_array(mysqli_query($conn, "select *from muser where username = '$r[approvedBy]'"));
$u2 = mysqli_fetch_array(mysqli_query($conn, "select *from muser where username = '$r[CreatedBy]'"));
$u3 = mysqli_fetch_array(mysqli_query($conn, "select *from muser where username = '$r[ApprovedBy]'"));
echo"
<table border='1' width='100%' cellspacing='0'>
<tr>
	<td width='25%' align='center' rowspan='2'>
		<img src='logo2.png' width='75%' >
		<br><font size='2'>Jl. Rungkut Industri III / 19<BR>Surabaya 60293</font>
	</td>
	<td width='45%' align='center' rowspan='2'>
		<b><font size='2.6'><u>NON CONFORMANCE AUDIT REPORT</u></font><br><font size='2'>Laporan Ketidaksesuaian Audit</font></b>
	</td>
	<td valign='middle'>
		<h5>No. NCAR : <br>$r[ncarCode]</h5>
	</td>
</tr>
<tr>
	<td valign='middle'>
		<h5>TANGGAL AUDIT: <br>".tgl_indo($r[tanggal_audit])."</h5>
	</td>
</tr>
</table>
<table border='1' width='100%' cellspacing='0'>
<tr>
	<td colspan='3'>
	<table width='100%' border='0' cellspacing='0'>
	<tr>
		<td width='10%'><font size='2'><br></font></td><td width='1%'></td><td width='36%'><font size='2'></font></td>
	</tr>
	<tr>
		<td width='10%'><font size='2'>&nbsp;Departemen/Bagian</font></td><td width='1%'>:</td><td width='36%'><font size='2'>&nbsp; $r[departName]</font></td>
	</tr>
	<tr>
		<td width='10%'><font size='2'>&nbsp;Dokumen Acuan</font></td><td width='1%'>:</td><td width='36%' colspan='5'><font size='2'>&nbsp; $r[dokAcuan]</font></td>
	</tr>
	</td>
</tr>
</table>
<hr>
<table width='100%' border='0' cellspacing='2'>
<tr><td width='100%' colspan='5'><font size='2'><b>Ketidaksesuaian :</b></font></td></tr>
<tr><td width='100%' colspan='5'></td></tr><tr><td width='100%' colspan='5'></td></tr>
<tr>
	<td width='10%'><font size='2'>Objektif</font></td>
		<td width='1%'>:</td>
		<td width='30%'><font size='2'>$r[objektif]</font></td>
</tr>
<tr>
	<td><font size='2'>Lokasi</font></td>
		<td>:</td>
		<td  colspan='2'><font size='2'>$r[lokasi] </font>
		</td>
</tr>
<tr>
	<td><font size='2'>Referensi</font></td>
		<td rowspan='2'>:</td>
		<td  colspan='2' rowspan='2'><font size='2'>$r[referensi]</font>
		</td>
</tr>
<tr>
	<td><font size='2'>&nbsp;</font></td>
</tr>
<tr>
	<td><font size='2'>Penjelasan</font></td>
		<td rowspan='2'>:</td>
		<td colspan='2' rowspan='2'><font size='2'>$r[penjelasan]</font></td>
</tr>
<tr>
	<td><font size='2'>&nbsp;</font></td>
</tr>
</table>

	<tr>
	<td width='25%'><input type='radio' style='height:0px;width:0px;border: 0px solid black;' name='kategori' value='Observasi' checked><b><font size='3'> Kategori</font></b>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td colspan='2'>";
			  if($r[kategori]=='Observasi'){
                echo"<input type='radio' style='height:15px;width:15px;border: 20px solid black;' name='kategori' value='Observasi' checked><b><font size='3'> Observasi</font></b>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type='radio' style='height:15px;width:13px;border: 20px solid black;' name='kategori' value='Minor'><b><font size='3'> Minor</font></b>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type='radio' style='height:15px;width:13px;border: 20px solid black;' name='kategori' value='Major'><b><font size='3'> Major</font></b>";
				}
				else if($r[kategori]=='Minor'){
                echo"<input type='radio' style='height:15px;width:13px;border: 20px solid black;' name='kategori' value='Observasi' ><b><font size='3'> Observasi</font></b>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type='radio' style='height:15px;width:13px;border: 20px solid black;' name='kategori' value='Minor' checked><b><font size='3'> Minor</font></b>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type='radio' style='height:15px;width:13px;border: 20px solid black;' name='kategori' value='Major'><b><font size='3'> Major</font></b>";
				}
				else if($r[kategori]=='Major'){
                echo"<input type='radio' style='height:15px;width:13px;border: 20px solid black;' name='kategori' value='Observasi' ><b><font size='3'> Observasi</font></b>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type='radio' style='height:15px;width:13px;border: 20px solid black;' name='kategori' value='Minor' ><b><font size='3'> Minor</font></b>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type='radio' style='height:15px;width:13px;border: 20px solid black;' name='kategori' value='Major' checked><b><font size='3'> Major</font></b>";
				}else{
					 echo"<input type='radio' style='height:15px;width:13px;border: 20px solid black;' name='kategori' value='Observasi' ><b><font size='3'> Observasi</font></b>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type='radio' style='height:15px;width:13px;border: 20px solid black;' name='kategori' value='Minor' ><b><font size='3'> Minor</font></b>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type='radio' style='height:15px;width:13px;border: 20px solid black;' name='kategori' value='Major'><b><font size='3'> Major</font></b>";
				}
	$cc = mysqli_fetch_array(mysqli_query($conn, "select *from ncar_correction where ncarCode = '$_GET[no]'"));		
echo"</td>
	</tr>

	<tr>
		<td width='50%'><font size='2'>Auditor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: $aud[fullName]</font></td>
		<td width='50%' colspan='2'><font size='2'>Auditee&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: $aue[fullName]</font></td>
	</tr>
	<tr>
		<td width='50%'><font size='2'>Tanggal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ".tgl_indo($r[tanggal_auditor])."</font></td>
		<td width='50%' colspan='2'><font size='2'>Tanggal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ".tgl_indo($r[tanggal_auditee])."</font></td>
	</tr>
	<tr>
		<td width='50%' ><font size='2'>Tanda Tangan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: $aud[fullName]</font></td>
		<td width='50%' colspan='2'><font size='2'>Tanda Tangan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: $aue[fullName]</font></td>
	</tr>

";
?>
<tr>
<td colspan='4'>
	<table width='100%'>
	<tr><td  colspan='5'><font size='2'><u>Correction :</u></font></td></tr>
	<tr><td   colspan='5'><font size='2'><u></u></font></td></tr>
	<tr><td  colspan='5' align='left'>
	<?php
		$query = "select *from ncar_correction_type where idCorNcar = '$_GET[coir]'";
			$sq = mysqli_query($conn, $query);
			$cek_user = array();
			while($row = mysqli_fetch_assoc($sq)) {
					$cek_user [ $row['jenisCor'] ] = $row['jenisCor'];
			}
            foreach($cek_user as $kode=>$cu) {
						$check_list[]=$cu;
			}  
			$checked= $check_list;
$jk = mysqli_query($conn, "select *from mjeniskoreksi where idKoreksi IN ('6','7','8') order by idKoreksi ASC");
while($j = mysqli_fetch_array($jk)){
	$checked= $check_list;
	?>
	<input type='checkbox' name='jenis_koreksi[]' value="<?php echo $j[jenisKoreksi]; ?>" style='height:16px;width:16px;background-color:none' <?php in_array ($j[jenisKoreksi], $checked) ? print "checked" : ""; ?>>&nbsp;<?php echo $j[jenisKoreksi];?>&nbsp;&nbsp;
<?php
}
$hh = mysqli_fetch_array(mysqli_query($conn, "select *from ncar_correction where ncarCode = '$_GET[no]'"));
$maue = mysqli_fetch_array(mysqli_query($conn, "select *from muser where username = '$hh[managerAuditee]'"));
	?>
	</tr>
	<tr><td colspan='5'><font size='2'><u>Root Cause :</u></font></td></tr>
		<tr><td colspan='5' height='30px' valign='top'><font size='2'><?php echo $r[rootCauseNcar]; ?></font></td></tr>
	<tr><td colspan='5'><font size='2'><u>Corrective Action :</u></font></td></tr>
		<tr><td colspan='5' height='30px' valign='top'><font size='2'><?php echo $r[CorrectiveActNcar]; ?></font></td></tr>
	
	</table>
   
		<tr>
			<td>
			<table width='100%'>
				<tr><td width='50%'><font size='2'>Manager Auditee</font></td><td>: <font size='2'><?php echo $maue[fullName]; ?></font></td></tr>
				<tr><td><font size='2'>Tanggal</font></td><td>: <font size='2'><?php echo tgl_indo($hh[tanggal_mgr]); ?></font></td></tr>
				<tr><td><font size='2'>Tanda Tangan</font></td><td>: <font size='2'><?php echo $maue[fullName]; ?></font></td></tr>
			</table>	
			</td>
			<td colspan='2'>
			<table width='100%'>
				<tr><td width='50%'><font size='2'>Tanggal Penyelesaian</font></td><td>: <font size='2'><?php echo tgl_indo($hh[tanggalSelesai]); ?></font></td></tr>
				<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
				<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
			</table>
			</td>
		</tr>
	
	<tr><td  colspan='4'>
	<table border='0' width='100%;'>
	<tr><td><b>Hasil verifikasi oleh Auditor :</b></td></tr>
	
		<tr><td valign='top'  colspan='4'><font size='2'><?php 
		$r2 = mysqli_fetch_array(mysqli_query($conn, "select *from ncar_verifikasi where ncarCode = '$_GET[no]'"));
		echo $r2[hasilVerifikasi]; ?></font></td></tr>
		<tr><td valign='top' align='right'  colspan='4'><font size='2'><?php 
			echo "Tanggal Pemeriksaan : ".  tgl_indo($r2[tanggal_periksa]); ?></font></td></tr>
	</table>
	</td></tr>
	<tr><td colspan='4'>
	<table border='0' width='100%;'>
	<tr><td><b><u>Verifikasi oleh Quality Assurance</u> :</b></td></tr>
		<tr><td  colspan='4'>
		<table border='0' width='100%;'>
		<tr><td width='20%'><font size='2'><?php 
				$r2 = mysqli_fetch_array(mysqli_query($conn, "select *from ncar_verifikasi_qa where ncarCode = '$_GET[no]'"));
				echo "Komentar </font></td><td width='1%'>:</td><td><font size='2'>".$r2[komentar]; ?></font></td></tr>
				<tr><td><font size='2'><?php 
					echo "Status </font></td><td>:</td><td><b><font size='2'>".strtoupper($r2[status]); ?></b></font></td></tr>
					<tr><td><font size='2'><?php 
					echo "Tanggal </font></td><td>:</td><td><b><font size='2'>".tgl_indo($r2[tanggal_qa]); ?></b></font></td></tr>
		</table>
	</table>
	</td></tr>
	<tr><td colspan='4'>
	<p align='right'><font size='2'>Tanda Tangan Quality Assurance</font></p>
                                    <tr>
                                        <td width='50%' align='left'><font size='2'>Disahkan Oleh MR :<br>
																					 <br><br><br><br>
										</font><br></td>
                                        <td width='50%' align='left'  colspan='2'><font size='2'>Tanggal : <br>
																					 <br><br><br><br>
										</font><br></td>
                                    </tr>
								<?php
								echo"
									";
									
								?>
								<tr><td colspan='5'><font size='2'>QF. KOP-QA-9.2-0004 REV : 01</font></td></tr>
</td>
</tr>
</table>						

	
<script>
		window.load = print_d();
		function print_d(){
			window.print();
		}
</script>