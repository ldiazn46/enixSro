	
	
	
	<?php

	
	
	$online = odbc_exec($connectacc, "SELECT top 1 * FROM _ShardCurrentUser WHERE nShardID = 64 ORDER BY nID desc");
    while ($online2 = odbc_fetch_array($online)):
        echo '<div id="info-bar">Players: <span style="color:#4D9C00;">'.$online2['nUserCount'].'</span> / <span style="color:#4D9C00;">1000</span></div> ';
       	endwhile; 
	   ?>