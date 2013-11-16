<?php
// A
$lang['about_title'] = 'About the %s module';
$lang['admin_title'] = 'Module Manager Admin Panel';
$lang['abouttxt'] = 'About';
$lang['accessdenied'] = 'Access Denied. Please check your permissions';
$lang['action_activated'] = 'Module %s has been activated';
$lang['action_installed'] = 'Module %s has been installed with the following message(s): %s';
$lang['action_upgraded'] = 'Module %s has been upgraded';
$lang['action'] = 'Action';
$lang['active'] = 'Active';
$lang['admindescription'] = 'Modules extend CMS Made Simple&trade; to provide all kinds of custom functionality';
$lang['advancedsearch_help'] = 'Specify words to include or exclude from the search using a + or -, surround exact phrases with quotes.  i.e:  +red -apple +"some text"';
$lang['all_modules_up_to_date'] = 'There are no newer modules available in the repository';
$lang['availablemodules'] = 'The current status of modules available from the current repository';
$lang['available_updates'] = 'One or more modules are available for upgrade; Before upgrading, please read the about information for the release and make sure you have a current backup of your website.';
$lang['availmodules'] = 'Available Modules'; 

// B
$lang['back'] = 'Back';
$lang['back_to_module_manager'] = 'Return to Module Manager';

// C
$lang['cantdownload'] = 'Cannot Download';
$lang['cantremove'] = 'Cannot Remove';
$lang['changeperms'] = 'Change Permissions';
$lang['confirm_resetcache'] = 'Are you sure you want to clear the local cache?';
$lang['confirm_reseturl'] = 'Are you sure you want to reset the repository URL?';
$lang['confirm_settings'] = 'Are you sure you want to save these settings?';
$lang['compatibility_disclaimer'] = 'The modules displayed here are contributed by both the CMSMS Developers and independent third parties.  We make no guarantees that the modules available here are functional, tested, or compatible with your system.  You are encouraged to read the information found in the help and about links for each module before attempting the installation.';

// D
$lang['db_newer'] = 'Database Version Newer';
$lang['dependstxt'] = 'Dependencies';
$lang['depend_activate'] = 'Module %s will be activated.';
$lang['depend_install'] = 'Module %s (version %s) will be installed.';
$lang['depend_upgrade'] = 'Module %s will be upgraded to version %s.';
$lang['display_in_english'] = 'Display in English';
$lang['display_in_mylanguage'] = 'Display in NAME LANGUAGE HERE';
$lang['download'] = 'Download &amp; Install';
$lang['downloads'] = 'Downloads';

// E
$lang['entersearchterm'] = 'Enter search term';
$lang['error'] = 'Error!';
$lang['error_active_failed'] = 'The operation to toggle the active state of a module failed';
$lang['error_checksum'] = 'Checksum error.  This probably indicates a corrupt file, either when it was uploaded to the repository, or a problem in transit down to your machine. (expected %s and got %s)';
$lang['error_connectnomodules'] = 'Although a connection was successfully made to the specified module repository.  It appears that this repository is not yet sharing any modules';
$lang['error_downloadxml'] = 'A problem occurred downloading the XML FILE: %s';
$lang['error_getmodule'] = 'A problem occurred instantiating %s';
$lang['error_internal'] = 'Internal Error... Please report this to your system administrator';
$lang['error_minimumrepository'] = 'The repository version is not compatible with this module manager';
$lang['error_missingparams'] = 'A required parameter was missing';
$lang['error_moduleinstallfailed'] = 'Module installation failed';
$lang['error_module_object'] = 'Error: could not get an instance of the %s module';
$lang['error_nodata'] = 'No data retrieved';
$lang['error_nofilename'] = 'No filename parameter supplied';
$lang['error_nofilesize'] = 'No filesize parameter supplied';
$lang['error_nomatchingmodules'] = 'Error: could not find any matching modules in the repository';
$lang['error_nomodules'] = 'Error: could not retrieve list of installed modules';
$lang['error_norepositoryurl'] = 'The URL for the Module Repository has not been specified';
$lang['error_noresults'] = 'We expected some results to be available from queued operations, but none were found. Please try to reproduce this experience, and provide sufficient information to support personnel for diagnoses.';
$lang['error_permissions'] = '<strong><em>WARNING:</em></strong> Insufficient directory permissions to install modules.  You may also be experiencing problems with PHP Safe mode.  Please ensure that safe mode is disabled, and that file system permissions are sufficient.';
$lang['error_request_problem'] = 'A problem occurred communicating with the module server';
$lang['error_search'] = 'Search Error';
$lang['error_searchterm'] = 'You have entered an invalid search term.  The term must consist of ascii characters and be three or more characters long';
$lang['error_skipping'] = 'Skipping install/upgrade of %s due to errors in setting up dependencies. Please see message above, and try again.';
$lang['error_unsatisfiable_dependency'] = 'Cannot find the required module "%s" (version %s or later) in the repository. It is directly required by %s; this could indicate a problem with the version of this module in the repository. Please contact the module\'s author. Aborting.';
$lang['error_upgrade'] = 'Upgrade of module %s failed!';
$lang['export'] = 'Export';

// F
$lang['friendlyname'] = 'Module Manager';

// G
$lang['general_notice'] = 'The versions displayed here represent the latest XML files uploaded to the CMSMS Forge.  They may or may not represent the latest available versions.'; 

// H
$lang['has_dependants'] = 'Has dependants';
$lang['help'] = '<h3>What Does This Do?</h3>
<p>A client for the CMS Made Simple Module Repository. This module allows previewing and installing modules from the CMSMS Forge without the need for ftp-ing, or unzipping archives.  Module XML files are downloaded using REST, integrity verified, and then expanded automatically.</p>
<h3>How Do I Use It</h3>
<p>In order to use this module you will need the \'Modify Modules\' permission.</p><br/>
<p>You can find the interface for this module under the \'Site Admin\' menu.  When you select this module, the \'Module Repository\' installation will automatically be queried for a list of it\'s available XML modules.  This list will be cross referenced with the list of currently installed modules, and a summary page displayed.  From here, you can view the descriptive information, the Help, and the About information for a module without physically installing it.  You can also choose to upgrade or install modules.</p>
<h3>Support</h3>
<p>As per the GPL, this software is provided as-is. Please read the text of the license for the full disclaimer.</p>
<h3>Copyright and License</h3>
<p>Copyright &copy; 2006, calguy1000 <a href="mailto:calguy1000@hotmail.com">&lt;calguy1000@hotmail.com&gt;</a>. All Rights Are Reserved.</p>
<p>This module has been released under the <a href="http://www.gnu.org/licenses/licenses.html#GPL">GNU Public License</a>. You must agree to this license before using the module.</p>';
$lang['helptxt'] = 'Help';
$lang['help_dl_chunksize'] = 'This parameter specifies the size <em>(in kilobytes)</em> of each chunk of data that will be downloaded from the repository when requesting a module.';
$lang['help_latestdepends'] = 'When installing a module with dependencies, this will ensure that the newest version of a dependent module is installed';

// I
$lang['incompatible'] = 'Incompatible';
//$lang['info_disable_caching'] = '<strong>Not Recommended</strong>.  For performance reasons, ModuleManager will cache for (by default one hour) much of the information retrieved from the remote server';
//$lang['info_latestdepends'] = 'When installing a module with dependencies, this option will make sure that the latest version of the dependency will be installed';
$lang['info_searchtab'] = 'This tab displays a list of installed modules for which there is a newer version available';
$lang['install'] = 'install';
$lang['installed'] = 'Installed';
$lang['install_submit'] = 'Install';
$lang['install_with_deps'] = 'Evaluate all Dependencies and Install';
$lang['instcount'] = 'Modules currently installed';

// L
$lang['latestdepends'] = 'Always install the newest modules';

// M
$lang['moddescription'] = 'A client for the CMS Made Simple Module Repository. This module allows previewing and installing modules from the CMSMS Forge without the need for ftp-ing, or unzipping archives.  Module XML files are downloaded using REST, integrity verified, and then expanded automatically.';
$lang['mod_name_ver'] = '%s version %s';
$lang['msg_module_activated'] = 'Module %s activated';
$lang['msg_module_deactivated'] = 'Module %s deactivated';
$lang['msg_cachecleared'] = 'Cache cleared';
$lang['msg_nodependencies'] = 'This file has not listed any dependencies';
$lang['msg_prefssaved'] = 'Preferences Updated';
//$lang['msg_urlreset'] = 'Module Repository URL reset to factory settings';

// N
$lang['nametext'] = 'Module Name';
$lang['need_upgrade'] = 'This module is awaiting upgrade';
$lang['newerversion'] = 'Newer version installed';
$lang['newversions'] = 'Available Upgrades';
$lang['newer_available'] = 'New version available';
$lang['notcompatibile'] = 'This module is not compatible with this version of CMSMS';
$lang['notice'] = 'Notice';
$lang['notice_depends'] = '%s has unresolved dependencies. In order to install this module the following actions must occur';

// O
$lang['onlynewesttext'] = 'Show only newest version';
$lang['operation_results'] = 'Operation Results';

// P
$lang['postinstall'] = 'Module Manager has been successfully installed.';
$lang['postuninstall'] = 'Module Manager has been uninstalled.  Users will no longer have the ability to install modules from the remote repositorie.  However, local installation is still possible.';
$lang['preferences'] = 'Preferences';
$lang['preferencessaved'] = 'Preferences saved';
$lang['prompt_advancedsearch'] = 'Advanced Search';
$lang['prompt_disable_caching'] = 'Disable caching of requests from the server';
$lang['prompt_dl_chunksize'] = 'Download Chunk Size (Kb)';
$lang['prompt_otheroptions'] = 'Other Options';
$lang['prompt_repository_url'] = 'ModuleRepository URL';
//$lang['prompt_resetcache'] = 'Reset the local cache of repository data';
//$lang['prompt_reseturl'] = 'Reset URL to preset default';
$lang['prompt_settings'] = 'Settings';

// R
$lang['really_uninstall'] = 'Are you sure you want to uninstall? You will be missing a lot of nice functionality.';
$lang['releasedate'] = 'Date';
$lang['repositorycount'] = 'Modules found in the repository';
$lang['reset'] = 'Reset';
$lang['reset_cache'] = 'Reset Cache';

// S
$lang['search'] = 'Search';
$lang['searchterm'] = 'Search Term';
$lang['search_input'] = 'Search Input';
$lang['search_noresults'] = 'Search succeeded but no results matched the expresssion';
$lang['search_results'] = 'Search Results';
$lang['sizetext'] = 'Size (Kilobytes)';
$lang['status'] = 'Status';
$lang['status_db_newer'] = 'The version number stored in the database is greater than the one in the module.';
$lang['status_need_upgrade'] = 'The upgrade routine needs to be run on this module';
$lang['status_newer_available'] = 'A newer version of this module is available in the repository';
$lang['statustext'] = 'Status/Action';
$lang['status_installed'] = 'This module is currently installed and available for use.';
$lang['submit'] = 'Submit';

// T
//$lang['text_dl_chunksize'] = 'The maximum amount of data to download from the server in one chunk (when installing a module)';
//$lang['text_repository_url'] = 'The URL should be in the form http://www.mycmsmssite.com/ModuleRepository/request/v2 (assuming pretty urls are enabled on the repository server)<br />Note: opening this link in your webbrowser will return an Error404!';
$lang['time_warning'] = 'Two or more actions need to be performed. Be aware that the install could take a few minutes. Please be patient!';
$lang['title_advancedsearch'] = 'Enable advanced search functionality';
$lang['title_has_dependants'] = 'This module is required and useed by other installed modules, and therefore cannot be uninstalled';
$lang['title_installation'] = 'Installation';
$lang['title_installation_complete'] = 'Installation Process Complete!';
$lang['title_letter'] = 'Show modules whos name starts with %s';
$lang['title_moduleabout'] = 'View the author and changelog information for this module';
$lang['title_moduleactive'] = 'Toggle the active state of the module. Inactive modules are not loaded, and cannot be called, however data remains intact';
$lang['title_moduleaction'] = 'This column displays the actions available for each module';
$lang['title_moduledepends'] = 'View the dependencies for this module';
$lang['title_moduledownloads'] = 'This column displays the approximate number of downloads for each release of the module';
$lang['title_moduledownloads2'] = 'This column displays the approximate number of downloads for the newest version of the module';
$lang['title_moduleexport'] = 'Export this module to XML for sharing';
$lang['title_modulehelp'] = 'View basic usage instructions for this module';
$lang['title_moduleinstallupgrade'] = 'Install or Upgrade this module';
$lang['title_modulelastreleasedate'] = 'This column displays the date of the last release for the module';
$lang['title_modulelastversion'] = 'This column displays the version number of the last release for the module';
$lang['title_moduletotaldownloads'] = 'This column displays the approximate total downloads for all released versions of the module';
$lang['title_modulereleaseabout'] = 'View the author and changelog information for this release';
$lang['title_modulereleasedate'] = 'This column displays the release date of the module';
$lang['title_modulereleasedepends'] = 'View the dependencies for this release';
$lang['title_modulereleasehelp'] = 'View the documentation supplied with this release';
$lang['title_modulesize2'] = 'This column displays the size of the module XML file to be downloaded (in kilobytes)';
$lang['title_modulestatus'] = 'This column displays the status or actions available for a particular module';
$lang['title_moduleversion'] = 'This column displays the module version';
$lang['title_new'] = 'This module was released within the last month';
$lang['title_newmoduleversion'] = 'This column displays the version number of the most recent release of the module';
$lang['title_notcompatible'] = 'This module has not passed compatibility tests';
$lang['title_searchterm'] = 'Enter a natural language search term.  If advanced mode is enabled, then boolean operations similar to google can be used';
$lang['title_stale'] = 'This module is stale (released over two years ago)';
$lang['title_star'] = 'A new version of this module is available in the repository';
$lang['title_system'] = 'This icon identifies a system module (module distributed with CMSMS)';
$lang['title_uninstall'] = 'Uninstall this module.  This action may destroy data and templates associated with the module';
$lang['title_warning'] = 'This module was released some time ago.  Use caution!';
$lang['title_yourmoduledate'] = 'This column displays the date of the latest release for this module';
$lang['title_yourmoduleversion'] = 'This column displays the version number of module that is currently installed';
$lang['toggle_active'] = 'Set this module as active and usable';
$lang['toggle_inactive'] = 'Set this module as inactive and unused.  No module data will be destroyed';

// U
$lang['uninstall'] = 'Uninstall';
$lang['uninstalled'] = 'Module Uninstalled';
$lang['unknown'] = 'Unknown';
$lang['upgrade'] = 'Upgrade';
$lang['upgraded'] = 'Module upgraded to version %s';
$lang['upgrade_available'] = 'Newer version available (%s), you have (%s)';
$lang['uptodate'] = 'Installed';
$lang['use_at_your_own_risk'] = 'Use at Your Own Risk';

// V
$lang['versionsformodule'] = 'Available versions of the module %s';
$lang['vertext'] = 'Version';

// X
$lang['xmltext'] = 'XML File';

// Y
$lang['yourversion'] = 'Your Version';

?>