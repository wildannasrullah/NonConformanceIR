<div class='page-header'>
  <div class='page-header-title'>
    <h4>Report
    </h4>
    <span>Report NCR
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
        <a href='#!'>Report NCR
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
					<th width='10%'>NCR Code</th>
					
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
					
					//QUERY UNTUK MENYELEKSI BERDASARKAN SETTING FullReportNCR
					$re = mysqli_query($conn, "select *from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='FullReportNCR' and value_set='$de[depName]'");

					if(mysqli_num_rows($re)>0){
						$q = mysqli_query($conn, "select n.ncrCode, n.tanggal_ncr, n.penerbit, n.jenis_inspection,
											  n.tujuan, n.approvedBy, c.ApprovedBy, c.CreatedBy, d.departName
											  from ncr_inspection n left join ncr_correction c on n.ncrCode=c.ncrCode 
											  left join departemen d on n.tujuan=d.idDepart
											  order by n.ncrCode DESC");
					}
					else{
						$q = mysqli_query($conn, "select n.ncrCode, n.tanggal_ncr, n.penerbit, n.jenis_inspection,
											  n.tujuan, n.approvedBy, c.ApprovedBy, c.CreatedBy, d.departName
											  from ncr_inspection n left join ncr_correction c on n.ncrCode=c.ncrCode 
											  left join departemen d on n.tujuan=d.idDepart
											  left join departemenmain dm on dm.idDepMain=d.idDepMain
											  WHERE n.tujuan = '$de[idDepart]' OR n.penerbit = '$de[idDepart]' AND n.approvedBy IS NOT NULL
											  order by n.ncrCode DESC");
					}
					
					while($i = mysqli_fetch_array($q)){
						$qw=mysqli_query($conn, "SELECT * FROM ncr_inspection ni left join departemen d on ni.penerbit=d.idDepart where ni.ncrCode='$i[ncrCode]'");
						$penerbit=mysqli_fetch_array($qw);
						$r = mysqli_query($conn, "select *from ncr_correction where ncrCode = '$i[ncrCode]'");
					echo"
						<tr>
						<td  style='display:none;'></td>
						<td><b><a href='page.php?n=detail-ncr&k=1&no=$i[ncrCode]'>$i[ncrCode]</a></b></td>
						
						<td align='center'>".tgl_indo($i[tanggal_ncr])."</td>
						<td>$penerbit[departName]</td>
						<td>$i[departName]</td>
						<td>$i[jenis_inspection]</td>";
						if(mysqli_num_rows($r)>0){
							if($i[CreatedBy] !=NULL AND $i[ApprovedBy]==NULL){
								echo"<td align='center'><b><font color='green'>Correcting &nbsp;&nbsp;<i class='fa fa-spinner'></i></font> </b></td>";
							}else if($i[CreatedBy] !=NULL AND $i[ApprovedBy] != NULL){
								echo"<td align='center'><b><font color='red'>Verified &nbsp;&nbsp;<i class='fa fa-check-square-o'></i></font> </b></td>";
							}
						}else{
							if($i[approvedBy] !=NULL AND $i[ApprovedBy] == NULL){ // di approve QC
								echo"<td align='center'><b><font color='blue'>New Inspection &nbsp;&nbsp;<i class='fa fa-info'></i></font></b></td>";
							}else if($i[approvedBy] ==NULL AND $i[ApprovedBy] == NULL){
								echo"<td align='center'><b><font color='black'>Open &nbsp;&nbsp;<i class='fa fa-external-link'></i></font></b></td>";
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

