<?php
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

$mime = !empty($this->result->mime) ? 'mime-' . $this->result->mime : null;
$base = JURI::getInstance()->toString(array('scheme', 'host', 'port'));

if (!empty($this->query->highlight) && empty($this->result->mime) && $this->params->get('highlight_terms', 1) && JPluginHelper::isEnabled('system', 'highlight')) {
	$route = $this->result->route . '&highlight=' . base64_encode(json_encode($this->query->highlight));
} else {
	$route = $this->result->route;
}

?>

<article class="uk-article">

	<h1 class="uk-article-title">
		<a href="<?php echo JRoute::_($route); ?>"><?php echo $this->result->title; ?></a>
	</h1>

	<?php if ($this->params->get('show_description', 1)) : ?>
		<?php echo JHtml::_('string.truncate', $this->result->description, $this->params->get('description_length', 255)); ?>
	<?php endif; ?>

	<?php if ($this->params->get('show_url', 1)): ?>
	<p><?php echo $base . JRoute::_($this->result->route); ?></p>
	<?php endif; ?>

</article>