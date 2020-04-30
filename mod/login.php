<?php



	

	
	if(!isset($_SESSION['loggedin'])) {
									print '
									<form class="form" action="" method="POST">  
      <div id="input-panel">
									<p class="name">  
									<label for="name">User ID</label>  
									<input type="text" name="username" id="username" />  
									
									</p>  
									
									<p class="email">  
									<label for="email">Password</label>  
										<input type="password" name="password" id="password" />  
									
									</p>  
									
									
									<p class="submit">  
										<input type="submit" name="login" value="Login" />
									</p>  
      </div>
									</form> ';
			if(isset($_POST['login'])) {
			
	
			
					
									
		$username	= anti_injection($_POST["username"]);
		$password	= anti_injection($_POST["password"]);
		if($username == "" || $password == "")
		{


			header("location:.././");
	
		}else
		{
		$enpass		= md5($password);
		$newpass	= sha1($enpass);
		

				$verifyAccount = odbc_num_rows(odbc_exec($connectacc, "select * from TB_User where StrUserID = '$username' AND password = '$enpass'"));
				if($verifyAccount <= 0) {

					echo '<script type="text/javascript">';
			echo ' alert("Invalid username and/or password!");';
			echo '</script>';	

				} else {
				
					$name = odbc_fetch_array(odbc_exec($connectacc, "select * from TB_User where StrUserID = '$username'"));
					
					$_SESSION['loggedin'] = "YES";
				$_SESSION['name'] = $username;
				$_SESSION['nick'] = $name['Name'];

					header("location:?news");



					}
				}
			}
									
											
									
								} else{
								echo "<div id='user'>";
								$userID = $_SESSION['name'];
								
									
									
									$getUserJID = odbc_exec($connectacc, "select * from TB_User where StrUserID = '$userID'");
									while ($row = odbc_fetch_array($getUserJID)) {
										$userJID = $row['JID'];
										$userGM  = $row['sec_content'];
										$userNICK  = $row['Name'];
										
						
									}
										echo "Welcome  $userNICK!<br />";
							
									$getSilkQuery = odbc_exec($connectacc,"select * from SK_Silk where JID = '$userJID'");
									$row = odbc_fetch_array($getSilkQuery); 
									
							
									$silk = $row['silk_own'];
									
									if ($silk == '') {
									$silk = 0;
									}
								
								
								$messages = odbc_num_rows(odbc_exec($connectacc,"select * from websro_inbox where Username = '$userNICK' and Seen='0'"));
								
							echo "
							<hr color='#3f1b1b' align='center' size='1'/>
									Silk balance: ".$silk."<img style='vertical-align:middle;' src='template/silk-icon.png' alt='icon' /> 
							<hr color='#3f1b1b' align='center' size='1'/>
							";
									
									
									
									
								echo "
								<table width='100%'>
									<tr>
								<td><a href='?inbox'>Inbox (".$messages.")</a></td> <td></td>
								</tr>
								<tr>
								<td><a href='?changepw'>Change Password</a></td> <td>	<a href='?logout'>Logout</a></td>
								</tr>
								<tr>
								<td><a href='?charge'>Charge Silk</a></td> <td></td>
								</tr>
								";
								
								If ($userGM == '1'){
								echo"<a href='?admin'><font color='#780000'>Admin Panel</font></a>";
								
								}
								
								echo "</table></div>";
								
								}
								  





		
	
	
	
?>