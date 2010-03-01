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

class CmsModuleTemplateExtension extends CmsObject
{
	function __construct()
	{
		parent::__construct();
	}

	public function list($template_type = '')
	{
		if( empty($template_type) )
		{
			return cms_orm('CmsModuleTemplate')->find_all_by_module($this->module->get_name());
		}
		return cms_orm('CmsModuleTemplate')->find_all_by_module_and_template_type($this->module->get_name(), $template_type);
	}


	/**
	* Returns a database saved template.  This should be used for admin functions only, as it doesn't
	* follow any smarty caching rules.
	*/
	public function get($template_type, $template_name)
	{
		return cms_orm('CmsModuleTemplate')->find_by_module_and_template_type_and_name($this->module->get_name(), $template_type, $template_name);
	}

	/**
	* Returns contents of the template that resides in modules/ModuleName/templates/{template_name}.tpl
	* Code adapted from the Guestbook module
	*/
	public function get_from_file($template_name)
	{
		$ok = (strpos($tpl_name, '..') === false);
		if (!$ok) return;

		$template = cms_join_path(ROOT_DIR, 'modules', $this->module->get_name(), 'templates', $template_name.'.tpl');
		if (is_file($template)) {
			return file_get_contents($template);
		}
		else
		{
			return lang('errorinsertingtemplate');
		}
	}

	public function set($template_type, $template_name, $content, $default = false)
	{
		$template = cms_orm('CmsModuleTemplate')->find_by_module_and_template_type_and_name($this->module->get_name(), $template_type, $template_name);
		if ($template != null)
		{
			$template->content = $content;
			$template->default = $default;
			return $template->save();
		}
		else
		{
			$template = new CmsModuleTemplate();
			$template->module = $this->module->get_name();
			$template->template_type = $template_type;
			$template->template_name = $template_name;
			$template->content = $content;
			$template->default = $default;
			return $template->save();
		}
	}

	public function delete($template_type = '', $template_name = '')
	{
		if( $template_type != '' && $template_name != '' )
		{
			$template = cms_orm('CmsModuleTemplate')->find_by_module_and_template_type_and_name($this->module->get_name(), $template_type, $template_name);
			if ($template != null)
			{
				return $template->delete();
			}
		}
		else if( $template_type != '' && empty($template_name) )
		{
			$template = cms_orm('CmsModuleTemplate')->find_by_module_and_template_type($this->module->get_name(), $template_type);
			foreach( $templates as $one )
			{
				$templates->delete();
			}
			return true;
		}
		else if( empty($template_type) && empty($template_name) )
		{
			$templates = cms_orm('CmsModuleTemplate')->find_by_module($this->module->get_name());
			foreach( $templates as $one )
			{
				$templates->delete();
			}
			return true;
		}
		return false;
	}

	public function is_file_cached($template_name, $designation = '', $timestamp = '', $cache_id = '')
	{
		$ok = (strpos($template_name, '..') === false);
		if (!$ok) return;

		return $smarty->is_cached('module_file_tpl:' . $this->module->get_name() . ';' . $template_name, $cache_id, ($designation != '' ? $designation : $this->module->get_name()));
	}

	public function process($template_name, $id, $return_id, $designation = '', $cache_id = '')
	{
		$smarty = cms_smarty();

		$old_module = null;
		if ($smarty->get_template_vars('cms_mapi_module') != null)
			$old_module = $smarty->get_template_vars('cms_mapi_module');

		$smarty->assign_by_ref('cms_mapi_module', $this);
		$smarty->assign('cms_mapi_id', $id);
		$smarty->assign('cms_mapi_return_id', $return_id);

		$result = $smarty->fetch('module_file_tpl:'.$this->module->get_name() . ';' . $template_name, $cache_id, ($designation != '' ? $designation : $this->module->get_name()));

		if ($old_module != null)
			$smarty->assign_by_ref('cms_mapi_module', $old_module);

		return $result;
	}

	public function is_database_template_cached($template_type, $template_name, $designation = '', $timestamp = '', $cache_id = '')
	{
		return $smarty->is_cached('module_db_tpl:' . $this->module->get_name() . ';' . $template_type . ';' . $template_name, $cache_id, ($designation != '' ? $designation : $this->module->get_name()));
	}

	public function process_from_database($id, $return_id, $template_type, $template_name = '', $designation = '', $cache_id = '')
	{
		$smarty = cms_smarty();

		$old_module = null;
		if ($smarty->get_template_vars('cms_mapi_module') != null)
			$old_module = $smarty->get_template_vars('cms_mapi_module');

		$smarty->assign_by_ref('cms_mapi_module', $this);
		$smarty->assign('cms_mapi_id', $id);
		$smarty->assign('cms_mapi_return_id', $return_id);

		$result = $smarty->fetch('module_db_tpl:' . $this->module->get_name() . ';' . $template_type . ';' . $template_name, $cache_id, ($designation != '' ? $designation : $this->module->get_name()));

		if ($old_module != null)
			$smarty->assign_by_ref('cms_mapi_module', $old_module);

		return $result;
	}

	/**
	* Given a template in a variable, this method processes it through smarty
	* note, there is no caching involved.
	*/
	public function process_from_data( $data )
	{
		$smarty = cms_smarty();
		$smarty->_compile_source('temporary template', $data, $_compiled );
		@ob_start();
		$smarty->_eval('?>' . $_compiled);
		$_contents = @ob_get_contents();
		@ob_end_clean();
		return $_contents;
	}
}

# vim:ts=4 sw=4 noet
?>