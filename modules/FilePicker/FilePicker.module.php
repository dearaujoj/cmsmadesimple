<?php
#-------------------------------------------------------------------------
# Module: FilePicker - A CMSMS addon module to provide file picking capabilities.
# (c) 2016 by Fernando Morgado <jomorg@cmsmadesimple.org>
# (c) 2016 by Robert Campbell <calguy1000@cmsmadesimple.org>
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2006 by Ted Kulp (wishy@cmsmadesimple.org)
# This projects homepage is: http://www.cmsmadesimple.org
#-------------------------------------------------------------------------
#-------------------------------------------------------------------------
# BEGIN_LICENSE
#-------------------------------------------------------------------------
# This file is part of FilePicker
# FilePicker is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# FilePicker is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#-------------------------------------------------------------------------
# END_LICENSE
#-------------------------------------------------------------------------
use \FilePicker\TemporaryProfileStorage;
use \CMSMS\FilePickerProfile as Profile;

require_once(__DIR__.'/lib/class.ProfileDAO.php');

final class FilePicker extends \CMSModule implements \CMSMS\FilePickerInterface
{
    protected $_dao;

    public function __construct()
    {
        parent::__construct();
        $this->_dao = new \FilePicker\ProfileDAO( $this );
    }

    private function _encodefilename($filename)
    {
        return str_replace('==', '', base64_encode($filename));
    }

    private function _decodefilename($encodedfilename)
    {
        return base64_decode($encodedfilename . '==');
    }

    function VisibleToAdminUser()
    {
        return $this->CheckPermission('Modify Site Preferences');
    }

    private function _GetTemplateObject()
    {
        $ret = $this->GetActionTemplateObject();
        if( is_object($ret) ) return $ret;
        return CmsApp::get_instance()->GetSmarty();
    }

    /**
     * end of private methods
     */

    function GetFriendlyName() { return $this->Lang('friendlyname');  }
    function GetVersion() { return '1.0.alpha'; }
    function GetHelp() { return $this->Lang('help'); }
    function IsPluginModule() { return FALSE; }
    function HasAdmin() { return TRUE; }
    function GetAdminSection() { return 'extensions'; }

    function HasCapability( $capability, $params = array() )
    {
        switch( $capability ) {
        case 'contentblocks':
        case 'filepicker':
        case 'upload':
            return TRUE;
        default:
            return FALSE;
        }
    }

    function GetContentBlockFieldInput($blockName, $value, $params, $adding, ContentBase $content_obj)
    {
        if( empty($blockName) ) return FALSE;
        $uid = get_userid(FALSE);
        //$adding = (bool)( $adding || ($content_obj->Id() < 1) ); // hack for the core. Have to ask why though (JM)

        $profile = $this->get_default_profile();
        $profile_name = get_parameter_value($params,'profile');
        if( $profile_name ) {
            $tmp = $this->get_profile($profile);
            if( $tmp ) $profile = $tmp;
        }
        // todo: optionally allow further overriding the profile
        $out = $this->get_html($blockName, $value, $profile);
        return $out;
    }

//  function ValidateContentBlockFieldValue($blockName,$value,$blockparams,ContentBase $content_obj)
//  {
//    echo('<br/>:::::::::::::::::::::<br/>');
//    debug_display($blockName, '$blockName');
//    debug_display($value, '$value');
//    debug_display($blockparams, '$blockparams');
//    //debug_display($adding, '$adding');
//    echo('<br/>' . __FILE__ . ' : (' . __CLASS__ . ' :: ' . __FUNCTION__ . ') : ' . __LINE__ . '<br/>');
//    //die('<br/>RIP!<br/>');
//  }

    public function GetFileList($path = '')
    {
        return filemanager_utils::get_file_list($path);
    }

    public function get_default_profile()
    {
        $profile = $this->_dao->getDefault();
        if( $profile ) return $profile;

        $profile = new \CMSMS\FilePickerProfile;
        return $profile;
    }

    public function get_browser_url()
    {
        return $this->create_url('m1_','filepicker');
    }

    public function get_html( $name, $value, \CMSMS\FilePickerProfile $profile )
    {
        $_instance = 'i'.uniqid();
        if( $value === '-1' ) $value = null;

        // store the profile as a 'useonce' and add it's signature to the params on the url
        $sig = TemporaryProfileStorage::set( $profile );
        $smarty = \cms_utils::get_smarty(); // $this->_GetTemplateObject();
        $tpl_ob = $smarty->CreateTemplate($this->GetTemplateResource('contentblock.tpl'),null,null,$smarty);
        $tpl_ob->assign('sig',$sig);
        $tpl_ob->assign('blockName',$name);;
        $tpl_ob->assign('value',$value);
        $tpl_ob->assign('instance',$_instance);
        $tpl_ob->assign('profile',$profile);
        $out = $tpl_ob->fetch();
        return $out;
    }
} // end of class
