	<div id="title">ADMIN PANEL</div>
	<div id="content">

<?php
	$userID = $_SESSION['name'];
	$admin = odbc_num_rows(odbc_exec($connectacc, "select * from TB_User where StrUserID = '$userID' AND sec_content = '1'"));				
	If($admin == 0){
	header("location:?news");
}else{	


	$page = $_GET['admin'];
	if($page==''){
	?>
<table>
<tr>
<td><a href="?admin=epin"><img src="template/epin.png"/></a></td><td><a href="?admin=news"><img src="template/news.png"/></a></td>
</tr>
<tr>
<td><a href="?admin=download"><img src="template/downloadb.png"/></a></td><td><a href="?admin=logs"><img src="template/logs.png"/></a></td>
</tr>
<tr>
<td><a href="?admin=support"><img src="template/support.png"/></a></td></td>
</tr>
</table>
	<?php
	}
	$page = $_GET['admin'];
	if($page=='epin'){
	
	If (isset($_POST["generate"])){
	
	$value 		= anti_injection($_POST["silks"]);
	$quantity 		= anti_injection($_POST["quantity"]);
		
	If($value == "" || $quantity == ""){
	echo "<div class='error'>Please fill all fields</div>";
	}else if($value > 2000){
	echo "<div class='error'>Silks amount is 2000 maximum</div>";
	}else if($quantity > 1000){
	echo "<div class='error'>Quantity is 1000 maximum</div>";
	}else{
		echo "Its epin codes for <b>".$value." </b>silks. <u><font color='red'>Write it!</font></u>";
	for($i=0;$i<$quantity;$i++)
{
		$random = chr(rand(65,90)) . rand(0,9) . rand(0,9) . chr(rand(65,90)) ."-". rand(0,9) . chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90)) ."-". chr(rand(65,90)) . rand(0,9) . rand(0,9) . chr(rand(65,90)) ."-". chr(rand(65,90)) . rand(0,9) . rand(0,9) . chr(rand(65,90)) ; 
echo "<p>".$random."";

odbc_exec($connectacc, "INSERT INTO dbo.websro_epin(Code, Value, Type, Available) VALUES ('$random','$value','1','1')");



		}
	}
	}
	
	?>
	
	
	
	<p>Here you can generate epin code.	</p>
		  <form action="" method="post">  
		  <table  width='100%'>
		  <tr>
	<td>Silks amount</td><td><input type="text" name="silks" id="silks"  /></td>
	</tr><tr>
	<td>Quantity</td><td><input type="text" name="quantity" id="quantity"  /></td>
	</tr><tr>
	<td></td><td><p class="submit"><input type="submit" name="generate" value="Generate" /></p> </td>
	</tr>
	</table>
	</form>
	
	<?php
	}else if($page=='download'){
	
	$row = odbc_exec($connectacc, "select * from websro_download");
echo '<table width="100%" border="0px">';
		while($row2 = odbc_fetch_array($row)):
		
		echo '
			

		<tr>
	<td width="30%"><font size="1">'.$row2['FileName'].'</font></td>	<td width="50%"><font size="1">'.$row2['Description'].'</font></td>	<td width="20%"><font size="1"><a href="?admin=download&action=del&title='.$row2['FileName'].'&desc='.$row2['Description'].'"><center><img src="template/del.png" /></center></a></font></td>
</tr>
		';
		endwhile;
		echo '	</table>';
		odbc_close($connectacc);
	
	If($_GET['action'] == "del"){
	$delt 		= anti_injection($_GET['title']);
	$deld 		= anti_injection($_GET['desc']);
	

	$del = odbc_exec($connectacc, "DELETE FROM dbo.websro_download WHERE FileName = '$delt' AND Description = '$deld'");
	If($del){
	header("location:?admin=download");
	
	}
	
	
	}
	
	
	
		If (isset($_POST["add"])){
	$title 		= anti_injection($_POST["titl"]);
	$desc 		= anti_injection($_POST["desc"]);
	$link		= anti_injection($_POST["link"]);
	If($title == "" || $desc == "" || $link == ""){
	echo "<div class='error'>Please fill all fields</div>";
	}else if(strlen($title) > "24"){
	echo "<div class='error'>Title is too long./div>";
	}else if(strlen($desc) > "32"){
	echo "<div class='error'>Desc is too long.</div>";
	}else{
	$add = odbc_exec($connectacc, "INSERT INTO dbo.websro_download(FileName, Description, Link) VALUES ('$title','$desc','$link')");
	If($add){
	header("location:?admin=download");
	}else{
	
	echo "<div class='error'>error.</div>";
	}
	}
	}
?>
<form action="" method="post">  
		  <table >
	  <tr>
	<td align="center" colspan="2">Add New File</td>
	</tr>
		  
		  <tr>
	<td>Title</td><td><input type="text" name="titl" id="titl" maxlength="24" style="width:350px;"/></td>
	</tr><tr>
	<td>Desc</td><td><input type="text" name="desc" id="desc" maxlength="32" style="width:350px;"/></td>
	</tr><tr>
	<td>Link</td><td><input type="text" name="link" id="link" style="width:350px;"/> </td>
	</tr><tr>
	<td></td><td><p class="submit"><input type="submit" name="add" value="Add" /></p> </td>
	</tr>
	</table>
	</form>


<?php
	}else if($page=='news'){
	
	
	$row = odbc_exec($connectacc, "select * from dbo.websro_news order by Date desc");
echo '<table width="100%" border="0px">';
		while($row2 = odbc_fetch_array($row)):
		
		echo '
			

		<tr>
	<td width="30%"><font size="1">'.$row2['ID'].'</font></td> <td width="30%"><font size="1">'.$row2['Title'].'</font></td> 	<td width="20%"><font size="1"><a href="?admin=news&action=del&id='.$row2['ID'].'"><center><img src="template/del.png" /></center></a></font></td>
</tr>
		';
		endwhile;
		echo '	</table>';
		odbc_close($connectacc);
	
	If($_GET['action'] == "del"){
	$delid 		= anti_injection($_GET['id']);

	

	$del = odbc_exec($connectacc, "DELETE FROM dbo.websro_news WHERE ID = '$delid'");
	If($del){
	header("location:?admin=news");
	
	}
	
	
	}
	
	
	
	
	
	If (isset($_POST["add"])){
	$title 		= anti_injection($_POST["titl"]);
	$cont 		= anti_injection($_POST["cont"]);
	$author		= anti_injection($_POST["author"]);
	$today = date('Y-m-d H:i:s');
	
	If($title == "" || $cont  == "" || $author == ""){
	echo "<div class='error'>Please fill all fields</div>";
	}else if(strlen($title) > "50"){
	echo "<div class='error'>Title is too long./div>";
	}else if(strlen($author) > "30"){
	echo "<div class='error'>Author is too long.</div>";
	}else{
	$add = odbc_exec($connectacc, "INSERT INTO dbo.websro_news(Title, Cont, Date, Author) VALUES ('$title','$cont','$today','$author')");
	If($add){
	header("location:?admin=news");
	}else{
	
	echo "<div class='error'>error.</div>";
	}
	}
	}
	



?>	
<form action="" method="post">  
		  <table >
	  <tr>
	<td align="center" colspan="2">Add News</td>
	</tr>
		  
		  <tr>
	<td>Title</td><td><input type="text" name="titl" id="titl" maxlength="50" style="width:350px;"/></td>
	</tr><tr>
	<td>Content</td><td><textarea type="text" name="cont" id="cont"  style="width:350px;"/></textarea></td>
	</tr><tr>
	<td colspan="2" align="right"><font size="1" color="gray">You can use BB codes.</td>
	</tr><tr>
	<td>Author</td><td><input type="text" name="author" id="author"  maxlength="30"  style="width:100px;"/> </td>
	</tr><tr>
	<td></td><td><p class="submit"><input type="submit" name="add" value="Add" /></p> </td>
	</tr>
	</table>
	</form>


<?php
	}else if($page=='logs'){
	

	$row = odbc_exec($connectacc, "select top 50 * from dbo.websro_epin_history order by Date desc");
echo '<table class="mlist" width="100%" border="1px" style="border-collapse: collapse;" ><tr><th width="50%">Code</th><th>Value</th><th>Used By</th><th>Date</th></tr>';
		while($row2 = odbc_fetch_array($row)):
		
		echo '
			

		<tr>
	<td class="tw" width="50%"><font size="1">'.$row2['Code'].'</font></td> <td class="tw" width="30%"><font size="1">'.$row2['Value'].'</font></td> 	<td class="tw" width="30%"><font size="1">'.$row2['UserID'].'</font></td> 	<td class="tw" width="30%"><font size="1">'.substr($row2['Date'],0,-4).'</font></td> 	
</tr>
		';
		endwhile;
		echo '	</table>';
		odbc_close($connectacc);
	

	}else if($page=='support'){
	function type($Type){
		$search  = array(1,2,3,4,5);
		$replace = array('Website', 'Game Acount', 'Bugs', 'Question to administration', 'Other');
		return $Type = str_replace($search, $replace, $Type);
		
		}
	if($_GET['read'] >'0'){
	$id = anti_injection($_GET['read']);
	$row = odbc_fetch_array(odbc_exec($connectacc, "select * from dbo.websro_support Where ID = $id"));
		echo "<div id='mess'>
		<div class='head'><a href='?admin=support'><img src='template/back.png'/></a></div>
		<div class='head2'><a href='?admin=support&del=".$row['ID']."'><img src='template/del.png'/></a></div>
		<div class='head2'><a href='?inbox&action=send&user=".$row['Sendby']."&title=Re: ".$row['Title']."'><img src='template/reply.png'/></a></div>
		</div>";
	
	
	
	echo "<div id='message'>
	
	<div class='bar'>Type </div> <div class='bar2'>".type($row['Type'])."</div>
	<div class='bar'>Send By </div> <div class='bar2'>".$row['Sendby']."</div>
	<div class='bar'>Title</div> <div class='bar2'>".$row['Title']."</div>
	<div class='bar'>Content</div> <div class='cont'>".$row['Cont']."</div>
	
	
	
</div>";
	

	}else if($_GET['del'] >'0') {
	$IDtoDel = anti_injection($_GET['del']);
	
	$del = odbc_exec($connectacc, "DELETE FROM dbo.websro_support where ID = '$IDtoDel'");
	if($del){ 	header("location:?admin=support"); };
	}else{
	
	
	
	$row = odbc_exec($connectacc, "select top 50 * from dbo.websro_support order by Date desc");
echo '';
		while($row2 = odbc_fetch_array($row)):
		
		$Type = type($row2['Type']);	
	If(strlen($row2['Title']) > 30){
	$Title = substr($row2['Title'],0,-20);
	}else{
	$Title = $row2['Title'];
	}


	
echo "<div class='mlist'>
	<table class='mlist'>
	<tr>
	<td class='tw' style='width:20%;'>".$Type."</td>
	<td class='tw'style='width:40%;'><a href=?admin=support&read=".$row2['ID']." style='color:black;text-decoration:none'>".$Title."</a></td>
	<td class='tw' style='width:20%;'>".$row2['Sendby']."</td>
	<td class='tw' style='width:18%;font-size:8px;'>".substr($row2['Date'],0,-7)."</td>";
		endwhile;
		echo '	</tr></table></div>';
		odbc_close($connectacc);
	echo   "<table>";

echo"
<tr>
<td> </td>
</tr>
";
		echo 	"</table>";
	}
}
	
	
	}
?>



</div>


