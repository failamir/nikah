<?php 

$string = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
 * Pagination Config Bootstrap 3 CSS Style
 */

\$config['query_string_segment'] = 'start';

\$config['full_tag_open'] = '<nav><ul class=\"pagination pagination-sm m-0 float-right\" style=\"margin-top:10px\">';
\$config['full_tag_close'] = '</ul></nav>';

\$config['first_link'] = 'First';
\$config['first_tag_open'] = '<li class=\"btn btn-warning\">';
\$config['first_tag_close'] = '</li>';

\$config['last_link'] = 'Last';
\$config['last_tag_open'] = '<li class=\"btn btn-danger\">';
\$config['last_tag_close'] = '</li>';

\$config['next_link'] = 'Next';
\$config['next_tag_open'] = '<li class=\"btn btn-warning\">';
\$config['next_tag_close'] = '</li>';

\$config['prev_link'] = 'Prev';
\$config['prev_tag_open'] = '<li class=\"btn btn-warning\">';
\$config['prev_tag_close'] = '</li>';

\$config['cur_tag_open'] = '<li class=\"btn active\"><a nav-link>';
\$config['cur_tag_close'] = '</a></li>';

\$config['num_tag_open'] = '<li class=\"btn btn-warning\">';
\$config['num_tag_close'] = '</li>';


/* End of file pagination.php */
/* Location: ./application/config/pagination.php */
";



$hasil_config_pagination = createFile($string, $target."config/pagination.php");

?>