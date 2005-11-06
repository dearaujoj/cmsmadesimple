<?php
#CMS - CMS Made Simple
#(c)2004 by Ted Kulp (wishy@users.sf.net)
#This project's homepage is: http://cmsmadesimple.sf.net
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

$CMS_ADMIN_PAGE=1;

require_once("../include.php");

check_login();

$error = "";

$title= "";
if (isset($_POST["title"])) $title = $_POST["title"];
$url = "";
if (isset($_POST["url"])) $url = $_POST["url"];

if (isset($_POST["cancel"])) {
	redirect("listbookmarks.php");
	return;
}

$userid = get_userid();

if (isset($_POST["addbookmark"]))
	{
	$validinfo = true;

	if ($title == "")
		{
		$error .= lang('nofieldgiven', array('addbookmark'));
		$validinfo = false;
		}

	if ($validinfo)
		{
		$markobj = new Bookmark();
		$markobj->title = $title;
		$markobj->url = $url;
		$markobj->user_id=$userid;

		$result = $markobj->save();

		if ($result)
			{
			redirect("listbookmarks.php");
			return;
			}
		else
			{
			$error .= lang('errorinsertingbookmark');
			}
		}
	}

include_once("header.php");

if ($error != "")
	{
		echo '<div class="pageerrorcontainer"><p class="pageerror">'.$error.'</p></div>';
	}
?>

<div class="pagecontainer">
	<div class="pageoverflow">
			<p class="pageheader"><?php echo lang("addbookmark"); ?></p>
			<form method="post" action="addbookmark.php">
				<div class="pageoverflow">
					<p class="pagetext"><?php echo lang('title')?>:</p>
					<p class="pageinput"><input type="text" name="title" maxlength="255" value="<?php echo $title?>" /></p>
				</div>
				<div class="pageoverflow">
					<p class="pagetext"><?php echo lang('url')?>:</p>
					<p class="pageinput"><input type="text" name="url" maxlength="255" value="<?php echo $url ?>" class="standard" /></p>
				</div>
				<div class="pageoverflow">
					<p class="pagetext">&nbsp;</p>
					<p class="pageinput">
						<input type="hidden" name="addbookmark" value="true" />
						<input type="submit" value="<?php echo lang('submit')?>" class="pagebutton" onmouseover="this.className='pagebuttonhover'" onmouseout="this.className='pagebutton'" />
						<input type="submit" name="cancel" value="<?php echo lang('cancel')?>" class="pagebutton" onmouseover="this.className='pagebuttonhover'" onmouseout="this.className='pagebutton'" />
					</p>
				</div>		
			</form>
	</div>
</div>
<p class="pageback"><a class="pageback" href="<?php echo $themeObject->BackUrl(); ?>">&#171; <?php echo lang('back')?></a></p>

<?php
include_once("footer.php");

# vim:ts=4 sw=4 noet
?>
