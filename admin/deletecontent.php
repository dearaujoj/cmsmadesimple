<?php

require_once("../include.php");

check_login($config);

$page_id = -1;
if (isset($_GET["page_id"])) {

	$page_id = $_GET["page_id"];

	$db = new DB($config);

	$query = "DELETE FROM ".$config->db_prefix."pages where page_id = $page_id";
	$result = $db->query($query);
	$db->close();
}

redirect("listcontent.php");
