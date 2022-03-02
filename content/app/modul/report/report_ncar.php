<div class='page-header'>
  <div class='page-header-title'>
    <h4>Report Non Conformance Audit Report
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

<div class='card-block'>
<div class='dt-responsive table-responsive'>
<table id='basic-btn' class='table table-striped table-bordered nowrap'>
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
if($_SESSION[level]=='admin' || $de[departName]=='Quality'){
	$q = mysqli_query($conn, "select *from ncar n left join departemen d on n.idDepart=d.idDepart where n.approvedBy IS NOT NULL order by n.ncarCode DESC");
}else{
	$q = mysqli_query($conn, "select *from ncar n left join departemen d on n.idDepart=d.idDepart where n.approvedBy IS NOT NULL AND n.idDepart = '$de[idDepart]' OR n.createdby='$_SESSION[username]' order by n.ncarCode DESC");
}	
					while($i = mysqli_fetch_array($q)){
echo"
	<tr>
		<td><a href='?n=detail-ncar&k=1&no=$i[ncarCode]'><b>$i[ncarCode]</b></a></td>
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
				echo"<font color='green' size='2'>Correction</b></font>";
			}
			else{
				echo"<font color='blue' size='2'><b>Inspection</b></font>";
			}
		}
		else{
			if($rf[jum_veri]==0 AND $rf[jum_vqa]==0){
				echo"<font color='red' size='2'>&nbsp;&nbsp;<b>Verified by Auditee</b>&nbsp;&nbsp;&nbsp;&nbsp;</font>
				</a>";
			}else if($rf[jum_veri] > 0 AND $rf[jum_vqa]==0){
				echo"<font color='red' size='2'>&nbsp;&nbsp;<b>Verified by Auditor</b>&nbsp;&nbsp;&nbsp;&nbsp;</font>
			</a>";
			}else if($rf[jum_veri] > 0 AND $rf[jum_vqa]>0){
				echo"<font color='red' size='2'>&nbsp;&nbsp;<b>Verified by QA</b>&nbsp;&nbsp;&nbsp;&nbsp;</font>
			";
			}
		}

}else{
	$n = mysqli_query($conn, "SELECT *from ncar_correction where ncarCode = '$i[ncarCode]'");
		$rf = mysqli_fetch_array($n);
		if($rf[ApprovedBy]==NULL AND $rf[ApprovedDate]==NULL){
			if(mysqli_num_rows($n)>0){
				echo"
					<font color='green' size='2'><b>Correction</b></font>";
			}
			else{
				echo"<font color='blue' size='2'><b>Inspection</b></font>
				</a>";
				
			}
		}
		else{
			echo"<font color='red' size='2'>&nbsp;&nbsp;<b>Verified</b>&nbsp;&nbsp;&nbsp;&nbsp;</font>
			</a>
			
			";
			
		}
}
		echo"
		</td>
	</tr>";
	
					}
?>
</tbody>
</table>
</div>
</div>
</div>
  
  </div>
</div>

