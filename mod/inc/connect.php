<?php
	include('security.php');
	$connectshard = odbc_connect("Driver={SQL Server};Server={".$host."}; Database={".$db."}", "".$user."", "".$pass."") or die("<center><b style=\"border:1px dashed #FF0000;\">".str_replace("[Microsoft][ODBC SQL Server Driver][SQL Server]", "", odbc_errormsg())."</b></center>");
	$connectacc = odbc_connect("Driver={SQL Server};Server={".$host."}; Database={".$db2."}", "".$user."", "".$pass."") or die("<center><b style=\"border:1px dashed #FF0000;\">".str_replace("[Microsoft][ODBC SQL Server Driver][SQL Server]", "", odbc_errormsg())."</b></center>");

?>