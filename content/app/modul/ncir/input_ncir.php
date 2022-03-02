<div class='page-header'>
  <div class='page-header-title'>
    <h4>Non Conformance Inspection Report
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
        <a href='#!'>NCIR
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
<h5>INSPECTION</h5>
</div>
<div class='card-header-right'>
<?php
$u = mysqli_query($conn, "select *from muser where username='$_SESSION[username]'");
$e = mysqli_fetch_array($u);
$d = mysqli_query($conn, "select *from departemenrole where idDep='$e[idDep]'");
$de = mysqli_fetch_array($d);

$aksi = "modul/ncir/aksi_ncir.php";
$p = mysqli_query($conn, "select *from ncir_inspection where ncirCode='$_GET[no]'");
$g = mysqli_fetch_array($p);
$re = mysqli_query($conn, "select *from msetting m left join msetting_value mv on m.idSetting=mv.idSetting
						  where m.name_set='ApproveNCIRInspection' and value_set='$de[depName]'");
if($_GET[st]==1){
	echo"
				<button class='btn btn-default' disabled=''>Approved</button></div>
				";
}else{
	if(mysqli_num_rows($re)>0){
		if($_GET[k]==1 AND $g[approvedBy]==NULL){
			echo"<form method='POST' action='$aksi?n=input-ncir&act=approve'>
					<input type='hidden' class='form-control' name='no_ncir' value='$g[ncirCode]'>
					<button class='btn btn-primary'>Approve</button></div>
				</form>";
		}
		else if($g[approvedBy]!=NULL){
			echo"
				<form method='POST' action='$aksi?n=input-ncir&act=disapproved'>
					<input type='hidden' class='form-control' name='no_ncir' value='$g[ncirCode]'>
					<button class='btn btn-danger'>Disapproved</button></div>
				</form>";
		}
		else{
		echo"<button class='btn btn-default' disabled='disabled'>Approve</button></div>";
		}
	}
}
	


?>
</div>

<?php

echo"
	<div class='card-block'>";
	if($_GET[k]==1){
		echo"<form action='$aksi?n=input-ncir&act=edit' method='POST' >
			 <input type='hidden' class='form-control' name='no_ncir' value='$g[ncirCode]'>";
	}else{
		echo"<form action='$aksi?n=input-ncir&act=input' method='POST' >";
	}
	echo"
      <div class='card-block'>
	<div class='row'>
	<div class='col-sm-6 col-xl-6 m-b-30'>
	  <h4 class='sub-title' align='left'>NO. NCIR
      </h4>
		<div class='input-group'>
			<input type='text' class='form-control' placeholder='NCIR Code' disabled='disabled' value='$g[ncirCode]' title='Kode NCIR otomatis terbentuk'>
			<button type='button' class='btn btn-primary waves-effect md-trigger' data-toggle='modal' data-target='#large-Modal' title='Klik untuk melihat daftar NCIR'>...</button>
		</div>
    </div>
    <div class='col-sm-6 col-xl-6 m-b-30'>
	  <h4 class='sub-title' align='left'>TANGGAL
      </h4>";
	  if($_GET[no]==NULL){
		echo "<input type='date' class='form-control' name='tgl_ncir' value='".date('Y-m-d')."' title='Tanggal Pembuatan NCIR'>";
	  }
	  else{
		 echo "<input type='date' class='form-control' name='tgl_ncir' value='$g[tanggal_ncir]' title='Tanggal Pembuatan NCIR'>"; 
	  }
	  echo"
    </div>
    
    <div class='col-sm-12 col-xl-6 m-b-30'>
      <h4 class='sub-title'>Penerbit
      </h4>
      <input type='text' name='penerbit' class='form-control' placeholder='Penerbit NCIR.....'  autofocus value='$g[penerbit]' title='Penerbit NCIR'>
    </div>
    <div class='col-sm-12 col-xl-6 m-b-30'>
      <h4 class='sub-title'>Yang Dituju
      </h4>
      <select name='tujuan' class='form-control form-control-primary' title='Tujuan diberikan NCIR'>
        <option value='#'>---Pilih Departemen Tujuan---
        </option>";
		$t = mysqli_query($conn, "select *from departemen");
		while($r = mysqli_fetch_array($t)){
			if($g[tujuan]==$r[idDepart]){
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
    
    
  </div>
  <div class='row'>
    <div class='col-sm-12 col-xl-12'>
      <h4 class='sub-title'>inspection
      </h4>
      <div class='form-radio'>";
	  
	 /*  if($g[jenis_inspection]=='Incoming Raw Material'){
           echo" <div class='radio radiofill radio-primary radio-inline'>
              <label>
                <input type='radio' name='inspek' value='Incoming Raw Material' data-bv-field='member' checked>
                <i class='helper'>
                </i>Incoming Raw Material
              </label>
            </div>
			<div class='radio radiofill radio-primary radio-inline'>
              <label>
                <input type='radio' name='inspek' value='Inprocess' data-bv-field='member'>
                <i class='helper'>
                </i>Inprocess
              </label>
            </div>
			<div class='radio radiofill radio-primary radio-inline'>
              <label>
                <input type='radio' name='inspek' value='Finished Good' data-bv-field='member'>
                <i class='helper'>
                </i>Finished Good
              </label>
            </div>";
	  }
	  else if($g[jenis_inspection]=='Inprocess'){
           echo" <div class='radio radiofill radio-primary radio-inline'>
              <label>
                <input type='radio' name='inspek' value='Incoming Raw Material' data-bv-field='member'>
                <i class='helper'>
                </i>Incoming Raw Material
              </label>
            </div>
			<div class='radio radiofill radio-primary radio-inline'>
              <label>
                <input type='radio' name='inspek' value='Inprocess' data-bv-field='member' checked>
                <i class='helper'>
                </i>Inprocess
              </label>
            </div>
			<div class='radio radiofill radio-primary radio-inline'>
              <label>
                <input type='radio' name='inspek' value='Finished Good' data-bv-field='member'>
                <i class='helper'>
                </i>Finished Good
              </label>
            </div>";
	  }else if($g[jenis_inspection]=='Finished Good'){
			echo"<div class='radio radiofill radio-primary radio-inline'>
              <label>
                <input type='radio' name='inspek' value='Incoming Raw Material' data-bv-field='member'>
                <i class='helper'>
                </i>Incoming Raw Material
              </label>
            </div>
			<div class='radio radiofill radio-primary radio-inline'>
              <label>
                <input type='radio' name='inspek' value='Inprocess' data-bv-field='member'>
                <i class='helper'>
                </i>Inprocess
              </label>
            </div>
			<div class='radio radiofill radio-primary radio-inline'>
              <label>
                <input type='radio' name='inspek' value='Finished Good' data-bv-field='member' checked>
                <i class='helper'>
                </i>Finished Good
              </label>
            </div>";
	  }
	  else{ 
		echo"  <div class='radio radiofill radio-primary radio-inline'>
              <label>
                <input type='radio' name='inspek' value='Incoming Raw Material' data-bv-field='member'>
                <i class='helper'>
                </i>Incoming Raw Material
              </label>
            </div>
			<div class='radio radiofill radio-primary radio-inline'>
              <label>
                <input type='radio' name='inspek' value='Inprocess' data-bv-field='member'>
                <i class='helper'>
                </i>Inprocess
              </label>
            </div>
			<div class='radio radiofill radio-primary radio-inline'>
              <label>
                <input type='radio' name='inspek' value='Finished Good' data-bv-field='member'>
                <i class='helper'>
                </i>Finished Good
              </label>
            </div>";
	   } */
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
          <h4 class='sub-title'>Data-data Ketidaksesuaian
          </h4>
            <div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Nama Barang
              </label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='nama_barang' placeholder='Nama Barang...' required value='$g[nama_barang]' title='Nama Barang yang di inspeksi'>
              </div>
			  <div class='col-sm-3'>
                <input type='text' class='form-control' name='po_wo' placeholder='PO/WO...' required value='$g[po_wo]' title='No PO atau WO Barang'>
              </div>
            </div>
            <div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Jumlah Ketidaksesuaian dari Jumlah Sample
              </label>
              <div class='col-sm-3'>
                <input type='text' class='form-control' placeholder='Jumlah Ketidaksesuaian' name='tidak_sesuai' value='$g[jum_ketidaksesuian]' title='Jumlah barang yang tidak sesuai'>
              </div>
			  <div class='col-sm-3'>
                <input type='text' class='form-control' placeholder='Jumlah Sample' name='sampel' value='$g[jum_sample]' title='Total keseleuruhan sample'>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Keterangan
              </label>
              <div class='col-sm-9'>
                <textarea rows='5' cols='5' class='form-control' placeholder='Keterangan' name='ket' title='Keterangan NCIR'>$g[keterangan]</textarea>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Jumlah yang dikarantina
              </label>
              <div class='col-sm-3'>
                <input type='text' class='form-control' placeholder='Jumlah yang dikarantina' name='karantina' value='$g[jum_karantina]' title='Jumlah barang yang dikarantina' >
              </div>
            </div>
            <div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Lot
              </label>
              <div class='col-sm-9'>
                <input type='text' class='form-control' name='lot' value='$g[lot]'>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  - Nomor Surat Jalan / Mesin & Shift
              </label>
              <div class='col-sm-3'>
                <input type='text' class='form-control' name='no_sj' value='$g[no_suratjalan]'>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-3 col-form-label'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  - Tanggal Kedatangan / Operator
              </label>
              <div class='col-sm-3'>
                <input type='text' class='form-control' name='tgl_datang' value='$g[tanggal_datang]'>
              </div>
            </div>
            <div class='form-group row'>
              <label class='col-sm-3 col-form-label'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  - Supplier / Supervisi
              </label>
              <div class='col-sm-3'>
                <input type='text' class='form-control' name='supplier' value='$g[supplier]'>
              </div>
            </div>
            <div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Terlampir hasil pemeriksaan tanggal
              </label>
              <div class='col-sm-9'>
                <input type='text' class='form-control' name='hasil_periksa' value='$g[tanggal_hasil]'>
              </div>
            </div>
			<hr>
			<table border='0'>
				<tr><td><font size='2'>Created By</font></td><td>&nbsp;:</td><td>&nbsp;$g[createdBy]</td></tr>
				<tr><td><font size='2'>Created Date</font></td><td>&nbsp;:</td><td>&nbsp;$g[createdDate]</td></tr>
				<tr><td><font size='2'>Approved By</font></td><td>&nbsp;:</td><td>&nbsp;$g[approvedBy]</td></tr>
				<tr><td><font size='2'>Approved Date</font></td><td>&nbsp;:</td><td>&nbsp;$g[approvedDate]</td></tr>
				<tr><td><font size='2'>Changed By</font></td><td>&nbsp;:</td><td>&nbsp;$g[changedBy]</td></tr>
				<tr><td><font size='2'>Changed Date</font></td><td>&nbsp;:</td><td>&nbsp;$g[changedDate]</td></tr>
			</table>
			<br>";
			if($g[approvedBy]==NULL){
				if($_GET[d]==1){
					echo"<button type='submit' class='btn btn-primary btn-block'>SIMPAN</button>";
					?>
					<a href='<?php echo "$aksi?n=input-ncir&act=delete&no=$g[ncirCode]";?>' onclick="return confirm('Apakah Anda yakin untuk menghapus dokumen ini?');"><?php
					echo"<button type='button' class='btn btn-warning btn-block'>HAPUS</button></a>";
				}else{
					echo"<button type='submit' class='btn btn-primary btn-block'>SIMPAN</button>";
				}
			}else{
				echo"<button type='submit' class='btn btn-default btn-block' disabled='disabled'>SIMPAN</button>";
			}
		echo"
          </form>
          
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
		<h3>Laporan NCIR</h3>
			<div>
					<div class='dt-responsive table-responsive'>
					<table id='footer-search' class='table table-striped table-bordered nowrap'>
					<thead>
					<tr>
					<th width='20%'>No. NCIR</th>
					<th width='50%'>Nama Barang</th>
					<th width='20%'>Tujuan</th>
					<th width='10%'>#</th>
					</tr>
					</thead>
					<tbody>
					<?php
					$q = mysqli_query($conn, "select n.ncirCode, n.nama_barang, n.tujuan, n.approvedBy, n.approvedDate, c.CreatedBy, d.departName 
											  from ncir_inspection n left join ncir_correction c on n.ncirCode=c.ncirCode
											  left join departemen d on n.tujuan=d.idDepart
											  order by n.ncirCode DESC");
					while($i = mysqli_fetch_array($q)){
					echo"
						<tr>
						<td><b>$i[ncirCode]</b></td>
						<td>$i[nama_barang]</td>
						<td>$i[departName]</td>
						<td>";
						if($i[approvedBy]==NULL && $i[approvedDate]==NULL){
							echo"<a href='page.php?n=input-ncir&k=1&no=$i[ncirCode]&d=1'>
								<button type='button' class='btn btn-warning '>Open</button>
							</a>";
						}else if($i[CreatedBy]!=NULL){
							echo"<a href='page.php?n=input-ncir&k=1&no=$i[ncirCode]&st=1'>
								<button type='button' class='btn btn-default '>Sent</button>
							</a>";
						}else{
							echo"<a href='page.php?n=input-ncir&k=1&no=$i[ncirCode]'>
								<button type='button' class='btn btn-danger '>Approved</button>
							</a>";
						}
						echo"</td>
						</tr>";
					}
					?>
					</tbody>
					<tfoot>
					<tr>
					<th style='display:none'>No. NCIR</th>
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

