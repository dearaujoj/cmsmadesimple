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

$CMS_ADMIN_PAGE=1;

require_once("../lib/include.php");
$urlext='?'.CMS_SECURE_PARAM_NAME.'='.$_SESSION[CMS_USER_KEY];

check_login();

include_once("header.php");

?>
<div class="pagecontainer">
	<div class="pageoverflow">

<?php

	$userid = get_userid();

	$bookops = cmsms()->GetBookmarkOperations();
	$marklist = $bookops->LoadBookmarks($userid);

	$page = 1;
	if (isset($_GET['page'])) $page = $_GET['page'];
	$limit = 20;

	if (count($marklist) > $limit)
	{
		echo "<p class=\"pageshowrows\">".pagination($page, count($marklist), $limit)."</p>";
	}
	echo $themeObject->ShowHeader('bookmarks').'</div>';

	if (count($marklist) > 0) {

		echo'<p class="pagewarning visible">' . lang('show_shortcuts_message') . '</p>';

		echo "<table class=\"pagetable\">\n";
		echo '<thead>';
		echo "<tr>\n";
		echo "<th class=\"pagew60\">".lang('name')."</th>\n";
		echo "<th class=\"pagew60\">".lang('url')."</th>\n";
		echo "<th class=\"pageicon\">&nbsp;</th>\n";
		echo "<th class=\"pageicon\">&nbsp;</th>\n";
		echo "</tr>\n";
		echo '</thead>';
		echo '<tbody>';

		$currow = "row1";

		// construct true/false button images
		$image_true = $themeObject->DisplayImage('icons/system/true.gif', lang('true'),'','','systemicon');
		$image_false = $themeObject->DisplayImage('icons/system/false.gif', lang('false'),'','','systemicon');

		$counter=0;
		foreach ($marklist as $onemark){
			if ($counter < $page*$limit && $counter >= ($page*$limit)-$limit) {
				echo "<tr class=\"$currow\">\n";
				echo "<td><a href=\"editbookmark.php".$urlext."&amp;bookmark_id=".$onemark->bookmark_id."\">".$onemark->title."</a></td>\n";
				echo "<td>".$onemark->url."</td>\n";
				echo "<td><a href=\"editbookmark.php".$urlext."&amp;bookmark_id=".$onemark->bookmark_id."\">";
				echo $themeObject->DisplayImage('icons/system/edit.gif', lang('edit'),'','','systemicon');
				echo "</a></td>\n";
				echo "<td><a href=\"deletebookmark.php".$urlext."&amp;bookmark_id=".$onemark->bookmark_id."\" onclick=\"return confirm('".cms_html_entity_decode(lang('deleteconfirm', $onemark->title) )."');\">";
				echo $themeObject->DisplayImage('icons/system/delete.gif', lang('delete'),'','','systemicon');
				echo "</a></td>\n";
				echo "</tr>\n";
				($currow == "row1"?$currow="row2":$currow="row1");
			}
			$counter++;
		}

		echo '</tbody>';
		echo "</table>\n";

	} else {
		echo'<p class="information">' . lang('no_shortcuts') . '</p>';
	}
?>
	<div class="pageoptions">
		<p class="pageoptions">
			<a href="addbookmark.php<?php echo $urlext ?>">
				<?php
					echo $themeObject->DisplayImage('icons/system/newobject.gif', lang('addbookmark'),'','','systemicon').'</a>';
					echo ' <a class="pageoptions" href="addbookmark.php'.$urlext.'">'.lang("addbookmark");
				?>
			</a>
		</p>
	</div>
</div>
<?php

include_once("footer.php");


?>
