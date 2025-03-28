<?php
#CMS - CMS Made Simple
#(c)2004 by Ted Kulp (wishy@users.sf.net)
#Visit our homepage at: http://www.cmsmadesimple.org
#
#This program is free software; you can redistribute it and/or modify
#it under the terms of the GNU General Public License as published by
#the Free Software Foundation; either version 2 of the License, or
#(at your option) any later version.
#
#This program is distributed in the hope that it will be useful,
#but WITHOUT ANY WARRANTY; without even the implied warranty of
#MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#GNU General Public License for more details.
#You should have received a copy of the GNU General Public License
#along with this program; if not, write to the Free Software
#Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
#
#$Id$

global $CMS_ADMIN_PAGE;
$CMS_ADMIN_PAGE = 1;

require_once('../lib/include.php');
$urlext='?'.CMS_SECURE_PARAM_NAME.'='.$_SESSION[CMS_USER_KEY];

include_once("header.php");
check_login();
$config = cmsms()->GetConfig();
$link = base64_decode($_GET['ref'], TRUE);

$newmark = new Bookmark();
$newmark->user_id = get_userid();
$newmark->url = $link;
$newmark->title = $_GET['title'];
$result = $newmark->save();

if($result)
{
	header('Location: //' . $link);

}
else
{
	redirect($config['admin_url'] . '/listbookmarks.php?' . CMS_SECURE_PARAM_NAME . '=' . $_SESSION[CMS_USER_KEY]);
}



?>
