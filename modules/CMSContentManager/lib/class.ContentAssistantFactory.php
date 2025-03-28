<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: CMSContentManager (c) 2013 by Robert Campbell
#         (calguy1000@cmsmadesimple.org)
#  A module for managing content in CMSMS.
#
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2004 by Ted Kulp (wishy@cmsmadesimple.org)
# Visit our homepage at: http://www.cmsmadesimple.org
#
#-------------------------------------------------------------------------
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# However, as a special exception to the GPL, this software is distributed
# as an addon module to CMS Made Simple.  You may not use this software
# in any Non GPL version of CMS Made simple, or in any version of CMS
# Made simple that does not indicate clearly and obviously in its admin
# section that the site was built with CMS Made simple.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#
#-------------------------------------------------------------------------
#END_LICENSE

class ContentAssistantFactory
{
	private $_content_obj;

	public function __construct(ContentBase $content_obj)
	{
		$this->_content_obj = $content_obj;
	}

	public function getEditContentAssistant()
	{
		$classname = get_class($this->_content_obj);
		$n = 0;
		while( $n < 10 ) {
			$n++;
			$test = $classname.'EditContentAssistant';
			if( class_exists($test) ) {
				$obj = new $test($this->_content_obj);
				return $obj;
			}
			$classname = get_parent_class($classname);
			if( !$classname ) {
				$obj = null;
				return $obj;
			}
		}
		throw new CmsException('Too many levels of hierarchy without finding an assistant');
  }
} // end of class

#
# EOF
#

?>