INSERT INTO content (id, content_name, type, owner_id, parent_id, template_id, item_order, hierarchy, default_content, menu_text, content_alias, show_in_menu, collapsed, markup, active, cachable, id_hierarchy, hierarchy_path, prop_names, metadata, titleattribute, tabindex, accesskey, last_modified_by, create_date, modified_date, lft, rgt) VALUES (1, '__root_node__', 'root', 1, -1, -1, 1, '', 0, '__root_node__', '__root_node__', 0, 0, 'none', 1, 0, '', '__root_node__', '', '', '', '', '', 1, NULL, NULL, 1, 4);
INSERT INTO content (id, content_name, type, owner_id, parent_id, template_id, item_order, lft, rgt, hierarchy, default_content, menu_text, content_alias, show_in_menu, collapsed, markup, active, cachable, id_hierarchy, hierarchy_path, prop_names, metadata, titleattribute, tabindex, accesskey, last_modified_by, create_date, modified_date) VALUES (2,'','content',1,1,1,1,2,3,'1',1,'','',1,0,'',1,0,'2','','default-block-type,default-content,front_page_image-block-type,front_page_image-content,name,menu_text','','','','',1,'2007-11-20 17:49:26','2007-11-20 17:49:41');
INSERT INTO content_props (id, content_id, type, prop_name, language, content, create_date, modified_date) VALUES (1,2,'cmscontentproperty','default-block-type','en_US','html','2007-11-20 17:39:47','2007-11-20 18:07:27');
INSERT INTO content_props (id, content_id, type, prop_name, language, content, create_date, modified_date) VALUES (2,2,'cmscontentproperty','default-content','en_US','<p>Congratulations! You now have a fully functional installation of CMS Made Simple and you are <em>almost</em> ready to start building your site. First thing though, you should click <a href=\"install/upgrade.php\" title=\"Check if your CMSMS system needs upgrading\">here</a> to check if your site requires a database upgrade. After you have confirmed you are up to date, then we can get cracking on the site development! </p>\r\n\r\n<p>These default pages are devoted to showing you the basics of how to get your site up with CMS Made Simple. </p>\r\n\r\n<p>To get to the Administration Panel you have to login as the administrator (with the username/password you mentioned during the installation process) on your site at http://yourwebsite.com/cmsmspath/admin. </p>\r\n\r\n<p>If you are right now on your own default install, you can probably just click <a title=\"CMSMS Demo Admin Panel\" href=\"admin/\">this link</a>. </p>\r\n\r\n<h3>Learning CMS Made Simple </h3>\r\n\r\n<p>On these example pages many of the features of the default installation of CMS Made Simple are described and demonstrated. You can learn about how to use different kinds of menus, templates, stylesheets and extensions. </p>\r\n\r\n<p>Read about how to use CMS Made Simple in the {cms_selflink ext=\"http://wiki.cmsmadesimple.org/\" title=\"CMS Made Simple Documentation\" text=\"documentation\" target=\"_blank\"}. In case you need any help the community is always at your service, in the \r\n{cms_selflink ext=\"http://forum.cmsmadesimple.org\" title=\"CMS Made Simple Forum\" text=\"forum\" target=\"_blank\"} or the {cms_selflink ext=\"http://www.cmsmadesimple.org/IRC.shtml\" title=\"Information about the CMS Made Simple IRC channel\" text=\"IRC\" target=\"_blank\"}. </p>\r\n\r\n<h3>License </h3>\r\n\r\n<p>CMS Made Simple is released under the {cms_selflink ext=\"http://www.gnu.org/licenses/licenses.html#GPL\" title=\"General Public License\" text=\"GPL\" target=\"_blank\"} license </p>','2007-11-20 17:39:47','2007-11-20 18:07:27');
INSERT INTO content_props (id, content_id, type, prop_name, language, content, create_date, modified_date) VALUES (3,2,'cmscontentproperty','front_page_image-block-type','en_US','html','2007-11-20 17:39:47','2007-11-20 17:39:47');
INSERT INTO content_props (id, content_id, type, prop_name, language, content, create_date, modified_date) VALUES (4,2,'cmscontentproperty','front_page_image-content','en_US','Test','2007-11-20 17:39:47','2007-11-20 17:39:47');
INSERT INTO content_props (id, content_id, type, prop_name, language, content, create_date, modified_date) VALUES (5,2,'cmscontentproperty','name','en_US','Home','2007-11-20 17:39:47','2007-11-20 18:07:27');
INSERT INTO content_props (id, content_id, type, prop_name, language, content, create_date, modified_date) VALUES (6,2,'cmscontentproperty','menu_text','en_US','Home','2007-11-20 17:39:47','2007-11-20 18:07:27');
INSERT INTO group_permissions (id, permission_defn_id, group_id, object_id, has_access) VALUES (1, 1, -1, 1, 1),
INSERT INTO group_permissions (id, permission_defn_id, group_id, object_id, has_access) VALUES (2, 1, 1, 2, 1),
INSERT INTO group_permissions (id, permission_defn_id, group_id, object_id, has_access) VALUES (3, 2, -1, 1, 0),
INSERT INTO group_permissions (id, permission_defn_id, group_id, object_id, has_access) VALUES (4, 3, -1, 1, 0);
INSERT INTO groups (id, group_name, active, create_date, modified_date) VALUES (1, 'Users', 1, '2007-11-25 16:01:31', '2007-11-25 16:01:31'),
INSERT INTO groups (id, group_name, active, create_date, modified_date) VALUES (2, 'Editors', 1, '2007-11-25 16:01:31', '2007-11-25 16:01:31');
INSERT INTO permission_defns (id, module, extra_attr, name, hierarchical, link_table) VALUES (1, 'Core', 'Page', 'View', 1, 'content'),
INSERT INTO permission_defns (id, module, extra_attr, name, hierarchical, link_table) VALUES (2, 'Core', 'Page', 'Edit', 1, 'content'),
INSERT INTO permission_defns (id, module, extra_attr, name, hierarchical, link_table) VALUES (3, 'Core', 'Page', 'Delete', 1, 'content');
INSERT INTO siteprefs ( SITEPREF_NAME, SITEPREF_VALUE, CREATE_DATE, MODIFIED_DATE ) VALUES ( 'enablecustom404', '0', '2006-07-25 21:22:33', '2006-07-25 21:22:33' );
INSERT INTO siteprefs ( SITEPREF_NAME, SITEPREF_VALUE, CREATE_DATE, MODIFIED_DATE ) VALUES ( 'custom404', '<p>Page could not be found.</p>', '2006-07-25 21:22:33', '2006-07-25 21:22:33' );
INSERT INTO siteprefs ( SITEPREF_NAME, SITEPREF_VALUE, CREATE_DATE, MODIFIED_DATE ) VALUES ( 'custom404template', '-1', '2006-07-25 21:22:33', '2006-07-25 21:22:33' );
INSERT INTO siteprefs ( SITEPREF_NAME, SITEPREF_VALUE, CREATE_DATE, MODIFIED_DATE ) VALUES ( 'enablesitedownmessage', '0', '2006-07-25 21:22:33', '2006-07-25 21:22:33' );
INSERT INTO siteprefs ( SITEPREF_NAME, SITEPREF_VALUE, CREATE_DATE, MODIFIED_DATE ) VALUES ( 'sitedownmessage', '<p>Site is currently down for maintenance.</p>', '2006-07-25 21:22:33', '2006-07-25 21:22:33' );
INSERT INTO siteprefs ( SITEPREF_NAME, SITEPREF_VALUE, CREATE_DATE, MODIFIED_DATE ) VALUES ( 'sitedownmessagetemplate', '-1', '2006-07-25 21:22:33', '2006-07-25 21:22:33' );
INSERT INTO siteprefs ( SITEPREF_NAME, SITEPREF_VALUE, CREATE_DATE, MODIFIED_DATE ) VALUES ( 'useadvancedcss', '1', '2006-07-25 21:22:33', '2006-07-25 21:22:33' );
INSERT INTO siteprefs ( SITEPREF_NAME, SITEPREF_VALUE, CREATE_DATE, MODIFIED_DATE ) VALUES ( 'metadata', '<meta name=\"Generator\" content=\"CMS Made Simple - Copyright (C) 2004-6 Ted Kulp. All rights reserved.\" />\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n ', '2006-07-25 21:22:33', '2006-07-25 21:22:33' );
INSERT INTO siteprefs ( SITEPREF_NAME, SITEPREF_VALUE, CREATE_DATE, MODIFIED_DATE ) VALUES ( 'xmlmodulerepository', null, '2006-07-25 21:22:33', '2006-07-25 21:22:33' );
INSERT INTO siteprefs ( SITEPREF_NAME, SITEPREF_VALUE, CREATE_DATE, MODIFIED_DATE ) VALUES ( 'logintheme', 'default', '2006-07-25 21:22:33', '2006-07-25 21:22:33' );
INSERT INTO templates ( id, template_name, template_content, encoding, active, default_template, create_date, modified_date ) VALUES (1,'Minimal Template','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"\r\n\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">\r\n{* Change lang=\"en\" to the language of your site *}\r\n\r\n<head>\r\n\r\n<title>{sitename} - {title}</title>\r\n{* The sitename is changed in Site Admin/Global settings. {title} is the name of each page *}\r\n\r\n{header}\r\n{* This is how all the stylesheets attached to this template are linked to and where metadata is displayed *}\r\n\r\n</head>\r\n\r\n<body>\r\n\r\n      {* Start Navigation *}\r\n      <div style=\"float: left; width: 25%;\">\r\n         {menu template=\'minimal_menu.tpl\'}\r\n      </div>\r\n      {* End Navigation *}\r\n\r\n      {* Start Content *}\r\n      <div>\r\n         <h2>{title}</h2>\r\n         {content}\r\n      </div>\r\n      {* End Content *}\r\n\r\n</body>\r\n</html>','',1,1,'2007-11-20 17:21:42','2007-11-20 18:11:32');
INSERT INTO version ( VERSION ) VALUES ( 1 );
