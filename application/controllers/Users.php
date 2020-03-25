<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
		$this->load->database();
		$this->load->model(array('Users_model','Identitas_web_model'));
		$this->load->model('Log_aktivitas_model');
        $this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url', 'html'));        
				$this->load->library('datatables');
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('Anda tidak punya akses di halaman ini');
		}
		else
		{
			$this->data['user'] = $this->ion_auth->user()->row();
            $this->data['usr'] = $this->ion_auth->user()->row();
			$this->data['message'] = $this->session->flashdata('message');
			$this->data['title'] = 'users';
			$this->get_Meta();
			
			$this->data['_view']='users/users_list';
			$this->_render_page('layouts/main',$this->data);
		}
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Users_model->json();
    }

    public function printing($id) 
    {
        if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('Anda tidak punya akses di halaman ini');
		}
		else
		{
			$this->data['user'] = $this->ion_auth->user()->row();
            $this->data['usr'] = $this->ion_auth->user()->row();
			
			$row = $this->Users_model->get_by_id($id);
			if ($row) {
				$this->data['id'] = $this->form_validation->set_value('id',$row->id);
				$this->data['ip_address'] = $this->form_validation->set_value('ip_address',$row->ip_address);
				$this->data['username'] = $this->form_validation->set_value('username',$row->username);
				$this->data['password'] = $this->form_validation->set_value('password',$row->password);
				$this->data['salt'] = $this->form_validation->set_value('salt',$row->salt);
				$this->data['email'] = $this->form_validation->set_value('email',$row->email);
				$this->data['activation_code'] = $this->form_validation->set_value('activation_code',$row->activation_code);
				$this->data['forgotten_password_code'] = $this->form_validation->set_value('forgotten_password_code',$row->forgotten_password_code);
				$this->data['forgotten_password_time'] = $this->form_validation->set_value('forgotten_password_time',$row->forgotten_password_time);
				$this->data['remember_code'] = $this->form_validation->set_value('remember_code',$row->remember_code);
				$this->data['created_on'] = $this->form_validation->set_value('created_on',$row->created_on);
				$this->data['last_login'] = $this->form_validation->set_value('last_login',$row->last_login);
				$this->data['active'] = $this->form_validation->set_value('active',$row->active);
				$this->data['first_name'] = $this->form_validation->set_value('first_name',$row->first_name);
				$this->data['last_name'] = $this->form_validation->set_value('last_name',$row->last_name);
				$this->data['company'] = $this->form_validation->set_value('company',$row->company);
				$this->data['phone'] = $this->form_validation->set_value('phone',$row->phone);
				$this->data['foto'] = $this->form_validation->set_value('foto',$row->foto);
	    
				$this->data['title'] = 'users';
				$this->get_Meta();
				$this->data['_view'] = 'users/users_print';
				$this->_render_page('layouts/print',$this->data);
			} else {
				$this->data['message'] = 'Data tidak ditemukan';
				redirect(site_url('users'));
			}
		}
    }

    public function read($id) 
    {
        if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('Anda tidak punya akses di halaman ini');
		}
		else
		{
			$this->data['user'] = $this->ion_auth->user()->row();
            $this->data['usr'] = $this->ion_auth->user()->row();
			
			$row = $this->Users_model->get_by_id($id);
			if ($row) {
				$this->data['id'] = $this->form_validation->set_value('id',$row->id);
				$this->data['ip_address'] = $this->form_validation->set_value('ip_address',$row->ip_address);
				$this->data['username'] = $this->form_validation->set_value('username',$row->username);
				$this->data['password'] = $this->form_validation->set_value('password',$row->password);
				$this->data['salt'] = $this->form_validation->set_value('salt',$row->salt);
				$this->data['email'] = $this->form_validation->set_value('email',$row->email);
				$this->data['activation_code'] = $this->form_validation->set_value('activation_code',$row->activation_code);
				$this->data['forgotten_password_code'] = $this->form_validation->set_value('forgotten_password_code',$row->forgotten_password_code);
				$this->data['forgotten_password_time'] = $this->form_validation->set_value('forgotten_password_time',$row->forgotten_password_time);
				$this->data['remember_code'] = $this->form_validation->set_value('remember_code',$row->remember_code);
				$this->data['created_on'] = $this->form_validation->set_value('created_on',$row->created_on);
				$this->data['last_login'] = $this->form_validation->set_value('last_login',$row->last_login);
				$this->data['active'] = $this->form_validation->set_value('active',$row->active);
				$this->data['first_name'] = $this->form_validation->set_value('first_name',$row->first_name);
				$this->data['last_name'] = $this->form_validation->set_value('last_name',$row->last_name);
				$this->data['company'] = $this->form_validation->set_value('company',$row->company);
				$this->data['phone'] = $this->form_validation->set_value('phone',$row->phone);
				$this->data['foto'] = $this->form_validation->set_value('foto',$row->foto);
	    
				$this->data['title'] = 'users';
				$this->get_Meta();
				$this->data['_view'] = 'users/users_read';
				$this->_render_page('layouts/main',$this->data);
			} else {
				$this->data['message'] = 'Data tidak ditemukan';
				redirect(site_url('users'));
			}
		}
    }

    public function create() 
    {
        if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('Anda tidak punya akses di halaman ini');
		}
		else
		{
			$this->data['user'] = $this->ion_auth->user()->row();
            $this->data['usr'] = $this->ion_auth->user()->row();
			
			$this->data['button'] = 'Tambah';
			$this->data['action'] = site_url('users/create_action');
		    $this->data['id'] = array(
				'name'			=> 'id',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('id'),
				'class'			=> 'form-control',
			);
		    $this->data['ip_address'] = array(
				'name'			=> 'ip_address',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('ip_address'),
				'class'			=> 'form-control',
			);
		    $this->data['username'] = array(
				'name'			=> 'username',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('username'),
				'class'			=> 'form-control',
			);
		    $this->data['password'] = array(
				'name'			=> 'password',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('password'),
				'class'			=> 'form-control',
			);
		    $this->data['salt'] = array(
				'name'			=> 'salt',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('salt'),
				'class'			=> 'form-control',
			);
		    $this->data['email'] = array(
				'name'			=> 'email',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('email'),
				'class'			=> 'form-control',
			);
		    $this->data['activation_code'] = array(
				'name'			=> 'activation_code',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('activation_code'),
				'class'			=> 'form-control',
			);
		    $this->data['forgotten_password_code'] = array(
				'name'			=> 'forgotten_password_code',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('forgotten_password_code'),
				'class'			=> 'form-control',
			);
		    $this->data['forgotten_password_time'] = array(
				'name'			=> 'forgotten_password_time',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('forgotten_password_time'),
				'class'			=> 'form-control',
			);
		    $this->data['remember_code'] = array(
				'name'			=> 'remember_code',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('remember_code'),
				'class'			=> 'form-control',
			);
		    $this->data['created_on'] = array(
				'name'			=> 'created_on',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('created_on'),
				'class'			=> 'form-control',
			);
		    $this->data['last_login'] = array(
				'name'			=> 'last_login',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('last_login'),
				'class'			=> 'form-control',
			);
		    $this->data['active'] = array(
				'name'			=> 'active',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('active'),
				'class'			=> 'form-control',
			);
		    $this->data['first_name'] = array(
				'name'			=> 'first_name',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('first_name'),
				'class'			=> 'form-control',
			);
		    $this->data['last_name'] = array(
				'name'			=> 'last_name',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('last_name'),
				'class'			=> 'form-control',
			);
		    $this->data['company'] = array(
				'name'			=> 'company',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('company'),
				'class'			=> 'form-control',
			);
		    $this->data['phone'] = array(
				'name'			=> 'phone',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('phone'),
				'class'			=> 'form-control',
			);
		    $this->data['foto'] = array(
				'name'			=> 'foto',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('foto'),
				'class'			=> 'form-control',
			);
	
			$this->data['title'] = 'users';
			$this->get_Meta();
			$this->data['_view'] = 'users/users_form';
			$this->_render_page('layouts/main',$this->data);
		}
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'ip_address' 			=> $this->input->post('ip_address',TRUE),
		'username' 			=> $this->input->post('username',TRUE),
		'password' 			=> $this->input->post('password',TRUE),
		'salt' 			=> $this->input->post('salt',TRUE),
		'email' 			=> $this->input->post('email',TRUE),
		'activation_code' 			=> $this->input->post('activation_code',TRUE),
		'forgotten_password_code' 			=> $this->input->post('forgotten_password_code',TRUE),
		'forgotten_password_time' 			=> $this->input->post('forgotten_password_time',TRUE),
		'remember_code' 			=> $this->input->post('remember_code',TRUE),
		'created_on' 			=> $this->input->post('created_on',TRUE),
		'last_login' 			=> $this->input->post('last_login',TRUE),
		'active' 			=> $this->input->post('active',TRUE),
		'first_name' 			=> $this->input->post('first_name',TRUE),
		'last_name' 			=> $this->input->post('last_name',TRUE),
		'company' 			=> $this->input->post('company',TRUE),
		'phone' 			=> $this->input->post('phone',TRUE),
		'foto' 			=> $this->input->post('foto',TRUE),
	    );

			$this->Users_model->insert($data);
			$temp = $this->ion_auth->user()->row();
			$id = $temp->id;
			$nama = $temp->first_name;
			$aktivitas = $nama ." telah menambah data pada users";
			$waktu = date('d-m-Y H:i:s');
			$data_log = array(
				'id_user' => $id,
				'aktivitas' => $aktivitas,
				'time' => $waktu, 
			);
			$this->Log_aktivitas_model->insert($data_log);
            $this->session->set_flashdata('message', 'Data berhasil ditambahkan');
            redirect(site_url('users'),'refresh');
        }
    }
    
    public function update($id) 
    {
        if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('Anda tidak punya akses di halaman ini');
		}
		else
		{
			$this->data['user'] = $this->ion_auth->user()->row();
            $this->data['usr'] = $this->ion_auth->user()->row();
			
			$row = $this->Users_model->get_by_id($id);

			if ($row) {
				$this->data['button']		= 'Ubah';
				$this->data['action']		= site_url('users/update_action');
			    $this->data['id'] = array(
					'name'			=> 'id',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('id', $row->id),
					'class'			=> 'form-control',
				);
			    $this->data['ip_address'] = array(
					'name'			=> 'ip_address',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('ip_address', $row->ip_address),
					'class'			=> 'form-control',
				);
			    $this->data['username'] = array(
					'name'			=> 'username',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('username', $row->username),
					'class'			=> 'form-control',
				);
			    $this->data['password'] = array(
					'name'			=> 'password',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('password', $row->password),
					'class'			=> 'form-control',
				);
			    $this->data['salt'] = array(
					'name'			=> 'salt',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('salt', $row->salt),
					'class'			=> 'form-control',
				);
			    $this->data['email'] = array(
					'name'			=> 'email',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('email', $row->email),
					'class'			=> 'form-control',
				);
			    $this->data['activation_code'] = array(
					'name'			=> 'activation_code',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('activation_code', $row->activation_code),
					'class'			=> 'form-control',
				);
			    $this->data['forgotten_password_code'] = array(
					'name'			=> 'forgotten_password_code',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('forgotten_password_code', $row->forgotten_password_code),
					'class'			=> 'form-control',
				);
			    $this->data['forgotten_password_time'] = array(
					'name'			=> 'forgotten_password_time',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('forgotten_password_time', $row->forgotten_password_time),
					'class'			=> 'form-control',
				);
			    $this->data['remember_code'] = array(
					'name'			=> 'remember_code',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('remember_code', $row->remember_code),
					'class'			=> 'form-control',
				);
			    $this->data['created_on'] = array(
					'name'			=> 'created_on',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('created_on', $row->created_on),
					'class'			=> 'form-control',
				);
			    $this->data['last_login'] = array(
					'name'			=> 'last_login',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('last_login', $row->last_login),
					'class'			=> 'form-control',
				);
			    $this->data['active'] = array(
					'name'			=> 'active',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('active', $row->active),
					'class'			=> 'form-control',
				);
			    $this->data['first_name'] = array(
					'name'			=> 'first_name',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('first_name', $row->first_name),
					'class'			=> 'form-control',
				);
			    $this->data['last_name'] = array(
					'name'			=> 'last_name',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('last_name', $row->last_name),
					'class'			=> 'form-control',
				);
			    $this->data['company'] = array(
					'name'			=> 'company',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('company', $row->company),
					'class'			=> 'form-control',
				);
			    $this->data['phone'] = array(
					'name'			=> 'phone',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('phone', $row->phone),
					'class'			=> 'form-control',
				);
			    $this->data['foto'] = array(
					'name'			=> 'foto',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('foto', $row->foto),
					'class'			=> 'form-control',
				);
	   
				$this->data['title'] = 'users';
				$this->get_Meta();
				$this->data['_view'] = 'users/users_form';
				$this->_render_page('layouts/main',$this->data);
			} else {
				$this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('users'),'refresh');
			}
		}
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
			'ip_address' 					=> $this->input->post('ip_address',TRUE),
			'username' 					=> $this->input->post('username',TRUE),
			'password' 					=> $this->input->post('password',TRUE),
			'salt' 					=> $this->input->post('salt',TRUE),
			'email' 					=> $this->input->post('email',TRUE),
			'activation_code' 					=> $this->input->post('activation_code',TRUE),
			'forgotten_password_code' 					=> $this->input->post('forgotten_password_code',TRUE),
			'forgotten_password_time' 					=> $this->input->post('forgotten_password_time',TRUE),
			'remember_code' 					=> $this->input->post('remember_code',TRUE),
			'created_on' 					=> $this->input->post('created_on',TRUE),
			'last_login' 					=> $this->input->post('last_login',TRUE),
			'active' 					=> $this->input->post('active',TRUE),
			'first_name' 					=> $this->input->post('first_name',TRUE),
			'last_name' 					=> $this->input->post('last_name',TRUE),
			'company' 					=> $this->input->post('company',TRUE),
			'phone' 					=> $this->input->post('phone',TRUE),
			'foto' 					=> $this->input->post('foto',TRUE),
	    );

			$this->Users_model->update($this->input->post('id', TRUE), $data);
			$temp = $this->ion_auth->user()->row();
			$id = $temp->id;
			$nama = $temp->first_name;
			$aktivitas = $nama . " telah mengubah data pada users";
			$waktu = date('d-m-Y H:i:s');
			$data_log = array(
				'id_user' => $id,
				'aktivitas' => $aktivitas,
				'time' => $waktu, 
			);
			$this->Log_aktivitas_model->insert($data_log);
            $this->session->set_flashdata('message', 'Data berhasil diubah');
            redirect(site_url('users'),'refresh');
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Users_model->get_by_id($id);

        if ($row) {
			$this->Users_model->delete($id);
			$temp = $this->ion_auth->user()->row();
			$id = $temp->id;
			$nama = $temp->first_name;
			$waktu = date('d-m-Y H:i:s');
			$aktivitas = $nama ." telah menghapus data pada users";
			$data_log = array(
				'id_user' => $id,
				'aktivitas' => $aktivitas,
				'time' => $waktu, 
			);
			$this->Log_aktivitas_model->insert($data_log);
            $this->session->set_flashdata('message', 'Data berhasil dihapus');
            redirect(site_url('users'),'refresh');
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('users'),'refresh');
        }
    }
	
	public function get_Meta(){
		
		$rows = $this->Identitas_web_model->get_all();
		foreach ($rows as $row) {			
			$this->data['web_name'] 		= $this->form_validation->set_value('nama_web',$row->nama_web);
			$this->data['meta_description']= $this->form_validation->set_value('meta_deskripsi',$row->meta_deskripsi);
			$this->data['meta_keywords'] 	= $this->form_validation->set_value('meta_keyword',$row->meta_keyword);
			$this->data['copyrights'] 		= $this->form_validation->set_value('copyright',$row->copyright);
			$this->data['logos'] 		= $this->form_validation->set_value('logo',$row->logo);
	    }
	}
	
	public function _render_page($view, $data = NULL, $returnhtml = FALSE)//I think this makes more sense
	{

		$this->viewdata = (empty($data)) ? $this->data : $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		// This will return html on 3rd argument being true
		if ($returnhtml)
		{
			return $view_html;
		}
	}
	
    public function _rules() 
    {
	$this->form_validation->set_rules('ip_address', 'ip address', 'trim|required');
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');
	$this->form_validation->set_rules('salt', 'salt', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('activation_code', 'activation code', 'trim|required');
	$this->form_validation->set_rules('forgotten_password_code', 'forgotten password code', 'trim|required');
	$this->form_validation->set_rules('forgotten_password_time', 'forgotten password time', 'trim|required');
	$this->form_validation->set_rules('remember_code', 'remember code', 'trim|required');
	$this->form_validation->set_rules('created_on', 'created on', 'trim|required');
	$this->form_validation->set_rules('last_login', 'last login', 'trim|required');
	$this->form_validation->set_rules('active', 'active', 'trim|required');
	$this->form_validation->set_rules('first_name', 'first name', 'trim|required');
	$this->form_validation->set_rules('last_name', 'last name', 'trim|required');
	$this->form_validation->set_rules('company', 'company', 'trim|required');
	$this->form_validation->set_rules('phone', 'phone', 'trim|required');
	$this->form_validation->set_rules('foto', 'foto', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
		$temp = $this->ion_auth->user()->row();
			$id = $temp->id;
			$nama = $temp->first_name;
			$waktu = date('d-m-Y H:i:s');
			$aktivitas = $nama ." telah mengunduh data pada  format excel";
			$data_log = array(
				'id_user' => $id,
				'aktivitas' => $aktivitas,
				'time' => $waktu, 
			);
			$this->Log_aktivitas_model->insert($data_log);
        $this->load->helper('exportexcel');
        $namaFile = "users.xls";
        $judul = "users";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Ip Address");
	xlsWriteLabel($tablehead, $kolomhead++, "Username");
	xlsWriteLabel($tablehead, $kolomhead++, "Password");
	xlsWriteLabel($tablehead, $kolomhead++, "Salt");
	xlsWriteLabel($tablehead, $kolomhead++, "Email");
	xlsWriteLabel($tablehead, $kolomhead++, "Activation Code");
	xlsWriteLabel($tablehead, $kolomhead++, "Forgotten Password Code");
	xlsWriteLabel($tablehead, $kolomhead++, "Forgotten Password Time");
	xlsWriteLabel($tablehead, $kolomhead++, "Remember Code");
	xlsWriteLabel($tablehead, $kolomhead++, "Created On");
	xlsWriteLabel($tablehead, $kolomhead++, "Last Login");
	xlsWriteLabel($tablehead, $kolomhead++, "Active");
	xlsWriteLabel($tablehead, $kolomhead++, "First Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Last Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Company");
	xlsWriteLabel($tablehead, $kolomhead++, "Phone");
	xlsWriteLabel($tablehead, $kolomhead++, "Foto");

	foreach ($this->Users_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ip_address);
	    xlsWriteLabel($tablebody, $kolombody++, $data->username);
	    xlsWriteLabel($tablebody, $kolombody++, $data->password);
	    xlsWriteLabel($tablebody, $kolombody++, $data->salt);
	    xlsWriteLabel($tablebody, $kolombody++, $data->email);
	    xlsWriteLabel($tablebody, $kolombody++, $data->activation_code);
	    xlsWriteLabel($tablebody, $kolombody++, $data->forgotten_password_code);
	    xlsWriteNumber($tablebody, $kolombody++, $data->forgotten_password_time);
	    xlsWriteLabel($tablebody, $kolombody++, $data->remember_code);
	    xlsWriteNumber($tablebody, $kolombody++, $data->created_on);
	    xlsWriteNumber($tablebody, $kolombody++, $data->last_login);
	    xlsWriteLabel($tablebody, $kolombody++, $data->active);
	    xlsWriteLabel($tablebody, $kolombody++, $data->first_name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->last_name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->company);
	    xlsWriteLabel($tablebody, $kolombody++, $data->phone);
	    xlsWriteLabel($tablebody, $kolombody++, $data->foto);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
		$temp = $this->ion_auth->user()->row();
			$id = $temp->id;
			$nama = $temp->first_name;
		$waktu = date('d-m-Y H:i:s');
		$aktivitas = $nama . " telah mengunduh data pada  format word";
		$data_log = array(
			'id_user' => $id,
			'aktivitas' => $aktivitas,
			'time' => $waktu, 
		);
		$this->Log_aktivitas_model->insert($data_log);
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=users.doc");

        $data = array(
            'users_data' => $this->Users_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('users/users_doc',$data);
    }

    function pdf()
    {
		$temp = $this->ion_auth->user()->row();
			$id = $temp->id;
			$nama = $temp->first_name;
		$waktu = date('d-m-Y H:i:s');
		$aktivitas = $nama ." telah mengunduh data pada  format pdf";
		$data_log = array(
			'id_user' => $id,
			'aktivitas' => $aktivitas,
			'time' => $waktu, 
		);
		$this->Log_aktivitas_model->insert($data_log);

        $data = array(
            'users_data' => $this->Users_model->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
        $html = $this->load->view('users/users_pdf', $data, true);
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        $pdf->WriteHTML($html);
        $pdf->Output('users.pdf', 'D'); 
    }

}

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */
