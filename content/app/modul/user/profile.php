<div class='page-header'>
  <div class='page-header-title'>
    <h4>User Profile
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
        <a href='#!'>Users
        </a>
      </li>
      <li class='breadcrumb-item'>
        <a href='#!'>Profile
        </a>
      </li>
    </ul>
  </div>
</div>
<?php
error_reporting(0);
session_start();
include("../config/koneksi.php");
$r = mysqli_query($conn, "select *from muser where username = '$_SESSION[username]'");
$t = mysqli_fetch_array($r);
echo"
<div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                    <div class='form-element-list'>
						<form method='POST' action='modul/user/act_editpass.php'>
						 <input type='hidden' class='form-control' value='$t[idUser]' name='id_user'>
                        <div class='row'>
                            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                                <div class='form-group ic-cmp-int'>
                                    <div class='form-ic-cmp'>
                                        <i class='notika-icon notika-support'></i>
                                    </div>
                                    <div class='nk-int-st'>
                                        <input type='text' class='form-control' placeholder='Username' value='$t[username]' disabled=''>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class='row'>
                            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                                <div class='form-group ic-cmp-int'>
                                    <div class='form-ic-cmp'>
                                        <i class='notika-icon notika-support'></i>
                                    </div>
                                    <div class='nk-int-st'>
                                        <input type='text' class='form-control' placeholder='Full Name' value='$t[fullName]' name='fullname'>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                           <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                                <div class='form-group ic-cmp-int'>
                                    <div class='form-ic-cmp'>
                                        <i class='notika-icon notika-map'></i>
                                    </div>
                                    <div class='nk-int-st'>
                                        <input type='password' class='form-control' placeholder='Password' value='$t[password]' name='password'>
                                    </div>
                                </div>
                            </div>
                        </div>
						<p align='right'><button type='submit' class='btn btn-success notika-btn-success'>Update</button></p>
						</form>
                    </div>
                </div>
				";
				?>