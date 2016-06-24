<?php

	//CSV reading purpose
	function parse_file($p_Filepath, $p_NamedFields = true) {
		
		$fields = array();            /** columns names retrieved after parsing */
		$separator = ';';    /** separator used to explode each line */
		$enclosure = '"';    /** enclosure used to decorate each field */		
		$max_row_size = 4096;    /** maximum row size to be used for decoding */
    	
        $content = false;
        $file = fopen($p_Filepath, 'r');
        if($p_NamedFields) {
            $fields = fgetcsv($file, $max_row_size, $separator, $enclosure);
        }
        while( ($row = fgetcsv($file, $max_row_size, $separator, $enclosure)) != false ) {            
            if( $row[0] != null ) { // skip empty lines
                if( !$content ) {
                    $content = array();
                }
                if( $p_NamedFields ) {
                    $items = array();

                    // I prefer to fill the array with values of defined fields
                    foreach( $fields as $id => $field ) {
                        if( isset($row[$id]) ) {
                            $items[$field] = $row[$id];    
                        }
                    }
                    $content[] = $items;
                } else {
                    $content[] = $row;
                }
            }
        }
        fclose($file);
        return $content;
	}
	
	//ip detecting
	function get_client_ip() {
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if(isset($_SERVER['REMOTE_ADDR']))
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
	
	function file_get_contents_curl($url)
	{
		$ch = curl_init();
	
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	
		$data = curl_exec($ch);
		curl_close($ch);
	
		return $data;
	}
	
	function saveFiles($ext,$source_ink,$permissions='r',$path='downloads/')
	{
		$name = $path.microtime(true).'.'.$ext;
		file_put_contents($name, fopen($source_ink, $permissions));
		return $name;
	}