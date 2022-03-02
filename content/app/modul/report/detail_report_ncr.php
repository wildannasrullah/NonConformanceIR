<?php

error_reporting(1);
session_start();
$d=date('d');$m=date('m');$y=date('y');

//include("../../../../config/koneksi.php");
// include("../../../../config/fungsi_ribuan.php");
// include("../../../../config/fungsi_indotgl.php");

$a = mysqli_query($conn, "select * from ncr_inspection ni left join ncr_correction nc on ni.ncrCode=nc.ncrCode left join ncr_correction_type nct on nc.idCorNcr=nct.idCor  left join departemen d on ni.tujuan=d.idDepart where ni.ncrCode='$_GET[no]'");
$r = mysqli_fetch_array($a);
$qw=mysqli_query($conn, "SELECT * FROM ncr_inspection ni left join departemen d on ni.penerbit=d.idDepart where ni.ncrCode='$_GET[no]'");
$penerbit=mysqli_fetch_array($qw);
$u = mysqli_fetch_array(mysqli_query($conn, "select *from muser where username = '$r[createdBy]'"));
$u1 = mysqli_fetch_array(mysqli_query($conn, "select *from muser where username = '$r[approvedBy]'"));
$u2 = mysqli_fetch_array(mysqli_query($conn, "select *from muser where username = '$r[CreatedBy]'"));
$u3 = mysqli_fetch_array(mysqli_query($conn, "select *from muser where username = '$r[ApprovedBy]'"));

?>
<div class='page-header'>
  <div class='page-header-title'>
    <h4>Non Conformance Report
    </h4>
    <span>Laporan Pemeriksaan Yang Tidak Sesuai
    </span>
  </div>
  <div class='page-header-breadcrumb'>
    <ul class='breadcrumb-title'>
      <li class='breadcrumb-item'>
        <a href='index.html'>
          <i class='icofont icofont-home'>
          </i>
        </a>
      </li>
      <li class='breadcrumb-item'>
        <a href='#!'>Transaction
        </a>
      </li>
      <li class='breadcrumb-item'>
        <a href='#!'>NCR
        </a>
      </li>
    </ul>
  </div>
</div>

<!-- FORM INPUT -->

<div class='page-body'>
  <div class='row'>
    <div class='col-sm-12'>
	
	<div class='card'>
	<div class='card-header'>
<div class='card-header-left'>
<h5>DETAIL REPORT NCR</h5><br><br>
</div>
<?php

echo"
<table border='1' width='100%' cellspacing='0'>
<tr>
	<td width='25%' align='center' rowspan='2'>
		<img src='modul/report/logo2.png' width='75%' >
		<br><font size='2'>Jl. Rungkut Industri III / 19<BR>Surabaya 60293</font>
	</td>
	<td width='45%' align='center' rowspan='2'>
		<b><font size='2.6'><u>NON CONFORMANCE REPORT</u></font><br><font size='2'>Laporan Ketidaksesuaian</font></b>
	</td>
	<td valign='middle'>
		<h5>No : $r[ncrCode]</h5>
	</td>
</tr>
<tr>
	<td valign='middle'>
		<h5>TANGGAL : ".tgl_indo($r[tanggal_ncr])."</h5>
	</td>
</tr>

<tr>
	<td colspan='3'>
	<table width='100%'  cellspacing='0'>
	<tr>
		<td width='15%'><font size='2'>&nbsp;Penerbit</font></td><td width='1%'>:</td><td width='36%'><font size='2'>&nbsp;Dept. $penerbit[departName]</font></td><td></td><td width='15%'><font size='2'>Yang dituju</font></td><td width='1%'>:</td><td width='30%'><font size='2'>&nbsp;Dept. $r[departName]</font></td>
	</tr><br>
	<tr><td width='15%'><b></b></td><td width='1%'><b></b></td><td width='36%' colspan='5'><b></b></td></tr>
	<tr><td width='15%'><b></b></td><td width='1%'><b></b></td><td width='36%' colspan='5'><b></b></td></tr>
	
	</td>
</tr>
</table>
<hr>
<table width='100%' cellspacing='2' >
<tr>
    <td width='10%' ><font size='2'>KetidakSesuaian</font></td>
    <td width='1%' ><font size='2'> : </font></td>
	<td width='70%'><font size='2'>$r[jenis_inspection]</font></td>
	
</tr>
<tr>
    <td width='10%' ><font size='2'>Uraian Ketidak Sesuaian</font></td>
    <td width='1%' ><font size='2'> : </font></td>
	<td width='70%' height='150px'><font size='2'>$r[uraian]</font></td>
	
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
																					  Department Chief     :<br><br><u><?php echo strtoupper($u1[fullName]); ?></u>
										<!-- <img src='../../../assets/images/garis.jpg' width='43%'> --></font><br></td>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								// $no=1;
								// $a1 = mysqli_query($conn, "select *from  where no_surat_jalan = '$_GET[no_jln]'");
								// while($r1 = mysqli_fetch_array($a1)){
								// echo"
                                //     <tr>
								// 		<td width='2%' align='center' height='20px'><font size='2'>$no. </font></td>
                                //         <td width='45%'><font size='2'>$r1[nama_barang]</font></td>
                                //     </tr>
								// 	";
									
								// 	}
								?>
                                </tbody>
                            </table>
							<hr>
	<table width='100%'>
	<tr><td  colspan='5'><font size='2'><u>Correction :</u></font></td>
		<?php
		$o = mysqli_query($conn, "select *from ncr_correction where idCorNcr='$r[idCorNcr]'");
	
		$h = mysqli_fetch_array($o);

		$query="SELECT * FROM ncr_correction_type WHERE idCOR='".$r['idCorNcr']."'";
		$tipe=mysqli_query($conn,$query);
		$tipe2=mysqli_query($conn,$query);
		$chk="";
		$dsk= mysqli_fetch_assoc($tipe);
		
		$jenis=array("penambahan_pembuatan","revisi","training");
		/*while ($row = mysqli_fetch_assoc($tipe)) {
			array_push($in_row, $row['jenisCor']);
		}*/

		if(mysqli_num_rows($tipe2)>0)
		{
			
			
		
			
			
			$num=0;
			foreach ($jenis as $key) {

				
				
				$proc=mysqli_query($conn,"SELECT * FROM ncr_correction_type WHERE idCOR='".$r['idCorNcr']."'");
				
				$status="";
				while ($kee = mysqli_fetch_array($proc)) {
					if ($key==$kee['jenisCor']) {
						$status="ada";
						break;
					}
					else {
						$status="tidak";
					}
				}
				if ($status=="ada") {
					switch ($key) {
						case 'penambahan_pembuatan':
							echo"<td><input type='checkbox' style='height:25px;width:23px;border: 20px solid black;' name='koreksi[]' value='penambahan_pembuatan' checked disabled><b><font size='3' > Penambahan / Pembuatan.</font></b>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
							break;
						case 'revisi':
							echo"<td><input type='checkbox' style='height:25px;width:23px;border: 20px solid black;' name='koreksi[]' value='revisi' checked disabled><b><font size='3' > Revisi.</font></b>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
							break;
						case 'training':
							echo"<td><input type='checkbox' style='height:25px;width:23px;border: 20px solid black;' name='koreksi[]' value='training' checked disabled><b><font size='3' > Training</font></b>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
							break;
						
						
					}
				}
				else
				{
					switch ($key) {
						case 'penambahan_pembuatan':
							echo"<td><input type='checkbox' style='height:25px;width:23px;border: 20px solid black;' name='koreksi[]' value='penambahan_pembuatan' disabled><b><font size='3'> Penambahan / Pembuatan.</font></b>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
							break;
						case 'revisi':
							echo"<td><input type='checkbox' style='height:25px;width:23px;border: 20px solid black;' name='koreksi[]' value='revisi' disabled ><b><font size='3' > Revisi.</font></b>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
							break;
						case 'training':
							echo"<td><input type='checkbox' style='height:25px;width:23px;border: 20px solid black;' name='koreksi[]' value='training' disabled><b><font size='3' > Training</font></b>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
							break;
						
						
					}
				}
				
				
			}
			
			
				echo $chk;
			
		}
		else
		{
			echo"
			
				<td><input type='checkbox' style='height:25px;width:23px;border: 20px solid black;' name='koreksi[]' value='penambahan_pembuatan' readonly><b><font size='3' > Penambahan / Pembuatan.</font></b>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td><input type='checkbox' style='height:25px;width:23px;border: 20px solid black;' name='koreksi[]' value='revisi' readonly><b><font size='3'> Revisi</font></b>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td><input type='checkbox' style='height:25px;width:23px;border: 20px solid black;' name='koreksi[]' value='training' readonly><b><font size='3' > Training / Sosialiasi</font></b></td>
						";
		}

		?>
		<td></td>
	</tr>
	<tr><td   colspan='5'><font size='2'><u></u></font></td></tr>
	<tr><td  colspan='5' align='center'>
	<?php
		
			?>
			</td>
	</tr>
	<tr><td colspan='5' ><font size='2'><u>Root Cause :</u></font></td></tr>
		<tr><td colspan='5' height='120px' valign='top'><font size='2'><?php echo $r[rootCouse]; ?></font></td></tr>
	<tr><td colspan='5'><font size='2'><u>Corrective Action :</u></font></td></tr>
		<tr><td colspan='5' height='120px' valign='top'><font size='2'><?php echo $r[correctiveAction]; ?></font></td></tr>
	
	</table>
    
	<table width='100%' style='margin-top:5px'>
                                <thead>
                                    <tr>
                                        <td width='50%' align='center'><font size='2'>Dibuat tanggal :<?php echo tgl_indo($r[createdDate]); ?><br>
																					  Oleh     :<br><br>
										<u><?php echo strtoupper($u2[fullName]); ?></u></font><br></td>
                                        <td width='50%' align='center'><font size='2'>Diverifikasi tanggal : <?php echo tgl_indo($r[approvedDate]); ?><br>
																					  Department Chief     : <br><br>
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
	<tr><td align='left'><font size='2'>QF.KOP-QD-8.7-001 REV : 01</font><td><td align='right'><font size='2'><i></i></font><td></tr>
	</table>
</td>
</tr>
</tbody>
</table>
	<?php
	$query_file=mysqli_query($conn,"SELECT * FROM `ncr_files` WHERE idNcr='".$r['ncrCode']."'");
	echo "<br><br><br><br>";
	while ($rows=mysqli_fetch_assoc($query_file)) {
		echo "<br><br><br><br><table  border='1' width='100%' cellspacing='0'>";

		echo "<tbody><tr><td><table border='0' width='100%'><tr><td height='900px' align='center' > <img src='http://localhost/ncr/content/app/modul/ncr/print/temp/$rows[nama]' style='width:700px;'></td></tr></tbody>
		<tr>
		<td>
		<table border='0' width='100%'>
			<tr>
				<td align='left' border='0'>
					<font size='2'><i>Asli : Quality Departement</i></font>
				</td>
				<td align='right'><font size='2'><i>Copy 1 : Departemen Yang Dituju</i></font>
				</td>
			</tr>
			
		<tr>
			<td align='left' border='0'>
				<font size='2'>QF.KOP-QD-8.7-001 REV : 01</font>
			</td>
			<td align='right'><font size='2'><i></i></font>
			</td>
		</tr>
		
		</table>
		</td>
		</tr>
		</table></td></tr>";
		echo "
			
		</table>
				";
	}

	?>
</div>
</div>
</div>
</div>
</div>