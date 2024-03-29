<?php
  $user_id = $this->session->userdata('userid');
  $NamaUser = $this->session->userdata('NamaUser');
  // $active;
  $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
  $lastUriSegment = array_pop($uriSegments);
  $active = $lastUriSegment;
  $title = '';
  if($user_id == ''){
    echo "<script>location.replace('".base_url()."home');</script>";
  }
  switch ($active) {
    case 'home':
      $title = 'Dashboard';
      break;
    case 'pinjam':
      $title = 'Peminjaman Alat';
      break;
    case 'kembali':
      $title = 'Pengembalian Alat';
      break;
    case 'pelihara':
      $title = 'Pemeliharaan';
      break;
    case 'mesinlist':
      $title = 'Daftar Alat';
      break;
    case 'fasyankes':
      $title = 'Daftar Fasyankes';
      break;
    case 'pegawai':
      $title = 'Daftar Pegawai';
      break;
    case 'vendor':
      $title = 'Daftar Vendor';
      break;
    case 'user':
      $title = 'User Management';
      break;
    case 'change':
      $title = 'Change Password';
      break;
    default:
      # code...
      break;
  }
//test
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $title; ?></title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo base_url();?>Assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>Assets/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>Assets/css/fullcalendar.css" />
<link rel="stylesheet" href="<?php echo base_url();?>Assets/css/matrix-style.css" />
<link rel="stylesheet" href="<?php echo base_url();?>Assets/css/matrix-media.css" />
<link href="<?php echo base_url();?>Assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url();?>Assets/css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo base_url();?>Assets/css/uniform.css" />
<link rel="stylesheet" href="<?php echo base_url();?>Assets/css/select2.css" />
<link rel="stylesheet" href="<?php echo base_url();?>Assets/css/bootstrap-wysihtml5.css" />
<!-- <link rel="stylesheet" href="<?php echo base_url();?>test/index.js" /> -->
<link rel='shortcut icon' href='<?php echo base_url();?>favicon.ico' type='image/x-icon' />

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/css/mdb.min.css" /> -->

<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/js/mdb.min.js"></script> -->
<!-- Sweet alert -->
<script src="<?php echo base_url();?>Assets/sweetalert2-8.8.0/package/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>Assets/sweetalert2-8.8.0/package/dist/sweetalert2.min.css">

<!-- dev express -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>window.jQuery || document.write(decodeURIComponent('%3Cscript src="js/jquery.min.js"%3E%3C/script%3E'))</script>
    <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/19.1.6/css/dx.common.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/19.1.6/css/dx.light.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.2/jszip.min.js"></script>
    <script src="https://cdn3.devexpress.com/jslib/19.1.6/js/dx.all.js"></script>

<style type="text/css">
  body.scrollable {
  overflow-y: auto; }
</style>
</head>
<body>

<!--Header-part-->
<div id="header">
  <img src="<?php echo base_url();?>Assets/img/logo_2.png" width = "12%">
</div>
<!--close-Header-part--> 


<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li class=""><a title="" href="<?php echo base_url(); ?>auth/logout"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
    <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text"><?php echo $NamaUser; ?></span></a>
      <ul class="dropdown-menu">
        <li><a class="sInbox" title="" href="<?php echo base_url(); ?>home/change"><i class="icon-key"></i> Change Password</a></li>
      </ul>
    </li>
  </ul>
</div>
<!--close-top-Header-menu-->
<!--start-top-serch-->
<!-- <div id="search">
  <input type="text" placeholder="Search here..."/>
  <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</div> -->
<!--close-top-serch-->
