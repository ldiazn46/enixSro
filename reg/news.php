<div id="title">NEWS</div>
	<div id="content">
	
	<?php
		function BBCode($contents){
			$tekst = nl2br($contents);
			$tekst = htmlspecialchars($contents);

		return($contents);
			}
	
					$news = odbc_exec($connectacc, "SELECT TOP 5 Title, Cont, Date, Author
									   FROM [dbo].[websro_news]
									   ORDER BY Date DESC");
									   
			while($row = odbc_fetch_array($news)):
			

			
			
$contents = $row['Cont'];
$contents = preg_replace("/\[br\]/is",'<br />',$contents);			  
$contents = preg_replace("#\[b\](.*?)\[/b\]#si",'<b>\\1</b>',$contents);
$contents = preg_replace("#\[i\](.*?)\[/i\]#si",'<i>\\1</i>',$contents);
$contents = preg_replace("#\[u\](.*?)\[/u\]#si",'<u>\\1</u>',$contents);
$contents = preg_replace("#\[s\](.*?)\[/s\]#si",'<s>\\1</s>',$contents);
$contents = preg_replace("/\[color\=(.*?)\](.*?)\[\/color\]/is",'<span style="color: $1;">$2</span>', $contents);
$contents = preg_replace("/\[size\=(.*?)\](.*?)\[\/size\]/is", '<span style="font-size: $1;">$2</span>', $contents);
$contents = preg_replace("/\[font\=(.*?)\](.*?)\[\/font\]/is", '<span style="font-family: $1;">$2</span>', $contents);
$contents = preg_replace("/\[img\](.*?)\[\/img\]/is", '<img src="$1" alt="" />', $contents);
$contents = preg_replace("/\[url\=(.*?)\](.*?)\[\/url\]/is", '<a href="$1" rel="nofollow" title="$2 - $1">$2</a>', $contents);
$contents = preg_replace("/\[url\](.*?)\[\/url\]/is", '<a href="$1" rel="nofollow" title="$1">$1</a>', $contents);
$contents = preg_replace("/\[align\=(left|center|right)\](.*?)\[\/align\]/is", '<div style="text-align: $1;">$2</div>', $contents);
		echo'
		
		
		
		
		
		
		<div id="news-title">'.$row['Title'].'</div>
	
	
	
	
		'. BBCode($contents).'
		<div id="news-date">Added '. substr($row['Date'],0,-12).' by: '.$row['Author'].'</div>
		';
		
		endwhile;
		
	?>


	
	</div>