<?php
class M_grafik extends CI_Model{

	function get_data_stok(){
        $query = $this->db->query("SELECT merk,SUM(stok) AS stok FROM barang GROUP BY merk");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

}