<?php
/**
 * @version		$Id: button.php 13 2011-03-12 12:00:00Z piotr_cz $
 * @package		K2 Extra fields Filter & Search
 * @copyright	Copyright (C) 2009 - 2011 Piotr Konieczny. All rights reserved.
 * @license		GNU/GPL 3.0
 * @author		smartwebstudio.com <info@smartwebstudio.com>
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

?>
	<fieldset>
		<legend><?php echo $extra_fields_name; ?></legend>
<?php foreach ($extra_fields_content as $which => $field) : ?>
<?php 	$active = (in_array($field, (array) JRequest::getVar('searchword', null)) && JRequest::getVar('field_id') == $field_id); ?>
		<button name="searchword" type="submit" value="<?php echo $field; ?>"<?php if ($active) : ?> class="active" disabled="disabled"<?php endif; ?> />
<?php if ($active) : ?>
			<strong><?php echo $field; ?></strong>
<?php else: ?>
			<?php echo $field; ?>
<?php endif; ?> 
		</button>
		<br />
<?php endforeach; ?>
	</fieldset>