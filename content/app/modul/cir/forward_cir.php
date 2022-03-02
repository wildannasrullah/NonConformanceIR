<div class='page-header'>
  <div class='page-header-title'>
    <h4>Customer Information Report
    </h4>
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
        <a href='#!'>CIR
        </a>
      </li>
    </ul>
  </div>
</div>

<!-- FORM INPUT -->

<div class='page-body'>
  <div class='row'>
    <div class='col-sm-12'>
	
<?php
$user = mysqli_query($conn, "select *from muser m 
								left join departemenrole dl on m.idDep = dl.idDep
								left join departemen d on dl.idDepart = d.idDepart
								left join departemenmain dm on d.idDepMain = dm.idDepMain
								where m.username='$_SESSION[username]';");
$u = mysqli_fetch_array($user);
$u1 = mysqli_query($conn, "select *from muser where username='$_SESSION[username]'");
$e1 = mysqli_fetch_array($u1);
$d1 = mysqli_query($conn, "select *from departemenrole where idDep='$e1[idDep]'");
$de1 = mysqli_fetch_array($d1);
switch($_GET[act]){
default:
echo"

<div class='card'>
<div class='card-header'>
<div class='card-header-left'>
<h5>FORWARD COMPLAINT / REJECT</h5>
</div>
<div class='card-block'>
<div class='dt-responsive table-responsive'>
<table id='footer-search' class='table table-striped table-bordered nowrap'>
<thead>
<tr>
<th style='display:none;'>#</th>
<th>No. CIR</th>
<th>Nama Perusahaan</th>
<th>Kode Material</th>
<th>No. Good Issue</th>
<th width='13%'>Status</th>
<th width='13%'>Tot. Rusak</th>
<th width='13%'>Status</th>";
$re3 = mysqli_query($conn, "select *from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='ButtonReplyDeptCIR' and value_set='$de1[depName]'");
if(mysqli_num_rows($re3)>0){
	echo"<th width='13%'>Balasan</th>";
}
echo"</tr>
</thead>
<tbody>";

$aksi = "modul/cir/aksi_cir.php";

$re1 = mysqli_query($conn, "select *from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='FullReportCIR' and value_set='$de1[depName]'");
if(mysqli_num_rows($re1)>0){
	
/* $q = mysqli_query($conn, "select *from ncir_inspection where approvedBy is not null and approvedDate is not null order by ncirCode DESC"); */
$q = mysqli_query($conn, "select distinct n.codeCustCare, n.tgl_lapor, n.companyName, n.designCode, n.GID, n.status, n.jumKerusakan, n.action  from cir_customer n
									join cir_forward f on n.codeCustCare=f.codeCustCare
											  order by n.codeCustCare DESC");
}else{
	
/* $q = mysqli_query($conn, "select *from ncir_inspection where approvedBy is not null and approvedDate is not null order by ncirCode DESC"); */
$q = mysqli_query($conn, "select * from cir_customer n
									left join cir_forward f on n.codeCustCare=f.codeCustCare
									where f.idDepart = '$u[idDepart]'
											  order by n.codeCustCare DESC");
}
	
while($i = mysqli_fetch_array($q)){
echo"
	<tr>
		<td style='display:none;'></td>
		<td>$i[codeCustCare]</td>
		<td>$i[companyName]</td>
		<td>$i[designCode]</td>
		<td>$i[GID]</td>
		<td align='center'>";
		if($i[status]=='Complaint'){
			echo "<font color='blue'><b>$i[status]</b></font>";
		}else{
			echo "<font color='red'><b>$i[status]</b></font>";
		}
		echo"</td>
		<td align='center'>$i[jumKerusakan]</td>
		<td align='center'>
		<a href='?n=forward-cir&act=detail&id=$i[idCirCust]&code=$i[codeCustCare]'>
		";
		$cl = mysqli_query($conn, "select *from cir_verifikasi where codeCustCare = '$i[codeCustCare]'");
		$clo = mysqli_fetch_array($cl);
		$apr = mysqli_query($conn, "select * from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='ApproveStatusCIR' and value_set='$u[depName]'");
	if($clo[statusKasus]=='Closed'){
		echo"<button type='button' class='btn btn-info btn-mini'><b>Closed</B></button>";
		if(mysqli_num_rows($apr)>0){
				?>
				<a href='<?php echo "modul/cir/aksi_cir.php?n=forward-cir&act=disapproving&id=$i[idCirCust]&code=$i[codeCustCare]";?>'><button type='button' class='btn btn-default btn-mini' onclick="return confirm('Apakah Anda yakin untuk membuka kasus ini?');"><?php echo"<b>Disapproved</B></button></a>";
			}else{}
	}else{
		if($i[action]=='Forwarded'){
			$sq = mysqli_query($conn, "select *from cir_correction_imm m left join departemen d on m.idDepart = d.idDepart where m.codeCustCare = '$i[codeCustCare]' AND m.idDepart = '$u[idDepart]'"); //Immediate
			$sq2 = mysqli_query($conn, "select *from cir_correction_action m left join departemen d on m.idDepart = d.idDepart where m.codeCustCare = '$i[codeCustCare]' AND m.idDepart = '$u[idDepart]'"); //Action
			
			if(mysqli_num_rows($sq)>0 || mysqli_num_rows($sq2)>0){
				echo"<button type='button' class='btn btn-success btn-mini'><B>Replied</B></button>";
			}else{
				echo"<button type='button' class='btn btn-warning btn-mini'><B>Forwarded</B></button>";
			}
			if(mysqli_num_rows($apr)>0){
				?>
				<a href='<?php echo "modul/cir/aksi_cir.php?n=forward-cir&act=approving&id=$i[idCirCust]&code=$i[codeCustCare]";?>'><button type='button' class='btn btn-danger btn-mini' onclick="return confirm('Apakah Anda yakin untuk menutup kasus ini?');"><?php echo"<b>Approved</B></button></a>";
			}else{}
		}else{
			echo"<button type='button' class='btn btn-info btn-mini'><b>Open</B></button>";
		}
	}
	echo"</a></td>
	";
	$re2 = mysqli_query($conn, "select *from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='ButtonReplyDeptCIR' and value_set='$de1[depName]'");
	if(mysqli_num_rows($re2)>0){
	echo "<td>";
			$qs = mysqli_query($conn, "select *from cir_correction_imm m left join departemen d on m.idDepart = d.idDepart where m.codeCustCare = '$i[codeCustCare]'"); //Immediate
			while($d = mysqli_fetch_array($qs)){
				echo"<a href='?n=forward-cir&act=detail-jawab-segera&id=$i[idCirCust]&code=$i[codeCustCare]&no=$d[idCirIm]' title='$d[departName]'><button type='button' class='btn btn-primary btn-mini'><i class='icofont icofont-user-alt-3'></i></button></a>";
			}
			$qp = mysqli_query($conn, "select *from cir_correction_action m left join departemen d on m.idDepart = d.idDepart where m.codeCustCare = '$i[codeCustCare]'"); //Action
			while($ds = mysqli_fetch_array($qp)){
				echo"<a href='?n=forward-cir&act=detail-jawab-tindakan&id=$i[idCirCust]&code=$i[codeCustCare]&no=$ds[idCA]' title='$ds[departName]'><button type='button' class='btn btn-danger btn-mini'><i class='icofont icofont-user-alt-3'></i></button></a>";
			}
	
	echo"</td>";
	}else{
		
	}
	echo"		
	</tr>";
	
}
echo"
</tbody>
<tfoot>
<tr>
<th style='display:none;'></th>
<th>No. CIR</th>
<th>Tanggal</th>
<th>Nama Perusahaan</th>
<th>Kode Material</th>
<th>Good Issue</th>
<th>Status</th>
<th>Rusak</th>
<th style='display:none'>&nbsp;</th>
<th style='display:none'>&nbsp;</th>
</tr>
</tfoot>
</table>
</div>
</div>
</div>
  
  </div>
</div>";
break;
case "detail" :

$aksi = "modul/cir/aksi_cir.php";
$m = date(m);$d = date(d);$y = date(Y);
$dated = date('Y-m-d');
$mailto = mysqli_query($conn, "select * from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='MailToCIR' and value_set='$u[depName]'");
$cek_ada = mysqli_num_rows(mysqli_query($conn, "select codeCustCare from cir_correction_imm where codeCustCare = '$_GET[code]'"));
$cek_ada2 = mysqli_num_rows(mysqli_query($conn, "select codeCustCare from cir_correction_action where codeCustCare = '$_GET[code]'"));

$cl = mysqli_query($conn, "select *from cir_verifikasi where codeCustCare = '$_GET[code]'");
$clo = mysqli_fetch_array($cl);
$seting = mysqli_query($conn, "select count(m.idSetting) as jum from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='ButtonCIRCorrection' and value_set='$u[depName]'");
$dep = mysqli_query($conn, "select *from departemenmain order by DepMain ASC;");
$forwardnya = mysqli_query($conn, "select *from cir_forward f left join departemen d on f.idDepart=d.idDepart where codeCustCare = '$_GET[code]';");
$fd = mysqli_query($conn, "select *from cir_forward f left join departemen d on f.idDepart=d.idDepart where codeCustCare = '$_GET[code]';");
$po = mysqli_fetch_array($fd);
$r = mysqli_query($conn, "select *from cir_customer where codeCustCare='$_GET[code]';");
$t = mysqli_fetch_array($r);

$w = mysqli_query($conn, "CALL SP_simKOP('$t[GID]')");
$g = mysqli_fetch_array($w);

echo"
<div class='card'>
    <div class='row invoice-contact'>
        <div class='col-md-6'>
            <div class='invoice-box row'>
                <div class='col-sm-12'>
                    <table class='table table-responsive invoice-table table-borderless'>
                        <tbody>
                            <tr>
                                <td><h4><b>".strtoupper($t[companyName])."</b></h4></td>
                            </tr>
                            <tr>
                                <td><b><font color='red'>".strtoupper($t[codeCustCare])."</font></b></td>
                            </tr>
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class='col-md-6'>
            <div class='row text-center'>
                <div class='col-sm-12 invoice-btn-group'>";
	
$dw = mysqli_fetch_array($seting);
if($clo[statusKasus]=='Closed'){
	echo "<font color='red'><strong>CLOSED!</strong></font><br>";
}else{
	if($dw[jum]>0){
		echo "<font color='red'><strong>FORWARDED!</strong></font><br>";
		if($cek_ada2 > 0){
			echo "<a href='?n=forward-cir&act=tindakan_koreksi&id=$_GET[id]&code=$_GET[code]&k=1'><button class='btn btn-warning btn-lg btn-block' data-toggle='modal' data-target='#sign-in-modal'>Tindakan Koreksi</button></a>";
		}else{
			echo "<a href='?n=forward-cir&act=tindakan_koreksi&id=$_GET[id]&code=$_GET[code]'><button class='btn btn-warning btn-lg btn-block' data-toggle='modal' data-target='#sign-in-modal'>Tindakan Koreksi</button></a>";
		}
	}else{
		echo "<font color='red'><strong>FORWARDED!</strong></font><br>";
		if(mysqli_num_rows($mailto) > 0){
			echo "<a href='mailto:$t[info_via]?subject=Reply: $t[companyName] - $t[GID] - $g[materialcode]' ><button class='btn btn-primary btn-lg btn-block' data-toggle='modal' data-target='#jawab-modal'>Jawaban Segera ke Customer</button></a>";
		}else{
			if($cek_ada > 0){
				echo "<a href='?n=forward-cir&act=jawab_segera&id=$_GET[id]&code=$_GET[code]&k=1' ><button class='btn btn-primary btn-lg btn-block' data-toggle='modal' data-target='#jawab-modal'>Jawaban Segera</button></a>";
			}else{
				echo "<a href='?n=forward-cir&act=jawab_segera&id=$_GET[id]&code=$_GET[code]' ><button class='btn btn-primary btn-lg btn-block' data-toggle='modal' data-target='#jawab-modal'>Jawaban Segera</button></a>";
			}
		}
	}
}
                echo "</div>
            </div>
        </div>
    </div>
    <div class='card-block'>
        <div class='row invoive-info'>
            <div class='col-md-6 col-xs-12 invoice-client-info'>
                <h6>Informasi Dokumen :</h6>
                <table class='table table-responsive invoice-table invoice-order table-borderless'>
                    <tbody>
                        <tr>
                            <th>Sales Order :</th>
                            <td>&nbsp;&nbsp;&nbsp; $g[so_no]</td>
                        </tr
						<tr>
                            <th>Good Issue :</th>
                            <td>&nbsp;&nbsp;&nbsp; $t[GID]</td>
                        </tr>
						<tr>
                            <th>Kode Design :</th>
                            <td>&nbsp;&nbsp;&nbsp; $g[materialcode]</td>
                        </tr>
                        <tr>
                            <th>Information :</th>
                            <td>
                               &nbsp;&nbsp;&nbsp; $g[information]
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class='col-md-6 col-sm-6'>
                <h6>Status :&nbsp;&nbsp;&nbsp; <span class='label label-warning'> $t[status]</span></h6>
                <table class='table table-responsive invoice-table invoice-order table-borderless'>
                    <tbody>
                        <tr>
                            <th>Jumlah Kirim :</th>
                            <td>&nbsp;&nbsp;&nbsp; ".ribu($g[qtydelivered])."</td>
                        </tr>
						<tr>
                            <th>Jumlah Kerusakan :</th>
                            <td>&nbsp;&nbsp;&nbsp; ".ribu($t[jumKerusakan])."</td>
                        </tr>
						<tr>
                            <th>Tanggal Kirim :</th>
                            <td>
                                &nbsp;&nbsp;&nbsp;&nbsp;".tgl_indo($g[docdate])."
                            </td>
                        </tr>
						<tr>
                            <th>Nama Barang :</th>
                            <td>
                               &nbsp;&nbsp;&nbsp; $t[productName]
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
		<hr><br>
        <div class='row'>
            <div class='col-sm-12'>
                <table class='table table-responsive invoice-detail-table'>
                    <tr>
                            <td>
							<img src='modul/cir/lampiran/$t[uploadFile]'>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
		<div class='row'>
            <div class='col-sm-12'>
                <h6>Email Adress :</h6>
                <p><a href='mailto:$t[info_via]?subject=Reply: $t[companyName] - $t[GID] - $g[materialcode]'>$t[info_via] </a></p>
				 <hr>
				<table border='0' width='30%'>
				<tr><td><font size='2'>Approved By</font></td><td>&nbsp;:</td><td>&nbsp;$po[approvedBy]</td></tr>
				<tr><td><font size='2'>Approved Date</font></td><td>&nbsp;:</td><td>&nbsp;$po[approvedAt]</td></tr>
				<tr><td><font size='2'>Forwarded By</font></td><td>&nbsp;:</td><td>&nbsp;$po[forwardBy]</td></tr>
				<tr><td><font size='2'>Forwarded To</font></td><td>&nbsp;:</td><td>&nbsp;";
				while($fr = mysqli_fetch_array($forwardnya)){
					echo "$fr[departName], ";
				}
				echo"</td></tr>
				<tr><td><font size='2'>Forwarded Date</font></td><td>&nbsp;:</td><td>&nbsp;$po[forwardAt]</td></tr>
				</table>
				<br><br>
            </div>
        </div>
    </div>
</div>
";
break;
case "jawab_segera" :
$aksi = "modul/cir/aksi_cir.php";
$m = date(m);$d = date(d);$y = date(Y);
$dated = date('Y-m-d');
$qa = mysqli_query($conn, "select *from cir_correction_action m left join departemen d on m.idDepart = d.idDepart where m.codeCustCare = '$_GET[code]'"); //Action
$cc = mysqli_query($conn, "select *from cir_correction_imm where codeCustCare='$_GET[code]' AND idDepart = '$u[idDepart]';");
$c2 = mysqli_fetch_array($cc);

$query = "select *from cir_correction_type where codeCustCare = '$_GET[code]' AND CreatedBy = '$u[username]'";
$sq = mysqli_query($conn, $query);
$jk = mysqli_query($conn, "select *from mjeniskoreksi where idKoreksi IN ('1','2','3','4','5') order by idKoreksi ASC");
$seting = mysqli_query($conn, "select count(m.idSetting) as jum from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='ButtonCIRCorrection' and value_set='$u[depName]'");
$dep = mysqli_query($conn, "select *from departemenmain order by DepMain ASC;");
$f = mysqli_query($conn, "select *from cir_forward where codeCustCare = '$_GET[code]';");
$r = mysqli_query($conn, "select *from cir_customer where codeCustCare='$_GET[code]';");
$t = mysqli_fetch_array($r);

$w = mysqli_query($conn, "CALL SP_simKOP('$t[GID]')");
$g = mysqli_fetch_array($w);

echo"
<div class='card'>
    <div class='row invoice-contact'>
        <div class='col-md-6'>
            <div class='invoice-box row'>
                <div class='col-sm-12'>
                    <table class='table table-responsive invoice-table table-borderless'>
                        <tbody>
                            <tr>
                                <td><h4><b>".strtoupper($t[companyName])."</b></h4></td>
                            </tr>
                            <tr>
                                <td><b><font color='red'>".strtoupper($t[codeCustCare])."</font></b></td>
                            </tr>
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class='col-md-6'>
            <div class='row text-center'>
                <div class='col-sm-12 invoice-btn-group'>
					<h5 align=''>Jawaban Segera</h5>
                </div>
            </div>
        </div>
    </div>
    <div class='card-block'>
        <div class='row invoive-info'>
            <div class='col-md-6 col-xs-12 invoice-client-info'>
                <h6>Informasi Dokumen :</h6>
                <table class='table table-responsive invoice-table invoice-order table-borderless'>
                    <tbody>
                        <tr>
                            <th>Sales Order :</th>
                            <td>&nbsp;&nbsp;&nbsp; $g[so_no]</td>
                        </tr
						<tr>
                            <th>Good Issue :</th>
                            <td>&nbsp;&nbsp;&nbsp; $t[GID]</td>
                        </tr>
						<tr>
                            <th>Kode Design :</th>
                            <td>&nbsp;&nbsp;&nbsp; $g[materialcode]</td>
                        </tr>
                        <tr>
                            <th>Information :</th>
                            <td>
                               &nbsp;&nbsp;&nbsp; $g[information]
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class='col-md-6 col-sm-6'>
                <h6>Status :&nbsp;&nbsp;&nbsp; <span class='label label-warning'> $t[status]</span></h6>
                <table class='table table-responsive invoice-table invoice-order table-borderless'>
                    <tbody>
                        <tr>
                            <th>Jumlah Kirim :</th>
                            <td>&nbsp;&nbsp;&nbsp; ".ribu($g[qtydelivered])."</td>
                        </tr>
						<tr>
                            <th>Jumlah Kerusakan :</th>
                            <td>&nbsp;&nbsp;&nbsp; ".ribu($t[jumKerusakan])."</td>
                        </tr>
						<tr>
                            <th>Tanggal Kirim :</th>
                            <td>
                                &nbsp;&nbsp;&nbsp;&nbsp;".tgl_indo($g[docdate])."
                            </td>
                        </tr>
						<tr>
                            <th>Nama Barang :</th>
                            <td>
                               &nbsp;&nbsp;&nbsp; $t[productName]
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
		<hr>
		<p>
<div class='card-block'>";

if($_GET[k]==1){
	echo"    <form action='$aksi?n=forward-cir&act=edit' method='POST' >";
}else{
	echo"    <form action='$aksi?n=forward-cir&act=input' method='POST' >";
}
echo"
	<input type='hidden' class='form-control' value='$_GET[code]' name='kode'>
    
  <div class='row'>
    <div class='col-sm-12 col-xl-12'>
      <h4 class='sub-title'>Correction
      </h4>
      <div class='border-checkbox-section'>";
			$cek_user = array();
			while($row = mysqli_fetch_assoc($sq)) {
					$cek_user [ $row['jenis_koreksi'] ] = $row['jenis_koreksi'];
			}
            foreach($cek_user as $kode=>$cu) {
						$check_list[]=$cu;
			}  
			$checked= $check_list;
while($j = mysqli_fetch_array($jk)){
	$checked= $check_list;
	?>
	<input type='checkbox' name='jenis_koreksi[]' value="<?php echo $j[jenisKoreksi]; ?>" style='height:20px;width:20px;background-color:white' <?php in_array ($j[jenisKoreksi], $checked) ? print "checked" : ""; ?>>&nbsp;<?php echo $j[jenisKoreksi];?>&nbsp;&nbsp;
<?php
}
echo"
		</div>
    </div>
  </div>
</div>
  </div>";
  /* $o = mysqli_query($conn, "select *from ncir_correction where idCor='$_GET[coir]'");
  $h = mysqli_fetch_array($o); */
echo"
	<div class='col-sm-12'>
      <div class='card'>
        <div class='card-block'>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Root Cause
              </label>
              <div class='col-sm-9'>
                <textarea rows='5' cols='5' class='form-control'  placeholder='Root Cause...' name='root'>$c2[rootCause]</textarea>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Corrective Action
              </label>
              <div class='col-sm-9'>
                <textarea rows='5' cols='5' class='form-control' value='$c2[correctiveAct]' placeholder='Corrective Action...' name='correct' >$c2[correctiveAct]</textarea>
              </div>
            </div>
			<br>
			
          <hr>
				<table border='0' width='30%'>
				<tr><td><font size='2'>Created By</font></td><td>&nbsp;:</td><td>&nbsp;$c2[createdBy]</td></tr>
				<tr><td><font size='2'>Created Date</font></td><td>&nbsp;:</td><td>&nbsp;$c2[createdDate]</td></tr>
				<tr><td><font size='2'>Changed By</font></td><td>&nbsp;:</td><td>&nbsp;$c2[changedBy]</td></tr>
				<tr><td><font size='2'>Changed Date</font></td><td>&nbsp;:</td><td>&nbsp;$c2[changedDate]</td></tr>
				</table>
				<br><br>
			";
			if(mysqli_num_rows($qa)>0){
				echo"<font size='2' color='red'>* Kasus sudah disimpulkan oleh pihak <i>Quality Assurance</i></font>
				<button type='button' class='btn btn-default btn-block'>SIMPAN</button>";
			}
			else{
				echo"
				<button type='submit' class='btn btn-primary btn-block'>SIMPAN</button>";
			}
		echo"
          </form>
    </div>
</p>
</div>
</div>

";
break;
case "tindakan_koreksi" :
$aksi = "modul/cir/aksi_cir.php";
$m = date(m);$d = date(d);$y = date(Y);
$dated = date('Y-m-d');
$cc = mysqli_query($conn, "select *from cir_correction_action where codeCustCare='$_GET[code]';");
$c2 = mysqli_fetch_array($cc);

$query = "select *from cir_correction_type where codeCustCare = '$_GET[code]'";
$sq = mysqli_query($conn, $query);
$jk = mysqli_query($conn, "select *from mjeniskoreksi where idKoreksi IN ('1','2','3','4','5') order by idKoreksi ASC");
$seting = mysqli_query($conn, "select count(m.idSetting) as jum from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='ButtonCIRCorrection' and value_set='$u[depName]'");
$dep = mysqli_query($conn, "select *from departemenmain order by DepMain ASC;");
$f = mysqli_query($conn, "select *from cir_forward where codeCustCare = '$_GET[code]';");
$r = mysqli_query($conn, "select *from cir_customer where codeCustCare='$_GET[code]';");
$t = mysqli_fetch_array($r);

$w = mysqli_query($conn, "CALL SP_simKOP('$t[GID]')");
$g = mysqli_fetch_array($w);

echo"
<div class='card'>
    <div class='row invoice-contact'>
        <div class='col-md-6'>
            <div class='invoice-box row'>
                <div class='col-sm-12'>
                    <table class='table table-responsive invoice-table table-borderless'>
                        <tbody>
                            <tr>
                                <td><h4><b>".strtoupper($t[companyName])."</b></h4></td>
                            </tr>
                            <tr>
                                <td><b><font color='red'>".strtoupper($t[codeCustCare])."</font></b></td>
                            </tr>
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class='col-md-6'>
            <div class='row text-center'>
                <div class='col-sm-12 invoice-btn-group'>
					<h5 align=''>Tindakan Koreksi</h5>
                </div>
            </div>
        </div>
    </div>
    <div class='card-block'>
        <div class='row invoive-info'>
            <div class='col-md-6 col-xs-12 invoice-client-info'>
                <h6>Informasi Dokumen :</h6>
                <table class='table table-responsive invoice-table invoice-order table-borderless'>
                    <tbody>
                        <tr>
                            <th>Sales Order :</th>
                            <td>&nbsp;&nbsp;&nbsp; $g[so_no]</td>
                        </tr
						<tr>
                            <th>Good Issue :</th>
                            <td>&nbsp;&nbsp;&nbsp; $t[GID]</td>
                        </tr>
						<tr>
                            <th>Kode Design :</th>
                            <td>&nbsp;&nbsp;&nbsp; $g[materialcode]</td>
                        </tr>
                        <tr>
                            <th>Information :</th>
                            <td>
                               &nbsp;&nbsp;&nbsp; $g[information]
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class='col-md-6 col-sm-6'>
                <h6>Status :&nbsp;&nbsp;&nbsp; <span class='label label-warning'> $t[status]</span></h6>
                <table class='table table-responsive invoice-table invoice-order table-borderless'>
                    <tbody>
                        <tr>
                            <th>Jumlah Kirim :</th>
                            <td>&nbsp;&nbsp;&nbsp; ".ribu($g[qtydelivered])."</td>
                        </tr>
						<tr>
                            <th>Jumlah Kerusakan :</th>
                            <td>&nbsp;&nbsp;&nbsp; ".ribu($t[jumKerusakan])."</td>
                        </tr>
						<tr>
                            <th>Tanggal Kirim :</th>
                            <td>
                                &nbsp;&nbsp;&nbsp;&nbsp;".tgl_indo($g[docdate])."
                            </td>
                        </tr>
						<tr>
                            <th>Nama Barang :</th>
                            <td>
                               &nbsp;&nbsp;&nbsp; $t[productName]
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
		<hr>
		<p>
    </div>
  </div>
</div>
  </div>";
echo"
	<div class='col-sm-12'>
      <div class='card'>";

if($_GET[k]==1){
	echo"    <form action='$aksi?n=forward-cir&act=edit_tindakan' method='POST' >";
}else{
	echo"    <form action='$aksi?n=forward-cir&act=input_tindakan' method='POST' >";
}
echo"
	<input type='hidden' class='form-control' value='$_GET[code]' name='kode'>
        <div class='card-block'>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Root Cause
              </label>
              <div class='col-sm-9'>
                <textarea rows='5' cols='5' class='form-control'  placeholder='Root Cause...' name='roott'>$c2[rootcause]</textarea>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Planned Action
              </label>
              <div class='col-sm-9'>
                <textarea rows='5' cols='5' class='form-control' value='$c2[plannedAction]' placeholder='Planned Action...' name='correctt' >$c2[plannedAction]</textarea>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Deadline Plan
              </label>
              <div class='col-sm-9'>
                <input type='date' class='form-control' value='$c2[deadline_plan]' placeholder='Deadline Plan...' name='deadlinet' >
              </div>
            </div>
			<br>
			
          <hr>
				<table border='0' width='30%'>
				<tr><td><font size='2'>Created By</font></td><td>&nbsp;:</td><td>&nbsp;$c2[createdby]</td></tr>
				<tr><td><font size='2'>Created Date</font></td><td>&nbsp;:</td><td>&nbsp;$c2[createddate]</td></tr>
				<tr><td><font size='2'>Changed By</font></td><td>&nbsp;:</td><td>&nbsp;$c2[changedby]</td></tr>
				<tr><td><font size='2'>Changed Date</font></td><td>&nbsp;:</td><td>&nbsp;$c2[changeddate]</td></tr>
				</table>
				<br><br>
			";
			echo"
				<button type='submit' class='btn btn-primary btn-block'>SIMPAN</button>";
			
		echo"
          </form>
    </div>
	</p>
    </div>
</div>

";
break;

case "detail-jawab-tindakan":
$aksi = "modul/cir/aksi_cir.php";
$m = date(m);$d = date(d);$y = date(Y);
$dated = date('Y-m-d');
$print = mysqli_query($conn, "select * from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='PrintCIR' and value_set='$u[depName]'");
$mail = mysqli_query($conn, "select * from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='MailToCIR' and value_set='$u[depName]'");
$approve = mysqli_query($conn, "select * from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='ApproveStatusCIR' and value_set='$u[depName]'");
$cc = mysqli_query($conn, "select *from cir_correction_action where codeCustCare='$_GET[code]';");
$c2 = mysqli_fetch_array($cc);
$aa = mysqli_query($conn, "select *from cir_verifikasi where codeCustCare='$_GET[code]';");
$ap = mysqli_fetch_array($aa);

$query = "select *from cir_correction_type where codeCustCare = '$_GET[code]'";
$sq = mysqli_query($conn, $query);
$jk = mysqli_query($conn, "select *from mjeniskoreksi where idKoreksi IN ('1','2','3','4','5') order by idKoreksi ASC");
$seting = mysqli_query($conn, "select count(m.idSetting) as jum from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='ButtonCIRCorrection' and value_set='$u[depName]'");
$dep = mysqli_query($conn, "select *from departemenmain order by DepMain ASC;");
$f = mysqli_query($conn, "select *from cir_forward where codeCustCare = '$_GET[code]';");
$r = mysqli_query($conn, "select *from cir_customer where codeCustCare='$_GET[code]';");
$t = mysqli_fetch_array($r);

$w = mysqli_query($conn, "CALL SP_simKOP('$t[GID]')");
$g = mysqli_fetch_array($w);

echo"
<div class='card'>
    <div class='row invoice-contact'>
        <div class='col-md-6'>
            <div class='invoice-box row'>
                <div class='col-sm-12'>
                    <table class='table table-responsive invoice-table table-borderless'>
                        <tbody>
                            <tr>
                                <td><h4><b>".strtoupper($t[companyName])."</b></h4></td>
                            </tr>
                            <tr>
                                <td><b><font color='red'>".strtoupper($t[codeCustCare])."</font></b></td>
                            </tr>
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class='col-md-6'>
            <div class='row text-center'>
                <div class='col-sm-12 invoice-btn-group'>";
			
				echo"<h5 align=''>Tindakan Koreksi</h5>
                </div>
            </div>
        </div>
    </div>
    <div class='card-block'>
        <div class='row invoive-info'>
            <div class='col-md-6 col-xs-12 invoice-client-info'>
                <h6>Informasi Dokumen :</h6>
                <table class='table table-responsive invoice-table invoice-order table-borderless'>
                    <tbody>
                        <tr>
                            <th>Sales Order :</th>
                            <td>&nbsp;&nbsp;&nbsp; $g[so_no]</td>
                        </tr
						<tr>
                            <th>Good Issue :</th>
                            <td>&nbsp;&nbsp;&nbsp; $t[GID]</td>
                        </tr>
						<tr>
                            <th>Kode Design :</th>
                            <td>&nbsp;&nbsp;&nbsp; $g[materialcode]</td>
                        </tr>
                        <tr>
                            <th>Information :</th>
                            <td>
                               &nbsp;&nbsp;&nbsp; $g[information]
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class='col-md-6 col-sm-6'>
                <h6>Status :&nbsp;&nbsp;&nbsp; <span class='label label-warning'> $t[status]</span></h6>
                <table class='table table-responsive invoice-table invoice-order table-borderless'>
                    <tbody>
                        <tr>
                            <th>Jumlah Kirim :</th>
                            <td>&nbsp;&nbsp;&nbsp; ".ribu($g[qtydelivered])."</td>
                        </tr>
						<tr>
                            <th>Jumlah Kerusakan :</th>
                            <td>&nbsp;&nbsp;&nbsp; ".ribu($t[jumKerusakan])."</td>
                        </tr>
						<tr>
                            <th>Tanggal Kirim :</th>
                            <td>
                                &nbsp;&nbsp;&nbsp;&nbsp;".tgl_indo($g[docdate])."
                            </td>
                        </tr>
						<tr>
                            <th>Nama Barang :</th>
                            <td>
                               &nbsp;&nbsp;&nbsp; $t[productName]
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
		<hr>
		<p>
    </div>
  </div>
</div>
  </div>";
echo"
	<div class='col-sm-12'>
      <div class='card'>";

if($_GET[k]==1){
	echo"    <form action='$aksi?n=correction&act=edit' method='POST' >";
}else{
	echo"    <form action='$aksi?n=forward-cir&act=input_tindakan' method='POST' >";
}
echo"
	<input type='hidden' class='form-control' value='$_GET[code]' name='kode'>
        <div class='card-block'>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Root Cause
              </label>
              <div class='col-sm-9'>
                <textarea rows='5' cols='5' class='form-control'  placeholder='Root Cause...' name='roott'>$c2[rootcause]</textarea>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Planned Action
              </label>
              <div class='col-sm-9'>
                <textarea rows='5' cols='5' class='form-control' value='$c2[plannedAction]' placeholder='Planned Action...' name='correctt' >$c2[plannedAction]</textarea>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Deadline Plan
              </label>
              <div class='col-sm-9'>
                <input type='date' class='form-control' value='$c2[deadline_plan]' placeholder='Deadline Plan...' name='deadlinet' >
              </div>
            </div>
			<br>
			
          <hr>
				<table border='0' width='30%'>
				<tr><td><font size='2'>Created By</font></td><td>&nbsp;:</td><td>&nbsp;$c2[createdby]</td></tr>
				<tr><td><font size='2'>Created Date</font></td><td>&nbsp;:</td><td>&nbsp;$c2[createddate]</td></tr>
				<tr><td><font size='2'>Changed By</font></td><td>&nbsp;:</td><td>&nbsp;$c2[changedby]</td></tr>
				<tr><td><font size='2'>Changed Date</font></td><td>&nbsp;:</td><td>&nbsp;$c2[changeddate]</td></tr>
				</table>
				<br><br>
			";
			if(mysqli_num_rows($mail)>0){
				
				echo"
				<a href='mailto:$t[info_via]?subject=Reply: $t[companyName] - $t[GID] - $g[materialcode]'><button type='button' class='btn btn-danger btn-block'>MAIL TO CUSTOMER</button></a>";
			}	
			else{}
			
			if(mysqli_num_rows($print)>0){
				echo"<br><button type='button' class='btn btn-success' title='Sudah Dikoreksi' ><i class='fa fa-check'></i></button>
			
			&nbsp;<button type='button' class='btn btn-inverse' title='Cetak' onclick='print_d()'><i class='fa fa-print'></i> Cetak</button>
			";
			?>
			<script type="text/javascript">
				function print_d(){
					window.open("<?php echo "modul/cir/print/print_tindak.php?n=forward-cir&act=detail-jawab-tindakan&id=$_GET[id]&code=$_GET[code]&no=$_GET[no]"?>","target=_blank");
				}
			</script>
			<?php
			}else{}
    echo"
    </div>
	</p>
    </div>
</div>

";
break;
case "detail-jawab-segera" :
	case "jawab_segera" :
$aksi = "modul/cir/aksi_cir.php";
$m = date(m);$d = date(d);$y = date(Y);
$dated = date('Y-m-d');
$print = mysqli_query($conn, "select * from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='PrintCIR' and value_set='$u[depName]'");
$cc = mysqli_query($conn, "select *from cir_correction_imm where codeCustCare='$_GET[code]' AND idCirIm = '$_GET[no]';");
$c2 = mysqli_fetch_array($cc);
$mail = mysqli_query($conn, "select * from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='MailToCIR' and value_set='$u[depName]'");
$approve = mysqli_query($conn, "select * from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='ApproveStatusCIR' and value_set='$u[depName]'");

$query = "select *from cir_correction_type where codeCustCare = '$_GET[code]' and CreatedBy = '$c2[createdBy]'";
$sq = mysqli_query($conn, $query);
$jk = mysqli_query($conn, "select *from mjeniskoreksi where idKoreksi IN ('1','2','3','4','5') order by idKoreksi ASC");
$seting = mysqli_query($conn, "select count(m.idSetting) as jum from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='ButtonCIRCorrection' and value_set='$u[depName]'");
$dep = mysqli_query($conn, "select *from departemenmain order by DepMain ASC;");
$f = mysqli_query($conn, "select *from cir_forward where codeCustCare = '$_GET[code]';");
$r = mysqli_query($conn, "select *from cir_customer where codeCustCare='$_GET[code]';");
$t = mysqli_fetch_array($r);

$w = mysqli_query($conn, "CALL SP_simKOP('$t[GID]')");
$g = mysqli_fetch_array($w);

echo"
<div class='card'>
    <div class='row invoice-contact'>
        <div class='col-md-6'>
            <div class='invoice-box row'>
                <div class='col-sm-12'>
                    <table class='table table-responsive invoice-table table-borderless'>
                        <tbody>
                            <tr>
                                <td><h4><b>".strtoupper($t[companyName])."</b></h4></td>
                            </tr>
                            <tr>
                                <td><b><font color='red'>".strtoupper($t[codeCustCare])."</font></b></td>
                            </tr>
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class='col-md-6'>
            <div class='row text-center'>
                <div class='col-sm-12 invoice-btn-group'>";
			
				echo"<h5 align=''>Jawaban Segera</h5>
                </div>
            </div>
        </div>
    </div>
    <div class='card-block'>
        <div class='row invoive-info'>
            <div class='col-md-6 col-xs-12 invoice-client-info'>
                <h6>Informasi Dokumen :</h6>
                <table class='table table-responsive invoice-table invoice-order table-borderless'>
                    <tbody>
                        <tr>
                            <th>Sales Order :</th>
                            <td>&nbsp;&nbsp;&nbsp; $g[so_no]</td>
                        </tr
						<tr>
                            <th>Good Issue :</th>
                            <td>&nbsp;&nbsp;&nbsp; $t[GID]</td>
                        </tr>
						<tr>
                            <th>Kode Design :</th>
                            <td>&nbsp;&nbsp;&nbsp; $g[materialcode]</td>
                        </tr>
                        <tr>
                            <th>Information :</th>
                            <td>
                               &nbsp;&nbsp;&nbsp; $g[information]
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class='col-md-6 col-sm-6'>
                <h6>Status :&nbsp;&nbsp;&nbsp; <span class='label label-warning'> $t[status]</span></h6>
                <table class='table table-responsive invoice-table invoice-order table-borderless'>
                    <tbody>
                        <tr>
                            <th>Jumlah Kirim :</th>
                            <td>&nbsp;&nbsp;&nbsp; ".ribu($g[qtydelivered])."</td>
                        </tr>
						<tr>
                            <th>Jumlah Kerusakan :</th>
                            <td>&nbsp;&nbsp;&nbsp; ".ribu($t[jumKerusakan])."</td>
                        </tr>
						<tr>
                            <th>Tanggal Kirim :</th>
                            <td>
                                &nbsp;&nbsp;&nbsp;&nbsp;".tgl_indo($g[docdate])."
                            </td>
                        </tr>
						<tr>
                            <th>Nama Barang :</th>
                            <td>
                               &nbsp;&nbsp;&nbsp; $t[productName]
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
		<hr>
		<p>
<div class='card-block'>";

if($_GET[k]==1){
	echo"    <form action='$aksi?n=correction&act=edit' method='POST' >";
}else{
	echo"    <form action='$aksi?n=forward-cir&act=input' method='POST' >";
}
echo"
	<input type='hidden' class='form-control' value='$_GET[code]' name='kode'>
    
  <div class='row'>
    <div class='col-sm-12 col-xl-12'>
      <h4 class='sub-title'>Correction
      </h4>
      <div class='border-checkbox-section'>";
			$cek_user = array();
			while($row = mysqli_fetch_assoc($sq)) {
					$cek_user [ $row['jenis_koreksi'] ] = $row['jenis_koreksi'];
			}
            foreach($cek_user as $kode=>$cu) {
						$check_list[]=$cu;
			}  
			$checked= $check_list;
while($j = mysqli_fetch_array($jk)){
	$checked= $check_list;
	?>
	<input type='checkbox' name='jenis_koreksi[]' value="<?php echo $j[jenisKoreksi]; ?>" style='height:20px;width:20px;background-color:white' <?php in_array ($j[jenisKoreksi], $checked) ? print "checked" : ""; ?>>&nbsp;<?php echo $j[jenisKoreksi];?>&nbsp;&nbsp;
<?php
}
echo"
		</div>
    </div>
  </div>
</div>
  </div>";
  /* $o = mysqli_query($conn, "select *from ncir_correction where idCor='$_GET[coir]'");
  $h = mysqli_fetch_array($o); */
echo"
	<div class='col-sm-12'>
      <div class='card'>
        <div class='card-block'>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Root Cause
              </label>
              <div class='col-sm-9'>
                <textarea rows='5' cols='5' class='form-control'  placeholder='Root Cause...' name='root'>$c2[rootCause]</textarea>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Corrective Action
              </label>
              <div class='col-sm-9'>
                <textarea rows='5' cols='5' class='form-control' value='$c2[correctiveAct]' placeholder='Corrective Action...' name='correct' >$c2[correctiveAct]</textarea>
              </div>
            </div>
			<br>
			
          <hr>
				<table border='0' width='30%'>
				<tr><td><font size='2'>Created By</font></td><td>&nbsp;:</td><td>&nbsp;$c2[createdBy]</td></tr>
				<tr><td><font size='2'>Created Date</font></td><td>&nbsp;:</td><td>&nbsp;$c2[createdDate]</td></tr>
				<tr><td><font size='2'>Changed By</font></td><td>&nbsp;:</td><td>&nbsp;$c2[changedBy]</td></tr>
				<tr><td><font size='2'>Changed Date</font></td><td>&nbsp;:</td><td>&nbsp;$c2[changedDate]</td></tr>
				</table>
				<br><br>
			";
			if(mysqli_num_rows($mail)>0){
				echo"
				<button type='submit' class='btn btn-danger btn-block'>MAIL TO CUSTOMER</button>";
			}	
			else{}
			if(mysqli_num_rows($print)>0){
				echo"<br><button type='button' class='btn btn-success' title='Sudah Dikoreksi' ><i class='fa fa-check'></i></button>
			
			&nbsp;<button type='button' class='btn btn-inverse' title='Cetak' onclick='print_d()'><i class='fa fa-print'></i> Cetak</button>
			";
			?>
			<script type="text/javascript">
				function print_d(){
					window.open("<?php echo "modul/cir/print/print.php?n=forward-cir&act=detail-jawab-segera&id=$_GET[id]&code=$_GET[code]&no=$_GET[no]"?>","target=_blank");
				}
			</script>
			<?php
			}else{}
    echo"</div>
</p>
    </div>
</div>

";
break;
}
?>