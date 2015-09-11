<?PHP
header('Content-Type: image/jpeg');
$url="http://media-cache-ak0.pinimg.com/736x/1a/6f/07/1a6f079e36c6e5fbaf4dce069b5fa69a.jpg";
if(isset($_GET['url']))
{
  $urltest=$_GET['url'];
  if(substr(strtolower($urltest),0,4) == 'http')
  {
	  $url=$urltest;
  }
}
$content=file_get_contents($url);
echo $content;
?>
