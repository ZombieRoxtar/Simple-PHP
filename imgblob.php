<html>
	<head>
		<title>Images</title>
		<style>
		img
		{
			display: block;
			margin-left: auto;
			margin-right: auto;
    }
		</style>
	</head>
	<body>
		<?php
			$url="http://imgur.com/";
			if(isset($_GET['url']))
			{
				$urltest=$_GET['url'];
				if(substr(strtolower($urltest),0,4) == 'http')
				{
					$url=$urltest;
				}
			}
			@$html=file_get_contents($url);
			$doc=new DOMDocument();
			@$doc->loadHTML($html);
			$tags=$doc->getElementsByTagName('img');
			echo "<a href='$url'>$url</a>";
		?>
		<br />
		<table border>
			<?php
				$doOnce=true;
				for ($i=0;$i<$tags->length;$i++)
				{
					echo "<tr>\n";
					echo "<td>$i</td>\n";
					echo "<td>";
					$src=$tags->item($i)->getAttribute('src');
					if(substr(strtolower($src),0,4) != 'http')
					{
						if($doOnce)
						{
							/* I need only the protocol/host portion for these pesky URLs */
							$firstDir=strpos($url,'/',8);
							$host=substr($url,0,$firstDir);
							if($host == '')
							{
								$host=$url;
							}
							$doOnce=false;
						}
						/* If I'm to append HTTP://whatever then a leading / is needed */
						if(substr(strtolower($src),0,1) != '/')
						{
							$prepend='/';
							/* Do I need to prepend a directory from the main URL? */
							$lastslash=strrpos($url,'/');
							if($lastslash===strlen($url)-1)
								$lastslash=strrpos($url,'/',-2);
							if($lastslash!==strpos($url,'/',strpos($url,'/')+1))
							{
								$prepend.=substr($url,$firstDir,$lastslash).'/';
							}
							$src=$prepend.$src;
							/* That whole thing feels hacky and sometimes I get doulbe slashes,
								but the browser doesn't to mind and those could be cleaned here */
						}
						$src=$host.$src;
					}
					echo "<a href='$src'>\n";
					echo "<img src='$src'><br />\n";
					echo "$src</a>\n";
					echo "</td></tr>\n";
				}
			?>
		</table>
	</body>
</html>
