
<div id="title">Change Password</div>
	<div id="content">
	
	
	<?php
	session_start();


	
	if(!isset($_SESSION['loggedin'])) {
		header("location:?news");
	} else {

							if(isset($_POST["submit"])){
							$userID = $_SESSION['name'];
							$oldpassword	= anti_injection($_POST["oldpassword"]);
							$newpassword	= anti_injection($_POST["newpassword"]);
							$newpassword2	= anti_injection($_POST["newpassword2"]);
							$encrypt	= md5($newpassword);
							$oldencrypt = md5($oldpassword);
							$email		= anti_injection($_POST["email"]);
							$passwordcheck	= odbc_num_rows(odbc_exec($connectacc, "SELECT * FROM dbo.TB_User WHERE StrUserID = '$userID' AND password = '$oldencrypt'"));
							$emailcheck	= odbc_num_rows(odbc_exec($connectacc, "SELECT * FROM dbo.TB_User WHERE StrUserID = '$userID' AND email = '$email'"));
	
							
							
	if($oldpassword == "" || $newpassword == "" || $newpassword2 == "" || $email == ""){
		echo "<div class='error'>Please fill all fields</div>";
	}else if ($newpassword != $newpassword2) {
		echo "<div class='error'>Password does not match!</div>";
	}else if(!ctype_alnum($oldpassword) || !ctype_alnum($newpassword)){
	echo "<div class='error'>Sould be Characters and Numbers only.</div>";
	}else if (strlen($newpassword) <= "3" || strlen($newpassword) >= "21") {
		echo "<div class='error'>Password should be between 4 and 21 characters</div>";
	}else if (strlen($newpassword2) <= "3" || strlen($newpassword2) >= "21") {
		echo "<div class='error'>Password should be between 4 and 21 characters</div>";
	}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
		echo "<div class='error'>Email is not valid!</div>";
	} else if($passwordcheck == "0"){
		echo "<div class='error'>Current Password is incorrect!</div>";
	} else if($emailcheck == "0"){
		echo "<div class='error'>Email is incorrect!</div>";
	} else {		
								if(odbc_exec($connectacc, "UPDATE dbo.TB_User SET password = '$encrypt' WHERE StrUserID = '$userID'"))
								{
									echo "<div class='ok'>Password is changed successful!</div>";
								}
								else
								{
									echo "<div class='error'>Register for handling an error during the holding at, please go to support.</div>";
								}
								}
								}
								}
	?>
	
	
	
	  <form action="" method="post">  
      
     	<table>
<tr>
	<td>Old Password</td>	<td><input type="password" name="oldpassword" id="oldpassword"  /> </td> 	<td><font size="1" color="grey">3-20 Long (Characters A-Z,a-z 0-9)</font> </td>
</tr>
<tr>
	<td>New Password</td>	<td><input type="password" name="newpassword" id="newpassword"/></td>		<td><font size="1" color="grey">3-20 Long (Characters A-Z,a-z 0-9)</font> </td>
</tr>
<tr>
	<td>Confirm New Password</td><td><input type="password" name="newpassword2" id="newpassword2" />  </td> 	<td></td>
</tr>
<tr>
	<td>Email</td><td><input type="email" name="email" id="email" />  </td>	<td><font size="1"  color="grey">Should be Vaild</font> </td>
</tr>
<tr>
	<td>Capatcha</td>	<td><input type="text" name="captcha" id="captcha" /> </td>	<td><img src="mod/captcha/captcha.php" id="captcha" /></td>
</tr>
<tr>
	<td></td>	<td></td>	<td><a href="" onclick="
    document.getElementById('captcha').src='mod/captcha/captcha.php?'+Math.random();
    document.getElementById('captcha-form').focus();"
    id="change-image"><font color="grey">Refresh captcha.</font></a></td>
</tr>
<tr>
	<td></td>	<td></td>	<td><p class="submit">   <input type="submit" name="submit" value="Register" />  </p> </td>
</tr>
</table> 
      
    </form>  
	</div>
	
	
	
	
	
