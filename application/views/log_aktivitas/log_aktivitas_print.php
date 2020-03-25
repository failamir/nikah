

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
		 <h5 class="box-title">Detail Log_aktivitas</h5>
    </div>
    <div class="card-body">
        <table class="table no-border">
	    <tr><td>Id User</td><td><?php echo $id_user; ?></td></tr>
	    <tr><td>Aktivitas</td><td><?php echo $aktivitas; ?></td></tr>
	    <tr><td>Time</td><td><?php echo $time; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('log_aktivitas') ?>" class="btn btn-flat btn-warning">Kembali</a></td></tr>
	</table>
        </div>
	 </div>
               
    </section>
	<!-- /.content -->
<script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script>

