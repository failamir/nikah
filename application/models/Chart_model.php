<?php
class Chart_model extends CI_Model{

  //get data from database
  function get_data(){
      $this->db->select('year,purchase,sale,profit');
      $result = $this->db->get('account');
      return $result;
  }

}
