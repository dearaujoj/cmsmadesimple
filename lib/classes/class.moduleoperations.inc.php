<?php // -*- mode:php; tab-width:4; indent-tabs-mode:t; c-basic-offset:4; -*-
#CMS - CMS Made Simple
#(c)2004-2010 by Ted Kulp (ted@cmsmadesimple.org)
#This project's homepage is: http://cmsmadesimple.org
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

/**
 * @package CMS 
 */

/**
 * @ignore
 */
define( "MODULE_DTD_VERSION", "1.3" );

require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'class.module.inc.php');

/**
 * "Static" module functions for internal use and module development.  CMSModule
 * extends this so that it has internal access to the functions.
 *
 * @since		0.9
 * @package		CMS
 */
final class ModuleOperations
{
	/**
	 * System Modules - a list (hardcoded) of all system modules
	 * TODO: MOVE ME.... someplace private.
	 *	@access private
	 *
	 */
	public $cmssystemmodules =  array( 'FileManager','nuSOAP', 'MenuManager', 'ModuleManager', 'Search', 'CMSMailer', 'News', 'MicroTiny', 'CMSPrinting', 'ThemeManager' );


	static private $_instance = null;
	private $_modules = null;
	private $_moduleinfo = null;
	
	private $xml_exclude_files = array('^\.svn' , '^CVS$' , '^\#.*\#$' , '~$', '\.bak$' );
	private $xmldtd = '
<!DOCTYPE module [
  <!ELEMENT module (dtdversion,name,version,description*,help*,about*,requires*,file+)>
  <!ELEMENT dtdversion (#PCDATA)>
  <!ELEMENT name (#PCDATA)>
  <!ELEMENT version (#PCDATA)>
  <!ELEMENT mincmsversion (#PCDATA)>
  <!ELEMENT description (#PCDATA)>
  <!ELEMENT help (#PCDATA)>
  <!ELEMENT about (#PCDATA)>
  <!ELEMENT requires (requiredname,requiredversion)>
  <!ELEMENT requiredname (#PCDATA)>
  <!ELEMENT requiredversion (#PCDATA)>
  <!ELEMENT file (filename,isdir,data)>
  <!ELEMENT filename (#PCDATA)>
  <!ELEMENT isdir (#PCDATA)>
  <!ELEMENT data (#PCDATA)>
]>';

  /**
   * ------------------------------------------------------------------
   * Error Functions
   * ------------------------------------------------------------------
   */
  private function __construct() {}


  public static function &get_instance()
  {
	  if( !isset(self::$_instance) ) {
		  $c = __CLASS__;
		  self::$_instance = new $c;
	  }
	  return self::$_instance;
  }


  /**
   * Set an error condition
   *
   * @param string $str The string to set for the error
   * @return void
   */
  protected function SetError($str = '')
  {
	  $gCms = cmsms();
	  $gCms->variables['error'] = $str;
  }


  /**
   * Return the last error
   *
   * @return string The last error, if any
   */
  public function GetLastError()
  {
	  $gCms = cmsms();
	  if( isset( $gCms->variables['error'] ) )
		  return $gCms->variables['error'];
	  return "";
  }


	/**
	 * Creates an xml data package from the module directory.
	 *
	 * @param mixed $modinstance The instance of the module object
	 * @param string $message Reference to a string which will be filled with the message 
	 *                        created by the run of the method
	 * @param integer $filecount Reference to an interger which will be filled with the 
	 *                           total # of files in the package
	 * @return string an XML string comprising the module and its files
	 */
	function CreateXMLPackage( &$modinstance, &$message, &$filecount )
	{
	  // get a file list
	  $filecount = 0;
	  $dir = dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."modules".DIRECTORY_SEPARATOR.$modinstance->GetName();
	  $files = get_recursive_file_list( $dir, $this->xml_exclude_files );

	  $xmltxt  = '<?xml version="1.0" encoding="ISO-8859-1"?>';
	  $xmltxt .= $this->xmldtd."\n";
	  $xmltxt .= "<module>\n";
	  $xmltxt .= "	<dtdversion>".MODULE_DTD_VERSION."</dtdversion>\n";
	  $xmltxt .= "	<name>".$modinstance->GetName()."</name>\n";
	  $xmltxt .= "	<version>".$modinstance->GetVersion()."</version>\n";
	  $xmltxt .= "  <mincmsversion>".$modinstance->MinimumCMSVersion()."</mincmsversion>\n";
	  $xmltxt .= "	<help><![CDATA[".base64_encode($modinstance->GetHelpPage())."]]></help>\n";
	  $xmltxt .= "	<about><![CDATA[".base64_encode($modinstance->GetAbout())."]]></about>\n";
	  $desc = $modinstance->GetAdminDescription();
	  if( $desc != '' )
		{
		  $xmltxt .= "	<description><![CDATA[".$desc."]]></description>\n";
		}
	  $depends = $modinstance->GetDependencies();
	  foreach( $depends as $key=>$val )
		{
		  $xmltxt .= "	<requires>\n";
			  $xmltxt .= "	  <requiredname>$key</requiredname>\n";
			  $xmltxt .= "	  <requiredversion>$val</requiredversion>\n";
		  $xmltxt .= "	</requires>\n";
		}
	  foreach( $files as $file )
		{
		  // strip off the beginning
		  if (substr($file,0,strlen($dir)) == $dir)
			 {
			 $file = substr($file,strlen($dir));
			 }
		  if( $file == '' ) continue;

		  $xmltxt .= "	<file>\n";
		  $filespec = $dir.DIRECTORY_SEPARATOR.$file;
		  $xmltxt .= "	  <filename>$file</filename>\n";
		  if( @is_dir( $filespec ) )
		{
		  $xmltxt .= "	  <isdir>1</isdir>\n";
		}
		  else
		{
		  $xmltxt .= "	  <isdir>0</isdir>\n";
		  $data = base64_encode(file_get_contents($filespec));
		  $xmltxt .= "	  <data><![CDATA[".$data."]]></data>\n";
		}

		  $xmltxt .= "	</file>\n";
		  ++$filecount;
		}
		  $xmltxt .= "</module>\n";
	  $message = 'XML package of '.strlen($xmltxt).' bytes created for '.$modinstance->GetName();
	  $message .= ' including '.$filecount.' files';
	  return $xmltxt;
	}


/**
* Unpackage a module from an xml string
* does not touch the database
*
* @param string $xml The xml data for the package
* @param boolean $overwrite Should we overwrite files if they exist?
* @param boolean $brief If set to true, less checking is done and no errors are returned
* @return array A hash of details about the installed module
*/
function ExpandXMLPackage( $xmluri, $overwrite = 0, $brief = 0 )
{
	$gCms = cmsms();

	// first make sure that we can actually write to the module directory
	$dir = dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."modules";

	if( !is_writable( $dir ) && $brief == 0 )
	{
		// directory not writable
		$this->SetError( lang( 'errordirectorynotwritable' ) );
		return false;
	}

	$reader = new XMLReader();
	$ret = $reader->open($xmluri);
	if( $ret == 0 )
	{
		$this->SetError( lang( 'errorcouldnotparsexml' ) );
		return false;
	}

	$this->SetError('');
	$havedtdversion = false;
	$moduledetails = array();
	if( is_file($xmluri) )
		$moduledetails['size'] = filesize($xmluri);
	$required = array();
	while( $reader->read() )
	{
		switch($reader->nodeType)
		{
			case XMLREADER::ELEMENT:
			{
				switch( strtoupper($reader->localName) )
				{
					case 'NAME':
					{
						$reader->read();
						$moduledetails['name'] = $reader->value;
						// check if this module is already installed
						if( isset( $this->_modules[$moduledetails['name']] ) && $overwrite == 0 && $brief == 0 )
						{
							$this->SetError( lang( 'moduleinstalled' ) );
							return false;
						}
						break;
					}
					case 'DTDVERSION':
					{
						$reader->read();
						if( $reader->value != MODULE_DTD_VERSION )
						{
							$this->SetError( lang( 'errordtdmismatch' ) );
							return false;
						}
						$havedtdversion = true;
						break;
					}

					case 'VERSION':
					{
						$reader->read();
						$moduledetails['version'] = $reader->value;
						$tmpinst = $this->get_module_instance($moduledetails['name']);
						if( $tmpinst && $brief == 0 )
						{
							$version = $tmpinst->GetVersion();
							if( version_compare($moduledetails['version'],$version) < 0 )
							{
								$this->SetError( lang('errorattempteddowngrade') );
								return false;
							}
							else if (version_compare($moduledetails['version'],$version) == 0 )
							{
								$this->SetError( lang('moduleinstalled') );
								return false;
							}
						}
						break;
					}
		
					case 'MINCMSVERSION':
					case 'MAXCMSVERSION':
					case 'DESCRIPTION':
					case 'FILENAME':
					case 'ISDIR':
					{
					    $name = $reader->localName;
						$reader->read();
						$moduledetails[$name] = $reader->value;
						break;
					}
					case 'HELP':
					case 'ABOUT':
					{
					    $name = $reader->localName;
						$reader->read();
						$moduledetails[$name] = base64_decode($reader->value);
						break;
					}
					case 'REQUIREDNAME':
					{
						$reader->read();
						$requires['name'] = $reader->value;
						break;
					}
					case 'REQUIREDVERSION':
					{
						$reader->read();
						$requires['version'] = $reader->value;
						break;
					}
					case 'DATA':
					{
						$reader->read();
						$moduledetails['filedata'] = $reader->value;
						break;
					}
				}
				break;
			}	
			case XMLReader::END_ELEMENT:
			{
				switch( strtoupper($reader->localName) )
				{
					case 'REQUIRES':
					{
						if( count($requires) != 2 )
						{
						  continue;
						}
						if( !isset( $moduledetails['requires'] ) )
						{
						  $moduledetails['requires'] = array();
						}
						$moduledetails['requires'][] = $requires;
						$requires = array();
						break;
					}
					case 'FILE':
					{
						if( $brief != 0 ) continue;

						// finished a first file
						if( !isset( $moduledetails['name'] )	   || !isset( $moduledetails['version'] ) ||
							!isset( $moduledetails['filename'] ) || !isset( $moduledetails['isdir'] ) )
						{
							$this->SetError( lang('errorincompletexml') );
							return false;
						}

						// ready to go
						$moduledir=$dir.DIRECTORY_SEPARATOR.$moduledetails['name'];
						$filename=$moduledir.$moduledetails['filename'];
						if( !file_exists( $moduledir ) )
						{
							if( !@mkdir( $moduledir ) && !is_dir( $moduledir ) )
							{
								$this->SetError(lang('errorcantcreatefile').' '.$moduledir);
								break;
							}
						}
						else if( $moduledetails['isdir'] )
						{
							if( !@mkdir( $filename ) && !is_dir( $filename ) )
							{
								$this->SetError(lang('errorcantcreatefile').' '.$filename);
								break;
							}
						}
						else
						{
							$data = $moduledetails['filedata'];
							if( strlen( $data ) )
							{
								$data = base64_decode( $data );
							}
							$fp = @fopen( $filename, "w" );
							if( !$fp )
							{
								$this->SetError(lang('errorcantcreatefile').' '.$filename);
							}
							if( strlen( $data ) )
							{
								@fwrite( $fp, $data );
							}
								@fclose( $fp );
						}
						unset( $moduledetails['filedata'] );
						unset( $moduledetails['filename'] );
						unset( $moduledetails['isdir'] );
						break;
					}
				}
				break;
			}
	      }
	} // while

	$reader->close();
	if( $havedtdversion == false )
	{
		$this->SetError( lang( 'errordtdmismatch' ) );
	}

	// we've created the module's directory
	unset( $moduledetails['filedata'] );
	unset( $moduledetails['filename'] );
	unset( $moduledetails['isdir'] );

	if( $this->GetLastError() != "" )
	{
		return false;
	}

	if( !$brief )
	{
		audit('','Module','Expanded XML file consisting of '.$moduledetails['name'].' '.$moduledetails['version']);
	}

	return $moduledetails;

}


 private function _install_module(CmsModule& $module_obj)
 {
	 debug_buffer('install_module '.$module_obj->GetName());

	 $gCms = cmsms(); // preserve the global.
	 $db = $gCms->GetDb();
	 $result = $module_obj->Install();
	 if( !isset($result) || $result === FALSE)
	 {
		 // install returned nothing, or FALSE
		 $query = 'DELETE FROM '.cms_db_prefix().'modules WHERE module_name = ?';
		 $dbr = $db->Execute($query,array($module_obj->GetName()));

		 $lazyload_fe    = (method_exists($module_obj,'LazyLoadFrontend') && $module_obj->LazyLoadFrontend())?1:0;
		 $lazyload_admin = (method_exists($module_obj,'LazyLoadAdmin') && $module_obj->LazyLoadAdmin())?1:0;
		 $query = 'INSERT INTO '.cms_db_prefix().'modules 
                   (module_name,version,status,admin_only,active,allow_fe_lazyload,allow_admin_lazyload)
                   VALUES (?,?,?,?,?,?,?)';
		 $dbr = $db->Execute($query,array($module_obj->GetName(),$module_obj->GetVersion(),'installed',
										  ($module_obj->IsAdminOnly()==true)?1:0,
										  1,$lazyload_fe,$lazyload_admin));

		 $deps = $module_obj->GetDependencies();
		 if( is_array($deps) )
			 {
				 $query = 'INSERT INTO '.cms_db_prefix().'module_deps
                           (parent_module,child_module,minimum_version,create_date,modified_date)
                           VALUES (?,?,?,NOW(),NOW())';
				 foreach( $deps as $depname => $depversion )
					 {
						 if( !$depname || !$depversion ) continue;
						 $dbr = $db->Execute($query,array($module_obj->GetName(),$depname,$depversion));
					 }
			 }

		 $info = $this->_get_module_info();
		 $info[$module_obj->GetName()] = array('module_name'=>$module_obj->GetName(),
											   'version'=>$module_obj->GetVersion(),
											   'status'=>'installed',
											   ($module_obj->IsAdminOnly()==true)?1:0,1,
											   $lazyload_fe,$lazyload_admin);

		 Events::SendEvent('Core', 'ModuleInstalled', array('name' => $module_obj->GetName(), 'version' => $module_obj->GetVersion()));
		 audit('',$module_obj->GetName(),'Installed version '.$module_obj->GetVersion());
		 return TRUE;
	 }

	 return $result;
 }


  /**
   * Install a module into the database
   *
   * @param string $module The name of the module to install
   * @param boolean $loadifnecessary If true, loads the module before trying to install it
   * @return array Returns a tuple of whether the install was successful and a message if applicable
   */
  public function InstallModule($module, $loadifnecessary = false)
  {
	  $modinstance = self::get_module_instance($module);
	  if( !$modinstance )
	  {
		  if( $loadifnecessary == false )
		  {
			  return array(false,lang('errormodulenotloaded'));
		  }
		  else
		  {
			  if( !$this->_load_module( $module, true ) )
			  {
				  return array(false,lang('errormodulewontload'));
			  }
		  }
      }
 
	  $modinstance = self::get_module_instance($module);
	  if( !$modinstance )
	  {
		  return array(false,lang('errormodulenotfound'));
	  }


	  // todo: send an event?
	  if( ($result = $this->_install_module($modinstance)) === TRUE )
	  {
		  // todo: send an event?
		  return array(true,$modinstance->InstallPostMessage());
	  }
	  else
	  {
		  if( trim($result) == "" )
		  {
			  $result = lang('errorinstallfailed');
		  }
		  return array(false,$result);
	  }
  }


  private function &_get_module_info()
  {
	  if( !is_array($this->_moduleinfo) )
	  {
		  $query = 'SELECT * FROM '.cms_db_prefix().'modules ORDER BY module_name';
		  $db = cmsms()->GetDb();
		  $tmp = $db->GetArray($query);
		  if( is_array($tmp) )
		  {
			  $config = cmsms()->GetConfig();
			  $dir = $config['root_path'].'/modules';
			  $this->_moduleinfo = array();
			  for( $i = 0; $i < count($tmp); $i++ )
			  {
				  $name = $tmp[$i]['module_name'];
				  if( is_file($dir."/$name/$name.module.php") )
				  {
					  if( !isset($this->_moduleinfo[$name]) )
					  {
						  $this->_moduleinfo[$name] = $tmp[$i];
					  }
				  }
			  }
		  }
	  }

	  return $this->_moduleinfo;
  }



  private function _load_module($module_name,$allow_auto = true)
  {
	  $config = cmsms()->GetConfig();
	  $dir = $config['root_path'].'/modules';
	  
	  global $CMS_VERSION;
	  global $CMS_PREVENT_AUTOINSTALL;
	  $allow_auto = ($allow_auto && !isset($CMS_PREVENT_AUTOINSTALL));
	  $fname = $dir."/$module_name/$module_name.module.php";
	  if( !is_file($fname) ) return FALSE;

	  $gCms = cmsms(); // backwards compatibility.
	  require_once($fname);
	  $obj = new $module_name;
	  if( !is_object($obj) ) 
	  {
		  // oops, some problem loading.
		  return FALSE;
	  }

	  if (version_compare($obj->MinimumCMSVersion(),$CMS_VERSION) == 1 )
	  {
		  // oops, not compatible.... can't load.
		  unset($obj);
		  return FALSE;
	  }

	  $info = $this->_get_module_info();
	  if( !isset($info[$module_name]) )
	  {
		  // not installed, can we auto-install it?
		  if( (in_array($module_name,$this->cmssystemmodules) || $obj->AllowAutoInstall() == true) && $allow_auto )
		  {
			  $this->_install_module($obj);
		  }
	  }

	  if( isset($info[$module_name]) )
	  {
		  $dbversion = $info[$module_name]['version'];
		  // check for compatibility
		  
		  // check for upgrade needed.
		  if( (version_compare($dbversion, $obj->GetVersion()) == -1 && $obj->AllowAutoUpgrade() == TRUE) && $allow_auto )
			  {
				  $this->_upgrade_module($obj);
			  }
	  }

	  $this->_modules[$module_name] = $obj;
	  return TRUE;
  }


  private function _load_all_modules()
  {
	  $names = $this->FindAllModules();
	  foreach( $names as $name )
	  {
		  class_exists($name,true); // trigger the autoloader magic.
	  }
  }


  public function LoadModules($loadall = false,$noadmin = false, $no_lazyload = false)
  {
	  if( $loadall ) return $this->_load_all_modules();

	  $config = cmsms()->GetConfig();
	  $no_lazyload = $no_lazyload or $config['ignore_lazy_load'];

	  global $CMS_ADMIN_PAGE;
	  $moduleinfo = $this->_get_module_info();
	  foreach( $moduleinfo as $name => $rec )
	  {
		  if( $rec['status'] != 'installed' ) continue;
		  if( $rec['active'] == 0 ) continue;
		  if( $rec['admin_only'] && $noadmin ) continue;
		  if( isset($CMS_ADMIN_PAGE) && $no_lazyload == false && isset($rec['allow_admin_lazyload']) && $rec['allow_admin_lazyload'] )
		  {
			  continue;
		  }
		  if( !isset($CMS_ADMIN_PAGE) && $no_lazyload == false && isset($rec['allow_admin_lazyload']) && $rec['allow_fe_lazyload'] )
		  {
			  continue;
		  }
		  
		  class_exists($name); // trigger the autoloader stuff.
	  }
  }


  /**
   * Load a single module from the filesystem
   *
   * @param string $modulename The name of the module to load
   * @return boolean Whether or not the module load was successful
   */
  public function LoadNewModule( $modulename )
  {
	  if( $modulename == 'cge_tmpdata') { stack_trace(); die(); }
	  debug_buffer('LoadNewModule '.$modulename);
	  return $this->_load_module( $modulename );
  }


  private function _upgrade_module( CmsModule& $module_obj )
  {
	  debug_buffer('upgrade_module '.$module_obj->GetName());

	  $info = $this->_get_module_info();
	  $dbversion = $info[$module_obj->GetName()]['version'];

	  $result = $module_obj->Upgrade($dbversion,$module_obj->GetVersion());
	  if( $result !== FALSE )
	  {
		  $db = cmsms()->GetDb();
		  $lazyload_fe    = (method_exists($module_obj,'LazyLoadFrontend') && $module_obj->LazyLoadFrontend())?1:0;
		  $lazyload_admin = (method_exists($module_obj,'LazyLoadAdmin') && $module_obj->LazyLoadAdmin())?1:0;

		  $query = 'UPDATE '.cms_db_prefix().'modules SET version = ?, allow_fe_lazyload = ?,allow_admin_lazyload = ? WHERE module_name = ?';
		  $dbr = $db->Execute($query,array($module_obj->GetVersion(),$lazyload_fe,$lazyload_admin,$module_obj->GetName()));

		  $info[$module_obj->GetName()]['version'] = $module_obj->GetVersion();
		  audit('','Module',$module_obj->GetName().' Upgraded from Version '.$dbversion.' to '.$module_obj->GetVersion());
		  Events::SendEvent('Core', 'ModuleUpgraded', array('name' => $module_obj->GetName(), 'oldversion' => $dbversion, 'newversion' => $module_obj->GetVersion()));
		  return TRUE;
	  }
	  return FALSE;
  }


  /**
   * Upgrade a module
   *
   * @param string $module The name of the module to upgrade
   * @return boolean Whether or not the upgrade was successful
   */
  public function UpgradeModule( $module )
  {
	  $modobj = $this->get_module_instance($module);
	  if( !$modobj ) return FALSE;

	  return $this->_upgrade_module( $modobj );
  }


  /**
   * Uninstall a module
   *
   * @param string $module The name of the module to upgrade
   * @return boolean Whether or not the upgrade was successful
   */
  public function UninstallModule( $module)
  {
	  $gCms = cmsms();
	  $db = $gCms->GetDb();

	  $modinstance = cms_utils::get_module($module);
	  if( !$modinstance ) return FALSE;

	  $cleanup = $modinstance->AllowUninstallCleanup();
	  $result = $modinstance->Uninstall();

	  if (!isset($result) || $result === FALSE)
		  {
			  // now delete the record
			  $query = "DELETE FROM ".cms_db_prefix()."modules WHERE module_name = ?";
			  $db->Execute($query, array($module));
			  
			  // delete any dependencies
			  $query = "DELETE FROM ".cms_db_prefix()."module_deps WHERE child_module = ?";
			  $db->Execute($query, array($module));
			  
			  // clean up, if permitted
			  if ($cleanup)
				  {
					  $db->Execute('DELETE FROM '.cms_db_prefix().
								   'module_templates where module_name=?',array($module));
					  $db->Execute('DELETE FROM '.cms_db_prefix().
								   'event_handlers where module_name=?',array($module));
					  $db->Execute('DELETE FROM '.cms_db_prefix().
								   'events where originator=?',array($module));
					  $db->Execute('DELETE FROM '.cms_db_prefix().
								   "siteprefs where sitepref_name like '".
								   str_replace("'",'',$db->qstr($module)).
								   "_mapi_pref%'");
				  }

			  Events::SendEvent('Core', 'ModuleUninstalled', array('name' => $module));
			  audit('','Module','Uninstalled module '.$module);
		  }
	  else
		  {
			  $this->setError($result);
			  return false;
		  }
	  return true;
  }


  /**
   * Test if a module is active
   */
  public function IsModuleActive($module_name)
  {
	  if( !$module_name ) return FALSE;
	  $info = $this->_get_module_info();
	  if( !isset($info[$module_name]) ) return FALSE;

	  return (bool)$info[$module_name]['active'];
  }


  /**
   * Activate a module
   *
   */
  public function ActivateModule($module_name,$activate = true)
  {
	  if( !$module_name ) return FALSE;
	  $info = $this->_get_module_info();
	  if( !isset($info[$module_name]) ) return FALSE;

	  $o_state = $info['module_name']['active'];
	  if( $activate ) 
		  {  
			  $info['module_name']['active'] = 1;
		  }
	  else
		  {
			  $info['module_name']['active'] = 0;
		  }
	  if( $info['module_name']['active'] != $o_state )
		  {
			  $db = cmsms()->GetDb();
			  $query = 'UPDATE '.cms_db_prefix.' SET active = ? WHERE module_name = ?';
			  $dbr = $db->Execute($query,array($info['module_name']['active'],$module_name));
		  }
	  return TRUE;
  }


  /**
   * Returns a hash of all loaded modules.  This will include all
   * modules loaded by LoadModules, which could either be all or them,
   * or just ones that are active and installed.
   *
   * @return array The hash of all loaded modules
   */
  public function &GetLoadedModules()
  {
	  return $this->_modules;
  }


  /**
   * Returns an array of the names of all installed modules.
   *
   * @return array of strings
   */
  public function GetInstalledModules($include_all = FALSE)
  {
	  $result = array();
	  $info = $this->_get_module_info();
	  foreach( $info as $name => $rec )
	  {
		  if( $rec['status'] != 'installed' ) continue;
		  if( !$rec['active'] && $include_all == FALSE ) continue;
		  $result[] = $name;
	  }
	  return $result;
  }


  /**
   * Returns an array of modules that have a certain capabilies
   * 
   * @param string $capability The capability name
   * @param mixed $args Capability arguments
   * @return array List of all the module with that capability
   */
  public static function get_modules_with_capability($capability, $args= '')
  {
	  $output = array();
	  foreach( self::get_instance()->_modules as $module_name => &$obj )
	  {
		  if( $obj->HasCapability($capability,$args) )
		  {
			  $output[] = $obj;
		  }
	  }

	  if( !count($output) ) return FALSE;
	  return $output;
  }


  public function &get_module_instance($module_name,$version = '')
  {
	  if( empty($module_name) && isset($this->variables['module']))
		  {
			  $module_name = $this->variables['module'];
		  }
	  
	  class_exists($module_name); // this will automagically load the module if it isn't there alrerady, neat eh.

	  $obj = null;
	  if( isset($this->_modules[$module_name]) )
		  {
			  $obj =& $this->_modules[$module_name];
		  }
	  if( is_object($obj) && !empty($version) )
		  {
			  $res = version_compare($obj->GetVersion(),$version);
			  if( $res < 1 OR $res === FALSE ) 
				  $obj = null;
		  }
	  return $obj;
  }


  public function IsSystemModule($module_name)
  {
	  return in_array($module_name,$this->cmssystemmodules);
  }


  public function FindAllModules()
  {
	$dir = dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."modules";
	
	$result = array();
	if( $handle = @opendir($dir) )
	{
		while( ($file = readdir($handle)) !== false )
		{
			$fn = "$dir/$file/$file.module.php";
			if( @is_file($fn) )
			{
				$result[] = $file;
			}
		}
	}
	
	sort($result);
	return $result;
  }


  public function &GetSyntaxHighlighter()
  {
	  global $CMS_ADMIN_PAGE;
	  if( !isset($CMS_ADMIN_PAGE) ) return;

	  $module_name = get_preference(get_userid(FALSE),'syntaxhighlighter');
	  if( !$module_name ) return;

	  $obj = $this->get_module_instance($module_name);
	  if( !is_object($obj) ) return;

	  if( !$obj->IsSyntaxHighlighter() ) return;
	  return $obj;
  }


  public function &GetWYSIWYGModule($module_name = '')
  {
	  global $CMS_ADMIN_PAGE;
	  $obj = null;
	  if( !$module_name )
		  {
			  if( !isset($CMS_ADMIN_PAGE) )
				  {
					  $module_name = get_site_preference('frontendwysiwyg');
				  }
			  else
				  {
					  $module_name = get_preference(get_userid(FALSE),'wysiwyg');
				  }
		  }

	  if( !$module_name ) return $obj;

	  $obj = $this->get_module_instance($module_name);
	  if( !$obj ) return $obj;
	  if( !$obj->IsWYSIWYG() ) return $obj;

	  return $obj;
  }
}

# vim:ts=4 sw=4 noet
?>
