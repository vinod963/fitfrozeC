<?php
require_once "database.php";
include_once "common.php";
$database = new DatabaseClass();
$error = '';
if(isset($_POST['url']))
{
    if(trim($_POST['url']) != '')
    {  

        $database->query('SELECT id FROM '.DIALOGS.' WHERE share_link = :share_link');
        $database->bind(':share_link', trim($_POST['url']));
        $database->execute();
        $cnt = $database->rowCount();

        
        if(!$cnt)
        {
          $html = file_get_contents_curl(trim($_POST['url']));

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
              $info['ip'] = get_client_ip();


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
              }
          }
          else{
            $error .='<p class="text-danger">Not found data</p>';
          }

        }
        else{
              $error .='<p class="text-danger">Record already existed</p>';
        }
    }
    else{
        $error .='<p class="text-danger">Please enter valid email adddress</p>';
    }
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <form role="form" action="" method="post">
    <div class="form-group">
      <label for="url">Source URL:</label>
      <input type="text" class="form-control" id="url" name="url" placeholder="Enter url">
      <?php echo $error;?>
    </div>      
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>
</body>
</html>
