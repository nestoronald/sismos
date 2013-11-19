<?php
/**
 * @version		$Id: wrapper.php 13 2011-03-12 12:00:00Z piotr_cz $
 * @package		K2 Extra fields Filter & Search
 * @copyright	Copyright (C) 2009 - 2011 Piotr Konieczny. All rights reserved.
 * @license		GNU/GPL 3.0
 * @author		smartwebstudio.com <info@smartwebstudio.com>
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

?>
<form method="<?php echo $method; ?>" action="<?php echo JRoute::_($uri_request); ?>" accept-charset="UTF-8" enctype="application/x-www-form-urlencoded" id="k2FilterBox<?php echo $module->id; ?>" class="k2FilterBlock <?php echo $params->get('moduleclass_sfx'); ?>">	
<?php // if ($method == "get") : // in form action ?>
<?php foreach ($vars as $cmd => $var) : ?>
	<input type="hidden" name="<?php echo $cmd; ?>" value="<?php echo $var; ?>" />
<?php endforeach; ?>
<?php // endif; ?>

	<fieldset>
<?php if ($show_legend) : ?>
		<legend><?php echo $extra_fields_name; ?></legend>
<?php endif; ?>
<?php require (JModuleHelper::getLayoutPath('mod_k2_filter', $field_type)); ?>
	</fieldset>
	
<?php if ($button): ?>
<?php 	if ($imagebutton): ?>
		<input type="image" value="<?php echo $button_text; ?>" class="button<?php echo $moduleclass_sfx; ?>" src="<?php echo $img; ?>" onclick="this.form.searchword.focus();"/>
<?php 	else: ?>
		<input type="submit" value="<?php echo $button_text; ?>" class="button<?php echo $moduleclass_sfx; ?>" />
<?php 	endif; ?>
<?php endif; ?>
</form>