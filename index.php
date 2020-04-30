<?php
ob_start();
session_start();
	//error_reporting(0);
	include("mod/inc/config.php");
	include("mod/inc/connect.php");

	
?>

	<head>
	
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<link rel="shortcut icon" href="favicon.png" type="image/x-icon" />
		<meta name="description" content="desc" />
		<meta name="keywords" content="Silkroad,Silkroad fun server,silkroad server,silkroad pserver, silkroad emulator, silkroad fun, silkroad hack, silkroad gold, free gold, free silkroad gold, silkroad online, silkroad funserver, sro, ISRO, pSRO" />
		<title><?php echo $webtitle ?> </title>
		<link rel="stylesheet" type="text/css" href="template/style.css" />
	</head>
<body> 	
	<div id="top">
	<div id="logo"></div>
	
	<div id='right'>
	<div id='cssmenu'>
<ul>
   <li><a href='?news'><span>News</span></a></li>
      <?php if(!isset($_SESSION['loggedin'])){ echo "<li><a href='?register'><span>Register</span></a></li>"; }?>
	<li><a href='?download'><span>Download</span></a></li>
   <li class='active has-sub'><a href='#'><span>Ranking</span></a>
      <ul>
         <li><a href='?ranking=char'><span>Top Char</span></a>
         </li>
         <li><a href='?ranking=job'><span>Top Job</span></a>
         </li>
      </ul>
   </li>
   <li><a href='#'><span>Forum</span></a></li>
   <li class='last'><a href='?contact'><span>Contact</span></a></li>
 
</ul>

		</div>	
		<div id="panel">
			<?php include('mod/login.php'); ?>
		</div>
	</div>

	<div id="info">
	<div id="info-title">Server Info</div>
	<div id="info-bar">Status:
	
	<?php $Status = @fsockopen($ServerIP, $ServerPort, $errno, $errstr, 0.3);

if($Status) { $Status = "<span style='color:#4D9C00;'>Online</span>"; }
else { $Status = "<span style='color:#e90000;'>Offline</span>"; }
echo "
		$Status<br/>
";


 ?>		
</div> 
	<?php
	
	$online = odbc_exec($connectacc, "SELECT top 1 * FROM _ShardCurrentUser WHERE nShardID = 64 ORDER BY nID desc");
    while ($online2 = odbc_fetch_array($online)):
        echo '<div id="info-bar">Players: <span style="color:#4D9C00;">'.$online2['nUserCount'].'</span> / <span style="color:#4D9C00;">'.$slot.'</span></div> ';
       	endwhile; 
	   ?>
	
	<div id="info-title">Fortress</div>
	<div id="info-bar">
<?php
	
	$janganFW = odbc_exec($connectshard, "select GuildID,TaxRatio from _SiegeFortress where FortressID = 1");
	while ($row = odbc_fetch_array($janganFW)) {
		$janganID = $row['GuildID'];
		$janganTax = $row['TaxRatio'];
	}
	
	$banditFW = odbc_exec($connectshard, "select GuildID,TaxRatio from _SiegeFortress where FortressID = 6");
	while ($row = odbc_fetch_array($banditFW)) {
		$banditID = $row['GuildID'];
		$banditTax = $row['TaxRatio'];
	}
	
	$hotanFW = odbc_exec($connectshard, "select GuildID,TaxRatio from _SiegeFortress where FortressID = 3");
	while ($row = odbc_fetch_array($hotanFW)) {
		$hotanID = $row['GuildID'];
		$hotanTax = $row['TaxRatio'];
	}

	$jangan = odbc_exec($connectshard, "select Name from _Guild where ID = '$janganID'");
	while ($row = odbc_fetch_array($jangan)) {
		$janganOwner = $row['Name'];
	}
	
	
	$bandit = odbc_exec($connectshard, "select Name from _Guild where ID = '$banditID'");
	while ($row = odbc_fetch_array($bandit)) {
		$banditOwner = $row['Name'];
	}
	
	$hotan = odbc_exec($connectshard, "select Name from _Guild where ID = '$hotanID'");
	while ($row = odbc_fetch_array($hotan)) {
		$hotanOwner = $row['Name'];
	}
	
	
	print "<img style='vertical-align:middle;' src='template/fort-hotan.png' /> <span style='color:#FF2700;font-size:13px;'>Hotan fortress:</span><br />$hotanOwner <span style='color:#FF2700;font-size:13px;'>Tax:</span>  $hotanTax%<br /><br />";
	print "	<img style='vertical-align:middle;' src='template/fort-jangan.png' /> <span style='color:#FF2700;font-size:13px;'>Jangan fortress:</span><br />$janganOwner <span style='color:#FF2700;font-size:13px;'>Tax:</span>  $janganTax%<br /><br />";
	print "	<img style='vertical-align:middle;' src='template/fort-bandit.png' /> <span style='color:#FF2700;font-size:13px;'>Bandit fortress:</span><br />$banditOwner <span style='color:#FF2700;font-size:13px;'>Tax:</span> $banditTax%<br /><br />";

	?>
	

	
	
	</div> 
	
	</div>
	<div id="board">
	
	<?php include("page.php"); ?>
	
	
	

	</div>
	<div id="bottom" align="center"><font size="2" color="grey">Deja45Vu&reg  2013</font></div>
</div>

</body>