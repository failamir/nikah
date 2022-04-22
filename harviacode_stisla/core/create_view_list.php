<?php 

$string = "
<div class=\"card\">
<div class=\"card-header\">
<h4 class=\"card-title\"><?php //echo \$button ;?> ".ucfirst($table_name)."</h4>
</div>
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
    <!-- Content Header (Page header) -->
	<div class=\"card-body\">
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
        <div class=\"box-header\">
		 
        
			 <?php echo anchor(site_url('".$c_url."/create'),'<i class = \"fa fa-plus\"></i> Tambah', 'class=\"btn btn-flat btn-primary\"'); ?>
            
            <div class=\"box-tools float-right\">
                <form action=\"<?php echo site_url('$c_url/index'); ?>\" class=\"form-inline\" method=\"get\">
                    <div class=\"input-group\">
                        <input type=\"text\" class=\"form-control\" name=\"q\" value=\"<?php echo \$q; ?>\">
                        <span class=\"input-group-btn\">
                            <?php 
                                if (\$q <> '')
                                {
                                    ?>
                                    <a href=\"<?php echo site_url('$c_url'); ?>\" class=\"btn btn-flat btn-default\">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class=\"btn btn-flat btn-primary\" type=\"submit\"><i class=\"fa fa-search\"></i></button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class=\"table-responsive\">
        <div id=\"table-2_wrapper\" class=\"dataTables_wrapper container-fluid dt-bootstrap4 no-footer\">
        <div class=\"row\"><div class=\"col-sm-12 col-md-6\"><div class=\"dataTables_length\" id=\"table-2_length\"><label>Show <select name=\"table-2_length\" aria-controls=\"table-2\" class=\"form-control form-control-sm\"><option value=\"10\">10</option><option value=\"25\">25</option><option value=\"50\">50</option><option value=\"100\">100</option></select> entries</label></div></div><div class=\"col-sm-12 col-md-6\"><div id=\"table-2_filter\" class=\"dataTables_filter\"><label>Search:<input type=\"search\" class=\"form-control form-control-sm\" placeholder=\" aria-controls=\"table-2\"></label></div></div></div>
        <div class=\"row\">
        <div class=\"col-sm-12 \">
        <table class=\"table table-striped dataTable no-footer\" id=\"table-2\" style=\"margin-bottom: 10px;margin-top:10px\" role=\"grid\" aria-describedby=\"table-2_info\">
            <thead>
            <tr role=\"role\">
                <th class=\"text-center sorting_asc\" rowspan=\"1\" colspan=\"1\" aria-label=\"&nbsp;\" style=\"width: 46.4531px;\">No</th>";
foreach ($non_pk as $row) {
    $string .= "\n\t\t<th>" . label($row['column_name']) . "</th>";
}
$string .= "\n\t\t<th>Aksi</th>
            </thead>
            <tbody>";
$string .= "<?php
            foreach ($" . $c_url . "_data as \$$c_url)
            {
                ?>
                <tr role=\"row\" class=\"odd\">";

$string .= "\n\t\t\t<td width=\"80px\"><?php echo ++\$start ?></td>";
foreach ($non_pk as $row) {
    $string .= "\n\t\t\t<td><?php echo $" . $c_url ."->". $row['column_name'] . " ?></td>";
}


$string .= "\n\t\t\t<td style=\"text-align:center\" width=\"200px\">"
        . "\n\t\t\t\t<?php "
        . "\n\t\t\t\techo anchor(site_url('".$c_url."/read/'.$".$c_url."->".$pk."),'<i class=\"fa fa-eye\"></i>','class=\"btn btn-flat btn-info\"'); "
        . "\n\t\t\t\techo '  '; "
        . "\n\t\t\t\techo anchor(site_url('".$c_url."/update/'.$".$c_url."->".$pk."),'<i class=\"fa fa-edit\"></i>','class=\"btn btn-flat btn-warning\"'); "
        . "\n\t\t\t\techo '  '; "
        . "\n\t\t\t\techo anchor(site_url('".$c_url."/delete/'.$".$c_url."->".$pk."),'<i class=\"fa fa-trash\"></i>','class=\"btn btn-flat btn-danger\"','onclick=\"javasciprt: return confirm(\\'Anda Yakin ?\\')\"'); "
        . "\n\t\t\t\t?>"
        . "\n\t\t\t</td>";

$string .=  "\n\t\t</tr>
                <?php
            }
            ?>
        </table>
        </div>
        
        <div class=\"card-footer\">
                <div class=\"row\">
                <a href=\"#\" class=\"btn btn-flat btn-primary\">Total Record : <?php echo \$total_rows ?></a>";
if ($export_excel == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/excel'), '<i class=\"fa fa-file-excel-o\"></i> Excel', 'class=\"btn btn-flat btn-success\"'); ?>";
}
if ($export_word == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/word'), '<i class=\"fa fa-file-word-o\"></i> Word', 'class=\"btn btn-flat btn-primary\"'); ?>";
}
if ($export_pdf == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/pdf'), '<i class=\"fa fa-file-pdf-o\"></i> PDF', 'class=\"btn btn-flat btn-danger\"'); ?>";
}
$string .= "\n\t    </div>
            <div class=\"col-md-6 text-right\">
            <p>
                <?php echo \$pagination ?>
            </p>
                </div>
        </div>
        </div>
		</div>
		</div>
		</section>
   <!-- /.content -->
  
    ";


$hasil_view_list = createFile($string, $target."views/" . $c_url . "/" . $v_list_file);

?>