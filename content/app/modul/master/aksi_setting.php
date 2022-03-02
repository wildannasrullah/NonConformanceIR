<?php
error_reporting(0);
session_start();
include("../../../../config/koneksi.php");
$p	=$_GET[n];  $act	=$_GET[act];

if($p=='msetting' AND $act=='input'){
	mysqli_query($conn, "INSERT INTO msetting VALUE(NULL, '$_POST[name_setting]')");
	echo"
		<script>
			alert('Tambah setting berhasil.');window.location = '../../page.php?n=setting';
		</script>";
}
if($p=='msetting' AND $act=='inputValue'){
	mysqli_query($conn, "INSERT INTO msetting_value VALUE(NULL, '$_POST[name_setting]')");
	echo"
		<script>
			alert('Tambah setting berhasil.');window.location = '../../page.php?n=setting';
		</script>";
}
if($p=='msetting' AND $act=='edit'){/* 
	$var = mysqli_real_escape_string($conn, $_POST[value_setting]); */
	mysqli_query($conn, "UPDATE msetting SET 
								 name_set = '$_POST[name_setting]'
								 WHERE idSetting  = '$_POST[id]'");

	echo"
		<script>
			alert('Edit Setting berhasil.');window.location = '../../page.php?n=setting';
		</script>";
}
if($p=='setting' AND $act=='delete'){
	mysqli_query($conn, "DELETE FROM msetting WHERE idSetting = '$_GET[id]'");
	echo"
		<script>
			alert('Delete Setting berhasil.');window.location = '../../page.php?n=setting';
		</script>";
}
if($p=='setting' AND $act=='jumlah'){
	echo"
		<script>
			window.location = '../../page.php?n=setting&act=add_value&no=$_GET[no]&j=$_POST[j]';
		</script>";
}
if($p=='msetting' AND $act=='valuenya'){
	$j=$_GET['j'];     
	for($i=1;$i<=$j;$i++)
	{   
		$id=$_POST['id'][$i];
		$nodoc=$_POST['value_setting'][$i];
		if($nodoc == ''){}
		else{
			mysqli_query($conn, "INSERT INTO msetting_value VALUE (NULL, '$id','$nodoc')");
		}
	} 
	echo"
		<script>
			alert('Tambah Value berhasil. $nodoc');window.location = '../../page.php?n=setting';
		</script>";
}
if($p=='value' AND $act=='delete'){
	mysqli_query($conn, "DELETE FROM msetting_value WHERE idValue = '$_GET[id_v]'");
	echo"
		<script>
			window.location = '../../page.php?n=setting&act=add_value&no=$_GET[no]&j=$_GET[j]';
		</script>";
}
?>