<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

	public function __construct()
	{			
		parent::__construct();		
		$this->load->library('Layouts');
		$includes = array('css/bootstrap.css','css/font-awesome.min.css','css/admin/ionicons.min.css',
				'css/admin/skin-blue.min.css','css/admin/style.css','js/jquery.min.js','js/bootstrap.min.js',
				'js/admin/app.min.js'
		);		
		$this->layouts->add_include($includes);		
		$this->load->helper(array('form','url','common'));		
	}
	
	public function index()
	{			
		$data = array();		
		$this->layouts->set_title('Dashboard');		
		$this->layouts->view('/home/dashboard',$data);
	}
			
	public function fetchFromSamosa($segment){
		$this->load->model('Dialogs');
		if(empty($this->Dialogs->fetch_content(array('share_link' => $segment)))){
			$url = 'http://getsamosa.com/play/'.$segment;		
			
			$html = file_get_contents_curl(trim($url));
			
			//parsing begins here:
			$doc = new DOMDocument();
			@$doc->loadHTML($html);
			
			
			$metas = $doc->getElementsByTagName('meta');
			
			$info = array();
			for ($i = 0; $i < $metas->length; $i++)
			{
				$meta = $metas->item($i);
				if($meta->getAttribute('property') == 'og:video')
				{
					$parts = parse_url($meta->getAttribute('content'));
					parse_str($parts['query'], $query);
					 
					$path_info = pathinfo($query['audio_file']);
					$info['audio_path'] = saveFiles($path_info['extension'],$query['audio_file']);
					$path_info = pathinfo($query['image_file']);
					$info['image_path'] = saveFiles($path_info['extension'],$query['image_file']);
					$info['share_link'] = trim($query['share_link']);
					 
				}
				else if($meta->getAttribute('property') == 'og:title')
				{
					$info['title'] = $meta->getAttribute('content');					
				}
				else if($meta->getAttribute('name') == 'description')
				{
					$info['description'] = $meta->getAttribute('content');
				}
			}
			
			if(isset($info['audio_path'])){
				return $info;
				/*$info['ip'] = get_client_ip();			
				$fields=array_keys($info); // here you have to trust your field names!
				$values=array_values($info);
				$fieldlist=implode(',',$fields);
				$qs=':'.implode(',:',$fields);
				$sql="insert into ".DIALOGS." ($fieldlist) values($qs)";
				$database->query($sql);
				foreach ($info as $key => $value) {
					$database->bind(':'.$key, $value);
				}
				if($database->execute()){
					$error .="<p class='text-success'>Data inserted successfully</p>";
				}
				else{
					$error .='<p class="text-danger">Some thing went wrong</p>';
				}*/
			}
			else{
				return false;
			}			
		}		
		return false;		
	}
	
	public function uploadToDrive($service,$uploadFile,$name,$mime_type='audio/mp3'){	
		
		$file = new Google_Service_Drive_DriveFile();
		$result = $service->files->create(
				$file,
				array(
						'data' => file_get_contents($uploadFile),
						'mimeType' => 'application/octet-stream',
						'uploadType' => 'media'
				)
				);
		
		$folderId = '0B7qbNFzen7jYdlpkUV95Zm04ZFk';
			
		$fileMetadata = new Google_Service_Drive_DriveFile(array(
				'name' => $name,
				'parents' => array($folderId),				
				'mimeType' => $mime_type));
		$content = file_get_contents($uploadFile);
		$file = $service->files->create($fileMetadata, array(
				'data' => $content,
				'mimeType' => $mime_type,
				'uploadType' => 'multipart',
				'fields' => 'id'));
		return $file->id;
	}
	
	
	public function bulkupload()
	{		
		
		
		//Gdrive connection
			$this->load->library('Google');
			$this->load->helper('gdrive');
			$client_id = '732517493728-3g52mauqrcu5muliiqfst7a45pj9kn0l.apps.googleusercontent.com';
			$client_secret = 'hwE5uOopKskaPHn1YdgM7VGD';
			$redirect_uri = 'http://localhost:5555/admin/home/bulkupload';
			
			$client = new Google_Client();
			$client->setClientId($client_id);
			$client->setClientSecret($client_secret);
			$client->setRedirectUri($redirect_uri);
			$client->addScope("https://www.googleapis.com/auth/drive");
			$service = new Google_Service_Drive($client);
			
			
			if (isset($_REQUEST['logout'])) {
				unset($_SESSION['upload_token']);
			}
			
			if (isset($_GET['code'])) {
				$client->authenticate($_GET['code']);
				$_SESSION['upload_token'] = $client->getAccessToken();
				$redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
				header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
			}
			
			if (isset($_SESSION['upload_token']) && $_SESSION['upload_token']) {
				$client->setAccessToken($_SESSION['upload_token']);
				if ($client->isAccessTokenExpired()) {
					unset($_SESSION['upload_token']);
				}
			} else {
				$authUrl = $client->createAuthUrl();
			}
			
			if (strpos($client_id, "googleusercontent") == false) {
				echo missingClientSecretsWarning();
				
			}
				
				
			if (isset($authUrl)) {
				echo "<a class='login' href='" . $authUrl . "'>Connect Me!</a>";
				exit;
			}
			
			
			
			
		//End
		
		
		$segmentList = parse_file('report.csv');
		$cnt = 0;$limit = 10;
		foreach ($segmentList as $segment){			
			if($cnt == $limit)break;
			$samosaData = $this->fetchFromSamosa($segment['Link']);
			if(is_array($samosaData)){
				if(file_exists($samosaData['audio_path'])){
					$pathinfo = pathinfo($samosaData['audio_path']);
					$mime_type = 'audio/'.strtolower($pathinfo['extension']);
					$name = str_replace(' ','_',$samosaData['title']).'.'.strtolower($pathinfo['extension']);
					$audio_id = $this->uploadToDrive($service,$samosaData['audio_path'],$name,$mime_type);
				}
				if(file_exists($samosaData['image_path'])){
					$pathinfo = pathinfo($samosaData['image_path']);
					$mime_type = 'image/'.strtolower($pathinfo['extension']);
					$name = str_replace(' ','_',$samosaData['title']).'.'.strtolower($pathinfo['extension']);
					$image_id = $this->uploadToDrive($service,$samosaData['image_path'],$name,$mime_type);
				}				
				echo "<pre>";print_r($audio_id.'<br>'.$image_id);		
			}
			else{
				//log here
				
				continue;
			}
			$cnt++;
		}
		
		exit;
		
		/*$this->load->library('Google');
		$this->load->helper('gdrive');
		$filesList = array('Aakasha_Ganga.mp3','04_-_Kila_Kila_DRGM1.mp3');
		
		$client_id = '732517493728-3g52mauqrcu5muliiqfst7a45pj9kn0l.apps.googleusercontent.com';
		$client_secret = 'hwE5uOopKskaPHn1YdgM7VGD';
		$redirect_uri = 'http://localhost:5555/admin/home/bulkupload';
		
		$client = new Google_Client();
		$client->setClientId($client_id);
		$client->setClientSecret($client_secret);
		$client->setRedirectUri($redirect_uri);
		$client->addScope("https://www.googleapis.com/auth/drive");
		$service = new Google_Service_Drive($client);
		
		
		if (isset($_REQUEST['logout'])) {
			unset($_SESSION['upload_token']);
		}
		
		if (isset($_GET['code'])) {
			$client->authenticate($_GET['code']);
			$_SESSION['upload_token'] = $client->getAccessToken();
			$redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
			header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
		}
		
		if (isset($_SESSION['upload_token']) && $_SESSION['upload_token']) {
			$client->setAccessToken($_SESSION['upload_token']);
			if ($client->isAccessTokenExpired()) {
				unset($_SESSION['upload_token']);
			}
		} else {
			$authUrl = $client->createAuthUrl();
		}
			
		$path = 'uploads/cuts/';
		
			
			
		
			if ($client->getAccessToken()) {
				// This is uploading a file directly, with no metadata associated.
				
				$cnt = 1;
				foreach ($filesList as $uploadFile){
					
					$file = new Google_Service_Drive_DriveFile();
					$result = $service->files->create(
						$file,
						array(
							'data' => file_get_contents($path.$uploadFile),
							'mimeType' => 'application/octet-stream',
							'uploadType' => 'media'
						)
					);
						
					$folderId = '0B7qbNFzen7jYdlpkUV95Zm04ZFk';
					
					$fileMetadata = new Google_Service_Drive_DriveFile(array(
							'name' => $cnt.'_My_Report.mp3',
							'parents' => array($folderId),
							//'mimeType' => 'application/vnd.google-apps.spreadsheet'));
							'mimeType' => 'audio/mp3'));
					$content = file_get_contents($path.$uploadFile);
					$file = $service->files->create($fileMetadata, array(
							'data' => $content,
							'mimeType' => 'audio/mp3',
							'uploadType' => 'multipart',
							'fields' => 'id'));
					printf("File ID: %s\n", $file->id);
					$cnt++;
					
				}
				
				
				
				
				
				
				
				
				
				
				
					
			}
			
			
		
		
			
			echo pageHeader("File Upload - Uploading a small file");
			if (strpos($client_id, "googleusercontent") == false) {
				echo missingClientSecretsWarning();
				exit;
			}
			
			
			if (isset($authUrl)) {
				echo "<a class='login' href='" . $authUrl . "'>Connect Me!</a>";
			}
			
			
			if (isset($result) && $result) {
				var_dump($result->title);
			}
		
		
		exit('hai');	*/	
	}
}
