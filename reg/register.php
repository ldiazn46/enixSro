
<div id="title">REGISTER</div>
	<div id="content">
	
	
	<?php
	


	
	if(isset($_SESSION['loggedin'])) {
		header("location:?news");
	} else {

							if(isset($_POST["submit"])){
				
							$username	= anti_injection($_POST["username"]);
							$password	= anti_injection($_POST["password"]);
							$repassword	= anti_injection($_POST["repassword"]);
							$encrypt	= md5($password);
							$email		= anti_injection($_POST["email"]);
							$nickname   = anti_injection($_POST["nick"]);
							$captcha	= anti_injection($_POST["captcha"]);
							

							if($username == "" || $password == "" || $repassword == "" || $email == "" || $nickname == "")
							{
								echo "<div class='error'>Please fill all fields</div>";
							}else if (trim(strtolower($_SESSION['captcha'])) != $_POST["captcha"]) {
								echo "<div class='error'>Captcha Invalido.</div>";	
							}else if(strlen($username) <= "3" || strlen($username) >= "21")
							{
								echo "<div class='error'>Username should be between 3 and 20 characters</div>";
							}else if(!ctype_alnum($password) || !ctype_alnum($username) || !ctype_alnum($nickname))
							{
							echo "<div class='error'>Sould be Characters and Numbers only.</div>";
							}
							else if($password != $repassword)
							{
								echo "<div class='error'>Password does not match.</div>";
							}
							else if(strlen($password) <= "3" || strlen($password) >= "21")
							{
								echo "<div class='error'>Password should be between 3 and 20 characters</div>";
							}
							else if(strlen($nickname) <= "3" || strlen($nickname) >= "21")
							{
								echo "<div class='error'>Nickname should be between 3 and 20 characters</div>";
							}
							else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
							{
								echo "<div class='error'>Invalid E-mail address.</div>";
							}
							else if(odbc_num_rows(odbc_exec($connectacc, "SELECT * FROM dbo.TB_User WHERE StrUserID = '$username'")) > "0")
							{
								echo "<div class='error'>This username has already been used.</div>";
							}
							else if(odbc_num_rows(odbc_exec($connectacc, "SELECT * FROM dbo.TB_User WHERE Email = '$email'")) > "0")
							{
								echo "<div class='error'>This e-mail address has already been used.</div>";
							}
							else if(odbc_num_rows(odbc_exec($connectacc, "SELECT * FROM dbo.TB_User WHERE Name = '$nickname'")) > "0")
							{
								echo "<div class='error'>Nombre de usuario no disponible.</div>";
							}
							else
							{
								if(odbc_exec($connectacc, "INSERT INTO dbo.TB_User (StrUserID,password,Email,name,sec_primary,sec_content) VALUES ('$username','$encrypt','$email','$nickname','3','3')"))
								{
									echo "<div class='ok'>Registro exitoso.</div>";
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
	<td>User ID</td>	<td><input type="text" name="username" id="username"  /> </td> 	<td><font size="1" color="grey">3-20 Long (Characters A-Z,a-z 0-9)</font> </td>
</tr>
<tr>
	<td>Password</td>	<td><input type="password" name="password" id="password"/></td>		<td><font size="1" color="grey">3-20 Long (Characters A-Z,a-z 0-9)</font> </td>
</tr>
<tr>
	<td>Confirm Password</td><td><input type="password" name="repassword" id="repassword" />  </td> 	<td></td>
</tr>
<tr>
	<td>Email</td><td><input type="email" name="email" id="email" />  </td>	<td><font size="1"  color="grey">Should be Vaild</font> </td>
</tr>
<tr>
	<td>Nickname</td>	<td><input type="text" name="nick" id="nick" />  </td> 	<td><font size="1" color="grey">3-20 Long (Characters A-Z,a-z 0-9)</font> </td>
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
	
	
	
	
	
