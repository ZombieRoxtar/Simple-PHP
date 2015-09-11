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
				for ($i=0;$i<$tags->length;$i++)
				{
					echo "<tr>\n";
					echo "<td>$i</td>\n";
					echo "<td>";
					$src=$tags->item($i)->getAttribute('src');
					echo "<a href='$src'>\n";
					echo "<img src='$src'><br />\n";
					echo "$src</a>\n";
					echo "</td></tr>\n";
				}
			?>
		</table>
	</body>
</html>
