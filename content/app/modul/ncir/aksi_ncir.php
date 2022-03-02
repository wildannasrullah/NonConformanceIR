<?php
error_reporting(0);
session_start();
include("../../../../config/koneksi.php");
$p	=$_GET[n];  $act	=$_GET[act];

if($p=='input-ncir' AND $act=='input'){
$m = date(m);$d = date(d);$y = date(Y);
$dated = date('Y-m-d');	
$dd = "$m/$d/$y";
$t = mysqli_fetch_array(mysqli_query($conn, "select max(ncirCode) as no from ncir_inspection"));
										$noUrut = (int) substr($t[no], 5, 3);
										$noUrut++;
										$char = "NCIR-";
										$newID = $char . sprintf("%03s", $noUrut);
	$no_ncir	= $newID;
	mysqli_query($conn, "INSERT INTO ncir_inspection (ncirCode, tanggal_ncir, penerbit, tujuan, jenis_inspection,
														nama_barang, po_wo, jum_ketidaksesuian, jum_sample,
														keterangan, jum_karantina, lot, no_suratjalan, tanggal_datang,
														supplier, tanggal_hasil, createdBy, createdDate,
														approvedBy, approvedDate, changedBy, changedDate) 
						VALUES ('$no_ncir', '$_POST[tgl_ncir]', '$_POST[penerbit]','$_POST[tujuan]','$_POST[inspek]','$_POST[nama_barang]','$_POST[po_wo]','$_POST[tidak_sesuai]',
								'$_POST[sampel]','$_POST[ket]','$_POST[karantina]','$_POST[lot]','$_POST[no_sj]','$_POST[tgl_datang]','$_POST[supplier]','$_POST[hasil_periksa]',
								'$_SESSION[username]',NOW(),NULL,NULL,'$_SESSION[username]',NOW())");
	echo"
		<script>
			alert('Berhasil simpan inspection document, kode : $no_ncir --> $_POST[penerbit]');window.location = '../../page.php?n=input-ncir';
		</script>";
}
if($p=='input-ncir' AND $act=='approve'){
	mysqli_query($conn, "UPDATE ncir_inspection SET 
								 approvedBy		 = '$_SESSION[username]',
								 approvedDate	 = NOW()
								 WHERE ncirCode  = '$_POST[no_ncir]'");

	echo"
		<script>
			alert('Menyetujui dokumen $_POST[no_ncir], berhasil.');window.location = '../../page.php?n=input-ncir&k=1&no=$_POST[no_ncir]';
		</script>";
}
if($p=='input-ncir' AND $act=='disapproved'){
	mysqli_query($conn, "UPDATE ncir_inspection SET 
								 approvedBy		 = NULL,
								 approvedDate	 =NULL
								 WHERE ncirCode  = '$_POST[no_ncir]'");

	echo"
		<script>
			alert('Membatalkan dokumen $_POST[no_ncir], berhasil.');window.location = '../../page.php?n=input-ncir&k=1&no=$_POST[no_ncir]';
		</script>";
}
if($p=='input-ncir' AND $act=='edit'){
	mysqli_query($conn, "UPDATE ncir_inspection SET 
								tanggal_ncir 		= '$_POST[tgl_ncir]', 
								penerbit 			= '$_POST[penerbit]', 
								tujuan 				= '$_POST[tujuan]', 
								jenis_inspection 	= '$_POST[inspek]'	,
								nama_barang 		= '$_POST[nama_barang]', 
								po_wo 				= '$_POST[po_wo]', 
								jum_ketidaksesuian 	= '$_POST[tidak_sesuai]', 
								jum_sample 			= '$_POST[sampel]',
								keterangan 			= '$_POST[ket]', 
								jum_karantina 		= '$_POST[karantina]', 
								lot 				= '$_POST[lot]', 
								no_suratjalan 		= '$_POST[no_sj]', 
								tanggal_datang 		= '$_POST[tgl_datang]',
								supplier 			= '$_POST[supplier]', 
								tanggal_hasil 		= '$_POST[hasil_periksa]', 
								changedBy 			= '$_SESSION[username]', 
								changedDate 		= NOW()
								WHERE ncirCode  	= '$_POST[no_ncir]'");

	echo"
		<script>
			alert('Edit NCIR berhasil.');window.location = '../../page.php?n=input-ncir&k=1&no=$_POST[no_ncir]&d=1';
		</script>";
}
if($p=='input-ncir' AND $act=='delete'){
	mysqli_query($conn, "DELETE FROM ncir_inspection WHERE ncirCode = '$_GET[no]'");
	echo"
		<script>
			alert('Delete NCIR berhasil.');window.location = '../../page.php?n=input-ncir';
		</script>";
}
if($p=='list-ncir' AND $act=='delete'){
	mysqli_query($conn, "DELETE FROM ncir_inspection WHERE ncirCode = '$_GET[no]'");
	echo"
		<script>
			alert('Delete NCIR berhasil.');window.location = '../../page.php?n=list-ncir';
		</script>";
}
// KOREKSI

if($p=='correction' AND $act=='input'){
$m = date(m);$d = date(d);$y = date(Y);
$dated = date('Y-m-d');	
$dd = "$m/$d/$y";
$t = mysqli_fetch_array(mysqli_query($conn, "select max(idCor) as no , date(createdDate) as tgl_n from ncir_correction where date(createdDate)='$dated' "));
										$noUrut = (int) substr($t[no], 14, 3);
										$noUrut++;
										$char = "COIR-$y$m$d-";
										$newID = $char . sprintf("%03s", $noUrut);
	$no_cor	= $newID;
	mysqli_query($conn, "INSERT INTO ncir_correction VALUES ('$no_cor', '$_POST[root]', '$_POST[correct]','$_POST[hasil]','$_POST[hasil_baik]','$_POST[hasil_rusak]','$_SESSION[username]',NOW(),NULL,NULL,'$_POST[kode]','$_SESSION[username]',NOW())");
	
	$jc = $_POST['koreksi'];
	$jumlah_dipilih = count($jc);
	for($x=0;$x<$jumlah_dipilih;$x++){
		mysqli_query($conn, "INSERT INTO ncir_correction_type VALUES (NULL,'$no_cor','$jc[$x]')");
	}
	echo"
		<script>
			alert('Berhasil simpan correction document');window.location = '../../page.php?n=list-ncir';
		</script>";
}
if($p=='correction' AND $act=='edit'){
	mysqli_query($conn, "UPDATE ncir_correction SET 
								rootCause 			= '$_POST[root]', 
								correctiveAct 		= '$_POST[correct]', 
								hasil_verifikasi 	= '$_POST[hasil]', 
								hasil_baik 			= '$_POST[hasil_baik]',
								hasil_rusak 		= '$_POST[hasil_rusak]',
								ChangedBy 			= '$_SESSION[username]',
								ChangedDate 		= NOW()
								WHERE idCor		  	= '$_POST[idCor]'");
	
	mysqli_query($conn, "DELETE FROM ncir_correction_type WHERE idCor = '$_POST[idCor]'");
	$jc = $_POST['koreksi'];
	$jumlah_dipilih = count($jc);
	for($x=0;$x<$jumlah_dipilih;$x++){
		mysqli_query($conn, "INSERT INTO ncir_correction_type VALUES (NULL,'$_POST[idCor]','$jc[$x]')");
	}
	echo"
		<script>
			alert('Berhasil simpan perubahan correction document');window.location = '../../page.php?n=list-ncir';
		</script>";
}
if($p=='input-correction' AND $act=='approve'){
	mysqli_query($conn, "UPDATE ncir_correction SET 
								 ApprovedBy		 = '$_SESSION[username]',
								 ApprovedDate	 = NOW()
								 WHERE idCor  	 = '$_POST[no_coir]'");

	echo"
		<script>
			alert('Menyetujui koreksi dokumen$_POST[no_ncir], berhasil.');window.location = '../../page.php?n=input-correction&no=$_POST[no_ncir]&coir=$_POST[no_coir]&s=finish&k=1';
		</script>";
}
if($p=='input-correction' AND $act=='disapproved'){
	mysqli_query($conn, "UPDATE ncir_correction SET 
								 ApprovedBy		 = NULL,
								 ApprovedDate	 = NULL
								 WHERE idCor   	 = '$_POST[no_coir]'");

	echo"
		<script>
			alert('Membatalkan koreksi dokumen $_POST[no_ncir], berhasil.');window.location = '../../page.php?n=input-correction&no=$_POST[no_ncir]&coir=$_POST[no_coir]&s=finish&k=1';
		</script>";
}
if($p=='dashboard' AND $act=='delete'){
	mysqli_query($conn, "DELETE FROM ncir_correction WHERE ncirCode = '$_GET[no]'");
	echo"
		<script>
			alert('Delete Koreksi berhasil.');window.location = '../../page.php?n=dashboard';
		</script>";
}
?>