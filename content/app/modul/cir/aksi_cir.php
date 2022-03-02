<?php
error_reporting(0);
session_start();
include("../../../../config/koneksi.php");
$conn = mysqli_connect($servername, $username, $password,$db);
// Check connection
if (!$conn) {
 die("Connection failed: " . mysqli_connect_error());
}
$p	=$_GET[n];  $act	=$_GET[act];

if($p=='cir' AND $act=='input'){
$m = date(m);$d = date(d);$y = date(Y);
$dated = date('Y-m-d');	
$dd = "$m/$d/$y";
$t = mysqli_fetch_array(mysqli_query($conn, "select max(codeCustCare) as no , date(tgl_lapor) as date_lapor from cir_customer where date(tgl_lapor)='$dated' "));
										$noUrut = (int) substr($t[no], 14, 3);
										$noUrut++;
										$char = "CIR-$y$m$d-";
										$newID = $char . sprintf("%03s", $noUrut);
$cir	= $newID;
	$file = $_FILES['fupload']['name'];	
		
		mysqli_query($conn, "INSERT INTO cir_customer VALUES (NULL, '$_POST[comp_name]', '$_POST[cust_info]', '$_POST[prod_name]','$_POST[des_code]','$_POST[status]','$_POST[jum_rusak]','$_POST[gid]',NOW(), '$cir', '$_POST[via]', '$file',NULL,'Open')");
			move_uploaded_file($_FILES['fupload']['tmp_name'], "lampiran/".$_FILES['fupload']['name']);
			
			include("sendmail.php"); 
			/* include("sendmail_customer.php"); */
			echo"
				<script>
					alert('Thank you for your report. We will immediately respond to the report that you have submitted. Check your email, please!');window.location = 'CustomerCareService.php';
				</script>";
			

}
// KOREKSI

if($p=='cir' AND $act=='forwardto'){
$m = date(m);$d = date(d);$y = date(Y);
$dated = date('Y-m-d');	
$dd = "$m/$d/$y";
$jc = $_POST['dep'];
	$jumlah_dipilih = count($jc);
	for($x=0;$x<$jumlah_dipilih;$x++){
		mysqli_query($conn, "INSERT INTO cir_forward VALUES (NULL,'$_POST[kode_cir]','$jc[$x]','$_SESSION[username]',NOW(), '$_SESSION[username]',NOW(), NULL)");
	}
	mysqli_query($conn, "UPDATE cir_customer SET 
								action 			= 'Forwarded'
								WHERE codeCustCare		  	= '$_POST[kode_cir]'");
	echo"
		<script>
			alert('Berhasil di Forward ke departemen terkait');window.location = '../../page.php?n=list-cir';
		</script>";
}
if($p=='forward-cir' AND $act=='input'){
$m = date(m);$d = date(d);$y = date(Y);
$dated = date('Y-m-d');	
$dd = "$m/$d/$y";
$user = mysqli_query($conn, "select *from muser m 
								left join departemenrole dl on m.idDep = dl.idDep
								left join departemen d on dl.idDepart = d.idDepart
								left join departemenmain dm on d.idDepMain = dm.idDepMain
								where m.username='$_SESSION[username]';");
$u = mysqli_fetch_array($user);
$jc = $_POST['jenis_koreksi'];
	$jumlah_dipilih = count($jc);
	for($x=0;$x<$jumlah_dipilih;$x++){
		mysqli_query($conn, "INSERT INTO cir_correction_type VALUES (NULL,'$_POST[kode]','$jc[$x]','$_SESSION[username]',NOW())");
	}
	mysqli_query($conn, "INSERT INTO cir_correction_imm VALUES (NULL,'$_POST[kode]','$_POST[root]','$_POST[correct]', '$_SESSION[username]',NOW(), '$_SESSION[username]',NOW(),'$u[idDepart]')");
	echo"
		<script>
			alert('Berhasil di input koreksi');window.location = '../../page.php?n=forward-cir';
		</script>";
}

if($p=='forward-cir' AND $act=='edit'){
$m = date(m);$d = date(d);$y = date(Y);
$dated = date('Y-m-d');	
$dd = "$m/$d/$y";
$user = mysqli_query($conn, "select *from muser m 
								left join departemenrole dl on m.idDep = dl.idDep
								left join departemen d on dl.idDepart = d.idDepart
								left join departemenmain dm on d.idDepMain = dm.idDepMain
								where m.username='$_SESSION[username]';");
$u = mysqli_fetch_array($user);
	mysqli_query($conn, "UPDATE cir_correction_imm SET 
								rootCause 			= '$_POST[root]', 
								correctiveAct 		= '$_POST[correct]', 
								ChangedBy 			= '$_SESSION[username]',
								ChangedDate 		= NOW()
								WHERE codeCustCare 	= '$_POST[kode]'");
	
	mysqli_query($conn, "DELETE FROM cir_correction_type WHERE codeCustCare = '$_POST[kode]'");
	$jc = $_POST['jenis_koreksi'];
	$jumlah_dipilih = count($jc);
	for($x=0;$x<$jumlah_dipilih;$x++){
		mysqli_query($conn, "INSERT INTO cir_correction_type VALUES (NULL,'$_POST[kode]','$jc[$x]','$_SESSION[username]',NOW())");
	}
	echo"
		<script>
			alert('Berhasil simpan perubahan correction document');window.location = '../../page.php?n=forward-cir';
		</script>";
}

if($p=='forward-cir' AND $act=='input_tindakan'){
$m = date(m);$d = date(d);$y = date(Y);
$dated = date('Y-m-d');	
$dd = "$m/$d/$y";
$user = mysqli_query($conn, "select *from muser m 
								left join departemenrole dl on m.idDep = dl.idDep
								left join departemen d on dl.idDepart = d.idDepart
								left join departemenmain dm on d.idDepMain = dm.idDepMain
								where m.username='$_SESSION[username]';");
$u = mysqli_fetch_array($user);

	mysqli_query($conn, "INSERT INTO cir_correction_action VALUES (NULL,'$_POST[kode]','$_POST[roott]','$_POST[correctt]','$_POST[deadlinet]', '$_SESSION[username]',NOW(), '$_SESSION[username]',NOW(),'$u[idDepart]')");
	echo"
		<script>
			alert('Berhasil di input koreksi');window.location = '../../page.php?n=forward-cir';
		</script>";
}

if($p=='forward-cir' AND $act=='edit_tindakan'){
$m = date(m);$d = date(d);$y = date(Y);
$dated = date('Y-m-d');	
$dd = "$m/$d/$y";
$user = mysqli_query($conn, "select *from muser m 
								left join departemenrole dl on m.idDep = dl.idDep
								left join departemen d on dl.idDepart = d.idDepart
								left join departemenmain dm on d.idDepMain = dm.idDepMain
								where m.username='$_SESSION[username]';");
$u = mysqli_fetch_array($user);
	mysqli_query($conn, "UPDATE cir_correction_action SET 
								rootcause 			= '$_POST[roott]', 
								plannedAction 		= '$_POST[correctt]',
								deadline_plan		= '$_POST[deadlinet]',
								changedby 			= '$_SESSION[username]',
								changeddate 		= NOW()
								WHERE codeCustCare 	= '$_POST[kode]'");
	
	echo"
		<script>
			alert('Berhasil simpan perubahan correction document');window.location = '../../page.php?n=forward-cir';
		</script>";
}

if($p=='forward-cir' AND $act=='approving'){
$m = date(m);$d = date(d);$y = date(Y);
$dated = date('Y-m-d');	
$dd = "$m/$d/$y";
mysqli_query($conn, "INSERT INTO cir_verifikasi VALUES (NULL,'$_GET[code]','$_SESSION[username]',NOW(),'Closed')");
	echo"
		<script>
			alert('Status Kasus dengan kode $_GET[code] adalah Closed');window.location = '../../page.php?n=forward-cir';
		</script>";
}
if($p=='forward-cir' AND $act=='disapproving'){
$m = date(m);$d = date(d);$y = date(Y);
$dated = date('Y-m-d');	
$dd = "$m/$d/$y";
mysqli_query($conn, "DELETE FROM cir_verifikasi WHERE codeCustCare = '$_GET[code]'");
	echo"
		<script>
			alert('Status Kasus dengan kode $_GET[code] adalah Open');window.location = '../../page.php?n=forward-cir';
		</script>";
}
/*if($p=='correction' AND $act=='edit'){
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
	$jc = $_POST['jenis_koreksi'];
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
} */
?>