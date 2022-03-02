<?php
error_reporting(0);
session_start();
$d=date('d');$m=date('m');$y=date('y');
include('../../../../../config/koneksi.php');

include("../../../../../config/fungsi_ribuan.php");
include("../../../../../config/fungsi_indotgl.php");

$a = mysqli_query($conn, "select *from ncir_inspection ni left join ncir_correction nc on ni.ncirCode=nc.ncirCode left join ncir_correction_type nct on nc.idCor=nct.idCor  left join departemen d on ni.tujuan=d.idDepart where nc.idCor='$_GET[coir]'");
$r = mysqli_fetch_array($a);
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
		<b><font size='2.6'><u>NON CONFORMANCE INSPECTION REPORT</u></font><br><font size='2'>Laporan Pemeriksaan yang tidak sesuai</font></b>
	</td>
	<td valign='middle'>
		<h5>No : $r[ncirCode]</h5>
	</td>
</tr>
<tr>
	<td valign='middle'>
		<h5>TANGGAL : ".tgl_indo($r[tanggal_ncir])."</h5>
	</td>
</tr>

<tr>
	<td colspan='3'>
	<table width='100%'  cellspacing='0'>
	<tr>
		<td width='15%'><font size='2'>&nbsp;Penerbit</font></td><td width='1%'>:</td><td width='36%'><font size='2'>&nbsp;Dept. $r[penerbit]</font></td><td></td><td width='15%'><font size='2'>Yang dituju</font></td><td width='1%'>:</td><td width='30%'><font size='2'>&nbsp;Dept. $r[departName]</font></td>
	</tr><br>
	<tr><td width='15%'><b></b></td><td width='1%'><b></b></td><td width='36%' colspan='5'><b></b></td></tr>
	<tr><td width='15%'><b></b></td><td width='1%'><b></b></td><td width='36%' colspan='5'><b></b></td></tr>
	<tr>
		<td width='15%'><b><font size='2'>&nbsp;Inspection</font></b></td><td width='1%'><b>:</b></td><td width='36%' colspan='5'><font size='2'>&nbsp;<b>INCOMING RAW MATERIAL &nbsp;/&nbsp; INPROCESS &nbsp;/&nbsp; FINISHED GOOD</b></font></td>
	</tr>
	</td>
</tr>
</table>
<hr>
<table width='100%' cellspacing='2'>
<tr><td width='100%' colspan='5'><font size='2'>Data-data ketidaksesuaian :</font></td></tr>
<tr><td width='100%' colspan='5'></td></tr><tr><td width='100%' colspan='5'></td></tr><tr><td width='100%' colspan='5'></td></tr>
<tr>
	<td width='40%'><font size='2'>1. Nama Barang</font></td>
		<td width='1%'>:</td>
		<td width='30%'><font size='2'>$r[nama_barang]</font></td>
		<td><font size='2'>PO/Wot: &nbsp;&nbsp;$r[po_wo]</font></td>
</tr>
<tr>
	<td><font size='2'>2. Jumlah Ketidaksesuaian dari Jumlah Sample</font></td>
		<td>:</td>
		<td  colspan='2'><font size='2'>$r[jum_ketidaksesuian] &nbsp;&nbsp; dari &nbsp;&nbsp;$r[jum_sample]</font>
		</td>
</tr>
<tr>
	<td><font size='2'>&nbsp;</font></td>
		<td>:</td>
		<td colspan='2' valign='middle' height='30px'>
		<input type='checkbox' style='height:16px;width:16px;border: 20px solid black;'><font size='2'> Critical</font>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<input type='checkbox' style='height:16px;width:16px;border: 20px; solid black'><font size='2'> Minor</font>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<input type='checkbox' style='height:16px;width:16px;border: 20px; solid black'><font size='2'> Major</font>
		</td>
</tr>
<tr>
	<td><font size='2'>3. Keterangan</font></td>
		<td>:</td>
		<td  colspan='2'><font size='2'>$r[keterangan]</font>
		</td>
</tr>
<tr>
	<td><font size='2'>4. Jumlah yang dikarantina</font></td>
		<td>:</td>
		<td><font size='2'>$r[jum_karantina]</font></td>
</tr>
<tr>
	<td><font size='2'>5. Lot</font></td>
	<td>:</td>
	<td><font size='2'>$r[lot]</font></td>
</tr>
<tr>
	<td><font size='2'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Nomor Surat Jalan / Mesin & Shift</font></td>
		<td>:</td>
		<td><font size='2'>$r[no_suratjalan]</font></td>
</tr>
<tr>
	<td><font size='2'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tanggal Kedatangan / Operator</font></td>
		<td>:</td>
		<td><font size='2'>$r[tanggal_datang]</font></td>
</tr>
<tr>
	<td><font size='2'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Supplier / Supervisi</font></td>
		<td>:</td>
		<td><font size='2'>$r[supplier]</font></td>
</tr>
<tr>
	<td><font size='2'>6. Terlampir hasil pemeriksaan tanggal</font></td>
		<td>:</td>
		<td><font size='2'>$r[tanggal_hasil]</font></td>
</tr>
</table>";
?>
										
                            <br><table width='100%' style='margin-top:5px'>
                                <thead>
                                    <tr>
                                        <td width='50%' align='center' height='20px'><font size='2'>Dibuat Oleh: <br><br><br>
										<u><?php echo strtoupper($u[fullName]); ?></u>
										<!-- <img src='../../../assets/images/garis.jpg' width='43%'>--></font><br></td>
                                        <td width='50%' align='center'><font size='2'>Disetujui tanggal :&nbsp;&nbsp;&nbsp;<?php echo tgl_indo($r[approvedDate]); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
																					  Quality Chief     :<br><br><u><?php echo strtoupper($u1[fullName]); ?></u>
										<!-- <img src='../../../assets/images/garis.jpg' width='43%'> --></font><br></td>
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
                                    </tr>
									";
									
									}
								?>
                                </tbody>
                            </table>
							<hr>
	<table width='100%'>
	<tr><td  colspan='5'><font size='2'><u>Correction :</u></font></td></tr>
	<tr><td   colspan='5'><font size='2'><u></u></font></td></tr>
	<tr><td  colspan='5' align='center'>
	<?php
		$query = "select *from ncir_correction_type where idCor = '$_GET[coir]'";
			$sq = mysqli_query($conn, $query);
			$cek_user = array();
			while($row = mysqli_fetch_assoc($sq)) {
					$cek_user [ $row['jenisCor'] ] = $row['jenisCor'];
			}
            foreach($cek_user as $kode=>$cu) {
						$check_list[]=$cu;
			}  
			$checked= $check_list;
$jk = mysqli_query($conn, "select *from mjeniskoreksi where idKoreksi IN ('1','2','3','4','5') order by idKoreksi ASC");
while($j = mysqli_fetch_array($jk)){
	$checked= $check_list;
	?>
	<input type='checkbox' name='jenis_koreksi[]' value="<?php echo $j[jenisKoreksi]; ?>" style='height:16px;width:16px;background-color:none' <?php in_array ($j[jenisKoreksi], $checked) ? print "checked" : ""; ?>>&nbsp;<?php echo $j[jenisKoreksi];?>&nbsp;&nbsp;
<?php
}
	?>
	</tr>
	<tr><td colspan='5'><font size='2'><u>Root Cause :</u></font></td></tr>
		<tr><td colspan='5' height='50px' valign='top'><font size='2'><?php echo $r[rootCause]; ?></font></td></tr>
	<tr><td colspan='5'><font size='2'><u>Corrective Action :</u></font></td></tr>
		<tr><td colspan='5' height='50px' valign='top'><font size='2'><?php echo $r[correctiveAct]; ?></font></td></tr>
	<tr><td colspan='5'><font size='2'><hr></font></td></tr>
	<tr><td colspan='5'><font size='2'><u>Hasil Verifikasi :</u></font></td></tr>
		<tr><td colspan='5' height='50px' valign='top'><font size='2'><?php echo $r[hasil_verifikasi]; ?></font></td></tr>
	<tr><td width='15%'><font size='2'>1. Hasil Baik</font></td><td width='1%'>:</td><td  colspan='3' ><?php echo $r[hasil_baik]; ?></td></tr>
	<tr><td><font size='2'>2. Hasil Rusak</font></td><td width='1%'>:</td><td  colspan='3'><?php echo $r[hasil_rusak]; ?></td></tr>
	
	</table>
    
	<table width='100%' style='margin-top:5px'>
                                <thead>
                                    <tr>
                                        <td width='50%' align='center'><font size='2'>Dibuat tanggal :<?php echo tgl_indo($r[CreatedDate]); ?><br>
																					  Oleh     :<br><br>
										<u><?php echo strtoupper($u2[fullName]); ?></u></font><br></td>
                                        <td width='50%' align='center'><font size='2'>Diverifikasi tanggal : <?php echo tgl_indo($r[ApprovedDate]); ?><br>
																					  Department Chief     : <?php echo $r[departName]; ?><br><br>
										<u><?php echo strtoupper($u3[fullName]); ?></u></font><br></td>
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
	<tr><td align='left'><font size='2'><i>Asli : Quality Departement</i></font><td><td align='right'><font size='2'><i>Copy 1 : Departemen Yang Dituju</i></font><td></tr>
	<tr><td align='left'><font size='2'>QF.KOP-QD-8.6-006 REV : 01</font><td><td align='right'><font size='2'><i>nb : tanda tangan berbentuk digital, sehingga tidak perlu tanda tangan manual</i></font><td></tr>
	</table>
	
<script>
		window.load = print_d();
		function print_d(){
			window.print();
		}
</script>