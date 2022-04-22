<?php 

$string = "
	  <div class=\"card-header\">
	  <h5 class=\"card-title\"><?php echo \$button ;?> ".ucfirst($table_name)."</h5>
		
		<div class=\"card-tools\">
                  <button type=\"button\" class=\"btn btn-tool\" data-card-widget=\"collapse\">
                    <i class=\"fas fa-minus\"></i>
                  </button>
                  <div class=\"btn-group\">
                    <button type=\"button\" class=\"btn btn-tool dropdown-toggle\" data-toggle=\"dropdown\">
                      <i class=\"fas fa-wrench\"></i>
                    </button>
                    <div class=\"dropdown-menu dropdown-menu-right\" role=\"menu\">
                      <a href=\"#\" class=\"dropdown-item\">Action</a>
                      <a href=\"#\" class=\"dropdown-item\">Another action</a>
                      <a href=\"#\" class=\"dropdown-item\">Something else here</a>
                      <a class=\"dropdown-divider\"></a>
                      <a href=\"#\" class=\"dropdown-item\">Separated link</a>
                    </div>
                  </div>
                  <button type=\"button\" class=\"btn btn-tool\" data-card-widget=\"remove\">
                    <i class=\"fas fa-times\"></i>
                  </button>
                </div>
			  </div>
			  <div class=\"card-body\">
			  <!-- Content Header (Page header) -->
			  <section class=\"content-header\">
			   
			  </section>
			  <!-- Main content -->
			  <section class=\"content\">
			  <?php if(isset(\$message)){   
				   echo '<div class=\"alert alert-warning\">  
					 <a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>  
					 '.\$message.'
				   </div> '; 
			  }  ?>
				<!-- Default box -->
				<div class=\"box\">	 
		<?php echo form_open(\$action);?>";
	foreach ($non_pk as $row) {
		if ($row["data_type"] == 'text')
		{
		$string .= "\n\t    <div class=\"form-group\">
				<?php 
					echo form_label('".label($row["column_name"])."');
					echo form_error('".$row["column_name"]."');
					echo form_textarea($".($row["column_name"]).");
				?>
			</div>";
		} else
		{
		$string .= "\n\t    <div class=\"form-group\">
				<?php 
					echo form_label('".label($row["column_name"])."');
					echo form_error('".$row["column_name"]."');
					echo form_input($".($row["column_name"]).");
				?>				
			</div>";
		}
	}
	$string .= "\n\t    <?php 
			echo form_input($".$pk."); ?>";
	$string .= "
	<div class=\"card-footer\">
                <div class=\"row\">
	";
	$string .= "\n\t<?php    	echo form_submit('submit', \$button , array('class'=>'btn btn-flat btn-primary'));";
	$string .= "\n\t        echo anchor('".$c_url."','Batal',array('class'=>'btn btn-flat btn-warning')); 
						?>";
	$string .= "\n\t<?php echo form_close();?>
	</div>
                <!-- /.row -->
              </div>	
	</div>
	 </div>
               
    </section>
	<!-- /.content -->

    ";

$hasil_view_form = createFile($string, $target."views/" . $c_url . "/" . $v_form_file);

?>