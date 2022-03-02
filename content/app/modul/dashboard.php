<div class='page-header'>
  <div class='page-header-title'>
    <h4>Dashboard
    </h4>
    <span>Dashboard
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
            <div class='col-md-12 col-xl-12'>
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
                    </div>
                    <div class='col-sm-12'><h4>";
					?>
					<script type='text/javascript'>
window.setTimeout("hari()",0)
function hari(){
 var namah = new Array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
 var namab = new Array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "November", "Desember");
 var tanggal = new Date();
 setTimeout("hari()",0);
 document.getElementById("dino").innerHTML =namah[tanggal.getDay()]+", "+tanggal.getDate()+" "+namab[tanggal.getMonth()]+" "+tanggal.getFullYear();
}
</script>

<b><u><div style="color : white;font-size: 20pt" id='dino'></div></u></b>
<?php
						
					 $tanggal = mktime(date('m'), date("d"), date('Y'));
						date_default_timezone_set("Asia/Jakarta");
						$jam = date ("H:i:s");
						echo "<b> " . $jam . " " ." </b> ";
						$a = date ("H");
						if (($a>=6) && ($a<=11)) {
							echo " <b>, Selamat Pagi</b>";
						}else if(($a>=11) && ($a<=15)){
							echo " , Selamat  Pagi !! ";
						}elseif(($a>15) && ($a<=18)){
							echo ", Selamat Siang";
						}else{
							echo ", <b> Selamat Malam </b>";
						}
				
					  ?>
                      </h4>
                      <h6>
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


 
 
 


</div>
</div>

