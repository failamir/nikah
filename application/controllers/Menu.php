<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
		$this->load->database();
		$this->load->model(array('Menu_model','Identitas_web_model'));
		$this->load->model('Log_aktivitas_model');
        $this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url', 'html'));        
				$this->load->library('datatables');
    }

    public function index()
    {
		//fungsi untuk index (default dari setiap controller)
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
			$this->data['title'] = 'menu';
			$this->get_Meta();
			
			$this->data['_view']='menu/menu_list';
			$this->_render_page('layouts/main',$this->data);
		}
    } 
	
	//fungsi untuk mendapatkan result dari model menggunakan api json
    public function json() {
        header('Content-Type: application/json');
        echo $this->Menu_model->json();
    }

    public function printing($id) 
    {
		//fungsi untuk printing halaman berisi data
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
			
			$row = $this->Menu_model->get_by_id($id);
			if ($row) {
				$this->data['id'] = $this->form_validation->set_value('id',$row->id);
				$this->data['parent_menu'] = $this->form_validation->set_value('parent_menu',$row->parent_menu);
				$this->data['nama_menu'] = $this->form_validation->set_value('nama_menu',$row->nama_menu);
				$this->data['controller_link'] = $this->form_validation->set_value('controller_link',$row->controller_link);
				$this->data['icon'] = $this->form_validation->set_value('icon',$row->icon);
				$this->data['slug'] = $this->form_validation->set_value('slug',$row->slug);
				$this->data['urut_menu'] = $this->form_validation->set_value('urut_menu',$row->urut_menu);
				$this->data['menu_grup_user'] = $this->form_validation->set_value('menu_grup_user',$row->menu_grup_user);
				$this->data['is_active'] = $this->form_validation->set_value('is_active',$row->is_active);
	    
				$this->data['title'] = 'menu';
				$this->get_Meta();
				$this->data['_view'] = 'menu/menu_print';
				$this->_render_page('layouts/print',$this->data);
			} else {
				$this->data['message'] = 'Data tidak ditemukan';
				redirect(site_url('menu'));
			}
		}
    }

    public function read($id) 
    {
		//fungsi untuk melihat data
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
			
			$row = $this->Menu_model->get_by_id($id);
			if ($row) {
				$this->data['id'] = $this->form_validation->set_value('id',$row->id);
				$this->data['parent_menu'] = $this->form_validation->set_value('parent_menu',$row->parent_menu);
				$this->data['nama_menu'] = $this->form_validation->set_value('nama_menu',$row->nama_menu);
				$this->data['controller_link'] = $this->form_validation->set_value('controller_link',$row->controller_link);
				$this->data['icon'] = $this->form_validation->set_value('icon',$row->icon);
				$this->data['slug'] = $this->form_validation->set_value('slug',$row->slug);
				$this->data['urut_menu'] = $this->form_validation->set_value('urut_menu',$row->urut_menu);
				$this->data['menu_grup_user'] = $this->form_validation->set_value('menu_grup_user',$row->menu_grup_user);
				$this->data['is_active'] = $this->form_validation->set_value('is_active',$row->is_active);
	    
				$this->data['title'] = 'menu';
				$this->get_Meta();
				$this->data['_view'] = 'menu/menu_read';
				$this->_render_page('layouts/main',$this->data);
			} else {
				$this->data['message'] = 'Data tidak ditemukan';
				redirect(site_url('menu'));
			}
		}
    }

    public function create() 
    {
		//fungsi untuk menuju halaman create (tambah data)
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
			$this->data['action'] = site_url('menu/create_action');
		    $this->data['id'] = array(
				'name'			=> 'id',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('id'),
				'class'			=> 'form-control',
			);
		    $this->data['parent_menu'] = array(
				'name'			=> 'parent_menu',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('parent_menu'),
				'class'			=> 'form-control',
			);
		    $this->data['nama_menu'] = array(
				'name'			=> 'nama_menu',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('nama_menu'),
				'class'			=> 'form-control',
			);
		    $this->data['controller_link'] = array(
				'name'			=> 'controller_link',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('controller_link'),
				'class'			=> 'form-control',
			);
		    $this->data['icon'] = array(
				'name'			=> 'icon',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('icon'),
				'class'			=> 'form-control',
			);
		    $this->data['slug'] = array(
				'name'			=> 'slug',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('slug'),
				'class'			=> 'form-control',
			);
		    $this->data['urut_menu'] = array(
				'name'			=> 'urut_menu',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('urut_menu'),
				'class'			=> 'form-control',
			);
		    $this->data['menu_grup_user'] = array(
				'name'			=> 'menu_grup_user',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('menu_grup_user'),
				'class'			=> 'form-control',
			);
		    $this->data['is_active'] = array(
				'name'			=> 'is_active',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('is_active'),
				'class'			=> 'form-control',
			);
	
			$this->data['title'] = 'menu';
			$this->get_Meta();
			$this->data['_view'] = 'menu/menu_form';
			$this->_render_page('layouts/main',$this->data);
		}
    }
    
    public function create_action() 
    {
		//fungsi untuk aksi menambah data ke database
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'parent_menu' 			=> $this->input->post('parent_menu',TRUE),
		'nama_menu' 			=> $this->input->post('nama_menu',TRUE),
		'controller_link' 			=> $this->input->post('controller_link',TRUE),
		'icon' 			=> $this->input->post('icon',TRUE),
		'slug' 			=> $this->input->post('slug',TRUE),
		'urut_menu' 			=> $this->input->post('urut_menu',TRUE),
		'menu_grup_user' 			=> $this->input->post('menu_grup_user',TRUE),
		'is_active' 			=> $this->input->post('is_active',TRUE),
	    );

			$this->Menu_model->insert($data);
			$temp = $this->ion_auth->user()->row();
			$id = $temp->id;
			$nama = $temp->first_name;
			$aktivitas = $nama ." telah menambah data pada menu";
			$waktu = date('d-m-Y H:i:s');
			$data_log = array(
				'id_user' => $id,
				'aktivitas' => $aktivitas,
				'time' => $waktu, 
			);
			$this->Log_aktivitas_model->insert($data_log);
            $this->session->set_flashdata('message', 'Data berhasil ditambahkan');
            redirect(site_url('menu'),'refresh');
        }
    }
    
    public function update($id) 
    {
		//fungsi untuk menuju halaman edit data
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
			
			$row = $this->Menu_model->get_by_id($id);

			if ($row) {
				$this->data['button']		= 'Ubah';
				$this->data['action']		= site_url('menu/update_action');
			    $this->data['id'] = array(
					'name'			=> 'id',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('id', $row->id),
					'class'			=> 'form-control',
				);
			    $this->data['parent_menu'] = array(
					'name'			=> 'parent_menu',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('parent_menu', $row->parent_menu),
					'class'			=> 'form-control',
				);
			    $this->data['nama_menu'] = array(
					'name'			=> 'nama_menu',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('nama_menu', $row->nama_menu),
					'class'			=> 'form-control',
				);
			    $this->data['controller_link'] = array(
					'name'			=> 'controller_link',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('controller_link', $row->controller_link),
					'class'			=> 'form-control',
				);
			    $this->data['icon'] = array(
					'name'			=> 'icon',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('icon', $row->icon),
					'class'			=> 'form-control',
				);
			    $this->data['slug'] = array(
					'name'			=> 'slug',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('slug', $row->slug),
					'class'			=> 'form-control',
				);
			    $this->data['urut_menu'] = array(
					'name'			=> 'urut_menu',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('urut_menu', $row->urut_menu),
					'class'			=> 'form-control',
				);
			    $this->data['menu_grup_user'] = array(
					'name'			=> 'menu_grup_user',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('menu_grup_user', $row->menu_grup_user),
					'class'			=> 'form-control',
				);
			    $this->data['is_active'] = array(
					'name'			=> 'is_active',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('is_active', $row->is_active),
					'class'			=> 'form-control',
				);
	   
				$this->data['title'] = 'menu';
				$this->get_Meta();
				$this->data['_view'] = 'menu/menu_form';
				$this->_render_page('layouts/main',$this->data);
			} else {
				$this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('menu'),'refresh');
			}
		}
    }
    
    public function update_action() 
    {
		//fungsi untuk aksi merubah isi data pada database
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
			'parent_menu' 					=> $this->input->post('parent_menu',TRUE),
			'nama_menu' 					=> $this->input->post('nama_menu',TRUE),
			'controller_link' 					=> $this->input->post('controller_link',TRUE),
			'icon' 					=> $this->input->post('icon',TRUE),
			'slug' 					=> $this->input->post('slug',TRUE),
			'urut_menu' 					=> $this->input->post('urut_menu',TRUE),
			'menu_grup_user' 					=> $this->input->post('menu_grup_user',TRUE),
			'is_active' 					=> $this->input->post('is_active',TRUE),
	    );

			$this->Menu_model->update($this->input->post('id', TRUE), $data);
			$temp = $this->ion_auth->user()->row();
			$id = $temp->id;
			$nama = $temp->first_name;
			$aktivitas = $nama . " telah mengubah data pada menu";
			$waktu = date('d-m-Y H:i:s');
			$data_log = array(
				'id_user' => $id,
				'aktivitas' => $aktivitas,
				'time' => $waktu, 
			);
			$this->Log_aktivitas_model->insert($data_log);
            $this->session->set_flashdata('message', 'Data berhasil diubah');
            redirect(site_url('menu'),'refresh');
        }
    }
    
    public function delete($id) 
    {
		//fungsi untuk menghapus isi data pada database
        $row = $this->Menu_model->get_by_id($id);

        if ($row) {
			$this->Menu_model->delete($id);
			$temp = $this->ion_auth->user()->row();
			$id = $temp->id;
			$nama = $temp->first_name;
			$waktu = date('d-m-Y H:i:s');
			$aktivitas = $nama ." telah menghapus data pada menu";
			$data_log = array(
				'id_user' => $id,
				'aktivitas' => $aktivitas,
				'time' => $waktu, 
			);
			$this->Log_aktivitas_model->insert($data_log);
            $this->session->set_flashdata('message', 'Data berhasil dihapus');
            redirect(site_url('menu'),'refresh');
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('menu'),'refresh');
        }
    }
	
	public function get_Meta(){
		//fungsi untuk mendapatkan data meta web
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
		//fungsi untuk merender view dan page menjadi satu halaman utuh
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
		//fungsi untuk menetapkan rules untuk setiap field
	$this->form_validation->set_rules('parent_menu', 'parent menu', 'trim|required');
	$this->form_validation->set_rules('nama_menu', 'nama menu', 'trim|required');
	$this->form_validation->set_rules('controller_link', 'controller link', 'trim|required');
	$this->form_validation->set_rules('icon', 'icon', 'trim|required');
	$this->form_validation->set_rules('slug', 'slug', 'trim|required');
	$this->form_validation->set_rules('urut_menu', 'urut menu', 'trim|required');
	$this->form_validation->set_rules('menu_grup_user', 'menu grup user', 'trim|required');
	$this->form_validation->set_rules('is_active', 'is active', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
		//fungsi untuk mencetak file excel
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
        $namaFile = "menu.xls";
        $judul = "menu";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Parent Menu");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Menu");
	xlsWriteLabel($tablehead, $kolomhead++, "Controller Link");
	xlsWriteLabel($tablehead, $kolomhead++, "Icon");
	xlsWriteLabel($tablehead, $kolomhead++, "Slug");
	xlsWriteLabel($tablehead, $kolomhead++, "Urut Menu");
	xlsWriteLabel($tablehead, $kolomhead++, "Menu Grup User");
	xlsWriteLabel($tablehead, $kolomhead++, "Is Active");

	foreach ($this->Menu_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->parent_menu);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_menu);
	    xlsWriteLabel($tablebody, $kolombody++, $data->controller_link);
	    xlsWriteLabel($tablebody, $kolombody++, $data->icon);
	    xlsWriteLabel($tablebody, $kolombody++, $data->slug);
	    xlsWriteNumber($tablebody, $kolombody++, $data->urut_menu);
	    xlsWriteLabel($tablebody, $kolombody++, $data->menu_grup_user);
	    xlsWriteNumber($tablebody, $kolombody++, $data->is_active);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
		//fungsi untuk mencetak file word document
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
        header("Content-Disposition: attachment;Filename=menu.doc");

        $data = array(
            'menu_data' => $this->Menu_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('menu/menu_doc',$data);
    }

    function pdf()
    {
		//fungsi untuk mencetak file pdf
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
            'menu_data' => $this->Menu_model->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
        $html = $this->load->view('menu/menu_pdf', $data, true);
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        $pdf->WriteHTML($html);
        $pdf->Output('menu.pdf', 'D'); 
    }

}

/* End of file Menu.php */
/* Location: ./application/controllers/Menu.php */
