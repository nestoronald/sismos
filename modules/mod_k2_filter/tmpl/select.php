<?php
/**
 * @version		$Id: select.php 13 2011-03-12 12:00:00Z piotr_cz $
 * @package		K2 Extra fields Filter & Search
 * @copyright	Copyright (C) 2009 - 2011 Piotr Konieczny. All rights reserved.
 * @license		GNU/GPL 3.0
 * @author		smartwebstudio.com <info@smartwebstudio.com>
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

?>		
		<select name="searchword" <?php if (!($button)) : ?>onchange="this.form.submit();"<?php endif; ?>>
			<option>-- <?php echo JText::_('Select').' '.$extra_fields_name; ?> --</option>
<?php foreach ($extra_fields_content as $field) : ?>
<?php 	$active = (in_array($field, (array) JRequest::getVar('searchword', null)) && JRequest::getVar('field_id') == $field_id); ?>
			<option <?php if ($active) : ?>class="active" selected="selected"<?php endif; ?>value="<?php echo ($field); /* urlencode($field); */ ?>"><?php echo $field; ?></option>
<?php endforeach; ?>
		</select>