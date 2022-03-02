<?php
error_reporting(0);
session_start();
include("../../../../config/koneksi.php");
$p	=$_GET[n];  $act	=$_GET[act];

if($p=='departemen' AND $act=='input'){
	mysqli_query($conn, "INSERT INTO departemenmain VALUE(NULL, '$_POST[nama_dept]')");
	echo"
		<script>
			alert('Tambah Departmene berhasil.');window.location = '../../page.php?n=departemen';
		</script>";
}
if($p=='departemen' AND $act=='edit'){
	mysqli_query($conn, "UPDATE departemenmain SET 
								 DepMain = '$_POST[nama_dept]'
								 WHERE idDepMain  = '$_POST[id]'");

	echo"
		<script>
			alert('Edit Departemen berhasil.');window.location = '../../page.php?n=departemen';
		</script>";
}
if($p=='departemen' AND $act=='delete'){
	mysqli_query($conn, "DELETE FROM departemenmain WHERE idDepMain = '$_GET[id]'");
	echo"
		<script>
			alert('Delete Departemen berhasil.');window.location = '../../page.php?n=departemen';
		</script>";
}

if($p=='bagian' AND $act=='input'){
	mysqli_query($conn, "INSERT INTO departemen VALUE(NULL, '$_POST[nama_dept]','$_POST[ket]','$_POST[dept]')");
	echo"
		<script>
			alert('Tambah Departmene Bagian berhasil.');window.location = '../../page.php?n=bagian';
		</script>";
}
if($p=='bagian' AND $act=='edit'){
	mysqli_query($conn, "UPDATE departemen SET 
								 departName = '$_POST[nama_dept]',
								 ketDepart	= '$_POST[ket]',
								 idDepMain  = '$_POST[dept]'
								 WHERE idDepart  = '$_POST[id]'");

	echo"
		<script>
			alert('Edit Departemen berhasil.');window.location = '../../page.php?n=bagian';
		</script>";
}
if($p=='bagian' AND $act=='delete'){
	mysqli_query($conn, "DELETE FROM departemen WHERE idDepart = '$_GET[id]'");
	echo"
		<script>
			alert('Delete Departemen berhasil.');window.location = '../../page.php?n=bagian';
		</script>";
}
?>