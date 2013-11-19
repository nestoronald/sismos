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

require_once (JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'route.php');
require_once (JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'utilities.php');


class modK2FilterHelper {
  
	function getSearchImage($button_text) {

		$img = JHTML::_('image.site', 'searchButton.gif', '/images/M_images/', NULL, NULL, $button_text, null, 0);
		return $img;
	}

	// pulls out specified information about extra fields from the database
	function pull($field_id,$what) {
		$query 		= 'SELECT t.id, t.name as name, t.value as value, t.type as type FROM #__k2_extra_fields AS t WHERE t.published = 1 AND t.id = "'.$field_id.'"';
		$db 		=& JFactory::getDBO();
		$db->setQuery($query);
		
		$extra_fields = get_object_vars($db->loadObject());
		
		switch ($what) {
			case 'name' :
				$output = $extra_fields['name']; break;
			case 'type' :
				$output = $extra_fields['type']; break;
			case 'value' :
				$output = $extra_fields['value']; break;
			default:
				$output = $extra_fields['value']; break;
		}
		return $output;
	}
	
	// pulls out extra fields of specified item from the database
	function pullItem($itemID) {
		$query 		= 'SELECT t.id, t.extra_fields FROM #__k2_items AS t WHERE t.published = 1 AND t.id = "'.$itemID.'"';
		$db 		=& JFactory::getDBO();
		$db->setQuery($query);
		$extra_fields = get_object_vars($db->loadObject());
		$output 	= $extra_fields['extra_fields'];
		return $output;
	}
	
	// extracts info from JSON format
	function extractExtraFields($extraFields) {
		$jsonObjects = json_decode($extraFields);

		if (count($jsonObjects) < 1) return NULL;

		// convert objects to array
		foreach ($jsonObjects as $object){
			if (isset($object->name)) $objects[] = $object->name;
			else if (isset($object->id)) {
				$objects[$object->id] = $object->value;
			}
			else return;
		}
		return $objects;
	}
	
	// from thaderweb.com
	function getExtraField($id){
		$db			= JFactory::getDBO();
		$query		= "SELECT id, name, value FROM #__k2_extra_fields WHERE id = ".$db->quote($id); // $id
		$db->setQuery($query);
		$rows		= $db->loadObject();

		return $rows;
	}
}
