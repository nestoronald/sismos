<?php
/**
 * @version		$Id: text.php 13 2011-03-12 12:00:00Z piotr_cz $
 * @package		K2 Extra fields Filter & Search
 * @copyright	Copyright (C) 2009 - 2011 Piotr Konieczny. All rights reserved.
 * @license		GNU/GPL 3.0
 * @author		smartwebstudio.com <info@smartwebstudio.com>
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

?>
<?php 	$active = (JRequest::getVar('field_id') == $field_id); ?>
		<input name="searchword" type="text"<?php if ($active) : ?> value="<?php echo JRequest::getVar('searchword', ""); ?>" class="active"<?php endif; ?> size="<?php echo $width; ?>" maxlength="<?php echo $maxlength; ?>" />