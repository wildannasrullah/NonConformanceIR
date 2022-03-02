<?php
//error_reporting(0);
session_start();
include("../../../../config/koneksi.php");
$p	=$_GET['n'];  $act	=$_GET['act'];

if($p=='input-ncr' AND $act=='input')
{
	
	$m = date('m');$d = date('d');$y = date('Y');
	$dated = date('Y-m-d');	
	$dd = "$m/$d/$y";
	$newID="";
	$t = mysqli_fetch_array(mysqli_query($conn, "select max(ncrCode) as no from ncr_inspection"));
	if (count($t) > 0 ) {
		$noUrut = (int) substr($t['no'], 5, 3);
		$noUrut++;
		$char = "NCR-";
		$newID = $char . sprintf("%03s", $noUrut);
	}
	else
	{
		$newID="NCR-001";
	}

	if(isset($_FILES))
	{
		print_r($_FILES);
		for($i=0;$i<count($_FILES['lampiran']['name']) ;$i++) {
		$nm=$_FILES['lampiran']['name'][$i];
		if($nm!='')
		{
			$nama=$newID."-".$i.substr($nm,-4);
			$temp=$_FILES['lampiran']['tmp_name'][$i];
			echo "nama : ".$nama." tmp ".$temp;
			move_uploaded_file($temp, 'print/temp/'.$nama);

			$file_query=mysqli_query($conn,"INSERT INTO ncr_files (`idNcr`, `nama`) values ('$newID', '$nama')");
			if($file_query)
			{}
				else{
					echo "error".mysqli_error($conn);
				}
		}
		
		}
		
		
	}										
	$no_ncr	= $newID;
	$inspek='';
	if($_POST['inspek']=="lain-lain")
	{
		$inspek=$_POST['lain-lain'];
	}
	else
	{
		$inspek=$_POST['inspek'];
	}
	$query_insert=mysqli_query($conn, "INSERT INTO ncr_inspection 
						VALUES ('$no_ncr', '$_POST[tgl_ncr]', '$_POST[penerbit]','$_POST[tujuan]','$inspek','$_POST[uraian]','$_SESSION[username]',NOW(),NULL,NULL,'$_SESSION[username]',NOW())");
	if($query_insert)
	{

		echo"
			<script>
				alert('Berhasil simpan inspection document, kode : $_POST[penerbit] --> $_POST[tujuan]');window.location = '../../page.php?n=input-ncr';
			</script>";
	}
	else
	{
		echo mysqli_error($conn);
	}
	
}

if($p=='input-ncr' AND $act=='approve')
{
	$query_update=mysqli_query($conn, "UPDATE ncr_inspection SET 
								 approvedBy		 = '$_SESSION[username]',
								 approvedDate	 = NOW()
								 WHERE ncrCode  = '$_POST[no_ncr]'");
	if($query_update)
	{
		echo"
			<script>
				alert('Menyetujui dokumen $_POST[no_ncr], berhasil.');window.location = '../../page.php?n=input-ncr&k=1&no=$_POST[no_ncr]';
			</script>";
	}
	else
		{
			echo mysqli_error($conn);
		}
	
}

if($p=='input-ncr' AND $act=='disapproved'){
	$query_update=mysqli_query($conn, "UPDATE ncr_inspection SET 
								 approvedBy		 = NULL,
								 approvedDate	 =NULL
								 WHERE ncrCode  = '$_POST[no_ncr]'");
	if($query_update)
	{
		echo"
		<script>
			alert('Membatalkan dokumen $_POST[no_ncr], berhasil.');window.location = '../../page.php?n=input-ncr&k=1&no=$_POST[no_ncr]';
		</script>";
	}
	else
	{
		echo mysqli_error($conn);
	}
	
}
if($p=='input-ncr' AND $act=='edit'){
	$query_edit=mysqli_query($conn, "UPDATE ncr_inspection SET 
								tanggal_ncr 		= '$_POST[tgl_ncr]', 
								penerbit 			= '$_POST[penerbit]', 
								tujuan 				= '$_POST[tujuan]', 
								jenis_inspection 	= '$_POST[inspek]'	,
								uraian 				= '$_POST[uraian]', 
								
								changedBy 			= '$_SESSION[username]', 
								changedDate 		= NOW()
								WHERE ncrCode  		= '$_POST[no_ncr]'");
	$sem_no=mysqli_query($conn, "SELECT * FROM ncr_files WHERE idNcr ='$_POST[no_ncr]' ");
	$num=mysqli_num_rows($sem_no);
	if(isset($_FILES))
	{
		
		for($i=0;$i<count($_FILES['lampiran']['name']) ;$i++) {
		$nm=$_FILES['lampiran']['name'][$i];
		if($nm!='')
		{
			$nama=$_POST['no_ncr']."-".$num.substr($nm,-4);
			$temp=$_FILES['lampiran']['tmp_name'][$i];
			echo "nama : ".$nama." tmp ".$temp;
			move_uploaded_file($temp, 'print/temp/'.$nama);

			$file_query=mysqli_query($conn,"INSERT INTO ncr_files (`idNcr`, `nama`) values ('$_POST[no_ncr]', '$nama')");
			if($file_query)
			{}
				else{
					echo "error".mysqli_error($conn);
				}
			$num++;
		}
		
		}
		
		
	}	
	if ($query_edit) {
		echo"
		<script>
			alert('Edit NCR berhasil.');window.location = '../../page.php?n=input-ncr&k=1&no=$_POST[no_ncr]&d=1';
		</script>";
	}
	else
	{
		echo mysqli_error($conn);
	}
	
}
if($p=='input-ncr' AND $act=='delete-file'){
	$idfile=$_GET['id'];
	$query=mysqli_query($conn,"DELETE FROM ncr_files WHERE idFileLampiran=".$idfile);
	if($query)
	{
		echo "
		<script>
			alert('Hapus Lampiran NCR berhasil.');window.location = '../../page.php?n=input-ncr&k=1&no=".$_GET['no']."&d=1';
		</script>";
	}
}
if ($p=='input-ncr' AND $act=='delete') {
	$query=mysqli_query($conn, "DELETE FROM ncr_inspection WHERE ncrCode ='$_GET[no]' ");
	if ($query) {
		echo "
		<script>
			alert('Hapus  $_GET[no] berhasil .');window.location = '../../page.php?n=input-ncr';
		</script>";
	}
}

// KOREKSI

if($p=='input-correction' AND $act=='input')
{
$m = date('m');$d = date('d');$y = date('Y');
$dated = date('Y-m-d');	
$dd = "$m/$d/$y";
$newID="";
$t = mysqli_fetch_array(mysqli_query($conn, "select max(idCorNcr) as no , date(createdDate) as tgl_n from ncr_correction where date(createdDate)='$dated' "));
if (count($t)>0) {
	$noUrut = (int) substr($t['no'], 14, 3);
	$noUrut++;
	$char = "COR-$y$m$d-";
	$newID = $char . sprintf("%03s", $noUrut);
}
else
{
	$newID="COR-001";
}
	/**/									
	$no_cor	= $newID;
	$query_input=mysqli_query($conn, "INSERT INTO ncr_correction (`idCorNcr`,  `rootCouse`, `correctiveAction`, `createdBy`, `createdDate`, `approvedBy`, `approvedDate`, `ncrCode`, `changedBy`, `changedDate`) VALUES ('$no_cor', '$_POST[root]', '$_POST[correct]','$_SESSION[username]',NOW(),NULL,NULL,'$_POST[kode]','$_SESSION[username]',NOW())");
	
	if($query_input)
	{
		$jc = $_POST['koreksi'];
		$jumlah_dipilih = count($jc);
		for($x=0;$x<$jumlah_dipilih;$x++){
			if(mysqli_query($conn, "INSERT INTO ncr_correction_type VALUES (NULL,'$no_cor','$jc[$x]')"))
			{

			}
			else
			{
				echo mysqli_error($conn);
			}
		}
		echo"
			<script>
				alert('Berhasil simpan correction document');window.location = '../../page.php?n=list-ncr';
			</script>";
	}
	else
	{
		echo mysqli_error($conn);
	}
	
}
if($p=='input-correction' AND $act=='edit'){
	$query_update=mysqli_query($conn, "UPDATE ncr_correction SET 
								rootCouse 			= '$_POST[root]', 
								correctiveAction 	= '$_POST[correct]', 
								
								ChangedBy 			= '$_SESSION[username]',
								ChangedDate 		= NOW()
								WHERE idCorNcr		  	= '$_POST[idCor]'");
	if($query_update)
	{
		if(mysqli_query($conn, "DELETE FROM ncr_correction_type WHERE idCor = '$_POST[idCor]'"))
		{
			$jc = $_POST['koreksi'];
			$jumlah_dipilih = count($jc);
			for($x=0;$x<$jumlah_dipilih;$x++){
				if(mysqli_query($conn, "INSERT INTO ncr_correction_type VALUES (NULL,'$_POST[idCor]','$jc[$x]')"))
				{

				}
				else
				{
					echo mysqli_error($conn);
				}
			}
			echo"
				<script>
					alert('Berhasil simpan perubahan correction document');window.location = '../../page.php?n=list-ncr';
				</script>";
		}
		else
		{
			echo mysqli_error($conn);
		}
		
	}
	else
	{
		echo mysqli_error($conn);
	}
	
}
if($p=='input-correction' AND $act=='approve'){
	$query_update=mysqli_query($conn, "UPDATE ncr_correction SET 
								 ApprovedBy		 = '$_SESSION[username]',
								 ApprovedDate	 = NOW()
								 WHERE idCorNcr  	 = '$_POST[no_cor]'");
	if($query_update)
	{
		echo"
		<script>
			alert('Menyetujui koreksi dokumen$_POST[no_cor], berhasil.');window.location = '../../page.php?n=ncr-correction&no=$_POST[no_ncr]&cor=$_POST[no_cor]&s=finish&k=1';
		</script>";
	}
	else
	{
		echo mysqli_error($conn);
	}
	
}
if($p=='input-correction' AND $act=='disapproved'){
	$query_update=mysqli_query($conn, "UPDATE ncr_correction SET 
								 ApprovedBy		 = NULL,
								 ApprovedDate	 = NULL
								 WHERE idCorNcr   	 = '$_POST[no_cor]'");
	if($query_update)
	{
		echo"
		<script>
			alert('Membatalkan koreksi dokumen $_POST[no_ncr], berhasil.');window.location = '../../page.php?n=ncr-correction&no=$_POST[no_ncr]&cor=$_POST[no_cor]&s=finish&k=1';
		</script>";
	}
	else
	{
		echo mysqli_error($conn);
	}
	
}
?>