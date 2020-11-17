<?php
	if(!isset($_SESION['log_User']) && !isset($_SESION['log_Admin'])){
		header('Location:signIn.php');
	}else{
		if (isset($_SESION['log_User'])) {
			header('Location:frontend/account.php');
		}
		if (isset($_SESION['log_Admin'])) {
			header('Location:backend/user.php');
		}
	}
?>