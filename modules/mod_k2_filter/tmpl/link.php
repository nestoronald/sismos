<?php
/**
 * @version		$Id: link.php 13 2011-03-12 12:00:00Z piotr_cz $
 * @package		K2 Extra fields Filter & Search
 * @copyright	Copyright (C) 2009 - 2011 Piotr Konieczny. All rights reserved.
 * @license		GNU/GPL 3.0
 * @author		smartwebstudio.com <info@smartwebstudio.com>
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

?>
		<ul>
<?php foreach ($extra_fields_content as $which => $field) : ?>
<?php 	$active = (in_array($field, (array) JRequest::getVar('searchword', null)) && JRequest::getVar('field_id') == $field_id); ?>
			<li>
<?php 	if ($active) : ?>
				<strong><?php echo $field; ?></strong>
<?php 	else : ?>				
				<a title="<?php echo $field; ?>" href="<?php echo JRoute::_($uri_request . '&searchword=' . $field) ?>" >
					<?php echo $field; ?>
				</a>
<?php 	endif; ?>
			</li>
<?php endforeach; ?>
		</ul>