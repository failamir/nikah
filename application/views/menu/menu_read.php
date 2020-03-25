

   <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
	<?php if(isset($message)){   
		 echo '<div class="alert alert-warning">  
		   <a href="#" class="close" data-dismiss="alert">&times;</a>  
		   '.$message.'
		 </div> '; 
    }  ?>
      <!-- Default box -->
      
        <div class="card-header">
		 <h5 class="box-title">Detail Menu</h5>
    </div>
    <div class="card-body">
        <table class="table no-border">
	    <tr><td>Parent Menu</td><td><?php echo $parent_menu; ?></td></tr>
	    <tr><td>Nama Menu</td><td><?php echo $nama_menu; ?></td></tr>
	    <tr><td>Controller Link</td><td><?php echo $controller_link; ?></td></tr>
	    <tr><td>Icon</td><td><?php echo $icon; ?></td></tr>
	    <tr><td>Slug</td><td><?php echo $slug; ?></td></tr>
	    <tr><td>Urut Menu</td><td><?php echo $urut_menu; ?></td></tr>
	    <tr><td>Menu Grup User</td><td><?php echo $menu_grup_user; ?></td></tr>
	    <tr><td>Is Active</td><td><?php echo $is_active; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('menu') ?>" class="btn btn-flat btn-warning no-print">Kembali</a></td></tr>
	</table>
        </div>
	 </div>
               
    </section>
	<!-- /.content -->