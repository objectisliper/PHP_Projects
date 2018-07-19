<?php
require('simple_html_dom.php');

 // Существование ссылки (URL)
function open_url($url)
{
 $url_c=parse_url($url);
 
  if (!empty($url_c['host']) and checkdnsrr($url_c['host']))
  {
    // Ответ сервера
    if ($otvet=@get_headers($url)){
      return substr($otvet[0], 9, 3);
    }
  }
  return false;     
}

$username = $_GET["username"];
$username = (string)$username;

$o=open_url("https://github.com/".$username);
if($o==200){

$html = file_get_html("https://github.com/".$username);

// Находим все изображения
foreach($html->find('img.avatar') as $element) 
   $parsed['profile_img'] = $element->src;
	
$profile_img = json_encode($parsed['profile_img']);
echo "<script language='javascript'>$('#profile_img').attr('src',$profile_img);</script>";
echo "<script language='javascript'>$('#userlogin').append('" . $username;
 
foreach ($html->find('span.p-name') as $element) {
	
	if ($element){
		$parsed['real_name'] = $element->plaintext;
	echo " - " . $parsed['real_name'];
	}


}

echo "');</script>";
foreach ($html->find('span.p-org div') as $element) {
	
	if ($element){
		$parsed['company'] = $element->plaintext;
	echo  "<script language='javascript'>$('#userlogin').append('".$parsed['company']."');</script>";
	}


}



}
else{
echo "Возможно вы ввели неверное имя пользователя <br>";
};


