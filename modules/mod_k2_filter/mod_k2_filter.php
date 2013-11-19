<?php 
/*
// "K2 Tools" Module by JoomlaWorks for Joomla! 1.5.x - Version 2.1
// Copyright (c) 2006 - 2009 JoomlaWorks Ltd. All rights reserved.
// Released under the GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
// More info at http://www.joomlaworks.gr and http://k2.joomlaworks.gr
// Designed and developed by the JoomlaWorks team
// *** Last update: September 9th, 2009 ***
*/

/*
// mod for K2 Extra fields Filter and Search module by Piotr Konieczny
// piotr@smartwebstudio.com
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once (dirname(__FILE__).DS.'helper.php');

// Main params
$moduleclass_sfx 	= (string) 	$params->get('moduleclass_sfx', '');				// Module Class Suffix
$show_legend		= (int)		$params->get('show_legend', "1");					// Show legend

$advanced 			= (int) 	$params->get('advanced', '0');						// Only selected Extra field
$field_type 		= (string) 	$params->get('field_type', 'select');				// Filter type (View)
$restrict_category 	= (int) 	$params->get('restrict_category', '0');				// Restrict to specific category?
$catid 				= (int) 	$params->get('category', '0');						// Category
$all_langs 			= (int) 	$params->get('all_langs', '0');						// Results for all languages?
$field_id 			= (int) 	$params->get('field_id', '1');						// Select Extra field
// Search button params
$width 				= intval($params->get('width', 20));							// Search Box size
$maxlength 			= $width > 20 ? $width : 20;									// 
$text 				= (string) 	$params->get('text', JText::_('Search...'));		// Text
$button 			= (int) 	$params->get('button', '0');						// Show submit button
$imagebutton 		= (string) 	$params->get('imagebutton', '');					// Sumbit button as image
$button_text 		= (string) 	$params->get('button_text', JText::_('Search'));	// Submit button text
// form options
$method				= (string) $params->get('method', "get");						// method
$set_itemid			= (int) $params->get('set_itemid', "");							// push Itemid

//JHTML::_('behavior.mootools'); //?
$document 			=& JFactory::getDocument();
$app 				=& JFactory::getApplication();


// Output
$extra_fields_content = (
	modK2FilterHelper::extractExtraFields(
		modK2FilterHelper::pull($field_id, "")) 
);
$extra_fields_name = (
		modK2FilterHelper::pull($field_id, "name")
);
// $extra_fields_name =  json_decode(modK2FilterHelper::getExtraField($field_id)->value->name);


// build request query
{
	// form request
	jimport( 'joomla.environment.uri' );
	$vars_default = array(
		'option' 		=> "com_k2",
		'view' 			=> "itemlist",
		'task' 			=> "filter"
	);
	if ($set_itemid) $vars_default['Itemid'] = $set_itemid;
	$uri_request = "index.php?" . JURI::buildQuery($vars_default);

	// form options
	$vars_options = array();
	if ($all_langs == '1') 							$vars_options['all_langs'] 	= "yes";
	if ($restrict_category == '1' && $catid != '0')	$vars_options['catid'] 		= $catid;
	if ($advanced == '1' ) 							$vars_options['field_id'] 	= $field_id;

	// $uri_request = "index.php?" . JURI::buildQuery(array_merge($vars_default, $vars_options));
	
	if (!$app->getCfg('sef')) {
		$vars = array_merge($vars_default, $vars_options);
	} else {
		// SEF already constructs query
		$vars = $vars_options;
	}
	
}

require (JModuleHelper::getLayoutPath('mod_k2_filter', 'wrapper'));