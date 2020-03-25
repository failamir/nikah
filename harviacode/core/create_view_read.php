<?php 

$string = "

   <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class=\"content\">
	<?php if(isset(\$message)){   
		 echo '<div class=\"alert alert-warning\">  
		   <a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>  
		   '.\$message.'
		 </div> '; 
    }  ?>
      <!-- Default box -->
      
        <div class=\"card-header\">
		 <h5 class=\"box-title\">Detail ".ucfirst($table_name)."</h5>
    </div>
    <div class=\"card-body\">
        <table class=\"table no-border\">";
foreach ($non_pk as $row) {
    $string .= "\n\t    <tr><td>".label($row["column_name"])."</td><td><?php echo $".$row["column_name"]."; ?></td></tr>";
}
$string .= "\n\t    <tr><td></td><td><a href=\"<?php echo site_url('".$c_url."') ?>\" class=\"btn btn-flat btn-warning no-print\">Kembali</a></td></tr>";
$string .= "\n\t</table>
        </div>
	 </div>
               
    </section>
	<!-- /.content -->";



$hasil_view_read = createFile($string, $target."views/" . $c_url . "/" . $v_read_file);

?>