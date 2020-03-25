<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_model extends CI_Model
{

    public $table = 'users';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id,ip_address,username,password,salt,email,activation_code,forgotten_password_code,forgotten_password_time,remember_code,created_on,last_login,active,first_name,last_name,company,phone,foto');
        $this->datatables->from('users');
        //add this line for join
        //$this->datatables->join('table2', 'users.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('users/printing/$1'),'<i class = "fa fa-print"></i>', array('class'=>'btn btn-flat btn-success'))." ".anchor(site_url('users/read/$1'),'<i class = "fa fa-eye"></i>', array('class'=>'btn btn-flat btn-info'))." ".anchor(site_url('users/update/$1'),'<i class = "fa fa-edit"></i>', array('class'=>'btn btn-flat btn-warning'))." ".anchor(site_url('users/delete/$1'),'<i class = "fa fa-trash"></i>', array('class'=>'btn btn-flat btn-danger','onclick'=>'javasciprt: return confirm(\'Are You Sure ?\')')), 'id');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('ip_address', $q);
	$this->db->or_like('username', $q);
	$this->db->or_like('password', $q);
	$this->db->or_like('salt', $q);
	$this->db->or_like('email', $q);
	$this->db->or_like('activation_code', $q);
	$this->db->or_like('forgotten_password_code', $q);
	$this->db->or_like('forgotten_password_time', $q);
	$this->db->or_like('remember_code', $q);
	$this->db->or_like('created_on', $q);
	$this->db->or_like('last_login', $q);
	$this->db->or_like('active', $q);
	$this->db->or_like('first_name', $q);
	$this->db->or_like('last_name', $q);
	$this->db->or_like('company', $q);
	$this->db->or_like('phone', $q);
	$this->db->or_like('foto', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('ip_address', $q);
	$this->db->or_like('username', $q);
	$this->db->or_like('password', $q);
	$this->db->or_like('salt', $q);
	$this->db->or_like('email', $q);
	$this->db->or_like('activation_code', $q);
	$this->db->or_like('forgotten_password_code', $q);
	$this->db->or_like('forgotten_password_time', $q);
	$this->db->or_like('remember_code', $q);
	$this->db->or_like('created_on', $q);
	$this->db->or_like('last_login', $q);
	$this->db->or_like('active', $q);
	$this->db->or_like('first_name', $q);
	$this->db->or_like('last_name', $q);
	$this->db->or_like('company', $q);
	$this->db->or_like('phone', $q);
	$this->db->or_like('foto', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */
