<?php
/**
 * @version		$Id: CustomParams.php 13 2011-03-12 12:00:00Z piotr_cz $
 * @package		K2 Extra fields Filter & Search
 * @copyright	Copyright (C) 2009 - 2011 Piotr Konieczny. All rights reserved.
 * @license		GNU/GPL 3.0
 * @author		smartwebstudio.com <info@smartwebstudio.com>
*/

defined('_JEXEC') or die('Restricted access');

class JElementCustomParams extends JElement {
	var $_name = 'CustomParams';

	function fetchElement($name, $value, &$node, $control_name)
	{
		switch ($name) {
		
			case 'field_id' :
				return JElementCustomParams::_selectfield($name, $value, $node, $control_name);
		}
	}

	function _selectfield($name, $value, $node, $control_name)
	{
		$value = (int)$value;
		
		//! when starting for first time select first folder
		$first_save = ($this->_parent->get($name.'firstsave', 0)) ? true: false;
		if ($first_save) {
			$value = 1;
		}
		
		global $mainframe;
		$html 	= "";
		$db 	=& JFactory::getDBO();
		
		// get all extra fields (t.id, t.name, t.value, t.type, t.group, t.published, t.ordering)
		$query 	= "SELECT t.*, t.id FROM #__k2_extra_fields AS t ORDER BY t.group, t.ordering";
		$db->setQuery($query);
		$extra_fields = ($db->loadObjectList());
		
		if (empty($extra_fields)) {
			// $html .= '<script type="text/javascript">alert("'.JText::_('Cannot fech Extra Fields!').'");</script>';
			$html .= '<font color="red">'.JText::_('Cannot access Extra Fields!').'</font>';
			return;
		} else {			
		
			// get extra fields groups (g.id, g.name)
			$query = "SELECT g.*, g.id FROM #__k2_extra_fields_groups AS g LEFT JOIN #__k2_extra_fields t ON t.group = g.id";
			$db->setQuery($query);
			$extra_fields_groups = ($db->loadObjectList());
		
			// render table headers
			$html .= '
				<table class="adminlist" cellspacing="0" cellpadding="0">
					<thead>
						<tr>
							<th class="title" valign="middle">&nbsp;</th>
							<th class="title" valign="middle">'.JText::_('Name').'</th>
							<th class="title" valign="middle">'.JText::_('Type').'</th>
							<th class="title" valign="middle">'.JText::_('Group').'</th>
							<th class="title" valign="middle">'.JText::_('Order').'<img alt="" src="images/sort_desc.png"/></th>
							<th class="title" valign="middle">'.JText::_('Published').'</th>
							<th class="title" valign="middle">'.JText::_('id').'</th>
						</tr>
					</thead>
					<tbody>'
			;
		
			// render table fields
			foreach ($extra_fields as $which=>$extra_row) 
			{
				//$extra_row = get_object_vars($extra_row2);
				
				// Row
				$html .= '
						<tr class="row'.($which&1).'"'.
							($extra_row->published =='0' ? 'style="opacity:.5"' :'').
						'>
				';
			
				// Radio select
				$html .= '
							<td align="center">
								<input '.
									'name="'.$control_name.'['.$name.']" '.
									'type="radio" '.
									'value="'.$extra_row->id.'" '.
									'title="'.$extra_row->name.'" '.
									($value == $extra_row->id ? 'checked="checked"' :'').
									($extra_row->published == '0' ? 'disabled="disabled"' : '').
								'/>
							</td>
				';
			
				// Name
				$html .= '
							<td><strong>
								<a href="' . JURI::base() . 'index.php?option=com_k2&view=extraField&cid=' . $extra_row->id . '">
									' . $extra_row->name . '
								</a>
							</strong></td>
				';
			
				// value
				// $html	.= '<td>'.$extra_row->value.'</td>';
			
				// Type
				$html .= '
							<td>
								'.$extra_row->type. '
							</td>
				';
			
				// Group name
				$html .= '
							<td align="center">
								<a href="'.JURI::base().'index.php?option=com_k2&view=extraFieldsGroup&cid=1">
									' . $extra_fields_groups[$which]->name . '
								</a>
							</td>
				';
			
				// Ordering
				$html .= '
							<td align="center" >
								' . $extra_row->ordering . '
							</td>
				';
				
				// Published
				$html .= '
							<td align="center">
								<a href="'.JURI::base().'index.php?option=com_k2&view=extraFields">
									'. ($extra_row->published =='1' ?
										'<img border="0" alt="'.JText::_('Published').'" src="images/tick.png" />' :
										'<img border="0" alt="'.JText::_('Unpublished').'" src="images/publish_x.png" / >'
									). '
								</a>
							</td>
				';
			
				// ID
				$html .= '
							<td align="center">
								' . $extra_row->id . '
							</td>
				';
			
				// row
				$html	.= '</tr>';
			}
			$html	.= '</table>';

			// shortcuts
			$html .= '
						<p>
							' . JText::_('Shortcuts: ') . '
							<a href="' .JURI::base().'index.php?option=com_k2&view=extraFields">'.JText::_('K2 Extra Fields manager'). '</a> '.
							' | '.
							'<a href="' .JURI::base().'index.php?option=com_k2&view=extraFieldsGroups">'.JText::_('K2 Extra Field groups manager'). '</a>
						</p>
			';
		}
		
		return $html;
	}
}

?>