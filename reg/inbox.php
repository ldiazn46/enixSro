<div id="title">Inbox</div>
	<div id="content">
	
	
	<?php



	
	if(!isset($_SESSION['loggedin'])) {
		header("location:?news");
	}If($_GET['read'] >'0'){
	
	
		
		$id = anti_injection($_GET['read']);
	$row = odbc_fetch_array(odbc_exec($connectacc, "select * from dbo.websro_inbox Where ID = $id"));
	
	
		echo "<div id='mess'>
		<div class='head'><a href='?inbox'><img src='template/back.png'/></a></div>
		<div class='head2'><a href='?inbox&del=".$row['ID']."'><img src='template/del.png'/></a></div>
		<div class='head2'><a href='?inbox&action=send&user=".$row['SendBy']."&title=Re: ".$row['Title']."'><img src='template/reply.png'/></a></div>
		</div>";
		
	
	
	
	echo "<div id='message'>
	
	<div class='bar'>Send By </div> <div class='bar2'>".$row['SendBy']."</div>
	<div class='bar'>Title</div> <div class='bar2'>".$row['Title']."</div>
	<div class='bar'>Content</div> <div class='cont'>".$row['Cont']."</div>
	
	
	
</div>";
		
		odbc_exec($connectacc, "UPDATE dbo.websro_inbox SET Seen = 1 Where ID = $id");
		
		}else if($_GET['del'] >'0') {

	$IDtoDel = anti_injection($_GET['del']);
	
	$del = odbc_exec($connectacc, "DELETE FROM dbo.websro_inbox where ID = '$IDtoDel'");
	if($del){ 	header("location:?inbox"); };
	}else if($_GET['action'] == "send") {
	
	
	
	If (isset($_POST["sendb"])){
	$title 		= anti_injection($_POST["titl"]);
	$cont 		= anti_injection($_POST["cont"]);
	$to 		= anti_injection($_POST["to"]);
	$captcha	= anti_injection($_POST["captcha"]);
	$userID		= $_SESSION['nick'];
	$today = date('Y-m-d H:i:s');
	
	If($title == "" || $cont  == "" || $to == "" ){
	echo "<div class='error'>Please fill all fields</div>";
	}else if(odbc_num_rows(odbc_exec($connectacc, "SELECT * FROM dbo.TB_User WHERE Name = '$to'")) == "0"){
	echo "<div class='error'>There is no such user.</div>";
	}else if (trim(strtolower($_SESSION['captcha'])) != $_POST["captcha"]) {
			echo "<div class='error'>Invalid captcha.</div>";	
	}else if(strlen($title) > "50"){
	echo "<div class='error'>Title is too long.</div>";
	}else if(strlen($cont) > "250"){
	echo "<div class='error'>Message is too long.</div>";
	}else{
	$add = odbc_exec($connectacc, "INSERT INTO dbo.websro_inbox(Username, SendBy, Title, Cont, Date, Seen) VALUES ('$to','$userID','$title','$cont', '$today', '0')");
	If($add){
	echo "<div class='ok'>Your message has been sent successfully.</div>";
	}else{
	
	echo "<div class='error'>error.</div>";
	}
	}
	}

	echo'
	
	<div id="mess">
		<div class="head"><a href="?inbox"><img src="template/back.png"/></a></div>
		</div>
	
		<form action="" method="post">  
		  <table>
	  <tr>
	<td align="center" colspan="2"></td>
	</tr>  <tr>
	
	
	
	</tr>
		  
	  <tr>
	<td>User</td><td colspan="2"><input type="text" name="to" id="to" value="'.$_GET['user'].'" maxlength="40" style="width:330px;"/></td>
	</tr>	  
		  <tr>
	<td>Title</td><td colspan="2"><input type="text" name="titl" id="titl"  maxlength="40" style="width:330px;" value="'.$_GET['title'].'" /></td>
	</tr><tr>
	<td>Content</td><td colspan="2"><textarea type="text" name="cont" id="cont"  maxlength="250"  style="width:330px;"/></textarea></td>
	</tr><tr>
	<td>Capatcha</td><td><input type="text" name="captcha" id="captcha" /> </td><td ><img src="mod/captcha/captcha.php" id="captcha" /></td>
	</tr>
	<tr>
	<td></td>	<td></td>	<td><a href="" onclick="
    document.getElementById("captcha").src="mod/captcha/captcha.php?"+Math.random();
    document.getElementById("captcha-form").focus();"
    id="change-image"><font color="grey">Refresh captcha.</font></a></td>
</tr>
	<tr>
	<td></td><td colspan="2"><p class="submit"><input type="submit" name="sendb" value="Send" /></p> </td>
	
	</tr>
	</table>
	</form>
	
	';
	
	}else if($_GET['action'] == "sent") {
	$userID = $_SESSION['nick'];
	$row = odbc_exec($connectacc, "select * from dbo.websro_inbox where SendBy='$userID' order by Date desc");
echo "<div class='head2'><a href='?inbox&action=send'><img src='template/reply.png'/></a><a href='?inbox&action=sent' style='font-size:14px'>Sent Messages</a><a href='?inbox'>Received Messages</a></div><br />";

	echo "<table class='mlist'><table class='mlist'>
	<tr>
	<td class='tw' style='width:50%;'>Title</td>	<td class='tw' style='width:20%;'>Send To</td>	<td class='tw'  style='width:18%;'>Date</td>
	</tr>
	</table>
	";
		
		while($row2 = odbc_fetch_array($row)):
		
	If(strlen($row2['Title']) > 30){
	$Title = substr($row2['Title'],0,-20);
	}else{
	$Title = $row2['Title'];
	}
	echo "<div class='mlist'>
	<table class='mlist'>
	<tr>
	<td class='tw' style='width:50%;'><a href=?inbox&read=".$row2['ID']." style='color:black;text-decoration:none'>".$Title."</a></td>

	<td class='tw' style='width:20%;'>".$row2['Username']."</td>
	<td class='tw' style='width:18%;font-size:8px;'>".substr($row2['Date'],0,-7)."</td>";
		endwhile;
		echo '	</tr></table></div>';
		odbc_close($connectacc);

	}else {
		
		
		
	
	$userID = $_SESSION['nick'];
	$row = odbc_exec($connectacc, "select * from dbo.websro_inbox where Username='$userID' order by Date desc");
	
echo "<div class='head2'><a href='?inbox&action=send'><img src='template/reply.png'/></a><a href='?inbox&action=sent'>Sent Messages</a><a href='?inbox' style='font-size:14px'>Received Messages</a></div><br />";
	echo "<table class='mlist'><table class='mlist'>
	<tr>
	<td class='tw' style='width:50%;'>Title</td>	<td class='tw' style='width:20%;'>Sent By</td>	<td class='tw'  style='width:18%;'>Date</td>
	</tr>
	</table>
	";
		while($row2 = odbc_fetch_array($row)):
		
	If(strlen($row2['Title']) > 30){
	$Title = substr($row2['Title'],0,-20);
	}else{
	$Title = $row2['Title'];
	}

	
	
	
echo "<div class='mlist'>
	<table class='mlist'>
	<tr>
	<td class='tw' style='width:50%;'><a href=?inbox&read=".$row2['ID']." style='color:black;text-decoration:none'>".$Title."</a></td>

	<td class='tw' style='width:20%;'>".$row2['SendBy']."</td>
	<td class='tw' style='width:18%;font-size:8px;'>".substr($row2['Date'],0,-7)."</td>";
		endwhile;
		echo '	</tr></table></div>';
		odbc_close($connectacc);

	
	
	
	}
	
?>
		</div>