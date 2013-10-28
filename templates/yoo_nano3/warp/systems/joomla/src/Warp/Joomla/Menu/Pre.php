<?php
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

namespace Warp\Joomla\Menu;

/**
 * Menu base class.
 */
class Pre
{
	/**
	 * Process menu
	 *
	 * @param object $module
	 * @param object $element
	 *
	 * @return object
	 */
	public function process($module, $element)
	{
		global $warp;

		// has ul ?
		if (!$element->first('ul:first')) {
			return false;
		}

		// init vars
		$menu   = \JFactory::getApplication()->getMenu();

        // get warp config
        $config = $warp['config'];

		foreach ($element->find('li') as $li) {

			$item = null;

			// get menu item
			if (preg_match('/item-(\d+)/', $li->attr(version_compare(JVERSION, '1.7.0', '>=') ? 'class' : 'id'), $matches)) {
				$item = $menu->getItem($matches[1]);
			}

			// set id
			if (isset($item)) {
				$li->attr('data-id', $item->id);
			}

			// set current and active
			if ($li->hasClass('active')) {
				$li->attr('data-menu-active', $li->hasClass('current') == 'current' ? 2 : 1);
			}

			// set columns and width
			if (isset($item)) {

				if ($columns = (int) $config->get("menus.{$item->id}.columns")) {
					$li->attr('data-menu-columns', $columns);
				}

				if ($columnwidth = (int) $config->get("menus.{$item->id}.columnwidth")) {
					$li->attr('data-menu-columnwidth', $columnwidth);
				}

                if ($icon = $config->get("menus.{$item->id}.icon")) {
                    if (preg_match('/\.(gif|png|jpg|jpeg|svg)$/', $icon)) {
                        $li->attr('data-menu-image', $warp['path']->url('site:').$icon);
                    } else {
                        $li->attr('data-menu-icon', $icon);
                    }
				}

                if ($subtitle = $config->get("menus.{$item->id}.subtitle")) {
                    $li->attr('data-menu-subtitle', $subtitle);
				}

			}

			if($span = $li->first("span:first")) {

				if($span->hasClass("separator")) {

					$type = $type = $span->text()=="-" ? "separator" : "header";

					$span->replaceWith('<a data-type="'.$type.'">'.$span->text().'</a>');
				}
			}

			$li->removeAttr('id')->removeAttr('class');
			$li->parent()->removeAttr('class');
		}

		return $element;
	}
}
