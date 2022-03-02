<?php
//NCIR
if ($_GET['n']=='dashboard'){
    include "modul/dashboard.php";
}
if ($_GET['n']=='input-ncir'){
    include "modul/ncir/input_ncir.php";
}
if ($_GET['n']=='list-ncir'){
    include "modul/ncir/daftar_ncir.php";
}
if ($_GET['n']=='input-correction'){
    include "modul/ncir/input_koreksi.php";
}

//NCAR
if ($_GET['n']=='input-ncar'){
    include "modul/ncar/input_ncar.php";
}
if ($_GET['n']=='list-ncar'){
    include "modul/ncar/daftar_ncar.php";
}
if ($_GET['n']=='ncar-correction'){
    include "modul/ncar/input_koreksi.php";
}

//NCR
if ($_GET['n']=='input-ncr'){
    include "modul/ncr/input_ncr.php";
}
if ($_GET['n']=='list-ncr'){
    include "modul/ncr/daftar_ncr.php";
}
if ($_GET['n']=='ncr-correction'){
    include "modul/ncr/input_koreksi.php";
}

//CIR
if($_GET['n']=='list-cir'){
	include "modul/cir/daftar_cir.php";
}
if($_GET['n']=='forward-cir'){
	include "modul/cir/forward_cir.php";
}

//MASTER
if ($_GET['n']=='departemen'){
    include "modul/master/departemen.php";
}
if ($_GET['n']=='bagian'){
    include "modul/master/bagian.php";
}
if ($_GET['n']=='role'){
    include "modul/master/role.php";
}
if ($_GET['n']=='menu-management'){
    include "modul/master/menu.php";
}
if ($_GET['n']=='user-management'){
    include "modul/master/user.php";
}
if ($_GET['n']=='setting'){
    include "modul/master/setting.php";
}
if ($_GET['n']=='menumanagement'){
    include "modul/master/menu_manage.php";
}

//REPORT
if($_GET['n']=='rpncir'){
	include "modul/report/report_ncir.php";
}
if($_GET['n']=='detail-ncir'){
	include "modul/report/detail_report.php";
}
if($_GET['n']=='rpncr'){
    include "modul/report/report_ncr.php";
}
if($_GET['n']=='detail-ncr'){
    include "modul/report/detail_report_ncr.php";
}
if($_GET['n']=='rpcir'){
    include "modul/report/report_cir.php";
}
if($_GET['n']=='detail-cir'){
    include "modul/report/detailcir_report.php";
}
if($_GET['n']=='rpncar'){
    include "modul/report/report_ncar.php";
}
if($_GET['n']=='detail-ncar'){
    include "modul/report/detailncar_report.php";
}

//USER
if($_GET['n']=='profile'){
	include "modul/user/profile.php";
}
?>