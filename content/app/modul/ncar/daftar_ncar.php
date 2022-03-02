<div class='page-header'>
  <div class='page-header-title'>
    <h4>Non Conformance Audit Report
    </h4>
    <span>Laporan Ketidaksesuaian Audit
    </span>
  </div>
  <div class='page-header-breadcrumb'>
    <ul class='breadcrumb-title'>
      <li class='breadcrumb-item'>
        <a href='index.html'>
          <i class='icofont icofont-home'>
          </i>
        </a>
      </li>
      <li class='breadcrumb-item'>
        <a href='#!'>Transaction
        </a>
      </li>
      <li class='breadcrumb-item'>
        <a href='#!'>NCAR
        </a>
      </li>
    </ul>
  </div>
</div>

<!-- FORM INPUT -->

<div class='page-body'>
  <div class='row'>
    <div class='col-sm-12'>
	
	<div class='card'>
	<div class='card-header'>
<div class='card-header-left'>
<h5>Send Corrections</h5>
</div>

<div class='card-block'>
<div class='dt-responsive table-responsive'>
<table id='footer-search' class='table table-striped table-bordered nowrap'>
<thead>
<tr>
<th style='display:none'>No.</th>
<th>No. NCAR</th>
<th>Tanggal Audit</th>
<th>Departemen</th>
<th>Dok. Acuan</th>
<th>Objektif</th>
<th>Lokasi</th>
<th>Referensi</th>
<th>#</th>
</tr>
</thead>
<tbody>
<?php
$u = mysqli_query($conn, "select *from muser where username='$_SESSION[username]'");
					$e = mysqli_fetch_array($u);
					$d = mysqli_query($conn, "select *from departemenrole dr 
											  left join departemen d on dr.idDepart=d.idDepart
											  left join departemenmain dm on d.idDepMain=dm.idDepMain
											  where dr.idDep='$e[idDep]'");
					$de = mysqli_fetch_array($d);
/* $q = mysqli_query($conn, "select *from ncar_inspection where approvedBy is not null and approvedDate is not null order by ncarCode DESC"); */
if($_SESSION[level]=='admin' || $de[departName]=='Quality'){
	$q2 = mysqli_query($conn, "select *from ncar n left join departemen d on n.idDepart=d.idDepart where n.approvedBy IS NOT NULL order by n.ncarCode DESC");
}else{
	$q2 = mysqli_query($conn, "select *from ncar n left join departemen d on n.idDepart=d.idDepart where n.approvedBy IS NOT NULL AND n.createdBy = '$_SESSION[username]' order by n.ncarCode DESC");
}	
$jb=1;
	while($i = mysqli_fetch_array($q2)){
echo"
	<tr>
		<td style='display:none'>$jb</td>
		<td>$i[ncarCode]</td>
		<td>$i[tanggal_audit]</td>
		<td>$i[departName]</td>
		<td>$i[dokAcuan]</td>
		<td>$i[objektif]</td>
		<td>$i[lokasi]</td>
		<td>$i[referensi]</td>
		<td>";
$jb++;
$u = mysqli_query($conn, "select *from muser where username='$_SESSION[username]'");
$e = mysqli_fetch_array($u);
$d = mysqli_query($conn, "select *from departemenrole where idDep='$e[idDep]'");
$de = mysqli_fetch_array($d);
$re = mysqli_query($conn, "select *from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='ButtonCorrectionNCAR' and value_set='$de[depName]'");
//SELEKSI SETTING
if(mysqli_num_rows($re)>0){

$p = mysqli_query($conn, "select *from ncar_correction where idCorNcar='$_GET[coir]'");
$g = mysqli_fetch_array($p);
		//SELEKSI Approved atau tidak
		$n = mysqli_query($conn, "SELECT count(v.idNcarVer) as jum_veri, v.createdby, count(vq.idVerQa) as jum_vqa, vq.createdByQa, n.* from ncar_correction n
								  left join ncar_verifikasi v on n.ncarCode = v.ncarCode 
								  left join ncar_verifikasi_qa vq on n.ncarCode = vq.ncarCode
								  where n.ncarCode = '$i[ncarCode]'");
		$rf = mysqli_fetch_array($n);
		if($rf[ApprovedBy]==NULL AND $rf[ApprovedDate]==NULL){
			if(mysqli_num_rows($n)>0){
				echo"<a href='page.php?n=ncar-correction&no=$i[ncarCode]&coir=$rf[idCorNcar]&s=finish&k=1' title='Show Detail Correction'>
					<button type='button' class='btn btn-success btn-sm'><b>Correction</b></button>
				</a>";

				?>
				<a href='<?php echo "modul/ncar/aksi_ncar.php?n=ncar-correction&no=$i[ncarCode]&coir=$rf[idCorNcar]&s=finish&k=1&act=delete";?>' onclick="return confirm('Apakah Anda yakin untuk menghapus koreksi ini?');"><?php
				echo"
					<button type='button' class='btn btn-info btn-sm'><b>Delete</b></button>
				</a>";
			}
			else{
				echo"<a href='page.php?n=ncar-correction&no=$i[ncarCode]&coir=$rf[idCorNcar]' title='Show Detail Inspection'>
					<button type='button' class='btn btn-success btn-sm'><b>Inspection</b></button>
				</a><button type='button' class='btn btn-default btn-sm' disabled=''><b>Delete</b></button>";
			}
		}
		else{
			if($rf[jum_veri]==0 AND $rf[jum_vqa]==0){
				echo"<a href='page.php?n=ncar-correction&no=$i[ncarCode]&coir=$rf[idCorNcar]&s=finish&k=1'  title='Show Detail All'>
				<button type='button' class='btn btn-danger btn-sm' title='Verified by Auditee' >&nbsp;&nbsp;<b>Verified by Auditee</b>&nbsp;&nbsp;&nbsp;&nbsp;</button>
				</a><button type='button' class='btn btn-default btn-sm' disabled=''><b>Delete</b></button>";
			}else if($rf[jum_veri] > 0 AND $rf[jum_vqa]==0){
				echo"<a href='page.php?n=ncar-correction&no=$i[ncarCode]&coir=$rf[idCorNcar]&s=finish&k=1'  title='Show Detail All'>
				<button type='button' class='btn btn-warning btn-sm' title='Verified by Auditor' >&nbsp;&nbsp;<b>Verified by Auditor</b>&nbsp;&nbsp;&nbsp;&nbsp;</button>
			</a><button type='button' class='btn btn-default btn-sm' disabled=''><b>Delete</b></button>";
			}else if($rf[jum_veri] > 0 AND $rf[jum_vqa]>0){
				echo"<a href='page.php?n=ncar-correction&no=$i[ncarCode]&coir=$rf[idCorNcar]&s=finish&k=1'  title='Show Detail All'>
				<button type='button' class='btn btn-danger btn-sm' title='Verified by QA' >&nbsp;&nbsp;<b>Verified by QA</b>&nbsp;&nbsp;&nbsp;&nbsp;</button>
			</a><button type='button' class='btn btn-default btn-sm' disabled=''><b>Delete</b></button>";
			}
		}

}else{
	$n = mysqli_query($conn, "SELECT *from ncar_correction where ncarCode = '$i[ncarCode]'");
		$rf = mysqli_fetch_array($n);
		if($rf[ApprovedBy]==NULL AND $rf[ApprovedDate]==NULL){
			if(mysqli_num_rows($n)>0){
				echo"
					<button type='button' class='btn btn-success btn-sm' disabled='disabled'><b>Correction</b></button>
				<button type='button' class='btn btn-default btn-sm' disabled=''><b>Delete</b></button>";
			}
			else{
				echo"<a href='page.php?n=input-ncar&k=1&no=$i[ncarCode]'>
					<button type='button' class='btn btn-info btn-sm'><b>Inspection</b></button>
				</a>";
				?>
				<a href='<?php echo "$aksi?n=list-ncar&act=delete&no=$i[ncarCode]";?>' onclick="return confirm('Apakah Anda yakin untuk menghapus dokumen ini?');"><?php
				echo"
				<button type='button' class='btn btn-warning btn-sm'><b>Delete</b></button></a>";
			}
		}
		else{
			echo"<a href='page.php?n=ncar-correction&no=$i[ncarCode]&coir=$rf[idCorNcar]&s=finish&k=1'>
				<button type='button' class='btn btn-danger btn-sm' title='Sudah Dikoreksi' >&nbsp;&nbsp;<b>Verified</b>&nbsp;&nbsp;&nbsp;&nbsp;</button>
			</a><button type='button' class='btn btn-default btn-sm' disabled=''><b>Delete</b></button>
			
			";
			
		}
}
		echo"
		</td>
	</tr>";
	
					}
?>
</tbody>
<tfoot>
<tr>
<th>No. NCAR</th>
<th>Tanggal Audit</th>
<th>Departemen</th>
<th>Dok. Acuan</th>
<th>Objektif</th>
<th>Lokasi</th>
<th>Referensi</th>
<th style='display:none'>&nbsp;</th>

</tr>
</tfoot>
</table>
</div>
</div>
</div>
  
  </div>
  
  
  <div class='card'>
	<div class='card-header'>
<div class='card-header-left'>
<h5>Get Correction</h5>
</div>

<div class='card-block'>
<div class='dt-responsive table-responsive'>
<table id='multi-colum-dt' class='table table-striped table-bordered nowrap'>
<thead>
<tr>
<th>No. NCAR</th>
<th>Tanggal Audit</th>
<th>Departemen</th>
<th>Dok. Acuan</th>
<th>Objektif</th>
<th>Lokasi</th>
<th>Referensi</th>
<th>#</th>
</tr>
</thead>
<tbody>
<?php
$u = mysqli_query($conn, "select *from muser where username='$_SESSION[username]'");
					$e = mysqli_fetch_array($u);
					$d = mysqli_query($conn, "select *from departemenrole dr 
											  left join departemen d on dr.idDepart=d.idDepart
											  left join departemenmain dm on d.idDepMain=dm.idDepMain
											  where dr.idDep='$e[idDep]'");
					$de = mysqli_fetch_array($d);
/* $q = mysqli_query($conn, "select *from ncar_inspection where approvedBy is not null and approvedDate is not null order by ncarCode DESC"); */
if($_SESSION[level]=='admin'){
	$q = mysqli_query($conn, "select *from ncar n left join departemen d on n.idDepart=d.idDepart where n.approvedBy IS NOT NULL order by n.ncarCode DESC");
}else{
	$q = mysqli_query($conn, "select *from ncar n left join departemen d on n.idDepart=d.idDepart where n.approvedBy IS NOT NULL AND n.idDepart = '$de[idDepart]' order by n.ncarCode DESC");
}	
	while($i = mysqli_fetch_array($q)){
echo"
	<tr>
		<td>$i[ncarCode]</td>
		<td>$i[tanggal_audit]</td>
		<td>$i[departName]</td>
		<td>$i[dokAcuan]</td>
		<td>$i[objektif]</td>
		<td>$i[lokasi]</td>
		<td>$i[referensi]</td>
		<td>";
$u = mysqli_query($conn, "select *from muser where username='$_SESSION[username]'");
$e = mysqli_fetch_array($u);
$d = mysqli_query($conn, "select *from departemenrole where idDep='$e[idDep]'");
$de = mysqli_fetch_array($d);
$re = mysqli_query($conn, "select *from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='ButtonCorrectionNCAR' and value_set='$de[depName]'");
//SELEKSI SETTING
if(mysqli_num_rows($re)>0){

$p = mysqli_query($conn, "select *from ncar_correction where idCorNcar='$_GET[coir]'");
$g = mysqli_fetch_array($p);
		//SELEKSI Approved atau tidak
		$n = mysqli_query($conn, "SELECT count(v.idNcarVer) as jum_veri, v.createdby, count(vq.idVerQa) as jum_vqa, vq.createdByQa, n.* from ncar_correction n
								  left join ncar_verifikasi v on n.ncarCode = v.ncarCode 
								  left join ncar_verifikasi_qa vq on n.ncarCode = vq.ncarCode
								  where n.ncarCode = '$i[ncarCode]'");
		$rf = mysqli_fetch_array($n);
		if($rf[ApprovedBy]==NULL AND $rf[ApprovedDate]==NULL){
			if(mysqli_num_rows($n)>0){
				echo"<a href='page.php?n=ncar-correction&no=$i[ncarCode]&coir=$rf[idCorNcar]&s=finish&k=1' title='Show Detail Correction'>
					<button type='button' class='btn btn-success btn-sm'><b>Correction</b></button>
				</a>";

				?>
				<a href='<?php echo "modul/ncar/aksi_ncar.php?n=ncar-correction&no=$i[ncarCode]&coir=$rf[idCorNcar]&s=finish&k=1&act=delete";?>' onclick="return confirm('Apakah Anda yakin untuk menghapus koreksi ini?');"><?php
				echo"
					<button type='button' class='btn btn-info btn-sm'><b>Delete</b></button>
				</a>";
			}
			else{
				echo"<a href='page.php?n=ncar-correction&no=$i[ncarCode]&coir=$rf[idCorNcar]' title='Show Detail Inspection'>
					<button type='button' class='btn btn-success btn-sm'><b>Inspection</b></button>
				</a><button type='button' class='btn btn-default btn-sm' disabled=''><b>Delete</b></button>";
			}
		}
		else{
			if($rf[jum_veri]==0 AND $rf[jum_vqa]==0){
				echo"<a href='page.php?n=ncar-correction&no=$i[ncarCode]&coir=$rf[idCorNcar]&s=finish&k=1'  title='Show Detail All'>
				<button type='button' class='btn btn-danger btn-sm' title='Verified by Auditee' >&nbsp;&nbsp;<b>Verified by Auditee</b>&nbsp;&nbsp;&nbsp;&nbsp;</button>
				</a><button type='button' class='btn btn-default btn-sm' disabled=''><b>Delete</b></button>";
			}else if($rf[jum_veri] > 0 AND $rf[jum_vqa]==0){
				echo"<a href='page.php?n=ncar-correction&no=$i[ncarCode]&coir=$rf[idCorNcar]&s=finish&k=1'  title='Show Detail All'>
				<button type='button' class='btn btn-warning btn-sm' title='Verified by Auditor' >&nbsp;&nbsp;<b>Verified by Auditor</b>&nbsp;&nbsp;&nbsp;&nbsp;</button>
			</a><button type='button' class='btn btn-default btn-sm' disabled=''><b>Delete</b></button>";
			}else if($rf[jum_veri] > 0 AND $rf[jum_vqa]>0){
				echo"<a href='page.php?n=ncar-correction&no=$i[ncarCode]&coir=$rf[idCorNcar]&s=finish&k=1'  title='Show Detail All'>
				<button type='button' class='btn btn-danger btn-sm' title='Verified by QA' >&nbsp;&nbsp;<b>Verified by QA</b>&nbsp;&nbsp;&nbsp;&nbsp;</button>
			</a><button type='button' class='btn btn-default btn-sm' disabled=''><b>Delete</b></button>";
			}
		}

}else{
	$n = mysqli_query($conn, "SELECT *from ncar_correction where ncarCode = '$i[ncarCode]'");
		$rf = mysqli_fetch_array($n);
		if($rf[ApprovedBy]==NULL AND $rf[ApprovedDate]==NULL){
			if(mysqli_num_rows($n)>0){
				echo"
					<button type='button' class='btn btn-success btn-sm' disabled='disabled'><b>Correction</b></button>
				<button type='button' class='btn btn-default btn-sm' disabled=''><b>Delete</b></button>";
			}
			else{
				echo"<a href='page.php?n=input-ncar&k=1&no=$i[ncarCode]'>
					<button type='button' class='btn btn-info btn-sm'><b>Inspection</b></button>
				</a>";
				?>
				<a href='<?php echo "$aksi?n=list-ncar&act=delete&no=$i[ncarCode]";?>' onclick="return confirm('Apakah Anda yakin untuk menghapus dokumen ini?');"><?php
				echo"
				<button type='button' class='btn btn-warning btn-sm'><b>Delete</b></button></a>";
			}
		}
		else{
			echo"<a href='page.php?n=ncar-correction&no=$i[ncarCode]&coir=$rf[idCorNcar]&s=finish&k=1'>
				<button type='button' class='btn btn-danger btn-sm' title='Sudah Dikoreksi' >&nbsp;&nbsp;<b>Verified</b>&nbsp;&nbsp;&nbsp;&nbsp;</button>
			</a><button type='button' class='btn btn-default btn-sm' disabled=''><b>Delete</b></button>
			
			";
			
		}
}
		echo"
		</td>
	</tr>";
	
					}
?>
</tbody>
<tfoot>
<tr>
<th>No. NCAR</th>
<th>Tanggal Audit</th>
<th>Departemen</th>
<th>Dok. Acuan</th>
<th>Objektif</th>
<th>Lokasi</th>
<th>Referensi</th>
<th style='display:none'>&nbsp;</th>

</tr>
</tfoot>
</table>
</div>
</div>
</div>
  
  </div>
  
</div>

