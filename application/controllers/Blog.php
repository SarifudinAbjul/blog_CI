<?php

class Blog extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
				// library database CI
		// $this->load->database();
			//helpers
		$this->load->model('Blog_model');
		$this->load->library('session');
	}


	public function index($offset = 0)
	{
		// library database CI
		// $this->load->database();

		// query SQL
		// $query = $this->db->query('SELECT * FROM blog');
		$this->load->library('pagination');

		$config['base_url'] = site_url('blog/index');
		$config['total_rows'] = $this->Blog_model->getTotalBlogs();
		$config['per_page'] = 3;

		$this->pagination->initialize($config);


		// query builder CI
		$query = $this->Blog_model->getBlogs($config['per_page'], $offset);

		$data['blogs'] = $query->result_array(); 

		// $data['blogs'] = [
		// 	[ 'title' => 'Artikel Pertama',
		// 		'content' => '<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		// 					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		// 					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		// 					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		// 					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		// 					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>'
		// 	],
		// 	[
		// 		'title' => 'Artikel Kedua',
		// 		'content' => '<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		// 					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		// 					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		// 					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		// 					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		// 					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>'
		// 	],
		// 	[
		// 		'title' => 'Artikel Ketiga',
		// 		'content' => '<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		// 					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		// 					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		// 					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		// 					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		// 					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>'
		// 	]
		// ];

		$this->load->view('blog', $data);
	}

	public function detail($url)
	{
				// SQL Query where
		// $query = $this->db->query('SELECT * FROM blog WHERE url = "'.$url.'"');

		$query = $this->Blog_model->getSingleBlog('url',$url);

		$data['blog'] = $query->row_array();

		$this->load->view('detail', $data);

	}

	public function add()
	{
		// pengecekan Manual
			// if(isset($_GET['title'])){

			// 	$data['title'] = $_GET['title'];
			// 	$data['content'] = $_GET['content'];
			
			// }

		// library pengecekan di CI
			// $this->input->get();
			$this->form_validation->set_rules('title', 'Judul', 'required');
			$this->form_validation->set_rules('url', 'URL', 'required|alpha_dash');
			$this->form_validation->set_rules('content', 'Konten', 'required');

		if($this->form_validation->run() === TRUE){
			$data['title'] = $this->input->post('title');
			$data['content'] = $this->input->post('content');
			$data['url'] = $this->input->post('url');

	         $config['upload_path']          = './uploads/';
             $config['allowed_types']        = 'gif|jpg|png';
             $config['max_size']             = 10000;
             $config['max_width']            = 1024;
             $config['max_height']           = 768;

              $this->load->library('upload', $config);
			  $this->upload->do_upload('cover');
                if (!empty($data['cover'] = $this->upload->data()['file_name']))
                {
                        $data['cover'] = $this->upload->data()['file_name'];
                        // $this->load->view('upload_success', $data);
                }

			$id = $this->Blog_model->insertBlog($data);


			if($id){
				$this->session->set_flashdata('massage','<div class="alert alert-success"> Data Berhasil disimpan! </div>');
				redirect('');
			}else{
				$this->session->set_flashdata('massage', '<div class="alert alert-warning"> Data Gagal disimpan! </div>');
				redirect('');
			}
		}

		$this->load->view('form_add');


}
	
	
	public function update($id)
	{

	
		$query = $this->Blog_model->getSingleBlog('id', $id);
		$data['blog'] = $query->row_array();

		$this->form_validation->set_rules('title', 'Judul', 'required');
		$this->form_validation->set_rules('url', 'URL', 'required|alpha_dash');
		$this->form_validation->set_rules('content', 'Konten', 'required');

		if($this->form_validation->run() === TRUE){
			$post['title'] = $this->input->post('title');
			$post['url'] = $this->input->post('url');
			$post['content'] = $this->input->post('content');

			 $config['upload_path']          = './uploads/';
             $config['allowed_types']        = 'gif|jpg|png';
             $config['max_size']             = 10000;
             $config['max_width']            = 1024;
             $config['max_height']           = 768;

              $this->load->library('upload', $config);
              $this->upload->do_upload('cover');
             
              if (!empty($post['cover'] = $this->upload->data()['file_name']))
                {
                   $post['cover'] = $this->upload->data()['file_name'];
                        // $this->load->view('upload_success', $data);
                }

			$id = $this->Blog_model->updateBlog($id, $post);

			if($id){

				$this->session->set_flashdata('massage', '<div class="alert alert-success"> Data berhasil Diubah! </div>');
				redirect('');
			}else{

				$this->session->set_flashdata('massage', '<div class="alert alert-warning"> Data Gagalgal Diubah! </div>');
				edirect('');
			}
		}

		$this->load->view('form_update', $data);
	}

 	public function delete($id)
 	{
 		$result= $this->Blog_model->deleteBlog($id);

 		if($result){
 			$this->session->set_flashdata('massage', '<div class="alert alert-success"> Data Berhasil Dihapus </div>');
 			 redirect('');
 		}else{
 			$this->session->set_flashdata('massage', '<div class="alert alert-warning"> Data Gagal Dihapus </div>');
 			redirect('');
 		}

 	}

 	public function login()
 	{
 		if($this->input->post())
 		{

	 		$username = $this->input->post('username');
	 		$password = $this->input->post('password');

	 		if($username == 'admin' && $password == 'admin'){
	 			$_SESSION['username'] = 'admin';
	 			redirect('');
	 		}else{
	 			$this->session->set_flashdata('massage','<div class="alert alert-warning"> Username/Password Tidak Valid.!!! </div>');
	 			redirect('blog/login');
	 		}
		}

	 	$this->load->view('login');
 		
 	}

 	public function logout()
 	{
 		$this->session->sess_destroy();
 		redirect('');
 	}

}