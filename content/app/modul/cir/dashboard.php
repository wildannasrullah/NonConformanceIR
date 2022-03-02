<div class='page-header'>
  <div class='page-header-title'>
    <h4>Report
    </h4>
    <span>Report NCIR
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
        <a href='#!'>Dashboard
        </a>
      </li>
      <li class='breadcrumb-item'>
        <a href='#!'>Dasboard
        </a>
      </li>
    </ul>
  </div>
</div>
<div class='page-body'>
          <div class='row'>
            <div class='col-md-12 col-xl-4'>
              <div class='card table-card widget-primary-card'>
                <div class=''>
                  <div class='row-table'>
                    <div class='col-sm-3 card-block-big'>
					<?php
					$u = mysqli_query($conn, "select *from muser where username='$_SESSION[username]'");
					$e = mysqli_fetch_array($u);
					$d = mysqli_query($conn, "select *from departemenrole dr 
											  left join departemen d on dr.idDepart=d.idDepart
											  left join departemenmain dm on d.idDepMain=dm.idDepMain
											  where dr.idDep='$e[idDep]'");
					$de = mysqli_fetch_array($d);
					/* $q = mysqli_query($conn, "select *from ncir_inspection where approvedBy is not null and approvedDate is not null order by ncirCode DESC"); */
					$re = mysqli_query($conn, "select *from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='FullReportNCIR' and value_set='$de[depName]'");
					
					if(mysqli_num_rows($re)>0){
							$j = mysqli_query($conn, "select n.ncirCode, n.nama_barang, n.tanggal_ncir, n.penerbit, n.jenis_inspection,
											  n.tujuan, n.approvedBy, c.ApprovedBy, c.CreatedBy, d.departName
											  from ncir_inspection n left join ncir_correction c on n.ncirCode=c.ncirCode 
											  left join departemen d on n.tujuan=d.idDepart
											  left join departemenmain dm on dm.idDepMain=d.idDepMain
											  order by n.ncirCode DESC");
					}
					else{
							$j = mysqli_query($conn, "select n.ncirCode, n.nama_barang, n.tanggal_ncir, n.penerbit, n.jenis_inspection,
											  n.tujuan, n.approvedBy, c.ApprovedBy, c.CreatedBy, d.departName
											  from ncir_inspection n left join ncir_correction c on n.ncirCode=c.ncirCode 
											  left join departemen d on n.tujuan=d.idDepart
											  left join departemenmain dm on dm.idDepMain=d.idDepMain
											  WHERE dm.idDepMain = '$de[idDepMain]'
											  order by n.ncirCode DESC");
					}
					  echo"
                      <i class='icofont icofont-files'>
                      </i>
					  $de[departName]
                    </div>
                    <div class='col-sm-9'><h4>";
					
						
					echo mysqli_num_rows($j);
					  ?>
                      </h4>
                      <h6>Jumlah Dokumen Sampai Saat Ini
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class='page-header'>
</div>
<div class='page-body'>
  <div class='row'>
    <div class='col-sm-12'>
	<div class="card">

<div class="card-block">
<div class="dt-responsive table-responsive">
<table id='footer-search' class='table table-striped table-bordered nowrap'>
<thead>
<tr>
<th  style='display:none;'></th>
<th>No. NCIR</th>
<th>Tanggal Inspeksi</th>
<th>Nama Barang</th>
<th>Jenis Inspeksi</th>
<th>Penerbit</th>
<th>Tujuan</th>
<th>PO / WO</th>
<th>Correction</th>
</tr>
</thead>
<tbody>
<?php
$aksi = "modul/ncir/aksi_ncir.php";
$u = mysqli_query($conn, "select *from muser where username='$_SESSION[username]'");
					$e = mysqli_fetch_array($u);
					$d = mysqli_query($conn, "select *from departemenrole dr 
											  left join departemen d on dr.idDepart=d.idDepart
											  left join departemenmain dm on d.idDepMain=dm.idDepMain
											  where dr.idDep='$e[idDep]'");
					$de = mysqli_fetch_array($d);
/* $q = mysqli_query($conn, "select *from ncir_inspection where approvedBy is not null and approvedDate is not null order by ncirCode DESC"); */
$re = mysqli_query($conn, "select *from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='FullReportNCIR' and value_set='$de[depName]'");

if(mysqli_num_rows($re)>0){
	if($de[idDepart]==1 || $de[idDepart]==6 || $de[idDepart]==7){
		$q = mysqli_query($conn, " select n.ncirCode, n.nama_barang, n.tanggal_ncir, n.penerbit, n.jenis_inspection,
											  n.tujuan, n.approvedBy, c.ApprovedBy, c.CreatedBy, d.departName
											  from ncir_inspection n left join ncir_correction c on n.ncirCode=c.ncirCode 
											  left join departemen d on n.tujuan=d.idDepart
											  left join departemenmain dm on dm.idDepMain=d.idDepMain
											  WHERE n.approvedBy is not null AND c.ApprovedBy is NULL
											  order by n.ncirCode DESC");
	}else{
	$q = mysqli_query($conn, " select n.ncirCode, n.nama_barang, n.tanggal_ncir, n.penerbit, n.jenis_inspection,
											  n.tujuan, n.approvedBy, c.ApprovedBy, c.CreatedBy, d.departName
											  from ncir_inspection n left join ncir_correction c on n.ncirCode=c.ncirCode 
											  left join departemen d on n.tujuan=d.idDepart
											  left join departemenmain dm on dm.idDepMain=d.idDepMain
											  WHERE n.approvedBy is not null AND c.ApprovedBy is NULL AND n.tujuan='$de[idDepart]'
											  order by n.ncirCode DESC");
	}
}
else{
	if($de[idDepart]==1 || $de[idDepart]==6 || $de[idDepart]==7){
		$q = mysqli_query($conn, " select n.ncirCode, n.nama_barang, n.tanggal_ncir, n.penerbit, n.jenis_inspection,
											  n.tujuan, n.approvedBy, c.ApprovedBy, c.CreatedBy, d.departName
											  from ncir_inspection n left join ncir_correction c on n.ncirCode=c.ncirCode 
											  left join departemen d on n.tujuan=d.idDepart
											  left join departemenmain dm on dm.idDepMain=d.idDepMain
											  WHERE dm.idDepMain = '$de[idDepMain]' AND n.approvedBy is not null AND c.ApprovedBy is NULL
											  order by n.ncirCode DESC");
	}
	else{
	$q = mysqli_query($conn, " select n.ncirCode, n.nama_barang, n.tanggal_ncir, n.penerbit, n.jenis_inspection,
											  n.tujuan, n.approvedBy, c.ApprovedBy, c.CreatedBy, d.departName
											  from ncir_inspection n left join ncir_correction c on n.ncirCode=c.ncirCode 
											  left join departemen d on n.tujuan=d.idDepart
											  left join departemenmain dm on dm.idDepMain=d.idDepMain
											  WHERE dm.idDepMain = '$de[idDepMain]' AND n.approvedBy is not null AND c.ApprovedBy is NULL AND n.tujuan='$de[idDepart]'
											  order by n.ncirCode DESC");
	}
}
					while($i = mysqli_fetch_array($q)){
echo"
	<tr>
		<td style='display:none;'></td>
		<td>$i[ncirCode]</td>
		<td align='center'>".tgl_indo($i[tanggal_ncir])."</td>
		<td>$i[nama_barang]</td>
		<td>$i[jenis_inspection]</td>
		<td>$i[penerbit]</td>
		<td>$i[departName]</td>
		<td>$i[po_wo]</td>
		<td>";
$u = mysqli_query($conn, "select *from muser where username='$_SESSION[username]'");
$e = mysqli_fetch_array($u);
$d = mysqli_query($conn, "select *from departemenrole where idDep='$e[idDep]'");
$de = mysqli_fetch_array($d);
$re = mysqli_query($conn, "select *from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='ButtonCorrectionNCIR' and value_set='$de[depName]'");
//SELEKSI SETTING
if(mysqli_num_rows($re)>0){

$p = mysqli_query($conn, "select *from ncir_correction where idCor='$_GET[coir]'");
$g = mysqli_fetch_array($p);
		//SELEKSI Approved atau tidak
		
		$n = mysqli_query($conn, "SELECT *from ncir_correction where ncirCode = '$i[ncirCode]'");
		$rf = mysqli_fetch_array($n);
		if($rf[ApprovedBy]==NULL AND $rf[ApprovedDate]==NULL){
			if(mysqli_num_rows($n)>0){
				echo"<a href='page.php?n=input-correction&no=$i[ncirCode]&coir=$rf[idCor]&s=finish&k=1'>
					<button type='button' class='btn btn-success btn-sm'><b>Correction</b></button>
				</a>";
				?>
				<a href='<?php echo "$aksi?n=dashboard&act=delete&no=$i[ncirCode]";?>' onclick="return confirm('Apakah Anda yakin untuk menghapus dokumen ini?');"><?php
				echo"	<button type='button' class='btn btn-warning btn-sm'><b>Delete</b></button>
				</a>";
			}
			else{
				echo"<a href='page.php?n=input-correction&no=$i[ncirCode]'>
					<button type='button' class='btn btn-info btn-sm'><b>Inspection</b></button>
				</a><button type='button' class='btn btn-default btn-sm' disabled=''><b>Delete</b></button>";
			}
		}
		else{
			echo"<a href='page.php?n=input-correction&no=$i[ncirCode]&coir=$rf[idCor]&s=finish&k=1'>
				<button type='button' class='btn btn-danger btn-sm' title='Sudah Dikoreksi' >&nbsp;&nbsp;<b>Verified</b>&nbsp;&nbsp;&nbsp;&nbsp;</button>
			</a><button type='button' class='btn btn-default btn-sm' disabled=''><b>Delete</b></button>";
		}
}
else{
	$n = mysqli_query($conn, "SELECT *from ncir_correction where ncirCode = '$i[ncirCode]'");
		$rf = mysqli_fetch_array($n);
		if($rf[ApprovedBy]==NULL AND $rf[ApprovedDate]==NULL){
			if(mysqli_num_rows($n)>0){
				echo"<button type='button' class='btn btn-success btn-sm' disabled=''><b>Correction</b></button>
				<button type='button' class='btn btn-default btn-sm' disabled=''><b>Delete</b></button>";
			}
			else{
				echo"<a href='page.php?n=input-ncir&k=1&no=$i[ncirCode]'>
					<button type='button' class='btn btn-info btn-sm'><b>Inspection</b></button>
				</a>";
				if($i[approvedBy]!=NULL){
					echo"
						<button type='button' class='btn btn-default btn-sm' disabled=''><b>Delete</b></button></a>";
				}else{
				?>
				<a href='<?php echo "$aksi?n=list-ncir&act=delete&no=$i[ncirCode]";?>' onclick="return confirm('Apakah Anda yakin untuk menghapus dokumen ini?');"><?php
				echo"
				<button type='button' class='btn btn-warning btn-sm'><b>Delete</b></button></a>";
				}
			}
		}
		else{
			echo"<a href='page.php?n=input-correction&no=$i[ncirCode]&coir=$rf[idCor]&s=finish&k=1'>
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
<th>No. NCIR</th>
<th>Tanggal Inspeksi</th>
<th>Nama Barang</th>
<th>Jenis Inspeksi</th>
<th>Penerbit</th>
<th>Tujuan</th>
<th>PO / WO</th>
<th style='display:none'>&nbsp;</th>

</tr>
</tfoot>
</table>
</div>
</div>
</div>
</div>

