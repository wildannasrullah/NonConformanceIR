<?php
error_reporting(0);
session_start();
include("../../../../config/koneksi.php");
mysqli_query($conn, "UPDATE muser SET 
								 fullName  	= '$_POST[fullname]',
								 password	= '$_POST[password]'
								 WHERE idUser  = '$_POST[id_user]'");

echo"
<script>
alert('Fullname / Password Anda berhasil di perbarui.');window.location = '../../page.php?n=profile';
</script>
";
?>