<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ownringtone extends MX_Controller {

	public function __construct()
	{		
		parent::__construct();		
		$this->load->library('Layouts');
		$this->layouts->add_include($this->config->item('header_css'));
		$this->layouts->add_include($this->config->item('header_js'));		
		$this->load->helper(array('form','url'));		
	}
	
	public function index($id=null)
	{	
		$data = array();
		$includes = array('css/popuo-box.css','css/flexslider.css',
				'js/jquery.leanModal.min.js','js/jquery.magnific-popup.js',
				'js/jquery.flexisel.js','js/common.js');
		array_push($includes,'css/custom_fileupload.css','js/jquery.ajaxfileupload.js');
		$this->layouts->add_include($includes);
		$this->layouts->set_title('Make your tone');
		$this->layouts->view('/ownringtone/upload.php',$data);			
	}
	
	public function ffmpeg(){
		$start_time		= $_GET['min'];
		$total_seconds	= $_GET['max'];
		$total_time 	= $_GET['total'];
		$song 			= ltrim($_GET['song'],'/');
		$song_name 		= $_GET['song_name'];
				
		$start_time=round((($start_time*$total_time)/100)/1000,2);
		$total_seconds=round((($total_seconds*$total_time)/100)/1000,2);
		$total_time=round($total_seconds-$start_time,2);
		$path2 = "uploads/cuts/";		
		exec("ffmpeg -ss ".$start_time." -t ".$total_time." -i ".$song." -acodec copy -y ".$path2.$song_name." -y");		
		
		/*************************Update table****************/
		 
		$data = array('mp3ringtone'=>'/'.$path2.$song_name);
		$this->load->model('Mp3Source');
		$sid = (gettype($_GET['id']) == 'integer') ? $_GET['id'] : (int)$_GET['id'];
		$this->Mp3Source->update_row($data,$sid);
		
		/*****************************************/			
		echo "<br></br><a class=\"pressing\" style=\"margin-top:1px;font-family:Verdana;font-size:10px; padding:5px;\"  href=\"/".$path2.$song_name."\">Download your ringtone!</a>";
		
		echo "<br></br><a class=\"pressing\" style=\"margin-top:1px;font-family:Verdana;font-size:10px; padding:5px;\"  href=\"#\" onclick=\"parent.location.reload();\">Try another!</a>";
		die();
		
	}
	
	public function ajaxFileUpload()
	{			
		$config['upload_path']          = 'uploads/';
		$config['allowed_types']        = 'mp3';
		$config['max_size']             = 8192; //8 MB
		$name = null;
		$rowid = 0;
		$sourcepath = '';
		$this->load->library('upload', $config);
		$error = "No file uploaded";
		
		if ( ! $this->upload->do_upload('fileToUpload'))
		{
			$error = strip_tags($this->upload->display_errors());
		}
		else
		{
			$error = 0;
			$data = $this->upload->data();
			$this->load->model('Mp3Source');
			$sourcepath = '/'.$config['upload_path'].$data['file_name'];
			$rdata = array('mp3upload'=>$sourcepath);
			$rowid = $this->Mp3Source->insertRecord($rdata);
			if($rowid){							
				$name = $data['file_name'];		
			}
			else{
				$error = "Something went wrong"; 
			}				
		}
		
		echo json_encode(array(
				'cutterurl'  => '/ringtones/ownringtone/cutringtone?vid_name='.$sourcepath.'&song_name='.$name.'&id='.$rowid,				
				'error' => $error,
		));
		die();	
	}
	
	public function cutringtone(){
		$data = array();
		$this->load->view('/ownringtone/index.php',$data);	
	}
}
