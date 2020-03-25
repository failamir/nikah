
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo lang('edit_group_heading');?>
        <small><?php echo lang('edit_group_subheading');?></small>
      </h1>
      
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
        <div class="card-header">
		 <h3 class="box-title"></h3>
		<hr />
		<?php echo form_open(current_url());?>
		<div class = "form-group">
            <label><?php echo lang('edit_group_name_label', 'group_name');?> </label>
            <?php echo form_input($group_name);?>
		</div>
		<div class = "form-group">
            <label><?php echo lang('edit_group_desc_label', 'description');?> </label>
            <?php echo form_input($group_description);?>
		</div>		
		<?php echo form_submit('submit', lang('edit_group_submit_btn'),array('class'=>'btn btn-primary btn-flat'));?>
	    <a href="<?php echo site_url('auth/index') ?>" class="btn btn-flat btn-default">Batal</a>
	<?php echo form_close();?>
		</div>
		</div>
               
    </section>
	<!-- /.content -->
 