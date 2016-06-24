<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dialogs extends CI_Model {	
	
	public function __construct()
	{			
		parent::__construct();		
	}	
	
	public function fetch_content($array,$limit=1,$offset=0)
	{
		return $this->db->get_where(DIALOGS, $array , $limit, $offset)->result_array();
	}
	
	public function insertRecord($data)
	{
		$this->db->insert(DIALOGS,$data);
		return $this->db->insert_id();						
	}
	/*public function update_row($data,$id)
	{
		$this->db->where('id',$id);
		return $this->db->update(DIALOGS,$data);
	}*/
}
