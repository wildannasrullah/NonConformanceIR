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

					$dv = mysqli_query($conn, "select *from departemenrole dr 
											  left join departemen d on dr.idDepart=d.idDepart
											  left join departemenmain dm on d.idDepMain=dm.idDepMain
											  where dr.idDep='$e[idDep]'");
					$dev = mysqli_fetch_array($dv);

$d = mysqli_query($conn, "select *from departemenrole where idDep='$e[idDep]'");
$de = mysqli_fetch_array($d);

$aksi = "modul/ncar/aksi_ncar.php";
$p = mysqli_query($conn, "select *from ncar where ncarCode='$_GET[no]'");
$g = mysqli_fetch_array($p);

$p2 = mysqli_query($conn, "select *from ncar_correction where idCorNcar='$_GET[coir]'");
$g2 = mysqli_fetch_array($p2);
$pveri = mysqli_query($conn, "select *from ncar_verifikasi where ncarCode='$_GET[no]'");
$pvqa = mysqli_query($conn, "select *from ncar_verifikasi_qa where ncarCode='$_GET[no]'");
$hh = mysqli_fetch_array($pvqa);

$re = mysqli_query($conn, "select *from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='ApproveNCARInspection' and value_set='$de[depName]'");

	if(mysqli_num_rows($re)>0){
		if($_SESSION[username]=="$g[createdBy]"){
			
		}else{
		if($_GET[k]==1 AND $g2[ApprovedBy]==NULL){
			echo"<form method='POST' action='$aksi?n=ncar-correction&act=approve&no=$_GET[no]&coir=$_GET[coir]'>
					<input type='hidden' class='form-control' name='no_coir' value='$g[idCorNcar]'>
					<button class='btn btn-primary'>Approve</button></div>
				</form>";
		}
		else if($g2[ApprovedBy]!=NULL){
			if(mysqli_num_rows($pveri)>0 || mysqli_num_rows($pvqa)>0){
				if($hh[status]=='Close'){
					echo"<button type='button' class='btn btn-success' title='Sudah Dikoreksi' ><i class='fa fa-check'></i></button>
			
					&nbsp;<button type='button' class='btn btn-inverse' title='Cetak' onclick='print_d()'><i class='fa fa-print'></i> Cetak</button>
					";
					?>
					<script type="text/javascript">
						function print_d(){
							window.open("<?php echo "modul/ncar/print/print.php?no=$_GET[no]&coir=$_GET[coir]&s=finish&k=1"?>","target=_blank");
						}
					</script>
					<?php
				}else{
					echo"
					<button class='btn btn-default' disabled=''>Disapproved</button></div>";
				}
			}else{
			echo"
				<form method='POST' action='$aksi?n=ncar-correction&act=disapproved&no=$_GET[no]&coir=$_GET[coir]'>
					<input type='hidden' class='form-control' name='no_coir' value='$g[idCorNcar]'>
					<button class='btn btn-danger'>Disapproved</button></div>
				</form>";
			}
		}
		else{
		echo"<button class='btn btn-default' disabled='disabled'>Approve</button></div>";
		}
		}
	}
	


?>
</div>

<?php
$n = mysqli_query($conn, "SELECT *from ncar_correction where ncarCode = '$_GET[no]'");
echo"
	<div class='card-block'>";
	if(mysqli_num_rows($n)>0){
		echo"<form action='$aksi?n=ncar-correction&act=edit&no=$_GET[no]&coir=$_GET[coir]' method='POST' >
			 <input type='hidden' class='form-control' name='no_ncar' value='$g[ncarCode]'>";
	}else{
		echo"<form action='$aksi?n=ncar-correction&act=input' method='POST' >";
	}
	echo"
      <div class='card-block'>
	<div class='row'>
	<div class='col-sm-6 col-xl-6 m-b-30'>
	  <h4 class='sub-title' align='left'>NO. NCAR
      </h4>
		<div class='input-group'>
			<input type='text' class='form-control' placeholder='NCAR Code' disabled='disabled' value='$g[ncarCode]' title='Kode NCAR otomatis terbentuk'>
			<input type='hidden' class='form-control' name='no_ncar' value='$g[ncarCode]'>
			
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
			echo"</div>
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
							  echo "<a href='$aksi?n=ttd&act=ttd&no_ncar=$g[ncarCode]'><button type='button' class='button btn btn-primary'>Tanda Tangan Auditee</button>
									</a>";
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
							  echo "<a href='$aksi?n=ttd_auditee&act=ttd_auditee&no_ncar=$g[ncarCode]'><button type='button' class='button btn btn-primary'>Tanda Tangan Auditee</button>
									</a>";
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
<div class='accordion-panel'>
<div class='accordion-heading' role='tab' id='headingOne'>
<h3 class='card-title accordion-title'>
<a class='accordion-msg bg-danger b-none' data-toggle='collapse' data-parent='#accordion' href='#collapseOne' aria-expanded='false' aria-controls='collapseOne'>
Correction
</a>
</h3>
</div>
";
if($_GET[s]=='finish'){
	echo"
	<div id='collapseOne' class='panel-collapse collapse show' role='tabpanel' aria-labelledby='headingOne'>";
}
else{
	echo"
	<div id='collapseOne' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>";
}
echo"
<div class='accordion-content accordion-desc'>
    <div class='col-sm-12 col-xl-12'><br>
      <h4 class='sub-title'>Correction
      </h4>";
$query = "select *from ncar_correction_type where idCorNcar = '$_GET[coir]'";
			$sq = mysqli_query($conn, $query);
			$cek_user = array();
			while($row = mysqli_fetch_assoc($sq)) {
					$cek_user [ $row['jenisCor'] ] = $row['jenisCor'];
			}
            foreach($cek_user as $kode=>$cu) {
						$check_list[]=$cu;
			}  
			$checked= $check_list;
$jk = mysqli_query($conn, "select *from mjeniskoreksi where idKoreksi IN ('6','7','8') order by idKoreksi ASC");
while($j = mysqli_fetch_array($jk)){
	$checked= $check_list;
	?>
	<input type='checkbox' name='koreksi[]' value="<?php echo $j[jenisKoreksi]; ?>" style='height:20px;width:20px;background-color:white' <?php in_array ($j[jenisKoreksi], $checked) ? print "checked" : ""; ?>>&nbsp;<?php echo $j[jenisKoreksi];?>&nbsp;&nbsp;
<?php
}
echo"
    </div>
  </div>";
  $o = mysqli_query($conn, "select *from ncar_correction where idCorNcar='$_GET[coir]'");
  $h = mysqli_fetch_array($o);
echo"
	<div class='col-sm-12'>
      <div class='card'>
        <div class='card-block'>
            
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Root Cause
              </label>
              <div class='col-sm-9'>
                <textarea rows='5' cols='5' class='form-control' placeholder='Root Cause...' name='root'>$h[rootCauseNcar]</textarea>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Corrective Action
              </label>
              <div class='col-sm-9'>
                <textarea rows='5' cols='5' class='form-control' placeholder='Corrective Action...' name='correct' >$h[CorrectiveActNcar]</textarea>
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
						<input type='text' class='form-control' placeholder='Manager Auditee' name='manager_au'  value='$h[managerAuditee]' readonly=''>
					  </div>
					</div>
					<div class='col-sm-6'>
					  <div class=''>
						  Tanggal Selesai : <input type='date' class='form-control' placeholder='Tanggal Penyelesaian' name='tanggal_selesai' value='$h[tanggalSelesai]'>
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
						  <input type='text' class='form-control' placeholder='Tanggal' name='tanggal_auditor'  readonly='' value='Approved date : $h[tanggal_mgr]' >
						</div>
					  </div>
					  <div class='col-sm-6'>
						<div class='input-group input-group-primary'>
						  
						</div>
					  </div>
					</div>
					<div class='row'>
					  <div class='col-sm-6'>
						<div class='input-group input-group-primary'>
						  <span class='input-group-addon'>
							<i class='icofont icofont-tick-boxed'>
							</i>
						  </span>
						  <input type='text' class='form-control' placeholder='Tanda Tangan' name='ttd_auditor' value='Approved by : $h[ttd_mgrAuditee]' readonly=''>
						</div>
					  </div>
					  <div class='col-sm-6'>
						<div class='input-group input-group-primary'>
						</div>
					  </div>
					</div>
              </div>
            </div>";
			echo"
			<br>
			
          <hr>
				<table border='0' width='30%'>
				<tr><td><font size='2'>Created By</font></td><td>&nbsp;:</td><td>&nbsp;$h[CreatedBy]</td></tr>
				<tr><td><font size='2'>Created Date</font></td><td>&nbsp;:</td><td>&nbsp;$h[CreatedDate]</td></tr>
				<tr><td><font size='2'>Approved By</font></td><td>&nbsp;:</td><td>&nbsp;$h[ApprovedBy]</td></tr>
				<tr><td><font size='2'>Approved Date</font></td><td>&nbsp;:</td><td>&nbsp;$h[ApprovedDate]</td></tr>
				<tr><td><font size='2'>Changed By</font></td><td>&nbsp;:</td><td>&nbsp;$h[ChangedBy]</td></tr>
				<tr><td><font size='2'>Changed Date</font></td><td>&nbsp;:</td><td>&nbsp;$h[ChangedDate]</td></tr>
				<tr><td><font size='2'></font></td><td></td><td>&nbsp;</td></tr>
				<tr><td><font size='2'><br><b>QF. KOP-QA-9.2-004 REV : 01</b></font></td><td></td><td>&nbsp;</td></tr>
				</table>
				<br><br>
			";
			if($h[ApprovedBy]==NULL){
				echo"<button type='submit' class='btn btn-primary btn-block'>SIMPAN</button>";
			}else{
				echo"<button type='submit' class='btn btn-default btn-block' disabled='disabled'>SIMPAN</button>";
			}
		echo"
          </form><br /><br />
		  
		  ";
	if($h[ApprovedBy]!=NULL){  
		if($_SESSION[username]==$g[createdBy]){ // HASIL VERIFIKASI
		$fv = mysqli_query($conn, "select *from ncar_verifikasi where ncarCode='$_GET[no]'");
		$c = mysqli_fetch_array($fv);
			echo"
			
		  <form action='$aksi?n=ncar-correction&act=verifikasi&no=$_GET[no]&coir=$_GET[coir]' method='POST' >
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'><b>Hasil Verfikasi Oleh Auditor</b>
              </label>
              <div class='col-sm-9'>
                <textarea rows='5' cols='5' class='form-control' placeholder='Verify Result...' name='hasil_verifikasi'>$c[hasilVerifikasi]</textarea>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Tanggal Pemeriksaan
              </label>
              <div class='col-sm-3'>
                <input type='date' class='form-control' placeholder='Tanggal Pemeriksaan' name='tanggal_periksa' value='$c[tanggal_periksa]'>
              </div>
            </div>";
			$fcf = mysqli_query($conn, "select *from ncar_verifikasi_qa where ncarCode='$_GET[no]'");
			$tgx = mysqli_fetch_array($fcf);
			if(mysqli_num_rows($fcf) > 0 AND $tgx[status]=='Close'){
				echo"<button type='button' class='btn btn-default btn-block' disabled=''>SIMPAN</button>";
			}
			else if(mysqli_num_rows($fcf) > 0 AND $tgx[status]=='Open'){
				echo"<button type='submit' class='btn btn-primary btn-block'>SIMPAN</button>";
			}else{
				echo"<button type='submit' class='btn btn-primary btn-block'>SIMPAN</button>";
				if(mysqli_num_rows($fv)>0){
					echo"<a href='modul/ncar/aksi_ncar.php?n=ncar-correction&act=delver&no=$_GET[no]&coir=$_GET[coir]&s=finish&k=1&id=$c[idNcarVer]'><button type='button' class='btn btn-warning btn-block'>HAPUS</button></a>";
				}
			
			}
			echo"</form>
			";
		}else{
			
			$fv = mysqli_query($conn, "select *from ncar_verifikasi where ncarCode='$_GET[no]'");
		$c = mysqli_fetch_array($fv);
			echo"
			
		  <form action='$aksi?n=ncar-correction&act=verifikasi&no=$_GET[no]&coir=$_GET[coir]' method='POST' >
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'><b>Hasil Verfikasi Oleh Auditor</b>
              </label>
              <div class='col-sm-9'>
                <textarea rows='5' cols='5' class='form-control' placeholder='Verify Result...' name='hasil_verifikasi'>$c[hasilVerifikasi]</textarea>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Tanggal Pemeriksaan
              </label>
              <div class='col-sm-3'>
                <input type='date' class='form-control' placeholder='Tanggal Pemeriksaan' name='tanggal_periksa' value='$c[tanggal_periksa]'>
              </div>
            </div>";
				echo"<button type='button' class='btn btn-default btn-block' disabled=''>SIMPAN</button>";
			
			echo"</form>
			";
		}
	}else{}
	
	$verf = mysqli_query($conn, "select *from ncar_verifikasi where ncarCode = '$_GET[no]'");
			echo"
</p>
            
    </div></div>";
if(mysqli_num_rows($verf)>0){
	if(mysqli_num_rows($re)>0){
	$tr = mysqli_query($conn, "select *from ncar_verifikasi_qa where ncarCode='$_GET[no]'");
	$f = mysqli_fetch_array($tr);
		echo"
	 <form action='$aksi?n=ncar-correction&act=qa&no=$_GET[no]&coir=$_GET[coir]' method='POST' >
	 <div class='col-sm-12 col-xl-12'>
      <h4 class='sub-title'><b>Hasil Verifikasi Oleh Quality Assurance :</b>
      </h4>
    </div>
  </div>
	<div class='col-sm-12'>
      <div class='card'>
        <div class='card-block'>
            
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Komentar
              </label>
              <div class='col-sm-9'>
                <textarea rows='5' cols='5' class='form-control' placeholder='Komentar...' name='komentar'>$f[komentar]</textarea>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Status
              </label>
              <div class='col-sm-9'>";
			if($f[status]=='Open'){
				echo"<label>
                <input type='radio' name='status' value='Open' style='height:20px; width:20px;' checked>
                <i class='helper'>
                </i>OPEN
              </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label>
                <input type='radio' name='status' value='Close' style='height:20px; width:20px;'>
                <i class='helper'>
                </i>CLOSE
              </label>";
			}else if($f[status]=='Close'){
				echo"<label>
                <input type='radio' name='status' value='Open' style='height:20px; width:20px;' >
                <i class='helper'>
                </i>OPEN
              </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label>
                <input type='radio' name='status' value='Close' style='height:20px; width:20px;' checked>
                <i class='helper'>
                </i>CLOSE
              </label>";
			}else{
           echo"<label>
                <input type='radio' name='status' value='Open' style='height:20px; width:20px;'>
                <i class='helper'>
                </i>OPEN
              </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label>
                <input type='radio' name='status' value='Close' style='height:20px; width:20px;'>
                <i class='helper'>
                </i>CLOSE
              </label>";
			}
            echo"  </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Tanggal
              </label>
              <div class='col-sm-3'>
                <input type='date' class='form-control' placeholder='Tanggal' name='tanggal_qa' value='$f[tanggal_qa]'>
              </div>
            </div> ";
			if($dev[departName]=='Quality'){
				echo"<button type='submit' class='btn btn-primary btn-block'>SIMPAN</button>";
				if(mysqli_num_rows($tr)>0){
					echo"<a href='modul/ncar/aksi_ncar.php?n=ncar-correction&act=delverqa&no=$_GET[no]&coir=$_GET[coir]&s=finish&k=1&id=$f[idVerQa]'><button type='button' class='btn btn-warning btn-block'>HAPUS</button></a>";
				}
			}else{
				echo"<button type='button' class='btn btn-default btn-block'>SIMPAN</button>";
			}
			
			echo"</form>
			";
		}else{}
}
else{}
	echo"
	
    </div>
</p>
            
    </div>
	";
	?>
  </div>
</div>

<div class='modal fade' id='large-Modal' tabindex='-1' role='dialog'>
<div class='modal-dialog modal-lg' role='document'>
	<div class='md-content'>
		<h3>Laporan NCAR</h3>
			<div>
					<div class='dt-responsive table-responsive'>
					<table id='footer-search' class='table table-striped table-bordered nowrap'>
					<thead>
					<tr>
					<th width='20%'>No. NCAR</th>
					<th width='50%'>Nama Barang</th>
					<th width='10%'>#</th>
					</tr>
					</thead>
					<tbody>
					<?php
					$q = mysqli_query($conn, "select *from ncar where approvedBy is null and approvedDate is null order by ncarCode DESC");
					while($i = mysqli_fetch_array($q)){
					echo"
						<tr>
						<td><b>$i[ncarCode]</b></td>
						<td>$i[nama_barang]</td>
						<td>
							<a href='page.php?n=input-ncar&k=1&no=$i[ncarCode]'>
								<button type='button' class='btn btn-warning '>Show</button>
							</a>
						</td>
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

<div class='md-overlay'></div>
</div>

