<?php $isn = $this->ion_auth->user()->row();
  $zul = $isn->id;
  if ($zul == NULL){
    redirect('auth/login', 'refresh');
  }
?>
<!--                    
<table class="table table-bordered">
  <tr><td width="150">Autocomplate</td><td><input type="text" id="name_user" name="product" class="form-control ui-autocomplete-input" placeholder="Masukan Nama user ..."></td></tr>
  <tr><td>Select2</td><td><?php // echo select2_dinamis('test', 'tbl_user', 'full_name', 'Masukan keyword ...') ?></td></tr>
  <tr><td>Datalist</td><td><?php // echo datalist_dinamis('test', 'tbl_user', 'full_name') ?></td></tr>
  <tr><td>Combobox</td><td><?php // echo cmb_dinamis('test', 'tbl_user', 'full_name', 'id_users') ?></td></tr>
</table> 
-->
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="<?php if(isset($meta_description)){ echo ucfirst($meta_description);}?>">
  <meta name="keywords" content="<?php if(isset($meta_keywords)){ echo ucfirst($meta_keywords);}?>">
  <meta name="author" content="Fail Amir Abdullah">
  <link rel="icon" href="<?php if(isset($logos)){ echo base_url($logos); }?>"/>
  <title><?php if(isset($web_name)){ echo ucfirst($web_name); }?> | <?php if(isset($title)){ echo ucfirst($title); }?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('resources');?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="<?php echo base_url('resources');?>/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('resources');?>/plugins/icheck/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url('resources');?>/plugins/jqvmap/jqvmap.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url('resources');?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('resources');?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url('resources');?>/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="<?php echo base_url('resources');?>/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url('resources');?>/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url('resources');?>/plugins/summernote/summernote-bs4.css">
  <!-- <link rel="stylesheet" href="<?php echo base_url('resources');?>/bower_components/bootstrap/dist/css/bootstrap.min.css"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('resources');?>/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('resources');?>/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url('resources');?>/bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <!-- <link rel="stylesheet" href="<?php echo base_url('resources');?>/dist/css/AdminLTE.min.css"> -->
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
       
  <!-- DataTables -->
  <!-- <link rel="stylesheet" href="<?php echo base_url('resources');?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css"> -->

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="nav-icon fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo site_url();?>dashboard" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block nav-link">
        <!-- <a href="#" class="nav-link">Contact</a> -->
            Welcome <?php echo $usr->first_name; 
						echo '&nbsp;';
						echo $usr->last_name;				  
            echo '<small> (' .$usr->email. ') </small>'; 
            ?>
      </li>
      
      <li>
      <!-- <?php
				$ip = "127.0.0.1"; //IP atau website
				$port = "80"; //Port
				$sock = @fsockopen( $ip, $port, $num, $error, 2 ); //2 waktu ping
				if( !$sock ){
					//Jika Port Tertutup
					echo( '<a href="#" class="nav-link"><i class="nav-icon fa fa-circle text-danger"></i> Offline</a>');
				}
				if( $sock ){
					//Jika Port Terbuka
					echo( '<a href="#" class="nav-link"><i class="nav-icon fa fa-circle text-success"></i> Online</a>' );
					fclose($sock);
				}
			?> -->
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="nav-icon fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <li>
      <?php echo anchor('auth/logout', 'Keluar', array('class' => 'nav-link'));?>
      </li>
      <?php $this->load->view('layouts/notification'); ?>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- <a href="<?php echo base_url('resources');?>/index3.html" class="brand-link">
      <img src="<?php echo base_url('resources');?>/dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><?php if(isset($web_name)){ echo $web_name;}?></span>
    </a> -->
      
    <a href="<?= site_url() ?>" class="brand-link">
      <img src="<?php if(isset($logos)){ echo base_url($logos); }?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><?php if(isset($web_name)){ echo ucfirst($web_name); }?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- <img src="<?php echo base_url('resources');?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
          <img src="<?php if($usr->foto != NULL){
            echo base_url('assets/foto_profil/'.$usr->foto.'');
          }else{echo base_url('assets/foto_profil/default.jpg');} ?>" class="img-circle" style="width:45px;height:45px" alt="User Image">
        </div>
        <div class="info">
          <a href="<?= site_url() ?>dashboard" class="d-block"><?php echo $usr->first_name;?>
          <?php echo $usr->last_name;?><br><?php echo $usr->company;?>
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">DASHBOARD</li>
        <?php 		
              $id_user = $usr->id;
              $get_group = $this->db->get_where('users_groups', array('user_id'=> $id_user));
              $hasil = $get_group->result();
                foreach($hasil as $h)		
                if(isset($h->group_id)){
                  $in_group = $this->ion_auth->in_group($h->group_id);
                  if(isset($in_group)){
                    $get_menu = $this->db->get_where('menu',array('parent_menu' => 0, 'menu_grup_user' => $h->group_id));
                    $menu = $get_menu->result();
                    foreach($menu as $m){
                      $cekSub = $this->db->get_where('menu',array('parent_menu' => $m->id));					
                      if($cekSub->num_rows() > 0){
						echo '
						<li class="nav-item has-treeview">
            <a href="#" class="nav-link">
							<i class="nav-icon fa '.$m->icon.'"></i> <p>'.$m->nama_menu.'</p>
							<span class="pull-right-container">
							  <i class="nav-icon fa fa-angle-left pull-right"></i>
							</span>
						  </a>
						  <ul class="nav nav-treeview">
							<li class="nav-item">';
							foreach($cekSub->result() as $c)
							echo anchor(''.$c->controller_link.'','<i class="nav-icon fa '.$c->icon.'"></i><p> '.$c->nama_menu.'</p>',array('class' => 'nav-link'));
							echo '</li>
						  </ul>		  
						</li>';
					} else {
						echo '<li class="nav-item">';
						echo anchor(''.$m->controller_link.'','<i class="nav-icon fa '.$m->icon.'"></i><p> '.$m->nama_menu.'</p>',array('class' => 'nav-link'));
						echo '</li>';
					}
				}
			}			
		}			
		?>
    <?php if($this->ion_auth->is_admin()){?>
      <li class="nav-header">ADMIN AREA</li>
		<li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-users"></i> <p>Atur Pengguna</p>
            <!-- <span class="pull-right-container"> -->
              <i class="nav-icon fa fa-angle-left pull-right"></i>
            <!-- </span> -->
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
            <?php echo anchor('auth/index','<i class="nav-icon fa fa-book"></i><p> Daftar Pengguna</p>',array('class' => 'nav-link'));?></li>
            <li class="nav-item">
            <?php echo anchor('groups','<i class="nav-icon fa fa-book"></i><p> Daftar Grup</p>',array('class' => 'nav-link'));?></li>
          </ul>		  
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-globe"></i> <p>Pengaturan Situs</p>
            <!-- <span class="pull-right-container"> -->
              <i class="nav-icon fa fa-angle-left pull-right"></i>
            <!-- </span> -->
          </a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><?php echo anchor('menu','<i class="nav-icon fa fa-list"></i><p> Menu</p>',array('class' => 'nav-link'));?></li>
		<li class="nav-item"><?php echo anchor('identitas_web','<i class="nav-icon fa fa-globe"></i><p> Identitas Web</p>',array('class' => 'nav-link'));?></li>
          </ul>		  
        </li>	        
		<?php } ?>
    <li class="nav-item"><?php echo anchor('auth/edit_foto','<i class="nav-icon fa fa-image"></i><p> Ganti Foto Profil</p>',array('class' => 'nav-link'));?></li>
    <li class="nav-item"><?php echo anchor('auth/change_password','<i class="nav-icon fa fa-key"></i><p> Ganti Kata Sandi</p>',array('class' => 'nav-link'));?></li>
    <li class="nav-item"><?php echo anchor('log_aktivitas','<i class="nav-icon fa fa-history"></i><p> Log Aktivitas</p>',array('class' => 'nav-link'));?></li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage <?php if(isset($web_name)){ echo ucfirst($web_name); }?> | <?php if(isset($title)){ echo ucfirst($title); }?></h1>
          </div>
          <div class="col-sm-6">
            <!-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Layout</a></li>
              <li class="breadcrumb-item active">Fixed Layout</li>
            </ol> -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <!-- <section class="content"> -->

      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          <div class="card card-success">  
            <?php                    
            if(isset($_view) && $_view)
               $this->load->view($_view);
            ?>
                <!-- /.row -->
                </div>
                <div class="card-footer">
                <div class="nav-link"> * Perhatikan dengan seksama segala aktivitas kamu ya :)</div>
                </div>
            </div>
          </div>
        </div>
      </div>
    <!-- </section> -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <!-- <b>Version</b> 3.0.1 -->
      <b>AdminLTE Version 3.0.1</b> | Page rendered in <strong>{elapsed_time}</strong> seconds.
    </div>
    <!-- <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved. -->
    <strong>Copyright &copy; <?php echo date('Y')?> <a href="<?php echo base_url();?>"><?php if (isset($copyrights)){ echo $copyrights;}?></a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
  
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url('resources');?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('resources');?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url('resources');?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('resources');?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('resources');?>/dist/js/demo.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url('resources');?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('resources');?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- <script>
  $.widget.bridge('uibutton', $.ui.button);
  
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()    
  })
</script> -->

</body>
</html>
