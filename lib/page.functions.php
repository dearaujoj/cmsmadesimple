<?php

function check_login(&$config) {
	if (!isset($_SESSION["user_id"])) {
		redirect($config->root_url."/admin/login.php");
	}
}

function check_admin(&$config) {
}

function check_permission(&$config, $userid, $permname) {
	$check = false;

	$db = new DB($config);

	$query = "SELECT * FROM user_groups ug INNER JOIN group_perms gp ON gp.group_id = ug.group_id INNER JOIN permissions p ON p.permission_id = gp.permission_id WHERE ug.user_id = ".$userid." AND permission_name = '".$permname."'";
	$result = $db->query($query);

	if (mysql_num_rows($result) > 0) {
		$check = true;
	}

	$db->close();

	return $check;
}

function & strip_slashes(&$str) {

	if(is_array($str)) {
		while(list($key, $val) = each($str)) {
			$str[$key] = strip_slashes($val);
		}
	}
	else {
		$str = stripslashes($str);
	}

	return $str;
}

# vim:ts=4 sw=4 noet
?>
