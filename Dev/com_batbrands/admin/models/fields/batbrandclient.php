<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_batbrands
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

JLoader::register('BatbrandsHelper', JPATH_ADMINISTRATOR . '/components/com_batbrands/helpers/batbrands.php');

JFormHelper::loadFieldClass('list');

/**
 * Batbrandclient field.
 *
 * @since  1.6
 */
class JFormFieldBatbrandClient extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  1.6
	 */
	protected $type = 'BatbrandClient';

	/**
	 * Method to get the field options.
	 *
	 * @return  array  The field option objects.
	 *
	 * @since   1.6
	 */
	public function getOptions()
	{
		return array_merge(parent::getOptions(), BatbrandsHelper::getClientOptions());
	}
}
