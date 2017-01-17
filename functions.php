<?php
function makeCurl($api,$method,$datas){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://api.telegram.org/bot{$api}/{$method}");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($datas));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec ($ch);
    curl_close ($ch);
    return $server_output;
}

function SetFeedReader($feed_address,$message_id)
{ 
    global $conn;
    $xmlDoc = new DOMDocument();
    $xmlDoc->load($feed_address);

    $out="";
    $x=$xmlDoc->getElementsByTagName('item');
    for ($i=0; $i<=3; $i++) {
      $item_title=$x->item($i)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
      $item_link=$x->item($i)->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
      //$item_desc=$x->item($i)->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;
      
      $sql="SELECT COUNT(title) AS title FROM tblsavefeedtitle WHERE title=N'$item_title'";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      echo $row["title"];

      if(strval($row["title"])==0){
        $out .= $item_link . "\n" . $item_title . "\n\n";
        $sql="INSERT INTO tblsavefeedtitle(title) VALUES('$item_title')";
        if ( $conn->query( $sql ) === TRUE ) {
          $inserted = true;
      } else
        echo $conn->error ;
      }

      echo ("<p><a href='" . $item_link . "'>" . $item_title . "</a>");
        echo ("<br>");
    }
    if($out != ""){
      echo "amir";
      $data=array("chat_id"=>$message_id, "text"=>$out);
      makeCurl(TOKEN,"sendMessage",$data);
    }else{
      echo "ali";
    }
}

?>