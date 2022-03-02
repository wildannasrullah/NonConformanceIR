<?php
error_reporting(0);
session_start();
include("../../config/koneksi.php");
include("../../config/fungsi_ribuan.php");
include("../../config/fungsi_indotgl.php");

	//cek apakah user sudah login 
	if(!isset($_SESSION['username'])){ 
	?><script language='javascript'>alert('You are not logged in. Please login first!');
	document.location='index.php'</script><?php
	    //jika belum login jangan lanjut.. 
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>
	CHECKER SYSTEM - KOP
    </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Phoenixcoded">
    <meta name="keywords" content=", Flat ui, Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="Phoenixcoded">
    <link rel="stylesheet" type="text/css" href="assets/css/color/color-1.css" id="color" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet'>
    <link rel='stylesheet' type='text/css' href='../../bower_components/bootstrap/dist/css/bootstrap.min.css'>
    <link rel='stylesheet' type='text/css' href='assets/icon/themify-icons/themify-icons.css'>
    <link rel='stylesheet' type='text/css' href='assets/icon/icofont/css/icofont.css'>
<link rel="stylesheet" type="text/css" href="assets/icon/font-awesome/css/font-awesome.min.css">
    <link rel='stylesheet' type='text/css' href='assets/pages/flag-icon/flag-icon.min.css'>
    <link rel='stylesheet' type='text/css' href='assets/pages/menu-search/css/component.css'>
    <link rel='stylesheet' type='text/css' href='assets/pages/dashboard/horizontal-timeline/css/style.css'>
    <link rel='stylesheet' type='text/css' href='assets/pages/dashboard/amchart/css/amchart.css'>
    <link rel='stylesheet' type='text/css' href='assets/pages/flag-icon/flag-icon.min.css'>
    <link rel='stylesheet' type='text/css' href='assets/css/style.css'>
    <link rel='stylesheet' type='text/css' href='assets/css/color/color-1.css' id='color' />
	
	<link rel="stylesheet" href="../../bower_components/select2/dist/css/select2.min.css" />

<link rel="stylesheet" type="text/css" href="../../bower_components/bootstrap-multiselect/dist/css/bootstrap-multiselect.css" />
<link rel="stylesheet" type="text/css" href="../../bower_components/multiselect/css/multi-select.css" />

<link rel="stylesheet" type="text/css" href="../../bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="assets/pages/data-table/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="../../bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
  </head>
  <body class="horizontal-fixed">
    <div class="theme-loader">
      <div class="ball-scale">
        <div>
        </div>
      </div>
    </div>
    <nav class="navbar header-navbar">
      <div class="navbar-wrapper">
        <div class="navbar-logo">
          <a class="mobile-menu" id="mobile-collapse" href="#!">
            <i class="ti-menu">
            </i>
          </a>
          <a class="mobile-search morphsearch-search" href="#">
            <i class="ti-search">
            </i>
          </a>
          <a href="#">
            <img class="img-fluid" src="assets/images/logo.png" alt="Theme-Logo" />
          </a>
          <a class="mobile-options">
            <i class="ti-more">
            </i>
          </a>
        </div>
        <div class="navbar-container container-fluid">
          <div>
            <ul class="nav-left">
              <li>
                <a id="collapse-menu" href="#">
                  <i class="ti-menu">
                  </i>
                </a>
              </li>
              <li>
                <a class="main-search morphsearch-search" href="#">
                  <i class="ti-search">
                  </i>
                </a>
              </li>
            </ul>
            <ul class='nav-right'>
              <li class='user-profile header-notification'>
                <a href='#!'>
                  <img src='assets/images/user.png' alt='User-Profile-Image'>
                  <span>
				  <?php
					$q = mysqli_query($conn, "select *from muser u left join departemenrole d on u.idDep = d.idDep where username='$_SESSION[username]'");
					$t = mysqli_fetch_array($q);
					echo"$t[fullName] - ($t[depName])";
				  ?>
                  </span>
                  <i class='ti-angle-down'>
                  </i>
                </a>
                <ul class='show-notification profile-notification'>
                  <li>
                    <a href='page.php?n=profile'>
                      <i class='ti-user'>
                      </i> Profile
                    </a>
                  </li>
                  <li>
                  <li>
                    <a href='logout.php' onclick="return confirm('Apakah Anda yakin untuk keluar dari sistem?');">
                      <i class='ti-layout-sidebar-left'>
                      </i> Logout
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
           
          </div>
        </div>
      </div>
    </nav>
    <div class="main-menu">
      <div class="main-menu-header">
        <img class="img-40" src="assets/images/user.png" alt="User-Profile-Image">
        <div class="user-details">
          <span>John Doe
          </span>
          <span id="more-details">UX Designer
            <i class="icon-arrow-down">
            </i>
          </span>
        </div>
      </div>
      <div class="main-menu-content">
        <ul class='main-navigation'>
          <li class='nav-item has-class'>
            <a href='?n=dashboard'>
              <i class='ti-home'>
              </i>
               <span>Dashboard
              </span>
            </a>
          </li>
          
          <li class='nav-item'>
            <a href='#!'>
              <i class='ti-pencil-alt'>
              </i>
              <span>Transaction
              </span>
            </a>
            <ul class='tree-1'>
			<?php
			$m = mysqli_query($conn, "select m.idMenu, m.menuName, msr.idSubMenu, msr.idDep, mg.subMenu from menu m 
							left join menugroup1 mg on m.idMenu = mg.idMenu
							left join menusubrole msr on  m.idMenu = msr.idMenu 
							where main = 'transaction' AND msr.idDep = $t[idDep]
							group by m.idMenu order by m.menuName ASC"
							);
			while($mm = mysqli_fetch_array($m)){
			echo"
			 <li class='nav-sub-item'>
                <a href='#'>$mm[menuName]
                </a>
                <ul class='tree-2'>";
				$m2 = mysqli_query($conn, "select *from menugroup1 m 
									left join menusubrole msr on  m.idSubMenu = msr.idSubMenu 
									where m.idMenu = '$mm[idMenu]' AND msr.idDep = $t[idDep] order by m.idSubMenu ASC");
				while($mm2 = mysqli_fetch_array($m2)){
				echo"
				 <li>
                    <a href='$mm2[link]'>$mm2[subMenu]
                    </a>
                  </li>";
				}
				echo"
                </ul>
              </li>";
			}
			?>
             </ul>
          </li>
          <li class='nav-item'>
            <a href='#!'>
              <i class='ti-write'>
              </i>
              <span>Report
              </span>
            </a>
            <ul class='tree-1'>
			<?php
			$rp = mysqli_query($conn, "select *from menu m left join menusubrole mr on mr.idMenu = m.idMenu
								where m.main = 'report' AND mr.idDep = $t[idDep] order by menuName ASC");
			while($rp2 = mysqli_fetch_array($rp)){
			  echo"
			  <li>
                <a href='$rp2[linkMenu]'>$rp2[menuName]
                </a>
              </li>";
			}
			  ?>
            </ul>
          </li>
		  <?php
		  if($_SESSION[level]=='admin'){
		  echo"
          <li class='nav-item'>
            <a href='#!'>
              <i class='ti-layout-grid3'>
              </i>
              <span>Master
              </span>
            </a>
            <ul class='tree-1'>
				<li class='nav-sub-item'>
                <a href='#'>Departemen
                </a>
                <ul class='tree-2'>
                  <li>
                    <a href='?n=departemen'>Departemen
                    </a>
                  </li>
				  <li>
                    <a href='?n=bagian'>Bagian
                    </a>
                  </li>
				  <li>
                    <a href='?n=role'>Role
                    </a>
                  </li>
                </ul>
              </li>
				<li>
					<a href='?n=menumanagement'>Menu Management</a>
				</li>
				<li>
					<a href='?n=user-management'>User Management</a>
				</li>
              <li class='nav-sub-item'>
                <a href='#'>System
                </a>
                <ul class='tree-2'>
                  <li>
                    <a href='?n=setting'>Setting
                    </a>
                  </li>
                </ul>
              </li>
              
            </ul>
          </li>";
		  }
		  else{}
		  ?>
        </ul>
      </div>
    </div>
   
    <div class='main-body'>
      <div class='page-wrapper'>
       <?php
		include('content.php');
	   ?>
      </div>
    </div>
	<script type="text/javascript" src="../../bower_components/jquery/dist/jquery.min.js">
    </script>
    <!----rachmad-->
    <script>
    var file=1;
    $(document).ready(function(){
      //$('#lain-lain').hide();
    });
  $('#inspection').change(function(){
    var ins = $('#inspection').val();
    if(ins=='lain-lain')
    {
      $('#lain-lain').show();
    }
    else
    {
      $('#lain-lain').hide();
    }
  });

  $('#tambah').click(function(){
    file++;
    var element = document.getElementById('fileLampiran');
    var newElement = document.createElement("input");
    newElement.setAttribute('id', "lampiran"+file);
    newElement.setAttribute('type', "file");
    newElement.setAttribute('class', "form-control m-b-30");
    newElement.setAttribute('name', "lampiran[]");
    newElement.setAttribute('accept', "image/x-png,image/gif,image/jpeg");
    newElement.setAttribute('multiple', "true");
    element.appendChild(newElement);
  });
  $('#kurang').click(function(){
    if(file > 1)
    {
    var element = document.getElementById('lampiran'+file);
    element.parentNode.removeChild(element);
    
      file--;
      console.log("total file : "+file);
    }
    
  });
</script>
<!----rachmad-->
    <script src="../../bower_components/jquery-ui/jquery-ui.min.js">
    </script>
    <script type="text/javascript" src="../../bower_components/tether/dist/js/tether.min.js">
    </script>
    <script type="text/javascript" src="../../bower_components/bootstrap/dist/js/bootstrap.min.js">
    </script>
    <script type="text/javascript" src="../../bower_components/jquery-slimscroll/jquery.slimscroll.js">
    </script>
    <script type="text/javascript" src="../../bower_components/modernizr/modernizr.js">
    </script>
    <script type="text/javascript" src="../../bower_components/modernizr/feature-detects/css-scrollbars.js">
    </script>
    <script type="text/javascript" src="../../bower_components/classie/classie.js">
    </script>
    <script src="../../bower_components/d3/d3.js">
    </script>
    <script src="../../bower_components/rickshaw/rickshaw.js">
    </script>
    <script src="../../bower_components/raphael/raphael.min.js">
    </script>
    <script src="../../bower_components/morris.js/morris.js">
    </script>
    <script type="text/javascript" src="assets/pages/dashboard/horizontal-timeline/js/main.js">
    </script>
    <script type="text/javascript" src="assets/pages/dashboard/amchart/js/amcharts.js">
    </script>
    <script type="text/javascript" src="assets/pages/dashboard/amchart/js/serial.js">
    </script>
    <script type="text/javascript" src="assets/pages/dashboard/amchart/js/light.js">
    </script>
    <script type="text/javascript" src="assets/pages/dashboard/amchart/js/custom-amchart.js">
    </script>
    <script type="text/javascript" src="../../bower_components/i18next/i18next.min.js">
    </script>
    <script type="text/javascript" src="../../bower_components/i18next-xhr-backend/i18nextXHRBackend.min.js">
    </script>
    <script type="text/javascript" src="../../bower_components/i18next-browser-languagedetector/i18nextBrowserLanguageDetector.min.js">
    </script>
    <script type="text/javascript" src="../../bower_components/jquery-i18next/jquery-i18next.min.js">
    </script>
    <script type="text/javascript" src="assets/pages/dashboard/custom-dashboard.js">
    </script>
    <script type="text/javascript" src="assets/js/script.js">
    </script>
	<script type="text/javascript" src="../../bower_components/select2/dist/js/select2.full.min.js"></script>

<script type="text/javascript" src="../../bower_components/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="../../bower_components/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="assets/js/jquery.quicksearch.js"></script>
<script type="text/javascript" src="assets/pages/advance-elements/select2-custom.js"></script>

<script src="../../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/pages/data-table/js/jszip.min.js"></script>
<script src="assets/pages/data-table/js/pdfmake.min.js"></script>
<script src="assets/pages/data-table/js/vfs_fonts.js"></script>
<script src="../../bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../../bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../../bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script type="text/javascript" src="assets/js/modal.js"></script>
<script type="text/javascript" src="assets/js/modalEffects.js"></script>
<script type="text/javascript" src="../../bower_components/i18next/i18next.min.js"></script>
<script type="text/javascript" src="../../bower_components/i18next-xhr-backend/i18nextXHRBackend.min.js"></script>
<script type="text/javascript" src="../../bower_components/i18next-browser-languagedetector/i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="../../bower_components/jquery-i18next/jquery-i18next.min.js"></script>
<script src="assets/pages/data-table/extensions/buttons/js/extension-btns-custom.js"></script>
<script src="assets/pages/data-table/js/data-table-custom.js"></script>
  </body>
</html>