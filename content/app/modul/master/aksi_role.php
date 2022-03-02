<?php
error_reporting(0);
session_start();
include("../../../../config/koneksi.php");
$p	=$_GET[n];  $act	=$_GET[act];

if($p=='role' AND $act=='input'){
	mysqli_query($conn, "INSERT INTO departemenrole VALUE(NULL, '$_POST[nama_role]','$_POST[ket_role]','$_POST[dept]')");
	echo"
		<script>
			alert('Tambah Departmene role berhasil.');window.location = '../../page.php?n=role';
		</script>";
}
if($p=='role' AND $act=='edit'){
	mysqli_query($conn, "UPDATE departemenrole SET 
								 depName = '$_POST[nama_role]',
								 ketDep	= '$_POST[ket_role]',
								 idDepart = '$_POST[dept]'
								 WHERE idDep  = '$_POST[id]'");

	echo"
		<script>
			alert('Edit departemenrole berhasil.');window.location = '../../page.php?n=role';
		</script>";
}
if($p=='role' AND $act=='delete'){
	mysqli_query($conn, "DELETE FROM departemenrole WHERE idDepart = '$_GET[id]'");
	echo"
		<script>
			alert('Delete departemenrole berhasil.');window.location = '../../page.php?n=role';
		</script>";
}
?>