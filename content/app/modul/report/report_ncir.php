<div class='page-header'>
  <div class='page-header-title'>
    <h4>Report Non Conformance Inspection Report
    </h4>
    <span>Report Non Conformance Inspection Report
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
        <a href='#!'>Report
        </a>
      </li>
      <li class='breadcrumb-item'>
        <a href='#!'>Report NCIR
        </a>
      </li>
    </ul>
  </div>
</div>

<div class='page-body'>
  <div class='row'>
    <div class='col-sm-12'>
	<div class="card">

<div class="card-block">
<div class='dt-responsive table-responsive'>
<table id='basic-btn' class='table table-striped table-bordered nowrap'>
					<thead>
					<tr>
					<th width='1%' style='display:none;'>#</th>
					<th width='10%'>NCIR Code</th>
					<th width='25%'>Nama Barang</th>
					<th width='15%'>Tanggal</th>
					<th width='15%'>Depart.</th>
					<th  width='15%'>Tujuan</th>
					<th  width='15%'>Jenis Inspeksi</th>
					<th width='13%'>Status</th>
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
					
					//QUERY UNTUK MENYELEKSI BERDASARKAN SETTING FullReportNCIR
					$re = mysqli_query($conn, "select *from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='FullReportNCIR' and value_set='$de[depName]'");

					if(mysqli_num_rows($re)>0){
						$q = mysqli_query($conn, "select n.ncirCode, n.nama_barang, n.tanggal_ncir, n.penerbit, n.jenis_inspection,
											  n.tujuan, n.approvedBy, c.ApprovedBy, c.CreatedBy, d.departName
											  from ncir_inspection n left join ncir_correction c on n.ncirCode=c.ncirCode 
											  left join departemen d on n.tujuan=d.idDepart
											  order by n.ncirCode DESC");
					}
					else{
						if($de[ketDepart]=='Produksi'){
							$q = mysqli_query($conn, "select n.ncirCode, n.nama_barang, n.tanggal_ncir, n.penerbit, n.jenis_inspection,
											  n.tujuan, n.approvedBy, c.ApprovedBy, c.CreatedBy, d.departName, d.ketDepart
											  from ncir_inspection n left join ncir_correction c on n.ncirCode=c.ncirCode 
											  left join departemen d on n.tujuan=d.idDepart
											  left join departemenmain dm on dm.idDepMain=d.idDepMain
											  WHERE d.ketDepart = 'Produksi' AND n.approvedBy IS NOT NULL
											  order by n.ncirCode DESC");
						}else{
							$q = mysqli_query($conn, "select n.ncirCode, n.nama_barang, n.tanggal_ncir, n.penerbit, n.jenis_inspection,
											  n.tujuan, n.approvedBy, c.ApprovedBy, c.CreatedBy, d.departName
											  from ncir_inspection n left join ncir_correction c on n.ncirCode=c.ncirCode 
											  left join departemen d on n.tujuan=d.idDepart
											  left join departemenmain dm on dm.idDepMain=d.idDepMain
											  WHERE d.idDepart = '$de[idDepart]' AND n.approvedBy IS NOT NULL
											  order by n.ncirCode DESC");
						}
					}
					while($i = mysqli_fetch_array($q)){
						$r = mysqli_query($conn, "select *from ncir_correction where ncirCode = '$i[ncirCode]'");
					echo"
						<tr>
						<td  style='display:none;'></td>
						<td><b><a href='page.php?n=detail-ncir&k=1&no=$i[ncirCode]'>$i[ncirCode]</a></b></td>
						<td>$i[nama_barang]</td>
						<td align='center'>".tgl_indo($i[tanggal_ncir])."</td>
						<td>$i[penerbit]</td>
						<td>$i[departName]</td>
						<td>$i[jenis_inspection]</td>";
						if(mysqli_num_rows($r)>0){
							if($i[CreatedBy] !=NULL AND $i[ApprovedBy]==NULL){
								echo"<td align='center'><b><font color='green'>Correcting &nbsp;&nbsp;</font> </b></td>";
							}else if($i[CreatedBy] !=NULL AND $i[ApprovedBy] != NULL){
								echo"<td align='center'><b><font color='red'>Verified &nbsp;&nbsp;</font> </b></td>";
							}
						}else{
							if($i[approvedBy] !=NULL AND $i[ApprovedBy] == NULL){ // di approve QC
								echo"<td align='center'><b><font color='blue'>New Inspection &nbsp;&nbsp;</font></b></td>";
							}else if($i[approvedBy] ==NULL AND $i[ApprovedBy] == NULL){
								echo"<td align='center'><b><font color='black'>Open &nbsp;&nbsp;</font></b></td>";
							}
						}
						echo"
						</tr>";
					}
					?>
					</tbody>
					
					</table>
</div>
</div>
</div>
</div>

