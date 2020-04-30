<div id="title">RANKING</div>
	<div id="content">
	
		<?php
		

		
		
		
	$type = $_GET['ranking'];
	if($type=='char'){
	
	echo '<div id="news-title">Top Char</div>
	

	<table width="100%" border="0">
	<tr bgcolor="#617798">
	<th>No.</th>	<th>Name</th>	<th>Level</th>	<th>Exp</th>	<th>Sp</th>
	<tr>
	';
	
					$players = odbc_exec($connectshard, "SELECT TOP 20 CharName16, RemainSkillPoint, MaxLevel, ExpOffSet
									   FROM [dbo].[_Char]
									   ORDER BY MaxLevel DESC, ExpOffSet DESC, RemainSkillPoint DESC, CurLevel DESC");
		
		
	
	
		$i = 1;
		while($prank = odbc_fetch_array($players)):
			echo '<tr bgcolor="#dfdfdf"> 
					<td style="text-align:center;"><font size="2">'.$i.'&ordm;</font></td>
					<td><font size="2">'.$prank['CharName16'].'</font></td>
					<td style="text-align:center;"><font size="2">'.$prank['MaxLevel'].'</font></td>
					<td><font size="2">'.$prank['ExpOffSet'].'</font></td>
					<td><font size="2">'.$prank['RemainSkillPoint'].'</font></td>
				  </tr>';
			$i++;
		endwhile;
	echo "</table>";
	
	}else if($type=='job'){
	echo '<div id="news-title">Top Job</div>
	
	<table width="100%" border="0">
	<tr bgcolor="#617798">
	<th>No.</th>	<th>Name</th>	<th>Level</th>	<th>Exp</th>
	<tr>
	
	';
					$players = odbc_exec($connectshard, "SELECT TOP 20 c.CharID, c.CharName16, c.NickName16, c.RemainSkillPoint, c.MaxLevel, c.ExpOffSet, j.Level, j.Exp, j.Contribution
									   FROM [dbo].[_Char] as c
									   LEFT JOIN [dbo].[_CharTrijob] as j
									   ON c.CharID = j.CharID
									   ORDER BY j.Level DESC, j.Exp DESC");
		
		
		
		$i = 1;
	
	while($prank = odbc_fetch_array($players)):
			echo '<tr bgcolor="#dfdfdf"> 
					<td style="text-align:center;"><font size="2">'.$i.'&ordm;</font></td>
					<td><font size="2">'.$prank['CharName16'].'</font></td>
					<td style="text-align:center;"><font size="2">'.$prank['Level'].'</font></td>
					<td style="text-align:center;"><font size="2">'.$prank['Exp'].'</font></td>
				  </tr>';
			$i++;
		endwhile;
	
		echo "</table>";
	
	}else if($type=='unique'){
	echo '<div id="news-title">Top Unique Killers</div>';
	}else{
	echo "no select";
	
	}
	
	
	
	
	
	
	
	
	
	?>
	

	</div>
	
	
