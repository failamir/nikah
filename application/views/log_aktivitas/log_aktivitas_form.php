
	  <div class="card-header">
	  <h5 class="card-title"><?php echo $button ;?> Log_aktivitas</h5>
		
		<div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Action</a>
                      <a href="#" class="dropdown-item">Another action</a>
                      <a href="#" class="dropdown-item">Something else here</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">Separated link</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
			  </div>
			  <div class="card-body">
			  <!-- Content Header (Page header) -->
			  <section class="content-header">
			   
			  </section>
			  <!-- Main content -->
			  <section class="content">
			  <?php if(isset($message)){   
				   echo '<div class="alert alert-warning">  
					 <a href="#" class="close" data-dismiss="alert">&times;</a>  
					 '.$message.'
				   </div> '; 
			  }  ?>
				<!-- Default box -->
				<div class="box">	 
		<?php echo form_open($action);?>
	    <div class="form-group">
				<?php 
					echo form_label('Id User');
					echo form_error('id_user');
					echo form_input($id_user);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Aktivitas');
					echo form_error('aktivitas');
					echo form_input($aktivitas);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Time');
					echo form_error('time');
					echo form_input($time);
				?>				
			</div>
	    <?php 
			echo form_input($id); ?>
	<div class="card-footer">
                <div class="row">
	
	<?php    	echo form_submit('submit', $button , array('class'=>'btn btn-flat btn-primary'));
	        echo anchor('log_aktivitas','Batal',array('class'=>'btn btn-flat btn-warning')); 
						?>
	<?php echo form_close();?>
	</div>
                <!-- /.row -->
              </div>	
	</div>
	 </div>
               
    </section>
	<!-- /.content -->

    