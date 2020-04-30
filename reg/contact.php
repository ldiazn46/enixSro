<div id="title">CONTACT</div>
	<div id="content">
	<center>
	<?php
	
	
	
	
	if(!isset($_SESSION['loggedin'])) {
		echo "<b>Email:</b> ".$email."";
	} else {
	
	
	If (isset($_POST["send"])){
	$title 		= anti_injection($_POST["titl"]);
	$cont 		= anti_injection($_POST["cont"]);
	$type 		= anti_injection($_POST["type"]);
	$sendby		= $_SESSION['nick'];
	$today = date('Y-m-d H:i:s');
	
	If($title == "" || $cont  == "" ){
	echo "<div class='error'>Please fill all fields</div>";
	}else if($type == ""){
	echo "<div class='error'>Select type.</div>";
	}else if(strlen($title) > "40"){
	echo "<div class='error'>Title is too long./div>";
	}else if(strlen($cont) > "250"){
	echo "<div class='error'>Message is too long./div>";
	}else{
	$add = odbc_exec($connectacc, "INSERT INTO dbo.websro_support(Title, Cont, Date, Sendby, Type) VALUES ('$title','$cont','$today','$sendby', '$type')");
	If($add){
	echo "<div class='ok'>Your message has been sent successfully to support.</div>";
	}else{
	
	echo "<div class='error'>error.</div>";
	}
	}
	}
	
	?>
	
	
	
	
	
	
	
	
	<form action="" method="post">  
		  <table >
	  <tr>
	<td align="center" colspan="2">Send Ticket to Support</td>
	</tr>  <tr>
	<td>Type</td><td><select name="type">
							<option>--Select--</option>
						<option value="1">Website</option>
							<option value="2">Game Account</option>
							<option value="3">Bugs</option>
							<option value="4">Question to administration</option>
							<option value="5">Other</option>
						</select></td>
	
	
	
	</tr>
		  
		  <tr>
	<td>Title</td><td><input type="text" name="titl" id="titl" maxlength="40" style="width:350px;"/></td>
	</tr><tr>
	<td>Content</td><td><textarea type="text" name="cont" id="cont"  maxlength="250"  style="width:350px;"/></textarea></td>
	</tr><tr>
	<td></td><td><p class="submit"><input type="submit" name="send" value="Send" /></p> </td>
	</tr>
	</table>
	</form>
	
</center>
	
	
	
	
	<?php
	}
	?>
	</div>