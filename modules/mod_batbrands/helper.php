<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_batbrands
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Helper for mod_batbrands
 *
 * @since  1.5
 */
class ModBatbrandsHelper
{
	/**
	 * Retrieve list of batbrands
	 *
	 * @param   \Joomla\Registry\Registry  &$params  module parameters
	 *
	 * @return  mixed
	 */
	public static function &getList(&$params)
	{
		JModelLegacy::addIncludePath(JPATH_ROOT . '/components/com_batbrands/models', 'BatbrandsModel');

		$document = JFactory::getDocument();
		$app      = JFactory::getApplication();
		$keywords = explode(',', $document->getMetaData('keywords'));

		$model = JModelLegacy::getInstance('Batbrands', 'BatbrandsModel', array('ignore_request' => true));
		$model->setState('filter.client_id', (int) $params->get('cid'));
		$model->setState('filter.category_id', $params->get('catid', array()));
		$model->setState('list.limit', (int) $params->get('count', 1));
		$model->setState('list.start', 0);
		$model->setState('filter.ordering', $params->get('ordering'));
		$model->setState('filter.tag_search', $params->get('tag_search'));
		$model->setState('filter.keywords', $keywords);
		$model->setState('filter.language', $app->getLanguageFilter());

		$batbrands = $model->getItems();

		if ($batbrands)
		{
			$model->impress();
		}

		return $batbrands;
	}
}
