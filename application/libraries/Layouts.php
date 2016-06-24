<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
  
/** 
 * Layouts Class. PHP5 only. 
 * 
 */
class Layouts { 
    
  // Will hold a CodeIgniter instance 
  private $CI; 
    
  // Will hold a title for the page, NULL by default 
  private $title_for_layout = NULL; 
    
  // The title separator, ' | ' by default 
  private $title_separator = ' | '; 
  
  private $includes = array();
    
  public function __construct()  
  {
    $this->CI = &get_instance(); 	
  } 
    
  public function set_title($title) 
  {   	
    $this->title_for_layout = $title.$this->title_separator;
  } 
    
  public function view($view_name, $params = array(), $layout = 'default') 
  {
  	
    // Handle the site's title. If NULL, don't add anything. If not, add a  
    // separator and append the title. 
    if ($this->title_for_layout !== NULL)  
    { 
      $separated_title_for_layout = $this->title_separator . $this->title_for_layout; 
    } 
      
    // Load the view's content, with the params passed 
    $view_content = $this->CI->load->view($view_name, $params, TRUE); 
  
    // Now load the layout, and pass the view we just rendered 
    $this->CI->load->view('layouts/' . $layout, array( 
      'content_for_layout' => $view_content, 
      'title_for_layout' => $separated_title_for_layout
    )); 
  } 
    
  public function add_include($paths, $prepend_base_url = TRUE) 
  {	
    if ($prepend_base_url) 
    { 
      $this->CI->load->helper('url'); // Load this just to be sure	  
	  foreach($paths as $path){$this->includes[] = base_url() .'assets/'.$path;} 
    } 
    else
    { 
      foreach($paths as $path){$this->includes[] = 'assets/'.$path;} 
    }  
    return $this; // This allows chain-methods 
  }
   
  public function print_includes() 
  {
  
    // Initialize a string that will hold all includes 
    $final_includes['css'] = ''; 
	$final_includes['js'] = ''; 
  
    foreach ($this->includes as $include) 
    {	
      // Check if it's a JS or a CSS file 
      if (preg_match('/js$/', $include)) 
      {  
        // It's a JS file 
        $final_includes['js'] .= '<script type="text/javascript" src="' . $include . '"></script>'; 
      } 
      elseif (preg_match('/css$/', $include)) 
      {      	
        // It's a CSS file 
        $final_includes['css'] .= '<link href="' . $include . '" rel="stylesheet" type="text/css" media="all" />'; 
      }      
    } 
	return $final_includes; 
  } 
  
  public function remove_includes($paths, $prepend_base_url = TRUE)
  {
  	if ($prepend_base_url)
  	{
  		$this->CI->load->helper('url'); // Load this just to be sure  		
  		foreach($paths as $path){
  			if(($key = array_search(base_url() .'assets/'.$path, $this->includes)) !== false) {
  				unset($this->includes[$key]);
  			}  				
  		}
  	}
  	else
  	{
  		foreach($paths as $path){
  			if(($key = array_search('assets/'.$path, $this->includes)) !== false) {
  				unset($this->includes[$key]);
  			}
  		}  		
  	}
  	//if(in_a)
  	return $this->includes;
  }
}