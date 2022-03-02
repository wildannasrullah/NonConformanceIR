<?php
error_reporting(0);
session_start();
include("../../../../config/koneksi.php");
$p	=$_GET[n];  $act	=$_GET[act];

if($p=='menumanagement' AND $act=='input'){
		
	$jumlah_dipilih = count($_POST[submenu]);
	$rr = $_POST[submenu];
	for($x=0;$x<$jumlah_dipilih;$x++){
	
	$menu = $_POST[submenu];
	$ff = mysqli_query($conn, "select *from menu where idMenu = '$menu[$x]'");
	$gf = mysqli_fetch_array($ff);
	
	$t = mysqli_fetch_array(mysqli_query($conn, "select *from menugroup1 where idSubMenu ='$rr[$x]'"));
	$p = $t[idMenu];
	
	if($gf[main] == 'report'){
		$q1 = mysqli_query($conn, "select *from menusubrole where idMenu = '$menu[$x]' AND idDep = '$_POST[idDep]'");
			if(mysqli_num_rows($q1)>0){	
				echo"
					<script>
						alert('Menu sudah ada1. $p - $menu[$x] - $rr[$x] - m = $gf[main]');window.location = '../../page.php?n=menumanagement';
					</script>";
			}
			else{
				mysqli_query($conn, "INSERT INTO menusubrole VALUE(NULL, '$menu[$x]',NULL,'$_POST[idDep]','$_SESSION[username]',NOW())");
				echo"
					<script>
						alert('Menu berhasil ditambahkan.');window.location = '../../page.php?n=menumanagement';
					</script>";
			}
	}else{
		$q2 = mysqli_query($conn, "select *from menusubrole where idMenu = '$p' AND idSubMenu = '$rr[$x]' AND idDep = '$_POST[idDep]'");
			if(mysqli_num_rows($q2)>0){	
				echo"
					<script>
						alert('Menu sudah ada2.  $p - $menu[$x] - $rr[$x] - m = $gf[main]');window.location = '../../page.php?n=menumanagement';
					</script>";
			}
			else{
				mysqli_query($conn, "INSERT INTO menusubrole VALUE(NULL, '$p','$rr[$x]','$_POST[idDep]','$_SESSION[username]',NOW())");
				echo"
					<script>
						alert('Menu berhasil ditambahkan.');window.location = '../../page.php?n=menumanagement';
					</script>";
			}
		}	
	}
}
if($p=='user-management' AND $act=='edit'){
	mysqli_query($conn, "UPDATE muser SET 
								 fullName = '$_POST[fullname]',
								 username	= '$_POST[username]',
								 password = '$_POST[password]',
								 level = '$_POST[level]',
								 email = '$_POST[email]',
								 idDep = '$_POST[role]'
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
if($p=='menumanagement' AND $act=='delete'){
	mysqli_query($conn, "DELETE FROM menusubrole WHERE idmsrole = '$_GET[id]'");
	echo"
		<script>
			alert('Delete menu management berhasil.');window.location = '../../page.php?n=menumanagement';
		</script>";
}
?>