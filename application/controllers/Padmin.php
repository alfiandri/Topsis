<?php
class Padmin extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
			$url=base_url('loginadmin');
			redirect($url);
		};
		$this->load->model('m_padmin');
	}
	public function index(){
		if(isset($_SESSION['logged_in'])){
			$user_nip=$_SESSION['user_nip'];
			$user_role=$_SESSION['user_role'];
			if($user_role=='pimpinan')
			{
				$x['guser']=$this->m_padmin->get_user($user_nip);
				$x['gdosen']=$this->m_padmin->get_all_dosen();
				$x['gkriteria']=$this->m_padmin->get_all_kriteria();
				$this->load->view('header');
				$this->load->view('topbar',$x);
				$this->load->view('sidebar',$x);
				$this->load->view('index');
				$this->load->view('footer');
			}
			else if($user_role=='dosen'){

				$x['guser']=$this->m_padmin->get_user($user_nip);
				$x['gnilai']=$this->m_padmin->get_nilai_by_user($user_nip);
				$x['gkriteria']=$this->m_padmin->get_all_kriteria($user_nip);
				$this->load->view('header');
				$this->load->view('topbar',$x);
				$this->load->view('sidebar',$x);
				$this->load->view('topsis/nilai');
				$this->load->view('footer');

			}
			else {
				$x['guser']=$this->m_padmin->get_user($user_nip);
				$x['gkriteria']=$this->m_padmin->get_all_kriteria();
				$this->load->view('header');
				$this->load->view('topbar',$x);
				$this->load->view('sidebar',$x);
				$this->load->view('topsis/kriteria');
				$this->load->view('footer');
			}
		}
		else {
			$this->load->view('404');
		}
	}

	public function user(){
		if(isset($_SESSION['logged_in'])){
			$user_nip=$_SESSION['user_nip'];
			$user_role=$_SESSION['user_role'];
			if($user_role=='admin')
			{
				$x['guser']=$this->m_padmin->get_user($user_nip);
				$x['data']=$this->m_padmin->get_all_user();
				$this->load->view('header');
				$this->load->view('topbar',$x);
				$this->load->view('sidebar',$x);
				$this->load->view('user/user');
				$this->load->view('footer');
			} 
			else {
				$this->load->view('404');
			}
		}
		else {
			$this->load->view('404');
		}
	}

	function save_kriteria(){
		$nama=$this->input->post('nama');
		$bobot=$this->input->post('bobot');
		$attribute=$this->input->post('attribute');
		$this->m_padmin->save_kriteria($nama,$bobot,$attribute);
		echo $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Berhasil menambahkan data kriteria</div>');
		redirect();
	}	

	function update_kriteria(){
		$kode=$this->input->post('kode');
		$nama=$this->input->post('nama');
		$bobot=$this->input->post('bobot');
		$attribute=$this->input->post('attribute');
		$this->m_padmin->update_kriteria($kode,$nama,$bobot,$attribute);
		echo $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Berhasil merubah data kriteria</div>');
		redirect();
	}	


	function delete_kriteria(){
		$kode=$this->input->post('kode');
		$this->m_padmin->delete_kriteria($kode);
		echo $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Berhasil menghapus data kriteria</div>');
		redirect();
	}


	function save_nilai(){
		$user_nip=$this->input->post('user_nip');
		$kriteria=$this->input->post('kriteria');
		$nilai=$this->input->post('nilai');
		$this->m_padmin->save_nilai($user_nip,$kriteria,$nilai);
		echo $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Berhasil menambah data Nilai</div>');
		redirect();
	}	

	function update_nilai(){
		$kode=$this->input->post('kode');
		$kriteria=$this->input->post('kriteria');
		$nilai=$this->input->post('nilai');
		$this->m_padmin->update_nilai($kode,$kriteria,$nilai);
		echo $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Berhasil merubah data Nilai</div>');
		redirect();
	}	


	function delete_nilai(){
		$kode=$this->input->post('kode');
		$this->m_padmin->delete_nilai($kode);
		echo $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Berhasil menghapus data Nilai</div>');
		redirect();
	}	



	function save_user(){
		$user_nip=$this->input->post('user_nip');
		$user_nama=$this->input->post('user_nama');
		$user_password=$this->input->post('password');
		$user_repassword=$this->input->post('repassword');
		$user_role=$this->input->post('user_role');

		if($user_password==$user_repassword){
			$config['upload_path'] = './assets/images/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
			$config['encrypt_name'] = TRUE;

			$this->upload->initialize($config);

			if ($this->upload->do_upload('filefoto'))
			{
				$gbr = $this->upload->data();
				$config['image_library']='gd2';
				$config['source_image']='./assets/images/'.$gbr['file_name'];
				$config['create_thumb']= FALSE;
				$config['maintain_ratio']= FALSE;
				$config['quality']= '60%';
				$config['width']= 360;
				$config['height']= 420;
				$config['new_image']= './assets/images/'.$gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$gambar=$gbr['file_name'];
				$this->m_padmin->save_user($user_nip,$user_nama,$user_password,$user_role,$gambar);
				echo $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> User berhasil ditambah</div>');
				redirect('user');

			}else{
				$this->m_padmin->save_user_wo_img($user_nip,$user_nama,$user_password,$user_role);
				echo $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> User berhasil ditambah</div>');
				redirect('user');
			}
		}
		else {
			echo $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Password Tidak Sama</div>');
			redirect('user');
		}
	}



	function update_user(){
		$kode=$this->input->post('kode');
		$user_nama=$this->input->post('user_nama');
		$user_password=$this->input->post('user_password');
		$user_repassword=$this->input->post('user_repassword');
		$user_role=$this->input->post('user_role');

		if($user_password==$user_repassword){
			$config['upload_path'] = './assets/images/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
			$config['encrypt_name'] = TRUE;

			$this->upload->initialize($config);

			if ($this->upload->do_upload('filefoto'))
			{
				$gbr = $this->upload->data();
				$config['image_library']='gd2';
				$config['source_image']='./assets/images/'.$gbr['file_name'];
				$config['create_thumb']= FALSE;
				$config['maintain_ratio']= FALSE;
				$config['quality']= '60%';
				$config['width']= 360;
				$config['height']= 420;
				$config['new_image']= './assets/images/'.$gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$gambar=$gbr['file_name'];
				$this->m_padmin->update_user($kode,$user_nama,$user_role,$gambar);
				echo $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> User berhasil diedit</div>');
				redirect('user');

			}else{
				$this->m_padmin->update_user_wo_img($kode,$user_nama,$user_role);
				echo $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> User berhasil diedit</div>');
				redirect('user');
			}
		}
		else {
			echo $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Password Tidak Sama</div>');
			redirect('user');
		}
	}




	function delete_user(){
		$kode=$this->input->post('kode');
		$this->m_padmin->delete_user($kode);
		echo $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> User berhasil dihapus</div>');
		redirect('user');
	}	

}		