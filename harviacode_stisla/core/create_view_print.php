<?php 
$string .= "
<script type=\"text/javascript\"> 
  window.addEventListener(\"load\", window.print());
</script>

";

$hasil_view_print = createFile($string, $target."views/" . $c_url . "/" . $v_print_file);
?>
