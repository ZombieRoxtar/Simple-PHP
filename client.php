<?php

/*
  serverVar: Returns the value of $_SERVER[ $var ] sanitized in htmlspecialchars() if present, if this data is unset of empty then $default will be returned, also sanitized in htmlspecialchars().
*/
function serverVar( $var, $default )
{
	if( isset( $default ))
    $retval = $default;
   else
    $retval = $default = "Unspecified";
	if( isset( $_SERVER[ $var ] ))
  {
    $testvar = $_SERVER[ $var ];
    if( $testvar != "" )
      $retval = $testvar;
  }
	return htmlspecialchars( $retval );
}

$protocol = serverVar( 'SERVER_PROTOCOL', 'Unspecified' );
$method = serverVar( 'REQUEST_METHOD', 'Unspecified' );
$query = serverVar( 'QUERY_STRING', 'Unused' );
$accept_main = serverVar( 'HTTP_ACCEPT', 'Unspecified' );
$accept_char = serverVar( 'HTTP_ACCEPT_CHARSET', 'Unspecified' );
$accept_enco = serverVar( 'HTTP_ACCEPT_ENCODING', 'Unspecified' );
$accept_lang = serverVar( 'HTTP_ACCEPT_LANGUAGE', 'Unspecified' );
$head_conn = serverVar( 'HTTP_CONNECTION', 'Unspecified' );
$head_host = serverVar( 'HTTP_HOST', 'Unspecified' );
$referer = serverVar( 'HTTP_REFERER', 'N/A' );
$user_agent = serverVar( 'HTTP_USER_AGENT', 'Unspecified' );

$secure = 'Unsecure';
if( isset( $_SERVER[ 'HTTPS' ] ))
  if ( $_SERVER[ 'HTTPS' ] == 'on' )
  {
    $secure = 'Secure';
  }

$ip = serverVar( 'REMOTE_ADDR', 'Unspecified' );
$port = serverVar( 'REMOTE_PORT', 'Unspecified' );
$reqeust = serverVar( 'REQUEST_URI', 'Unspecified' );

$maxlength = 75;
if ( strlen( $referer ) > $maxlength )
{
  $referer = substr( $referer, 0, $maxlength - 3 ) . "...";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta charset="utf-8" />
  <title>What I know about you...</title>
</head>
<body>
It's amazing how much information you send to every website you visit.
<h2>This table is about the request you just made:</h2>
<table border>
  <tr><td><i>Field</i></td><td><i>Value</i></td><td><i>Description</i></td></tr>
  <tr><td>Protocol</td><td><b><?php echo $protocol; ?></b></td><td>Usually the HTTP version (usually 1.1)</td></tr>
  <tr><td>Request Method</td><td><b><?php echo $method; ?></b></td><td>The method will (almost) always be "GET" for this page.</td></tr>
  <tr><td>Query String</td><td><b><?php echo $query; ?></b></td><td>The part of the URL after the page's name <a href="client.php?x=1">Try this.</a></td></tr>
  <tr><td>Accept Header</td><td><b><?php echo $accept_main; ?></b></td><td>The types of data that you accept</td></tr>
  <tr><td>Accept Characters</td><td><b><?php echo $accept_char; ?></b></td><td>The character set that you accept</td></tr>
  <tr><td>Accept Encoding</td><td><b><?php echo $accept_enco; ?></b></td><td>The encoding type that you accept</td></tr>
  <tr><td>Accept Language</td><td><b><?php echo $accept_lang; ?></b></td><td>The language that you accept</td></tr>
  <tr><td>Connection Header</td><td><b><?php echo $head_conn; ?></b></td><td>Connection parameters</td></tr>
  <tr><td>Connection Host</td><td><b><?php echo $head_host; ?></b></td><td>The server name you used</td></tr>
  <tr><td>Referer</td><td><b><?php echo $referer; ?></b></td><td>The page where you just were</td></tr>
  <tr><td>User Agent</td><td><b><?php echo $user_agent; ?></b></td><td>Information about your browser and operating system</td></tr>
  <tr><td>Secure Connection</td><td><b><?php echo $secure; ?></b></td><td>Whether you connected using secure HTTP</td></tr>
  <tr><td>IP Address</td><td><b><?php echo $ip; ?></b></td><td>The numerical address of your computer</td></tr>
  <tr><td>Port</td><td><b><?php echo $port; ?></b></td><td>The virtual port from which you sent your request</td></tr>
  <tr><td>Request URI</td><td><b><?php echo $reqeust; ?></b></td><td>The page you requsted</td></tr>
  </td></tr>
</table><br />
<table><tr><td><form action="client.php" method="GET"><input type="submit" value="Use the GET method" /></form></td><td><form action="client.php" method="POST"><input type="submit" value="Use the POST method" /></form>
</td></tr></table><br />
Technical: This page uses selective parts of the PHP $_SERVER array. See <a href="http://www.php.net/manual/en/reserved.variables.server.php">http://www.php.net/manual/en/reserved.variables.server.php</a>.
</body>
</html>