<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

	public function __construct()
	{			
		parent::__construct();		
		$this->load->library('Layouts');
		$this->layouts->add_include($this->config->item('header_css'));
		$this->layouts->add_include($this->config->item('header_js'));		
		$this->load->helper(array('form','url'));		
	}
	
	public function index()
	{			
		$data = array();	
		$includes = array('css/popuo-box.css','css/flexslider.css','js/jquery.leanModal.min.js','js/jquery.magnific-popup.js','js/jquery.flexisel.js','js/common.js');
		$this->layouts->add_include($includes);
		$this->layouts->set_title('Home');		
		$this->layouts->view('/home/index.php',$data);
	}
}
