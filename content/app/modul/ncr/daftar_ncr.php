<div class='page-header'>
  <div class='page-header-title'>
    <h4>Non Conformance Report
    </h4>
    <span>Laporan Pemeriksaan Yang Tidak Sesuai
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
        <a href='#!'>NCR
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
<h5>CORRECTION</h5>
</div>

<div class='card-block'>
<div class='dt-responsive table-responsive'>
<table id='footer-search' class='table table-striped table-bordered nowrap'>
<thead>
<tr>
<th>No. NCR</th>
<th>Tanggal Inspeksi</th>
<th>Jenis Inspeksi</th>
<th>Penerbit</th>
<th>Correction</th>
</tr>
</thead>
<tbody>
<?php
$u = mysqli_query($conn, "select *from muser where username='$_SESSION[username]'");
$e = mysqli_fetch_array($u);
$dv = mysqli_query($conn, "select *from departemenrole dr 
						  left join departemen d on dr.idDepart=d.idDepart
						  left join departemenmain dm on d.idDepMain=dm.idDepMain
						  where dr.idDep='$e[idDep]'");
$arrUser = mysqli_fetch_array($dv);

$q = mysqli_query($conn, "select *from ncr_inspection left join departemen on departemen.idDepart = ncr_inspection.penerbit  WHERE approvedBy IS NOT NULL AND approvedDate IS NOT NULL AND tujuan='$arrUser[idDepart]' order by ncrCode DESC");
$q2 = mysqli_query($conn, "select *from ncr_inspection left join departemen on departemen.idDepart = ncr_inspection.penerbit  WHERE approvedBy IS NOT NULL AND approvedDate IS NOT NULL  AND tujuan='$arrUser[idDepart]' OR penerbit='$arrUser[idDepart]' order by ncrCode DESC");
/* $username = $_SESSION['username'] ;
$user=mysqli_query($conn,"SELECT * FROM muser WHERE username='".$username."'");
$arrUser=mysqli_fetch_array($user); */



$dep = mysqli_fetch_array($q2);
if($arrUser['idDepart']==$dep['tujuan'])
{
	while($i = mysqli_fetch_array($q)){
		echo"
			<tr>
				<td>$i[ncrCode]</td>
				<td align='center'>".tgl_indo($i[tanggal_ncr])."</td>
				<td>$i[jenis_inspection]</td>
				<td>$i[departName]</td>
				<td>";
		$u = mysqli_query($conn, "select *from muser where username='$_SESSION[username]'");
		$e = mysqli_fetch_array($u);
		$d = mysqli_query($conn, "select *from departemenrole where idDep='$e[idDep]'");
		$de = mysqli_fetch_array($d);
		$re = mysqli_query($conn, "select *from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
									where m.name_set='ButtonCorrectionNCR' and value_set='$de[depName]'");
		//SELEKSI SETTING
		if(mysqli_num_rows($re)>0){
		
		$p = mysqli_query($conn, "select *from ncr_correction where idCor='$_GET[cor]'");
		$g = mysqli_fetch_array($p);
				//SELEKSI Approved atau tidak
				
				$n = mysqli_query($conn, "SELECT *from ncr_correction where ncrCode = '$i[ncrCode]'");
				$rf = mysqli_fetch_array($n);
				if(mysqli_num_rows($n)>0){
				if($rf[ApprovedBy]==NULL AND $rf[approvedDate]==NULL){
					
						echo"<a href='page.php?n=ncr-correction&no=$i[ncrCode]&cor=$rf[idCorNcr]&s=finish&k=1'>
							<button type='button' class='btn btn-warning '>Menunggu Persetujuan</button>
						</a>";
					}
					else{
						echo"<a href='page.php?n=ncr-correction&no=$i[ncrCode]&cor=$rf[idCorNcr]&s=finish&k=1'>
						<button type='button' class='btn btn-success' title='Sudah Dikoreksi' ><i class='fa fa-check'></i></button>
					</a>";
						
					}
				}
				else{
					
					echo"<a href='page.php?n=ncr-correction&no=$i[ncrCode]'>
							<button type='button' class='btn btn-danger '>Input Correction</button>
						</a>";
				}
		}
		else{
			$n = mysqli_query($conn, "SELECT *from ncr_correction where ncrCode = '$i[ncrCode]'");
				$rf = mysqli_fetch_array($n);
				if($rf[ApprovedBy]==NULL AND $rf[approvedDate]==NULL){
					if(mysqli_num_rows($n)>0){
						echo"<a href='page.php?n=ncr-correction&no=$i[ncrCode]&cor=$rf[idCorNcr]&s=finish&k=1'>
							<button type='button' class='btn btn-warning ' disabled='disabled'>Menunggu Persetujuan</button>
						</a>";
					}
					else{
						echo"<a href='page.php?n=ncr-correction&no=$i[ncrCode]'>
							<button type='button' class='btn btn-danger ' disabled='disabled'><i class='fa fa-pencil'></i> Input Correction</button>
						</a>";
					}
				}
				else{
					echo"<a href='page.php?n=ncr-correction&no=$i[ncrCode]&cor=$rf[idCorNcr]&s=finish&k=1'>
						<button type='button' class='btn btn-success' title='Sudah Dikoreksi' disabled='disabled'><i class='fa fa-check'></i> Sudah Dikoreksi</button>
					</a>
					
					";
					
				}
		}
				echo"
				</td>
			</tr>";
			
							}
}	
elseif($arrUser['idDepart']==$dep['penerbit'])
{
	while($i = mysqli_fetch_array($q)){
				echo"
					<tr>
						<td>$i[ncrCode]</td>
						<td>".tgl_indo($i[tanggal_ncr])."</td>
						<td>$i[jenis_inspection]</td>
						<td>$i[departName]</td>
						<td>";
				$u = mysqli_query($conn, "select *from muser where username='$_SESSION[username]'");
				$e = mysqli_fetch_array($u);
				$d = mysqli_query($conn, "select *from departemenrole where idDep='$e[idDep]'");
				$de = mysqli_fetch_array($d);
				$re = mysqli_query($conn, "select *from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
											where m.name_set='ButtonCorrectionNCR' and value_set='$de[depName]'");
				//SELEKSI SETTING
				if(mysqli_num_rows($re)>0){
				
				$p = mysqli_query($conn, "select *from ncr_correction where idCor='$_GET[cor]'");
				$g = mysqli_fetch_array($p);
						//SELEKSI Approved atau tidak
						
						$n = mysqli_query($conn, "SELECT *from ncr_correction where ncrCode = '$i[ncrCode]'");
						$rf = mysqli_fetch_array($n);
						if(mysqli_num_rows($n)>0){
						if($rf[ApprovedBy]==NULL AND $rf[approvedDate]==NULL){
							
								echo"<a href='page.php?n=ncr-correction&no=$i[ncrCode]&cor=$rf[idCorNcr]&s=finish&k=1'>
									<button type='button' class='btn btn-warning '>Menunggu Persetujuan</button>
								</a>";
							}
							else{
								echo"<a href='page.php?n=ncr-correction&no=$i[ncrCode]&cor=$rf[idCorNcr]&s=finish&k=1'>
								<button type='button' class='btn btn-success' title='Sudah Dikoreksi' ><i class='fa fa-check'></i></button>
							</a>";
								
							}
						}
						else{
							
							echo"<a href='page.php?n=ncr-correction&no=$i[ncrCode]'>
									<button type='button' class='btn btn-danger '>Input Correction</button>
								</a>";
						}
				}
				else{
					$n = mysqli_query($conn, "SELECT *from ncr_correction where ncrCode = '$i[ncrCode]'");
						$rf = mysqli_fetch_array($n);
						if($rf[ApprovedBy]==NULL AND $rf[approvedDate]==NULL){
							if(mysqli_num_rows($n)>0){
								echo"<a href=''>
									<button type='button' class='btn btn-warning ' disabled='disabled'>Menunggu Persetujuan</button>
								</a>";
							}
							else{
								echo"<a href=''>
									<button type='button' class='btn btn-danger ' disabled='disabled'><i class='fa fa-pencil'></i> Input Correction</button>
								</a>";
							}
						}
						else{
							echo"<a href='page.php?n=ncr-correction&no=$i[ncrCode]'>
								<button type='button' class='btn btn-success' title='Sudah Dikoreksi' ><i class='fa fa-check'></i> Sudah Dikoreksi</button>
							</a>
							
							";
							
						}
				}
						echo"
						</td>
					</tr>";
					
									}
}
// while($i = mysqli_fetch_array($q)){
// 	echo"
// 		<tr>
// 			<td>$i[ncrCode]</td>
// 			<td>$i[tanggal_ncr]</td>
// 			<td>$i[jenis_inspection]</td>
// 			<td>$i[departName]</td>
// 			<td>";
// 	$u = mysqli_query($conn, "select *from muser where username='$_SESSION[username]'");
// 	$e = mysqli_fetch_array($u);
// 	$d = mysqli_query($conn, "select *from departemenrole where idDep='$e[idDep]'");
// 	$de = mysqli_fetch_array($d);
// 	$re = mysqli_query($conn, "select *from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
// 								where m.name_set='ButtonCorrectionNCR' and value_set='$de[depName]'");
// 	//SELEKSI SETTING
// 	if(mysqli_num_rows($re)>0){
	
// 	$p = mysqli_query($conn, "select *from ncr_correction where idCor='$_GET[cor]'");
// 	$g = mysqli_fetch_array($p);
// 			//SELEKSI Approved atau tidak
			
// 			$n = mysqli_query($conn, "SELECT *from ncr_correction where ncrCode = '$i[ncrCode]'");
// 			$rf = mysqli_fetch_array($n);
// 			if(mysqli_num_rows($n)>0){
// 			if($rf[approvedBy]==NULL AND $rf[approvedDate]==NULL){
				
// 					echo"<a href='page.php?n=ncr-correction&no=$i[ncrCode]&cor=$rf[idCorNcr]&s=finish&k=1'>
// 						<button type='button' class='btn btn-warning '>Menunggu Persetujuan</button>
// 					</a>";
// 				}
// 				else{
// 					echo"<a href='page.php?n=ncr-correction&no=$i[ncrCode]&cor=$rf[idCorNcr]&s=finish&k=1'>
// 					<button type='button' class='btn btn-success' title='Sudah Dikoreksi' ><i class='fa fa-check'></i></button>
// 				</a>";
					
// 				}
// 			}
// 			else{
				
// 				echo"<a href='page.php?n=ncr-correction&no=$i[ncrCode]'>
// 						<button type='button' class='btn btn-danger '>Input Correction</button>
// 					</a>";
// 			}
// 	}
// 	else{
// 		$n = mysqli_query($conn, "SELECT *from ncr_correction where ncrCode = '$i[ncrCode]'");
// 			$rf = mysqli_fetch_array($n);
// 			if($rf[ApprovedBy]==NULL AND $rf[ApprovedDate]==NULL){
// 				if(mysqli_num_rows($n)>0){
// 					echo"<a href='page.php?n=ncr-correction&no=$i[ncrCode]&cor=$rf[idCorNcr]&s=finish&k=1'>
// 						<button type='button' class='btn btn-warning ' disabled='disabled'>Menunggu Persetujuan</button>
// 					</a>";
// 				}
// 				else{
// 					echo"<a href='page.php?n=ncr-correction&no=$i[ncrCode]'>
// 						<button type='button' class='btn btn-danger ' disabled='disabled'><i class='fa fa-pencil'></i> Input Correction</button>
// 					</a>";
// 				}
// 			}
// 			else{
// 				echo"<a href='page.php?n=ncr-correction&no=$i[ncrCode]&cor=$rf[idCorNcr]&s=finish&k=1'>
// 					<button type='button' class='btn btn-success' title='Sudah Dikoreksi' ><i class='fa fa-check'></i> Sudah Dikoreksi</button>
// 				</a>
				
// 				";
				
// 			}
// 	}
// 			echo"
// 			</td>
// 		</tr>";
		
// 						}				

?>
</tbody>
<tfoot>
<tr>
<th>No. NCR</th>
<th>Tanggal Inspeksi</th>
<th>Nama Barang</th>
<th>Jenis Inspeksi</th>
<th>Penerbit</th>
<th style='display:none'>&nbsp;</th>

</tr>
</tfoot>
</table>
</div>
</div>
</div>
  
  </div>
</div>

