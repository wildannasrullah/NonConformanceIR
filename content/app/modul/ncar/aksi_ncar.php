<?php
error_reporting(0);
session_start();
include("../../../../config/koneksi.php");
$p	=$_GET[n];  $act	=$_GET[act];

if($p=='ttd_auditee' AND $act=='ttd_auditee'){
	mysqli_query($conn, "UPDATE ncar SET 
								 auditee		 = '$_SESSION[username]',
								 tanggal_auditee = NOW(),
								 ttd_auditee	 = '$_SESSION[username]'
								 WHERE ncarCode  = '$_GET[no_ncar]'");

	echo"
		<script>
			alert('Tanda tangan dokumen, berhasil.');window.location = '../../page.php?n=input-ncar&k=1&no=$_GET[no_ncar]';
		</script>";
}
if($p=='input-ncar' AND $act=='input'){
$m = date(m);$d = date(d);$y = date(Y);
$dated = date('Y-m-d');	
$dd = "$m/$d/$y";
$t = mysqli_fetch_array(mysqli_query($conn, "select max(ncarCode) as no from ncar"));
										$noUrut = (int) substr($t[no], 5, 3);
										$noUrut++;
										$char = "NCAR-";
										$newID = $char . sprintf("%03s", $noUrut);
	$no_ncar	= $newID;
	mysqli_query($conn, "INSERT INTO ncar (ncarCode, tanggal_audit, idDepart, dokAcuan, objektif,
														lokasi, referensi, kategori, auditor,
														tanggal_auditor, ttd_auditor, createdBy, createdDate,
														approvedBy, approvedDate, changedBy, changedDate, penjelasan) 
						VALUES ('$no_ncar', '$_POST[tgl_ncar]', '$_POST[dept]','$_POST[doc_acuan]','$_POST[objektif]',
							    '$_POST[lokasi]','$_POST[ref]','$_POST[kategori]',
								'$_SESSION[username]',NOW(),'$_SESSION[username]','$_SESSION[username]',NOW(),NULL,NULL,'$_SESSION[username]',NOW(),'$_POST[penjelasan]')");
	echo"
		<script>
			alert('Berhasil simpan inspection document');window.location = '../../page.php?n=input-ncar';
		</script>";
}
if($p=='input-ncar' AND $act=='approve'){
	mysqli_query($conn, "UPDATE ncar SET 
								 approvedBy		 = '$_SESSION[username]',
								 approvedDate	 = NOW()
								 WHERE ncarCode  = '$_POST[no_ncar]'");

	echo"
		<script>
			alert('Menyetujui dokumen $_POST[no_ncar], berhasil.');window.location = '../../page.php?n=input-ncar&k=1&no=$_POST[no_ncar]';
		</script>";
}
if($p=='input-ncar' AND $act=='disapproved'){
	mysqli_query($conn, "UPDATE ncar SET 
								 approvedBy		 = NULL,
								 approvedDate	 =NULL
								 WHERE ncarCode  = '$_POST[no_ncar]'");

	echo"
		<script>
			alert('Membatalkan dokumen $_POST[no_ncar], berhasil.');window.location = '../../page.php?n=input-ncar&k=1&no=$_POST[no_ncar]';
		</script>";
}
if($p=='input-ncar' AND $act=='edit'){
	mysqli_query($conn, "UPDATE ncar SET 
								tanggal_audit 		= '$_POST[tgl_ncar]', 
								idDepart 			= '$_POST[dept]', 
								dokAcuan 			= '$_POST[doc_acuan]', 
								objektif 			= '$_POST[objektif]'	,
								lokasi 				= '$_POST[lokasi]', 
								referensi 			= '$_POST[ref]', 
								kategori 			= '$_POST[kategori]',   
								changedBy 			= '$_SESSION[username]', 
								changedDate 		= NOW(),
								penjelasan			= '$_POST[penjelasan]'
								WHERE ncarCode  	= '$_POST[no_ncar]'");

	echo"
		<script>
			alert('Edit ncar berhasil.');window.location = '../../page.php?n=input-ncar&k=1&no=$_POST[no_ncar]';
		</script>";
}

// KOREKSI

if($p=='ncar-correction' AND $act=='input'){
$m = date(m);$d = date(d);$y = date(Y);
$dated = date('Y-m-d');	
$dd = "$m/$d/$y";
$t = mysqli_fetch_array(mysqli_query($conn, "select max(idCor) as no , date(createdDate) as tgl_n from ncar_correction where date(createdDate)='$dated' "));
										$noUrut = (int) substr($t[no], 14, 3);
										$noUrut++;
										$char = "COIR-$y$m$d-";
										$newID = $char . sprintf("%03s", $noUrut);
	$no_cor	= $newID;
	mysqli_query($conn, "INSERT INTO ncar_correction VALUES ('$no_cor', '$_POST[root]', '$_POST[correct]',NULL,'$_POST[tanggal_selesai]',NULL,NULL,'$_SESSION[username]',NOW(),NULL,NULL,'$_SESSION[username]',NOW(),'$_POST[no_ncar]')");
	mysqli_query($conn, "UPDATE ncar SET 
								auditee 				= '$_SESSION[username]',
								tanggal_auditee			= NOW(),
								ttd_auditee 			= '$_SESSION[username]'
								WHERE ncarCode	  		= '$_POST[no_ncar]'");
	
	$jc = $_POST['koreksi'];
	$jumlah_dipilih = count($jc);
	for($x=0;$x<$jumlah_dipilih;$x++){
		mysqli_query($conn, "INSERT INTO ncar_correction_type VALUES (NULL,'$no_cor','$jc[$x]','$_SESSION[username]',NOW())");
	}
	echo"
		<script>
			alert('Berhasil simpan correction document');window.location = '../../page.php?n=list-ncar';
		</script>";
}
if($p=='ncar-correction' AND $act=='edit'){
	mysqli_query($conn, "UPDATE ncar_correction SET 
								rootCauseNcar 			= '$_POST[root]', 
								CorrectiveActNcar 		= '$_POST[correct]', 
								tanggalSelesai		 	= '$_POST[tanggal_selesai]',
								ChangedBy 				= '$_SESSION[username]',
								ChangedDate 			= NOW()
								WHERE idCorNcar	  		= '$_GET[coir]'");
	
	mysqli_query($conn, "DELETE FROM ncar_correction_type WHERE idCorNcar = '$_GET[coir]'");
	$jc = $_POST['koreksi'];
	$jumlah_dipilih = count($jc);
	for($x=0;$x<$jumlah_dipilih;$x++){
		mysqli_query($conn, "INSERT INTO ncar_correction_type VALUES (NULL,'$_GET[coir]','$jc[$x]','$_SESSION[username]',NOW())");
	}
	echo"
		<script>
			alert('Berhasil simpan perubahan correction document');window.location = '../../page.php?n=list-ncar';
		</script>";
}
if($p=='ncar-correction' AND $act=='delete'){
	mysqli_query($conn, "DELETE FROM ncar_correction WHERE idCorNcar = '$_GET[coir]'");
	mysqli_query($conn, "DELETE FROM ncar_correction_type WHERE idCorNcar = '$_GET[coir]'");
	echo"
		<script>
			alert('Berhasil delete correction document');window.location = '../../page.php?n=list-ncar';
		</script>";
}
if($p=='ncar-correction' AND $act=='approve'){
	mysqli_query($conn, "UPDATE ncar_correction SET
								 managerAuditee	 = '$_SESSION[username]',
								 tanggal_mgr	 = NOW(),
								 ttd_mgrAuditee	 = '$_SESSION[username]',
								 ApprovedBy		 = '$_SESSION[username]',
								 ApprovedDate	 = NOW()
								 WHERE idCorNcar  	 = '$_GET[coir]'");

	echo"
		<script>
			alert('Menyetujui koreksi dokumen, berhasil.');window.location = '../../page.php?n=ncar-correction&no=$_GET[no]&coir=$_GET[coir]&s=finish&k=1';
		</script>";
}
if($p=='ncar-correction' AND $act=='disapproved'){
	mysqli_query($conn, "UPDATE ncar_correction SET 
								 ApprovedBy		 = NULL,
								 ApprovedDate	 = NULL
								 WHERE idCorNcar   	 = '$_GET[coir]'");

	echo"
		<script>
			alert('Membatalkan koreksi dokumen $_POST[no_ncar], berhasil.');window.location = '../../page.php?n=ncar-correction&no=$_GET[no]&coir=$_GET[coir]&s=finish&k=1';
		</script>";
}
if($p=='ncar-correction' AND $act=='verifikasi'){
	$t = mysqli_query($conn, "select *from ncar_verifikasi where ncarCode='$_GET[no]'");
	if(mysqli_num_rows($t)>0){
		mysqli_query($conn, "UPDATE ncar_verifikasi SET 
								 hasilVerifikasi		 = '$_POST[hasil_verifikasi]',
								 tanggal_periksa		 = '$_POST[tanggal_periksa]'
								 WHERE ncarCode   	 = '$_GET[no]'");
	}else{
		mysqli_query($conn, "INSERT INTO ncar_verifikasi VALUES (NULL, '$_GET[no]', '$_POST[hasil_verifikasi]','$_POST[tanggal_periksa]','$_SESSION[username]',NOW())");
	}
	echo"
		<script>
			alert('Berhasil simpan verifikasi document');window.location = '../../page.php?n=ncar-correction&no=$_GET[no]&coir=$_GET[coir]&s=finish&k=1';
		</script>";
}
if($p=='ncar-correction' AND $act=='qa'){
	$t = mysqli_query($conn, "select *from ncar_verifikasi_qa where ncarCode='$_GET[no]'");
	if(mysqli_num_rows($t)>0){
		mysqli_query($conn, "UPDATE ncar_verifikasi_qa SET 
								 komentar		= '$_POST[komentar]',
								 status		 	= '$_POST[status]',
								 tanggal_qa		= '$_POST[tanggal_qa]'
								 WHERE ncarCode   	 	 = '$_GET[no]'");
	}else{
		mysqli_query($conn, "INSERT INTO ncar_verifikasi_qa VALUES (NULL, '$_GET[no]', '$_POST[komentar]','$_POST[status]','$_POST[tanggal_qa]','$_SESSION[username]',NOW())");
	}
	echo"
		<script>
			alert('Berhasil simpan verifikasi document');window.location = '../../page.php?n=ncar-correction&no=$_GET[no]&coir=$_GET[coir]&s=finish&k=1';
		</script>";
}
if($p=='ncar-correction' AND $act=='delverqa'){
	mysqli_query($conn, "DELETE FROM ncar_verifikasi_qa WHERE idVerQa = '$_GET[id]'");
	echo"
		<script>
			alert('Berhasil delete verifikasi QA');window.location = '../../page.php?n=ncar-correction&no=$_GET[no]&coir=$_GET[coir]&s=finish&k=1';
		</script>";
}
if($p=='ncar-correction' AND $act=='delver'){
	mysqli_query($conn, "DELETE FROM ncar_verifikasi WHERE idNcarVer = '$_GET[id]'");
	echo"
		<script>
			alert('Berhasil delete verifikasi Auditor');window.location = '../../page.php?n=ncar-correction&no=$_GET[no]&coir=$_GET[coir]&s=finish&k=1';
		</script>";
}
?>