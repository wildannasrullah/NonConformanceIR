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
<h5>KETIDAKSESUAIAN</h5>
</div>
<div class='card-header-right'>
<?php
$u = mysqli_query($conn, "select *from muser where username='$_SESSION[username]'");
$e = mysqli_fetch_array($u);
$d = mysqli_query($conn, "select *from departemenrole where idDep='$e[idDep]'");
$de = mysqli_fetch_array($d);

$aksi = "modul/ncar/aksi_ncar.php";
$p = mysqli_query($conn, "select *from ncar where ncarCode='$_GET[no]'");
$p33 = mysqli_query($conn, "select *from ncar_correction where ncarCode='$_GET[no]'");
$g = mysqli_fetch_array($p);
$re = mysqli_query($conn, "select *from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='ApproveNcarInspection' and value_set='$de[depName]'");

	if(mysqli_num_rows($re)>0){
		if($_GET[k]==1 AND $g[approvedBy]==NULL){
			echo"<form method='POST' action='$aksi?n=input-ncar&act=approve'>
					<input type='hidden' class='form-control' name='no_ncar' value='$g[ncarCode]'>
					<button class='btn btn-primary'>Approve</button></div>
				</form>";
		}
		else if($g[approvedBy]!=NULL AND $_GET[st]!=1){
			echo"
				<form method='POST' action='$aksi?n=input-ncar&act=disapproved'>
					<input type='hidden' class='form-control' name='no_ncar' value='$g[ncarCode]'>
					<button class='btn btn-danger'>Disapproved</button></div>
				</form>";
		}
		else if($g[approvedBy]!=NULL AND $_GET[st]==1){
			echo"<button class='btn btn-default' disabled='disabled'>Disapproved</button></div>";
		}
		else if(mysqli_num_rows($p33)>0){
			echo"<button class='btn btn-default' disabled='disabled'>Disapproved</button></div>";
		}
		else{
			echo"<button class='btn btn-default' disabled='disabled'>Approve</button></div>";
		}
	}
	


?>
</div>

<?php

echo"
	<div class='card-block'>";
	if($_GET[k]==1){
		echo"<form action='$aksi?n=input-ncar&act=edit' method='POST' >
			 <input type='hidden' class='form-control' name='no_ncar' value='$g[ncarCode]'>";
	}else{
		echo"<form action='$aksi?n=input-ncar&act=input' method='POST' >";
	}
	echo"
      <div class='card-block'>
	<div class='row'>
	<div class='col-sm-6 col-xl-6 m-b-30'>
	  <h4 class='sub-title' align='left'>NO. NCAR
      </h4>
		<div class='input-group'>
			<input type='text' class='form-control' placeholder='NCAR Code' disabled='disabled' value='$g[ncarCode]' title='Kode NCAR otomatis terbentuk'>
			<button type='button' class='btn btn-primary waves-effect md-trigger' data-toggle='modal' data-target='#large-Modal' title='Klik untuk melihat daftar ncar'>...</button>
		</div>
    </div>
    <div class='col-sm-6 col-xl-6 m-b-30'>
	  <h4 class='sub-title' align='left'>TANGGAL AUDIT
      </h4>";
	  if($_GET[no]==NULL){
		echo "<input type='date' class='form-control' name='tgl_ncar' value='".date('Y-m-d')."' title='Tanggal Audit NCAR'>";
	  }
	  else{
		 echo "<input type='date' class='form-control' name='tgl_ncar' value='$g[tanggal_audit]' title='Tanggal Audit NCAR'>"; 
	  }
	  echo"
    </div>
    
    <div class='col-sm-12 col-xl-6 m-b-30'>
      <h4 class='sub-title'>Departemen / Bagian
      </h4>
     <select name='dept' class='form-control form-control-primary' title='Departemen'>
        <option value='#'>---Pilih Departemen---
        </option>";
		$t = mysqli_query($conn, "select *from departemen");
		while($r = mysqli_fetch_array($t)){
			if($g[idDepart]==$r[idDepart]){
				echo"
					<option value='$r[idDepart]' selected>$r[departName]
					</option>";
			}else{
				echo"
					<option value='$r[idDepart]'>$r[departName]
					</option>";
			}
		}
        echo"
      </select>
    </div>
    <div class='col-sm-12 col-xl-6 m-b-30'>
      <h4 class='sub-title'>Dokumen Acuan
      </h4>
     <input type='text' class='form-control' name='doc_acuan' value='$g[dokAcuan]' title='Dokumen Acuan'>
    </div>
  </div>
  <div class='row'>
    <div class='col-sm-12 col-xl-12'>
      <div class='form-radio'>";
	  
	  echo"
          </div>
    </div>
  </div>
</div>
  </div>
</div>
</div>

	<div class='col-sm-12'>
      <div class='card'>
        <div class='card-block'>
            <div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Objektif
              </label>
              <div class='col-sm-9'>
                <textarea rows='5' cols='5' class='form-control' placeholder='Objektif' name='objektif' title='Objektif'>$g[objektif]</textarea>
              </div>
            </div>
            <div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Lokasi
              </label>
              <div class='col-sm-3'>
                <input type='text' class='form-control' placeholder='Lokasi' name='lokasi' value='$g[lokasi]' title='Lokasi'>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Referensi
              </label>
              <div class='col-sm-9'>
                <textarea rows='5' cols='5' class='form-control' placeholder='Referensi' name='ref' title='Referensi'>$g[referensi]</textarea>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Penjelasan
              </label>
              <div class='col-sm-9'>
                <textarea rows='5' cols='5' class='form-control' placeholder='Penjelasan' name='penjelasan' title='Penjelasan'>$g[penjelasan]</textarea>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'><B>KATEGORI</B>
              </label>
              <div class='col-sm-9'>";
			  if($g[kategori]=='Observasi'){
                echo"<input type='radio' style='height:25px;width:23px;border: 20px solid black;' name='kategori' value='Observasi' checked><b><font size='3'> Observasi</font></b>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type='radio' style='height:25px;width:23px;border: 20px solid black;' name='kategori' value='Minor'><b><font size='3'> Minor</font></b>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type='radio' style='height:25px;width:23px;border: 20px solid black;' name='kategori' value='Major'><b><font size='3'> Major</font></b>";
				}
				else if($g[kategori]=='Minor'){
                echo"<input type='radio' style='height:25px;width:23px;border: 20px solid black;' name='kategori' value='Observasi' ><b><font size='3'> Observasi</font></b>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type='radio' style='height:25px;width:23px;border: 20px solid black;' name='kategori' value='Minor' checked><b><font size='3'> Minor</font></b>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type='radio' style='height:25px;width:23px;border: 20px solid black;' name='kategori' value='Major'><b><font size='3'> Major</font></b>";
				}
				else if($g[kategori]=='Major'){
                echo"<input type='radio' style='height:25px;width:23px;border: 20px solid black;' name='kategori' value='Observasi' ><b><font size='3'> Observasi</font></b>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type='radio' style='height:25px;width:23px;border: 20px solid black;' name='kategori' value='Minor' ><b><font size='3'> Minor</font></b>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type='radio' style='height:25px;width:23px;border: 20px solid black;' name='kategori' value='Major' checked><b><font size='3'> Major</font></b>";
				}else{
					 echo"<input type='radio' style='height:25px;width:23px;border: 20px solid black;' name='kategori' value='Observasi' ><b><font size='3'> Observasi</font></b>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type='radio' style='height:25px;width:23px;border: 20px solid black;' name='kategori' value='Minor' ><b><font size='3'> Minor</font></b>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type='radio' style='height:25px;width:23px;border: 20px solid black;' name='kategori' value='Major'><b><font size='3'> Major</font></b>";
				}
			echo"
              </div>
            </div>
            <div class='form-group row'>
              <label class='col-sm-3 col-form-label'>
              </label>
              <div class='col-sm-9'>
                <div class='row'>
					<div class='col-sm-6'>
					  <div class='input-group input-group-primary'>
						<span class='input-group-addon'>
						  <i class='icofont icofont-businessman'>
						  </i>
						</span>
						<input type='text' class='form-control' placeholder='Auditor' name='auditor' value='$g[auditor]' readonly=''>
					  </div>
					</div>
					<div class='col-sm-6'>
					  <div class='input-group input-group-primary'>
						<span class='input-group-addon'>
						  <i class='icofont icofont-businesswoman'>
						  </i>
						</span>
						<input type='text' class='form-control' placeholder='Auditee' name='auditee' value='$g[auditee]' readonly=''>
					  </div>
					</div>
					</div>
					<div class='row'>
					  <div class='col-sm-6'>
						<div class='input-group input-group-primary'>
						  <span class='input-group-addon'>
							<i class='icofont icofont-ui-calendar'>
							</i>
						  </span>
						  <input type='text' class='form-control' placeholder='Tanggal' name='tanggal_auditor'  value='approved date : $g[tanggal_auditor]'  readonly=''>
						</div>
					  </div>
					  <div class='col-sm-6'>
						<div class='input-group input-group-primary'>
						  <span class='input-group-addon'>
							<i class='icofont icofont-ui-calendar'>
							</i>
						  </span>
						  <input type='text' class='form-control' placeholder='Tanggal' name='tanggal_auditee'  value='approved date : $g[tanggal_auditee]'  readonly=''>
						</div>
					  </div>
					</div>
					<div class='row'>
					  <div class='col-sm-6'>
						<div class='input-group input-group-primary'>
						  ";
						  if($g[ttd_auditor]==NULL){
							  
						  }else{
							echo "<span class='input-group-addon'>
							<i class='icofont icofont-tick-boxed'>
							</i>
						  </span><input type='text' class='form-control' placeholder='Tanda Tangan' name='ttd_auditor' value='approved by : $g[ttd_auditor]' readonly=''>";
						  }
						  echo"
						</div>
					  </div>
					  <div class='col-sm-6'>
						<div class='input-group input-group-primary'>
						  ";
						  if($g[ttd_auditee]==NULL){
							  
						  }else{
							echo "<span class='input-group-addon'>
							<i class='icofont icofont-tick-boxed'>
							</i>
						  </span><input type='text' class='form-control' placeholder='Tanda Tangan' name='ttd_auditee' value='approved by : $g[ttd_auditee]' readonly=''>";
						  }
						  echo"
						</div>
					  </div>
					</div>
              </div>
            </div>
          <hr>
				<table border='0' width='30%'>
				<tr><td><font size='2'>Created By</font></td><td>&nbsp;:</td><td>&nbsp;$g[createdBy]</td></tr>
				<tr><td><font size='2'>Created Date</font></td><td>&nbsp;:</td><td>&nbsp;$g[createdDate]</td></tr>
				<tr><td><font size='2'>Approved By</font></td><td>&nbsp;:</td><td>&nbsp;$g[approvedBy]</td></tr>
				<tr><td><font size='2'>Approved Date</font></td><td>&nbsp;:</td><td>&nbsp;$g[approvedDate]</td></tr>
				<tr><td><font size='2'>Changed By</font></td><td>&nbsp;:</td><td>&nbsp;$g[changedBy]</td></tr>
				<tr><td><font size='2'>Changed Date</font></td><td>&nbsp;:</td><td>&nbsp;$g[changedDate]</td></tr>
				<tr><td><font size='2'></font></td><td></td><td>&nbsp;</td></tr>
				<tr><td><font size='2'><br><b>QF. KOP-QA-9.2-004 REV : 01</b></font></td><td></td><td>&nbsp;</td></tr>
				</table>
				<br><br>
			";
			 if($g[approvedBy]==NULL){ 
				echo"<button type='submit' class='btn btn-primary btn-block'>SIMPAN</button>";
			}else{
				echo"<button type='submit' class='btn btn-default btn-block' disabled='disabled'>SIMPAN</button>";
			}
		echo"
          </form>
    </div>
</p>
            
    </div>
	";
	?>
  </div>
</div>

<div class='modal fade' id='large-Modal' tabindex='-1' role='dialog'>
<div class='modal-dialog modal-lg' role='document'>
<div class='col-sm-12'>
  <div class='card'>
    <div class='card-block'>
	<div class='md-content'>
		<h3>Laporan NCAR</h3>
			<div>
					<div class='dt-responsive table-responsive'>
					<table id='footer-search' class='table table-striped table-bordered nowrap'>
					<thead>
					<tr>
					<th width='20%'>No. NCAR</th>
					<th width='10%'>Tanggal Audit</th>
					<th width='20%'>Departemen</th>
					<th width='20%'>Dok. Acuan</th>
					<th width='10%'>#</th>
					</tr>
					</thead>
					<tbody>
					<?php
					
					$q = mysqli_query($conn, "select n.ncarCode, n.tanggal_audit, n.dokAcuan, d.departName, n.approvedBy, n.approvedDate 
											  from ncar n left join departemen d on n.idDepart=d.idDepart
											  order by n.ncarCode DESC");
					while($i = mysqli_fetch_array($q)){
						$qs = mysqli_query($conn, "select *from ncar_correction where ncarCode = '$i[ncarCode]'");
					echo"
						<tr>
						<td><b>$i[ncarCode]</b></td>
						<td>$i[tanggal_audit]</td>
						<td>$i[departName]</td>
						<td>$i[dokAcuan]</td>
						<td>";
						if(mysqli_num_rows($qs)>0){
							echo"<a href='page.php?n=input-ncar&k=1&no=$i[ncarCode]&st=1'>
								<button type='button' class='btn btn-default '>Sent</button>
							</a>";
						}else{
							if(($i[approvedBy]==NULL) && ($i[approvedDate]==NULL)){
								echo"<a href='page.php?n=input-ncar&k=1&no=$i[ncarCode]&d=1'>
									<button type='button' class='btn btn-warning '>Open</button>
								</a>";
							}else{
								echo"<a href='page.php?n=input-ncar&k=1&no=$i[ncarCode]'>
									<button type='button' class='btn btn-danger '>Approved</button>
								</a>";
							}
						}
						echo"</td>
						</tr>";
						
					}
					?>
					</tbody>
					<tfoot>
					<tr>
					<th style='display:none'>No. ncar</th>
					<th style='display:none'>Nama Barang</th>
					<th  style='display:none'></th>
					<th style='display:none'></th>

					</tr>
					</tfoot>
					</table>
					</div>
					</div>
			</div>
</div>
</div></div></div>
</div>
<div class='md-overlay'></div>

