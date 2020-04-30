

<div id="title">DOWNLOAD</div>
	<div id="content">
	

			<table width="100%" border="0px">
<tr>
	<th bgcolor="#dcdcdc">File Name</th>	<th bgcolor="#dcdcdc">Description</th>	<th bgcolor="#dcdcdc">Link</th>
</tr>



	<?php

$row = odbc_exec($connectacc, "select * from websro_download");

		while($row2 = odbc_fetch_array($row)):
		
		echo '
		
		<tr>
	<td width="30%"><font size="1">'.$row2['FileName'].'</font></td>	<td width="50%"><font size="1">'.$row2['Description'].'</font></td>	<td width="20%"><font size="1"><a href="'.$row2['Link'].'"><center><img src="template/download.png" /></center></a></font></td>
</tr>
		
	
	
		
		
		
		';
		endwhile;
		odbc_close($connectacc);
		
		

?>		
	
	</table>
	</div>
	
	

	
	

