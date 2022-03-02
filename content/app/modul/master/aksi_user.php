<?php
error_reporting(0);
session_start();
include("../../../../config/koneksi.php");
$p	=$_GET[n];  $act	=$_GET[act];

if($p=='user-management' AND $act=='input'){
	mysqli_query($conn, "INSERT INTO muser VALUE(NULL, '$_POST[fullname]','$_POST[username]','$_POST[password]','$_POST[level]','$_POST[email]','$_POST[role]','$_POST[jabatan]')");
	echo"
		<script>
			alert('Tambah user-management berhasil.');window.location = '../../page.php?n=user-management';
		</script>";
}
if($p=='user-management' AND $act=='edit'){
	mysqli_query($conn, "UPDATE muser SET 
								 fullName = '$_POST[fullname]',
								 username	= '$_POST[username]',
								 password = '$_POST[password]',
								 level = '$_POST[level]',
								 email = '$_POST[email]',
								 idDep = '$_POST[role]',
								 jabatan = '$_POST[jabatan]'
								 WHERE idUser  = '$_POST[id]'");

	echo"
		<script>
			alert('Edit user management berhasil.');window.location = '../../page.php?n=user-management';
		</script>";
}
if($p=='user-management' AND $act=='delete'){
	mysqli_query($conn, "DELETE FROM muser WHERE idUser = '$_GET[id]'");
	echo"
		<script>
			alert('Delete user management berhasil.');window.location = '../../page.php?n=user-management';
		</script>";
}
?>