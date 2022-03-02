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
switch($_GET[act]){
default:
echo"

<div class='card'>
<div class='card-header'>
<div class='card-header-left'>
<h5>COMPLAINT / REJECT</h5>
</div>
<div class='card-block'>
<div class='dt-responsive table-responsive'>
<table id='footer-search' class='table table-striped table-bordered nowrap'>
<thead>
<tr>
<th style='display:none;'>#</th>
<th>No. CIR</th>
<th>Tanggal </th>
<th>Nama Perusahaan</th>
<th>Kode Material</th>
<th>No. Good Issue</th>
<th width='13%'>Status</th>
<th width='13%'>Jumlah Rusak</th>
<th width='13%'>Status</th>
</tr>
</thead>
<tbody>";

$aksi = "modul/cir/aksi_cir.php";

/* $q = mysqli_query($conn, "select *from ncir_inspection where approvedBy is not null and approvedDate is not null order by ncirCode DESC"); */
$q = mysqli_query($conn, "select * from cir_customer n where action not in ('Forwarded')
											  order by n.codeCustCare DESC");
	
while($i = mysqli_fetch_array($q)){
echo"
	<tr>
		<td style='display:none;'></td>
		<td>$i[codeCustCare]</td>
		<td>$i[tgl_lapor]</td>
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
		<a href='?n=list-cir&act=detail&id=$i[idCirCust]&code=$i[codeCustCare]' target='_blank'>
		";
		
		if($i[action]=='Forwarded'){
			echo"<button type='button' class='btn btn-danger btn-sm'><B>Forwarded</B></button>";
		}else{
			echo"<button type='button' class='btn btn-success btn-sm'><b>Open</B></button>";
		}
	echo"</a></tr>";
	
					}
echo"
</tbody>
<tfoot>
<tr>
<th style='display:none;'></th>
<th>No. CIR</th>
<th>Tanggal/th>
<th>Nama Perusahaan</th>
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
</div>";
break;
case "detail" :

$aksi = "modul/cir/aksi_cir.php";
$m = date(m);$d = date(d);$y = date(Y);
$dated = date('Y-m-d');
$dep = mysqli_query($conn, "select *from departemen order by departName ASC;");
$f = mysqli_query($conn, "select *from cir_forward f left join departemen d on f.idDepart=d.idDepart where codeCustCare = '$_GET[code]';");
$po = mysqli_fetch_array($f);
$r = mysqli_query($conn, "select *from cir_customer where codeCustCare='$_GET[code]';");
$t = mysqli_fetch_array($r);

$w = mysqli_query($conn, "CALL SP_simKOP('$t[GID]')");
$g = mysqli_fetch_array($w);

echo"
<div class='card'>
    <div class='row invoice-contact'>
        <div class='col-md-8'>
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
        <div class='col-md-4'>
            <div class='row text-center'>
                <div class='col-sm-12 invoice-btn-group'>";
				if(mysqli_num_rows($f) >0){
					echo "<button class='btn btn-default btn-lg btn-block' data-toggle='modal' data-target='#sign-in-modal' disabled=''>Forward To...</button><br>
							<font color='red'><strong>FORWARDED!</strong></font>";
				}else{
					echo "<button class='btn btn-danger btn-lg btn-block' data-toggle='modal' data-target='#sign-in-modal'>Forward To...</button><br>
							<font color='green'><strong>OPEN!</strong></font>";
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
                <p><a href='mailto:$t[info_via]'>$t[info_via] </a></p>
				 <hr>
				<table border='0' width='30%'>
				<tr><td><font size='2'>Approved By</font></td><td>&nbsp;:</td><td>&nbsp;$po[approvedBy]</td></tr>
				<tr><td><font size='2'>Approved Date</font></td><td>&nbsp;:</td><td>&nbsp;$po[approvedAt]</td></tr>
				<tr><td><font size='2'>Forwarded By</font></td><td>&nbsp;:</td><td>&nbsp;$po[forwardBy]</td></tr>
				<tr><td><font size='2'>Forwarded To</font></td><td>&nbsp;:</td><td>&nbsp;";
				while($fr = mysqli_fetch_array($f)){
					echo "$fr[DepMain], ";
				}
				echo"</td></tr>
				<tr><td><font size='2'>Forwarded Date</font></td><td>&nbsp;:</td><td>&nbsp;$po[forwardAt]</td></tr>
				</table>
				<br><br>
            </div>
        </div>
    </div>
</div>


<!--FORM FORWARD TO -->

<div class='modal fade' id='sign-in-modal' tabindex='-1'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title'>Forward To</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body p-b-0'>
                <form method='POST' action='$aksi?n=cir&act=forwardto'>
                    <div class='row'>
                        <div class='col-sm-12'>
                            <div class='input-group'>
                                <table width='100%' >
								<tr><th colspan='3'>Departemen</th></tr>
                                ";
								while($d2 = mysqli_fetch_array($dep)){
										echo "<tr>
												<td width='5%'>&nbsp;<input type='hidden' name='kode_cir' value='$t[codeCustCare]'></td>
												<td width='3%'>";
												if($d2[idDepart]==6){
													echo "<input type='checkbox' name='dep[]' value='$d2[idDepart]' onclick='return false;' checked>";
												}else{
													echo "<input type='checkbox' name='dep[]' value='$d2[idDepart]'>";
												}
												echo"</td>
												<td> &nbsp;&nbsp;$d2[departName]</td>
											  </tr>";
									}	
			echo"
								</table>
                            </div>
                        </div>
                    </div>
                
            </div>
            <div class='modal-footer'>
                <button type='submit' class='btn btn-primary'>Kirim</button>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            </div>
			</form>
        </div>
    </div>
</div>
";
break;
}
?>


