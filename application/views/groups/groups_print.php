

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
		 <h5 class="box-title">Detail Groups</h5>
    </div>
    <div class="card-body">
        <table class="table no-border">
	    <tr><td>Name</td><td><?php echo $name; ?></td></tr>
	    <tr><td>Description</td><td><?php echo $description; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('groups') ?>" class="btn btn-flat btn-warning">Kembali</a></td></tr>
	</table>
        </div>
	 </div>
               
    </section>
	<!-- /.content -->
<script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script>

