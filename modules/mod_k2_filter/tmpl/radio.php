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
<?php foreach ($extra_fields_content as $which => $field) : ?>
<?php 	$active = (in_array($field, (array) JRequest::getVar('searchword', null)) && JRequest::getVar('field_id') == $field_id); ?>
			<label for="<?php echo 'mod'.$module->id.'-v'.$which; ?>"<?php if ($active): ?> class="active"<?php endif; ?>>
				<input name="searchword" type="radio" value="<?php echo $field; ?>" <?php if ($active) : ?> class="active" checked="checked"<?php endif; ?><?php if (!($button)) : ?> onchange="this.form.submit()"<?php endif; ?> id="<?php echo 'mod'.$module->id.'-v'.$which; ?>"/>
				<?php echo $field; ?>
			</label>
			<br />
<?php endforeach; ?>