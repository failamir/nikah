<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_groups extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
		$this->load->database();
		$this->load->model(array('Users_groups_model','Identitas_web_model'));
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
			$this->data['title'] = 'users_groups';
			$this->get_Meta();
			
			$this->data['_view']='users_groups/users_groups_list';
			$this->_render_page('layouts/main',$this->data);
		}
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Users_groups_model->json();
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
			
			$row = $this->Users_groups_model->get_by_id($id);
			if ($row) {
				$this->data['id'] = $this->form_validation->set_value('id',$row->id);
				$this->data['user_id'] = $this->form_validation->set_value('user_id',$row->user_id);
				$this->data['group_id'] = $this->form_validation->set_value('group_id',$row->group_id);
	    
				$this->data['title'] = 'users_groups';
				$this->get_Meta();
				$this->data['_view'] = 'users_groups/users_groups_print';
				$this->_render_page('layouts/print',$this->data);
			} else {
				$this->data['message'] = 'Data tidak ditemukan';
				redirect(site_url('users_groups'));
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
			
			$row = $this->Users_groups_model->get_by_id($id);
			if ($row) {
				$this->data['id'] = $this->form_validation->set_value('id',$row->id);
				$this->data['user_id'] = $this->form_validation->set_value('user_id',$row->user_id);
				$this->data['group_id'] = $this->form_validation->set_value('group_id',$row->group_id);
	    
				$this->data['title'] = 'users_groups';
				$this->get_Meta();
				$this->data['_view'] = 'users_groups/users_groups_read';
				$this->_render_page('layouts/main',$this->data);
			} else {
				$this->data['message'] = 'Data tidak ditemukan';
				redirect(site_url('users_groups'));
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
			$this->data['action'] = site_url('users_groups/create_action');
		    $this->data['id'] = array(
				'name'			=> 'id',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('id'),
				'class'			=> 'form-control',
			);
		    $this->data['user_id'] = array(
				'name'			=> 'user_id',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('user_id'),
				'class'			=> 'form-control',
			);
		    $this->data['group_id'] = array(
				'name'			=> 'group_id',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('group_id'),
				'class'			=> 'form-control',
			);
	
			$this->data['title'] = 'users_groups';
			$this->get_Meta();
			$this->data['_view'] = 'users_groups/users_groups_form';
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
		'user_id' 			=> $this->input->post('user_id',TRUE),
		'group_id' 			=> $this->input->post('group_id',TRUE),
	    );

			$this->Users_groups_model->insert($data);
			$temp = $this->ion_auth->user()->row();
			$id = $temp->id;
			$nama = $temp->first_name;
			$aktivitas = $nama ." telah menambah data pada users_groups";
			$waktu = date('d-m-Y H:i:s');
			$data_log = array(
				'id_user' => $id,
				'aktivitas' => $aktivitas,
				'time' => $waktu, 
			);
			$this->Log_aktivitas_model->insert($data_log);
            $this->session->set_flashdata('message', 'Data berhasil ditambahkan');
            redirect(site_url('users_groups'),'refresh');
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
			
			$row = $this->Users_groups_model->get_by_id($id);

			if ($row) {
				$this->data['button']		= 'Ubah';
				$this->data['action']		= site_url('users_groups/update_action');
			    $this->data['id'] = array(
					'name'			=> 'id',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('id', $row->id),
					'class'			=> 'form-control',
				);
			    $this->data['user_id'] = array(
					'name'			=> 'user_id',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('user_id', $row->user_id),
					'class'			=> 'form-control',
				);
			    $this->data['group_id'] = array(
					'name'			=> 'group_id',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('group_id', $row->group_id),
					'class'			=> 'form-control',
				);
	   
				$this->data['title'] = 'users_groups';
				$this->get_Meta();
				$this->data['_view'] = 'users_groups/users_groups_form';
				$this->_render_page('layouts/main',$this->data);
			} else {
				$this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('users_groups'),'refresh');
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
			'user_id' 					=> $this->input->post('user_id',TRUE),
			'group_id' 					=> $this->input->post('group_id',TRUE),
	    );

			$this->Users_groups_model->update($this->input->post('id', TRUE), $data);
			$temp = $this->ion_auth->user()->row();
			$id = $temp->id;
			$nama = $temp->first_name;
			$aktivitas = $nama . " telah mengubah data pada users_groups";
			$waktu = date('d-m-Y H:i:s');
			$data_log = array(
				'id_user' => $id,
				'aktivitas' => $aktivitas,
				'time' => $waktu, 
			);
			$this->Log_aktivitas_model->insert($data_log);
            $this->session->set_flashdata('message', 'Data berhasil diubah');
            redirect(site_url('users_groups'),'refresh');
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Users_groups_model->get_by_id($id);

        if ($row) {
			$this->Users_groups_model->delete($id);
			$temp = $this->ion_auth->user()->row();
			$id = $temp->id;
			$nama = $temp->first_name;
			$waktu = date('d-m-Y H:i:s');
			$aktivitas = $nama ." telah menghapus data pada users_groups";
			$data_log = array(
				'id_user' => $id,
				'aktivitas' => $aktivitas,
				'time' => $waktu, 
			);
			$this->Log_aktivitas_model->insert($data_log);
            $this->session->set_flashdata('message', 'Data berhasil dihapus');
            redirect(site_url('users_groups'),'refresh');
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('users_groups'),'refresh');
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
	$this->form_validation->set_rules('user_id', 'user id', 'trim|required');
	$this->form_validation->set_rules('group_id', 'group id', 'trim|required');

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
        $namaFile = "users_groups.xls";
        $judul = "users_groups";
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
	xlsWriteLabel($tablehead, $kolomhead++, "User Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Group Id");

	foreach ($this->Users_groups_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->user_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->group_id);

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
        header("Content-Disposition: attachment;Filename=users_groups.doc");

        $data = array(
            'users_groups_data' => $this->Users_groups_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('users_groups/users_groups_doc',$data);
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
            'users_groups_data' => $this->Users_groups_model->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
        $html = $this->load->view('users_groups/users_groups_pdf', $data, true);
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        $pdf->WriteHTML($html);
        $pdf->Output('users_groups.pdf', 'D'); 
    }

}

/* End of file Users_groups.php */
/* Location: ./application/controllers/Users_groups.php */
