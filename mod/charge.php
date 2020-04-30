<div id="title">CHARGE SILK</div>
	<div id="content">
<?php
$page = $_GET['charge'];
if($page==''){
	
	


	?>

	<small>Select the method:</small>
	<table>
	
	<td><a href="?charge=epin"><img src="template/epin.png"/></a></td>	<td><a href="?charge=paypal"><img src="template/paypal.png"/></a></td>
	</table>

	

	

	
<?php

	}
	else if($page=='epin'){
		$userID = $_SESSION['name'];
	
	if(isset($_POST["charge"])){
	$code	= anti_injection($_POST["code"]);
		$codequery = odbc_exec($connectacc, "SELECT * FROM dbo.websro_epin WHERE Code = '$code'");
		$codequery2 = odbc_fetch_array($codequery);

		
		if($code == "" || $code == "xxxx-xxxx-xxxx-xxxx"){
			echo "<div class='error'>Please fill all fields.</div>";
		}else if (odbc_num_rows($codequery) == "0" || $codequery2['Available'] == "0"){
		echo "<div class='error'>Epin code is wrong.</div>";
		}else{
		
		$query = odbc_fetch_array(odbc_exec($connectacc, "SELECT * FROM dbo.websro_epin WHERE Code = '$code'"));
		$user = odbc_fetch_array(odbc_exec($connectacc, "SELECT JID FROM dbo.TB_User WHERE StrUserID = '$userID'"));
		$JID = $user['JID']; 
		$type = $query['Type'];
		$value = $query['Value'];
		$today = date("Y-m-d H:i:s"); 
		If($type = "Silk"){
		
		
		
		 $update = odbc_exec($connectacc, "UPDATE dbo.websro_epin SET Available = 0 Where Code = '$code'");
		 If ($update){
		 odbc_exec($connectacc, "DELETE FROM dbo.websro_epin WHERE Code = '$code'");
		 odbc_exec($connectacc, "INSERT INTO dbo.websro_epin_history(Code,Value,Type,UserID,Date)VALUES('$code','$value','$type','$userID','$today')");
		
		 $check = odbc_exec($connectacc, "select * from SK_Silk where JID = '$JID'");
		if (odbc_num_rows($check) == 1) {
		
						$getCurrSilks = odbc_exec($connectacc, "select * from SK_Silk where JID = '$JID'");
					while ($silks = odbc_fetch_array($getCurrSilks)) {
						$silk_own = $silks['silk_own'];
						$silk_gift = $silks['silk_gift'];
						$silk_point = $silks['silk_point'];
					}
		$silkupdate = $value + $silk_own;			
		$updatesilk = odbc_exec($connectacc,"UPDATE dbo.SK_Silk set silk_own = '$silkupdate' where JID = '$JID'");
		
		
		}else{
		 
		 
		 $addsilk = odbc_exec($connectacc, "INSERT INTO dbo.SK_Silk(JID,silk_own,silk_gift,silk_point)VALUES('$JID','$value','0','0')");
		 }
		 If($updatesilk or $addsilk){
		 echo "<div class='ok'>".$value." Silks been recharged to your account</div>";
		 }
		 }
		 
		 
		 
		 
		}else if($type = "Gold"){
		echo "COMMING SOON xD";
		}else if($type = "SP"){
		echo "COMMING SOON xD";
		}
		

		
		
		}
			
	}
	
	
	
?>
	<form action="" method="POST">
<table>
<tr>
	<td><font size="1" color="grey">Your Epin Code</font></td>	<td><input type="text" name="code" id="code" style="width:300px"  /> </td> 	
</tr>
<tr>
	<td></td>	<td align="right"><p class="submit">   <input type="submit" name="charge" value="Charge" />   </td>	
</tr>	
	
		</table>
	
	
	</form>


	<?php
	

	
	
	}else if($page=='paypal'){
	echo "paypal";
	}
	
	
	


?>	
	
		</div>