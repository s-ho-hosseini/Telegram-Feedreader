
<?php
require_once dirname( __FILE__ ) . '/dbconnect.php';
header('Content-Type: text/html; charset=utf-8');

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
 

$xml=("http://www.tabnak.ir/fa/rss/allnews");
$xmlDoc = new DOMDocument();
$xmlDoc->load($xml);


$channel=$xmlDoc->getElementsByTagName('channel')->item(0);
$channel_title = $channel->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
$channel_link = $channel->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
$channel_desc = $channel->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;


echo("<p><a href='" . $channel_link
  . "'>" . $channel_title . "</a>");
echo("<br>");
echo($channel_desc . "</p>");

$out="";
$x=$xmlDoc->getElementsByTagName('item');
for ($i=0; $i<=3; $i++) {
  $item_title=$x->item($i)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
  $item_link=$x->item($i)->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
  //$item_desc=$x->item($i)->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;
  $sql="SELECT COUNT(title) AS title FROM tblsavefeedtitle WHERE title=N'$item_title'";
  $result = $conn->query( $sql );
  if ( $result->num_rows > 0 ) {
    $row = $result->fetch_assoc()
    if(strval($row["title"])==0){
      echo ("<p><a href='" . $item_link
        . "'>" . $item_title . "</a>");
        echo ("<br>");
    }
  }
  


 $out.= $item_link . "\n" . $item_title . "\n\n";
  //echo ($item_desc . "</p>");
}
$data=array("chat_id"=>"-1001081902139", "text"=>$out);
makeCurl("305737044:AAGAIwUrbDC15wWE9k4JSDyd9yfgYoUKSW8","sendMessage",$data);
?> 