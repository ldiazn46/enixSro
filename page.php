<?php
	if (isset($_GET['register'])) {
		include("mod/register.php");
	}else if (isset($_GET['download'])) {
		include("mod/download.php");
	}else if (isset($_GET['ranking'])) {
		include("mod/ranking.php");
	}else if (isset($_GET['changepw'])) {
		include("mod/changepw.php");
	}else if (isset($_GET['charge'])) {
		include("mod/charge.php");
	}else if (isset($_GET['admin'])) {
		include("mod/admin.php");
	}else if (isset($_GET['contact'])) {
		include("mod/contact.php");
	}else if (isset($_GET['inbox'])) {
		include("mod/inbox.php");
	}else if (isset($_GET['logout'])) {
				session_start();
				session_unset();
				session_destroy();
				header("location:?news");
	}else {
		include("mod/news.php");
	}
?>